<?php
App::uses('AppController', 'Controller');
/**
 * Ngos Controller
 *
 * @property Ngo $GeographicalNgo
 * @property PaginatorComponent $Paginator
 */
class IvrssController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Upload');

    var  $uses = array('Ivrs','Contraceptive','VhsncConstitution','Geographical','Ngo','User','MeetingFacilitated','Village','Panchayat','Ward','Country','City','Block','Designation','VhsncAfc','Discussion','Bpccc','Bpc','Dpo');
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
    $condition['OR']=array('Ivrs.id LIKE'=>'%'.$searchKey.'%','Ivrs.ivrs_user_mobile LIKE'=>'%'.$searchKey.'%','Ivrs.ivrs_user_type LIKE'=>'%'.$searchKey.'%','Ivrs.ivrs_user_name LIKE'=>'%'.$searchKey.'%','Ivrs.gender LIKE'=>'%'.$searchKey.'%'); 
	
	}
		
		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition['AND']=array('date(Ivrs.date) >='=>$fromdate,'date(Ivrs.date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['Ivrs.date']=$fromdate;	
				}
				
			}
		
              if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBuilderId=trim($this->request->query['block']); 
		$condition['Ivrs.block']=$searchBuilderId;
		}
		if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchPanchayatId=trim($this->request->query['panchayat']); 
		$condition['Ivrs.panchayat']=$searchPanchayatId;
		}
		
		if(isset($this->request->query['village']) and ($this->request->query['village']!=0) and ($this->request->query['village']!='')){$searchProjectId=trim($this->request->query['village']);
		$condition['Ivrs.village']=$searchProjectId;
		}	
	}
		if(CakeSession::read('User.type')==='regular'){
             //echo CakeSession::read('User.subrole');
            // die();
             if(CakeSession::read('User.subrole')==='CC'){
		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'))));
                      if($r){ 
                        if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchPanchayatId=trim($this->request->query['panchayat']); 
		            $condition['Ivrs.panchayat']=$searchPanchayatId;
		             }  
                             else {
                       //$condition='Ivrs.panchayat='.$r['Bpccc']['allocated_panchayat'];
                       $condition=['Ivrs.panchayat IN' =>explode(',',$r['Bpccc']['allocated_panchayat'])];
                             }
                             
                             if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('Ivrs.id LIKE'=>'%'.$searchKey.'%','Ivrs.ivrs_user_mobile LIKE'=>'%'.$searchKey.'%','Ivrs.ivrs_user_type LIKE'=>'%'.$searchKey.'%','Ivrs.ivrs_user_name LIKE'=>'%'.$searchKey.'%','Ivrs.gender LIKE'=>'%'.$searchKey.'%'); 
	
	}
		
		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition['AND']=array('date(Ivrs.date) >='=>$fromdate,'date(Ivrs.date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date']))); 
				$condition['Ivrs.date']=$fromdate;	
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
		            $condition['Ivrs.block']=$searchBuilderId;
		              }
                              else {
                       //$condition='Ivrs.block='.$r['Bpc']['allocated_block'];
                        $condition=['Ivrs.block IN' =>explode(',',$r['Bpc']['allocated_block'])];
                              }
                              
                              if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('Ivrs.id LIKE'=>'%'.$searchKey.'%','Ivrs.ivrs_user_mobile LIKE'=>'%'.$searchKey.'%','Ivrs.ivrs_user_type LIKE'=>'%'.$searchKey.'%','Ivrs.ivrs_user_name LIKE'=>'%'.$searchKey.'%','Ivrs.gender LIKE'=>'%'.$searchKey.'%'); 
	
	}
		
		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition['AND']=array('date(Ivrs.date) >='=>$fromdate,'date(Ivrs.date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['Ivrs.date']=$fromdate;	
				}
				
			}
                      } 
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Village yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
			
                      $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id IN'=>explode(',',$r['Bpc']['allocated_block']))));
                   
                        //$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
				
		}
                
                
                 else {
		   $r = $this->Dpo->find('first',array('conditions'=>array('Dpo.first_name='.CakeSession::read('User.id'))));
                      if($r){ 
                          if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBuilderId=trim($this->request->query['block']); 
		            $condition['Ivrs.block']=$searchBuilderId;
		              } else {
                       $condition='Ivrs.district='.$r['Dpo']['district'];
                              }
                       
                       if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('Ivrs.id LIKE'=>'%'.$searchKey.'%','Ivrs.ivrs_user_mobile LIKE'=>'%'.$searchKey.'%','Ivrs.ivrs_user_type LIKE'=>'%'.$searchKey.'%','Ivrs.ivrs_user_name LIKE'=>'%'.$searchKey.'%','Ivrs.gender LIKE'=>'%'.$searchKey.'%'); 
	
	}
		
		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition['AND']=array('date(Ivrs.date) >='=>$fromdate,'date(Ivrs.date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['Ivrs.date']=$fromdate;	
				}
				
			}
                      } 
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Village yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
			//$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
			$blocks=$this->Block->find('list',array('order'=>array('name'=>'asc')));
                       $panchayats=$this->Panchayat->find('list',array('order'=>array('name'=>'asc')));
                        $villages=$this->Village->find('list',array('order'=>array('name'=>'asc')));
	
		}
         }
         else {
             $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc')));
                $panchayats=$this->Panchayat->find('list',array('order'=>array('name'=>'asc')));
                $villages=$this->Village->find('list',array('order'=>array('name'=>'asc')));

         }
		$this->Paginator->settings = array('Ivrs' => array('limit' =>20,'order' => array('id' => 'desc'),'conditions'=>array($condition,'Ivrs.status'=>'active')));
		$this->Ivrs->recursive = 0;
		$this->set('Ivrss', $this->Paginator->paginate());
		
			
//			$users = $this->User->find('list',array('fields'=>array('parent'),'conditions'=>array('status'=>'active')));
//			$builders=$this->Builder->find('list');
			$this->set(compact('users','blocks','panchayats','villages'));
			
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Ivrs->exists($id)) {
			throw new NotFoundException(__('Invalid Afc Home Visit Member'));
		}
		$options = array('conditions' => array('Ivrs.' . $this->Ivrs->primaryKey => $id));
		$this->set('Ivrs', $this->Ivrs->find('first', $options));
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
			$this->Ivrs->create();
                     // print_r($this->request->data);
                      // die();
                          $sur= implode(',',$this->request->data['Ivrs']['survey_participated']);
                          
                        $district =  $this->request->data['Ivrs']['district'];
                        $block =  $this->request->data['Ivrs']['block'];   
                        $panchayat=   $this->request->data['Ivrs']['panchayat'];
                        $village=   $this->request->data['Ivrs']['village'];
                        $ward=   $this->request->data['Ivrs']['ward'];
                        $date=   $this->request->data['Ivrs']['date'];
                        $ivrs_user_name=   $this->request->data['Ivrs']['ivrs_user_name'];
                        $age=   $this->request->data['Ivrs']['age'];
                        $gender=   $this->request->data['Ivrs']['gender'];
                        $ivrs_user_mobile=   $this->request->data['Ivrs']['ivrs_user_mobile'];
                        $ivrs_user_type=   $this->request->data['Ivrs']['ivrs_user_type'];
                        $registration_status=   $this->request->data['Ivrs']['registration_status'];
                          if(isset($this->request->data['Ivrs']['registration_reason'])){
                                
                                 $registration_reason=   $this->request->data['Ivrs']['registration_reason'];
                            }
                            else {
                                $registration_reason='no';
                            }
                            
                            
                              if(isset($this->request->data['Ivrs']['voice_reason'])){
                                
                                 $voice_reason=   $this->request->data['Ivrs']['voice_reason'];
                            }
                            else {
                                $voice_reason='no';
                            }
                            
                            
                              if(isset($this->request->data['Ivrs']['info_pack_reason'])){
                                
                                  $info_pack_reason   =$this->request->data['Ivrs']['info_pack_reason'];
                            }
                            else {
                                $info_pack_reason='no';
                            }
                            
                    
                        $voice_feedback_recorded=   $this->request->data['Ivrs']['voice_feedback_recorded']; 
                        $information_pack_listen=   $this->request->data['Ivrs']['information_pack_listen'];
                        $remarks=   $this->request->data['Ivrs']['remarks'];
                        
                        $data= array(
                            
                            	'district'=>$district,
                            	'block'=>$block,
                                'panchayat'=>$panchayat,
                            	'village'=>$village,
                                'ward'=>$ward,
                            	'date'=>$date, 
                                'ivrs_user_name'=>$ivrs_user_name,
                            	'age'=>$age,
                                'gender'=>$gender,
                            	'ivrs_user_mobile'=>$ivrs_user_mobile,
                            	'ivrs_user_type'=>$ivrs_user_type,
                                'registration_status'=>$registration_status,
                            	'registration_reason'=>$registration_reason,
                               'survey_participated'=>$sur,
                               'voice_feedback_recorded'=>$voice_feedback_recorded,
                               'voice_reason'=>$voice_reason,
                               'information_pack_listen'=>$information_pack_listen,
                               'info_pack_reason'=>$info_pack_reason,
                               'remarks'=>$remarks
                            
                            
                            
                            
                        );
                        
                           $save=$this->Ivrs->saveAll($data);    
                         if($save) {
                               $this->Session->setFlash(__('The M-Shakti has been saved.'));
				return $this->redirect(array('action' => 'index'));

                        } else {
				$this->Session->setFlash(__('The Adolescent Meeting could not be saved. Please, try again.'));
			}
                         
                    }   
                  if(CakeSession::read('User.type')==='regular'){
                     
                     if(CakeSession::read('User.subrole')==='CC'){
		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'))));
                       
                     
	            $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Bpccc']['allocated_district'])));
                    $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id'=>$r['Bpccc']['allocated_block'])));
                    $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>['Panchayat.id IN'=>explode(',',$r['Bpccc']['allocated_panchayat'])]));
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
                         
	            $cities=$this->City->find('list',array('conditions'=>array('City.id'=>$r['Dpo']['district'])));
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
		//$cities=$this->City->find('list');
                $desig=$this->Designation->find('list');
		//$blocks=$this->Block->find('list');
		$ngos=$this->Ngo->find('list');
                //$panchayat=$this->Panchayat->find('list');
               // $village=$this->Village->find('list');
                $ward=$this->Ward->find('list');
                $vhsnc=$this->VhsncConstitution->find('list');
                $opt=$this->Contraceptive->find('list');
                $facilitated=$this->MeetingFacilitated->find('list');
                $topic=$this->Discussion->find('list');
                $vhsncmembers=$this->VhsncAfc->find('list',array('conditions'=>array('VhsncAfc.member_type'=>'VHSNC')));
		$this->set(compact('cities','panchayat','ngos','blocks','desig','village','ward','vhsnc','vhsncmembers','opt','facilitated','topic'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Ivrs->exists($id)) {
			throw new NotFoundException(__('Invalid VhsncAfc'));
		}
		if ($this->request->is(array('post', 'put'))) {
                            $sur= implode(',',$this->request->data['Ivrs']['survey_participated']);
                          
                        $district =  $this->request->data['Ivrs']['district'];
                        $block =  $this->request->data['Ivrs']['block'];   
                        $panchayat=   $this->request->data['Ivrs']['panchayat'];
                        $village=   $this->request->data['Ivrs']['village'];
                        $ward=   $this->request->data['Ivrs']['ward'];
                        $date=   $this->request->data['Ivrs']['date'];
                        $ivrs_user_name=   $this->request->data['Ivrs']['ivrs_user_name'];
                        $age=   $this->request->data['Ivrs']['age'];
                        $gender=   $this->request->data['Ivrs']['gender'];
                        $ivrs_user_mobile=   $this->request->data['Ivrs']['ivrs_user_mobile'];
                        $ivrs_user_type=   $this->request->data['Ivrs']['ivrs_user_type'];
                        $registration_status=   $this->request->data['Ivrs']['registration_status'];
                          if(isset($this->request->data['Ivrs']['registration_reason'])){
                                
                                 $registration_reason=   $this->request->data['Ivrs']['registration_reason'];
                            }
                            else {
                                $registration_reason='no';
                            }
                            
                            
                              if(isset($this->request->data['Ivrs']['voice_reason'])){
                                
                                 $voice_reason=   $this->request->data['Ivrs']['voice_reason'];
                            }
                            else {
                                $voice_reason='no';
                            }
                            
                            
                              if(isset($this->request->data['Ivrs']['info_pack_reason'])){
                                
                                  $info_pack_reason   =$this->request->data['Ivrs']['info_pack_reason'];
                            }
                            else {
                                $info_pack_reason='no';
                            }
                            
                    
                        $voice_feedback_recorded=   $this->request->data['Ivrs']['voice_feedback_recorded']; 
                        $information_pack_listen=   $this->request->data['Ivrs']['information_pack_listen'];
                        $remarks=   $this->request->data['Ivrs']['remarks'];
                        
                        $data= array(
                                'district'=>$district,
                            	'block'=>$block,
                            	'panchayat'=>$panchayat,
                            	'village'=>$village,
                                'ward'=>$ward,
                            	'date'=>$date, 
                                'ivrs_user_name'=>$ivrs_user_name,
                            	'age'=>$age,
                                'gender'=>$gender,
                            	'ivrs_user_mobile'=>$ivrs_user_mobile,
                            	'ivrs_user_type'=>$ivrs_user_type,
                                'registration_status'=>$registration_status,
                            	'registration_reason'=>$registration_reason,
                               'survey_participated'=>$sur,
                               'voice_feedback_recorded'=>$voice_feedback_recorded,
                               'voice_reason'=>$voice_reason,
                               'information_pack_listen'=>$information_pack_listen,
                               'info_pack_reason'=>$info_pack_reason,
                               'remarks'=>$remarks,
                               'id'=>$id
                            
                            
                            
                            
                        );
                           $save=$this->Ivrs->saveAll($data);
			if ($save) {
				$this->Session->setFlash(__('The M-Shakti  has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The M-Shakti  could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Ivrs.' . $this->Ivrs->primaryKey => $id));
			$this->request->data = $this->Ivrs->find('first', $options);
			$executives=$this->User->find('list',array('conditions'=>array('User.status'=>'active','User.role'=>'regular')));
//			
                }
                 if(CakeSession::read('User.type')==='regular'){
                     
                     if(CakeSession::read('User.subrole')==='CC'){
		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'))));
                       
                       
	            $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Bpccc']['allocated_district'])));
                    $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id'=>$r['Bpccc']['allocated_block'])));
                    $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>['Panchayat.id IN'=>explode(',',$r['Bpccc']['allocated_panchayat'])]));
                    if($this->request->data['Ivrs']['panchayat']!=0 and $this->request->data['Ivrs']['panchayat']!='')
			{
		     $village=$this->Village->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Village.panchayat_id'=>$this->request->data['Ivrs']['panchayat'])));
		    } 
                    else {
                    $village=$this->Village->find('list',array('order'=>array('name'=>'asc')));
                        
                    }	
		}
                
                 elseif(CakeSession::read('User.subrole')==='BPC'){
		  $r = $this->Bpc->find('first',array('conditions'=>array('Bpc.first_name='.CakeSession::read('User.id'))));
                       
                      
	           $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Bpc']['allocated_district'])));
                   $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id IN'=>explode(',',$r['Bpc']['allocated_block']))));
                   if($this->request->data['Ivrs']['panchayat']!=0 and $this->request->data['Ivrs']['panchayat']!='')
			{
		     $village=$this->Village->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Village.panchayat_id'=>$this->request->data['Ivrs']['panchayat'])));
		    } 
                    else {
                    $village=$this->Village->find('list',array('order'=>array('name'=>'asc')));
                        
                    }
                   if($this->request->data['Ivrs']['panchayat']!=0 and $this->request->data['Ivrs']['panchayat']!='')
			{
		     $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Panchayat.id'=>$this->request->data['Ivrs']['panchayat'])));
		    }
                    else {
                        $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'))); 
                    }
		}
                
                
                 else {
		  $r = $this->Dpo->find('first',array('conditions'=>array('Dpo.first_name='.CakeSession::read('User.id'))));
                         
	            $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Dpo']['district'])));
                   if($this->request->data['Ivrs']['block']!=0 and $this->request->data['Ivrs']['block']!='')
			{
		     $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id'=>$this->request->data['Ivrs']['block'])));
		    } 
                    else {
                    $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc')));
                        
                    }
                    if($this->request->data['Ivrs']['panchayat']!=0 and $this->request->data['Ivrs']['panchayat']!='')
			{
		     $village=$this->Village->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Village.panchayat_id'=>$this->request->data['Ivrs']['panchayat'])));
		    } 
                    else {
                    $village=$this->Village->find('list',array('order'=>array('name'=>'asc')));
                        
                    }
                   if($this->request->data['Ivrs']['panchayat']!=0 and $this->request->data['Ivrs']['panchayat']!='')
			{
		     $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Panchayat.id'=>$this->request->data['Ivrs']['panchayat'])));
		    }
                    else {
                        $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'))); 
                    }
		}
		   }
                else {
                    $cities=$this->City->find('list',array('order'=>array('name'=>'asc')));
                    if($this->request->data['Ivrs']['block']!=0 and $this->request->data['Ivrs']['block']!='')
			{
		     $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id'=>$this->request->data['Ivrs']['block'])));
		    } 
                    else {
                    $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc')));
                        
                    }
                    if($this->request->data['Ivrs']['panchayat']!=0 and $this->request->data['Ivrs']['panchayat']!='')
			{
		     $village=$this->Village->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Village.panchayat_id'=>$this->request->data['Ivrs']['panchayat'])));
		    } 
                    else {
                    $village=$this->Village->find('list',array('order'=>array('name'=>'asc')));
                        
                    }
                   if($this->request->data['Ivrs']['panchayat']!=0 and $this->request->data['Ivrs']['panchayat']!='')
			{
		     $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Panchayat.id'=>$this->request->data['Ivrs']['panchayat'])));
		    }
                    else {
                        $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'))); 
                    }
                }
				
		//$cities=$this->City->find('list');
                $desig=$this->Designation->find('list');
		//$blocks=$this->Block->find('list');
		$ngos=$this->Ngo->find('list');
                //$panchayat=$this->Panchayat->find('list');
                //$village=$this->Village->find('list');
                $ward=$this->Ward->find('list');
                $opt=$this->Contraceptive->find('list');
                $vhsnc=$this->VhsncConstitution->find('list');
                  $facilitated=$this->MeetingFacilitated->find('list');
                $topic=$this->Discussion->find('list');
                $vhsncmembers=$this->VhsncAfc->find('list',array('conditions'=>array('VhsncAfc.member_type'=>'VHSNC')));
		$this->set(compact('cities','panchayat','ngos','blocks','desig','village','ward','vhsnc','vhsncmembers','opt','facilitated','topic'));
		
	}
	
	
	
/**  
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null,$status='deactive') {
		$this->Ivrs->id = $id;
		if (!$this->Ivrs->exists()) {
			throw new NotFoundException(__('Invalid M-Shakti  Detail'));
		}
		    //$this->request->onlyAllow('post', 'delete');
		    $this->Ivrs->read(null,$id);
	           $this->Ivrs->set(array('status'=>$status));
		
		if ($this->Ivrs->save()) {
			$this->Session->setFlash(__('The M-Shakti  Detail has been '.$status));
		} else {
			$this->Session->setFlash(__('Nothing happen. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
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
	$condition2.=' and Ivrs.id LIKE %'.$searchKey.'% || Ivrs.ivrs_user_mobile LIKE %'.$searchKey.'% Ivrs.ivrs_user_type LIKE %'.$searchKey.'% || Ivrs.ivrs_user_name LIKE %'.$searchKey.'% || Ivrs.gender LIKE %'.$searchKey.'%';
	
	}
	
	
	
	if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(Ivrs.date)>="'.$fromdate.'" and date(Ivrs.date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(Ivrs.date)="'.$fromdate.'"';
				}
				else
				{
					
					}
			}
			
			
  
//		if(isset($this->request->query['organization']) and ($this->request->query['organization']!=0) and ($this->request->query['organization']!='')){$searchBuilderId=trim($this->request->query['organization']);  //$condition['Enquiry.country_id']=$searchCountryId;
//		$condition2.=' and Vhsnd.organization='.$searchBuilderId;
//		
//		}
//		
		if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBlockId=trim($this->request->query['block']); //$condition['Enquiry.builder_id']=$searchBuilderId;
		$condition2.=' and Ivrs.block='.$searchBlockId;
		}
		
		if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchProjectId=trim($this->request->query['panchayat']); //$condition['Enquiry.project_id']=$searchProjectId;
		$condition2.=' and Ivrs.panchayat='.$searchProjectId;
		}
               
                if(isset($this->request->query['village']) and ($this->request->query['village']!=0) and ($this->request->query['village']!='')){$searchVillageId=trim($this->request->query['village']); //$condition['Enquiry.project_id']=$searchProjectId;
		$condition2.=' and Ivrs.village='.$searchVillageId;
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
                             $condition2.=' and Ivrs.panchayat='.$searchProjectId;
		           }   else { 
                        ///$condition=['VhsncAfc.panchayat IN' =>explode(',',$r['Bpccc']['allocated_panchayat'])]; 
                         $condition2.=' and Ivrs.panchayat IN ('.$r['Bpccc']['allocated_panchayat'].')';
                      }
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    //$condition['OR']=array('Geographical.id LIKE'=>'%'.$searchKey.'%','Geographical.ward LIKE'=>'%'.$searchKey.'%','Geographical.awc_code LIKE'=>'%'.$searchKey.'%','Geographical.awc_worker LIKE '=>'%'.$searchKey.'%','Geographical.asha_name LIKE '=>'%'.$searchKey.'%'); 
	$condition2.=' and Ivrs.id LIKE %'.$searchKey.'% || Ivrs.ivrs_user_mobile LIKE %'.$searchKey.'% Ivrs.ivrs_user_type LIKE %'.$searchKey.'% || Ivrs.ivrs_user_name LIKE %'.$searchKey.'% || Ivrs.gender LIKE %'.$searchKey.'%';
	
	}
	
	
	
	if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(Ivrs.date)>="'.$fromdate.'" and date(Ivrs.date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(Ivrs.date)="'.$fromdate.'"';
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
		        $condition2.=' and Ivrs.block='.$searchBlockId;
		        }else {
                            
                       $condition2.=' and Ivrs.block IN ('.$r['Bpc']['allocated_block'].')';
                       
                      }
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    //$condition['OR']=array('Geographical.id LIKE'=>'%'.$searchKey.'%','Geographical.ward LIKE'=>'%'.$searchKey.'%','Geographical.awc_code LIKE'=>'%'.$searchKey.'%','Geographical.awc_worker LIKE '=>'%'.$searchKey.'%','Geographical.asha_name LIKE '=>'%'.$searchKey.'%'); 
	$condition2.=' and Ivrs.id LIKE %'.$searchKey.'% || Ivrs.ivrs_user_mobile LIKE %'.$searchKey.'% Ivrs.ivrs_user_type LIKE %'.$searchKey.'% || Ivrs.ivrs_user_name LIKE %'.$searchKey.'% || Ivrs.gender LIKE %'.$searchKey.'%';
	
	}
	
	
	
	if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(Ivrs.date)>="'.$fromdate.'" and date(Ivrs.date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(Ivrs.date)="'.$fromdate.'"';
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
                               $condition2.=' and Ivrs.block='.$searchBlockId;
		        // $condition['VhsncAfc.block']=$searchBlockId;
		        }else {
                       //$condition='VhsncAfc.district='.$r['Dpo']['district'];
                        $condition2.=' and Ivrs.district IN ('.$r['Dpo']['district'].')';
                        }
                        if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    //$condition['OR']=array('Geographical.id LIKE'=>'%'.$searchKey.'%','Geographical.ward LIKE'=>'%'.$searchKey.'%','Geographical.awc_code LIKE'=>'%'.$searchKey.'%','Geographical.awc_worker LIKE '=>'%'.$searchKey.'%','Geographical.asha_name LIKE '=>'%'.$searchKey.'%'); 
	$condition2.=' and Ivrs.id LIKE %'.$searchKey.'% || Ivrs.ivrs_user_mobile LIKE %'.$searchKey.'% Ivrs.ivrs_user_type LIKE %'.$searchKey.'% || Ivrs.ivrs_user_name LIKE %'.$searchKey.'% || Ivrs.gender LIKE %'.$searchKey.'%';
	
	}
	
	
	
	if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(Ivrs.date)>="'.$fromdate.'" and date(Ivrs.date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(Ivrs.date)="'.$fromdate.'"';
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
		$condition2.=' and Ivrs.status="active"';
		$this->response->download("Ivrs.csv");
		//print_r($condition); exit;
	    $data=$this->Ivrs->query('select Ivrs.id,Ivrs.date,Ivrs.ivrs_user_name,Ivrs.age,Ivrs.gender,Ivrs.ivrs_user_mobile,Ivrs.ivrs_user_type,Ivrs.registration_status,Ivrs.registration_reason,Ivrs.survey_participated,Ivrs.voice_feedback_recorded,Ivrs.voice_reason,Ivrs.information_pack_listen,Ivrs.info_pack_reason,City.name,Block.name,Panchayat.name,Village.name,Ward.name,Ivrs.status from ivrs as Ivrs left join cities as City  on Ivrs.district=City.id left join blocks as Block  on Ivrs.block=Block.id left join villages as Village  on Ivrs.village=Village.id left join panchayats as Panchayat on Ivrs.panchayat=Panchayat.id left join wards as Ward on Ivrs.ward=Ward.id where 1 '.$condition2 );
		
		
		//$data = $this->Geographical->find('all', array('conditions'=>$condition2));
		
		//$log = $this->Enquiry->getDataSource()->getLog(false, false);
        //debug($log);
		//exit;
		
            $headers = array('Ivrs'=>array( 'Id' => 'Id','District' => 'District', 'Block' => 'Block','Panchayat' => 'Panchayat','Village'=>'Village','Ward'=>'Ward','Visit Date'=>'Visit Date','Name of M-Shakti User'=>'Name of M-Shakti User','Age'=>'Age','Gender'=>'Gender','Mobile'=>'Mobile','Type of M-Shakti User'=>'Type of M-Shakti User','Registration held today'=>'Registration held today','Reason'=>'Reason','Survey Participated'=>'Survey Participated ','Voice Feedback Recorded'=>'Voice Feedback Recorded','Reason'=>'Reason','Information Pack Listen'=>'Information Pack Listen','Reason'=>'Reason','Status'=>'Status')); 
	    $this->set(compact('data','headers'));
		$this->layout = 'ajax';
		return;
		
		}
  ////  reports section ---///// 
	   
	     
	
	}
	
	
	
	
