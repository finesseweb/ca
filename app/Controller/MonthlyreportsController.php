<?php
App::uses('AppController', 'Controller');
/**
 * Ngos Controller
 *
 * @property Ngo $GeographicalNgo
 * @property PaginatorComponent $Paginator
 */
class MonthlyreportsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Upload');

    var  $uses = array('Monthlyreport','Feedback','Subfeedback','User','Level','Village','Panchayat','MeetingFacilitated','Country','City','Block','Designation','Ward','IssueCategory','IssueSubcategory','Bpccc','Bpc','Dpo');
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
    $condition['OR']=array('Monthlyreport.id LIKE'=>'%'.$searchKey.'%','Monthlyreport.name_of_monitor LIKE'=>'%'.$searchKey.'%','Monthlyreport.vhsnc_name LIKE'=>'%'.$searchKey.'%','Monthlyreport.response LIKE '=>'%'.$searchKey.'%','Monthlyreport.status LIKE '=>'%'.$searchKey.'%'); 
	
	}
		
		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
                                $condition['AND']=array('date(Monthlyreport.month) >='=>$fromdate,'date(Monthlyreport.month) <='=>$todate);
			
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['Monthlyreport.month']=$fromdate;	
				}
				
			}
		if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBuilderId=trim($this->request->query['block']); 
		$condition['Monthlyreport.block']=$searchBuilderId;
		}
		if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchPanchayatId=trim($this->request->query['panchayat']); 
		$condition['Monthlyreport.panchayat']=$searchPanchayatId;
		}
		
		if(isset($this->request->query['level']) and ($this->request->query['level']!=0) and ($this->request->query['level']!='')){$searchProjectId=trim($this->request->query['level']);
		$condition['Monthlyreport.level']=$searchProjectId;
		}
//                if(isset($this->request->query['ward']) and ($this->request->query['ward']!=0) and ($this->request->query['ward']!='')){$searchProjectId=trim($this->request->query['ward']);
//		$condition['Monthlyreport.ward']=$searchProjectId;
//		}
		
		
		
	}
		 if(CakeSession::read('User.type')==='regular'){
             //echo CakeSession::read('User.subrole');
            // die();
             if(CakeSession::read('User.subrole')==='CC'){
		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'))));
                      if($r){ 
                          if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchPanchayatId=trim($this->request->query['panchayat']); 
		$condition['Monthlyreport.panchayat']=$searchPanchayatId;
		} else {
                      // $condition='Monthlyreport.panchayat='.$r['Bpccc']['allocated_panchayat'];
                        $condition=['Monthlyreport.panchayat IN' =>explode(',',$r['Bpccc']['allocated_panchayat'])];
                }
                
                if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
                                $condition['AND']=array('date(Monthlyreport.month) >='=>$fromdate,'date(Monthlyreport.month) <='=>$todate);
			
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['Monthlyreport.month']=$fromdate;	
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
		$condition['Monthlyreport.block']=$searchBuilderId;
		} else {
                       //$condition='Monthlyreport.block='.$r['Bpc']['allocated_block'];
                       $condition=['Monthlyreport.block IN' =>explode(',',$r['Bpc']['allocated_block'])];
                }
                if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
                                 $condition['AND']=array('date(Monthlyreport.month) >='=>$fromdate,'date(Monthlyreport.month) <='=>$todate);
			
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['Monthlyreport.month']=$fromdate;	
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
		$condition['Monthlyreport.block']=$searchBuilderId;
		}   else {  
                       $condition='Monthlyreport.district='.$r['Dpo']['district'];
                }
                if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
                                 $condition['AND']=array('date(Monthlyreport.month) >='=>$fromdate,'date(Monthlyreport.month) <='=>$todate);
			
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['Monthlyreport.month']=$fromdate;	
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
		
               $this->Paginator->settings = array('Monthlyreport' => array('limit' =>20,'group'=>array('level','panchayat'),'order' => array('id' => 'desc'),'conditions'=>array($condition,'Monthlyreport.status'=>'active')));
		$this->Monthlyreport->recursive = 0;
		$this->set('vhsncafcs', $this->Paginator->paginate());
		$levels = $this->Level->find('list');
			
//			$users = $this->User->find('list',array('fields'=>array('parent'),'conditions'=>array('status'=>'active')));
//			$builders=$this->Builder->find('list');
			$this->set(compact('panchayats','villages','wards','blocks','levels'));
			
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Monthlyreport->exists($id)) {
			throw new NotFoundException(__('Invalid Commom Report'));
		}
		$options = array('conditions' => array('Monthlyreport.' . $this->Monthlyreport->primaryKey => $id));
		$this->set('vhsncAfc', $this->Monthlyreport->find('first', $options));
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
			$this->Monthlyreport->create();
                     // print_r($this->request->data);
                       
                       // echo count($this->request->data['VhsncAfc']['member_name']);
                      // die();
                         
                           for($y=0;$y<count($this->request->data['Monthlyreport']['question_id']);$y++){
                               
                           
                            $district =  $this->request->data['Monthlyreport']['district'];
                            $block =  $this->request->data['Monthlyreport']['block'];
                            $panchayat =  $this->request->data['Monthlyreport']['panchayat'];
                            //$village =  $this->request->data['Monthlyreport']['village'];
                            //$ward =  $this->request->data['Monthlyreport']['ward'];
                            $meeting_date = date('Y-m-d',strtotime($this->request->data['Monthlyreport']['month']));
                            //$activity =  $this->request->data['Monthlyreport']['activity'];
                            $level =  $this->request->data['Monthlyreport']['level'];
                            $user_id=  $this->request->data['Monthlyreport']['user_id'];
                            $created_date =  $this->request->data['Monthlyreport']['created_date'];
                           
                             $remarks =  $this->request->data['Monthlyreport']['remarks'];
                            $hidden =  $this->request->data['Monthlyreport']['question_id'][$y];
                            //$hidden=$member;
                            $question =  $this->request->data['Monthlyreport']['question_id'][$y];
                            $response =  $this->request->data['Monthlyreport']['response'][$y];
                            //$feedback_remarks = $this->request->data['Monthlyreport']['feedback_remarks'][$y];
                            
                    $data=array (
                                'district'=>$district,
                                'block'=>$block,
                                'panchayat'=>$panchayat,
                                //'village'=>$village,
                                //'ward' =>$ward,
                                'month' =>$meeting_date,
                                'created_date'=>$created_date,
                                //'vhsnc_name'=> $vhsnc_name,
                                'level'=>$level,
                                'remarks'=>$remarks,
                                
                               'feed_title'=>$hidden,
                               'question'=>$question,
                               'response'=>$response,
                               'user_id'=>$user_id,
                               //'feedback_remarks'=>$feedback_remarks,
                               'updated'=>0
                                
                                );  
                    
                          $save=$this->Monthlyreport->saveAll($data);
			 
                         }
                          
                         
                           //} //} }   
                         
                             
                         if($save) {
                         $this->Session->setFlash(__('The Commom  Report has been saved.'));
				return $this->redirect(array('action' => 'index'));

                        } else {
				$this->Session->setFlash(__('The Commom Report could not be saved. Please, try again.'));
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
		
               // $feedbacks = array('Feedback' => array('limit' =>20,'order' => array('id' => 'desc')));
		$level = $this->Level->find('list');
                $feedbacks=$this->Feedback->find('all',array('conditions'=>array('Feedback.category'=>'checklist-vhsnc')));
		
		$this->set(compact('panchayat','cities','level','blocks','village','feedbacks'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Monthlyreport->exists($id)) {
			throw new NotFoundException(__('Invalid VHSNC Feedback'));
		}
		if ($this->request->is(array('post', 'put'))) {
                     
                            $district =  $this->request->data['Monthlyreport']['district'];
                            $block =  $this->request->data['Monthlyreport']['block'];
                            $panchayat =  $this->request->data['Monthlyreport']['panchayat'];
                            //$village =  $this->request->data['Monthlyreport']['village'];
                            //$ward =  $this->request->data['Monthlyreport']['ward'];
                           // $meeting_date =  date('Y-m-d',strtotime($this->request->data['Monthlyreport']['date']));
                             //$created_date =  $this->request->data['Monthlyreport']['created_date'];
                             $level =  $this->request->data['Monthlyreport']['level'];
                            // $user_id=  $this->request->data['Monthlyreport']['user_id'];
                            //$level=  $this->request->data['Monthlyreport']['level'];
                             $remarks =  $this->request->data['Monthlyreport']['remarks'];
                    $data=array (
                        
                                'district'=>$district,
                                'block'=>$block,
                                'panchayat'=>$panchayat,
                                //'village'=>$village,
                                //'ward' =>$ward,
                                //'date' =>$meeting_date,
                                ///'activity'=>$activity,
                                //'vhsnc_name'=> $vhsnc_name,
                                'level'=>$level,
                                'remarks'=>$remarks,
                                //'user_id'=>$user_id,
                                'updated'=>1,
                                'id'=>$id
                                ); 
                        $save=$this->Monthlyreport->save($data);
				
                         //}///} } } 
			if ($save) {
				$this->Session->setFlash(__('The Common Report has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Common Report could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Monthlyreport.' . $this->Monthlyreport->primaryKey => $id));
			$this->request->data = $this->Monthlyreport->find('first', $options);
			//$executives=$this->User->find('list',array('conditions'=>array('User.status'=>'active','User.role'=>'regular')));
//			
			}
                        
                  if(CakeSession::read('User.type')==='regular'){
                     
                     if(CakeSession::read('User.subrole')==='CC'){
		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'))));
                      
	            $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Bpccc']['allocated_district'])));
                    $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id'=>$r['Bpccc']['allocated_block'])));
                   $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Panchayat.id IN'=>explode(',',$r['Bpccc']['allocated_panchayat']))));
                    if($this->request->data['Monthlyreport']['panchayat']!=0 and $this->request->data['Monthlyreport']['panchayat']!='')
			{
		     $village=$this->Village->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Village.panchayat_id'=>$this->request->data['Monthlyreport']['panchayat'])));
		    }
                    else {
                   $village=$this->Village->find('list',array('order'=>array('name'=>'asc'),));
                        
                    }
		}
                
                 elseif(CakeSession::read('User.subrole')==='BPC'){
		  $r = $this->Bpc->find('first',array('conditions'=>array('Bpc.first_name='.CakeSession::read('User.id'))));
                      
	            $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Bpc']['allocated_district'])));
                    $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id IN'=>explode(',',$r['Bpc']['allocated_block']))));
                     if($this->request->data['Monthlyreport']['panchayat']!=0 and $this->request->data['Monthlyreport']['panchayat']!='')
			{
		     $village=$this->Village->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Village.panchayat_id'=>$this->request->data['Monthlyreport']['panchayat'])));
		    }
                    else {
                        $village=$this->Village->find('list');
                    }
                   if($this->request->data['Monthlyreport']['panchayat']!=0 and $this->request->data['Monthlyreport']['panchayat']!='')
			{
		     $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Panchayat.id'=>$this->request->data['Monthlyreport']['panchayat'])));
		    } else {
                        $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc')));
                    }
                    
                    
		}
                
                
                 else {
		  $r = $this->Dpo->find('first',array('conditions'=>array('Dpo.first_name='.CakeSession::read('User.id'))));
                         
	            $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Dpo']['district'])));
                  if($this->request->data['Monthlyreport']['panchayat']!=0 and $this->request->data['Monthlyreport']['panchayat']!='')
			{
		     $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id'=>$this->request->data['Monthlyreport']['block'])));
		    }
                    else {
                        $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc')));
                    } 
                    if($this->request->data['Monthlyreport']['panchayat']!=0 and $this->request->data['Monthlyreport']['panchayat']!='')
			{
		     $village=$this->Village->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Village.panchayat_id'=>$this->request->data['Monthlyreport']['panchayat'])));
		    }
                    else {
                        $village=$this->Village->find('list',array('order'=>array('name'=>'asc')));
                    }
                   if($this->request->data['Monthlyreport']['panchayat']!=0 and $this->request->data['Monthlyreport']['panchayat']!='')
			{
		     $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Panchayat.id'=>$this->request->data['Monthlyreport']['panchayat'])));
		    } else {
                        $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc')));
                    }
		}
		   }
                else {
                    $cities=$this->City->find('list',array('order'=>array('name'=>'asc')));
                     if($this->request->data['Monthlyreport']['panchayat']!=0 and $this->request->data['Monthlyreport']['panchayat']!='')
			{
		     $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id'=>$this->request->data['Monthlyreport']['block'])));
		    }
                    else {
                        $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc')));
                    } 
                    if($this->request->data['Monthlyreport']['panchayat']!=0 and $this->request->data['Monthlyreport']['panchayat']!='')
			{
		     $village=$this->Village->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Village.panchayat_id'=>$this->request->data['Monthlyreport']['panchayat'])));
		    }
                    else {
                        $village=$this->Village->find('list',array('order'=>array('name'=>'asc')));
                    }
                   if($this->request->data['Monthlyreport']['panchayat']!=0 and $this->request->data['Monthlyreport']['panchayat']!='')
			{
		     $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Panchayat.id'=>$this->request->data['Monthlyreport']['panchayat'])));
		    } else {
                        $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc')));
                    }
                }
		//$cities=$this->City->find('list');
               // $desig=$this->Designation->find('list');
		//$blocks=$this->Block->find('list');
		//$reg=$this->FacilityDetail->find('list');
               // $panchayat=$this->Panchayat->find('list');
               // $village=$this->Village->find('list');
                //$ward=$this->Ward->find('list');
                //$issue=$this->IssueCategory->find('list');
                //$subissue=$this->IssueSubcategory->find('list');
                //$facilitated=$this->MeetingFacilitated->find('list');
                //$feedbacks=$this->Feedback->find('all');
                $level = $this->Level->find('list');
		$this->set(compact('panchayat','cities','level','blocks','desig','village','facilitated','ward','issue','subissue','feedbacks'));
	
	}
	
	
	
	

	
	public function delete($id = null,$status='deactive') {
		$this->Monthlyreport->id = $id;
		if (!$this->Monthlyreport->exists()) {
			throw new NotFoundException(__('Invalid Common Report Detail'));
		}
		    //$this->request->onlyAllow('post', 'delete');
		    $this->Monthlyreport->read(null,$id);
			$this->Monthlyreport->set(array('status'=>$status));
		
		if ($this->Monthlyreport->save()) {
			$this->Session->setFlash(__('The Common Report has been '.$status));
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
	$condition2.=' and Monthlyreport.id LIKE %'.$searchKey.'% || Monthlyreport.name_of_monitor LIKE %'.$searchKey.'% Monthlyreport.vhsnc_name LIKE %'.$searchKey.'% || Monthlyreport.responce LIKE %'.$searchKey.'% || Monthlyreport.status LIKE %'.$searchKey.'%';
	
	}
	
	
	
	if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(Monthlyreport.month)>="'.$fromdate.'" and date(Monthlyreport.month)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(Monthlyreport.month)="'.$fromdate.'"';
				}
				else
				{
					
					}
			}
			
			
  
		
		
		if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBlockId=trim($this->request->query['block']); //$condition['Enquiry.builder_id']=$searchBuilderId;
		$condition2.=' and Monthlyreport.block='.$searchBlockId;
		}
		
		if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchProjectId=trim($this->request->query['panchayat']); //$condition['Enquiry.project_id']=$searchProjectId;
		$condition2.=' and Monthlyreport.panchayat='.$searchProjectId;
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
                             $condition2.=' and Monthlyreport.panchayat='.$searchProjectId;
		           }   else { 
                        ///$condition=['VhsncAfc.panchayat IN' =>explode(',',$r['Bpccc']['allocated_panchayat'])]; 
                         $condition2.=' and Monthlyreport.panchayat IN ('.$r['Bpccc']['allocated_panchayat'].')';
                      }
                      if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(Monthlyreport.month)>="'.$fromdate.'" and date(Monthlyreport.month)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(Monthlyreport.month)="'.$fromdate.'"';
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
		        $condition2.=' and Monthlyreport.block='.$searchBlockId;
		        }else {
                            
                       $condition2.=' and Monthlyreport.block IN ('.$r['Bpc']['allocated_block'].')';
                       
                      }
                      if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(Monthlyreport.month)>="'.$fromdate.'" and date(Monthlyreport.month)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(Monthlyreport.month)="'.$fromdate.'"';
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
                               $condition2.=' and Monthlyreport.block='.$searchBlockId;
		        // $condition['VhsncAfc.block']=$searchBlockId;
		        }else {
                       //$condition='VhsncAfc.district='.$r['Dpo']['district'];
                        $condition2.=' and Monthlyreport.district IN ('.$r['Dpo']['district'].')';
                        }
                        if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(Monthlyreport.month)>="'.$fromdate.'" and date(Monthlyreport.month)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(Monthlyreport.month)="'.$fromdate.'"';
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
		$condition2.=' and Monthlyreport.status="active"';
		$this->response->download("Monthlyreport.csv");
		//print_r($condition2); exit;
	    $data=$this->Monthlyreport->query('select Monthlyreport.id,Monthlyreport.month,User.name,User.last_name,Level.name,City.name,Block.name,Panchayat.name,Monthlyreport.feed_title,Monthlyreport.remarks,Subfeedback.name,Monthlyreport.response,Monthlyreport.status from monthlyreports as Monthlyreport left join cities as City  on Monthlyreport.district=City.id left join blocks as Block  on Monthlyreport.block=Block.id left join panchayats as Panchayat  on Monthlyreport.panchayat=Panchayat.id left join subfeedbacks as Subfeedback on Monthlyreport.question=Subfeedback.id left join users as User on Monthlyreport.user_id=User.id left join levels as Level on Monthlyreport.level=Level.id where 1 '.$condition2 );
		
		

		
            $headers = array('Monthlyreport'=>array( 'Id' => 'Id','District' => 'District', 'Block' => 'Block','Panchayat' => 'Panchayat','Month'=>'Month','User'=>'User','Level'=>'Level','Question'=>'Question','Answer'=>'Answer','Status'=>'Status','Remarks'=>'Remarks')); 
	    $this->set(compact('data','headers'));
		$this->layout = 'ajax';
		return;
		
		}
  ////  reports section ---///// 
	
	}
	
	
	
	
