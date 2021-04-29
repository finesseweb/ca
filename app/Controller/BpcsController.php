<?php
App::uses('AppController', 'Controller');
/**
 * Ngos Controller
 *
 * @property Ngo $GeographicalNgo
 * @property PaginatorComponent $Paginator
 */
class BpcsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Upload');

    var  $uses = array('Bpc','Geographical','Ngoname','Ngo','User','Project','Village','Panchayat','Location','Country','City','Block','Designation');
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
    $condition['OR']=array('Bpc.id LIKE'=>'%'.$searchKey.'%','Bpc.first_name LIKE'=>'%'.$searchKey.'%','Bpc.last_name LIKE'=>'%'.$searchKey.'%','Bpc.mobile LIKE '=>'%'.$searchKey.'%','Bpc.email_id LIKE '=>'%'.$searchKey.'%'); 
	
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
		$condition['Bpc.organization']=$searchBuilderId;
		}
		
		if(isset($this->request->query['user']) and ($this->request->query['user']!=0) and ($this->request->query['user']!='')){$searchProjectId=trim($this->request->query['user']);
		$condition['Bpc.first_name']=$searchProjectId;
		}
//		if(isset($this->request->query['search_user']) and ($this->request->query['search_user']!=0) and ($this->request->query['search_user']!='')){$searchUserId=trim($this->request->query['search_user']);
//		$condition['OR']=array('Ngo.booked_by'=>$searchUserId,'Ngo.booked_by_2'=>$searchUserId);
//		}
//		
	}
        
        
          if(CakeSession::read('User.type')==='user'){
			$r = $this->Ngo->find('first',array('conditions'=>array('Ngo.chief_functionary_name='.CakeSession::read('User.id'))));
                       $r['Ngo']['id'];
                       $condition='Bpc.organization='.$r['Ngo']['id'];
                        
			//$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
		 $ngos=$this->Ngo->find('list',array('conditions'=>array('Ngo.id'=>$r['Ngo']['id'])));
				
		}
		else {
                  $executives=$this->User->find('all',array('conditions'=>array('User.status'=>'active','User.role'=>'regular','User.subrole'=>'BPC','User.Type'=>'NGO')));
		 $ngos=$this->Ngo->find('list');
                
                }
		$this->Paginator->settings = array('Bpc' => array('limit' =>20,'order' => array('id' => 'desc'),'conditions'=>array($condition,'Bpc.status'=>'active')));
		$this->Bpc->recursive = 0;
		$this->set('geographicals', $this->Paginator->paginate());
			
			
//			$users = $this->User->find('list',array('fields'=>array('parent'),'conditions'=>array('status'=>'active')));
//			$builders=$this->Builder->find('list');
			$this->set(compact('users','executives','ngos'));
			
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Bpc->exists($id)) {
			throw new NotFoundException(__('Invalid BPC'));
		}
		$options = array('conditions' => array('Bpc.' . $this->Bpc->primaryKey => $id));
		$this->set('bpccc', $this->Bpc->find('first', $options));
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
			$this->Bpc->create();
//                        print_r($this->request->data);
//                        die();
                        
                        
                            $organization =  $this->request->data['Bpc']['organization'];
                            $first_name =  $this->request->data['Bpc']['first_name'];
                            //$last_name=  $this->request->data['Bpc']['last_name'];
                            $designation =  $this->request->data['Bpc']['designation'];
                            $gender=  $this->request->data['Bpc']['gender'];
                            $mobile =  $this->request->data['Bpc']['mobile'];
                            $email_id =  $this->request->data['Bpc']['email_id'];
                            $address =  $this->request->data['Bpc']['address'];
                            $district =  $this->request->data['Bpc']['allocated_district'];
                            $block =  implode(',',$this->request->data['Bpc']['allocated_block']);
                           // $allocated_panchayat =  $this->request->data['Bpc']['allocated_panchayat'];
                           // $allocated_village =  $this->request->data['Bpc']['allocated_village'];
                            $date_of_joining =  date('Y-m-d',strtotime($this->request->data['Bpc']['date_of_joining']));
                            $contract_end_date =  date('Y-m-d',strtotime($this->request->data['Bpc']['contract_end_date']));
                           // $aphc_no =  $this->request->data['Bpc']['aphc_no'];
                            //$hsc_no =  $this->request->data['Bpc']['hsc_no'];
                           // $awc_no =  $this->request->data['Bpc']['awc_no'];
                           // $aww_no =  $this->request->data['Bpc']['aww_no'];
                           // $vhsnd_no =  $this->request->data['Bpc']['vhsnd_no'];
                           // $anm_no =  $this->request->data['Bpc']['anm_no'];
                           // $asha_facilitators_no =  $this->request->data['Bpc']['asha_facilitators_no'];
                           // $asha_no =  $this->request->data['Bpc']['asha_no'];
                            $remarks =  $this->request->data['Bpc']['remarks'];
                            $status =  $this->request->data['Bpc']['status'];
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
                               // 'allocated_panchayat'=>$allocated_panchayat,
                               // 'allocated_village'=> $allocated_village,
                                'date_of_joining'=>$date_of_joining,
                                'contract_end_date'=>$contract_end_date,
                               // 'aphc_no'=>$aphc_no,
                               // 'hsc_no' =>$hsc_no,
                               // 'awc_no'=>$awc_no,
                                //'aww_no' =>$aww_no,
                                //'vhsnd_no'=>$vhsnd_no,
                               // 'anm_no' =>$anm_no,
                               // 'asha_facilitators_no' =>$asha_facilitators_no,
                               // 'asha_no'=>$asha_no,
                                'remarks'=>$remarks,
                                'status'=>$status
                                );  
                            
                            
			if ($this->Bpc->save($data)) {
				$this->Session->setFlash(__('The BPC has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The BPC could not be saved. Please, try again.'));
			}
		}
		$executives=$this->User->find('all',array('conditions'=>array('User.status'=>'active','User.role'=>'regular','User.subrole'=>'BPC','User.type'=>'NGO')));
		$cities=$this->City->find('list',array('order' => array('name' => 'asc')));
                $desig=$this->Designation->find('list');
		
                if(CakeSession::read('User.type')==='user'){  
                 $sessionval=$this->Session->read('User.id');
                 $ngos=$this->Ngo->find('list',array('conditions'=>array('Ngo.chief_functionary_name'=>$sessionval))); 
                 $blocks=$this->Block->find('list',array('order' => array('name' => 'asc')));
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
		if (!$this->Bpc->exists($id)) {
			throw new NotFoundException(__('Invalid booking'));
		}
		if ($this->request->is(array('post', 'put'))) {
                    
                    $organization =  $this->request->data['Bpc']['organization'];
                            $first_name =  $this->request->data['Bpc']['first_name'];
                           // $last_name=  $this->request->data['Bpc']['last_name'];
                            $designation =  $this->request->data['Bpc']['designation'];
                            $gender=  $this->request->data['Bpc']['gender'];
                            $mobile =  $this->request->data['Bpc']['mobile'];
                            $email_id =  $this->request->data['Bpc']['email_id'];
                            $address =  $this->request->data['Bpc']['address'];
                            $district =  $this->request->data['Bpc']['allocated_district'];
                            $block =  implode(',',$this->request->data['Bpc']['allocated_block']);
                           // $allocated_panchayat =  $this->request->data['Bpc']['allocated_panchayat'];
                           // $allocated_village =  $this->request->data['Bpc']['allocated_village'];
                            $date_of_joining =  date('Y-m-d',strtotime($this->request->data['Bpc']['date_of_joining']));
                            $contract_end_date =  date('Y-m-d',strtotime($this->request->data['Bpc']['contract_end_date']));
                           // $aphc_no =  $this->request->data['Bpc']['aphc_no'];
                           // $hsc_no =  $this->request->data['Bpc']['hsc_no'];
                           // $awc_no =  $this->request->data['Bpc']['awc_no'];
                           // $aww_no =  $this->request->data['Bpc']['aww_no'];
                           // $vhsnd_no =  $this->request->data['Bpc']['vhsnd_no'];
                           // $anm_no =  $this->request->data['Bpc']['anm_no'];
                           // $asha_facilitators_no =  $this->request->data['Bpc']['asha_facilitators_no'];
                           // $asha_no =  $this->request->data['Bpc']['asha_no'];
                            $remarks =  $this->request->data['Bpc']['remarks'];
                            $status =  $this->request->data['Bpc']['status'];
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
                               // 'allocated_panchayat'=>$allocated_panchayat,
                               // 'allocated_village'=> $allocated_village,
                                'date_of_joining'=>$date_of_joining,
                                'contract_end_date'=>$contract_end_date,
                               //// 'aphc_no'=>$aphc_no,
                               // 'hsc_no' =>$hsc_no,
                                //'awc_no'=>$awc_no,
                               // 'aww_no' =>$aww_no,
                               // 'vhsnd_no'=>$vhsnd_no,
                               // 'anm_no' =>$anm_no,
                              //  'asha_facilitators_no' =>$asha_facilitators_no,
                              //  'asha_no'=>$asha_no,
                                'remarks'=>$remarks,
                                'status'=>$status,
                                'id'=>$id
                                );  
                            
			if ($this->Bpc->save($data)) {
				$this->Session->setFlash(__('The BPC has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The BPC could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Bpc.' . $this->Bpc->primaryKey => $id));
			$this->request->data = $this->Bpc->find('first', $options);
			$executives=$this->User->find('all',array('conditions'=>array('User.status'=>'active','User.role'=>'regular','User.Type'=>'NGO','User.id'=>$this->request->data['Bpc']['first_name'])));
			if($this->request->data['Bpc']['allocated_district']!=0 and $this->request->data['Bpc']['allocated_district']!='')
			{
				$cities=$this->City->find('list',array('order' => array('name' => 'asc'),'conditions'=>array('City.id'=>$this->request->data['Bpc']['allocated_district'])));
				}
			else
			{
				$cities=$this->City->find('list',array('order' => array('name' => 'asc')));
				}
                               
//                                if($this->request->data['Bpc']['allocated_block']!=0 and $this->request->data['Bpc']['allocated_block']!='')
//			{
//				$blocks=$this->Block->find('list',array('conditions'=>array('Block.id'=>$this->request->data['Bpc']['allocated_block'])));
//				}
//			else
//			{
//				$desig=$this->Designation->find('list');
//				}
		///$cities=$this->City->find('list');
                $desig=$this->Designation->find('list');
		$blocks=$this->Block->find('list',array('order' => array('name' => 'asc')));
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
		$this->Bpc->id = $id;
		if (!$this->Bpc->exists()) {
			throw new NotFoundException(__('Invalid Bpc-cc Detail'));
		}
                  if(CakeSession::read('User.type')==='regular'){
                  $menu= $this->Session->read('User.mainmenu');
                if (in_array($this->request->params['controller'].":".$this->request->params['action'], $menu)) { 
             
		    //$this->request->onlyAllow('post', 'delete');
		    $this->Bpc->read(null,$id);
			$this->Bpc->set(array('status'=>$status));
		
		if ($this->Bpc->save()) {
			$this->Session->setFlash(__('The Bpc-cc has been '.$status));
		} else {
			$this->Session->setFlash(__('Nothing happen. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
                 } else {
                    
                    $this->requestAction(array('controller' => 'users', 'action' => 'checkRestriction'));
                }
                  } else {
                      //$this->request->onlyAllow('post', 'delete');
		    $this->Bpc->read(null,$id);
			$this->Bpc->set(array('status'=>$status));
		
		if ($this->Bpc->save()) {
			$this->Session->setFlash(__('The Bpc-cc has been '.$status));
		} else {
			$this->Session->setFlash(__('Nothing happen. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index')); 
                  }
	}
	public function getuser($id=null) {
	
		  $this->layout='ajax';
               $this->autoRender = false; 
		  $data= "<option>--Select--</option>";
          $subcatlist=$this->Bpc->find('first',array('conditions'=>array('Bpc.organization'=>$id)));
         // print_r($subcatlist);
         // die();
	 $executives=$this->User->find('all',array('conditions'=>array('User.id'=>$subcatlist['Bpc']['first_name'],'User.status'=>'active','User.role'=>'regular','User.subrole'=>'BPC','User.Type'=>'NGO')));
			
            foreach($executives as $usr) {
               $data.= '<option value="'.$usr['User']['id'].'">'.$usr['User']['name'].' '.$usr['User']['last_name'].'</option>';
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
	$condition2.=' and Bpc.id LIKE %'.$searchKey.'% || Bpccc.mobile LIKE %'.$searchKey.'%';
	
	}
	
	
	
              
		if(isset($this->request->query['organization']) and ($this->request->query['organization']!=0) and ($this->request->query['organization']!='')){$searchBuilderId=trim($this->request->query['organization']);  //$condition['Enquiry.country_id']=$searchCountryId;
		$condition2.=' and Bpc.organization='.$searchBuilderId;
		
		}
		
		if(isset($this->request->query['user']) and ($this->request->query['user']!=0) and ($this->request->query['user']!='')){$searchBlockId=trim($this->request->query['user']); //$condition['Enquiry.builder_id']=$searchBuilderId;
		$condition2.=' and Bpc.first_name='.$searchBlockId;
		}
		
		
               
//                if(isset($this->request->query['village']) and ($this->request->query['village']!=0) and ($this->request->query['village']!='')){$searchVillageId=trim($this->request->query['village']); //$condition['Enquiry.project_id']=$searchProjectId;
//		$condition2.=' and Bpccc.village='.$searchVillageId;
//		}
		
		
		
		}
		else {
		 if(CakeSession::read('User.type')==='user'){
			$r = $this->Ngo->find('first',array('conditions'=>array('Ngo.chief_functionary_name='.CakeSession::read('User.id'))));
                       $r['Ngo']['id'];
                       $condition2.=' and Bpc.organization='.$r['Ngo']['id'];
                        
			//$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
				
		}
		else {
		
		}
		}
		//$condition['NOT']=array('Enquiry.status'=>"trash");
		$condition2.=' and Bpc.status="active"';
		$this->response->download("BPC.csv");
		//print_r($condition); exit;
		$data=$this->Bpc->query('select Bpc.id,Bpc.designation,Bpc.gender,Bpc.mobile,Bpc.email_id,Bpc.address,Bpc.date_of_joining,Bpc.contract_end_date,Bpc.remarks,Ngo.name_of_ngo,User.name,User.last_name,City.name,Block.name,Bpc.status from bpcs as Bpc left join ngos as Ngo on Bpc.organization=Ngo.id left join cities as City  on Bpc.allocated_district=City.id left join blocks as Block  on Bpc.allocated_block=Block.id left join  users as User on Bpc.first_name=User.id where 1 '.$condition2 );
		
		
		//$data = $this->Geographical->find('all', array('conditions'=>$condition2));
		
		//$log = $this->Enquiry->getDataSource()->getLog(false, false);
        //debug($log);
		//exit;
		
            $headers = array('Bpc'=>array( 'Id' => 'Id','NGO' => 'NGO', 'District' => 'District', 'Block' => 'Block', 'Staff Name'=>'Staff Name','Designation'=>'Designation','Gender'=>'Gender','Mobile'=>'Mobile','Email'=>'Email','Address'=>'Address', 'Date of Joining' => 'Date of Joining','Contract End Date' => 'Contract End Date','Remarks'=>'Remarks','Status' => 'Status')); 
	    $this->set(compact('data','headers'));
		$this->layout = 'ajax';
		return;
		
		}
  ////  reports section ---/////
	
}
	
	
	
	
