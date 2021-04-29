<?php
App::uses('AppController', 'Controller');
/**
 * Ngos Controller
 *
 * @property Ngo $GeographicalNgo
 * @property PaginatorComponent $Paginator
 */
class BpmcsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Upload');

    var  $uses = array('Bpmc','Geographical','Ngo','User','RegisterMember','Village','Panchayat','MeetingFacilitated','Country','City','Block','Designation','Ward','IssueCategory','IssueSubcategory','Bpccc','Bpc','Dpo');
/**
 * index method
 *
 * @return void
 */
	public function index() {
		
		$data='';$searchKey=null;$searchUserId=null;$searchBuilderId=null;$searchProjectId=null;$fromdate=null;$todate=null;
		$condition='';$querySrting=''; $condition=array();
		$conc='';
		
		if(isset($this->params->query['confirm'])) {
	   
		if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('Bpmc.id LIKE'=>'%'.$searchKey.'%','Bpmc.decisions_taken LIKE'=>'%'.$searchKey.'%','Bpmc.issue_resolved LIKE '=>'%'.$searchKey.'%','Bpmc.details_of_issues LIKE '=>'%'.$searchKey.'%'); 
	
	}
		
		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(Bpmc.meeting_date) >='=>$fromdate,'date(Bpmc.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['Bpmc.meeting_date']=$fromdate;	
				}
				
			}
		
                 if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBuilderId=trim($this->request->query['block']); 
		$condition['Bpmc.block']=$searchBuilderId;
		}
		
	}
        if(CakeSession::read('User.type')==='regular'){
             if(CakeSession::read('User.subrole')==='BPC'){
		   $r = $this->Bpc->find('first',array('conditions'=>array('Bpc.first_name='.CakeSession::read('User.id'))));
                       if($r){
                           
                            if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBuilderId=trim($this->request->query['block']); 
		            $condition['Bpmc.block']=$searchBuilderId;
                            } else {
                     
                        $condition=['Bpmc.block IN' =>explode(',',$r['Bpc']['allocated_block'])];
                            }
                            
                            if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('Bpmc.id LIKE'=>'%'.$searchKey.'%','Bpmc.decisions_taken LIKE'=>'%'.$searchKey.'%','Bpmc.issue_resolved LIKE '=>'%'.$searchKey.'%','Bpmc.details_of_issues LIKE '=>'%'.$searchKey.'%'); 
	
	}
                            if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(Bpmc.meeting_date) >='=>$fromdate,'date(Bpmc.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['Bpmc.meeting_date']=$fromdate;	
				}
				
			}
                      } 
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Block yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }   
		 $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id IN'=>explode(',',$r['Bpc']['allocated_block']))));
             }else {
                 $r = $this->Dpo->find('first',array('conditions'=>array('Dpo.first_name='.CakeSession::read('User.id'))));
                      if($r){ 
                          
                          if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){
                              $searchBlockId=trim($this->request->query['block']);
                              
		          $condition['Bpmc.block']=$searchBuilderId;
		        }else {
                       $condition='Bpmc.district='.$r['Dpo']['district'];
                        //$condition2.=' and Bpmc.district IN ('.$r['Dpo']['district'].')';
                        }
                        if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('Bpmc.id LIKE'=>'%'.$searchKey.'%','Bpmc.decisions_taken LIKE'=>'%'.$searchKey.'%','Bpmc.issue_resolved LIKE '=>'%'.$searchKey.'%','Bpmc.details_of_issues LIKE '=>'%'.$searchKey.'%'); 
	
	}
                        if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(Bpmc.meeting_date) >='=>$fromdate,'date(Bpmc.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['Bpmc.meeting_date']=$fromdate;	
				}
				
			}
                      } 
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Block yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
			$blocks=$this->Block->find('list',array('order' => array('name' => 'asc'),'conditions'=>array('Block.city_id IN'=>explode(',',$r['Dpo']['district']))));
                     
             }
		}
                 else if(CakeSession::read('User.type')==='user'){
	   $r = $this->Ngo->find('first',array('conditions'=>array('Ngo.chief_functionary_name='.CakeSession::read('User.id'))));
                 if($r){
                     $blo=array();
                   $blo= [$r['Ngo']['allocated_block_one'],$r['Ngo']['allocated_block_two']];
                     if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){
                              $searchBlockId=trim($this->request->query['block']);
		         $condition['Bpmc.block']=$searchBlockId;
		        }else {
                            
                       $condition=['Bpmc.block IN' =>$blo];
                       
                      }
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('Bpmc.id LIKE'=>'%'.$searchKey.'%','Bpmc.decisions_taken LIKE'=>'%'.$searchKey.'%','Bpmc.issue_resolved LIKE '=>'%'.$searchKey.'%','Bpmc.details_of_issues LIKE '=>'%'.$searchKey.'%'); 
	
	}
                      if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(Bpmc.meeting_date) >='=>$fromdate,'date(Bpmc.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['Bpmc.meeting_date']=$fromdate;	
				}
				
			}
		}
                 $blocks=$this->Block->find('list',array('order' => array('name' => 'asc'),'conditions'=>array('Block.id IN'=>$blo)));
                 $ngos=$this->Ngo->find('list',array('conditions'=>array('Ngo.id'=>$r['Ngo']['id'])));
                     
         }
                
                else {
                   $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'))); 
                }
		
		$this->Paginator->settings = array('Bpmc' => array('limit' =>20,'group'=>array('meeting_date','block'),'order' => array('id' => 'desc'),'conditions'=>array($condition,'Bpmc.status'=>'active')));
		$this->Bpmc->recursive = 0;
		$this->set('anms', $this->Paginator->paginate());
//		$panchayats=$this->Panchayat->find('list');
//                $villages=$this->Village->find('list');
//                $wards=$this->Ward->find('list');
//		$blocks=$this->Block->find('list');	
//			$users = $this->User->find('list',array('fields'=>array('parent'),'conditions'=>array('status'=>'active')));
//			$builders=$this->Builder->find('list');
			$this->set(compact('panchayats','villages','wards','blocks'));
			
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Bpmc->exists($id)) {
			throw new NotFoundException(__('Invalid  Meeting'));
		}
		$options = array('conditions' => array('Bpmc.' . $this->Bpmc->primaryKey => $id));
		$this->set('anm', $this->Bpmc->find('first', $options));
		$this->layout='newdefault';
	}
	
	
	public function viewissues($id = null,$date=null) {
		$r= explode(',',$id);
              //  print_r($r);
                //die();
		$options = array('conditions' => array('Bpmc.block' => $r['0'],'Bpmc.meeting_date' => $r['1']));
		$this->set('anms', $this->Bpmc->find('all', $options));
		$this->layout='newdefault';
	}
public function viewpendingissue() {
		
		$data='';$searchKey=null;$searchUserId=null;$searchBuilderId=null;$searchProjectId=null;$fromdate=null;$todate=null;
		$condition='';$querySrting=''; $condition=array();
		$conc='';
		
		if(isset($this->params->query['confirm'])) {
	   
		if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('Bpmc.id LIKE'=>'%'.$searchKey.'%','Bpmc.decisions_taken LIKE'=>'%'.$searchKey.'%','Bpmc.issue_resolved LIKE '=>'%'.$searchKey.'%','Bpmc.details_of_issues LIKE '=>'%'.$searchKey.'%'); 
	
	}
		
		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(Bpmc.meeting_date) >='=>$fromdate,'date(Bpmc.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['Bpmc.meeting_date']=$fromdate;	
				}
				
			}
		
                 if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBuilderId=trim($this->request->query['block']); 
		$condition['Bpmc.block']=$searchBuilderId;
		}
		
	}
        if(CakeSession::read('User.type')==='regular'){
             if(CakeSession::read('User.subrole')==='BPC'){
		   $r = $this->Bpc->find('first',array('conditions'=>array('Bpc.first_name='.CakeSession::read('User.id'))));
                       if($r){
                           
                            if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBuilderId=trim($this->request->query['block']); 
		            $condition['Bpmc.block']=$searchBuilderId;
                            } else {
                     
                        $condition=['Bpmc.block IN' =>explode(',',$r['Bpc']['allocated_block'])];
                            }
                            if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('Bpmc.id LIKE'=>'%'.$searchKey.'%','Bpmc.decisions_taken LIKE'=>'%'.$searchKey.'%','Bpmc.issue_resolved LIKE '=>'%'.$searchKey.'%','Bpmc.details_of_issues LIKE '=>'%'.$searchKey.'%'); 
	
	}
                            if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(Bpmc.meeting_date) >='=>$fromdate,'date(Bpmc.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['Bpmc.meeting_date']=$fromdate;	
				}
				
			}
                      } 
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Block yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }   
		 $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id IN'=>explode(',',$r['Bpc']['allocated_block']))));
             }else {
                 $r = $this->Dpo->find('first',array('conditions'=>array('Dpo.first_name='.CakeSession::read('User.id'))));
                      if($r){ 
                          
                          if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){
                              $searchBlockId=trim($this->request->query['block']);
                              
		          $condition['Bpmc.block']=$searchBuilderId;
		        }else {
                       $condition='Bpmc.district='.$r['Dpo']['district'];
                        //$condition2.=' and Bpmc.district IN ('.$r['Dpo']['district'].')';
                        }
                        if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('Bpmc.id LIKE'=>'%'.$searchKey.'%','Bpmc.decisions_taken LIKE'=>'%'.$searchKey.'%','Bpmc.issue_resolved LIKE '=>'%'.$searchKey.'%','Bpmc.details_of_issues LIKE '=>'%'.$searchKey.'%'); 
	
	}
                        if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(Bpmc.meeting_date) >='=>$fromdate,'date(Bpmc.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['Bpmc.meeting_date']=$fromdate;	
				}
				
			}
                      } 
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Block yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
			$blocks=$this->Block->find('list',array('order' => array('name' => 'asc'),'conditions'=>array('Block.city_id IN'=>explode(',',$r['Dpo']['district']))));
                     
             }
		}
                else if(CakeSession::read('User.type')==='user'){
	   $r = $this->Ngo->find('first',array('conditions'=>array('Ngo.chief_functionary_name='.CakeSession::read('User.id'))));
                 if($r){
                     $blo=array();
                   $blo= [$r['Ngo']['allocated_block_one'],$r['Ngo']['allocated_block_two']];
                     if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){
                              $searchBlockId=trim($this->request->query['block']);
		         $condition['Bpmc.block']=$searchBlockId;
		        }else {
                            
                       $condition=['Bpmc.block IN' =>$blo];
                       
                      }
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('Bpmc.id LIKE'=>'%'.$searchKey.'%','Bpmc.decisions_taken LIKE'=>'%'.$searchKey.'%','Bpmc.issue_resolved LIKE '=>'%'.$searchKey.'%','Bpmc.details_of_issues LIKE '=>'%'.$searchKey.'%'); 
	
	}
                      if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(Bpmc.meeting_date) >='=>$fromdate,'date(Bpmc.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['Bpmc.meeting_date']=$fromdate;	
				}
				
			}
		}
                 $blocks=$this->Block->find('list',array('order' => array('name' => 'asc'),'conditions'=>array('Block.id IN'=>$blo)));
                 $ngos=$this->Ngo->find('list',array('conditions'=>array('Ngo.id'=>$r['Ngo']['id'])));
                     
         }
                else {
                   $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'))); 
                }
		
		$this->Paginator->settings = array('Bpmc' => array('limit' =>20,'order' => array('id' => 'desc'),'conditions'=>array($condition,'Bpmc.status'=>'active','Bpmc.updated'=>'0')));
		$this->Bpmc->recursive = 0;
		$this->set('anms', $this->Paginator->paginate());
//		$panchayats=$this->Panchayat->find('list');
//                $villages=$this->Village->find('list');
//                $wards=$this->Ward->find('list');
//		$blocks=$this->Block->find('list');	
//			$users = $this->User->find('list',array('fields'=>array('parent'),'conditions'=>array('status'=>'active')));
//			$builders=$this->Builder->find('list');
			$this->set(compact('panchayats','villages','wards','blocks'));
			
	}
  public function viewresolvedissue() {
		
		$data='';$searchKey=null;$searchUserId=null;$searchBuilderId=null;$searchProjectId=null;$fromdate=null;$todate=null;
		$condition='';$querySrting=''; $condition=array();
		$conc='';
		
		if(isset($this->params->query['confirm'])) {
	   
		if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('Bpmc.id LIKE'=>'%'.$searchKey.'%','Bpmc.decisions_taken LIKE'=>'%'.$searchKey.'%','Bpmc.issue_resolved LIKE '=>'%'.$searchKey.'%','Bpmc.details_of_issues LIKE '=>'%'.$searchKey.'%'); 
	
	}
		
		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(Bpmc.meeting_date) >='=>$fromdate,'date(Bpmc.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['Bpmc.meeting_date']=$fromdate;	
				}
				
			}
		
                 if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBuilderId=trim($this->request->query['block']); 
		$condition['Bpmc.block']=$searchBuilderId;
		}
		
	}
        if(CakeSession::read('User.type')==='regular'){
             if(CakeSession::read('User.subrole')==='BPC'){
		   $r = $this->Bpc->find('first',array('conditions'=>array('Bpc.first_name='.CakeSession::read('User.id'))));
                       if($r){
                           
                            if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBuilderId=trim($this->request->query['block']); 
		            $condition['Bpmc.block']=$searchBuilderId;
                            } else {
                     
                        $condition=['Bpmc.block IN' =>explode(',',$r['Bpc']['allocated_block'])];
                            }
                            if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('Bpmc.id LIKE'=>'%'.$searchKey.'%','Bpmc.decisions_taken LIKE'=>'%'.$searchKey.'%','Bpmc.issue_resolved LIKE '=>'%'.$searchKey.'%','Bpmc.details_of_issues LIKE '=>'%'.$searchKey.'%'); 
	
	}
                            if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(Bpmc.meeting_date) >='=>$fromdate,'date(Bpmc.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['Bpmc.meeting_date']=$fromdate;	
				}
				
			}
                      } 
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Block yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }   
		 $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id IN'=>explode(',',$r['Bpc']['allocated_block']))));
             }else {
                 $r = $this->Dpo->find('first',array('conditions'=>array('Dpo.first_name='.CakeSession::read('User.id'))));
                      if($r){ 
                          
                          if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){
                              $searchBlockId=trim($this->request->query['block']);
                              
		          $condition['Bpmc.block']=$searchBuilderId;
		        }else {
                       $condition='Bpmc.district='.$r['Dpo']['district'];
                        //$condition2.=' and Bpmc.district IN ('.$r['Dpo']['district'].')';
                        }
                        if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('Bpmc.id LIKE'=>'%'.$searchKey.'%','Bpmc.decisions_taken LIKE'=>'%'.$searchKey.'%','Bpmc.issue_resolved LIKE '=>'%'.$searchKey.'%','Bpmc.details_of_issues LIKE '=>'%'.$searchKey.'%'); 
	
	}
                        if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(Bpmc.meeting_date) >='=>$fromdate,'date(Bpmc.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['Bpmc.meeting_date']=$fromdate;	
				}
				
			}
                      } 
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Block yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
			$blocks=$this->Block->find('list',array('order' => array('name' => 'asc'),'conditions'=>array('Block.city_id IN'=>explode(',',$r['Dpo']['district']))));
                     
             }
		}
                else if(CakeSession::read('User.type')==='user'){
	   $r = $this->Ngo->find('first',array('conditions'=>array('Ngo.chief_functionary_name='.CakeSession::read('User.id'))));
                 if($r){
                     $blo=array();
                   $blo= [$r['Ngo']['allocated_block_one'],$r['Ngo']['allocated_block_two']];
                     if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){
                              $searchBlockId=trim($this->request->query['block']);
		         $condition['Bpmc.block']=$searchBlockId;
		        }else {
                            
                       $condition=['Bpmc.block IN' =>$blo];
                       
                      }
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('Bpmc.id LIKE'=>'%'.$searchKey.'%','Bpmc.decisions_taken LIKE'=>'%'.$searchKey.'%','Bpmc.issue_resolved LIKE '=>'%'.$searchKey.'%','Bpmc.details_of_issues LIKE '=>'%'.$searchKey.'%'); 
	
	}
                      if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(Bpmc.meeting_date) >='=>$fromdate,'date(Bpmc.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['Bpmc.meeting_date']=$fromdate;	
				}
				
			}
		}
                 $blocks=$this->Block->find('list',array('order' => array('name' => 'asc'),'conditions'=>array('Block.id IN'=>$blo)));
                 $ngos=$this->Ngo->find('list',array('conditions'=>array('Ngo.id'=>$r['Ngo']['id'])));
                     
         }
                else {
                   $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'))); 
                }
		
		$this->Paginator->settings = array('Bpmc' => array('limit' =>20,'order' => array('id' => 'desc'),'conditions'=>array($condition,'Bpmc.status'=>'active','Bpmc.issue_resolved'=>'yes','Bpmc.updated'=>'1')));
		$this->Bpmc->recursive = 0;
		$this->set('anms', $this->Paginator->paginate());
//		$panchayats=$this->Panchayat->find('list');
//                $villages=$this->Village->find('list');
//                $wards=$this->Ward->find('list');
//		$blocks=$this->Block->find('list');	
//			$users = $this->User->find('list',array('fields'=>array('parent'),'conditions'=>array('status'=>'active')));
//			$builders=$this->Builder->find('list');
			$this->set(compact('panchayats','villages','wards','blocks'));
			
	}
/**
 * add method
 *
 * @return void
 */
	public function add() {




		if ($this->request->is('post')) {
			$this->Bpmc->create();
                   $data =  $this->request->data;
                   
                   
                        for($i=0;$i<count($this->request->data['Bpmc']['details_of_issues']);$i++){
                            
                            $res= implode(',', $register_member_type =  $this->request->data['Bpmc']['register_member_type']);
                            $district =  $this->request->data['Bpmc']['district'];
                            $block =  $this->request->data['Bpmc']['block'];
                            $meeting_date =  date('Y-m-d',strtotime($this->request->data['Bpmc']['meeting_date']));
                            $register_member =  $this->request->data['Bpmc']['register_member'];
                            $other_participated=  $this->request->data['Bpmc']['other_participated'];
                            $meeting_facilitated_by =  $this->request->data['Bpmc']['meeting_facilitated_by'];
                            $issue_shared_bpmc =  $this->request->data['Bpmc']['issue_shared_bpmc'];
                            $no_of_decision=  $this->request->data['Bpmc']['no_of_decision'];
                            $solved_issue=  $this->request->data['Bpmc']['solved_issue'];
                            
                            $details_of_issues =  $this->request->data['Bpmc']['details_of_issues'][$i];
                            $issue_category =  $this->request->data['Bpmc']['issue_category'][$i];
                            $issues_level =  $this->request->data['Bpmc']['issues_level'][$i];
                            $decisions_taken=  $this->request->data['Bpmc']['decisions_taken'][$i]; 
                            $decision_details=  $this->request->data['Bpmc']['decision_details'][$i]; 
                            $issue_resolved=  $this->request->data['Bpmc']['issue_resolved'][$i]; 
                            $resolved_date = date('Y-m-d',strtotime($this->request->data['Bpmc']['resolved_date'][$i]));
                            
                            $details_of_issues_resolved=  $this->request->data['Bpmc']['details_of_issues_resolved'][$i]; 
                            $letter_to_higher_authority=  $this->request->data['Bpmc']['letter_to_higher_authority'][$i];   
                            $remarks =  $this->request->data['Bpmc']['remarks'];
                          
                    $data=array (
                                'district'=>$district,
                                'block'=>$block,
                                'meeting_date'=>$meeting_date,
                                'register_member' =>$register_member,
                                'other_participated' =>$other_participated,
                                'register_member_type'=>$res,
                                'meeting_facilitated_by'=> $meeting_facilitated_by,
                                'issue_shared_bpmc'=>$issue_shared_bpmc,
                                'no_of_decision'=>$no_of_decision,
                                'solved_issue'=>$solved_issue,
                                'details_of_issues'=>$details_of_issues,
                                'decisions_taken'=>$decisions_taken,
                                'decision_details'=>$decision_details,
                                'issue_resolved'=>$issue_resolved,
                                'resolved_date'=>$resolved_date,
                                'details_of_issues_resolved'=>$details_of_issues_resolved,
                                'issues_level'=>$issues_level,
                                'issue_category'=>$issue_category,
                                'letter_to_higher_authority'=>$letter_to_higher_authority,
                                'updated'=>0,
                                'remarks'=>$remarks,
                               
                        
                                );  
                    
                           $save=$this->Bpmc->saveAll($data);
				
                         }///} } }   
                         
                             
                         if($save) {
                         $this->Session->setFlash(__('The BPMC Meeting has been saved.'));
				return $this->redirect(array('action' => 'index'));

                        } else {
				$this->Session->setFlash(__('The BPMC Meeting could not be saved. Please, try again.'));
			}
			
                    }   
                 if(CakeSession::read('User.type')==='regular'){
                     if(CakeSession::read('User.subrole')==='BPC'){ 
		   $r = $this->Bpc->find('first',array('conditions'=>array('Bpc.first_name='.CakeSession::read('User.id'))));
                       
                    $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id IN'=>explode(',',$r['Bpc']['allocated_block']))));
                     }
                     else {
                     $r = $this->Dpo->find('first',array('conditions'=>array('Dpo.first_name='.CakeSession::read('User.id'))));
                       
                    $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.city_id IN'=>explode(',',$r['Dpo']['district']))));
                         
                     }
                    
                     }
                else {
                    
                    $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc')));
                    
                }
		//$executives=$this->User->find('list',array('conditions'=>array('User.status'=>'active','User.role'=>'regular')));
		$cities=$this->City->find('list');
                $desig=$this->Designation->find('list');
		//$blocks=$this->Block->find('list');
		$reg=$this->RegisterMember->find('list');
                $panchayat=$this->Panchayat->find('list');
                $village=$this->Village->find('list');
                $ward=$this->Ward->find('list');
                $issue=$this->IssueCategory->find('list');
                $subissue=$this->IssueSubcategory->find('list');
                $facilitated=$this->MeetingFacilitated->find('list');
                
		$this->set(compact('panchayat','cities','reg','blocks','desig','village','facilitated','ward','issue','subissue'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Bpmc->exists($id)) {
			throw new NotFoundException(__('Invalid BPMC'));
		}
                
                
		if ($this->request->is(array('post', 'put'))) {
                     //$data =  $this->request->data;
                           $res= implode(',', $register_member_type =  $this->request->data['Bpmc']['register_member_type']);
                            $block =  $this->request->data['Bpmc']['block'];
                             $district =  $this->request->data['Bpmc']['district'];
                            $meeting_date =  date('Y-m-d',strtotime($this->request->data['Bpmc']['meeting_date']));
                            $register_member =  $this->request->data['Bpmc']['register_member'];
                            $other_participated=  $this->request->data['Bpmc']['other_participated'];
                            $meeting_facilitated_by =  $this->request->data['Bpmc']['meeting_facilitated_by'];
                           // $issue_shared_bpmc =  $this->request->data['Bpmc']['issue_shared_bpmc'];
                           $no_of_decision=  $this->request->data['Bpmc']['no_of_decision'];
                            $solved_issue=  $this->request->data['Bpmc']['solved_issue'];
                             
                            $details_of_issues =  $this->request->data['Bpmc']['details_of_issues'];
                            $issue_category =  $this->request->data['Bpmc']['issue_category'];
                            $issue_level =  $this->request->data['Bpmc']['issues_level'];
                            $decisions_taken=  $this->request->data['Bpmc']['decisions_taken']; 
                            $decision_details=  $this->request->data['Bpmc']['decision_details']; 
                            $issue_resolved=  $this->request->data['Bpmc']['issue_resolved']; 
                            $details_of_issues_resolved=  $this->request->data['Bpmc']['details_of_issues_resolved']; 
                            $resolved_date = date('Y-m-d',strtotime($this->request->data['Bpmc']['resolved_date']));
                            
                            $letter_to_higher_authority=  $this->request->data['Bpmc']['letter_to_higher_authority'];   
                            $remarks =  $this->request->data['Bpmc']['remarks'];
                          
                    $data=array (
                                'district'=>$district,
                                'block'=>$block,
                                'meeting_date'=>$meeting_date,
                                'register_member' =>$register_member,
                                'other_participated' =>$other_participated,
                                'register_member_type'=>$res,
                                'meeting_facilitated_by'=> $meeting_facilitated_by,
                                //'issue_shared_bpmc'=>$issue_shared_bpmc,
                                 'no_of_decision'=>$no_of_decision,
                                'solved_issue'=>$solved_issue,
                                 'details_of_issues'=>$details_of_issues,
                                'decisions_taken'=>$decisions_taken,
                                'decision_details'=>$decision_details,
                                'issue_resolved'=>$issue_resolved,
                                 'resolved_date'=>$resolved_date,
                                'details_of_issues_resolved'=>$details_of_issues_resolved,
                                'issues_level'=>$issue_level,
                                'issue_category'=>$issue_category,
                                'letter_to_higher_authority'=>$letter_to_higher_authority,
                                'updated'=>1,
                                'remarks'=>$remarks,
                                'id'=>$id
                               
                        
                                );  
                    
			if ($this->Bpmc->save($data)) {
				$this->Session->setFlash(__('The BPMC Meeting has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The BPMC could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Bpmc.' . $this->Bpmc->primaryKey => $id));
			$this->request->data = $this->Bpmc->find('first', $options);
			$executives=$this->User->find('list',array('conditions'=>array('User.status'=>'active','User.role'=>'regular')));
		}
                         if(CakeSession::read('User.type')==='regular'){
		         if(CakeSession::read('User.subrole')==='BPC'){ 
		   $r = $this->Bpc->find('first',array('conditions'=>array('Bpc.first_name='.CakeSession::read('User.id'))));
                       
                    $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id IN'=>explode(',',$r['Bpc']['allocated_block']))));
                     }
                     else {
                     $r = $this->Dpo->find('first',array('conditions'=>array('Dpo.first_name='.CakeSession::read('User.id'))));
                       
                    $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.city_id IN'=>explode(',',$r['Dpo']['district']))));
                         
                     }  }
                        else {
                   
                    $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc')));
                    }
		$cities=$this->City->find('list');
                $desig=$this->Designation->find('list');
		//$blocks=$this->Block->find('list');
		$reg=$this->RegisterMember->find('list');
                $panchayat=$this->Panchayat->find('list');
                $village=$this->Village->find('list');
                $ward=$this->Ward->find('list');
                $issue=$this->IssueCategory->find('list');
                $subissue=$this->IssueSubcategory->find('list');
                $facilitated=$this->MeetingFacilitated->find('list');
                
		$this->set(compact('panchayat','cities','reg','blocks','desig','village','facilitated','ward','issue','subissue'));
	
	}
	
	
	
	

	
	public function delete($id = null,$status='deactive') {
		$this->Bpmc->id = $id;
		if (!$this->Bpmc->exists()) {
			throw new NotFoundException(__('Invalid Vhsnc/Afc Detail'));
		}
		    //$this->request->onlyAllow('post', 'delete');
		    $this->Bpmc->read(null,$id);
			$this->Bpmc->set(array('status'=>$status));
		
		if ($this->Bpmc->save()) {
			$this->Session->setFlash(__('The BPMC Meeting has been '.$status));
		} else {
			$this->Session->setFlash(__('Nothing happen. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	
	public function getvhsnc() {
	    $this->layout='ajax';
        $this->autoRender = false;
	    $data='<option value="">Select VHSNC</option>';
		$subcatlist=$this->VhsncAfc->find('list',array('conditions'=>array('VhsncAfc.member_type'=>'VHSNC')));
		foreach($subcatlist as $key=>$value){ $data.='<option value="'.$key.'">'.$value.'</option>';}
		return $data;
	}
        public function getmobile($id) {
	    $this->layout='ajax';
        $this->autoRender = false;
	    
		$subcatlist=$this->VhsncAfc->find('all',array('conditions'=>array('VhsncAfc.id'=>$id)));
		foreach($subcatlist as $key=>$value){ $data =$value['VhsncAfc']['mobile'];
               // die();
                }
		return $data;
	}
        
        
     //// report export section start------------//////     
 
        public function export(){
            $data='';$searchKey=null;$searchUserId=null;$searchCountryId=null;$searchBuilderId=null;$searchProjectId=null;
		$searchStatus=null;$pages=null;$condition='';$querySrting=''; $condition=array();$condition2='';
		$conc='';
		//$username=$this->User->findById(CakeSession::read('User.id'));
		if(isset($this->params->query['confirm'])) {
	   
		if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    //$condition['OR']=array('Geographical.id LIKE'=>'%'.$searchKey.'%','Geographical.ward LIKE'=>'%'.$searchKey.'%','Geographical.awc_code LIKE'=>'%'.$searchKey.'%','Geographical.awc_worker LIKE '=>'%'.$searchKey.'%','Geographical.asha_name LIKE '=>'%'.$searchKey.'%'); 
	$condition2.=' and Bpmc.id LIKE %'.$searchKey.'% || Bpmc.decisions_taken LIKE %'.$searchKey.'% Bpmc.issue_resolved LIKE %'.$searchKey.'% || Bpmc.details_of_issues LIKE %'.$searchKey.'%';
	
	
	}
	
	
	
	if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(Bpmc.meeting_date)>="'.$fromdate.'" and date(Bpmc.meeting_date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(Bpmc.meeting_date)="'.$fromdate.'"';
				}
				else
				{
					
					}
			}
			
			
  
//		if(isset($this->request->query['organization']) and ($this->request->query['organization']!=0) and ($this->request->query['organization']!='')){$searchBuilderId=trim($this->request->query['organization']);  //$condition['Enquiry.country_id']=$searchCountryId;
//		$condition2.=' and VhsncMeeting.organization='.$searchBuilderId;
//		
//		}
//		
		if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBlockId=trim($this->request->query['block']); //$condition['Enquiry.builder_id']=$searchBuilderId;
		$condition2.=' and Bpmc.block='.$searchBlockId;
		}
		
		//if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchProjectId=trim($this->request->query['panchayat']); //$condition['Enquiry.project_id']=$searchProjectId;
//		$condition2.=' and SocialAudit.panchayat='.$searchProjectId;
//		}
//               
//                if(isset($this->request->query['village']) and ($this->request->query['village']!=0) and ($this->request->query['village']!='')){$searchVillageId=trim($this->request->query['village']); //$condition['Enquiry.project_id']=$searchProjectId;
//		$condition2.=' and SocialAudit.village='.$searchVillageId;
//		}
		
		
		
		}
		else {
		if(CakeSession::read('User.type')==='regular'){
             //echo CakeSession::read('User.subrole');
            // die();
             if(CakeSession::read('User.subrole')==='CC'){
		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'))));
                      if($r){ 
                          if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){
                           $searchProjectId=trim($this->request->query['panchayat']);
		          //  $condition['VhsncAfc.panchayat']=$searchProjectId;
                             $condition2.=' and Bpmc.block='.$searchProjectId;
		           }   else { 
                        ///$condition=['VhsncAfc.panchayat IN' =>explode(',',$r['Bpccc']['allocated_panchayat'])]; 
                         $condition2.=' and Bpmc.block IN ('.$r['Bpccc']['allocated_block'].')';
                      }
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    //$condition['OR']=array('Geographical.id LIKE'=>'%'.$searchKey.'%','Geographical.ward LIKE'=>'%'.$searchKey.'%','Geographical.awc_code LIKE'=>'%'.$searchKey.'%','Geographical.awc_worker LIKE '=>'%'.$searchKey.'%','Geographical.asha_name LIKE '=>'%'.$searchKey.'%'); 
	$condition2.=' and Bpmc.id LIKE %'.$searchKey.'% || Bpmc.decisions_taken LIKE %'.$searchKey.'% Bpmc.issue_resolved LIKE %'.$searchKey.'% || Bpmc.details_of_issues LIKE %'.$searchKey.'%';
	
	
	}
                      if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(Bpmc.meeting_date)>="'.$fromdate.'" and date(Bpmc.meeting_date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(Bpmc.meeting_date)="'.$fromdate.'"';
				}
				else
				{
					
					}
                      }
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Village yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
	            //$blocks=$this->Block->find('list',array('conditions'=>array('Block.id'=>$r['Bpccc']['allocated_block'])));
                    $panchayats=$this->Panchayat->find('list',array('order' => array('name' => 'asc'),'conditions'=>['Panchayat.id IN'=>explode(',',$r['Bpccc']['allocated_panchayat'])]));
                   	
		}
                
                 elseif(CakeSession::read('User.subrole')==='BPC'){
		   $r = $this->Bpc->find('first',array('conditions'=>array('Bpc.first_name='.CakeSession::read('User.id'))));
                      if($r){ 
                          if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){
                              $searchBlockId=trim($this->request->query['block']);
		        $condition2.=' and Bpmc.block='.$searchBlockId;
		        }else {
                           
                       $condition2.=' and Bpmc.block IN ('.$r['Bpc']['allocated_block'].')';
                       
                      }
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    //$condition['OR']=array('Geographical.id LIKE'=>'%'.$searchKey.'%','Geographical.ward LIKE'=>'%'.$searchKey.'%','Geographical.awc_code LIKE'=>'%'.$searchKey.'%','Geographical.awc_worker LIKE '=>'%'.$searchKey.'%','Geographical.asha_name LIKE '=>'%'.$searchKey.'%'); 
	$condition2.=' and Bpmc.id LIKE %'.$searchKey.'% || Bpmc.decisions_taken LIKE %'.$searchKey.'% Bpmc.issue_resolved LIKE %'.$searchKey.'% || Bpmc.details_of_issues LIKE %'.$searchKey.'%';
	
	
	}
                       if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(Bpmc.meeting_date)>="'.$fromdate.'" and date(Bpmc.meeting_date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(Bpmc.meeting_date)="'.$fromdate.'"';
				}
				else
				{
					
					}
                      }
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Block yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
		     //$blocks=$this->Block->find('list',array('order' => array('name' => 'asc'),'conditions'=>array('Block.id IN'=>explode(',',$r['Bpc']['allocated_block']))));
                   //$villages=$this->Village->find('list');
                   //$panchayats=$this->Panchayat->find('list');
                    //$condition2['OR']=array('Ngo.allocated_block_one'=>explode(',',$r['Bpc']['allocated_block']),'Ngo.allocated_block_two'=>explode(',',$r['Bpc']['allocated_block'])); 
                    //$ngos=$this->Ngo->find('list',array('conditions'=>$condition2));
                    
		}
                
                
                 else {
		   $r = $this->Dpo->find('first',array('conditions'=>array('Dpo.first_name='.CakeSession::read('User.id'))));
                      if($r){ 
                          
                          if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){
                              $searchBlockId=trim($this->request->query['block']);
                               $condition2.=' and Bpmc.block='.$searchBlockId;
		        // $condition['VhsncAfc.block']=$searchBlockId;
		        }else {
                       //$condition='VhsncAfc.district='.$r['Dpo']['district'];
                        $condition2.=' and Bpmc.district IN ('.$r['Dpo']['district'].')';
                        }
                        if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    //$condition['OR']=array('Geographical.id LIKE'=>'%'.$searchKey.'%','Geographical.ward LIKE'=>'%'.$searchKey.'%','Geographical.awc_code LIKE'=>'%'.$searchKey.'%','Geographical.awc_worker LIKE '=>'%'.$searchKey.'%','Geographical.asha_name LIKE '=>'%'.$searchKey.'%'); 
	$condition2.=' and Bpmc.id LIKE %'.$searchKey.'% || Bpmc.decisions_taken LIKE %'.$searchKey.'% Bpmc.issue_resolved LIKE %'.$searchKey.'% || Bpmc.details_of_issues LIKE %'.$searchKey.'%';
	
	
	}
                        if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(Bpmc.meeting_date)>="'.$fromdate.'" and date(Bpmc.meeting_date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(Bpmc.meeting_date)="'.$fromdate.'"';
				}
				else
				{
					
					}
                      } 
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Village yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
			//$blocks=$this->Block->find('list',array('order' => array('name' => 'asc'),'conditions'=>array('Block.city_id IN'=>explode(',',$r['Dpo']['district']))));
                     //$ngos=$this->Ngo->find('list',array('conditions'=>array('Ngo.allocated_district IN'=>explode(',',$r['Dpo']['district']))));
                     
		}
         }
		else {
		
		}
		}
		//$condition['NOT']=array('Enquiry.status'=>"trash");
		$condition2.=' and Bpmc.status="active"';
		$this->response->download("Bpmc.csv");
		//print_r($condition); exit;
	    $data=$this->Bpmc->query('select Bpmc.id,Bpmc.meeting_date,Bpmc.register_member,Issuecategory.name,Issuesubcat.name,Bpmc.other_participated,Resitermember.name,Meetingfacilitated.name,Bpmc.issue_shared_bpmc,Bpmc.details_of_issues,Bpmc.decisions_taken,City.name,Block.name,Bpmc.decision_details,Bpmc.issue_resolved,Bpmc.details_of_issues_resolved,Bpmc.letter_to_higher_authority,Bpmc.status from bpmcs as Bpmc left join cities as City  on Bpmc.district=City.id left join blocks as Block  on Bpmc.block=Block.id left join issue_category as Issuecategory on Bpmc.issue_category=Issuecategory.id left join issue_subcategory as Issuesubcat on Bpmc.issues_level=Issuesubcat.id left join meeting_facilitateds as Meetingfacilitated on Bpmc.meeting_facilitated_by=Meetingfacilitated.id left join register_members as Resitermember on Bpmc.register_member_type=Resitermember.id  where 1 '.$condition2 );
		
		
		//$data = $this->Geographical->find('all', array('conditions'=>$condition2));
		
		//$log = $this->Enquiry->getDataSource()->getLog(false, false);
        //debug($log);
		//exit;
		
            $headers = array('Bpmc'=>array( 'Id' => 'Id','District' => 'District', 'Block' => 'Block','Date of Meeting'=>'Date of Meeting','BPMC Registered Member Participated' => 'BPMC Registered Member Participated','Other Participated'=>'Other Participated','Type of Registered Member Participated'=>'Type of Registered Member Participated ','Meeting chaired by'=>'Meeting chaired by','Issues Shared in BPMC'=>'Issues Shared in BPMC','Details of Issues'=>'Details of Issues','Issue Category'=>'Issue Category','Issue Level'=>'Issue Level','Decisions Taken'=>'Decisions Taken','Decision Details'=>'Decision Details','Issue Resolved'=>'Issue Resolved','Describe Resolved Issue'=>'Describe Resolved Issue','No. of issues forwarded to higher authority'=>'No. of issues forwarded to higher authority','Status'=>'Status')); 
	    $this->set(compact('data','headers'));
		$this->layout = 'ajax';
		return;
		
		}
  ////  reports section ---/////      
	
	}
	
	
	
	
