<?php
App::uses('AppController', 'Controller');
/**
 * Ngos Controller
 *
 * @property Ngo $Ngo
 * @property PaginatorComponent $Paginator
 */
class DposController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Upload');

    var  $uses = array('Dpo','User','Project','Ngo','Location','Country','City','Block','Designation');
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
    $condition['OR']=array('Dpo.id LIKE'=>'%'.$searchKey.'%','Dpo.first_name LIKE'=>'%'.$searchKey.'%','Dpo.last_name LIKE'=>'%'.$searchKey.'%','Dpo.mobile LIKE '=>'%'.$searchKey.'%','Dpo.email_id LIKE '=>'%'.$searchKey.'%'); 
	
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
//		if(isset($this->request->query['search_builder']) and ($this->request->query['search_builder']!=0) and ($this->request->query['search_builder']!='')){$searchBuilderId=trim($this->request->query['search_builder']); 
//		$condition['Ngo.bulider_name']=$searchBuilderId;
//		}
//		
//		if(isset($this->request->query['search_project']) and ($this->request->query['search_project']!=0) and ($this->request->query['search_project']!='')){$searchProjectId=trim($this->request->query['search_project']);
//		$condition['Ngo.project_name']=$searchProjectId;
//		}
//		
//		if(isset($this->request->query['search_user']) and ($this->request->query['search_user']!=0) and ($this->request->query['search_user']!='')){$searchUserId=trim($this->request->query['search_user']);
//		$condition['OR']=array('Ngo.booked_by'=>$searchUserId,'Ngo.booked_by_2'=>$searchUserId);
//		}
//		
	}
		
	    $this->Paginator->settings = array('Dpo' => array('limit' =>20,'order' => array('id' => 'desc'),'conditions'=>array($condition,'Dpo.status'=>'active')));
		$this->Dpo->recursive = 0;
		$this->set('administrations', $this->Paginator->paginate());
		
			
			$users = $this->User->find('list',array('fields'=>array('parent'),'conditions'=>array('status'=>'active')));
			
			$this->set(compact('users','projects','administrations'));
			
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Dpo->exists($id)) {
			throw new NotFoundException(__('Invalid booking'));
		}
		$options = array('conditions' => array('Dpo.' . $this->Dpo->primaryKey => $id));
		$this->set('administration', $this->Dpo->find('first', $options));
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
			$this->Dpo->create();
			if ($this->Dpo->save($this->request->data)) {
				$this->Session->setFlash(__('The Dpo has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Dpo could not be saved. Please, try again.'));
			}
		}
		$executives=$this->User->find('all',array('conditions'=>array('User.status'=>'active','User.role'=>'regular','User.Type'=>'PFI')));
		$cities=$this->City->find('list');
                $desig=$this->Designation->find('list');
		//$ngos=$this->Ngo->find('list');
		//$builders=$this->Builder->find('list');
		$this->set(compact('executives','cities','builders','ngos','desig'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Dpo->exists($id)) {
			throw new NotFoundException(__('Invalid Dpo'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Dpo->save($this->request->data)) {
				$this->Session->setFlash(__('The Dpo has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Dpo could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Dpo.' . $this->Dpo->primaryKey => $id));
			$this->request->data = $this->Dpo->find('first', $options);
			$executives=$this->User->find('all',array('conditions'=>array('User.status'=>'active','User.role'=>'regular','User.Type'=>'PFI','User.id'=>$this->request->data['Dpo']['first_name'])));
			
                                if($this->request->data['Dpo']['designation']!=0 and $this->request->data['Dpo']['designation']!='')
			{
				$desig=$this->Designation->find('list',array('conditions'=>array('Designation.id'=>$this->request->data['Dpo']['designation'])));
				}
			else
			{
				$desig=$this->Designation->find('list');
				}
			//$locations=$this->Location->find('list');
			//$builders=$this->Builder->find('list');
                                
                          $cities=$this->City->find('list');
			$this->set(compact('desig','cities','ngos','locations','executives'));
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
		$this->Dpo->id = $id;
		if (!$this->Dpo->exists()) {
			throw new NotFoundException(__('Invalid Dpo'));
		}
                if(CakeSession::read('User.type')==='regular'){
                 $menu= $this->Session->read('User.mainmenu');
                if (in_array($this->request->params['controller'].":".$this->request->params['action'], $menu)) { 
             
		    //$this->request->onlyAllow('post', 'delete');
		    $this->Dpo->read(null,$id);
			$this->Dpo->set(array('status'=>$status));
		
		if ($this->Dpo->save()) {
			$this->Session->setFlash(__('The Dpo has been '.$status));
		} else {
			$this->Session->setFlash(__('Nothing happen. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
                 } else {
                    
                    $this->requestAction(array('controller' => 'users', 'action' => 'checkRestriction'));
                }
                } else {
                      $this->Dpo->read(null,$id);
			$this->Dpo->set(array('status'=>$status));
		
		if ($this->Dpo->save()) {
			$this->Session->setFlash(__('The Dpo has been '.$status));
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
		
		//$condition['NOT']=array('Enquiry.status'=>"trash");
		$condition2.=' and Dpo.status="active"';
		$this->response->download("DPO.csv");
		//print_r($condition); exit;
		$data=$this->Dpo->query('select Dpo.id,Dpo.designation,Dpo.gender,Dpo.mobile,Dpo.email_id,Dpo.address,User.name,User.last_name,City.name,Dpo.status from dpos as Dpo left join cities as City  on Dpo.district=City.id left join  users as User on Dpo.first_name=User.id where 1 '.$condition2 );
		
		
		//$data = $this->Geographical->find('all', array('conditions'=>$condition2));
		
		//$log = $this->Enquiry->getDataSource()->getLog(false, false);
        //debug($log);
		//exit;
		
            $headers = array('Bpc'=>array( 'Id' => 'Id','District' => 'District', 'Staff Name'=>'Staff Name','Designation'=>'Designation','Gender'=>'Gender','Mobile'=>'Mobile','Email'=>'Email','Address'=>'Address','Status' => 'Status')); 
	    $this->set(compact('data','headers'));
		$this->layout = 'ajax';
		return;
		
		}
  ////  reports section ---/////	
    
	
	
	
	}
	
	
	
	
