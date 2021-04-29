<?php
App::uses('AppController', 'Controller');
/**
 * Ngos Controller
 *
 * @property Ngo $GeographicalNgo
 * @property PaginatorComponent $Paginator
 */
class ChecklistsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Upload');

    var  $uses = array('Checklist','Feedback','Subfeedback','Level','User','FacilityDetail','Village','Panchayat','MeetingFacilitated','Country','City','Block','Designation','Ward','IssueCategory','IssueSubcategory','Bpccc','Bpc','Dpo');
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
    $condition['OR']=array('Checklist.id LIKE'=>'%'.$searchKey.'%','Checklist.name_of_monitor LIKE'=>'%'.$searchKey.'%','Checklist.response LIKE'=>'%'.$searchKey.'%','Checklist.status LIKE '=>'%'.$searchKey.'%'); 
	
	}
		
		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(Checklist.monitoring_date) >='=>$fromdate,'date(Checklist.monitoring_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['Checklist.monitoring_date']=$fromdate;	
				}
				
			}
		if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBuilderId=trim($this->request->query['block']); 
		$condition['Checklist.block']=$searchBuilderId;
		}
		if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchPanchayatId=trim($this->request->query['panchayat']); 
		$condition['Checklist.panchayat']=$searchPanchayatId;
		}
		
		if(isset($this->request->query['village']) and ($this->request->query['village']!=0) and ($this->request->query['village']!='')){$searchProjectId=trim($this->request->query['village']);
		$condition['Checklist.village']=$searchProjectId;
		}
//                if(isset($this->request->query['ward']) and ($this->request->query['ward']!=0) and ($this->request->query['ward']!='')){$searchProjectId=trim($this->request->query['ward']);
//		$condition['Checklist.ward']=$searchProjectId;
//		}
		
		
		
	}
		 if(CakeSession::read('User.type')==='regular'){
             //echo CakeSession::read('User.subrole');
            // die();
             if(CakeSession::read('User.subrole')==='CC'){
		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'))));
                      if($r){ 
                          if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchPanchayatId=trim($this->request->query['panchayat']); 
		$condition['Checklist.panchayat']=$searchPanchayatId;
		} else {
                      // $condition='Checklist.panchayat='.$r['Bpccc']['allocated_panchayat'];
                        $condition=['Checklist.panchayat IN' =>explode(',',$r['Bpccc']['allocated_panchayat'])];
                }
                if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('Checklist.id LIKE'=>'%'.$searchKey.'%','Checklist.name_of_monitor LIKE'=>'%'.$searchKey.'%','Checklist.response LIKE'=>'%'.$searchKey.'%','Checklist.status LIKE '=>'%'.$searchKey.'%'); 
	
	}
		
		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(Checklist.monitoring_date) >='=>$fromdate,'date(Checklist.monitoring_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['Checklist.monitoring_date']=$fromdate;	
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
		$condition['Checklist.block']=$searchBuilderId;
		} else {
                       //$condition='Checklist.block='.$r['Bpc']['allocated_block'];
                       $condition=['Checklist.block IN' =>explode(',',$r['Bpc']['allocated_block'])];
                }
                if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('Checklist.id LIKE'=>'%'.$searchKey.'%','Checklist.name_of_monitor LIKE'=>'%'.$searchKey.'%','Checklist.response LIKE'=>'%'.$searchKey.'%','Checklist.status LIKE '=>'%'.$searchKey.'%'); 
	
	}
		
		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(Checklist.monitoring_date) >='=>$fromdate,'date(Checklist.monitoring_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['Checklist.monitoring_date']=$fromdate;	
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
		$condition['Checklist.block']=$searchBuilderId;
		}   else {  
                       $condition='Checklist.district='.$r['Dpo']['district'];
                }
                if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('Checklist.id LIKE'=>'%'.$searchKey.'%','Checklist.name_of_monitor LIKE'=>'%'.$searchKey.'%','Checklist.response LIKE'=>'%'.$searchKey.'%','Checklist.status LIKE '=>'%'.$searchKey.'%'); 
	
	}
		
		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(Checklist.monitoring_date) >='=>$fromdate,'date(Checklist.monitoring_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['Checklist.monitoring_date']=$fromdate;	
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
		$this->Paginator->settings = array('Checklist' => array('limit' =>20,'group' => array('Checklist.monitoring_date','Checklist.village'),'order' => array('id' => 'desc'),'conditions'=>array($condition,'Checklist.status'=>'active')));
		$this->Checklist->recursive = 0;
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
		if (!$this->Checklist->exists($id)) {
			throw new NotFoundException(__('Invalid VHSNC Feedback'));
		}
		$options = array('conditions' => array('Checklist.' . $this->Checklist->primaryKey => $id));
		$this->set('vhsncAfc', $this->Checklist->find('first', $options));
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
			$this->Checklist->create();
                     // print_r($this->request->data);
                       
                       // echo count($this->request->data['VhsncAfc']['member_name']);
                        //die();
                        //for($i=0;$i<count($this->request->data['Checklist']['hidden']);$i++){
                            
                            //echo $i;
                            //foreach($this->request->data['Checklist']['hidden'] as $member) {
                                 //print_r($member);
                              //die(); 
                           for($y=0;$y<count($this->request->data['Checklist']['question_id']);$y++){
                                //foreach($this->request->data['Checklist']['question'] as $que) {
                                      // print_r($this->request->data);
                              //die(); 
                                   // foreach($this->request->data['VhsncAfc']['induction_training_date'] as $induction_training_date) {
                                    //foreach($this->request->data['VhsncAfc']['refresher_date'] as $refresher_date) {
                          //print_r($mobile);
                          //die();
                           
                           $district =  $this->request->data['Checklist']['district'];
                            $block =  $this->request->data['Checklist']['block'];
                            $panchayat =  $this->request->data['Checklist']['panchayat'];
                            $village =  $this->request->data['Checklist']['village'];
                            //$ward =  $this->request->data['Checklist']['ward'];
                            $monitoring_date =  date('Y-m-d',strtotime($this->request->data['Checklist']['monitoring_date']));
                            $name_of_monitor =  $this->request->data['Checklist']['name_of_monitor'];
                            $awc_code =  $this->request->data['Checklist']['awc_code'];
                            $level=  $this->request->data['Checklist']['level'];
                            
                            $remarks =  $this->request->data['Checklist']['remarks'];
                            $hidden =  $this->request->data['Checklist']['question_id'][$y];
                            //$hidden=$member;
                            $question =  $this->request->data['Checklist']['question_id'][$y];
                            $response =  $this->request->data['Checklist']['response'][$y];
                            $feedback_remarks = $this->request->data['Checklist']['feedback_remarks'][$y];
                            
                    $data=array (
                                'district'=>$district,
                                'block'=>$block,
                                'panchayat'=>$panchayat,
                                'village'=>$village,
                                //'ward' =>$ward,
                                'monitoring_date' =>$monitoring_date,
                                'name_of_monitor'=>$name_of_monitor,
                                'awc_code'=> $awc_code,
                                'level'=>$level,
                                'remarks'=>$remarks,
                                
                                'feed_title'=>$hidden,
                                'question'=>$question,
                                'response'=>$response,
                                'feedback_remarks'=>$feedback_remarks,
                                 'updated'=>0
                                
                                );  
                    
                          $save=$this->Checklist->saveAll($data);
			 
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
                $level = $this->Level->find('list');
               // $feedbacks = array('Feedback' => array('limit' =>20,'order' => array('id' => 'desc')));
		$feedbacks=$this->Feedback->find('all',array('conditions'=>array('Feedback.category'=>'checklist')));
		
		$this->set(compact('panchayat','cities','level','reg','blocks','desig','village','facilitated','ward','issue','subissue','feedbacks'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Checklist->exists($id)) {
			throw new NotFoundException(__('Invalid VHSNC Feedback'));
		}
		if ($this->request->is(array('post', 'put'))) {
                     
                            $district =  $this->request->data['Checklist']['district'];
                          
                            $block =  $this->request->data['Checklist']['block'];
                            $panchayat =  $this->request->data['Checklist']['panchayat'];
                            $village =  $this->request->data['Checklist']['village'];
                            //$ward =  $this->request->data['Checklist']['ward'];
                            $monitoring_date =  date('Y-m-d',strtotime($this->request->data['Checklist']['monitoring_date']));
                            $name_of_monitor =  $this->request->data['Checklist']['name_of_monitor'];
                            $awc_code =  $this->request->data['Checklist']['awc_code'];
                            $level=  $this->request->data['Checklist']['level'];
                             $remarks =  $this->request->data['Checklist']['remarks'];
                    $data=array (
                        
                                'district'=>$district,
                                'block'=>$block,
                                'panchayat'=>$panchayat,
                                'village'=>$village,
                                //'ward' =>$ward,
                                'monitoring_date' =>$monitoring_date,
                                'name_of_monitor'=>$name_of_monitor,
                                'awc_code'=> $awc_code,
                                'level'=>$level,
                                'remarks'=>$remarks,
                                'updated'=>1,
                                'id'=>$id
                                ); 
                        $save=$this->Checklist->save($data);
				
                         //}///} } } 
			if ($save) {
				$this->Session->setFlash(__('The VHSNC Feedback has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The VHSNC Feedback could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Checklist.' . $this->Checklist->primaryKey => $id));
			$this->request->data = $this->Checklist->find('first', $options);
			//$executives=$this->User->find('list',array('conditions'=>array('User.status'=>'active','User.role'=>'regular')));
//			
			}
                        
                  if(CakeSession::read('User.type')==='regular'){
                     
                     if(CakeSession::read('User.subrole')==='CC'){
		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'))));
                      
	            $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Bpccc']['allocated_district'])));
                    $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id'=>$r['Bpccc']['allocated_block'])));
                   $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Panchayat.id IN'=>explode(',',$r['Bpccc']['allocated_panchayat']))));
                    if($this->request->data['Checklist']['panchayat']!=0 and $this->request->data['Checklist']['panchayat']!='')
			{
		     $village=$this->Village->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Village.panchayat_id'=>$this->request->data['Checklist']['panchayat'])));
		    }
                    else {
                   $village=$this->Village->find('list',array('order'=>array('name'=>'asc'),));
                        
                    }
		}
                
                 elseif(CakeSession::read('User.subrole')==='BPC'){
		  $r = $this->Bpc->find('first',array('conditions'=>array('Bpc.first_name='.CakeSession::read('User.id'))));
                      
	            $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Bpc']['allocated_district'])));
                    $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id IN'=>explode(',',$r['Bpc']['allocated_block']))));
                     if($this->request->data['Checklist']['panchayat']!=0 and $this->request->data['Checklist']['panchayat']!='')
			{
		     $village=$this->Village->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Village.panchayat_id'=>$this->request->data['Checklist']['panchayat'])));
		    }
                    else {
                        $village=$this->Village->find('list');
                    }
                   if($this->request->data['Checklist']['panchayat']!=0 and $this->request->data['Checklist']['panchayat']!='')
			{
		     $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Panchayat.id'=>$this->request->data['Checklist']['panchayat'])));
		    } else {
                        $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc')));
                    }
                    
                    
		}
                
                
                 else {
		  $r = $this->Dpo->find('first',array('conditions'=>array('Dpo.first_name='.CakeSession::read('User.id'))));
                         
	            $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Dpo']['district'])));
                  if($this->request->data['Checklist']['panchayat']!=0 and $this->request->data['Checklist']['panchayat']!='')
			{
		     $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id'=>$this->request->data['Checklist']['block'])));
		    }
                    else {
                        $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc')));
                    } 
                    if($this->request->data['Checklist']['panchayat']!=0 and $this->request->data['Checklist']['panchayat']!='')
			{
		     $village=$this->Village->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Village.panchayat_id'=>$this->request->data['Checklist']['panchayat'])));
		    }
                    else {
                        $village=$this->Village->find('list',array('order'=>array('name'=>'asc')));
                    }
                   if($this->request->data['Checklist']['panchayat']!=0 and $this->request->data['Checklist']['panchayat']!='')
			{
		     $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Panchayat.id'=>$this->request->data['Checklist']['panchayat'])));
		    } else {
                        $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc')));
                    }
		}
		   }
                else {
                    $cities=$this->City->find('list',array('order'=>array('name'=>'asc')));
                     if($this->request->data['Checklist']['panchayat']!=0 and $this->request->data['Checklist']['panchayat']!='')
			{
		     $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id'=>$this->request->data['Checklist']['block'])));
		    }
                    else {
                        $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc')));
                    } 
                    if($this->request->data['Checklist']['panchayat']!=0 and $this->request->data['Checklist']['panchayat']!='')
			{
		     $village=$this->Village->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Village.panchayat_id'=>$this->request->data['Checklist']['panchayat'])));
		    }
                    else {
                        $village=$this->Village->find('list',array('order'=>array('name'=>'asc')));
                    }
                   if($this->request->data['Checklist']['panchayat']!=0 and $this->request->data['Checklist']['panchayat']!='')
			{
		     $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Panchayat.id'=>$this->request->data['Checklist']['panchayat'])));
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
                 $level = $this->Level->find('list');
                //$issue=$this->IssueCategory->find('list');
                //$subissue=$this->IssueSubcategory->find('list');
                //$facilitated=$this->MeetingFacilitated->find('list');
                //$feedbacks=$this->Feedback->find('all');
		$this->set(compact('panchayat','cities','reg','level','blocks','desig','village','facilitated','ward','issue','subissue','feedbacks'));
	
	}
	
	
	
	

	
	public function delete($id = null,$status='deactive') {
		$this->Checklist->id = $id;
		if (!$this->Checklist->exists()) {
			throw new NotFoundException(__('Invalid Vhsnc/Afc Detail'));
		}
		    //$this->request->onlyAllow('post', 'delete');
		    $this->Checklist->read(null,$id);
			$this->Checklist->set(array('status'=>$status));
		
		if ($this->Checklist->save()) {
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
	$condition2.=' and Checklist.id LIKE %'.$searchKey.'% || Checklist.name_of_monitor LIKE %'.$searchKey.'% Checklist.response LIKE %'.$searchKey.'% || Checklist.status LIKE %' .$searchKey.'%';
	
	}
	
	
	
	if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(Checklist.monitoring_date)>="'.$fromdate.'" and date(Checklist.monitoring_date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(Checklist.monitoring_date)="'.$fromdate.'"';
				}
				else
				{
					
					}
			}
			
			
  
		
		
		if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBlockId=trim($this->request->query['block']); //$condition['Enquiry.builder_id']=$searchBuilderId;
		$condition2.=' and Checklist.block='.$searchBlockId;
		}
		
		if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchProjectId=trim($this->request->query['panchayat']); //$condition['Enquiry.project_id']=$searchProjectId;
		$condition2.=' and Checklist.panchayat='.$searchProjectId;
		}
               
                if(isset($this->request->query['village']) and ($this->request->query['village']!=0) and ($this->request->query['village']!='')){$searchVillageId=trim($this->request->query['village']); //$condition['Enquiry.project_id']=$searchProjectId;
		$condition2.=' and Checklist.village='.$searchVillageId;
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
                             $condition2.=' and Checklist.panchayat='.$searchProjectId;
		           }   else { 
                        ///$condition=['VhsncAfc.panchayat IN' =>explode(',',$r['Bpccc']['allocated_panchayat'])]; 
                         $condition2.=' and Checklist.panchayat IN ('.$r['Bpccc']['allocated_panchayat'].')';
                      }
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    //$condition['OR']=array('Geographical.id LIKE'=>'%'.$searchKey.'%','Geographical.ward LIKE'=>'%'.$searchKey.'%','Geographical.awc_code LIKE'=>'%'.$searchKey.'%','Geographical.awc_worker LIKE '=>'%'.$searchKey.'%','Geographical.asha_name LIKE '=>'%'.$searchKey.'%'); 
	$condition2.=' and Checklist.id LIKE %'.$searchKey.'% || Checklist.name_of_monitor LIKE %'.$searchKey.'% Checklist.response LIKE %'.$searchKey.'% || Checklist.status LIKE %' .$searchKey.'%';
	
	}
	
	
	
	if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(Checklist.monitoring_date)>="'.$fromdate.'" and date(Checklist.monitoring_date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(Checklist.monitoring_date)="'.$fromdate.'"';
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
		        $condition2.=' and Checklist.block='.$searchBlockId;
		        }else {
                            
                       $condition2.=' and Checklist.block IN ('.$r['Bpc']['allocated_block'].')';
                       
                      }
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    //$condition['OR']=array('Geographical.id LIKE'=>'%'.$searchKey.'%','Geographical.ward LIKE'=>'%'.$searchKey.'%','Geographical.awc_code LIKE'=>'%'.$searchKey.'%','Geographical.awc_worker LIKE '=>'%'.$searchKey.'%','Geographical.asha_name LIKE '=>'%'.$searchKey.'%'); 
	$condition2.=' and Checklist.id LIKE %'.$searchKey.'% || Checklist.name_of_monitor LIKE %'.$searchKey.'% Checklist.response LIKE %'.$searchKey.'% || Checklist.status LIKE %' .$searchKey.'%';
	
	}
	
	
	
	if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(Checklist.monitoring_date)>="'.$fromdate.'" and date(Checklist.monitoring_date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(Checklist.monitoring_date)="'.$fromdate.'"';
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
                               $condition2.=' and Checklist.block='.$searchBlockId;
		        // $condition['VhsncAfc.block']=$searchBlockId;
		        }else {
                       //$condition='VhsncAfc.district='.$r['Dpo']['district'];
                        $condition2.=' and Checklist.district IN ('.$r['Dpo']['district'].')';
                        }
                        if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    //$condition['OR']=array('Geographical.id LIKE'=>'%'.$searchKey.'%','Geographical.ward LIKE'=>'%'.$searchKey.'%','Geographical.awc_code LIKE'=>'%'.$searchKey.'%','Geographical.awc_worker LIKE '=>'%'.$searchKey.'%','Geographical.asha_name LIKE '=>'%'.$searchKey.'%'); 
	$condition2.=' and Checklist.id LIKE %'.$searchKey.'% || Checklist.name_of_monitor LIKE %'.$searchKey.'% Checklist.response LIKE %'.$searchKey.'% || Checklist.status LIKE %' .$searchKey.'%';
	
	}
	
	
	
	if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(Checklist.monitoring_date)>="'.$fromdate.'" and date(Checklist.monitoring_date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(Checklist.monitoring_date)="'.$fromdate.'"';
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
		$condition2.=' and Checklist.status="active"';
		$this->response->download("Checklist.csv");
		//print_r($condition); exit;
	    $data=$this->Checklist->query('select Checklist.id,Checklist.monitoring_date,Checklist.name_of_monitor,Checklist.level,Geographical.awc_code,City.name,Block.name,Panchayat.name,Village.name,Geographical.awc_code,Checklist.feed_title,Subfeedback.name,Checklist.response,Checklist.status from checklists as Checklist left join cities as City  on Checklist.district=City.id left join blocks as Block  on Checklist.block=Block.id left join panchayats as Panchayat  on Checklist.panchayat=Panchayat.id left join villages as Village on Checklist.village=Village.id left join subfeedbacks as Subfeedback on Checklist.question=Subfeedback.id left join geographicals as Geographical on Checklist.awc_code=Geographical.id where 1 '.$condition2 );
		
		
		//$data = $this->Geographical->find('all', array('conditions'=>$condition2));
		
		//$log = $this->Enquiry->getDataSource()->getLog(false, false);
        //debug($log);
		//exit;
		
            $headers = array('Checklist'=>array( 'Id' => 'Id','District' => 'District', 'Block' => 'Block','Panchayat' => 'Panchayat','Village'=>'Village','Date'=>'Date','Name of Monitor'=>'Name of Monitor','AWC Code'=>'AWC Code','Level'=>'Level','Question'=>'Question','Answer'=>'Answer','Status'=>'Status')); 
	    $this->set(compact('data','headers'));
		$this->layout = 'ajax';
		return;
		
		}
  ////  reports section ---///// 
	
	}
	
	
	
	
