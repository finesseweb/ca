<?php
App::uses('AppController', 'Controller');
/**
 * Ngos Controller
 *
 * @property Ngo $BpcccNgo
 * @property PaginatorComponent $Paginator
 */
class BpcccsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Upload');

    var  $uses = array('Bpccc','Bpc','Dpo','Ngoname','Ngo','User','Project','Village','Panchayat','Location','Country','City','Block','Designation');
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
    $condition['OR']=array('Bpccc.id LIKE'=>'%'.$searchKey.'%','Bpccc.mobile LIKE '=>'%'.$searchKey.'%'); 
	
	}
//		
//		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
//			
//			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
//			{
//				$fromdate=trim($this->request->query['from_date']);
//				$todate=trim($this->request->query['to_date']);
//				$condition['AND']=array('date(Ngo.date_of_booking) >='=>$fromdate,'date(Ngo.date_of_booking) <='=>$todate);
//				}
//				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
//					
//				$fromdate=trim($this->request->query['from_date']);  
//				$condition['Ngo.date_of_booking']=$fromdate;	
//				}
//				
//			}
//		
		if(isset($this->request->query['organization']) and ($this->request->query['organization']!=0) and ($this->request->query['organization']!='')){$searchBuilderId=trim($this->request->query['organization']); 
		$condition['Bpccc.organization']=$searchBuilderId;
		}
		
		if(isset($this->request->query['user']) and ($this->request->query['user']!=0) and ($this->request->query['user']!='')){$searchProjectId=trim($this->request->query['user']);
		$condition['Bpccc.first_name']=$searchProjectId;
		}
                
                if(isset($this->request->query['district']) and ($this->request->query['district']!=0) and ($this->request->query['district']!='')){$searchDistrictId=trim($this->request->query['district']); 
		$condition['Bpccc.allocated_district']=$searchDistrictId;
		}
		
		if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBlockId=trim($this->request->query['block']);
		$condition['Bpccc.allocated_block']=$searchBlockId;
		}
                
		
//		if(isset($this->request->query['search_user']) and ($this->request->query['search_user']!=0) and ($this->request->query['search_user']!='')){$searchUserId=trim($this->request->query['search_user']);
//		$condition['OR']=array('Ngo.booked_by'=>$searchUserId,'Ngo.booked_by_2'=>$searchUserId);
//		}
//		
	}
        
        
          if(CakeSession::read('User.type')==='user'){
			$r = $this->Ngo->find('first',array('conditions'=>array('Ngo.chief_functionary_name='.CakeSession::read('User.id'))));
                       $r['Ngo']['id'];
                      
                     if(isset($this->request->query['organization']) and ($this->request->query['organization']!=0) and ($this->request->query['organization']!='')){
                              $searchNgoId=trim($this->request->query['organization']);
		         $condition='Bpccc.organization='.$searchNgoId;
		        }else {
                            
                       $condition='Bpccc.organization='.$r['Ngo']['id'];
                       
                      } 
                      if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){
                              $searchBlockId=trim($this->request->query['block']);
		         $condition='Bpccc.allocated_block='.$searchBlockId;
		        }
		$blo=array();
                   $blo= [$r['Ngo']['allocated_block_one'],$r['Ngo']['allocated_block_two']];
                   
                   
                     	//$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
		 $ngos=$this->Ngo->find('list',array('conditions'=>array('Ngo.id'=>$r['Ngo']['id'])));
		$blocks=$this->Block->find('list',array('order' => array('name' => 'asc'),'conditions'=>array('Block.id IN'=>$blo)));
                $cities=$this->City->find('list',array('order' => array('name' => 'asc'),'conditions'=>array('City.id'=>$r['Ngo']['allocated_district'])));   
                  			
		}
                else if(CakeSession::read('User.type')==='regular'){
                 if(CakeSession::read('User.subrole')==='CC'){
		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'))));
                      if($r){ 
                          if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){
                           $searchProjectId=trim($this->request->query['panchayat']);
		            $condition['Bpccc.allocated_panchayat']=$searchProjectId;
		           }   else { 
                        $condition=['Bpccc.allocated_panchayat IN' =>explode(',',$r['Bpccc']['allocated_panchayat'])]; 
                        
                      } 
                      }
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Village yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
	            //$blocks=$this->Block->find('list',array('conditions'=>array('Block.id'=>$r['Bpccc']['allocated_block'])));
                    $panchayats=$this->Panchayat->find('list',array('conditions'=>['Panchayat.id IN'=>explode(',',$r['Bpccc']['allocated_panchayat'])]));
                   	
		}
                
                 elseif(CakeSession::read('User.subrole')==='BPC'){
		   $r = $this->Bpc->find('first',array('conditions'=>array('Bpc.first_name='.CakeSession::read('User.id'))));
                      if($r){ 
                         if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchProjectId=trim($this->request->query['block']);
		       $condition['Bpccc.allocated_block']=$searchProjectId;
		       }
                       if(isset($this->request->query['organization']) and ($this->request->query['organization']!=0) and ($this->request->query['organization']!='')){$searchBuilderId=trim($this->request->query['organization']); 
		     $condition['Bpccc.organization']=$searchBuilderId;
		         }
                       else {
                            
                       $condition=['Bpccc.allocated_block IN' =>explode(',',$r['Bpc']['allocated_block'])];
                       
                      } 
                      }
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Block yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
		     $blocks=$this->Block->find('list',array('order' => array('name' => 'asc'),'conditions'=>array('Block.id IN'=>explode(',',$r['Bpc']['allocated_block']))));
                   //$villages=$this->Village->find('list');
                   //$panchayats=$this->Panchayat->find('list');
                    $condition2['OR']=array('Ngo.allocated_block_one'=>explode(',',$r['Bpc']['allocated_block']),'Ngo.allocated_block_two'=>explode(',',$r['Bpc']['allocated_block'])); 
                    $ngos=$this->Ngo->find('list',array('conditions'=>$condition2));
                    
		}
                
                
                 else {
		   $r = $this->Dpo->find('first',array('conditions'=>array('Dpo.first_name='.CakeSession::read('User.id'))));
                      if($r){ 
                        if(isset($this->request->query['organization']) and ($this->request->query['organization']!=0) and ($this->request->query['organization']!='')){$searchBuilderId=trim($this->request->query['organization']); 
		$condition['Bpccc.organization']=$searchBuilderId;
		} else {  
                       $condition='Bpccc.allocated_district='.$r['Dpo']['district'];
                }
                       
                      } 
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Village yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
		    $blocks=$this->Block->find('list',array('order' => array('name' => 'asc'),'conditions'=>array('Block.city_id IN'=>explode(',',$r['Dpo']['district']))));
                     $ngos=$this->Ngo->find('list',array('conditions'=>array('Ngo.allocated_district IN'=>explode(',',$r['Dpo']['district']))));
                   
                     $cities=$this->City->find('list',array('order' => array('name' => 'asc'),'conditions'=>array('City.id IN'=>explode(',',$r['Dpo']['district']))));
                   
                   
		} 
                    
                }
                else{
                $ngos=$this->Ngo->find('list');
		$blocks=$this->Block->find('list',array('order' => array('name' => 'asc')));
                $cities=$this->City->find('list',array('order' => array('name' => 'asc')));   
                    
                }
		
		$this->Paginator->settings = array('Bpccc' => array('limit' =>20,'order' => array('id' => 'desc'),'conditions'=>array($condition,'Bpccc.status'=>'active')));
		$this->Bpccc->recursive = 0;
		$this->set('geographicals', $this->Paginator->paginate());
		$executives=$this->User->find('all',array('conditions'=>array('User.status'=>'active','User.role'=>'regular','User.subrole'=>'CC','User.Type'=>'NGO')));
	        //$ngos=$this->Ngo->find('list');
		//$blocks=$this->Block->find('list');
                //$cities=$this->City->find('list');
                
//			$users = $this->User->find('list',array('fields'=>array('parent'),'conditions'=>array('status'=>'active')));
//			$builders=$this->Builder->find('list');
			$this->set(compact('users','projects','builders','executives','ngos','blocks','cities'));
			
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Bpccc->exists($id)) {
			throw new NotFoundException(__('Invalid BPC/CC'));
		}
		$options = array('conditions' => array('Bpccc.' . $this->Bpccc->primaryKey => $id));
		$this->set('bpccc', $this->Bpccc->find('first', $options));
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
			$this->Bpccc->create();
//                        print_r($this->request->data);
//                        die();
                        
                        
                            $organization =  $this->request->data['Bpccc']['organization'];
                            $first_name =  $this->request->data['Bpccc']['first_name'];
                            //$last_name=  $this->request->data['Bpccc']['last_name'];
                            $designation =  $this->request->data['Bpccc']['designation'];
                            $gender=  $this->request->data['Bpccc']['gender'];
                            $mobile =  $this->request->data['Bpccc']['mobile'];
                            $email_id =  $this->request->data['Bpccc']['email_id'];
                            $address =  $this->request->data['Bpccc']['address'];
                            $district =  $this->request->data['Bpccc']['allocated_district'];
                            $block =  $this->request->data['Bpccc']['allocated_block'];
                             $allocated_panchayat= implode(',',$this->request->data['Bpccc']['allocated_panchayat']);
                           // $allocated_panchayat =  $this->request->data['Bpccc']['allocated_panchayat'];
                            $allocated_village =  $this->request->data['Bpccc']['allocated_village'];
                            $date_of_joining =  date('Y-m-d',strtotime($this->request->data['Bpccc']['date_of_joining']));
                            $contract_end_date =  date('Y-m-d',strtotime($this->request->data['Bpccc']['contract_end_date']));
                            $aphc_no =  $this->request->data['Bpccc']['aphc_no'];
                            $hsc_no =  $this->request->data['Bpccc']['hsc_no'];
                            $awc_no =  $this->request->data['Bpccc']['awc_no'];
                            $aww_no =  $this->request->data['Bpccc']['aww_no'];
                            $vhsnd_no =  $this->request->data['Bpccc']['vhsnd_no'];
                            $anm_no =  $this->request->data['Bpccc']['anm_no'];
                            $asha_facilitators_no =  $this->request->data['Bpccc']['asha_facilitators_no'];
                            $asha_no =  $this->request->data['Bpccc']['asha_no'];
                            $remarks =  $this->request->data['Bpccc']['remarks'];
                            $status =  $this->request->data['Bpccc']['status'];
                    $data=array (
                                'organization' => $organization,
                                'first_name' => $first_name ,
                                //'last_name' => $last_name,
                                'designation' => $designation,
                                'gender' => $gender,
                                'mobile' => $mobile,
                                'email_id' => $email_id,
                                'address' => $address,
                                'allocated_district' =>$district,
                                'allocated_block' =>$block,
                                'allocated_panchayat'=>$allocated_panchayat,
                                'allocated_village'=> $allocated_village,
                                'date_of_joining'=>$date_of_joining,
                                'contract_end_date'=>$contract_end_date,
                                'aphc_no'=>$aphc_no,
                                'hsc_no' =>$hsc_no,
                                'awc_no'=>$awc_no,
                                'aww_no' =>$aww_no,
                                'vhsnd_no'=>$vhsnd_no,
                                'anm_no' =>$anm_no,
                                'asha_facilitators_no' =>$asha_facilitators_no,
                                'asha_no'=>$asha_no,
                                'remarks'=>$remarks,
                                'status'=>$status
                                );  
                            
                            
			if ($this->Bpccc->save($data)) {
				$this->Session->setFlash(__('The CC has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The CC could not be saved. Please, try again.'));
			}
		}
		$executives=$this->User->find('all',array('conditions'=>array('User.status'=>'active','User.role'=>'regular','User.subrole'=>'CC','User.Type'=>'NGO')));
		$cities=$this->City->find('list',array('order' => array('name' => 'asc')));
                $desig=$this->Designation->find('list');
		
                if(CakeSession::read('User.type')==='user'){  
                 $sessionval=$this->Session->read('User.id');
                 $ngos=$this->Ngo->find('list',array('conditions'=>array('Ngo.chief_functionary_name'=>$sessionval))); 
                 $blocks=$this->Block->find('list',array('order' => array('name' => 'asc'),'conditions'=>array('Ngo.chief_functionary_name'=>$sessionval)));
                 }
                 else {
                 $ngos=$this->Ngo->find('list');
                 $blocks=$this->Block->find('list',array('order' => array('name' => 'asc')));
                 }
               
                $panchayat=$this->Panchayat->find('list',array('order' => array('name' => 'asc')));
                $village=$this->Village->find('list',array('order' => array('name' => 'asc')));
		$this->set(compact('panchayat','cities','ngos','blocks','desig','village','executives'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Bpccc->exists($id)) {
			throw new NotFoundException(__('Invalid booking'));
		}
		if ($this->request->is(array('post', 'put'))) {
                    
                    $organization =  $this->request->data['Bpccc']['organization'];
                            $first_name =  $this->request->data['Bpccc']['first_name'];
                            //$last_name=  $this->request->data['Bpccc']['last_name'];
                            $designation =  $this->request->data['Bpccc']['designation'];
                            $gender=  $this->request->data['Bpccc']['gender'];
                            $mobile =  $this->request->data['Bpccc']['mobile'];
                            $email_id =  $this->request->data['Bpccc']['email_id'];
                            $address =  $this->request->data['Bpccc']['address'];
                            $district =  $this->request->data['Bpccc']['allocated_district'];
                            $block =  $this->request->data['Bpccc']['allocated_block'];
                             $allocated_panchayat= implode(',',$this->request->data['Bpccc']['allocated_panchayat']);
                            //$allocated_panchayat =  $this->request->data['Bpccc']['allocated_panchayat'];
                            $allocated_village =  $this->request->data['Bpccc']['allocated_village'];
                            $date_of_joining =  date('Y-m-d',strtotime($this->request->data['Bpccc']['date_of_joining']));
                            $contract_end_date =  date('Y-m-d',strtotime($this->request->data['Bpccc']['contract_end_date']));
                            $aphc_no =  $this->request->data['Bpccc']['aphc_no'];
                            $hsc_no =  $this->request->data['Bpccc']['hsc_no'];
                            $awc_no =  $this->request->data['Bpccc']['awc_no'];
                            $aww_no =  $this->request->data['Bpccc']['aww_no'];
                            $vhsnd_no =  $this->request->data['Bpccc']['vhsnd_no'];
                            $anm_no =  $this->request->data['Bpccc']['anm_no'];
                            $asha_facilitators_no =  $this->request->data['Bpccc']['asha_facilitators_no'];
                            $asha_no =  $this->request->data['Bpccc']['asha_no'];
                            $remarks =  $this->request->data['Bpccc']['remarks'];
                            $status =  $this->request->data['Bpccc']['status'];
                    $data=array (
                                'organization' => $organization,
                                'first_name' => $first_name ,
                               // 'last_name' => $last_name,
                                'designation' => $designation,
                                'gender' => $gender,
                                'mobile' => $mobile,
                                'email_id' => $email_id,
                                'address' => $address,
                                'allocated_district' =>$district,
                                'allocated_block' =>$block,
                                'allocated_panchayat'=>$allocated_panchayat,
                                'allocated_village'=> $allocated_village,
                                'date_of_joining'=>$date_of_joining,
                                'contract_end_date'=>$contract_end_date,
                                'aphc_no'=>$aphc_no,
                                'hsc_no' =>$hsc_no,
                                'awc_no'=>$awc_no,
                                'aww_no' =>$aww_no,
                                'vhsnd_no'=>$vhsnd_no,
                                'anm_no' =>$anm_no,
                                'asha_facilitators_no' =>$asha_facilitators_no,
                                'asha_no'=>$asha_no,
                                'remarks'=>$remarks,
                                'status'=>$status,
                                'id'=>$id
                                );  
                            
			if ($this->Bpccc->save($data)) {
				$this->Session->setFlash(__('The CC has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The CC could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Bpccc.' . $this->Bpccc->primaryKey => $id));
			$this->request->data = $this->Bpccc->find('first', $options);
			$executives=$this->User->find('all',array('conditions'=>array('User.status'=>'active','User.role'=>'regular','User.Type'=>'NGO','User.id'=>$this->request->data['Bpccc']['first_name'])));
			if($this->request->data['Bpccc']['allocated_district']!=0 and $this->request->data['Bpccc']['allocated_district']!='')
			{
				$cities=$this->City->find('list',array('order' => array('name' => 'asc'),'conditions'=>array('City.id'=>$this->request->data['Bpccc']['allocated_district'])));
				}
			else
			{
				$cities=$this->City->find('list',array('order' => array('name' => 'asc')));
				}
                                
                                if($this->request->data['Bpccc']['allocated_block']!=0 and $this->request->data['Bpccc']['allocated_block']!='')
			{
		           $blocks=$this->Block->find('list',array('order' => array('name' => 'asc'),'conditions'=>array('Block.id'=>$this->request->data['Bpccc']['allocated_block'])));
				}
			else
			{
			  $blocks=$this->Block->find('list',array('order' => array('name' => 'asc')));
				}
		//$cities=$this->City->find('list');
                $desig=$this->Designation->find('list',array('order' => array('name' => 'asc'),));
		//$blocks=$this->Block->find('list');
		$ngos=$this->Ngo->find('list');
                $panchayat=$this->Panchayat->find('list',array('order' => array('name' => 'asc')));
                $village=$this->Village->find('list',array('order' => array('name' => 'asc')));
		$this->set(compact('panchayat','cities','ngos','blocks','desig','village','executives'));
		}
	}
	
	
	
/**  
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null,$status='deactive') {
		$this->Bpccc->id = $id;
		if (!$this->Bpccc->exists()) {
			throw new NotFoundException(__('Invalid cc Detail'));
		} 
                if(CakeSession::read('User.type')==='regular'){
                
		    $menu= $this->Session->read('User.mainmenu');
                if (in_array($this->request->params['controller'].":".$this->request->params['action'], $menu)) { 
             
		    $this->Bpccc->read(null,$id);
			$this->Bpccc->set(array('status'=>$status));
		
		if ($this->Bpccc->save()) {
			$this->Session->setFlash(__('The cc has been '.$status));
		} else {
			$this->Session->setFlash(__('Nothing happen. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
                 } else {
                    
                    $this->requestAction(array('controller' => 'users', 'action' => 'checkRestriction'));
                }
                } else {
                       $this->Bpccc->read(null,$id);
			$this->Bpccc->set(array('status'=>$status));
		
		if ($this->Bpccc->save()) {
			$this->Session->setFlash(__('The cc has been '.$status));
		} else {
			$this->Session->setFlash(__('Nothing happen. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
                }
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
	$condition2.=' and Bpccc.id LIKE %'.$searchKey.'% || Bpccc.mobile LIKE %'.$searchKey.'%';
	
	}
	
	
	
//	if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
//			
//			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
//			{
//				$fromdate=trim($this->request->query['from_date']);
//				$todate=trim($this->request->query['to_date']);
//				$condition2.=' and date(Enquiry.posted_date)>="'.$fromdate.'" and date(Enquiry.posted_date)<="'.$todate.'"';
//				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
//				}
//				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
//					
//				$fromdate=trim($this->request->query['from_date']);  
//				//$condition['Enquiry.posted_date']=$fromdate;	
//				$condition2.=' and date(Enquiry.posted_date)="'.$fromdate.'"';
//				}
//				else
//				{
//					
//					}
//			}
//			
			
//		if(isset($this->request->query['organization']) and ($this->request->query['organization']!=0) and ($this->request->query['organization']!='')){$searchBuilderId=trim($this->request->query['organization']); 
//		$condition2['Geographical.organization']=$searchBuilderId;
//		}
//		
//		if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBlockId=trim($this->request->query['block']);
//		$condition2['Geographical.block']=$searchBlockId;
//		}
//                if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchProjectId=trim($this->request->query['panchayat']);
//		$condition2['Geographical.panchayat']=$searchProjectId;
//		}
//                if(isset($this->request->query['village']) and ($this->request->query['village']!=0) and ($this->request->query['village']!='')){$searchVillageId=trim($this->request->query['village']);
//		$condition2['Geographical.village']=$searchVillageId;
//		}
//                
		if(isset($this->request->query['organization']) and ($this->request->query['organization']!=0) and ($this->request->query['organization']!='')){$searchBuilderId=trim($this->request->query['organization']);  //$condition['Enquiry.country_id']=$searchCountryId;
		$condition2.=' and Bpccc.organization='.$searchBuilderId;
		
		}
		
		if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBlockId=trim($this->request->query['block']); //$condition['Enquiry.builder_id']=$searchBuilderId;
		$condition2.=' and Bpccc.allocated_block='.$searchBlockId;
		}
		
		if(isset($this->request->query['district']) and ($this->request->query['district']!=0) and ($this->request->query['district']!='')){$searchProjectId=trim($this->request->query['district']); //$condition['Enquiry.project_id']=$searchProjectId;
		$condition2.=' and Bpccc.allocated_district='.$searchProjectId;
		}
               
//                if(isset($this->request->query['village']) and ($this->request->query['village']!=0) and ($this->request->query['village']!='')){$searchVillageId=trim($this->request->query['village']); //$condition['Enquiry.project_id']=$searchProjectId;
//		$condition2.=' and Bpccc.village='.$searchVillageId;
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
		          //  $condition['Bpccc.panchayat']=$searchProjectId;
                             $condition2.=' and Bpccc.allocated_panchayat='.$searchProjectId;
		           }   else { 
                        ///$condition=['Bpccc.panchayat IN' =>explode(',',$r['Bpccc']['allocated_panchayat'])]; 
                         $condition2.=' and Bpccc.allocated_panchayat IN ('.$r['Bpccc']['allocated_panchayat'].')';
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
		        $condition2.=' and Bpccc.allocated_block='.$searchBlockId;
		        }else {
                            
                       $condition2.=' and Bpccc.allocated_block IN ('.$r['Bpc']['allocated_block'].')';
                       
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
                               $condition2.=' and Bpccc.allocated_block='.$searchBlockId;
		        // $condition['Bpccc.block']=$searchBlockId;
		        }else {
                       //$condition='Bpccc.district='.$r['Dpo']['district'];
                        $condition2.=' and Bpccc.allocated_district IN ('.$r['Dpo']['district'].')';
                        }
                      } 
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Village yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
			$blocks=$this->Block->find('list',array('order' => array('name' => 'asc'),'conditions'=>array('Block.city_id IN'=>explode(',',$r['Dpo']['district']))));
                     $ngos=$this->Ngo->find('list',array('conditions'=>array('Ngo.allocated_district IN'=>explode(',',$r['Dpo']['district']))));
                     
		}
         }
		else {
		
		}
		}
		//$condition['NOT']=array('Enquiry.status'=>"trash");
		$condition2.=' and Bpccc.status="active"';
		$this->response->download("CC.csv");
		//print_r($condition); exit;
		$data=$this->Bpccc->query('select Bpccc.id,Bpccc.designation,Bpccc.gender,Bpccc.mobile,Bpccc.email_id,Bpccc.address,Bpccc.date_of_joining,Bpccc.contract_end_date,Bpccc.aphc_no,Bpccc.hsc_no,Ngo.name_of_ngo,User.name,User.last_name,City.name,Block.name,Panchayat.name,Bpccc.awc_no,Bpccc.aww_no,Bpccc.vhsnd_no,Bpccc.anm_no,Bpccc.asha_facilitators_no,Bpccc.asha_no,Bpccc.remarks,Bpccc.status from bpcccs as Bpccc left join ngos as Ngo on Bpccc.organization=Ngo.id left join cities as City  on Bpccc.allocated_district=City.id left join blocks as Block  on Bpccc.allocated_block=Block.id left join panchayats as Panchayat  on Bpccc.allocated_panchayat=Panchayat.id left join  users as User on Bpccc.first_name=User.id where 1 '.$condition2 );
		
		
		//$data = $this->Geographical->find('all', array('conditions'=>$condition2));
		
		//$log = $this->Enquiry->getDataSource()->getLog(false, false);
        //debug($log);
		//exit;
		
            $headers = array('Bpccc'=>array( 'Id' => 'Id','NGO' => 'NGO', 'District' => 'District', 'Block' => 'Block', 'Panchayat' => 'Panchayat','Staff Name'=>'Staff Name','Designation'=>'Designation','Gender'=>'Gender','Mobile'=>'Mobile','Email'=>'Email','Address'=>'Address', 'Date of Joining' => 'Date of Joining','Contract End Date' => 'Contract End Date', 'No of APHC' => 'No of APHC','No of HSC' => 'No of HSC','No of AWC' => 'No of AWC','No of AWW' => 'No of AWW','No of VHSND' => 'No of VHSND','No of ANM' => 'No of ANM','No of ASHA Facilitators' => 'No of ASHA Facilitators','No of ASHA' => 'No of ASHA','Remarks'=>'Remarks','Status' => 'Status')); 
	    $this->set(compact('data','headers'));
		$this->layout = 'ajax';
		return;
		
		}
  ////  reports section ---/////
	
	
	}
	
	
	
	
