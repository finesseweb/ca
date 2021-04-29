<?php
App::uses('AppController', 'Controller');
/**
 * Ngos Controller
 *
 * @property Ngo $GeographicalNgo
 * @property PaginatorComponent $Paginator
 */
class DpmcsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Upload');

    var  $uses = array('Dpmc','Dpo','Geographical','Ngo','User','RegisterMember','Village','Panchayat','MeetingFacilitated','Country','City','Block','Designation','Ward','IssueCategory','IssueSubcategory');
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
    $condition['OR']=array('Dpmc.id LIKE'=>'%'.$searchKey.'%','Dpmc.decisions_taken LIKE'=>'%'.$searchKey.'%','Dpmc.issue_resolved LIKE '=>'%'.$searchKey.'%','Dpmc.details_of_issues LIKE '=>'%'.$searchKey.'%'); 
	
	}
		
		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(Dpmc.meeting_date) >='=>$fromdate,'date(Dpmc.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['Dpmc.meeting_date']=$fromdate;	
				}
				
			}
		
		if(isset($this->request->query['district']) and ($this->request->query['district']!=0) and ($this->request->query['district']!='')){$searchBuilderId=trim($this->request->query['district']); 
		$condition['Dpmc.district']=$searchBuilderId;
		}
//		
//		if(isset($this->request->query['village']) and ($this->request->query['village']!=0) and ($this->request->query['village']!='')){$searchProjectId=trim($this->request->query['village']);
//		$condition['Dpmc.village']=$searchProjectId;
//		}
//                if(isset($this->request->query['ward']) and ($this->request->query['ward']!=0) and ($this->request->query['ward']!='')){$searchProjectId=trim($this->request->query['ward']);
//		$condition['Dpmc.ward']=$searchProjectId;
//		}
		
		
		
	}
         if(CakeSession::read('User.type')==='regular'){
		   $r = $this->Dpo->find('first',array('conditions'=>array('Dpo.first_name='.CakeSession::read('User.id'))));
                       if($r){
                           if(isset($this->request->query['district']) and ($this->request->query['district']!=0) and ($this->request->query['district']!='')){$searchBuilderId=trim($this->request->query['district']); 
		$condition['Dpmc.district']=$searchBuilderId;
		} else {
                       $condition='Dpmc.district='.$r['Dpo']['district'];
                }
                   if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('Dpmc.id LIKE'=>'%'.$searchKey.'%','Dpmc.decisions_taken LIKE'=>'%'.$searchKey.'%','Dpmc.issue_resolved LIKE '=>'%'.$searchKey.'%','Dpmc.details_of_issues LIKE '=>'%'.$searchKey.'%'); 
	
	}   
                      
                      if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(Dpmc.meeting_date) >='=>$fromdate,'date(Dpmc.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['Dpmc.meeting_date']=$fromdate;	
				}
				
			}
                       }
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated District yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }   
			//$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
				
		}
		
		$this->Paginator->settings = array('Dpmc' => array('limit' =>20,'group'=>array('meeting_date','district'),'order' => array('id' => 'desc'),'conditions'=>array($condition,'Dpmc.status'=>'active')));
		$this->Dpmc->recursive = 0;
		$this->set('anms', $this->Paginator->paginate());
		$panchayats=$this->Panchayat->find('list');
                $villages=$this->Village->find('list');
                $cities=$this->City->find('list',array('order'=>array('name'=>'asc')));
			
//			$users = $this->User->find('list',array('fields'=>array('parent'),'conditions'=>array('status'=>'active')));
//			$builders=$this->Builder->find('list');
			$this->set(compact('panchayats','villages','cities'));
			
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Dpmc->exists($id)) {
			throw new NotFoundException(__('Invalid Dpmc Meeting'));
		}
		$options = array('conditions' => array('Dpmc.' . $this->Dpmc->primaryKey => $id));
		$this->set('anm', $this->Dpmc->find('first', $options));
		$this->layout='newdefault';
	}
	
	
	public function viewissues($id = null,$date=null) {
		$r= explode(',',$id);
              //  print_r($r);
                //die();
		$options = array('conditions' => array('Dpmc.district' => $r['0'],'Dpmc.meeting_date' => $r['1']));
		$this->set('anms', $this->Dpmc->find('all', $options));
		$this->layout='newdefault';
	}
        
        
        public function viewpendingissue() {
		
		$data='';$searchKey=null;$searchUserId=null;$searchBuilderId=null;$searchProjectId=null;$fromdate=null;$todate=null;
		$condition='';$querySrting=''; $condition=array();
		$conc='';
		
		if(isset($this->params->query['confirm'])) {
	   
		if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('Dpmc.id LIKE'=>'%'.$searchKey.'%','Dpmc.decisions_taken LIKE'=>'%'.$searchKey.'%','Dpmc.issue_resolved LIKE '=>'%'.$searchKey.'%','Dpmc.details_of_issues LIKE '=>'%'.$searchKey.'%'); 
	
	}
		
		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(Dpmc.meeting_date) >='=>$fromdate,'date(Dpmc.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['Dpmc.meeting_date']=$fromdate;	
				}
				
			}
		
		if(isset($this->request->query['district']) and ($this->request->query['district']!=0) and ($this->request->query['district']!='')){$searchBuilderId=trim($this->request->query['district']); 
		$condition['Dpmc.district']=$searchBuilderId;
		}
//		
//		if(isset($this->request->query['village']) and ($this->request->query['village']!=0) and ($this->request->query['village']!='')){$searchProjectId=trim($this->request->query['village']);
//		$condition['Dpmc.village']=$searchProjectId;
//		}
//                if(isset($this->request->query['ward']) and ($this->request->query['ward']!=0) and ($this->request->query['ward']!='')){$searchProjectId=trim($this->request->query['ward']);
//		$condition['Dpmc.ward']=$searchProjectId;
//		}
		
		
		
	}
         if(CakeSession::read('User.type')==='regular'){
		   $r = $this->Dpo->find('first',array('conditions'=>array('Dpo.first_name='.CakeSession::read('User.id'))));
                       if($r){
                           if(isset($this->request->query['district']) and ($this->request->query['district']!=0) and ($this->request->query['district']!='')){$searchBuilderId=trim($this->request->query['district']); 
		$condition['Dpmc.district']=$searchBuilderId;
		}
                else {		   
                       $condition='Dpmc.district='.$r['Dpo']['district'];
                }
                if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('Dpmc.id LIKE'=>'%'.$searchKey.'%','Dpmc.decisions_taken LIKE'=>'%'.$searchKey.'%','Dpmc.issue_resolved LIKE '=>'%'.$searchKey.'%','Dpmc.details_of_issues LIKE '=>'%'.$searchKey.'%'); 
	
	}
                if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(Dpmc.meeting_date) >='=>$fromdate,'date(Dpmc.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['Dpmc.meeting_date']=$fromdate;	
				}
				
			}
                
                      } 
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated District yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }   
			//$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
				
		}
		
		$this->Paginator->settings = array('Dpmc' => array('limit' =>20,'group'=>array('meeting_date','district'),'order' => array('id' => 'desc'),'conditions'=>array($condition,'Dpmc.status'=>'active','Dpmc.updated'=>'0')));
		$this->Dpmc->recursive = 0;
		$this->set('anms', $this->Paginator->paginate());
		$panchayats=$this->Panchayat->find('list');
                $villages=$this->Village->find('list');
                $cities=$this->City->find('list',array('order'=>array('name'=>'asc')));
			
//			$users = $this->User->find('list',array('fields'=>array('parent'),'conditions'=>array('status'=>'active')));
//			$builders=$this->Builder->find('list');
			$this->set(compact('panchayats','villages','cities'));
			
	}
        
        public function viewresolvedissue() {
		
		$data='';$searchKey=null;$searchUserId=null;$searchBuilderId=null;$searchProjectId=null;$fromdate=null;$todate=null;
		$condition='';$querySrting=''; $condition=array();
		$conc='';
		
		if(isset($this->params->query['confirm'])) {
	   
		if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('Dpmc.id LIKE'=>'%'.$searchKey.'%','Dpmc.decisions_taken LIKE'=>'%'.$searchKey.'%','Dpmc.issue_resolved LIKE '=>'%'.$searchKey.'%','Dpmc.details_of_issues LIKE '=>'%'.$searchKey.'%'); 
	
	}
		
		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(Dpmc.meeting_date) >='=>$fromdate,'date(Dpmc.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['Dpmc.meeting_date']=$fromdate;	
				}
				
			}
		
		if(isset($this->request->query['district']) and ($this->request->query['district']!=0) and ($this->request->query['district']!='')){$searchBuilderId=trim($this->request->query['district']); 
		$condition['Dpmc.district']=$searchBuilderId;
		}
//		
//		if(isset($this->request->query['village']) and ($this->request->query['village']!=0) and ($this->request->query['village']!='')){$searchProjectId=trim($this->request->query['village']);
//		$condition['Dpmc.village']=$searchProjectId;
//		}
//                if(isset($this->request->query['ward']) and ($this->request->query['ward']!=0) and ($this->request->query['ward']!='')){$searchProjectId=trim($this->request->query['ward']);
//		$condition['Dpmc.ward']=$searchProjectId;
//		}
		
		
		
	}
         if(CakeSession::read('User.type')==='regular'){
		   $r = $this->Dpo->find('first',array('conditions'=>array('Dpo.first_name='.CakeSession::read('User.id'))));
                       if($r){
                           
                           if(isset($this->request->query['district']) and ($this->request->query['district']!=0) and ($this->request->query['district']!='')){$searchBuilderId=trim($this->request->query['district']); 
		$condition['Dpmc.district']=$searchBuilderId;
		}  else {
                       $condition='Dpmc.district='.$r['Dpo']['district'];
                }
                       
                   if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('Dpmc.id LIKE'=>'%'.$searchKey.'%','Dpmc.decisions_taken LIKE'=>'%'.$searchKey.'%','Dpmc.issue_resolved LIKE '=>'%'.$searchKey.'%','Dpmc.details_of_issues LIKE '=>'%'.$searchKey.'%'); 
	
	}    
                       if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(Dpmc.meeting_date) >='=>$fromdate,'date(Dpmc.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['Dpmc.meeting_date']=$fromdate;	
				}
				
			}
                      } 
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated District yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }   
			//$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
				
		}
		
		$this->Paginator->settings = array('Dpmc' => array('limit' =>20,'group'=>array('meeting_date','district'),'order' => array('id' => 'desc'),'conditions'=>array($condition,'Dpmc.status'=>'active','Dpmc.issue_resolved'=>'yes','Dpmc.updated'=>'1')));
		$this->Dpmc->recursive = 0;
		$this->set('anms', $this->Paginator->paginate());
		$panchayats=$this->Panchayat->find('list');
                $villages=$this->Village->find('list');
                $cities=$this->City->find('list',array('order'=>array('name'=>'asc')));
			
//			$users = $this->User->find('list',array('fields'=>array('parent'),'conditions'=>array('status'=>'active')));
//			$builders=$this->Builder->find('list');
			$this->set(compact('panchayats','villages','cities'));
			
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {




		if ($this->request->is('post')) {
			$this->Dpmc->create();
                       //$data=$this->request->data;
                           for($i=0;$i<count($this->request->data['Dpmc']['details_of_issues']);$i++){
                            
                            $res= implode(',', $register_member_type =  $this->request->data['Dpmc']['register_member_type']);
                            $district =  $this->request->data['Dpmc']['district'];
                            $meeting_date =  date('Y-m-d',strtotime($this->request->data['Dpmc']['meeting_date']));
                            $register_member =  $this->request->data['Dpmc']['register_member'];
                            $other_participated=  $this->request->data['Dpmc']['other_participated'];
                            $meeting_facilitated_by =  $this->request->data['Dpmc']['meeting_facilitated_by'];
                            $issue_shared_dpmc =  $this->request->data['Dpmc']['issue_shared_dpmc'];
                            $no_of_decision =  $this->request->data['Dpmc']['no_of_decision'];
                            $solved_issue =  $this->request->data['Dpmc']['solved_issue'];
                            
                            $details_of_issues =  $this->request->data['Dpmc']['details_of_issues'][$i];
                            $issue_category =  $this->request->data['Dpmc']['issue_category'][$i];
                            $issue_level =  $this->request->data['Dpmc']['issues_level'][$i];
                            $decisions_taken=  $this->request->data['Dpmc']['decisions_taken'][$i]; 
                            $decision_details=  $this->request->data['Dpmc']['decision_details'][$i]; 
                            $issue_resolved=  $this->request->data['Dpmc']['issue_resolved'][$i];
                            $resolved_date=  $this->request->data['Dpmc']['resolved_date'][$i];
                            $details_of_issues_resolved=  $this->request->data['Dpmc']['details_of_issues_resolved'][$i]; 
                            $letter_to_higher_authority=  $this->request->data['Dpmc']['letter_to_higher_authority'][$i];   
                            $remarks =  $this->request->data['Dpmc']['remarks'];
                          
                    $data=array (
                                'district'=>$district,
                                'meeting_date'=>$meeting_date,
                                'register_member' =>$register_member,
                                'other_participated' =>$other_participated,
                                'register_member_type'=>$res,
                                'meeting_facilitated_by'=> $meeting_facilitated_by,
                                'issue_shared_dpmc'=>$issue_shared_dpmc,
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
                                'updated'=>0,
                                'remarks'=>$remarks,
                               
                        
                                );  
                    
                           $save=$this->Dpmc->saveAll($data);
				
                         }///} } }   
                         
                             
                         if($save) {
                         $this->Session->setFlash(__('The Dpmc Meeting has been saved.'));
				return $this->redirect(array('action' => 'index'));

                        } else {
				$this->Session->setFlash(__('The Vhsnc Meeting could not be saved. Please, try again.'));
			}
			
                    }   
                 if(CakeSession::read('User.type')==='regular'){
		   $r = $this->Dpo->find('first',array('conditions'=>array('Dpo.first_name='.CakeSession::read('User.id'))));
                       
                    $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Dpo']['district'])));
                      }
                else {
                    $cities=$this->City->find('list',array('order'=>array('name'=>'asc')));    
                    
                }
		//$executives=$this->User->find('list',array('conditions'=>array('User.status'=>'active','User.role'=>'regular')));
		//$cities=$this->City->find('list');
                $desig=$this->Designation->find('list');
		$blocks=$this->Block->find('list');
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
		if (!$this->Dpmc->exists($id)) {
			throw new NotFoundException(__('Invalid VhsncAfc'));
		}
		if ($this->request->is(array('post', 'put'))) {
                    ///$data=$this->request->data;
                            $res= implode(',', $register_member_type =  $this->request->data['Dpmc']['register_member_type']);
                            $district =  $this->request->data['Dpmc']['district'];
                            $meeting_date =  date('Y-m-d',strtotime($this->request->data['Dpmc']['meeting_date']));
                            $register_member =  $this->request->data['Dpmc']['register_member'];
                            $other_participated=  $this->request->data['Dpmc']['other_participated'];
                            $meeting_facilitated_by =  $this->request->data['Dpmc']['meeting_facilitated_by'];
                            //$issue_shared_dpmc =  $this->request->data['Dpmc']['issue_shared_dpmc'];
                             $no_of_decision =  $this->request->data['Dpmc']['no_of_decision'];
                            $solved_issue =  $this->request->data['Dpmc']['solved_issue'];
                            
                            $details_of_issues =  $this->request->data['Dpmc']['details_of_issues'];
                            $issue_category =  $this->request->data['Dpmc']['issue_category'];
                            $issue_level =  $this->request->data['Dpmc']['issues_level'];
                            $decisions_taken=  $this->request->data['Dpmc']['decisions_taken']; 
                            $decision_details=  $this->request->data['Dpmc']['decision_details']; 
                            $issue_resolved=  $this->request->data['Dpmc']['issue_resolved']; 
                            $resolved_date=  $this->request->data['Dpmc']['resolved_date'];
                            $details_of_issues_resolved=  $this->request->data['Dpmc']['details_of_issues_resolved']; 
                           
                            $letter_to_higher_authority=  $this->request->data['Dpmc']['letter_to_higher_authority'];   
                            $remarks =  $this->request->data['Dpmc']['remarks'];
                          
                    $data=array (
                                'district'=>$district,
                                'meeting_date'=>$meeting_date,
                                'register_member' =>$register_member,
                                'other_participated' =>$other_participated,
                                'register_member_type'=>$res,
                                'meeting_facilitated_by'=> $meeting_facilitated_by,
                               // 'issue_shared_dpmc'=>$issue_shared_dpmc,
                                'details_of_issues'=>$details_of_issues,
                                'decisions_taken'=>$decisions_taken,
                                'decision_details'=>$decision_details,
                                'issue_resolved'=>$issue_resolved,
                                'resolved_date'=>$resolved_date,
                                'details_of_issues_resolved'=>$details_of_issues_resolved,
                                'issues_level'=>$issue_level,
                                'no_of_decision'=>$no_of_decision,
                                'solved_issue'=>$solved_issue,   
                                'issue_category'=>$issue_category,
                                'letter_to_higher_authority'=>$letter_to_higher_authority,
                                'updated'=>1,
                                'remarks'=>$remarks,
                                'id'=>$id
                               
                        
                                );  
			if ($this->Dpmc->save($data)) {
				$this->Session->setFlash(__('The Dpmc Meeting has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Dpmc could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Dpmc.' . $this->Dpmc->primaryKey => $id));
			$this->request->data = $this->Dpmc->find('first', $options);
			$executives=$this->User->find('list',array('conditions'=>array('User.status'=>'active','User.role'=>'regular')));

			}
                        
                   if(CakeSession::read('User.type')==='regular'){
		   $r = $this->Dpo->find('first',array('conditions'=>array('Dpo.first_name='.CakeSession::read('User.id'))));
                     $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Dpo']['district'])));
                      }
                else {
                    $cities=$this->City->find('list',array('order'=>array('name'=>'asc')));       
                }
		//$cities=$this->City->find('list');
                $desig=$this->Designation->find('list');
		$blocks=$this->Block->find('list');
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
		$this->Dpmc->id = $id;
		if (!$this->Dpmc->exists()) {
			throw new NotFoundException(__('Invalid Dpmc Detail'));
		}
		    //$this->request->onlyAllow('post', 'delete');
		    $this->Dpmc->read(null,$id);
			$this->Dpmc->set(array('status'=>$status));
		
		if ($this->Dpmc->save()) {
			$this->Session->setFlash(__('The Dpmc Meeting has been '.$status));
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
	$condition2.=' and Dpmc.id LIKE %'.$searchKey.'% || Dpmc.decisions_taken LIKE %'.$searchKey.'% Dpmc.issue_resolved LIKE %'.$searchKey.'% || Dpmc.details_of_issues LIKE %'.$searchKey.'%';
	
	}
	
	
	
	if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(Dpmc.meeting_date)>="'.$fromdate.'" and date(Dpmc.meeting_date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(Dpmc.meeting_date)="'.$fromdate.'"';
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
		if(isset($this->request->query['district']) and ($this->request->query['district']!=0) and ($this->request->query['district']!='')){$searchBlockId=trim($this->request->query['district']); //$condition['Enquiry.builder_id']=$searchBuilderId;
		$condition2.=' and Dpmc.district='.$searchBlockId;
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
                             $condition2.=' and Dpmc.block='.$searchProjectId;
		           }   else { 
                        ///$condition=['VhsncAfc.panchayat IN' =>explode(',',$r['Bpccc']['allocated_panchayat'])]; 
                         $condition2.=' and Dpmc.block IN ('.$r['Bpccc']['allocated_block'].')';
                      }
                      
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    //$condition['OR']=array('Geographical.id LIKE'=>'%'.$searchKey.'%','Geographical.ward LIKE'=>'%'.$searchKey.'%','Geographical.awc_code LIKE'=>'%'.$searchKey.'%','Geographical.awc_worker LIKE '=>'%'.$searchKey.'%','Geographical.asha_name LIKE '=>'%'.$searchKey.'%'); 
	$condition2.=' and Dpmc.id LIKE %'.$searchKey.'% || Dpmc.decisions_taken LIKE %'.$searchKey.'% Dpmc.issue_resolved LIKE %'.$searchKey.'% || Dpmc.details_of_issues LIKE %'.$searchKey.'%';
	
	}
	
                      if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(Dpmc.meeting_date)>="'.$fromdate.'" and date(Dpmc.meeting_date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(Dpmc.meeting_date)="'.$fromdate.'"';
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
		        $condition2.=' and Dpmc.block='.$searchBlockId;
		        }else {
                            
                       $condition2.=' and Dpmc.block IN ('.$r['Bpc']['allocated_block'].')';
                       
                      } 
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    //$condition['OR']=array('Geographical.id LIKE'=>'%'.$searchKey.'%','Geographical.ward LIKE'=>'%'.$searchKey.'%','Geographical.awc_code LIKE'=>'%'.$searchKey.'%','Geographical.awc_worker LIKE '=>'%'.$searchKey.'%','Geographical.asha_name LIKE '=>'%'.$searchKey.'%'); 
	$condition2.=' and Dpmc.id LIKE %'.$searchKey.'% || Dpmc.decisions_taken LIKE %'.$searchKey.'% Dpmc.issue_resolved LIKE %'.$searchKey.'% || Dpmc.details_of_issues LIKE %'.$searchKey.'%';
	
	}
	
                      if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(Dpmc.meeting_date)>="'.$fromdate.'" and date(Dpmc.meeting_date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(Dpmc.meeting_date)="'.$fromdate.'"';
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
                               $condition2.=' and Dpmc.district='.$searchBlockId;
		        // $condition['VhsncAfc.block']=$searchBlockId;
		        }else {
                       //$condition='VhsncAfc.district='.$r['Dpo']['district'];
                        $condition2.=' and Dpmc.district IN ('.$r['Dpo']['district'].')';
                        }
                        if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    //$condition['OR']=array('Geographical.id LIKE'=>'%'.$searchKey.'%','Geographical.ward LIKE'=>'%'.$searchKey.'%','Geographical.awc_code LIKE'=>'%'.$searchKey.'%','Geographical.awc_worker LIKE '=>'%'.$searchKey.'%','Geographical.asha_name LIKE '=>'%'.$searchKey.'%'); 
	$condition2.=' and Dpmc.id LIKE %'.$searchKey.'% || Dpmc.decisions_taken LIKE %'.$searchKey.'% Dpmc.issue_resolved LIKE %'.$searchKey.'% || Dpmc.details_of_issues LIKE %'.$searchKey.'%';
	
	}
	
                        if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(Dpmc.meeting_date)>="'.$fromdate.'" and date(Dpmc.meeting_date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(Dpmc.meeting_date)="'.$fromdate.'"';
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
		$condition2.=' and Dpmc.status="active"';
		$this->response->download("Dpmc.csv");
		//print_r($condition); exit;
	    $data=$this->Dpmc->query('select Dpmc.id,Dpmc.meeting_date,Dpmc.register_member,Issuecategory.name,Issuesubcat.name,Dpmc.other_participated,Resitermember.name,Meetingfacilitated.name,Dpmc.issue_shared_dpmc,Dpmc.details_of_issues,Dpmc.decisions_taken,City.name,Dpmc.decision_details,Dpmc.issue_resolved,Dpmc.details_of_issues_resolved,Dpmc.letter_to_higher_authority,Dpmc.status from dpmcs as Dpmc left join cities as City  on Dpmc.district=City.id left join issue_category as Issuecategory on Dpmc.issue_category=Issuecategory.id left join issue_subcategory as Issuesubcat on Dpmc.issues_level=Issuesubcat.id left join meeting_facilitateds as Meetingfacilitated on Dpmc.meeting_facilitated_by=Meetingfacilitated.id left join register_members as Resitermember on Dpmc.register_member_type=Resitermember.id  where 1 '.$condition2 );
		
		
		//$data = $this->Geographical->find('all', array('conditions'=>$condition2));
		
		//$log = $this->Enquiry->getDataSource()->getLog(false, false);
        //debug($log);
		//exit;
		
            $headers = array('Dpmc'=>array( 'Id' => 'Id','District' => 'District','Date of Meeting'=>'Date of Meeting','BPMC Registered Member Participated' => 'BPMC Registered Member Participated','Other Participated'=>'Other Participated','Type of Registered Member Participated'=>'Type of Registered Member Participated ','Meeting chaired by'=>'Meeting chaired by','Issues Shared in BPMC'=>'Issues Shared in BPMC','Details of Issues'=>'Details of Issues','Issue Category'=>'Issue Category','Issue Level'=>'Issue Level','Decisions Taken'=>'Decisions Taken','Decision Details'=>'Decision Details','Issue Resolved'=>'Issue Resolved','Describe Resolved Issue'=>'Describe Resolved Issue','No. of issues forwarded to higher authority'=>'No. of issues forwarded to higher authority','Status'=>'Status')); 
	    $this->set(compact('data','headers'));
		$this->layout = 'ajax';
		return;
		
		}
  ////  reports section ---/////          
	
	}
	
	
	
	
