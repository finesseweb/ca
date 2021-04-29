<?php
App::uses('AppController', 'Controller');
/**
 * Ngos Controller
 *
 * @property Ngo $GeographicalNgo
 * @property PaginatorComponent $Paginator
 */
class VhsncMeetingsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Upload');

    var  $uses = array('VhsncMeeting','Geographical','Ngo','User','RegisterMember','Village','Panchayat','MeetingFacilitated','Country','City','Block','Designation','Ward','IssueCategory','IssueSubcategory','Bpccc','Bpc','Dpo');
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
    $condition['OR']=array('VhsncMeeting.id LIKE'=>'%'.$searchKey.'%','VhsncMeeting.vhsnc_quorum_ompleted LIKE'=>'%'.$searchKey.'%','VhsncMeeting.decisions_taken LIKE'=>'%'.$searchKey.'%','VhsncMeeting.issue_resolved LIKE '=>'%'.$searchKey.'%','VhsncMeeting.issue_details LIKE '=>'%'.$searchKey.'%'); 
	
	}
		
		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(VhsncMeeting.meeting_date) >='=>$fromdate,'date(VhsncMeeting.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['VhsncMeeting.meeting_date']=$fromdate;	
				}
				
			}
		if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBuilderId=trim($this->request->query['block']); 
		$condition['VhsncMeeting.block']=$searchBuilderId;
		}
		if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchPanchayatId=trim($this->request->query['panchayat']); 
		$condition['VhsncMeeting.panchayat']=$searchPanchayatId;
		}
		
		if(isset($this->request->query['village']) and ($this->request->query['village']!=0) and ($this->request->query['village']!='')){$searchProjectId=trim($this->request->query['village']);
		$condition['VhsncMeeting.village']=$searchProjectId;
		}
//                if(isset($this->request->query['decisions']) and ($this->request->query['decisions']!=0) and ($this->request->query['decisions']!='')){$searchdecision=trim($this->request->query['decisions']); 
//		$condition['VhsncMeeting.decisions_taken']=$searchdecision;
//		}
//		
//		if(isset($this->request->query['issue_resolved']) and ($this->request->query['issue_resolved']!=0) and ($this->request->query['issue_resolved']!='')){$searchissue=trim($this->request->query['issue_resolved']);
//		$condition['VhsncMeeting.issue_resolved']=$searchissue;
//		}
//                if(isset($this->request->query['ward']) and ($this->request->query['ward']!=0) and ($this->request->query['ward']!='')){$searchProjectId=trim($this->request->query['ward']);
//		$condition['VhsncMeeting.ward']=$searchProjectId;
//		}
		
		
	}
         if(CakeSession::read('User.type')==='regular'){
             //echo CakeSession::read('User.subrole');
            // die();
             if(CakeSession::read('User.subrole')==='CC'){
		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'))));
                      if($r){
                           if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchPanchayatId=trim($this->request->query['panchayat']); 
		           $condition['VhsncMeeting.panchayat']=$searchPanchayatId;
		             
		          } else {
                       //$condition='VhsncMeeting.panchayat='.$r['Bpccc']['allocated_panchayat'];
                        $condition=['VhsncMeeting.panchayat IN' =>explode(',',$r['Bpccc']['allocated_panchayat'])];
                          }
                         if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('VhsncMeeting.id LIKE'=>'%'.$searchKey.'%','VhsncMeeting.vhsnc_quorum_ompleted LIKE'=>'%'.$searchKey.'%','VhsncMeeting.decisions_taken LIKE'=>'%'.$searchKey.'%','VhsncMeeting.issue_resolved LIKE '=>'%'.$searchKey.'%','VhsncMeeting.issue_details LIKE '=>'%'.$searchKey.'%'); 
	
	}
		
                          if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(VhsncMeeting.meeting_date) >='=>$fromdate,'date(VhsncMeeting.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['VhsncMeeting.meeting_date']=$fromdate;	
				}
				
			}   
                      } 
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Village yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
			//$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
			 $panchayats=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>['Panchayat.id IN'=>explode(',',$r['Bpccc']['allocated_panchayat'])]));
                   		
		}
                
                 elseif(CakeSession::read('User.subrole')==='BPC'){
		   $r = $this->Bpc->find('first',array('conditions'=>array('Bpc.first_name='.CakeSession::read('User.id'))));
                      if($r){ 
                          if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBuilderId=trim($this->request->query['block']); 
		           $condition['VhsncMeeting.block']=$searchBuilderId;
		            }
                            else {
                       //$condition='VhsncMeeting.block='.$r['Bpc']['allocated_block'];
                        $condition=['VhsncMeeting.block IN' =>explode(',',$r['Bpc']['allocated_block'])];
                            }
                            if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('VhsncMeeting.id LIKE'=>'%'.$searchKey.'%','VhsncMeeting.vhsnc_quorum_ompleted LIKE'=>'%'.$searchKey.'%','VhsncMeeting.decisions_taken LIKE'=>'%'.$searchKey.'%','VhsncMeeting.issue_resolved LIKE '=>'%'.$searchKey.'%','VhsncMeeting.issue_details LIKE '=>'%'.$searchKey.'%'); 
	
	}
		
                        if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(VhsncMeeting.meeting_date) >='=>$fromdate,'date(VhsncMeeting.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['VhsncMeeting.meeting_date']=$fromdate;	
				}
				
			}    
                      } 
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Village yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
			//$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
			$blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id IN'=>explode(',',$r['Bpc']['allocated_block']))));
                    	
		}
                
                
                 else {
		   $r = $this->Dpo->find('first',array('conditions'=>array('Dpo.first_name='.CakeSession::read('User.id'))));
                      if($r){ 
                          if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBuilderId=trim($this->request->query['block']); 
		           $condition['VhsncMeeting.block']=$searchBuilderId;
		            }else {
                       $condition='VhsncMeeting.district='.$r['Dpo']['district'];
                            }
                           if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('VhsncMeeting.id LIKE'=>'%'.$searchKey.'%','VhsncMeeting.vhsnc_quorum_ompleted LIKE'=>'%'.$searchKey.'%','VhsncMeeting.decisions_taken LIKE'=>'%'.$searchKey.'%','VhsncMeeting.issue_resolved LIKE '=>'%'.$searchKey.'%','VhsncMeeting.issue_details LIKE '=>'%'.$searchKey.'%'); 
	
	}
		 
                    
                            if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(VhsncMeeting.meeting_date) >='=>$fromdate,'date(VhsncMeeting.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['VhsncMeeting.meeting_date']=$fromdate;	
				}
				
			}   
                      } 
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Village yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
                      
			//$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
		       $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.city_id IN'=>explode(',',$r['Dpo']['district']))));
                   
               // $panchayats=$this->Panchayat->find('list');
               // $villages=$this->Village->find('list');		
		}
         }
         else if(CakeSession::read('User.type')==='user'){
	   $r = $this->Ngo->find('first',array('conditions'=>array('Ngo.chief_functionary_name='.CakeSession::read('User.id'))));
                 if($r){
                     $blo=array();
                   $blo= [$r['Ngo']['allocated_block_one'],$r['Ngo']['allocated_block_two']];
                     if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){
                              $searchBlockId=trim($this->request->query['block']);
		         $condition['VhsncMeeting.block']=$searchBlockId;
		        }else {
                            
                       $condition=['VhsncMeeting.block IN' =>$blo];
                       
                      } 
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('VhsncMeeting.id LIKE'=>'%'.$searchKey.'%','VhsncMeeting.vhsnc_quorum_ompleted LIKE'=>'%'.$searchKey.'%','VhsncMeeting.decisions_taken LIKE'=>'%'.$searchKey.'%','VhsncMeeting.issue_resolved LIKE '=>'%'.$searchKey.'%','VhsncMeeting.issue_details LIKE '=>'%'.$searchKey.'%'); 
	
	} 
        if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(VhsncMeeting.meeting_date) >='=>$fromdate,'date(VhsncMeeting.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['VhsncMeeting.meeting_date']=$fromdate;	
				}
				
			}
		
		}
                 $blocks=$this->Block->find('list',array('order' => array('name' => 'asc'),'conditions'=>array('Block.id IN'=>$blo)));
                 $ngos=$this->Ngo->find('list',array('conditions'=>array('Ngo.id'=>$r['Ngo']['id'])));
                     
         }else {
             $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc')));
             $panchayats=$this->Panchayat->find('list',array('order'=>array('name'=>'asc')));
              $villages=$this->Village->find('list',array('order'=>array('name'=>'asc')));
              //$ngos=$this->Ngo->find('list');
             
         }
	
		
		$this->Paginator->settings = array('VhsncMeeting' => array('limit' =>20,'group'=>array('meeting_date','panchayat'),'order' => array('id' => 'desc'),'conditions'=>array($condition,'VhsncMeeting.status'=>'active')));
		$this->VhsncMeeting->recursive = 0;
		$this->set('vhsncafcs', $this->Paginator->paginate());
		//$panchayats=$this->Panchayat->find('list');
               // $villages=$this->Village->find('list');
                $wards=$this->Ward->find('list');
                //$blocks=$this->Block->find('list');
			
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
		if (!$this->VhsncMeeting->exists($id)) {
			throw new NotFoundException(__('Invalid VHSNC Meeting'));
		}
		$options = array('conditions' => array('VhsncMeeting.' . $this->VhsncMeeting->primaryKey => $id));
		$this->set('vhsncAfc', $this->VhsncMeeting->find('first', $options));
		$this->layout='newdefault';
	}
        
        public function viewissue($id = null) {
//		if (!$this->VhsncMeeting->exists($id)) {
//			throw new NotFoundException(__('Invalid VHSNC Meeting'));
//		}
             $r = explode(',',$id);
//             print_r($r);
//             die();
		$options = array('conditions' => array('VhsncMeeting.panchayat' => $r['0'],'VhsncMeeting.meeting_date' => $r['1'],'VhsncMeeting.status' =>'active'));
		$this->set('vhsncAfcs', $this->VhsncMeeting->find('all', $options));
		$this->layout='newdefault';
	}
	
	
	public function report($id = null) {
		
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {




		if ($this->request->is('post')) {
			$this->VhsncMeeting->create();
                      //print_r($this->request->data);
                       
                       //print_r($this->request->data['VhsncMeeting']['register_member']);
                       $men= implode(',',$this->request->data['VhsncMeeting']['register_member']);
                       //echo $men;
                        //die();
                        for($i=0;$i<count($this->request->data['VhsncMeeting']['issue_category']);$i++){
                            
                            //echo $i;
                            //foreach($this->request->data['VhsncAfc']['member_name'] as $member) {
                                
                               // foreach($this->request->data['VhsncAfc']['mobile'] as $mobile) {
                                   // foreach($this->request->data['VhsncAfc']['induction_training_date'] as $induction_training_date) {
                                    //foreach($this->request->data['VhsncAfc']['refresher_date'] as $refresher_date) {
                          //print_r($mobile);
                          //die();
                           
                            $district =  $this->request->data['VhsncMeeting']['district'];
                            $block =  $this->request->data['VhsncMeeting']['block'];
                            $panchayat =  $this->request->data['VhsncMeeting']['panchayat'];
                            $village =  $this->request->data['VhsncMeeting']['village'];
                            $ward =  $this->request->data['VhsncMeeting']['ward'];
                            $meeting_date =  date('Y-m-d',strtotime($this->request->data['VhsncMeeting']['meeting_date']));
                            $vhsnc_quorum_ompleted =  $this->request->data['VhsncMeeting']['vhsnc_quorum_ompleted'];
                           // $register_member =  $this->request->data['VhsncMeeting']['register_member'];
                            $register_member=$men;
                            $meeting_facilitated =  $this->request->data['VhsncMeeting']['meeting_facilitated'];
                            $new_issue =  $this->request->data['VhsncMeeting']['new_issue'];
                            $decision_taken =  $this->request->data['VhsncMeeting']['decision_taken'];
                            $solved_issue =  $this->request->data['VhsncMeeting']['solved_issue'];
                            $issue_category =  $this->request->data['VhsncMeeting']['issue_category'][$i];
                            $issue_level =  $this->request->data['VhsncMeeting']['issue_level'][$i];
                            $issue_details =  $this->request->data['VhsncMeeting']['issue_details'][$i];
                            $decisions_taken = $this->request->data['VhsncMeeting']['decisions_taken'][$i];
                            $decision_details = $this->request->data['VhsncMeeting']['decision_details'][$i];
                           $issue_resolved = $this->request->data['VhsncMeeting']['issue_resolved'][$i];
                           $issue_resolved_date =  date('Y-m-d',strtotime($this->request->data['VhsncMeeting']['issue_resolved_date'][$i]));
                           $issue_remarks =  $this->request->data['VhsncMeeting']['issue_remarks'][$i];
                           $letter_issued_bpmc =  $this->request->data['VhsncMeeting']['letter_issued_bpmc'][$i];
                    $data=array (
                                'district'=>$district,
                                'block'=>$block,
                                'panchayat'=>$panchayat,
                                'village'=>$village,
                                'ward' =>$ward,
                                'meeting_date' =>$meeting_date,
                                'vhsnc_quorum_ompleted'=>$vhsnc_quorum_ompleted,
                                'register_member'=> $register_member,
                                'meeting_facilitated'=>$meeting_facilitated,
                                'new_issue'=>$new_issue,
                                'decision_taken'=>$decision_taken,
                                'solved_issue'=>$solved_issue,
                                'issue_category'=>$issue_category,
                                'issue_level'=>$issue_level,
                                'issue_details'=>$issue_details,
                                'decisions_taken'=>$decisions_taken,
                                'decision_details'=>$decision_details,
                                'issue_resolved'=>$issue_resolved,
                                'issue_resolved_date'=>$issue_resolved_date,
                                'issue_remarks'=>$issue_remarks,
                        	'letter_issued_bpmc'=>$letter_issued_bpmc,
                                'updated'=>0
                        
                                );  
                    
                           $save=$this->VhsncMeeting->saveAll($data);
				
                         }///} } }   
                         
                             
                         if($save) {
                         $this->Session->setFlash(__('The VHSNC Meeting has been saved.'));
				return $this->redirect(array('action' => 'index'));

                        } else {
				$this->Session->setFlash(__('The Vhsnc Meeting could not be saved. Please, try again.'));
			}
			
                    }   
                 if(CakeSession::read('User.type')==='regular'){
                     
                     if(CakeSession::read('User.subrole')==='CC'){
		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'))));
                          
	            $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Bpccc']['allocated_district'])));
                    $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id'=>$r['Bpccc']['allocated_block'])));
                    $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Panchayat.id IN'=>explode(',',$r['Bpccc']['allocated_panchayat']))));
                    $village=$this->Village->find('list',array('order'=>array('name'=>'asc')));
				
		}
                
                 elseif(CakeSession::read('User.subrole')==='BPC'){
		  $r = $this->Bpc->find('first',array('conditions'=>array('Bpc.first_name='.CakeSession::read('User.id'))));
                       
	            $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Bpc']['allocated_district'])));
                    $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id IN'=>explode(',',$r['Bpc']['allocated_block']))));
                    $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc')));
                    $village=$this->Village->find('list',array('order'=>array('name'=>'asc')));
		}
                
                
                 else {
		  $r = $this->Dpo->find('first',array('conditions'=>array('Dpo.first_name='.CakeSession::read('User.id'))));
                         
	            $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Dpo']['district'])));
                   $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc')));
                    $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc')));
                    $village=$this->Village->find('list',array('order'=>array('name'=>'asc')));
		}
		   }
                else {
                    $cities=$this->City->find('list',array('order'=>array('name'=>'asc')));
                    $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc')));
                    $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc')));
                    $village=$this->Village->find('list',array('order'=>array('name'=>'asc')));
                }
		//$executives=$this->User->find('list',array('conditions'=>array('User.status'=>'active','User.role'=>'regular')));
		
                $desig=$this->Designation->find('list');
		$reg=$this->RegisterMember->find('list');
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
		if (!$this->VhsncMeeting->exists($id)) {
			throw new NotFoundException(__('Invalid VhsncAfc'));
		}
		if ($this->request->is(array('post', 'put'))) {
                    
                   // print_r($this->request->data);
                   // die();
                         $men= implode(',',$this->request->data['VhsncMeeting']['register_member']);
                          
                          $district =  $this->request->data['VhsncMeeting']['district'];
                            $block =  $this->request->data['VhsncMeeting']['block'];
                          $panchayat =  $this->request->data['VhsncMeeting']['panchayat'];
                            $village =  $this->request->data['VhsncMeeting']['village'];
                            $ward =  $this->request->data['VhsncMeeting']['ward'];
                            $meeting_date =  date('Y-m-d',strtotime($this->request->data['VhsncMeeting']['meeting_date']));
                            $vhsnc_quorum_ompleted =  $this->request->data['VhsncMeeting']['vhsnc_quorum_ompleted'];
                            $register_member=$men;
                            //$register_member =  $this->request->data['VhsncMeeting']['register_member'];
                            $meeting_facilitated =  $this->request->data['VhsncMeeting']['meeting_facilitated'];
                          //  $new_issue =  $this->request->data['VhsncMeeting']['new_issue'];
                            $decision_taken =  $this->request->data['VhsncMeeting']['decision_taken'];
                            $solved_issue =  $this->request->data['VhsncMeeting']['solved_issue'];
                            $issue_category =  $this->request->data['VhsncMeeting']['issue_category'];
                            $issue_level =  $this->request->data['VhsncMeeting']['issue_level'];
                            $issue_details =  $this->request->data['VhsncMeeting']['issue_details'];
                            $decisions_taken = $this->request->data['VhsncMeeting']['decisions_taken'];
                            $decision_details = $this->request->data['VhsncMeeting']['decision_details'];
                           $issue_resolved = $this->request->data['VhsncMeeting']['issue_resolved'];
                           if($this->request->data['VhsncMeeting']['issue_resolved']=='no') {
                               $updated='0';
                               
                           }else {
                               $updated='1';
                           }
                           $issue_resolved_date =  date('Y-m-d',strtotime($this->request->data['VhsncMeeting']['issue_resolved_date']));
                           $issue_remarks =  $this->request->data['VhsncMeeting']['issue_remarks'];
                           $letter_issued_bpmc =  $this->request->data['VhsncMeeting']['letter_issued_bpmc'];
                           $status = $this->request->data['VhsncMeeting']['status'];
                    $data=array (
                                'district'=>$district,
                                'block'=>$block,
                                'panchayat'=>$panchayat,
                                'village'=>$village,
                                'ward' =>$ward,
                                'meeting_date' =>$meeting_date,
                                'vhsnc_quorum_ompleted'=>$vhsnc_quorum_ompleted,
                                'register_member'=> $register_member,
                                'meeting_facilitated'=>$meeting_facilitated,
                                //'new_issue'=>$new_issue,
                                'decision_taken'=>$decision_taken,
                                'solved_issue'=>$solved_issue,
                                'issue_category'=>$issue_category,
                                'issue_level'=>$issue_level,
                                'issue_details'=>$issue_details,
                                'decisions_taken'=>$decisions_taken,
                                'decision_details'=>$decision_details,
                                'issue_resolved'=>$issue_resolved,
                                'issue_resolved_date'=>$issue_resolved_date,
                                'issue_remarks'=>$issue_remarks,
                        	'letter_issued_bpmc'=>$letter_issued_bpmc,
                                'status'=>$status,
                                 'updated'=>$updated,
                                 'id'=>$id
                        
                                );  
			if ($this->VhsncMeeting->save($data)) {
				$this->Session->setFlash(__('The Vhsnc Meeting has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Vhsnc/Afc could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('VhsncMeeting.' . $this->VhsncMeeting->primaryKey => $id));
			$this->request->data = $this->VhsncMeeting->find('first', $options);
			$executives=$this->User->find('list',array('conditions'=>array('User.status'=>'active','User.role'=>'regular')));

			}
                         if(CakeSession::read('User.type')==='regular'){
                     
                     if(CakeSession::read('User.subrole')==='CC'){
		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'))));
                       
                      
	            $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Bpccc']['allocated_district'])));
                    $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id'=>$r['Bpccc']['allocated_block'])));
                    $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Panchayat.id IN'=>explode(',',$r['Bpccc']['allocated_panchayat']))));
                  
                    if($this->request->data['VhsncMeeting']['panchayat']!=0 and $this->request->data['VhsncMeeting']['panchayat']!='')
			{
		     $village=$this->Village->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Village.panchayat_id'=>$this->request->data['VhsncMeeting']['panchayat'])));
		    }
                    else {
                         $village=$this->Village->find('list',array('order'=>array('name'=>'asc')));
                    }
                 
				
		}
                
                 elseif(CakeSession::read('User.subrole')==='BPC'){
		  $r = $this->Bpc->find('first',array('conditions'=>array('Bpc.first_name='.CakeSession::read('User.id'))));
                       
                     
	            $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Bpc']['allocated_district'])));
                   $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id IN'=>explode(',',$r['Bpc']['allocated_block']))));
                    if($this->request->data['VhsncMeeting']['panchayat']!=0 and $this->request->data['VhsncMeeting']['panchayat']!='')
			{
		     $village=$this->Village->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Village.panchayat_id'=>$this->request->data['VhsncMeeting']['panchayat'])));
		    }
                    else {
                         $village=$this->Village->find('list',array('order'=>array('name'=>'asc')));
                    }                 
                    if($this->request->data['VhsncMeeting']['panchayat']!=0 and $this->request->data['VhsncMeeting']['panchayat']!='')
			{
		     $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Panchayat.id'=>$this->request->data['VhsncMeeting']['panchayat'])));
		    }
                    else {
                      $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc')));
                    }
                  
                  // $panchayat=$this->Panchayat->find('list');
                  //  $village=$this->Village->find('list');
		}
                
                
                 else {
		  $r = $this->Dpo->find('first',array('conditions'=>array('Dpo.first_name='.CakeSession::read('User.id'))));
                         
	            $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Dpo']['district'])));
                   
                     if($this->request->data['VhsncMeeting']['block']!=0 and $this->request->data['VhsncMeeting']['block']!='')
			{
		     $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id'=>$this->request->data['VhsncMeeting']['block'])));
		    }
                    else {
                        $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),));
                    } 
                    
                   if($this->request->data['VhsncMeeting']['panchayat']!=0 and $this->request->data['VhsncMeeting']['panchayat']!='')
			{
		     $village=$this->Village->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Village.panchayat_id'=>$this->request->data['VhsncMeeting']['panchayat'])));
		    }
                    else {
                         $village=$this->Village->find('list',array('order'=>array('name'=>'asc')));
                    }                 
                    if($this->request->data['VhsncMeeting']['panchayat']!=0 and $this->request->data['VhsncMeeting']['panchayat']!='')
			{
		     $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Panchayat.id'=>$this->request->data['VhsncMeeting']['panchayat'])));
		    }
                    else {
                      $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc')));
                    }
		}
		   }
                else {
                    $cities=$this->City->find('list',array('order'=>array('name'=>'asc')));
                    if($this->request->data['VhsncMeeting']['block']!=0 and $this->request->data['VhsncMeeting']['block']!='')
			{
		     $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id'=>$this->request->data['VhsncMeeting']['block'])));
		    }
                    else {
                        $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc')));
                    } 
                    
                   if($this->request->data['VhsncMeeting']['panchayat']!=0 and $this->request->data['VhsncMeeting']['panchayat']!='')
			{
		     $village=$this->Village->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Village.panchayat_id'=>$this->request->data['VhsncMeeting']['panchayat'])));
		    }
                    else {
                         $village=$this->Village->find('list',array('order'=>array('name'=>'asc')));
                    }                 
                    if($this->request->data['VhsncMeeting']['panchayat']!=0 and $this->request->data['VhsncMeeting']['panchayat']!='')
			{
		     $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Panchayat.id'=>$this->request->data['VhsncMeeting']['panchayat'])));
		    }
                    else {
                      $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc')));
                    }
                }
		//$cities=$this->City->find('list');
                $desig=$this->Designation->find('list');
		//$blocks=$this->Block->find('list');
		$reg=$this->RegisterMember->find('list');
                //$panchayat=$this->Panchayat->find('list');
                //$village=$this->Village->find('list');
                $ward=$this->Ward->find('list');
                $issue=$this->IssueCategory->find('list');
                $subissue=$this->IssueSubcategory->find('list');
                $facilitated=$this->MeetingFacilitated->find('list');
                
		$this->set(compact('panchayat','cities','reg','blocks','desig','village','facilitated','ward','issue','subissue'));
	
	}
	
	
	
	

	
	public function delete($id = null,$status='deactive') {
		$this->VhsncMeeting->id = $id;
		if (!$this->VhsncMeeting->exists()) {
			throw new NotFoundException(__('Invalid Vhsnc/Afc Detail'));
		}
		    //$this->request->onlyAllow('post', 'delete');
		    $this->VhsncMeeting->read(null,$id);
			$this->VhsncMeeting->set(array('status'=>$status));
		
		if ($this->VhsncMeeting->save()) {
			$this->Session->setFlash(__('The Vhsnc Meeting has been '.$status));
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
        
        public function getissue() {
	  
		$subcatlist=$this->VhsncMeeting->query("select * from vhsnc_meetings where issue_resolved='yes' order by id desc");
		
		return $subcatlist;
	}
        public function getissuetitle($id) {
	  
		$subcatlist=$this->VhsncMeeting->query("select * from vhsnc_meetings where issue_resolved='yes' and id='$id' order by id desc");
		
		return $subcatlist;
	}
        public function getissues($id,$date=null) {
	  
		 $issuecount = $this->VhsncMeeting->find('all',array('fields' => array('sum(VhsncMeeting.new_issue) AS ctotal'),'conditions'=>array('VhsncMeeting.panchayat'=>$id,'VhsncMeeting.meeting_date'=>$date,'VhsncMeeting.status'=>'active')));
              
		return $issuecount;
	}
        
        
        public function reviewissue() {
		
		$data='';$searchKey=null;$searchUserId=null;$searchBuilderId=null;$searchProjectId=null;$fromdate=null;$todate=null;
		$condition='';$querySrting=''; $condition=array();
		$conc='';
		
		if(isset($this->params->query['confirm'])) {
	   
		if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('VhsncMeeting.id LIKE'=>'%'.$searchKey.'%','VhsncMeeting.vhsnc_quorum_ompleted LIKE'=>'%'.$searchKey.'%','VhsncMeeting.decisions_taken LIKE'=>'%'.$searchKey.'%','VhsncMeeting.issue_resolved LIKE '=>'%'.$searchKey.'%','VhsncMeeting.issue_details LIKE '=>'%'.$searchKey.'%'); 
	
	}
		
		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(VhsncMeeting.meeting_date) >='=>$fromdate,'date(VhsncMeeting.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['VhsncMeeting.meeting_date']=$fromdate;	
				}
				
			}
		
		if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchBuilderId=trim($this->request->query['panchayat']); 
		$condition['VhsncMeeting.panchayat']=$searchBuilderId;
		}
		
		if(isset($this->request->query['village']) and ($this->request->query['village']!=0) and ($this->request->query['village']!='')){$searchProjectId=trim($this->request->query['village']);
		$condition['VhsncMeeting.village']=$searchProjectId;
		}
                if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchProjectId=trim($this->request->query['block']);
		$condition['VhsncMeeting.block']=$searchProjectId;
		}
		
		
		
	}
         if(CakeSession::read('User.type')==='regular'){
             //echo CakeSession::read('User.subrole');
            // die();
             if(CakeSession::read('User.subrole')==='CC'){
		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'))));
                      if($r){
                          
                          if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchPanchayatId=trim($this->request->query['panchayat']); 
		           $condition['VhsncMeeting.panchayat']=$searchPanchayatId;
		             
                      } else {
                       //$condition='VhsncMeeting.panchayat='.$r['Bpccc']['allocated_panchayat'];
                        $condition=['VhsncMeeting.panchayat IN' =>explode(',',$r['Bpccc']['allocated_panchayat'])];
                         }
                         if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('VhsncMeeting.id LIKE'=>'%'.$searchKey.'%','VhsncMeeting.vhsnc_quorum_ompleted LIKE'=>'%'.$searchKey.'%','VhsncMeeting.decisions_taken LIKE'=>'%'.$searchKey.'%','VhsncMeeting.issue_resolved LIKE '=>'%'.$searchKey.'%','VhsncMeeting.issue_details LIKE '=>'%'.$searchKey.'%'); 
	
	} 
                      if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(VhsncMeeting.meeting_date) >='=>$fromdate,'date(VhsncMeeting.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['VhsncMeeting.meeting_date']=$fromdate;	
				}
				
			}
                      } 
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Village yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
			//$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
			 $panchayats=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>['Panchayat.id IN'=>explode(',',$r['Bpccc']['allocated_panchayat'])]));
                   		
		}
                
                 elseif(CakeSession::read('User.subrole')==='BPC'){
		   $r = $this->Bpc->find('first',array('conditions'=>array('Bpc.first_name='.CakeSession::read('User.id'))));
                      if($r){ 
                          
                          if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBuilderId=trim($this->request->query['block']); 
		           $condition['VhsncMeeting.block']=$searchBuilderId;
		            } else {
                       //$condition='VhsncMeeting.block='.$r['Bpc']['allocated_block'];
                        $condition=['VhsncMeeting.block IN' =>explode(',',$r['Bpc']['allocated_block'])];
                            }
                            if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('VhsncMeeting.id LIKE'=>'%'.$searchKey.'%','VhsncMeeting.vhsnc_quorum_ompleted LIKE'=>'%'.$searchKey.'%','VhsncMeeting.decisions_taken LIKE'=>'%'.$searchKey.'%','VhsncMeeting.issue_resolved LIKE '=>'%'.$searchKey.'%','VhsncMeeting.issue_details LIKE '=>'%'.$searchKey.'%'); 
	
	} 
                       if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(VhsncMeeting.meeting_date) >='=>$fromdate,'date(VhsncMeeting.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['VhsncMeeting.meeting_date']=$fromdate;	
				}
				
			}     
                            } 
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Village yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
			//$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
			$blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id IN'=>explode(',',$r['Bpc']['allocated_block']))));
                    		
		}
                
                
                 else {
		   $r = $this->Dpo->find('first',array('conditions'=>array('Dpo.first_name='.CakeSession::read('User.id'))));
                      if($r){
                          if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBuilderId=trim($this->request->query['block']); 
		           $condition['VhsncMeeting.block']=$searchBuilderId;
		            } else {
                       $condition='VhsncMeeting.district='.$r['Dpo']['district'];
                            }
                            if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('VhsncMeeting.id LIKE'=>'%'.$searchKey.'%','VhsncMeeting.vhsnc_quorum_ompleted LIKE'=>'%'.$searchKey.'%','VhsncMeeting.decisions_taken LIKE'=>'%'.$searchKey.'%','VhsncMeeting.issue_resolved LIKE '=>'%'.$searchKey.'%','VhsncMeeting.issue_details LIKE '=>'%'.$searchKey.'%'); 
	
	} 
                      if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(VhsncMeeting.meeting_date) >='=>$fromdate,'date(VhsncMeeting.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['VhsncMeeting.meeting_date']=$fromdate;	
				}
				
			}} 
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Village yet'));
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
		         $condition['VhsncMeeting.block']=$searchBlockId;
		        }else {
                            
                       $condition=['VhsncMeeting.block IN' =>$blo];
                       
                      } 
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('VhsncMeeting.id LIKE'=>'%'.$searchKey.'%','VhsncMeeting.vhsnc_quorum_ompleted LIKE'=>'%'.$searchKey.'%','VhsncMeeting.decisions_taken LIKE'=>'%'.$searchKey.'%','VhsncMeeting.issue_resolved LIKE '=>'%'.$searchKey.'%','VhsncMeeting.issue_details LIKE '=>'%'.$searchKey.'%'); 
	
	} 
                      if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(VhsncMeeting.meeting_date) >='=>$fromdate,'date(VhsncMeeting.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['VhsncMeeting.meeting_date']=$fromdate;	
				}
				
			}
		}
                 $blocks=$this->Block->find('list',array('order' => array('name' => 'asc'),'conditions'=>array('Block.id IN'=>$blo)));
                 $ngos=$this->Ngo->find('list',array('conditions'=>array('Ngo.id'=>$r['Ngo']['id'])));
                     
         }
         else {
                    $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc')));
                    $panchayats=$this->Panchayat->find('list',array('order'=>array('name'=>'asc')));
                    $villages=$this->Village->find('list',array('order'=>array('name'=>'asc')));
         }
		
		$this->Paginator->settings = array('VhsncMeeting' => array('limit' =>20,'order' => array('updated' => 'asc','id'=>'desc'),'conditions'=>array($condition,'VhsncMeeting.status'=>'active','VhsncMeeting.updated'=>'0')));
		$this->VhsncMeeting->recursive = 0;
		$this->set('vhsncafcs', $this->Paginator->paginate());
		
                $wards=$this->Ward->find('list');
			
//			$users = $this->User->find('list',array('fields'=>array('parent'),'conditions'=>array('status'=>'active')));
//			$builders=$this->Builder->find('list');
			$this->set(compact('panchayats','villages','wards','blocks'));
			
	}
        
        
         public function revieresolved() {
		
		$data='';$searchKey=null;$searchUserId=null;$searchBuilderId=null;$searchProjectId=null;$fromdate=null;$todate=null;
		$condition='';$querySrting=''; $condition=array();
		$conc='';
		
		if(isset($this->params->query['confirm'])) {
	   
		if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('VhsncMeeting.id LIKE'=>'%'.$searchKey.'%','VhsncMeeting.vhsnc_quorum_ompleted LIKE'=>'%'.$searchKey.'%','VhsncMeeting.decisions_taken LIKE'=>'%'.$searchKey.'%','VhsncMeeting.issue_resolved LIKE '=>'%'.$searchKey.'%','VhsncMeeting.issue_details LIKE '=>'%'.$searchKey.'%'); 
	
	}
		
		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(VhsncMeeting.meeting_date) >='=>$fromdate,'date(VhsncMeeting.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['VhsncMeeting.meeting_date']=$fromdate;	
				}
				
			}
		
		if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchBuilderId=trim($this->request->query['panchayat']); 
		$condition['VhsncMeeting.panchayat']=$searchBuilderId;
		}
		
		if(isset($this->request->query['village']) and ($this->request->query['village']!=0) and ($this->request->query['village']!='')){$searchProjectId=trim($this->request->query['village']);
		$condition['VhsncMeeting.village']=$searchProjectId;
		}
                if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchProjectId=trim($this->request->query['block']);
		$condition['VhsncMeeting.block']=$searchProjectId;
		}
		
		
	}
         if(CakeSession::read('User.type')==='regular'){
             //echo CakeSession::read('User.subrole');
            // die();
             if(CakeSession::read('User.subrole')==='CC'){
		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'))));
                      if($r){ 
                          
                           if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchPanchayatId=trim($this->request->query['panchayat']); 
		           $condition['VhsncMeeting.panchayat']=$searchPanchayatId;
		             
                      } else {
                       //$condition='VhsncMeeting.panchayat='.$r['Bpccc']['allocated_panchayat'];
                        $condition=['VhsncMeeting.panchayat IN' =>explode(',',$r['Bpccc']['allocated_panchayat'])];
                      }
                        if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('VhsncMeeting.id LIKE'=>'%'.$searchKey.'%','VhsncMeeting.vhsnc_quorum_ompleted LIKE'=>'%'.$searchKey.'%','VhsncMeeting.decisions_taken LIKE'=>'%'.$searchKey.'%','VhsncMeeting.issue_resolved LIKE '=>'%'.$searchKey.'%','VhsncMeeting.issue_details LIKE '=>'%'.$searchKey.'%'); 
	
	} 
                        if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(VhsncMeeting.meeting_date) >='=>$fromdate,'date(VhsncMeeting.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['VhsncMeeting.meeting_date']=$fromdate;	
				}
				
			}
                       
                      }
                      
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Village yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
			//$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
			 $panchayats=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>['Panchayat.id IN'=>explode(',',$r['Bpccc']['allocated_panchayat'])]));
                   		
		}
                
                 elseif(CakeSession::read('User.subrole')==='BPC'){
		   $r = $this->Bpc->find('first',array('conditions'=>array('Bpc.first_name='.CakeSession::read('User.id'))));
                      if($r){ 
                       if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBuilderId=trim($this->request->query['block']); 
		           $condition['VhsncMeeting.block']=$searchBuilderId;
		            }
                             else {
                        $condition=['VhsncMeeting.block IN' =>explode(',',$r['Bpc']['allocated_block'])];
                             }
                        if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('VhsncMeeting.id LIKE'=>'%'.$searchKey.'%','VhsncMeeting.vhsnc_quorum_ompleted LIKE'=>'%'.$searchKey.'%','VhsncMeeting.decisions_taken LIKE'=>'%'.$searchKey.'%','VhsncMeeting.issue_resolved LIKE '=>'%'.$searchKey.'%','VhsncMeeting.issue_details LIKE '=>'%'.$searchKey.'%'); 
	
	} 
                        if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(VhsncMeeting.meeting_date) >='=>$fromdate,'date(VhsncMeeting.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['VhsncMeeting.meeting_date']=$fromdate;	
				}
				
			}
                                             }
                      
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Village yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
			//$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
			  $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id IN'=>explode(',',$r['Bpc']['allocated_block']))));
                    		
		}
                
                
                 else {
		   $r = $this->Dpo->find('first',array('conditions'=>array('Dpo.first_name='.CakeSession::read('User.id'))));
                      if($r){ 
                          if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBuilderId=trim($this->request->query['block']); 
		           $condition['VhsncMeeting.block']=$searchBuilderId;
		            } else {
                       $condition='VhsncMeeting.district='.$r['Dpo']['district'];
                            }
                       if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('VhsncMeeting.id LIKE'=>'%'.$searchKey.'%','VhsncMeeting.vhsnc_quorum_ompleted LIKE'=>'%'.$searchKey.'%','VhsncMeeting.decisions_taken LIKE'=>'%'.$searchKey.'%','VhsncMeeting.issue_resolved LIKE '=>'%'.$searchKey.'%','VhsncMeeting.issue_details LIKE '=>'%'.$searchKey.'%'); 
	
	} 
                       if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(VhsncMeeting.meeting_date) >='=>$fromdate,'date(VhsncMeeting.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['VhsncMeeting.meeting_date']=$fromdate;	
				}
				
			}
                       
                      } 
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Village yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
			//$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
	        $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.city_id IN'=>explode(',',$r['Dpo']['district']))));
                 	
		}
         } else if(CakeSession::read('User.type')==='user'){
	   $r = $this->Ngo->find('first',array('conditions'=>array('Ngo.chief_functionary_name='.CakeSession::read('User.id'))));
                 if($r){
                     $blo=array();
                   $blo= [$r['Ngo']['allocated_block_one'],$r['Ngo']['allocated_block_two']];
                     if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){
                              $searchBlockId=trim($this->request->query['block']);
		         $condition['VhsncMeeting.block']=$searchBlockId;
		        }else {
                            
                       $condition=['VhsncMeeting.block IN' =>$blo];
                       
                      } 
		
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('VhsncMeeting.id LIKE'=>'%'.$searchKey.'%','VhsncMeeting.vhsnc_quorum_ompleted LIKE'=>'%'.$searchKey.'%','VhsncMeeting.decisions_taken LIKE'=>'%'.$searchKey.'%','VhsncMeeting.issue_resolved LIKE '=>'%'.$searchKey.'%','VhsncMeeting.issue_details LIKE '=>'%'.$searchKey.'%'); 
	
	} 
                      if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(VhsncMeeting.meeting_date) >='=>$fromdate,'date(VhsncMeeting.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['VhsncMeeting.meeting_date']=$fromdate;	
				}
				
			}
                     
                        }
                 $blocks=$this->Block->find('list',array('order' => array('name' => 'asc'),'conditions'=>array('Block.id IN'=>$blo)));
                 $ngos=$this->Ngo->find('list',array('conditions'=>array('Ngo.id'=>$r['Ngo']['id'])));
                     
         } else {
                 $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc')));
                $panchayats=$this->Panchayat->find('list',array('order'=>array('name'=>'asc')));
                $villages=$this->Village->find('list',array('order'=>array('name'=>'asc')));
               
         }
		
		$this->Paginator->settings = array('VhsncMeeting' => array('limit' =>20,'order' => array('updated' => 'asc','id'=>'desc'),'conditions'=>array($condition,'VhsncMeeting.status'=>'active','VhsncMeeting.updated'=>'1','VhsncMeeting.issue_resolved !='=>'no')));
		$this->VhsncMeeting->recursive = 0;
		$this->set('vhsncafcs', $this->Paginator->paginate());
		 $wards=$this->Ward->find('list');
			
//			$users = $this->User->find('list',array('fields'=>array('parent'),'conditions'=>array('status'=>'active')));
//			$builders=$this->Builder->find('list');
			$this->set(compact('panchayats','villages','wards','blocks'));
			
	}
    public function editissue($id = null) {
		if (!$this->VhsncMeeting->exists($id)) {
			throw new NotFoundException(__('Invalid VhsncAfc'));
		}
                 //print_r($this->request->data);
		if ($this->request->is(array('post', 'put'))) {
                         //$men= implode(',',$this->request->data['VhsncMeeting']['register_member']);
                          //print_r($this->request->data);
                          //die();
//                          $district =  $this->request->data['VhsncMeeting']['district'];
//                            $block =  $this->request->data['VhsncMeeting']['block'];
//                          $panchayat =  $this->request->data['VhsncMeeting']['panchayat'];
//                            $village =  $this->request->data['VhsncMeeting']['village'];
//                            $ward =  $this->request->data['VhsncMeeting']['ward'];
                            $meeting_date =  date('Y-m-d',strtotime($this->request->data['VhsncMeeting']['meeting_date']));
                           // $vhsnc_quorum_ompleted =  $this->request->data['VhsncMeeting']['vhsnc_quorum_ompleted'];
                            //$register_member=$men;
                            //$register_member =  $this->request->data['VhsncMeeting']['register_member'];
                            //$meeting_facilitated =  $this->request->data['VhsncMeeting']['meeting_facilitated'];
                          //  $new_issue =  $this->request->data['VhsncMeeting']['new_issue'];
                             
                           
                            
                            if($this->request->data['VhsncMeeting']['decisions_taken']=='yes'){
                                $decision_taken =  $this->request->data['VhsncMeeting']['decision_taken']+1;
                            }
                            else {
                               $decision_taken =  $this->request->data['VhsncMeeting']['decision_taken']; 
                            }
                            if($this->request->data['VhsncMeeting']['issue_resolved']=='yes'){
                                $solved_issue =  $this->request->data['VhsncMeeting']['solved_issue']+1;
                            }
                            else {
                                  $solved_issue =  $this->request->data['VhsncMeeting']['solved_issue'];
                            }
                            $issue_category =  $this->request->data['VhsncMeeting']['issue_category'];
                            $issue_level =  $this->request->data['VhsncMeeting']['issue_level'];
                            $issue_details =  $this->request->data['VhsncMeeting']['issue_details'];
                            $decisions_taken = $this->request->data['VhsncMeeting']['decisions_taken'];
                            $decision_details = $this->request->data['VhsncMeeting']['decision_details'];
                           $issue_resolved = $this->request->data['VhsncMeeting']['issue_resolved'];
                           if($this->request->data['VhsncMeeting']['issue_resolved']=='no') {
                               $updated='0';
                               
                           }else {
                               $updated='1';
                           }
                           $issue_resolved_date =  date('Y-m-d',strtotime($this->request->data['VhsncMeeting']['issue_resolved_date']));
                           $issue_remarks =  $this->request->data['VhsncMeeting']['issue_remarks'];
                           $letter_issued_bpmc =  $this->request->data['VhsncMeeting']['letter_issued_bpmc'];
                           $status =  $this->request->data['VhsncMeeting']['status'];
                    $data=array (
                                //'district'=>$district,
                                //'block'=>$block,
                                //'panchayat'=>$panchayat,
                                //'village'=>$village,
                                //'ward' =>$ward,
                                'meeting_date' =>$meeting_date,
                                //'vhsnc_quorum_ompleted'=>$vhsnc_quorum_ompleted,
                                //'register_member'=> $register_member,
                                //'meeting_facilitated'=>$meeting_facilitated,
                                //'new_issue'=>$new_issue,
                                'decision_taken'=>$decision_taken,
                                'solved_issue'=>$solved_issue,
                                'issue_category'=>$issue_category,
                                'issue_level'=>$issue_level,
                                'issue_details'=>$issue_details,
                                'decisions_taken'=>$decisions_taken,
                                'decision_details'=>$decision_details,
                                'issue_resolved'=>$issue_resolved,
                                'issue_resolved_date'=>$issue_resolved_date,
                                'issue_remarks'=>$issue_remarks,
                        	'letter_issued_bpmc'=>$letter_issued_bpmc,
                                'status'=>$status,
                                 'updated'=>$updated,
                                 'id'=>$id
                        
                                );  
			if ($this->VhsncMeeting->save($data)) {
				$this->Session->setFlash(__('The Vhsnc Meeting has been saved.'));
				return $this->redirect(array('action' => 'reviewissue'));
			} else {
				$this->Session->setFlash(__('The Vhsnc/Afc could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('VhsncMeeting.' . $this->VhsncMeeting->primaryKey => $id));
			$this->request->data = $this->VhsncMeeting->find('first', $options);
			//$executives=$this->User->find('list',array('conditions'=>array('User.status'=>'active','User.role'=>'regular')));

			}
                         if(CakeSession::read('User.type')==='regular'){
                     
                     if(CakeSession::read('User.subrole')==='CC'){
		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'))));
                       
                      
	            $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Bpccc']['allocated_district'])));
                    $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id'=>$r['Bpccc']['allocated_block'])));
                    $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Panchayat.id IN'=>explode(',',$r['Bpccc']['allocated_panchayat']))));
                    $village=$this->Village->find('list',array('order'=>array('name'=>'asc')));
				
		}
                
                 elseif(CakeSession::read('User.subrole')==='BPC'){
		  $r = $this->Bpc->find('first',array('conditions'=>array('Bpc.first_name='.CakeSession::read('User.id'))));
                       
                     
	            $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Bpc']['allocated_district'])));
                   $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id IN'=>explode(',',$r['Bpc']['allocated_block']))));
                    $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc')));
                    $village=$this->Village->find('list',array('order'=>array('name'=>'asc')));
		}
                
                
                 else {
		  $r = $this->Dpo->find('first',array('conditions'=>array('Dpo.first_name='.CakeSession::read('User.id'))));
                         
	            $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Dpo']['district'])));
                   $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc')));
                    $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc')));
                    $village=$this->Village->find('list',array('order'=>array('name'=>'asc')));
		}
		   }
                else {
                    $cities=$this->City->find('list',array('order'=>array('name'=>'asc')));
                    $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc')));
                    $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc')));
                    $village=$this->Village->find('list',array('order'=>array('name'=>'asc')));
                }
		//$cities=$this->City->find('list');
                $desig=$this->Designation->find('list');
		//$blocks=$this->Block->find('list');
		$reg=$this->RegisterMember->find('list');
                //$panchayat=$this->Panchayat->find('list');
                //$village=$this->Village->find('list');
                $ward=$this->Ward->find('list');
                $issue=$this->IssueCategory->find('list');
                $subissue=$this->IssueSubcategory->find('list');
                $facilitated=$this->MeetingFacilitated->find('list');
                
		$this->set(compact('panchayat','cities','reg','blocks','desig','village','facilitated','ward','issue','subissue'));
	
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
	$condition2.=' and VhsncMeeting.id LIKE %'.$searchKey.'% || VhsncMeeting.vhsnc_quorum_ompleted LIKE %'.$searchKey.'% VhsncMeeting.decisions_taken LIKE %'.$searchKey.'% || VhsncMeeting.issue_resolved LIKE %'.$searchKey.'% || VhsncMeeting.issue_details LIKE %'.$searchKey.'%';
	
	}
	
	
	
	if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(VhsncMeeting.meeting_date)>="'.$fromdate.'" and date(VhsncMeeting.meeting_date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(VhsncMeeting.meeting_date)="'.$fromdate.'"';
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
		$condition2.=' and VhsncMeeting.block='.$searchBlockId;
		}
		
		if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchProjectId=trim($this->request->query['panchayat']); //$condition['Enquiry.project_id']=$searchProjectId;
		$condition2.=' and VhsncMeeting.panchayat='.$searchProjectId;
		}
               
                if(isset($this->request->query['village']) and ($this->request->query['village']!=0) and ($this->request->query['village']!='')){$searchVillageId=trim($this->request->query['village']); //$condition['Enquiry.project_id']=$searchProjectId;
		$condition2.=' and VhsncMeeting.village='.$searchVillageId;
		}
		
		
		
		}
		else {
		if(CakeSession::read('User.type')==='regular'){
             //echo CakeSession::read('User.subrole');
            // die();
             if(CakeSession::read('User.subrole')==='CC'){
		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'))));
                      if($r){ 
                          if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){
                           $searchProjectId=trim($this->request->query['panchayat']);
		          //  $condition['VhsncAfc.panchayat']=$searchProjectId;
                             $condition2.=' and VhsncMeeting.panchayat='.$searchProjectId;
		           }   else { 
                        ///$condition=['VhsncAfc.panchayat IN' =>explode(',',$r['Bpccc']['allocated_panchayat'])]; 
                         $condition2.=' and VhsncMeeting.panchayat IN ('.$r['Bpccc']['allocated_panchayat'].')';
                      } 
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('VhsncMeeting.id LIKE'=>'%'.$searchKey.'%','VhsncMeeting.vhsnc_quorum_ompleted LIKE'=>'%'.$searchKey.'%','VhsncMeeting.decisions_taken LIKE'=>'%'.$searchKey.'%','VhsncMeeting.issue_resolved LIKE '=>'%'.$searchKey.'%','VhsncMeeting.issue_details LIKE '=>'%'.$searchKey.'%'); 
	
	}  
        if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(VhsncMeeting.meeting_date)>="'.$fromdate.'" and date(VhsncMeeting.meeting_date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(VhsncMeeting.meeting_date)="'.$fromdate.'"';
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
		        $condition2.=' and VhsncMeeting.block='.$searchBlockId;
		        }else {
                            
                       $condition2.=' and VhsncMeeting.block IN ('.$r['Bpc']['allocated_block'].')';
                       
                      } 
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('VhsncMeeting.id LIKE'=>'%'.$searchKey.'%','VhsncMeeting.vhsnc_quorum_ompleted LIKE'=>'%'.$searchKey.'%','VhsncMeeting.decisions_taken LIKE'=>'%'.$searchKey.'%','VhsncMeeting.issue_resolved LIKE '=>'%'.$searchKey.'%','VhsncMeeting.issue_details LIKE '=>'%'.$searchKey.'%'); 
	
	} 
        if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(VhsncMeeting.meeting_date)>="'.$fromdate.'" and date(VhsncMeeting.meeting_date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(VhsncMeeting.meeting_date)="'.$fromdate.'"';
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
                               $condition2.=' and VhsncMeeting.block='.$searchBlockId;
		        // $condition['VhsncAfc.block']=$searchBlockId;
		        }else {
                       //$condition='VhsncAfc.district='.$r['Dpo']['district'];
                        $condition2.=' and VhsncMeeting.district IN ('.$r['Dpo']['district'].')';
                        }
                        if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('VhsncMeeting.id LIKE'=>'%'.$searchKey.'%','VhsncMeeting.vhsnc_quorum_ompleted LIKE'=>'%'.$searchKey.'%','VhsncMeeting.decisions_taken LIKE'=>'%'.$searchKey.'%','VhsncMeeting.issue_resolved LIKE '=>'%'.$searchKey.'%','VhsncMeeting.issue_details LIKE '=>'%'.$searchKey.'%'); 
	
	} 
        if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(VhsncMeeting.meeting_date)>="'.$fromdate.'" and date(VhsncMeeting.meeting_date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(VhsncMeeting.meeting_date)="'.$fromdate.'"';
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
		$condition2.=' and VhsncMeeting.status="active"';
		$this->response->download("VhsncMeeting.csv");
		//print_r($condition); exit;
	    $data=$this->VhsncMeeting->query('select VhsncMeeting.id,VhsncMeeting.meeting_date,VhsncMeeting.vhsnc_quorum_ompleted,Registermember.name,Meetingfacilitated.name,VhsncMeeting.new_issue,VhsncMeeting.decision_taken,VhsncMeeting.solved_issue,Issuecategory.name,Issuesubcat.name,VhsncMeeting.issue_details,VhsncMeeting.decisions_taken,VhsncMeeting.decision_details,VhsncMeeting.issue_resolved,VhsncMeeting.issue_resolved_date,VhsncMeeting.issue_remarks,VhsncMeeting.letter_issued_bpmc,City.name,Block.name,Panchayat.name,Village.name,Ward.name,VhsncMeeting.status from vhsnc_meetings as VhsncMeeting left join cities as City  on VhsncMeeting.district=City.id left join blocks as Block  on VhsncMeeting.block=Block.id left join villages as Village  on VhsncMeeting.village=Village.id left join panchayats as Panchayat on VhsncMeeting.panchayat=Panchayat.id left join wards as Ward on VhsncMeeting.ward=Ward.id left join register_members as Registermember on VhsncMeeting.register_member=Registermember.id left join meeting_facilitateds as Meetingfacilitated on VhsncMeeting.meeting_facilitated=Meetingfacilitated.id left join issue_category as Issuecategory on VhsncMeeting.issue_category=Issuecategory.id left join issue_subcategory as Issuesubcat on VhsncMeeting.issue_level=Issuesubcat.id   where 1 '.$condition2 );
		
		
		//$data = $this->Geographical->find('all', array('conditions'=>$condition2));
		
		//$log = $this->Enquiry->getDataSource()->getLog(false, false);
        //debug($log);
		//exit;
		
            $headers = array('VhsncMeeting'=>array( 'Id' => 'Id','District' => 'District', 'Block' => 'Block','Panchayat' => 'Panchayat','Village'=>'Village','Ward'=>'Ward','Date of Meeting'=>'Date of Meeting','VHSNC Quorum Completed'=>'VHSNC Quorum Completed','Types of Reg. Member Participated'=>'Types of Reg. Member Participated','Meeting Facilitated by'=>'Meeting Facilitated by','No. New Issues Identified'=>'No. New Issues Identified','Decisions Taken'=>'Decisions Taken','Issues Resolved'=>'Issues Resolved','Issue Details'=>'Issue Details','Issue Category'=>'Issue Category','Issue Level'=>'Issue Level','Decisions Taken'=>'Decisions Taken','Decision Details'=>'Decision Details','Issue Resolved'=>'Issue Resolved','Date of Resolved Issued'=>'Date of Resolved Issued','Remarks of Issued'=>'Remarks of Issued','Letter Issued to Higher Authority'=>'Letter Issued to Higher Authority','Status'=>'Status')); 
	    $this->set(compact('data','headers'));
		$this->layout = 'ajax';
		return;
		
		}
                
  ////exportpendingissue////////
                
                
    public function exportpendingissue(){
            $data='';$searchKey=null;$searchUserId=null;$searchCountryId=null;$searchBuilderId=null;$searchProjectId=null;
		$searchStatus=null;$pages=null;$condition='';$querySrting=''; $condition=array();$condition2='';
		$conc='';
		//$username=$this->User->findById(CakeSession::read('User.id'));
		if(isset($this->params->query['confirm'])) {
	   
		if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    //$condition['OR']=array('Geographical.id LIKE'=>'%'.$searchKey.'%','Geographical.ward LIKE'=>'%'.$searchKey.'%','Geographical.awc_code LIKE'=>'%'.$searchKey.'%','Geographical.awc_worker LIKE '=>'%'.$searchKey.'%','Geographical.asha_name LIKE '=>'%'.$searchKey.'%'); 
	$condition2.=' and VhsncMeeting.id LIKE %'.$searchKey.'% || VhsncMeeting.vhsnc_quorum_ompleted LIKE %'.$searchKey.'% VhsncMeeting.decisions_taken LIKE %'.$searchKey.'% || VhsncMeeting.issue_resolved LIKE %'.$searchKey.'% || VhsncMeeting.issue_details LIKE %'.$searchKey.'%';
	
	}
	
	
	
	if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(VhsncMeeting.meeting_date)>="'.$fromdate.'" and date(VhsncMeeting.meeting_date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(VhsncMeeting.meeting_date)="'.$fromdate.'"';
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
		$condition2.=' and VhsncMeeting.block='.$searchBlockId;
		}
		
		if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchProjectId=trim($this->request->query['panchayat']); //$condition['Enquiry.project_id']=$searchProjectId;
		$condition2.=' and VhsncMeeting.panchayat='.$searchProjectId;
		}
               
                if(isset($this->request->query['village']) and ($this->request->query['village']!=0) and ($this->request->query['village']!='')){$searchVillageId=trim($this->request->query['village']); //$condition['Enquiry.project_id']=$searchProjectId;
		$condition2.=' and VhsncMeeting.village='.$searchVillageId;
		}
		
		
		
		}
		else {
		if(CakeSession::read('User.type')==='regular'){
             //echo CakeSession::read('User.subrole');
            // die();
             if(CakeSession::read('User.subrole')==='CC'){
		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'))));
                      if($r){ 
                          if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){
                           $searchProjectId=trim($this->request->query['panchayat']);
		          //  $condition['VhsncAfc.panchayat']=$searchProjectId;
                             $condition2.=' and VhsncMeeting.panchayat='.$searchProjectId;
		           }   else { 
                        ///$condition=['VhsncAfc.panchayat IN' =>explode(',',$r['Bpccc']['allocated_panchayat'])]; 
                         $condition2.=' and VhsncMeeting.panchayat IN ('.$r['Bpccc']['allocated_panchayat'].')';
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
		        $condition2.=' and VhsncMeeting.block='.$searchBlockId;
		        }else {
                            
                       $condition2.=' and VhsncMeeting.block IN ('.$r['Bpc']['allocated_block'].')';
                       
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
                               $condition2.=' and VhsncMeeting.block='.$searchBlockId;
		        // $condition['VhsncAfc.block']=$searchBlockId;
		        }else {
                       //$condition='VhsncAfc.district='.$r['Dpo']['district'];
                        $condition2.=' and VhsncMeeting.district IN ('.$r['Dpo']['district'].')';
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
		$condition2.=' and VhsncMeeting.status="active"';
                $condition2.=' and VhsncMeeting.issue_resolved="no"';
		$this->response->download("pedingissue.csv");
		//print_r($condition); exit;
	    $data=$this->VhsncMeeting->query('select VhsncMeeting.id,VhsncMeeting.meeting_date,VhsncMeeting.vhsnc_quorum_ompleted,Registermember.name,Meetingfacilitated.name,VhsncMeeting.new_issue,VhsncMeeting.decision_taken,VhsncMeeting.solved_issue,Issuecategory.name,Issuesubcat.name,VhsncMeeting.issue_details,VhsncMeeting.decisions_taken,VhsncMeeting.decision_details,VhsncMeeting.issue_resolved,VhsncMeeting.issue_resolved_date,VhsncMeeting.issue_remarks,VhsncMeeting.letter_issued_bpmc,City.name,Block.name,Panchayat.name,Village.name,Ward.name,VhsncMeeting.status from vhsnc_meetings as VhsncMeeting left join cities as City  on VhsncMeeting.district=City.id left join blocks as Block  on VhsncMeeting.block=Block.id left join villages as Village  on VhsncMeeting.village=Village.id left join panchayats as Panchayat on VhsncMeeting.panchayat=Panchayat.id left join wards as Ward on VhsncMeeting.ward=Ward.id left join register_members as Registermember on VhsncMeeting.register_member=Registermember.id left join meeting_facilitateds as Meetingfacilitated on VhsncMeeting.meeting_facilitated=Meetingfacilitated.id left join issue_category as Issuecategory on VhsncMeeting.issue_category=Issuecategory.id left join issue_subcategory as Issuesubcat on VhsncMeeting.issue_level=Issuesubcat.id   where 1 '.$condition2 );
		
		
		//$data = $this->Geographical->find('all', array('conditions'=>$condition2));
		
		//$log = $this->Enquiry->getDataSource()->getLog(false, false);
        //debug($log);
		//exit;
		
            $headers = array('VhsncMeeting'=>array( 'Id' => 'Id','District' => 'District', 'Block' => 'Block','Panchayat' => 'Panchayat','Village'=>'Village','Ward'=>'Ward','Date of Meeting'=>'Date of Meeting','VHSNC Quorum Completed'=>'VHSNC Quorum Completed','Types of Reg. Member Participated'=>'Types of Reg. Member Participated','Meeting Facilitated by'=>'Meeting Facilitated by','No. New Issues Identified'=>'No. New Issues Identified','Decisions Taken'=>'Decisions Taken','Issues Resolved'=>'Issues Resolved','Issue Details'=>'Issue Details','Issue Category'=>'Issue Category','Issue Level'=>'Issue Level','Decisions Taken'=>'Decisions Taken','Decision Details'=>'Decision Details','Issue Resolved'=>'Issue Resolved','Date of Resolved Issued'=>'Date of Resolved Issued','Remarks of Issued'=>'Remarks of Issued','Letter Issued to Higher Authority'=>'Letter Issued to Higher Authority','Status'=>'Status')); 
	    $this->set(compact('data','headers'));
		$this->layout = 'ajax';
		return;
		
		}
                
   //////exportresolvedissue///////             
                
   public function exportresolvedissue(){
            $data='';$searchKey=null;$searchUserId=null;$searchCountryId=null;$searchBuilderId=null;$searchProjectId=null;
		$searchStatus=null;$pages=null;$condition='';$querySrting=''; $condition=array();$condition2='';
		$conc='';
		//$username=$this->User->findById(CakeSession::read('User.id'));
		if(isset($this->params->query['confirm'])) {
	   
		if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    //$condition['OR']=array('Geographical.id LIKE'=>'%'.$searchKey.'%','Geographical.ward LIKE'=>'%'.$searchKey.'%','Geographical.awc_code LIKE'=>'%'.$searchKey.'%','Geographical.awc_worker LIKE '=>'%'.$searchKey.'%','Geographical.asha_name LIKE '=>'%'.$searchKey.'%'); 
	$condition2.=' and VhsncMeeting.id LIKE %'.$searchKey.'% || VhsncMeeting.vhsnc_quorum_ompleted LIKE %'.$searchKey.'% VhsncMeeting.decisions_taken LIKE %'.$searchKey.'% || VhsncMeeting.issue_resolved LIKE %'.$searchKey.'% || VhsncMeeting.issue_details LIKE %'.$searchKey.'%';
	
	}
	
	
	
	if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(VhsncMeeting.meeting_date)>="'.$fromdate.'" and date(VhsncMeeting.meeting_date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(VhsncMeeting.meeting_date)="'.$fromdate.'"';
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
		$condition2.=' and VhsncMeeting.block='.$searchBlockId;
		}
		
		if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchProjectId=trim($this->request->query['panchayat']); //$condition['Enquiry.project_id']=$searchProjectId;
		$condition2.=' and VhsncMeeting.panchayat='.$searchProjectId;
		}
               
                if(isset($this->request->query['village']) and ($this->request->query['village']!=0) and ($this->request->query['village']!='')){$searchVillageId=trim($this->request->query['village']); //$condition['Enquiry.project_id']=$searchProjectId;
		$condition2.=' and VhsncMeeting.village='.$searchVillageId;
		}
		
		
		
		}
		else {
		if(CakeSession::read('User.type')==='regular'){
             //echo CakeSession::read('User.subrole');
            // die();
             if(CakeSession::read('User.subrole')==='CC'){
		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'))));
                      if($r){ 
                          if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){
                           $searchProjectId=trim($this->request->query['panchayat']);
		          //  $condition['VhsncAfc.panchayat']=$searchProjectId;
                             $condition2.=' and VhsncMeeting.panchayat='.$searchProjectId;
		           }   else { 
                        ///$condition=['VhsncAfc.panchayat IN' =>explode(',',$r['Bpccc']['allocated_panchayat'])]; 
                         $condition2.=' and VhsncMeeting.panchayat IN ('.$r['Bpccc']['allocated_panchayat'].')';
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
		        $condition2.=' and VhsncMeeting.block='.$searchBlockId;
		        }else {
                            
                       $condition2.=' and VhsncMeeting.block IN ('.$r['Bpc']['allocated_block'].')';
                       
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
                               $condition2.=' and VhsncMeeting.block='.$searchBlockId;
		        // $condition['VhsncAfc.block']=$searchBlockId;
		        }else {
                       //$condition='VhsncAfc.district='.$r['Dpo']['district'];
                        $condition2.=' and VhsncMeeting.district IN ('.$r['Dpo']['district'].')';
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
		$condition2.=' and VhsncMeeting.status="active"';
                $condition2.=' and VhsncMeeting.issue_resolved="yes"';
		$this->response->download("resolvedissue.csv");
		//print_r($condition); exit;
	    $data=$this->VhsncMeeting->query('select VhsncMeeting.id,VhsncMeeting.meeting_date,VhsncMeeting.vhsnc_quorum_ompleted,Registermember.name,Meetingfacilitated.name,VhsncMeeting.new_issue,VhsncMeeting.decision_taken,VhsncMeeting.solved_issue,Issuecategory.name,Issuesubcat.name,VhsncMeeting.issue_details,VhsncMeeting.decisions_taken,VhsncMeeting.decision_details,VhsncMeeting.issue_resolved,VhsncMeeting.issue_resolved_date,VhsncMeeting.issue_remarks,VhsncMeeting.letter_issued_bpmc,City.name,Block.name,Panchayat.name,Village.name,Ward.name,VhsncMeeting.status from vhsnc_meetings as VhsncMeeting left join cities as City  on VhsncMeeting.district=City.id left join blocks as Block  on VhsncMeeting.block=Block.id left join villages as Village  on VhsncMeeting.village=Village.id left join panchayats as Panchayat on VhsncMeeting.panchayat=Panchayat.id left join wards as Ward on VhsncMeeting.ward=Ward.id left join register_members as Registermember on VhsncMeeting.register_member=Registermember.id left join meeting_facilitateds as Meetingfacilitated on VhsncMeeting.meeting_facilitated=Meetingfacilitated.id left join issue_category as Issuecategory on VhsncMeeting.issue_category=Issuecategory.id left join issue_subcategory as Issuesubcat on VhsncMeeting.issue_level=Issuesubcat.id   where 1 '.$condition2 );
		
		
		//$data = $this->Geographical->find('all', array('conditions'=>$condition2));
		
		//$log = $this->Enquiry->getDataSource()->getLog(false, false);
        //debug($log);
		//exit;
		
            $headers = array('VhsncMeeting'=>array( 'Id' => 'Id','District' => 'District', 'Block' => 'Block','Panchayat' => 'Panchayat','Village'=>'Village','Ward'=>'Ward','Date of Meeting'=>'Date of Meeting','VHSNC Quorum Completed'=>'VHSNC Quorum Completed','Types of Reg. Member Participated'=>'Types of Reg. Member Participated','Meeting Facilitated by'=>'Meeting Facilitated by','No. New Issues Identified'=>'No. New Issues Identified','Decisions Taken'=>'Decisions Taken','Issues Resolved'=>'Issues Resolved','Issue Details'=>'Issue Details','Issue Category'=>'Issue Category','Issue Level'=>'Issue Level','Decisions Taken'=>'Decisions Taken','Decision Details'=>'Decision Details','Issue Resolved'=>'Issue Resolved','Date of Resolved Issued'=>'Date of Resolved Issued','Remarks of Issued'=>'Remarks of Issued','Letter Issued to Higher Authority'=>'Letter Issued to Higher Authority','Status'=>'Status')); 
	    $this->set(compact('data','headers'));
		$this->layout = 'ajax';
		return;
		
		}              
  ////  reports section ---///// 
	
	}
	
	
	
	
