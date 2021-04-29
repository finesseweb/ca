<?php
App::uses('AppController', 'Controller');
/**
 * Ngos Controller
 *
 * @property Ngo $GeographicalNgo
 * @property PaginatorComponent $Paginator
 */
class AnmMeetingsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Upload');

    var  $uses = array('AnmMeeting','Geographical','Ngo','User','RegisterMember','Village','Panchayat','MeetingFacilitated','Country','City','Block','Designation','Ward','IssueCategory','IssueSubcategory','Bpccc','Bpc','Dpo');
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
    $condition['OR']=array('AnmMeeting.id LIKE'=>'%'.$searchKey.'%','AnmMeeting.meeting_chaired_by LIKE'=>'%'.$searchKey.'%','AnmMeeting.key_issues_discussed LIKE'=>'%'.$searchKey.'%','AnmMeeting.issue_resolved LIKE '=>'%'.$searchKey.'%','AnmMeeting.issues_raised_by_bpc LIKE '=>'%'.$searchKey.'%'); 
	
	}
		
		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(AnmMeeting.meeting_date) >='=>$fromdate,'date(AnmMeeting.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['AnmMeeting.meeting_date']=$fromdate;	
				}
				
			}
		
		if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBuilderId=trim($this->request->query['block']); 
		$condition['AnmMeeting.block']=$searchBuilderId;
		}
		
		
		
		
		
	}  
        
           if(CakeSession::read('User.type')==='regular'){
             //echo CakeSession::read('User.subrole');
            // die();
             if(CakeSession::read('User.subrole')==='CC'){
		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'))));
                      if($r){ 
                          if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBuilderId=trim($this->request->query['block']); 
		        $condition['AnmMeeting.block']=$searchBuilderId;
		         }
                         else {
		
                        // $condition= 'FIND_IN_SET(\''. $r['Bpccc']['allocated_panchayat'].'\',VhsncConstitution.panchayat)'; 
                      // $condition='VhsncConstitution.panchayat='.$r['Bpccc']['allocated_panchayat'];
                         $condition=['AnmMeeting.block IN' =>explode(',',$r['Bpccc']['allocated_block'])]; 
                         }
                         if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('AnmMeeting.id LIKE'=>'%'.$searchKey.'%','AnmMeeting.meeting_chaired_by LIKE'=>'%'.$searchKey.'%','AnmMeeting.key_issues_discussed LIKE'=>'%'.$searchKey.'%','AnmMeeting.issue_resolved LIKE '=>'%'.$searchKey.'%','AnmMeeting.issues_raised_by_bpc LIKE '=>'%'.$searchKey.'%'); 
	
	}
                         if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(AnmMeeting.meeting_date) >='=>$fromdate,'date(AnmMeeting.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['AnmMeeting.meeting_date']=$fromdate;	
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
		         $condition['AnmMeeting.block']=$searchBuilderId;
		               }
		      else {
                      // $condition='VhsncConstitution.block='.$r['Bpc']['allocated_block'];
                        $condition=['AnmMeeting.block IN' =>explode(',',$r['Bpc']['allocated_block'])];
                      }
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('AnmMeeting.id LIKE'=>'%'.$searchKey.'%','AnmMeeting.meeting_chaired_by LIKE'=>'%'.$searchKey.'%','AnmMeeting.key_issues_discussed LIKE'=>'%'.$searchKey.'%','AnmMeeting.issue_resolved LIKE '=>'%'.$searchKey.'%','AnmMeeting.issues_raised_by_bpc LIKE '=>'%'.$searchKey.'%'); 
	
	}
                      if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(AnmMeeting.meeting_date) >='=>$fromdate,'date(AnmMeeting.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['AnmMeeting.meeting_date']=$fromdate;	
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
		         $condition['AnmMeeting.block']=$searchBuilderId;
		               }
		      else {
                          $blk =$this->Block->find('all',array('conditions'=>array('Block.city_id '=>$r['Dpo']['district'])));
                           
                          foreach($blk as $bk) {
                              
                      // $condition='VhsncConstitution.block='.$r['Bpc']['allocated_block'];
                       $condition=['AnmMeeting.district IN' =>explode(',',$r['Dpo']['district'])];
                        
                          }
                      }
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('AnmMeeting.id LIKE'=>'%'.$searchKey.'%','AnmMeeting.meeting_chaired_by LIKE'=>'%'.$searchKey.'%','AnmMeeting.key_issues_discussed LIKE'=>'%'.$searchKey.'%','AnmMeeting.issue_resolved LIKE '=>'%'.$searchKey.'%','AnmMeeting.issues_raised_by_bpc LIKE '=>'%'.$searchKey.'%'); 
	
	}
                      if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(AnmMeeting.meeting_date) >='=>$fromdate,'date(AnmMeeting.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['AnmMeeting.meeting_date']=$fromdate;	
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
		         $condition['AnmMeeting.block']=$searchBlockId;
		        }else {
                            
                       $condition=['AnmMeeting.block IN' =>$blo];
                       
                      }
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('AnmMeeting.id LIKE'=>'%'.$searchKey.'%','AnmMeeting.meeting_chaired_by LIKE'=>'%'.$searchKey.'%','AnmMeeting.key_issues_discussed LIKE'=>'%'.$searchKey.'%','AnmMeeting.issue_resolved LIKE '=>'%'.$searchKey.'%','AnmMeeting.issues_raised_by_bpc LIKE '=>'%'.$searchKey.'%'); 
	
	}
                      if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(AnmMeeting.meeting_date) >='=>$fromdate,'date(AnmMeeting.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['AnmMeeting.meeting_date']=$fromdate;	
				}
				
			}
		}
                 $blocks=$this->Block->find('list',array('order' => array('name' => 'asc'),'conditions'=>array('Block.id IN'=>$blo)));
                 $ngos=$this->Ngo->find('list',array('conditions'=>array('Ngo.id'=>$r['Ngo']['id'])));
                     
         }
         else {
             $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc')));	
         }
		$this->Paginator->settings = array('AnmMeeting' => array('limit' =>20,'group'=>array('AnmMeeting.meeting_date','AnmMeeting.block'),'order' => array('id' => 'desc'),'conditions'=>array($condition,'AnmMeeting.status'=>'active')));
		$this->AnmMeeting->recursive = 0;
		$this->set('anms', $this->Paginator->paginate());
		//$panchayats=$this->Panchayat->find('list');
              //  $villages=$this->Village->find('list');
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
		if (!$this->AnmMeeting->exists($id)) {
			throw new NotFoundException(__('Invalid VHSNC Meeting'));
		}
		$options = array('conditions' => array('AnmMeeting.' . $this->AnmMeeting->primaryKey => $id));
		$this->set('anm', $this->AnmMeeting->find('first', $options));
		$this->layout='newdefault';
	}
        
        public function viewissues($id = null,$date=null) {
//		if (!$this->AnmMeeting->exists($id)) {
//			throw new NotFoundException(__('Invalid VHSNC Meeting'));
//		}
            $r= explode(',',$id);
		$options = array('conditions' => array('AnmMeeting.block'=> $r['0'],'AnmMeeting.meeting_date' => $r['1']));
		$this->set('anms', $this->AnmMeeting->find('all', $options));
		$this->layout='newdefault';
	}
	
	
	
        public function viewpendingissue() {
		
		$data='';$searchKey=null;$searchUserId=null;$searchBuilderId=null;$searchProjectId=null;$fromdate=null;$todate=null;
		$condition='';$querySrting=''; $condition=array();
		$conc='';
		
		if(isset($this->params->query['confirm'])) {
	   
		if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('AnmMeeting.id LIKE'=>'%'.$searchKey.'%','AnmMeeting.meeting_chaired_by LIKE'=>'%'.$searchKey.'%','AnmMeeting.key_issues_discussed LIKE'=>'%'.$searchKey.'%','AnmMeeting.issue_resolved LIKE '=>'%'.$searchKey.'%','AnmMeeting.issues_raised_by_bpc LIKE '=>'%'.$searchKey.'%'); 
	
	}
		
		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(AnmMeeting.meeting_date) >='=>$fromdate,'date(AnmMeeting.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['AnmMeeting.meeting_date']=$fromdate;	
				}
				
			}
		
		if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBuilderId=trim($this->request->query['block']); 
		$condition['AnmMeeting.block']=$searchBuilderId;
		}
		
		
		
		
		
	}  
        
           if(CakeSession::read('User.type')==='regular'){
             //echo CakeSession::read('User.subrole');
            // die();
             if(CakeSession::read('User.subrole')==='CC'){
		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'))));
                      if($r){ 
                          if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBuilderId=trim($this->request->query['block']); 
		        $condition['AnmMeeting.block']=$searchBuilderId;
		         }
                         else {
		
                        // $condition= 'FIND_IN_SET(\''. $r['Bpccc']['allocated_panchayat'].'\',VhsncConstitution.panchayat)'; 
                      // $condition='VhsncConstitution.panchayat='.$r['Bpccc']['allocated_panchayat'];
                         $condition=['AnmMeeting.block IN' =>explode(',',$r['Bpccc']['allocated_block'])]; 
                         }
                         
                         if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('AnmMeeting.id LIKE'=>'%'.$searchKey.'%','AnmMeeting.meeting_chaired_by LIKE'=>'%'.$searchKey.'%','AnmMeeting.key_issues_discussed LIKE'=>'%'.$searchKey.'%','AnmMeeting.issue_resolved LIKE '=>'%'.$searchKey.'%','AnmMeeting.issues_raised_by_bpc LIKE '=>'%'.$searchKey.'%'); 
	
	}
                         if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(AnmMeeting.meeting_date) >='=>$fromdate,'date(AnmMeeting.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['AnmMeeting.meeting_date']=$fromdate;	
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
		         $condition['AnmMeeting.block']=$searchBuilderId;
		               }
		      else {
                      // $condition='VhsncConstitution.block='.$r['Bpc']['allocated_block'];
                        $condition=['AnmMeeting.block IN' =>explode(',',$r['Bpc']['allocated_block'])];
                      }
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('AnmMeeting.id LIKE'=>'%'.$searchKey.'%','AnmMeeting.meeting_chaired_by LIKE'=>'%'.$searchKey.'%','AnmMeeting.key_issues_discussed LIKE'=>'%'.$searchKey.'%','AnmMeeting.issue_resolved LIKE '=>'%'.$searchKey.'%','AnmMeeting.issues_raised_by_bpc LIKE '=>'%'.$searchKey.'%'); 
	
	}
                      if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(AnmMeeting.meeting_date) >='=>$fromdate,'date(AnmMeeting.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['AnmMeeting.meeting_date']=$fromdate;	
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
		         $condition['AnmMeeting.block']=$searchBuilderId;
		               }
		      else {
                          $blk =$this->Block->find('all',array('conditions'=>array('Block.city_id '=>$r['Dpo']['district'])));
                           
                          foreach($blk as $bk) {
                              
                      // $condition='VhsncConstitution.block='.$r['Bpc']['allocated_block'];
                       $condition=['AnmMeeting.district IN' =>explode(',',$r['Dpo']['district'])];
                        
                          }
                      }
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('AnmMeeting.id LIKE'=>'%'.$searchKey.'%','AnmMeeting.meeting_chaired_by LIKE'=>'%'.$searchKey.'%','AnmMeeting.key_issues_discussed LIKE'=>'%'.$searchKey.'%','AnmMeeting.issue_resolved LIKE '=>'%'.$searchKey.'%','AnmMeeting.issues_raised_by_bpc LIKE '=>'%'.$searchKey.'%'); 
	
	}
                      if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(AnmMeeting.meeting_date) >='=>$fromdate,'date(AnmMeeting.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['AnmMeeting.meeting_date']=$fromdate;	
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
		         $condition['AnmMeeting.block']=$searchBlockId;
		        }else {
                            
                       $condition=['AnmMeeting.block IN' =>$blo];
                       
                      }
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('AnmMeeting.id LIKE'=>'%'.$searchKey.'%','AnmMeeting.meeting_chaired_by LIKE'=>'%'.$searchKey.'%','AnmMeeting.key_issues_discussed LIKE'=>'%'.$searchKey.'%','AnmMeeting.issue_resolved LIKE '=>'%'.$searchKey.'%','AnmMeeting.issues_raised_by_bpc LIKE '=>'%'.$searchKey.'%'); 
	
	}
                      if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(AnmMeeting.meeting_date) >='=>$fromdate,'date(AnmMeeting.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['AnmMeeting.meeting_date']=$fromdate;	
				}
				
			}
		}
                 $blocks=$this->Block->find('list',array('order' => array('name' => 'asc'),'conditions'=>array('Block.id IN'=>$blo)));
                 $ngos=$this->Ngo->find('list',array('conditions'=>array('Ngo.id'=>$r['Ngo']['id'])));
                     
         }
         else {
             $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc')));	
         }
		$this->Paginator->settings = array('AnmMeeting' => array('limit' =>20,'order' => array('id' => 'desc'),'conditions'=>array($condition,'AnmMeeting.status'=>'active','AnmMeeting.updated'=>'0')));
		$this->AnmMeeting->recursive = 0;
		$this->set('anms', $this->Paginator->paginate());
		//$panchayats=$this->Panchayat->find('list');
              //  $villages=$this->Village->find('list');
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
    $condition['OR']=array('AnmMeeting.id LIKE'=>'%'.$searchKey.'%','AnmMeeting.meeting_chaired_by LIKE'=>'%'.$searchKey.'%','AnmMeeting.key_issues_discussed LIKE'=>'%'.$searchKey.'%','AnmMeeting.issue_resolved LIKE '=>'%'.$searchKey.'%','AnmMeeting.issues_raised_by_bpc LIKE '=>'%'.$searchKey.'%'); 
	
	}
		
		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(AnmMeeting.meeting_date) >='=>$fromdate,'date(AnmMeeting.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['AnmMeeting.meeting_date']=$fromdate;	
				}
				
			}
		
		if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBuilderId=trim($this->request->query['block']); 
		$condition['AnmMeeting.block']=$searchBuilderId;
		}
		
		
		
		
		
	}  
        
           if(CakeSession::read('User.type')==='regular'){
             //echo CakeSession::read('User.subrole');
            // die();
             if(CakeSession::read('User.subrole')==='CC'){
		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'))));
                      if($r){ 
                          if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBuilderId=trim($this->request->query['block']); 
		        $condition['AnmMeeting.block']=$searchBuilderId;
		         }
                         else {
		
                        // $condition= 'FIND_IN_SET(\''. $r['Bpccc']['allocated_panchayat'].'\',VhsncConstitution.panchayat)'; 
                      // $condition='VhsncConstitution.panchayat='.$r['Bpccc']['allocated_panchayat'];
                         $condition=['AnmMeeting.block IN' =>explode(',',$r['Bpccc']['allocated_block'])]; 
                         }
                         if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('AnmMeeting.id LIKE'=>'%'.$searchKey.'%','AnmMeeting.meeting_chaired_by LIKE'=>'%'.$searchKey.'%','AnmMeeting.key_issues_discussed LIKE'=>'%'.$searchKey.'%','AnmMeeting.issue_resolved LIKE '=>'%'.$searchKey.'%','AnmMeeting.issues_raised_by_bpc LIKE '=>'%'.$searchKey.'%'); 
	
	}
                         if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(AnmMeeting.meeting_date) >='=>$fromdate,'date(AnmMeeting.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['AnmMeeting.meeting_date']=$fromdate;	
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
		         $condition['AnmMeeting.block']=$searchBuilderId;
		               }
		      else {
                      // $condition='VhsncConstitution.block='.$r['Bpc']['allocated_block'];
                        $condition=['AnmMeeting.block IN' =>explode(',',$r['Bpc']['allocated_block'])];
                      }
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('AnmMeeting.id LIKE'=>'%'.$searchKey.'%','AnmMeeting.meeting_chaired_by LIKE'=>'%'.$searchKey.'%','AnmMeeting.key_issues_discussed LIKE'=>'%'.$searchKey.'%','AnmMeeting.issue_resolved LIKE '=>'%'.$searchKey.'%','AnmMeeting.issues_raised_by_bpc LIKE '=>'%'.$searchKey.'%'); 
	
	}
                      if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(AnmMeeting.meeting_date) >='=>$fromdate,'date(AnmMeeting.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['AnmMeeting.meeting_date']=$fromdate;	
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
		         $condition['AnmMeeting.block']=$searchBuilderId;
		               }
		      else {
                          $blk =$this->Block->find('all',array('conditions'=>array('Block.city_id '=>$r['Dpo']['district'])));
                           
                          foreach($blk as $bk) {
                              
                      // $condition='VhsncConstitution.block='.$r['Bpc']['allocated_block'];
                       $condition=['AnmMeeting.district IN' =>explode(',',$r['Dpo']['district'])];
                        
                          }
                      }
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('AnmMeeting.id LIKE'=>'%'.$searchKey.'%','AnmMeeting.meeting_chaired_by LIKE'=>'%'.$searchKey.'%','AnmMeeting.key_issues_discussed LIKE'=>'%'.$searchKey.'%','AnmMeeting.issue_resolved LIKE '=>'%'.$searchKey.'%','AnmMeeting.issues_raised_by_bpc LIKE '=>'%'.$searchKey.'%'); 
	
	}
                      if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(AnmMeeting.meeting_date) >='=>$fromdate,'date(AnmMeeting.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['AnmMeeting.meeting_date']=$fromdate;	
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
		         $condition['AnmMeeting.block']=$searchBlockId;
		        }else {
                            
                       $condition=['AnmMeeting.block IN' =>$blo];
                       
                      }
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('AnmMeeting.id LIKE'=>'%'.$searchKey.'%','AnmMeeting.meeting_chaired_by LIKE'=>'%'.$searchKey.'%','AnmMeeting.key_issues_discussed LIKE'=>'%'.$searchKey.'%','AnmMeeting.issue_resolved LIKE '=>'%'.$searchKey.'%','AnmMeeting.issues_raised_by_bpc LIKE '=>'%'.$searchKey.'%'); 
	
	}
                      if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(AnmMeeting.meeting_date) >='=>$fromdate,'date(AnmMeeting.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['AnmMeeting.meeting_date']=$fromdate;	
				}
				
			}
		}
                 $blocks=$this->Block->find('list',array('order' => array('name' => 'asc'),'conditions'=>array('Block.id IN'=>$blo)));
                 $ngos=$this->Ngo->find('list',array('conditions'=>array('Ngo.id'=>$r['Ngo']['id'])));
                     
         }
         else {
             $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc')));	
         }
		$this->Paginator->settings = array('AnmMeeting' => array('limit' =>20,'order' => array('id' => 'desc'),'conditions'=>array($condition,'AnmMeeting.status'=>'active','AnmMeeting.issue_resolved'=>'yes','AnmMeeting.updated'=>'1')));
		$this->AnmMeeting->recursive = 0;
		$this->set('anms', $this->Paginator->paginate());
		//$panchayats=$this->Panchayat->find('list');
              //  $villages=$this->Village->find('list');
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
			$this->AnmMeeting->create();
                    
                        for($i=0;$i<count($this->request->data['AnmMeeting']['key_issues_discussed']);$i++){
                            
                          
                            $district =  $this->request->data['AnmMeeting']['district'];
                            $block =  $this->request->data['AnmMeeting']['block'];
                            $meeting_date =  date('Y-m-d',strtotime($this->request->data['AnmMeeting']['meeting_date']));
                            $meeting_chaired_by =  $this->request->data['AnmMeeting']['meeting_chaired_by'];  
                            $no_of_issue =  $this->request->data['AnmMeeting']['no_of_issue'];  
                            $no_of_decision =  $this->request->data['AnmMeeting']['no_of_decision'];  
                            $solved_issue =  $this->request->data['AnmMeeting']['solved_issue']; 
                            $key_issues_discussed =  $this->request->data['AnmMeeting']['key_issues_discussed'][$i];
                            $issues_raised_by_bpc =  $this->request->data['AnmMeeting']['issues_raised_by_bpc'][$i];
                            $decisions_taken =  $this->request->data['AnmMeeting']['decisions_taken'][$i];
                            $issue_category =  $this->request->data['AnmMeeting']['issue_category'][$i];
                            $issue_level =  $this->request->data['AnmMeeting']['issue_level'][$i];
                            $decision_details =  $this->request->data['AnmMeeting']['decision_details'][$i];
                            $issue_resolved =  $this->request->data['AnmMeeting']['issue_resolved'][$i];
                            $resolved_date =  date('Y-m-d',strtotime($this->request->data['AnmMeeting']['resolved_date'][$i]));
                            $details_of_issues_resolved =  $this->request->data['AnmMeeting']['details_of_issues_resolved'][$i];   
                            $remarks =  $this->request->data['AnmMeeting']['remarks'];
                          
                    $data=array (
                                'district'=>$district,
                                'block'=>$block,
                                'meeting_date'=>$meeting_date,
                                'meeting_chaired_by' =>$meeting_chaired_by,
                                'key_issues_discussed' =>$key_issues_discussed,
                                'issues_raised_by_bpc'=>$issues_raised_by_bpc,
                                'decisions_taken'=> $decisions_taken,
                                'issue_resolved'=>$issue_resolved,
                        	'issue_category'=>$issue_category,
                                'issue_level'=>$issue_level,
                                'decision_details'=>$decision_details,
                                'details_of_issues_resolved'=>$details_of_issues_resolved,
                                'no_of_issue'=>$no_of_issue,
                                'no_of_decision'=>$no_of_decision,
                                'solved_issue'=>$solved_issue,
                                'resolved_date'=> $resolved_date,
                                'updated'=>0,
                                'remarks'=>$remarks,
                               
                        
                                );  
                    
                           $save=$this->AnmMeeting->saveAll($data);
				
                         }///} } }   
                         
                             
                         if($save) {
                         $this->Session->setFlash(__('The ANM Meeting has been saved.'));
				return $this->redirect(array('action' => 'index'));

                        } else {
				$this->Session->setFlash(__('The ANM Meeting could not be saved. Please, try again.'));
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
		
                }
               }
                else {
                    
                    $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc')));
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
		if (!$this->AnmMeeting->exists($id)) {
			throw new NotFoundException(__('Invalid VhsncAfc'));
		}
		if ($this->request->is(array('post', 'put'))) {
                           $district =  $this->request->data['AnmMeeting']['district'];
                           $block =  $this->request->data['AnmMeeting']['block'];
                            $meeting_date =  date('Y-m-d',strtotime($this->request->data['AnmMeeting']['meeting_date']));
                            $meeting_chaired_by =  $this->request->data['AnmMeeting']['meeting_chaired_by'];  
                            $key_issues_discussed =  $this->request->data['AnmMeeting']['key_issues_discussed'];
                            $issues_raised_by_bpc =  $this->request->data['AnmMeeting']['issues_raised_by_bpc'];
                            $decisions_taken =  $this->request->data['AnmMeeting']['decisions_taken'];
                            $issue_category =  $this->request->data['AnmMeeting']['issue_category'];
                            $issue_level =  $this->request->data['AnmMeeting']['issue_level'];
                            $decision_details =  $this->request->data['AnmMeeting']['decision_details'];
                            $resolved_date =  date('Y-m-d',strtotime($this->request->data['AnmMeeting']['resolved_date']));
                            $no_of_decision =  $this->request->data['AnmMeeting']['no_of_decision'];  
                            $solved_issue =  $this->request->data['AnmMeeting']['solved_issue']; 
                           
                            $issue_resolved =  $this->request->data['AnmMeeting']['issue_resolved'];
                            $details_of_issues_resolved =  $this->request->data['AnmMeeting']['details_of_issues_resolved'];   
                            $remarks =  $this->request->data['AnmMeeting']['remarks'];
                          
                    $data=array (
                                'district'=>$district,
                                'block'=>$block,
                                'meeting_date'=>$meeting_date,
                                'meeting_chaired_by' =>$meeting_chaired_by,
                                'key_issues_discussed' =>$key_issues_discussed,
                                'issues_raised_by_bpc'=>$issues_raised_by_bpc,
                                'decisions_taken'=> $decisions_taken,
                                'issue_resolved'=>$issue_resolved,
                                'issue_category'=>$issue_category,
                                'issue_level'=>$issue_level,
                                'decision_details'=>$decision_details,
                                'no_of_decision'=>$no_of_decision,
                                'solved_issue'=>$solved_issue,
                                'details_of_issues_resolved'=>$details_of_issues_resolved,
                                'remarks'=>$remarks,
                                'resolved_date'=> $resolved_date,
                                'updated'=>1,
                               'id'=>$id
                        
                                );  
			if ($this->AnmMeeting->save($data)) {
				$this->Session->setFlash(__('The ANM Meeting has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ANM could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('AnmMeeting.' . $this->AnmMeeting->primaryKey => $id));
			$this->request->data = $this->AnmMeeting->find('first', $options);
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
		  
                }
               }
               else {
                         $blocks=$this->Block->find('list');
                         $cities=$this->City->find('list');
                          }
		
                $desig=$this->Designation->find('list');
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
		$this->AnmMeeting->id = $id;
		if (!$this->AnmMeeting->exists()) {
			throw new NotFoundException(__('Invalid ANM Meeting Detail'));
		}
		    //$this->request->onlyAllow('post', 'delete');
		    $this->AnmMeeting->read(null,$id);
			$this->AnmMeeting->set(array('status'=>$status));
		
		if ($this->AnmMeeting->save()) {
			$this->Session->setFlash(__('The ANM Meeting has been '.$status));
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
	$condition2.=' and AnmMeeting.id LIKE %'.$searchKey.'% || AnmMeeting.meeting_chaired_by LIKE %'.$searchKey.'% AnmMeeting.key_issues_discussed LIKE %'.$searchKey.'% || AnmMeeting.issue_resolved LIKE %'.$searchKey.'% || AnmMeeting.issues_raised_by_bpc LIKE %'.$searchKey.'%';
	
	}
	
	
	
	if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(AnmMeeting.meeting_date)>="'.$fromdate.'" and date(AnmMeeting.meeting_date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(AnmMeeting.meeting_date)="'.$fromdate.'"';
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
		$condition2.=' and AnmMeeting.block='.$searchBlockId;
		}
		
		//if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchProjectId=trim($this->request->query['panchayat']); //$condition['Enquiry.project_id']=$searchProjectId;
//		$condition2.=' and AnmMeeting.panchayat='.$searchProjectId;
//		}
//               
//                if(isset($this->request->query['village']) and ($this->request->query['village']!=0) and ($this->request->query['village']!='')){$searchVillageId=trim($this->request->query['village']); //$condition['Enquiry.project_id']=$searchProjectId;
//		$condition2.=' and AnmMeeting.village='.$searchVillageId;
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
                             $condition2.=' and AnmMeeting.block='.$searchProjectId;
		           }   else { 
                        ///$condition=['VhsncAfc.panchayat IN' =>explode(',',$r['Bpccc']['allocated_panchayat'])]; 
                         $condition2.=' and AnmMeeting.block IN ('.$r['Bpccc']['allocated_block'].')';
                      }
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    //$condition['OR']=array('Geographical.id LIKE'=>'%'.$searchKey.'%','Geographical.ward LIKE'=>'%'.$searchKey.'%','Geographical.awc_code LIKE'=>'%'.$searchKey.'%','Geographical.awc_worker LIKE '=>'%'.$searchKey.'%','Geographical.asha_name LIKE '=>'%'.$searchKey.'%'); 
	$condition2.=' and AnmMeeting.id LIKE %'.$searchKey.'% || AnmMeeting.meeting_chaired_by LIKE %'.$searchKey.'% AnmMeeting.key_issues_discussed LIKE %'.$searchKey.'% || AnmMeeting.issue_resolved LIKE %'.$searchKey.'% || AnmMeeting.issues_raised_by_bpc LIKE %'.$searchKey.'%';
	
	}
                      if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(AnmMeeting.meeting_date)>="'.$fromdate.'" and date(AnmMeeting.meeting_date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(AnmMeeting.meeting_date)="'.$fromdate.'"';
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
		        $condition2.=' and AnmMeeting.block='.$searchBlockId;
		        }else {
                            
                       $condition2.=' and AnmMeeting.block IN ('.$r['Bpc']['allocated_block'].')';
                       
                      }
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    //$condition['OR']=array('Geographical.id LIKE'=>'%'.$searchKey.'%','Geographical.ward LIKE'=>'%'.$searchKey.'%','Geographical.awc_code LIKE'=>'%'.$searchKey.'%','Geographical.awc_worker LIKE '=>'%'.$searchKey.'%','Geographical.asha_name LIKE '=>'%'.$searchKey.'%'); 
	$condition2.=' and AnmMeeting.id LIKE %'.$searchKey.'% || AnmMeeting.meeting_chaired_by LIKE %'.$searchKey.'% AnmMeeting.key_issues_discussed LIKE %'.$searchKey.'% || AnmMeeting.issue_resolved LIKE %'.$searchKey.'% || AnmMeeting.issues_raised_by_bpc LIKE %'.$searchKey.'%';
	
	}
                      if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(AnmMeeting.meeting_date)>="'.$fromdate.'" and date(AnmMeeting.meeting_date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(AnmMeeting.meeting_date)="'.$fromdate.'"';
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
                               $condition2.=' and AnmMeeting.block='.$searchBlockId;
		        // $condition['VhsncAfc.block']=$searchBlockId;
		        }else {
                       //$condition='VhsncAfc.district='.$r['Dpo']['district'];
                        $condition2.=' and AnmMeeting.district IN ('.$r['Dpo']['district'].')';
                        }
                        if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    //$condition['OR']=array('Geographical.id LIKE'=>'%'.$searchKey.'%','Geographical.ward LIKE'=>'%'.$searchKey.'%','Geographical.awc_code LIKE'=>'%'.$searchKey.'%','Geographical.awc_worker LIKE '=>'%'.$searchKey.'%','Geographical.asha_name LIKE '=>'%'.$searchKey.'%'); 
	$condition2.=' and AnmMeeting.id LIKE %'.$searchKey.'% || AnmMeeting.meeting_chaired_by LIKE %'.$searchKey.'% AnmMeeting.key_issues_discussed LIKE %'.$searchKey.'% || AnmMeeting.issue_resolved LIKE %'.$searchKey.'% || AnmMeeting.issues_raised_by_bpc LIKE %'.$searchKey.'%';
	
	}
                        if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(AnmMeeting.meeting_date)>="'.$fromdate.'" and date(AnmMeeting.meeting_date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(AnmMeeting.meeting_date)="'.$fromdate.'"';
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
		$condition2.=' and AnmMeeting.status="active"';
		$this->response->download("AnmMeeting.csv");
		//print_r($condition); exit;
	    $data=$this->AnmMeeting->query('select AnmMeeting.id,AnmMeeting.meeting_date,AnmMeeting.meeting_chaired_by,Issuecategory.name,Issuesubcat.name,AnmMeeting.key_issues_discussed,AnmMeeting.issues_raised_by_bpc,AnmMeeting.decisions_taken,AnmMeeting.decision_details,City.name,Block.name,AnmMeeting.issue_resolved,AnmMeeting.details_of_issues_resolved,AnmMeeting.status from anm_meetings as AnmMeeting left join cities as City  on AnmMeeting.district=City.id left join blocks as Block  on AnmMeeting.block=Block.id left join issue_category as Issuecategory on AnmMeeting.issue_category=Issuecategory.id left join issue_subcategory as Issuesubcat on AnmMeeting.issue_level=Issuesubcat.id   where 1 '.$condition2 );
		
		
		//$data = $this->Geographical->find('all', array('conditions'=>$condition2));
		
		//$log = $this->Enquiry->getDataSource()->getLog(false, false);
        //debug($log);
		//exit;
		
            $headers = array('AnmMeeting'=>array( 'Id' => 'Id','District' => 'District', 'Block' => 'Block','Date of Meeting'=>'Date of Meeting','Meeting chaired by' => 'Meeting chaired by','Key Issues Discussed'=>'Key Issues Discussed','Issues Raised By'=>'Issues Raised By','Issue Category'=>'Issue Category','Issue Level'=>'Issue Level','Decisions Taken'=>'Decisions Taken','Decision Details'=>'Decision Details','Issue Resolved'=>'Issue Resolved','Describe Resolved Issue'=>'Describe Resolved Issue','Status'=>'Status')); 
	    $this->set(compact('data','headers'));
		$this->layout = 'ajax';
		return;
		
		}
  ////  reports section ---/////   
	
	}
	
	
	
	
