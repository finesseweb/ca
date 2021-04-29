<?php
App::uses('AppController', 'Controller');
/**
 * Ngos Controller
 *
 * @property Ngo $GeographicalNgo
 * @property PaginatorComponent $Paginator
 */
class FacilityassessmentsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Upload');

    var  $uses = array('FacilityAssessment','Feedback','Subfeedback','User','FacilityDetail','Village','Panchayat','MeetingFacilitated','Country','City','Block','Designation','Ward','IssueCategory','IssueSubcategory','Bpccc','Bpc','Dpo');
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
    $condition['OR']=array('FacilityAssessment.id LIKE'=>'%'.$searchKey.'%','FacilityAssessment.investigator_name LIKE'=>'%'.$searchKey.'%','FacilityAssessment.name_of_responder_one LIKE'=>'%'.$searchKey.'%','FacilityAssessment.name_of_responder_two LIKE '=>'%'.$searchKey.'%','FacilityAssessment.mobile_responder_one LIKE '=>'%'.$searchKey.'%','FacilityAssessment.mobile_responder_two LIKE '=>'%'.$searchKey.'%'); 
	
	}
		
		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(FacilityAssessment.invsetigation_date) >='=>$fromdate,'date(FacilityAssessment.invsetigation_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['FacilityAssessment.invsetigation_date']=$fromdate;	
				}
				
			}
		if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBuilderId=trim($this->request->query['block']); 
		$condition['FacilityAssessment.block']=$searchBuilderId;
		}
		if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchPanchayatId=trim($this->request->query['panchayat']); 
		$condition['FacilityAssessment.panchayat']=$searchPanchayatId;
		}
		
//		if(isset($this->request->query['village']) and ($this->request->query['village']!=0) and ($this->request->query['village']!='')){$searchProjectId=trim($this->request->query['village']);
//		$condition['FacilityAssessment.village']=$searchProjectId;
//		}
//                if(isset($this->request->query['ward']) and ($this->request->query['ward']!=0) and ($this->request->query['ward']!='')){$searchProjectId=trim($this->request->query['ward']);
//		$condition['FacilityAssessment.ward']=$searchProjectId;
//		}
		
		
		
	}
		 if(CakeSession::read('User.type')==='regular'){
             //echo CakeSession::read('User.subrole');
            // die();
             if(CakeSession::read('User.subrole')==='CC'){
		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'))));
                      if($r){ 
                          if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchPanchayatId=trim($this->request->query['panchayat']); 
		$condition['FacilityAssessment.panchayat']=$searchPanchayatId;
		} else {
                      // $condition='FacilityAssessment.panchayat='.$r['Bpccc']['allocated_panchayat'];
                        $condition=['FacilityAssessment.panchayat IN' =>explode(',',$r['Bpccc']['allocated_panchayat'])];
                }
                if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('FacilityAssessment.id LIKE'=>'%'.$searchKey.'%','FacilityAssessment.investigator_name LIKE'=>'%'.$searchKey.'%','FacilityAssessment.name_of_responder_one LIKE'=>'%'.$searchKey.'%','FacilityAssessment.name_of_responder_two LIKE '=>'%'.$searchKey.'%','FacilityAssessment.mobile_responder_one LIKE '=>'%'.$searchKey.'%','FacilityAssessment.mobile_responder_two LIKE '=>'%'.$searchKey.'%'); 
	
	}
		
		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(FacilityAssessment.invsetigation_date) >='=>$fromdate,'date(FacilityAssessment.invsetigation_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['FacilityAssessment.invsetigation_date']=$fromdate;	
				}
				
			}
                      } 
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Village yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
			//$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
			$panchayats=$this->Panchayat->find('list',array('conditions'=>array('Panchayat.id IN'=>explode(',',$r['Bpccc']['allocated_panchayat']))));
                     	
		}
                
                 elseif(CakeSession::read('User.subrole')==='BPC'){
		   $r = $this->Bpc->find('first',array('conditions'=>array('Bpc.first_name='.CakeSession::read('User.id'))));
                      if($r){
                          if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBuilderId=trim($this->request->query['block']); 
		$condition['FacilityAssessment.block']=$searchBuilderId;
		} else {
                       //$condition='FacilityAssessment.block='.$r['Bpc']['allocated_block'];
                       $condition=['FacilityAssessment.block IN' =>explode(',',$r['Bpc']['allocated_block'])];
                }
                if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('FacilityAssessment.id LIKE'=>'%'.$searchKey.'%','FacilityAssessment.investigator_name LIKE'=>'%'.$searchKey.'%','FacilityAssessment.name_of_responder_one LIKE'=>'%'.$searchKey.'%','FacilityAssessment.name_of_responder_two LIKE '=>'%'.$searchKey.'%','FacilityAssessment.mobile_responder_one LIKE '=>'%'.$searchKey.'%','FacilityAssessment.mobile_responder_two LIKE '=>'%'.$searchKey.'%'); 
	
	}
		
		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(FacilityAssessment.invsetigation_date) >='=>$fromdate,'date(FacilityAssessment.invsetigation_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['FacilityAssessment.invsetigation_date']=$fromdate;	
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
		$condition['FacilityAssessment.block']=$searchBuilderId;
		}   else {  
                       $condition='FacilityAssessment.district='.$r['Dpo']['district'];
                }
                if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('FacilityAssessment.id LIKE'=>'%'.$searchKey.'%','FacilityAssessment.investigator_name LIKE'=>'%'.$searchKey.'%','FacilityAssessment.name_of_responder_one LIKE'=>'%'.$searchKey.'%','FacilityAssessment.name_of_responder_two LIKE '=>'%'.$searchKey.'%','FacilityAssessment.mobile_responder_one LIKE '=>'%'.$searchKey.'%','FacilityAssessment.mobile_responder_two LIKE '=>'%'.$searchKey.'%'); 
	
	}
		
		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(FacilityAssessment.invsetigation_date) >='=>$fromdate,'date(FacilityAssessment.invsetigation_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['FacilityAssessment.invsetigation_date']=$fromdate;	
				}
				
			}
                      } 
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Village yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
			//$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
			//$panchayats=$this->Panchayat->find('list');
                //$villages=$this->Village->find('list');
                //$wards=$this->Ward->find('list');
                $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.city_id IN'=>explode(',',$r['Dpo']['district']))));
                   	
		}
         }
         else {
                $panchayats=$this->Panchayat->find('list',array('order'=>array('name'=>'asc')));
                $villages=$this->Village->find('list',array('order'=>array('name'=>'asc')));
               // $wards=$this->Ward->find('list');
                $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc')));
         }
		$this->Paginator->settings = array('FacilityAssessment' => array('limit' =>20,'group' => array('FacilityAssessment.invsetigation_date','FacilityAssessment.panchayat'),'order' => array('id' => 'desc'),'conditions'=>array($condition,'FacilityAssessment.status'=>'active')));
		$this->FacilityAssessment->recursive = 0;
		$this->set('vhsncafcs', $this->Paginator->paginate());
		
			
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
		if (!$this->FacilityAssessment->exists($id)) {
			throw new NotFoundException(__('Invalid VHSNC Feedback'));
		}
		$options = array('conditions' => array('FacilityAssessment.' . $this->FacilityAssessment->primaryKey => $id));
		$this->set('vhsncAfc', $this->FacilityAssessment->find('first', $options));
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
			$this->FacilityAssessment->create();
                     // print_r($this->request->data);
                       
                       // echo count($this->request->data['VhsncAfc']['member_name']);
                        //die();
                        //for($i=0;$i<count($this->request->data['FacilityAssessment']['hidden']);$i++){
                            
                            //echo $i;
                            //foreach($this->request->data['FacilityAssessment']['hidden'] as $member) {
                                 //print_r($member);
                              //die(); 
                           for($y=0;$y<count($this->request->data['FacilityAssessment']['question_id']);$y++){
                                //foreach($this->request->data['FacilityAssessment']['question'] as $que) {
                                      // print_r($this->request->data);
                              //die(); 
                                   // foreach($this->request->data['VhsncAfc']['induction_training_date'] as $induction_training_date) {
                                    //foreach($this->request->data['VhsncAfc']['refresher_date'] as $refresher_date) {
                          //print_r($mobile);
                          //die();
                           
                           $district =  $this->request->data['FacilityAssessment']['district'];
                            $block =  $this->request->data['FacilityAssessment']['block'];
                            $panchayat =  $this->request->data['FacilityAssessment']['panchayat'];
                            $level =  $this->request->data['FacilityAssessment']['facility_level'];
                            //$ward =  $this->request->data['FacilityAssessment']['ward'];
                            $invsetigation_date =  date('Y-m-d',strtotime($this->request->data['FacilityAssessment']['invsetigation_date']));
                            $investigator_name =  $this->request->data['FacilityAssessment']['investigator_name'];
                            $health_facility_name =  $this->request->data['FacilityAssessment']['health_facility_name'];
                            $health_facility_type=  $this->request->data['FacilityAssessment']['health_facility_type'];
                            $name_of_responder_one =  $this->request->data['FacilityAssessment']['name_of_responder_one'];
                            $mobile_responder_one =  $this->request->data['FacilityAssessment']['mobile_responder_one'];
                            $name_of_responder_two =  $this->request->data['FacilityAssessment']['name_of_responder_two'];
                            $mobile_responder_two =  $this->request->data['FacilityAssessment']['mobile_responder_two'];
                            $start_time_assessment =  $this->request->data['FacilityAssessment']['start_time_assessment'];
                            $end_time_assessment =  $this->request->data['FacilityAssessment']['end_time_assessment'];
                            
                            $remarks =  $this->request->data['FacilityAssessment']['remarks'];
                            $hidden =  $this->request->data['FacilityAssessment']['question_id'][$y];
                            //$hidden=$member;
                            $question =  $this->request->data['FacilityAssessment']['question_id'][$y];
                            $response =  $this->request->data['FacilityAssessment']['response'][$y];
                            $feedback_remarks = $this->request->data['FacilityAssessment']['feedback_remarks'][$y];
                            
                    $data=array (
                                'district'=>$district,
                                'block'=>$block,
                                'panchayat'=>$panchayat,
                                'facility_level'=>$level,
                                //'ward' =>$ward,
                                'invsetigation_date' =>$invsetigation_date,
                                'investigator_name'=>$investigator_name,
                                'health_facility_name'=> $health_facility_name,
                                'health_facility_type'=>$health_facility_type,
                                'remarks'=>$remarks,
                                'name_of_responder_one'=>$name_of_responder_one,
                                'mobile_responder_one'=>$mobile_responder_one,
                                'name_of_responder_two'=>$name_of_responder_two,
                                'mobile_responder_two'=>$mobile_responder_two,
                                'start_time_assessment'=>$start_time_assessment,
                                'end_time_assessment'=>$end_time_assessment,
                                'feed_title'=>$hidden,
                                'question'=>$question,
                                'response'=>$response,
                                'feedback_remarks'=>$feedback_remarks,
                                 'updated'=>0
                                
                                );  
                    
                          $save=$this->FacilityAssessment->saveAll($data);
			 
                         }
                          
                         
                           //} //} }   
                         
                             
                         if($save) {
                         $this->Session->setFlash(__('The Facility Assessment has been saved.'));
				return $this->redirect(array('action' => 'index'));

                        } else {
				$this->Session->setFlash(__('The Facility Assessment could not be saved. Please, try again.'));
			}
			
                    }   
                    if(CakeSession::read('User.type')==='regular'){
                     
                     if(CakeSession::read('User.subrole')==='CC'){
		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'))));
                       
                       //$condition='VhsncConstitution.village='.$r['Bpccc']['allocated_village'];
                        
			//$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
                       
	            $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Bpccc']['allocated_district'])));
                     $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id'=>$r['Bpccc']['allocated_block'])));
                     $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Panchayat.id IN'=>explode(',',$r['Bpccc']['allocated_panchayat']))));
                     
                     $village=$this->Village->find('list',array('order'=>array('name'=>'asc')));
		}
                
                 elseif(CakeSession::read('User.subrole')==='BPC'){
		  $r = $this->Bpc->find('first',array('conditions'=>array('Bpc.first_name='.CakeSession::read('User.id'))));
                       
                       //$condition='VhsncConstitution.village='.$r['Bpccc']['allocated_village'];
                        
			//$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
                       
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
		$reg=$this->FacilityDetail->find('list');
                $ward=$this->Ward->find('list');
                $issue=$this->IssueCategory->find('list');
                $subissue=$this->IssueSubcategory->find('list');
                $facilitated=$this->MeetingFacilitated->find('list');
               // $feedbacks = array('Feedback' => array('limit' =>20,'order' => array('id' => 'desc')));
		$feedbacks=$this->Feedback->find('all',array('conditions'=>array('Feedback.category'=>'facility')));
		
		$this->set(compact('panchayat','cities','reg','blocks','desig','village','facilitated','ward','issue','subissue','feedbacks'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->FacilityAssessment->exists($id)) {
			throw new NotFoundException(__('Invalid VHSNC Feedback'));
		}
		if ($this->request->is(array('post', 'put'))) {
                      //print_r($this->request->data);
                       //die();
                            $district =  $this->request->data['FacilityAssessment']['district'];
                            $block =  $this->request->data['FacilityAssessment']['block'];
                            $panchayat =  $this->request->data['FacilityAssessment']['panchayat'];        
                            $level =  $this->request->data['FacilityAssessment']['facility_level'];        
                           
                            $invsetigation_date =  date('Y-m-d',strtotime($this->request->data['FacilityAssessment']['invsetigation_date']));
                            $investigator_name =  $this->request->data['FacilityAssessment']['investigator_name'];
                            $health_facility_name =  $this->request->data['FacilityAssessment']['health_facility_name'];
                            $health_facility_type=  $this->request->data['FacilityAssessment']['health_facility_type'];
                            $name_of_responder_one =  $this->request->data['FacilityAssessment']['name_of_responder_one'];
                            $mobile_responder_one =  $this->request->data['FacilityAssessment']['mobile_responder_one'];
                            $name_of_responder_two =  $this->request->data['FacilityAssessment']['name_of_responder_two'];
                            $mobile_responder_two =  $this->request->data['FacilityAssessment']['mobile_responder_two'];
                            $start_time_assessment =  $this->request->data['FacilityAssessment']['start_time_assessment'];
                            $end_time_assessment =  $this->request->data['FacilityAssessment']['end_time_assessment'];
                             $remarks =  $this->request->data['FacilityAssessment']['remarks'];
                    $data=array (
                               'district'=>$district,
                                'block'=>$block,
                                'panchayat'=>$panchayat,
                                'facility_level'=>$level,
                                //'ward' =>$ward,
                                'invsetigation_date' =>$invsetigation_date,
                                'investigator_name'=>$investigator_name,
                                'health_facility_name'=> $health_facility_name,
                                'health_facility_type'=>$health_facility_type,
                                'remarks'=>$remarks,
                                'name_of_responder_one'=>$name_of_responder_one,
                                'mobile_responder_one'=>$mobile_responder_one,
                                'name_of_responder_two'=>$name_of_responder_two,
                                'mobile_responder_two'=>$mobile_responder_two,
                                'start_time_assessment'=>$start_time_assessment,
                                'end_time_assessment'=>$end_time_assessment,
                                'remarks'=>'$remarks',
                                'updated'=>1,
                                'id'=>$id
                                ); 
                        $save=$this->FacilityAssessment->save($data);
				
                         //}///} } } 
			if ($save) {
				$this->Session->setFlash(__('The VHSNC Feedback has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The VHSNC Feedback could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('FacilityAssessment.' . $this->FacilityAssessment->primaryKey => $id));
			$this->request->data = $this->FacilityAssessment->find('first', $options);
			//$executives=$this->User->find('list',array('conditions'=>array('User.status'=>'active','User.role'=>'regular')));
//			
			}
                        
                  if(CakeSession::read('User.type')==='regular'){
                     
                     if(CakeSession::read('User.subrole')==='CC'){
		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'))));
                      
	            $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Bpccc']['allocated_district'])));
                    $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id'=>$r['Bpccc']['allocated_block'])));
                   $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Panchayat.id IN'=>explode(',',$r['Bpccc']['allocated_panchayat']))));
                    if($this->request->data['FacilityAssessment']['panchayat']!=0 and $this->request->data['FacilityAssessment']['panchayat']!='')
			{
		     $village=$this->Village->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Village.panchayat_id'=>$this->request->data['FacilityAssessment']['panchayat'])));
		    }
                    else {
                   $village=$this->Village->find('list',array('order'=>array('name'=>'asc'),));
                        
                    }
		}
                
                 elseif(CakeSession::read('User.subrole')==='BPC'){
		  $r = $this->Bpc->find('first',array('conditions'=>array('Bpc.first_name='.CakeSession::read('User.id'))));
                      
	            $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Bpc']['allocated_district'])));
                    $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id IN'=>explode(',',$r['Bpc']['allocated_block']))));
                     if($this->request->data['FacilityAssessment']['panchayat']!=0 and $this->request->data['FacilityAssessment']['panchayat']!='')
			{
		     $village=$this->Village->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Village.panchayat_id'=>$this->request->data['FacilityAssessment']['panchayat'])));
		    }
                    else {
                        $village=$this->Village->find('list');
                    }
                   if($this->request->data['FacilityAssessment']['panchayat']!=0 and $this->request->data['FacilityAssessment']['panchayat']!='')
			{
		     $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Panchayat.id'=>$this->request->data['FacilityAssessment']['panchayat'])));
		    } else {
                        $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc')));
                    }
                    
                    
		}
                
                
                 else {
		  $r = $this->Dpo->find('first',array('conditions'=>array('Dpo.first_name='.CakeSession::read('User.id'))));
                         
	            $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Dpo']['district'])));
                  if($this->request->data['FacilityAssessment']['panchayat']!=0 and $this->request->data['FacilityAssessment']['panchayat']!='')
			{
		     $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id'=>$this->request->data['FacilityAssessment']['block'])));
		    }
                    else {
                        $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc')));
                    } 
                    if($this->request->data['FacilityAssessment']['panchayat']!=0 and $this->request->data['FacilityAssessment']['panchayat']!='')
			{
		     $village=$this->Village->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Village.panchayat_id'=>$this->request->data['FacilityAssessment']['panchayat'])));
		    }
                    else {
                        $village=$this->Village->find('list',array('order'=>array('name'=>'asc')));
                    }
                   if($this->request->data['FacilityAssessment']['panchayat']!=0 and $this->request->data['FacilityAssessment']['panchayat']!='')
			{
		     $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Panchayat.id'=>$this->request->data['FacilityAssessment']['panchayat'])));
		    } else {
                        $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc')));
                    }
		}
		   }
                else {
                    $cities=$this->City->find('list',array('order'=>array('name'=>'asc')));
                     if($this->request->data['FacilityAssessment']['panchayat']!=0 and $this->request->data['FacilityAssessment']['panchayat']!='')
			{
		     $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id'=>$this->request->data['FacilityAssessment']['block'])));
		    }
                    else {
                        $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc')));
                    } 
                    if($this->request->data['FacilityAssessment']['panchayat']!=0 and $this->request->data['FacilityAssessment']['panchayat']!='')
			{
		     $village=$this->Village->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Village.panchayat_id'=>$this->request->data['FacilityAssessment']['panchayat'])));
		    }
                    else {
                        $village=$this->Village->find('list',array('order'=>array('name'=>'asc')));
                    }
                   if($this->request->data['FacilityAssessment']['panchayat']!=0 and $this->request->data['FacilityAssessment']['panchayat']!='')
			{
		     $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Panchayat.id'=>$this->request->data['FacilityAssessment']['panchayat'])));
		    } else {
                        $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc')));
                    }
                }
		//$cities=$this->City->find('list');
                $desig=$this->Designation->find('list');
		//$blocks=$this->Block->find('list');
		$reg=$this->FacilityDetail->find('list');
               // $panchayat=$this->Panchayat->find('list');
               // $village=$this->Village->find('list');
                $ward=$this->Ward->find('list');
                //$issue=$this->IssueCategory->find('list');
                //$subissue=$this->IssueSubcategory->find('list');
                //$facilitated=$this->MeetingFacilitated->find('list');
                //$feedbacks=$this->Feedback->find('all');
		$this->set(compact('panchayat','cities','reg','blocks','desig','village','facilitated','ward','issue','subissue','feedbacks'));
	
	}
	
	
	
	

	
	public function delete($id = null,$status='deactive') {
		$this->FacilityAssessment->id = $id;
		if (!$this->FacilityAssessment->exists()) {
			throw new NotFoundException(__('Invalid Vhsnc/Afc Detail'));
		}
		    //$this->request->onlyAllow('post', 'delete');
		    $this->FacilityAssessment->read(null,$id);
			$this->FacilityAssessment->set(array('status'=>$status));
		
		if ($this->FacilityAssessment->save()) {
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
	$condition2.=' and FacilityAssessment.id LIKE %'.$searchKey.'% || FacilityAssessment.investigator_name LIKE %'.$searchKey.'% FacilityAssessment.name_of_responder_one LIKE %'.$searchKey.'% || FacilityAssessment.name_of_responder_two LIKE %'.$searchKey.'% || FacilityAssessment.mobile_responder_one LIKE %'.$searchKey.'% || FacilityAssessment.mobile_responder_two LIKE %'.$searchKey.'%';
	
	}
	
	
	
	if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(FacilityAssessment.invsetigation_date)>="'.$fromdate.'" and date(FacilityAssessment.invsetigation_date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(FacilityAssessment.invsetigation_date)="'.$fromdate.'"';
				}
				else
				{
					
					}
			}
			
			
  
//		if(isset($this->request->query['organization']) and ($this->request->query['organization']!=0) and ($this->request->query['organization']!='')){$searchBuilderId=trim($this->request->query['organization']);  //$condition['Enquiry.country_id']=$searchCountryId;
//		$condition2.=' and FacilityAssessment.organization='.$searchBuilderId;
//		
//		}
		
		if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBlockId=trim($this->request->query['block']); //$condition['Enquiry.builder_id']=$searchBuilderId;
		$condition2.=' and FacilityAssessment.block='.$searchBlockId;
		}
		
		if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchProjectId=trim($this->request->query['panchayat']); //$condition['Enquiry.project_id']=$searchProjectId;
		$condition2.=' and FacilityAssessment.panchayat='.$searchProjectId;
		}
               
//                if(isset($this->request->query['village']) and ($this->request->query['village']!=0) and ($this->request->query['village']!='')){$searchVillageId=trim($this->request->query['village']); //$condition['Enquiry.project_id']=$searchProjectId;
//		$condition2.=' and FacilityAssessment.village='.$searchVillageId;
//		}
		
		
		
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
                             $condition2.=' and FacilityAssessment.panchayat='.$searchProjectId;
		           }   else { 
                        ///$condition=['VhsncAfc.panchayat IN' =>explode(',',$r['Bpccc']['allocated_panchayat'])]; 
                         $condition2.=' and FacilityAssessment.panchayat IN ('.$r['Bpccc']['allocated_panchayat'].')';
                      }
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    //$condition['OR']=array('Geographical.id LIKE'=>'%'.$searchKey.'%','Geographical.ward LIKE'=>'%'.$searchKey.'%','Geographical.awc_code LIKE'=>'%'.$searchKey.'%','Geographical.awc_worker LIKE '=>'%'.$searchKey.'%','Geographical.asha_name LIKE '=>'%'.$searchKey.'%'); 
	$condition2.=' and FacilityAssessment.id LIKE %'.$searchKey.'% || FacilityAssessment.investigator_name LIKE %'.$searchKey.'% FacilityAssessment.name_of_responder_one LIKE %'.$searchKey.'% || FacilityAssessment.name_of_responder_two LIKE %'.$searchKey.'% || FacilityAssessment.mobile_responder_one LIKE %'.$searchKey.'% || FacilityAssessment.mobile_responder_two LIKE %'.$searchKey.'%';
	
	}
	
	
	
	if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(FacilityAssessment.invsetigation_date)>="'.$fromdate.'" and date(FacilityAssessment.invsetigation_date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(FacilityAssessment.invsetigation_date)="'.$fromdate.'"';
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
		        $condition2.=' and FacilityAssessment.block='.$searchBlockId;
		        }else {
                            
                       $condition2.=' and FacilityAssessment.block IN ('.$r['Bpc']['allocated_block'].')';
                       
                      }
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    //$condition['OR']=array('Geographical.id LIKE'=>'%'.$searchKey.'%','Geographical.ward LIKE'=>'%'.$searchKey.'%','Geographical.awc_code LIKE'=>'%'.$searchKey.'%','Geographical.awc_worker LIKE '=>'%'.$searchKey.'%','Geographical.asha_name LIKE '=>'%'.$searchKey.'%'); 
	$condition2.=' and FacilityAssessment.id LIKE %'.$searchKey.'% || FacilityAssessment.investigator_name LIKE %'.$searchKey.'% FacilityAssessment.name_of_responder_one LIKE %'.$searchKey.'% || FacilityAssessment.name_of_responder_two LIKE %'.$searchKey.'% || FacilityAssessment.mobile_responder_one LIKE %'.$searchKey.'% || FacilityAssessment.mobile_responder_two LIKE %'.$searchKey.'%';
	
	}
	
	
	
	if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(FacilityAssessment.invsetigation_date)>="'.$fromdate.'" and date(FacilityAssessment.invsetigation_date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(FacilityAssessment.invsetigation_date)="'.$fromdate.'"';
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
                               $condition2.=' and FacilityAssessment.block='.$searchBlockId;
		        // $condition['VhsncAfc.block']=$searchBlockId;
		        }else {
                       //$condition='VhsncAfc.district='.$r['Dpo']['district'];
                        $condition2.=' and FacilityAssessment.district IN ('.$r['Dpo']['district'].')';
                        }
                        if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    //$condition['OR']=array('Geographical.id LIKE'=>'%'.$searchKey.'%','Geographical.ward LIKE'=>'%'.$searchKey.'%','Geographical.awc_code LIKE'=>'%'.$searchKey.'%','Geographical.awc_worker LIKE '=>'%'.$searchKey.'%','Geographical.asha_name LIKE '=>'%'.$searchKey.'%'); 
	$condition2.=' and FacilityAssessment.id LIKE %'.$searchKey.'% || FacilityAssessment.investigator_name LIKE %'.$searchKey.'% FacilityAssessment.name_of_responder_one LIKE %'.$searchKey.'% || FacilityAssessment.name_of_responder_two LIKE %'.$searchKey.'% || FacilityAssessment.mobile_responder_one LIKE %'.$searchKey.'% || FacilityAssessment.mobile_responder_two LIKE %'.$searchKey.'%';
	
	}
	
	
	
	if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(FacilityAssessment.invsetigation_date)>="'.$fromdate.'" and date(FacilityAssessment.invsetigation_date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(FacilityAssessment.invsetigation_date)="'.$fromdate.'"';
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
		$condition2.=' and FacilityAssessment.status="active"';
		$this->response->download("FacilityAssessment.csv");
		//print_r($condition); exit;
	    $data=$this->FacilityAssessment->query('select FacilityAssessment.id,FacilityAssessment.invsetigation_date,FacilityAssessment.investigator_name,FacilityAssessment.name_of_responder_one,City.name,Block.name,Facility.health_facility_name,Panchayat.name,Facility.facility_type,FacilityAssessment.mobile_responder_one,FacilityAssessment.name_of_responder_two,FacilityAssessment.mobile_responder_two,FacilityAssessment.start_time_assessment,FacilityAssessment.end_time_assessment,FacilityAssessment.feed_title,Subfeedback.name,FacilityAssessment.response,FacilityAssessment.status from facility_assessments as FacilityAssessment left join cities as City  on FacilityAssessment.district=City.id left join blocks as Block  on FacilityAssessment.block=Block.id left join facility_details as Facility  on FacilityAssessment.health_facility_name=Facility.id left join panchayats as Panchayat on FacilityAssessment.panchayat=Panchayat.id left join subfeedbacks as Subfeedback on FacilityAssessment.question=Subfeedback.id where 1 '.$condition2 );
		
		
		//$data = $this->Geographical->find('all', array('conditions'=>$condition2));
		
		//$log = $this->Enquiry->getDataSource()->getLog(false, false);
        //debug($log);
		//exit;
		
            $headers = array('FacilityAssessment'=>array( 'Id' => 'Id','District' => 'District', 'Block' => 'Block','Panchayat' => 'Panchayat','Date of Investigation'=>'Date of Investigation','Name of Investigator'=>'Name of Investigator','Name of Health Facility'=>'Name of Health Facility','Type of Health Facility'=>'Type of Health Facility','Name of Responder One'=>'Name of Responder One','Mobile Number'=>'Mobile Number','Name of Responder Two'=>'Name of Responder Two','Mobile Number'=>'Mobile Number','Start time of assessement'=>'Start time of assessement','End time of assessement'=>'End time of assessement','Question'=>'Question','Answer'=>'Answer','Status'=>'Status')); 
	    $this->set(compact('data','headers'));
		$this->layout = 'ajax';
		return;
		
		}
  ////  reports section ---///// 
	
	}
	
	
	
	
