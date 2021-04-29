<?php
App::uses('AppController', 'Controller');
/**
 * Ngos Controller
 *
 * @property Ngo $GeographicalNgo
 * @property PaginatorComponent $Paginator
 */
class SocialAuditsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Upload');

    var  $uses = array('SocialAudit','Geographical','Ngo','User','RegisterMember','Village','Panchayat','MeetingFacilitated','Country','City','Block','Designation','Ward','IssueCategory','IssueSubcategory','Bpccc','Bpc','Dpo');
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
    $condition['OR']=array('SocialAudit.id LIKE'=>'%'.$searchKey.'%','SocialAudit.details_of_issues LIKE'=>'%'.$searchKey.'%','SocialAudit.decisions_taken LIKE'=>'%'.$searchKey.'%','SocialAudit.decisions_details LIKE '=>'%'.$searchKey.'%','SocialAudit.action_taken LIKE '=>'%'.$searchKey.'%'); 
	
	}
		
		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(SocialAudit.meeting_date) >='=>$fromdate,'date(SocialAudit.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['SocialAudit.meeting_date']=$fromdate;	
				}
				
			}
		
		if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBuilderId=trim($this->request->query['block']); 
		$condition['SocialAudit.block']=$searchBuilderId;
		}
//		
//		if(isset($this->request->query['village']) and ($this->request->query['village']!=0) and ($this->request->query['village']!='')){$searchProjectId=trim($this->request->query['village']);
//		$condition['SocialAudit.village']=$searchProjectId;
//		}
//                if(isset($this->request->query['ward']) and ($this->request->query['ward']!=0) and ($this->request->query['ward']!='')){$searchProjectId=trim($this->request->query['ward']);
//		$condition['SocialAudit.ward']=$searchProjectId;
//		}
		
		
		
	}
		
        if(CakeSession::read('User.type')==='regular'){
		   if(CakeSession::read('User.subrole')==='CC'){
		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'))));
                      if($r){ 
                          if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBuilderId=trim($this->request->query['block']); 
		        $condition['SocialAudit.block']=$searchBuilderId;
		         }
                         else {
		
                        // $condition= 'FIND_IN_SET(\''. $r['Bpccc']['allocated_panchayat'].'\',VhsncConstitution.panchayat)'; 
                      // $condition='VhsncConstitution.panchayat='.$r['Bpccc']['allocated_panchayat'];
                         $condition=['SocialAudit.block IN' =>explode(',',$r['Bpccc']['allocated_block'])]; 
                         }
                         if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('SocialAudit.id LIKE'=>'%'.$searchKey.'%','SocialAudit.details_of_issues LIKE'=>'%'.$searchKey.'%','SocialAudit.decisions_taken LIKE'=>'%'.$searchKey.'%','SocialAudit.decisions_details LIKE '=>'%'.$searchKey.'%','SocialAudit.action_taken LIKE '=>'%'.$searchKey.'%'); 
	
	}
                         if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(SocialAudit.meeting_date) >='=>$fromdate,'date(SocialAudit.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['SocialAudit.meeting_date']=$fromdate;	
				}
				
			}
                      } 
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Village yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
			//$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
		     $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id'=>$r['Bpccc']['allocated_block'])));
                   		
		}
                
                 elseif(CakeSession::read('User.subrole')==='BPC') {
		   $r = $this->Bpc->find('first',array('conditions'=>array('Bpc.first_name='.CakeSession::read('User.id'))));
                      if($r){ 
                          if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBuilderId=trim($this->request->query['block']); 
		         $condition['SocialAudit.block']=$searchBuilderId;
		               }
		      else {
                      // $condition='VhsncConstitution.block='.$r['Bpc']['allocated_block'];
                        $condition=['SocialAudit.block IN' =>explode(',',$r['Bpc']['allocated_block'])];
                      }
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('SocialAudit.id LIKE'=>'%'.$searchKey.'%','SocialAudit.details_of_issues LIKE'=>'%'.$searchKey.'%','SocialAudit.decisions_taken LIKE'=>'%'.$searchKey.'%','SocialAudit.decisions_details LIKE '=>'%'.$searchKey.'%','SocialAudit.action_taken LIKE '=>'%'.$searchKey.'%'); 
	
	}
                      if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(SocialAudit.meeting_date) >='=>$fromdate,'date(SocialAudit.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['SocialAudit.meeting_date']=$fromdate;	
				}
				
			}
                      } 
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Block yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
			//$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
	            $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id IN'=>explode(',',$r['Bpc']['allocated_block']))));
                   	
		}
                
                
                else {
		   $r = $this->Dpo->find('first',array('conditions'=>array('Dpo.first_name='.CakeSession::read('User.id'))));
                      if($r){
                          
                          if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBuilderId=trim($this->request->query['block']); 
		         $condition['SocialAudit.block']=$searchBuilderId;
		               }
		      else {
                         $condition=['SocialAudit.district IN' =>explode(',',$r['Dpo']['district'])];
                      }
                      
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('SocialAudit.id LIKE'=>'%'.$searchKey.'%','SocialAudit.details_of_issues LIKE'=>'%'.$searchKey.'%','SocialAudit.decisions_taken LIKE'=>'%'.$searchKey.'%','SocialAudit.decisions_details LIKE '=>'%'.$searchKey.'%','SocialAudit.action_taken LIKE '=>'%'.$searchKey.'%'); 
	
	}
                      if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(SocialAudit.meeting_date) >='=>$fromdate,'date(SocialAudit.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['SocialAudit.meeting_date']=$fromdate;	
				}
				
			}
                      } 
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Block yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
			//$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
	            $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.city_id IN'=>explode(',',$r['Dpo']['district']))));
                   	
		}
			
		}else if(CakeSession::read('User.type')==='user'){
	   $r = $this->Ngo->find('first',array('conditions'=>array('Ngo.chief_functionary_name='.CakeSession::read('User.id'))));
                 if($r){
                     $blo=array();
                   $blo= [$r['Ngo']['allocated_block_one'],$r['Ngo']['allocated_block_two']];
                     if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){
                              $searchBlockId=trim($this->request->query['block']);
		         $condition['SocialAudit.block']=$searchBlockId;
		        }else {
                            
                       $condition=['SocialAudit.block IN' =>$blo];
                       
                      }
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('SocialAudit.id LIKE'=>'%'.$searchKey.'%','SocialAudit.details_of_issues LIKE'=>'%'.$searchKey.'%','SocialAudit.decisions_taken LIKE'=>'%'.$searchKey.'%','SocialAudit.decisions_details LIKE '=>'%'.$searchKey.'%','SocialAudit.action_taken LIKE '=>'%'.$searchKey.'%'); 
	
	}
                      if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(SocialAudit.meeting_date) >='=>$fromdate,'date(SocialAudit.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['SocialAudit.meeting_date']=$fromdate;	
				}
				
			}
		}
                 $blocks=$this->Block->find('list',array('order' => array('name' => 'asc'),'conditions'=>array('Block.id IN'=>$blo)));
                 $ngos=$this->Ngo->find('list',array('conditions'=>array('Ngo.id'=>$r['Ngo']['id'])));
                     
         }
                else {
                  $blocks=$this->Block->find('list');  
                }
        
		$this->Paginator->settings = array('SocialAudit' => array('limit' =>20,'group'=>array('SocialAudit.meeting_date','SocialAudit.block'),'order' => array('id' => 'desc'),'conditions'=>array($condition,'SocialAudit.status'=>'active')));
		$this->SocialAudit->recursive = 0;
		$this->set('anms', $this->Paginator->paginate());
		//$panchayats=$this->Panchayat->find('list');
                //$villages=$this->Village->find('list');
                //$wards=$this->Ward->find('list');
			
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
		if (!$this->SocialAudit->exists($id)) {
			throw new NotFoundException(__('Invalid VHSNC Meeting'));
		}
		$options = array('conditions' => array('SocialAudit.' . $this->SocialAudit->primaryKey => $id));
		$this->set('anm', $this->SocialAudit->find('first', $options));
		$this->layout='newdefault';
	}
	
	
	public function viewissue($id = null,$date=null) {
            $r= explode(',',$id);
//		if (!$this->SocialAudit->exists($id)) {
//			throw new NotFoundException(__('Invalid VHSNC Meeting'));
//		}
		$options = array('conditions' => array('SocialAudit.block' => $r['0'],'SocialAudit.meeting_date' => $r['1']));
		$this->set('anms', $this->SocialAudit->find('all', $options));
		$this->layout='newdefault';
	}
        
        
        public function viewpendingissue() {
		
		$data='';$searchKey=null;$searchUserId=null;$searchBuilderId=null;$searchProjectId=null;$fromdate=null;$todate=null;
		$condition='';$querySrting=''; $condition=array();
		$conc='';
		
		if(isset($this->params->query['confirm'])) {
	   
		if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('SocialAudit.id LIKE'=>'%'.$searchKey.'%','SocialAudit.details_of_issues LIKE'=>'%'.$searchKey.'%','SocialAudit.decisions_taken LIKE'=>'%'.$searchKey.'%','SocialAudit.decisions_details LIKE '=>'%'.$searchKey.'%','SocialAudit.action_taken LIKE '=>'%'.$searchKey.'%'); 
	
	}
		
		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(SocialAudit.meeting_date) >='=>$fromdate,'date(SocialAudit.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['SocialAudit.meeting_date']=$fromdate;	
				}
				
			}
		
		if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBuilderId=trim($this->request->query['block']); 
		$condition['SocialAudit.block']=$searchBuilderId;
		}
//		
//		if(isset($this->request->query['village']) and ($this->request->query['village']!=0) and ($this->request->query['village']!='')){$searchProjectId=trim($this->request->query['village']);
//		$condition['SocialAudit.village']=$searchProjectId;
//		}
//                if(isset($this->request->query['ward']) and ($this->request->query['ward']!=0) and ($this->request->query['ward']!='')){$searchProjectId=trim($this->request->query['ward']);
//		$condition['SocialAudit.ward']=$searchProjectId;
//		}
		
		
		
	}
		
        if(CakeSession::read('User.type')==='regular'){
		   if(CakeSession::read('User.subrole')==='CC'){
		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'))));
                      if($r){ 
                          if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBuilderId=trim($this->request->query['block']); 
		        $condition['SocialAudit.block']=$searchBuilderId;
		         }
                         else {
		
                        // $condition= 'FIND_IN_SET(\''. $r['Bpccc']['allocated_panchayat'].'\',VhsncConstitution.panchayat)'; 
                      // $condition='VhsncConstitution.panchayat='.$r['Bpccc']['allocated_panchayat'];
                         $condition=['SocialAudit.block IN' =>explode(',',$r['Bpccc']['allocated_block'])]; 
                         }
                         
                         if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('SocialAudit.id LIKE'=>'%'.$searchKey.'%','SocialAudit.details_of_issues LIKE'=>'%'.$searchKey.'%','SocialAudit.decisions_taken LIKE'=>'%'.$searchKey.'%','SocialAudit.decisions_details LIKE '=>'%'.$searchKey.'%','SocialAudit.action_taken LIKE '=>'%'.$searchKey.'%'); 
	
	}
		
                         if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(SocialAudit.meeting_date) >='=>$fromdate,'date(SocialAudit.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['SocialAudit.meeting_date']=$fromdate;	
				}
				
			}
                      } 
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Village yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
			//$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
		     $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id'=>$r['Bpccc']['allocated_block'])));
                   		
		}
                
                 elseif(CakeSession::read('User.subrole')==='BPC') {
		   $r = $this->Bpc->find('first',array('conditions'=>array('Bpc.first_name='.CakeSession::read('User.id'))));
                      if($r){ 
                          if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBuilderId=trim($this->request->query['block']); 
		         $condition['SocialAudit.block']=$searchBuilderId;
		               }
		      else {
                      // $condition='VhsncConstitution.block='.$r['Bpc']['allocated_block'];
                        $condition=['SocialAudit.block IN' =>explode(',',$r['Bpc']['allocated_block'])];
                      }
                      
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('SocialAudit.id LIKE'=>'%'.$searchKey.'%','SocialAudit.details_of_issues LIKE'=>'%'.$searchKey.'%','SocialAudit.decisions_taken LIKE'=>'%'.$searchKey.'%','SocialAudit.decisions_details LIKE '=>'%'.$searchKey.'%','SocialAudit.action_taken LIKE '=>'%'.$searchKey.'%'); 
	
	}
		
                      if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(SocialAudit.meeting_date) >='=>$fromdate,'date(SocialAudit.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['SocialAudit.meeting_date']=$fromdate;	
				}
				
			}
                      } 
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Block yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
			//$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
	            $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id IN'=>explode(',',$r['Bpc']['allocated_block']))));
                   	
		}
                
                
                else {
		   $r = $this->Dpo->find('first',array('conditions'=>array('Dpo.first_name='.CakeSession::read('User.id'))));
                      if($r){
                          
                          if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBuilderId=trim($this->request->query['block']); 
		         $condition['SocialAudit.block']=$searchBuilderId;
		               }
		      else {
                         $condition=['SocialAudit.district IN' =>explode(',',$r['Dpo']['district'])];
                      }
                      
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('SocialAudit.id LIKE'=>'%'.$searchKey.'%','SocialAudit.details_of_issues LIKE'=>'%'.$searchKey.'%','SocialAudit.decisions_taken LIKE'=>'%'.$searchKey.'%','SocialAudit.decisions_details LIKE '=>'%'.$searchKey.'%','SocialAudit.action_taken LIKE '=>'%'.$searchKey.'%'); 
	
	}
		
                      if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(SocialAudit.meeting_date) >='=>$fromdate,'date(SocialAudit.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['SocialAudit.meeting_date']=$fromdate;	
				}
				
			}
                      } 
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Block yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
			//$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
	            $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.city_id IN'=>explode(',',$r['Dpo']['district']))));
                   	
		}
			
		}
                else if(CakeSession::read('User.type')==='user'){
	   $r = $this->Ngo->find('first',array('conditions'=>array('Ngo.chief_functionary_name='.CakeSession::read('User.id'))));
                 if($r){
                     $blo=array();
                   $blo= [$r['Ngo']['allocated_block_one'],$r['Ngo']['allocated_block_two']];
                     if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){
                              $searchBlockId=trim($this->request->query['block']);
		         $condition['SocialAudit.block']=$searchBlockId;
		        }else {
                            
                       $condition=['SocialAudit.block IN' =>$blo];
                       
                      }
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('SocialAudit.id LIKE'=>'%'.$searchKey.'%','SocialAudit.details_of_issues LIKE'=>'%'.$searchKey.'%','SocialAudit.decisions_taken LIKE'=>'%'.$searchKey.'%','SocialAudit.decisions_details LIKE '=>'%'.$searchKey.'%','SocialAudit.action_taken LIKE '=>'%'.$searchKey.'%'); 
	
	}
		
                      if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(SocialAudit.meeting_date) >='=>$fromdate,'date(SocialAudit.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['SocialAudit.meeting_date']=$fromdate;	
				}
				
			}
		}
                 $blocks=$this->Block->find('list',array('order' => array('name' => 'asc'),'conditions'=>array('Block.id IN'=>$blo)));
                 $ngos=$this->Ngo->find('list',array('conditions'=>array('Ngo.id'=>$r['Ngo']['id'])));
                     
         }
                else {
                  $blocks=$this->Block->find('list');  
                }
        
		$this->Paginator->settings = array('SocialAudit' => array('limit' =>20,'group'=>array('SocialAudit.meeting_date','SocialAudit.block'),'order' => array('id' => 'desc'),'conditions'=>array($condition,'SocialAudit.status'=>'active','SocialAudit.updated'=>'0')));
		$this->SocialAudit->recursive = 0;
		$this->set('anms', $this->Paginator->paginate());
		//$panchayats=$this->Panchayat->find('list');
                //$villages=$this->Village->find('list');
                //$wards=$this->Ward->find('list');
			
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
    $condition['OR']=array('SocialAudit.id LIKE'=>'%'.$searchKey.'%','SocialAudit.details_of_issues LIKE'=>'%'.$searchKey.'%','SocialAudit.decisions_taken LIKE'=>'%'.$searchKey.'%','SocialAudit.decisions_details LIKE '=>'%'.$searchKey.'%','SocialAudit.action_taken LIKE '=>'%'.$searchKey.'%'); 
	
	}
		
		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(SocialAudit.meeting_date) >='=>$fromdate,'date(SocialAudit.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['SocialAudit.meeting_date']=$fromdate;	
				}
				
			}
		
		if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBuilderId=trim($this->request->query['block']); 
		$condition['SocialAudit.block']=$searchBuilderId;
		}
//		
//		if(isset($this->request->query['village']) and ($this->request->query['village']!=0) and ($this->request->query['village']!='')){$searchProjectId=trim($this->request->query['village']);
//		$condition['SocialAudit.village']=$searchProjectId;
//		}
//                if(isset($this->request->query['ward']) and ($this->request->query['ward']!=0) and ($this->request->query['ward']!='')){$searchProjectId=trim($this->request->query['ward']);
//		$condition['SocialAudit.ward']=$searchProjectId;
//		}
		
		
		
	}
		
        if(CakeSession::read('User.type')==='regular'){
		   if(CakeSession::read('User.subrole')==='CC'){
		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'))));
                      if($r){ 
                          if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBuilderId=trim($this->request->query['block']); 
		        $condition['SocialAudit.block']=$searchBuilderId;
		         }
                         else {
		
                        // $condition= 'FIND_IN_SET(\''. $r['Bpccc']['allocated_panchayat'].'\',VhsncConstitution.panchayat)'; 
                      // $condition='VhsncConstitution.panchayat='.$r['Bpccc']['allocated_panchayat'];
                         $condition=['SocialAudit.block IN' =>explode(',',$r['Bpccc']['allocated_block'])]; 
                         }
                         if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('SocialAudit.id LIKE'=>'%'.$searchKey.'%','SocialAudit.details_of_issues LIKE'=>'%'.$searchKey.'%','SocialAudit.decisions_taken LIKE'=>'%'.$searchKey.'%','SocialAudit.decisions_details LIKE '=>'%'.$searchKey.'%','SocialAudit.action_taken LIKE '=>'%'.$searchKey.'%'); 
	
	}
		
                         if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(SocialAudit.meeting_date) >='=>$fromdate,'date(SocialAudit.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['SocialAudit.meeting_date']=$fromdate;	
				}
				
			}
                      } 
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Village yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
			//$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
		     $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id'=>$r['Bpccc']['allocated_block'])));
                   		
		}
                
                 elseif(CakeSession::read('User.subrole')==='BPC') {
		   $r = $this->Bpc->find('first',array('conditions'=>array('Bpc.first_name='.CakeSession::read('User.id'))));
                      if($r){ 
                          if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBuilderId=trim($this->request->query['block']); 
		         $condition['SocialAudit.block']=$searchBuilderId;
		               }
		      else {
                      // $condition='VhsncConstitution.block='.$r['Bpc']['allocated_block'];
                        $condition=['SocialAudit.block IN' =>explode(',',$r['Bpc']['allocated_block'])];
                      }
                      
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('SocialAudit.id LIKE'=>'%'.$searchKey.'%','SocialAudit.details_of_issues LIKE'=>'%'.$searchKey.'%','SocialAudit.decisions_taken LIKE'=>'%'.$searchKey.'%','SocialAudit.decisions_details LIKE '=>'%'.$searchKey.'%','SocialAudit.action_taken LIKE '=>'%'.$searchKey.'%'); 
	
	}
		
                      if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(SocialAudit.meeting_date) >='=>$fromdate,'date(SocialAudit.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['SocialAudit.meeting_date']=$fromdate;	
				}
				
			}
                      } 
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Block yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
			//$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
	            $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id IN'=>explode(',',$r['Bpc']['allocated_block']))));
                   	
		}
                
                
                else {
		   $r = $this->Dpo->find('first',array('conditions'=>array('Dpo.first_name='.CakeSession::read('User.id'))));
                      if($r){
                          
                          if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBuilderId=trim($this->request->query['block']); 
		         $condition['SocialAudit.block']=$searchBuilderId;
		               }
		      else {
                         $condition=['SocialAudit.district IN' =>explode(',',$r['Dpo']['district'])];
                      }
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('SocialAudit.id LIKE'=>'%'.$searchKey.'%','SocialAudit.details_of_issues LIKE'=>'%'.$searchKey.'%','SocialAudit.decisions_taken LIKE'=>'%'.$searchKey.'%','SocialAudit.decisions_details LIKE '=>'%'.$searchKey.'%','SocialAudit.action_taken LIKE '=>'%'.$searchKey.'%'); 
	
	}
		
                      if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(SocialAudit.meeting_date) >='=>$fromdate,'date(SocialAudit.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['SocialAudit.meeting_date']=$fromdate;	
				}
				
			}
                      } 
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Block yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
			//$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
	            $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.city_id IN'=>explode(',',$r['Dpo']['district']))));
                   	
		}
			
		}
                else if(CakeSession::read('User.type')==='user'){
	   $r = $this->Ngo->find('first',array('conditions'=>array('Ngo.chief_functionary_name='.CakeSession::read('User.id'))));
                 if($r){
                     $blo=array();
                   $blo= [$r['Ngo']['allocated_block_one'],$r['Ngo']['allocated_block_two']];
                     if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){
                              $searchBlockId=trim($this->request->query['block']);
		         $condition['SocialAudit.block']=$searchBlockId;
		        }else {
                            
                       $condition=['SocialAudit.block IN' =>$blo];
                       
                      } 
                      
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('SocialAudit.id LIKE'=>'%'.$searchKey.'%','SocialAudit.details_of_issues LIKE'=>'%'.$searchKey.'%','SocialAudit.decisions_taken LIKE'=>'%'.$searchKey.'%','SocialAudit.decisions_details LIKE '=>'%'.$searchKey.'%','SocialAudit.action_taken LIKE '=>'%'.$searchKey.'%'); 
	
	}
		
                      if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(SocialAudit.meeting_date) >='=>$fromdate,'date(SocialAudit.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['SocialAudit.meeting_date']=$fromdate;	
				}
				
			}
		}
                 $blocks=$this->Block->find('list',array('order' => array('name' => 'asc'),'conditions'=>array('Block.id IN'=>$blo)));
                 $ngos=$this->Ngo->find('list',array('conditions'=>array('Ngo.id'=>$r['Ngo']['id'])));
                     
         }
                else {
                  $blocks=$this->Block->find('list');  
                }
        
		$this->Paginator->settings = array('SocialAudit' => array('limit' =>20,'group'=>array('SocialAudit.meeting_date','SocialAudit.block'),'order' => array('id' => 'desc'),'conditions'=>array($condition,'SocialAudit.status'=>'active','SocialAudit.issue_resolved'=>'yes','SocialAudit.issue_resolved'=>'1')));
		$this->SocialAudit->recursive = 0;
		$this->set('anms', $this->Paginator->paginate());
		//$panchayats=$this->Panchayat->find('list');
                //$villages=$this->Village->find('list');
                //$wards=$this->Ward->find('list');
			
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
			$this->SocialAudit->create();
                  // $data =  $this->request->data;
                   
                        for($i=0;$i<count($this->request->data['SocialAudit']['issue_category']);$i++){
                            
                          
                            $district =  $this->request->data['SocialAudit']['district'];
                            $block =  $this->request->data['SocialAudit']['block'];
                            $meeting_date =  date('Y-m-d',strtotime($this->request->data['SocialAudit']['meeting_date']));
                            $participants =  $this->request->data['SocialAudit']['participants']; 
                            $panellist=  $this->request->data['SocialAudit']['panellist']; 
                            $case_study_shared =  $this->request->data['SocialAudit']['case_study_shared']; 
                            $testimonial_shared =  $this->request->data['SocialAudit']['testimonial_shared']; 
                            $issue_shared_jansamwad =  $this->request->data['SocialAudit']['issue_shared_jansamwad']; 
                            $no_of_decision =  $this->request->data['SocialAudit']['no_of_decision']; 
                            $solved_issue =  $this->request->data['SocialAudit']['solved_issue']; 
                            $issue_shared_pri =  $this->request->data['SocialAudit']['issue_shared_pri'][$i];  
                            $issue_category =  $this->request->data['SocialAudit']['issue_category'][$i];
                            $issue_level =  $this->request->data['SocialAudit']['issue_level'][$i];
                            $details_of_issues =  $this->request->data['SocialAudit']['details_of_issues'][$i];
                            $decisions_taken =  $this->request->data['SocialAudit']['decisions_taken'][$i];
                            $decisions_details =  $this->request->data['SocialAudit']['decisions_details'][$i];
                            $issue_resolved =  $this->request->data['SocialAudit']['issue_resolved'][$i];
                            $details_of_issues_resolved =  $this->request->data['SocialAudit']['details_of_issues_resolved'][$i];
                            $issue_resolved_date =  $this->request->data['SocialAudit']['issue_resolved_date'][$i];   
                            $action_taken =  $this->request->data['SocialAudit']['action_taken'][$i];  
                            $remarks =  $this->request->data['SocialAudit']['remarks'];
                          
                    $data=array (
                                'district'=>$district,
                                'block'=>$block,
                                'meeting_date'=>$meeting_date,
                                'participants' =>$participants,
                                'panellist' =>$panellist,
                                'case_study_shared'=>$case_study_shared,
                                'testimonial_shared'=> $testimonial_shared,
                                'issue_shared_jansamwad'=>$issue_shared_jansamwad,
                                'issue_shared_pri'=>$issue_shared_pri,
                                'details_of_issues'=>$details_of_issues,  
                                'decisions_taken'=>$decisions_taken,
                                'decisions_details'=>$decisions_details,
                                'issue_resolved'=>$issue_resolved,
                                'details_of_issues_resolved'=>$details_of_issues_resolved,
                                //'letter_to_higher_authority'=>$letter_to_higher_authority,
                                'action_taken'=>$action_taken,
                                'issue_resolved_date'=>$issue_resolved_date,
                                'updated'=>0,
                                'issue_cat'=>$issue_category,
                                'no_of_decision'=>$no_of_decision,
                                'solved_issue'=>$solved_issue,
                                'issue_level'=>$issue_level,
                                'remarks'=>$remarks,
                               
                        
                              );  
                    
                           $save=$this->SocialAudit->saveAll($data);
				
                        }///} } }   
                         
                             
                         if($save) {
                         $this->Session->setFlash(__('The Social Audit Meeting has been saved.'));
				return $this->redirect(array('action' => 'index'));

                        } else {
				$this->Session->setFlash(__('The Social Audit Meeting could not be saved. Please, try again.'));
			}
			
                    }   
                 if(CakeSession::read('User.type')==='regular'){
		    
                     if(CakeSession::read('User.subrole')==='CC'){
		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'))));
                       
                     
	             $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id'=>$r['Bpccc']['allocated_block'])));
                    $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Bpccc']['allocated_district'])));	
				
		}
                
                 elseif(CakeSession::read('User.subrole')==='BPC'){
		  $r = $this->Bpc->find('first',array('conditions'=>array('Bpc.first_name='.CakeSession::read('User.id'))));
                       
                     
	           $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id IN'=>explode(',',$r['Bpc']['allocated_block']))));
                    $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Bpc']['allocated_district'])));	
			
		}
                else {
                    
                   $r = $this->Dpo->find('first',array('conditions'=>array('Dpo.first_name='.CakeSession::read('User.id'))));
                       
                     
	           $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.city_id IN'=>explode(',',$r['Dpo']['district']))));
                     $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Dpo']['district'])));	
			 
                }}
                else {
                    
                    $blocks=$this->Block->find('list');
                    $cities=$this->City->find('list');
                   
                }
		//$executives=$this->User->find('list',array('conditions'=>array('User.status'=>'active','User.role'=>'regular')));
		
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
		if (!$this->SocialAudit->exists($id)) {
			throw new NotFoundException(__('Invalid Social Audit'));
		}
                
                
		if ($this->request->is(array('post', 'put'))) {
                     //$data =  $this->request->data;
                     //die();
                         $district =  $this->request->data['SocialAudit']['district'];
                           $block =  $this->request->data['SocialAudit']['block'];
                            $meeting_date =  date('Y-m-d',strtotime($this->request->data['SocialAudit']['meeting_date']));
                            $participants =  $this->request->data['SocialAudit']['participants']; 
                            $panellist=  $this->request->data['SocialAudit']['panellist']; 
                            $case_study_shared =  $this->request->data['SocialAudit']['case_study_shared']; 
                            $testimonial_shared =  $this->request->data['SocialAudit']['testimonial_shared']; 
                            //$issue_shared_jansamwad =  $this->request->data['SocialAudit']['issue_shared_jansamwad']; 
                            $no_of_decision =  $this->request->data['SocialAudit']['no_of_decision']; 
                            $solved_issue =  $this->request->data['SocialAudit']['solved_issue']; 
                             $issue_shared_pri =  $this->request->data['SocialAudit']['issue_shared_pri'];  
                            $issue_category =  $this->request->data['SocialAudit']['issue_category'];
                            $issue_level =  $this->request->data['SocialAudit']['issue_level'];
                            $details_of_issues =  $this->request->data['SocialAudit']['details_of_issues'];
                            $decisions_taken =  $this->request->data['SocialAudit']['decisions_taken'];
                            $decisions_details =  $this->request->data['SocialAudit']['decisions_details'];
                            $issue_resolved =  $this->request->data['SocialAudit']['issue_resolved'];
                            $details_of_issues_resolved =  $this->request->data['SocialAudit']['details_of_issues_resolved'];
                            $issue_resolved_date =  $this->request->data['SocialAudit']['issue_resolved_date'];   
                             $action_taken =  $this->request->data['SocialAudit']['action_taken'];  
                            $remarks =  $this->request->data['SocialAudit']['remarks'];
                          
                    $data=array (
                                'district'=>$district,
                                'block'=>$block,
                                'meeting_date'=>$meeting_date,
                                'participants' =>$participants,
                                'panellist' =>$panellist,
                                'case_study_shared'=>$case_study_shared,
                                'testimonial_shared'=> $testimonial_shared,
                               // 'issue_shared_jansamwad'=>$issue_shared_jansamwad,
                                'issue_shared_pri'=>$issue_shared_pri,
                                'details_of_issues'=>$details_of_issues,
                                'decisions_taken'=>$decisions_taken,
                                'decisions_details'=>$decisions_details,
                                'issue_resolved'=>$issue_resolved,
                                'details_of_issues_resolved'=>$details_of_issues_resolved,
                                'issue_resolved_date'=>$issue_resolved_date,
                                'action_taken'=>$action_taken,
                                'updated'=>1,
                                'issue_cat'=>$issue_category,
                                'issue_level'=>$issue_level,
                                'no_of_decision'=>$no_of_decision,
                                'solved_issue'=>$solved_issue,
                                'remarks'=>$remarks,
                                'id'=>$id
                               
                        
                              );
			if ($this->SocialAudit->save($data)) {
				$this->Session->setFlash(__('The Social Audit Meeting has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Social Audit could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('SocialAudit.' . $this->SocialAudit->primaryKey => $id));
			$this->request->data = $this->SocialAudit->find('first', $options);
			$executives=$this->User->find('list',array('conditions'=>array('User.status'=>'active','User.role'=>'regular')));

			}
                    if(CakeSession::read('User.type')==='regular'){
		   if(CakeSession::read('User.subrole')==='CC'){
		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'))));
                       
                     
	             $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id'=>$r['Bpccc']['allocated_block'])));
                    $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Bpccc']['allocated_district'])));	
			
		}
                
                 elseif(CakeSession::read('User.subrole')==='BPC'){
		  $r = $this->Bpc->find('first',array('conditions'=>array('Bpc.first_name='.CakeSession::read('User.id'))));
                       
                     
	           $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id IN'=>explode(',',$r['Bpc']['allocated_block']))));
                    $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Bpc']['allocated_district'])));	
		
		}
                else {
                    
                   $r = $this->Dpo->find('first',array('conditions'=>array('Dpo.first_name='.CakeSession::read('User.id'))));
                       
                     
	           $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.city_id IN'=>explode(',',$r['Dpo']['district']))));
                   $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Dpo']['district'])));	
		 
                } }
                   else {
                         $blocks=$this->Block->find('list');
                         $cities=$this->City->find('list');
                   }
		
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
		$this->SocialAudit->id = $id;
		if (!$this->SocialAudit->exists()) {
			throw new NotFoundException(__('Invalid Vhsnc/Afc Detail'));
		}
		    //$this->request->onlyAllow('post', 'delete');
		    $this->SocialAudit->read(null,$id);
			$this->SocialAudit->set(array('status'=>$status));
		
		if ($this->SocialAudit->save()) {
			$this->Session->setFlash(__('The Social Audit Meeting has been '.$status));
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
	$condition2.=' and SocialAudit.id LIKE %'.$searchKey.'% || SocialAudit.details_of_issues LIKE %'.$searchKey.'% SocialAudit.decisions_taken LIKE %'.$searchKey.'% || SocialAudit.decisions_details LIKE %'.$searchKey.'% || SocialAudit.action_taken LIKE %'.$searchKey.'%';
	
	}
	
	
	
	if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(SocialAudit.meeting_date)>="'.$fromdate.'" and date(SocialAudit.meeting_date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(SocialAudit.meeting_date)="'.$fromdate.'"';
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
		$condition2.=' and SocialAudit.block='.$searchBlockId;
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
                             $condition2.=' and SocialAudit.block='.$searchProjectId;
		           }   else { 
                        ///$condition=['VhsncAfc.panchayat IN' =>explode(',',$r['Bpccc']['allocated_panchayat'])]; 
                         $condition2.=' and SocialAudit.block IN ('.$r['Bpccc']['allocated_block'].')';
                      }
                      
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    //$condition['OR']=array('Geographical.id LIKE'=>'%'.$searchKey.'%','Geographical.ward LIKE'=>'%'.$searchKey.'%','Geographical.awc_code LIKE'=>'%'.$searchKey.'%','Geographical.awc_worker LIKE '=>'%'.$searchKey.'%','Geographical.asha_name LIKE '=>'%'.$searchKey.'%'); 
	$condition2.=' and SocialAudit.id LIKE %'.$searchKey.'% || SocialAudit.details_of_issues LIKE %'.$searchKey.'% SocialAudit.decisions_taken LIKE %'.$searchKey.'% || SocialAudit.decisions_details LIKE %'.$searchKey.'% || SocialAudit.action_taken LIKE %'.$searchKey.'%';
	
	}
                      if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(SocialAudit.meeting_date)>="'.$fromdate.'" and date(SocialAudit.meeting_date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(SocialAudit.meeting_date)="'.$fromdate.'"';
				}
				else
				{
					
					}
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
		        $condition2.=' and SocialAudit.block='.$searchBlockId;
		        }else {
                            
                       $condition2.=' and SocialAudit.block IN ('.$r['Bpc']['allocated_block'].')';
                       
                      } 
                      
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    //$condition['OR']=array('Geographical.id LIKE'=>'%'.$searchKey.'%','Geographical.ward LIKE'=>'%'.$searchKey.'%','Geographical.awc_code LIKE'=>'%'.$searchKey.'%','Geographical.awc_worker LIKE '=>'%'.$searchKey.'%','Geographical.asha_name LIKE '=>'%'.$searchKey.'%'); 
	$condition2.=' and SocialAudit.id LIKE %'.$searchKey.'% || SocialAudit.details_of_issues LIKE %'.$searchKey.'% SocialAudit.decisions_taken LIKE %'.$searchKey.'% || SocialAudit.decisions_details LIKE %'.$searchKey.'% || SocialAudit.action_taken LIKE %'.$searchKey.'%';
	
	}
                      if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(SocialAudit.meeting_date)>="'.$fromdate.'" and date(SocialAudit.meeting_date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(SocialAudit.meeting_date)="'.$fromdate.'"';
				}
				else
				{
					
					}
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
                               $condition2.=' and SocialAudit.block='.$searchBlockId;
		        // $condition['VhsncAfc.block']=$searchBlockId;
		        }else {
                       //$condition='VhsncAfc.district='.$r['Dpo']['district'];
                        $condition2.=' and SocialAudit.district IN ('.$r['Dpo']['district'].')';
                        }
                        if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    //$condition['OR']=array('Geographical.id LIKE'=>'%'.$searchKey.'%','Geographical.ward LIKE'=>'%'.$searchKey.'%','Geographical.awc_code LIKE'=>'%'.$searchKey.'%','Geographical.awc_worker LIKE '=>'%'.$searchKey.'%','Geographical.asha_name LIKE '=>'%'.$searchKey.'%'); 
	$condition2.=' and SocialAudit.id LIKE %'.$searchKey.'% || SocialAudit.details_of_issues LIKE %'.$searchKey.'% SocialAudit.decisions_taken LIKE %'.$searchKey.'% || SocialAudit.decisions_details LIKE %'.$searchKey.'% || SocialAudit.action_taken LIKE %'.$searchKey.'%';
	
	}
                        if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(SocialAudit.meeting_date)>="'.$fromdate.'" and date(SocialAudit.meeting_date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(SocialAudit.meeting_date)="'.$fromdate.'"';
				}
				else
				{
					
					}
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
		$condition2.=' and SocialAudit.status="active"';
		$this->response->download("SocialAudit.csv");
		//print_r($condition); exit;
	    $data=$this->SocialAudit->query('select SocialAudit.id,SocialAudit.meeting_date,SocialAudit.participants,Issuecategory.name,Issuesubcat.name,SocialAudit.panellist,SocialAudit.case_study_shared,SocialAudit.testimonial_shared,SocialAudit.issue_shared_jansamwad,SocialAudit.issue_shared_pri,SocialAudit.details_of_issues,City.name,Block.name,SocialAudit.decisions_taken,SocialAudit.decisions_details,SocialAudit.issue_resolved,SocialAudit.details_of_issues_resolved,SocialAudit.action_taken,SocialAudit.status from social_audits as SocialAudit left join cities as City  on SocialAudit.district=City.id left join blocks as Block  on SocialAudit.block=Block.id left join issue_category as Issuecategory on SocialAudit.issue_cat=Issuecategory.id left join issue_subcategory as Issuesubcat on SocialAudit.issue_level=Issuesubcat.id   where 1 '.$condition2 );
		
		
		//$data = $this->Geographical->find('all', array('conditions'=>$condition2));
		
		//$log = $this->Enquiry->getDataSource()->getLog(false, false);
        //debug($log);
		//exit;
		
            $headers = array('SocialAudit'=>array( 'Id' => 'Id','District' => 'District', 'Block' => 'Block','Date of Meeting'=>'Date of Meeting','Participants' => 'Participants','Panellist'=>'Panellist','Case Study Shared'=>'Case Study Shared','Testimonials Shared'=>'Testimonials Shared','Issues Shared in Jan Samwaad'=>'Issues Shared in Jan Samwaad','Details of Issues'=>'Details of Issues','Issues Shared by'=>'Issues Shared by','Issue Category'=>'Issue Category','Issue Level'=>'Issue Level','Decisions Taken'=>'Decisions Taken','Decision Details'=>'Decision Details','Issue Resolved'=>'Issue Resolved','Describe Resolved Issue'=>'Describe Resolved Issue','Action Taken'=>'Action Taken','Status'=>'Status')); 
	    $this->set(compact('data','headers'));
		$this->layout = 'ajax';
		return;
		
		}
  ////  reports section ---/////   
		
	}
	
	
	
	
