<?php
App::uses('AppController', 'Controller');
/**
 * Resales Controller
 *
 * @property Resale $Resale
 * @property PaginatorComponent $Paginator
 */
class ResalesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
	var  $uses = array('Resale','User');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		
	    $condition='';
		$searchKey='';
		
		if(isset($this->params->query['confirm'])) {
			
	/*if (isset($this->params->query['user_id']) && ($this->params->query['user_id']!="")  && ($this->checkUser($this->params->query['user_id'])==false))
	 { throw new NotFoundException(__('Invalid Lead'));
		}*/
			
		if(isset($this->params->query['search_key']) && (trim($this->params->query['search_key'])!="")) { $searchKey=$this->params->query['search_key']; $condition['OR']=array('Resale.id LIKE'=>'%'.$searchKey.'%','Resale.name LIKE'=>'%'.$searchKey.'%','Resale.email LIKE'=>'%'.$searchKey.'%','Resale.contact LIKE'=>'%'.$searchKey.'%');}

		if(isset($this->params->query['user_id']) && ($this->params->query['user_id']!=""))
		{
			 $condition['Resale.user_id']=trim($this->params->query['user_id']);
			}
			
			if(isset($this->params->query['client_type']) && ($this->params->query['client_type']!="" ||  $this->params->query['client_type']!=0)) {$condition['Resale.client_type']=trim($this->params->query['client_type']);}

		if(isset($this->params->query['country_id']) && ($this->params->query['country_id']!="" ||  $this->params->query['country_id']!=0)) {$condition['Resale.country_id']=trim($this->params->query['country_id']);}
		
		if(isset($this->params->query['builder_id']) && ($this->params->query['builder_id']!="" ||  $this->params->query['builder_id']!=0)) {$condition['Resale.builder_id']=trim($this->params->query['builder_id']);}
		
		if(isset($this->params->query['project_id'])&& ($this->params->query['project_id']!="" ||  $this->params->query['project_id']!=0)) {$condition['Resale.project_id']=trim($this->params->query['project_id']);}
		
		if(isset($this->params->query['close_reason_id']) && ($this->params->query['close_reason_id']!="" ||  $this->params->query['close_reason_id']!=0)) {$condition['Resale.close_reason_id']=trim($this->params->query['close_reason_id']);}
		
		if(isset($this->params->query['status']) && ($this->params->query['status']!="" ||  $this->params->query['status']!=0)) {$condition['Resale.status']=trim($this->params->query['status']);}
		
		if(isset($this->params->query['posted_date']) && ($this->params->query['posted_date']!="")) {$condition['date(Resale.posted_date)']=trim($this->params->query['posted_date']);}
		
		}
		else
		{	 
		if(CakeSession::read('User.type')==='regular')
		{
			 $condition['Resale.user_id']=CakeSession::read('User.id');
			}
			else
			{
				
				}
			
			}
		
		
		
		
		$this->Paginator->settings = array('Resale' => array('limit' =>15,'order' => array('id' => 'desc'),'conditions'=>$condition));
		$this->Resale->recursive = 0;
		$this->set('resales', $this->Paginator->paginate());
		
		$users = $this->User->find('list',array('fields'=>array('parent'),'conditions'=>array('status'=>'active')));
		$builders = $this->Resale->Builder->find('list');
		$projects = $this->Resale->Project->find('list');
		$countries = $this->Resale->Country->find('list');
		$closeReasons = $this->Resale->CloseReason->find('list');
		$this->set(compact('users', 'builders', 'countries','closeReasons','projects'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Resale->exists($id)) {
			throw new NotFoundException(__('Invalid resale'));
		}
		if ($this->request->is('ajax')) {
		$options = array('conditions' => array('Resale.' . $this->Resale->primaryKey => $id));
		$this->set('resale', $this->Resale->find('first', $options));
		
		}
		$this->layout='ajax';
	}
	
	
	
		
		
		
		
		
		

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Resale->create();
			
			$this->request->data['Resale']['posted_date']=date('Y-m-d H:i:s');
			
			if ($this->Resale->save($this->request->data)) {
				$this->Session->setFlash(__('The resale has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The resale could not be saved. Please, try again.'));
			}
		}
		$builders = $this->Resale->Builder->find('list');
		$projects = $this->Resale->Project->find('list');
		$users = $this->Resale->User->find('list',array('fields'=>array('id','username')));
		$propertyTypes = $this->Resale->PropertyType->find('list');
		$countries = $this->Resale->Country->find('list');
		$closeReasons = $this->Resale->CloseReason->find('list');
		$leadSources = $this->Resale->LeadSource->find('list');
		$sectors = $this->Resale->Sector->find('list');
		$this->set(compact('builders', 'projects', 'users', 'propertyTypes', 'countries', 'closeReasons', 'leadSources', 'sectors'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Resale->exists($id)) {
			throw new NotFoundException(__('Invalid resale'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$this->request->data['Resale']['updated_date']=date('Y-m-d H:i:s');
			if ($this->Resale->save($this->request->data)) {
				$this->Session->setFlash(__('The resale has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The resale could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Resale.' . $this->Resale->primaryKey => $id));
			$this->request->data = $this->Resale->find('first', $options);
		}
		$builders = $this->Resale->Builder->find('list');
		$projects = $this->Resale->Project->find('list');
		$users = $this->Resale->User->find('list',array('fields'=>array('id','username')));
		$propertyTypes = $this->Resale->PropertyType->find('list');
		$countries = $this->Resale->Country->find('list');
		$closeReasons = $this->Resale->CloseReason->find('list');
		$leadSources = $this->Resale->LeadSource->find('list');
		$sectors = $this->Resale->Sector->find('list');
		$this->set(compact('builders', 'projects', 'users', 'propertyTypes', 'countries', 'closeReasons', 'leadSources', 'sectors'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		/*$this->Resale->id = $id;
		if (!$this->Resale->exists()) {
			throw new NotFoundException(__('Invalid resale'));
		}
		//$this->request->onlyAllow('post', 'delete');
		if ($this->Resale->delete()) {
			$this->Session->setFlash(__('The resale has been deleted.'));
		} else {
			$this->Session->setFlash(__('The resale could not be deleted. Please, try again.'));
		}*/
		
		$this->Session->setFlash(__('The resale could not be deleted.'));
		return $this->redirect(array('action' => 'index'));
	}
	
	public function checkUser($id) {
		
		if(CakeSession::read('User.type')==="regular") {
		$thisdata=$this->User->find("first",array('fields'=>'parent','conditions'=>array('User.id' => $id)));
		if(CakeSession::read('User.id')==$id)
		{  return true; }
		/*else if(CakeSession::read('User.id')===$thisdata['User']['parent'])
		{   return true; }	*/
		else
		{
			return false;
			}
		}
		else
		{
			return true;
			}
		
		
	}
	
	
	public function export() {
		
	    $condition='';
		$searchKey='';
		
		if(isset($this->params->query['confirm'])) {
			
		if(isset($this->params->query['search_key']) && (trim($this->params->query['search_key'])!="")) { $searchKey=$this->params->query['search_key']; $condition['OR']=array('Resale.id LIKE'=>'%'.$searchKey.'%','Resale.name LIKE'=>'%'.$searchKey.'%','Resale.email LIKE'=>'%'.$searchKey.'%','Resale.contact LIKE'=>'%'.$searchKey.'%');}

		if(isset($this->params->query['user_id']) && ($this->params->query['user_id']!=""))
		{
			 $condition['Resale.user_id']=trim($this->params->query['user_id']);
			}
			
			if(isset($this->params->query['client_type']) && ($this->params->query['client_type']!="" ||  $this->params->query['client_type']!=0)) {$condition['Resale.client_type']=trim($this->params->query['client_type']);}

		if(isset($this->params->query['country_id']) && ($this->params->query['country_id']!="" ||  $this->params->query['country_id']!=0)) {$condition['Resale.country_id']=trim($this->params->query['country_id']);}
		
		if(isset($this->params->query['builder_id']) && ($this->params->query['builder_id']!="" ||  $this->params->query['builder_id']!=0)) {$condition['Resale.builder_id']=trim($this->params->query['builder_id']);}
		
		if(isset($this->params->query['project_id'])&& ($this->params->query['project_id']!="" ||  $this->params->query['project_id']!=0)) {$condition['Resale.project_id']=trim($this->params->query['project_id']);}
		
		if(isset($this->params->query['close_reason_id']) && ($this->params->query['close_reason_id']!="" ||  $this->params->query['close_reason_id']!=0)) {$condition['Resale.close_reason_id']=trim($this->params->query['close_reason_id']);}
		
		if(isset($this->params->query['status']) && ($this->params->query['status']!="" ||  $this->params->query['status']!=0)) {$condition['Resale.status']=trim($this->params->query['status']);}
		
		if(isset($this->params->query['posted_date']) && ($this->params->query['posted_date']!="")) {$condition['date(Resale.posted_date)']=trim($this->params->query['posted_date']);}
		
		}
		else
		{	 
		if(CakeSession::read('User.type')==='regular')
		{
			 $condition['Resale.user_id']=CakeSession::read('User.id');
			}
			else
			{
				
				}
			
			}
		
		$this->response->download("data.csv");
		$resalealldata=$this->Resale->find('all',array('conditions'=>$condition));
		$this->set('resales', $resalealldata);
		
		
		/*$headers = array('Resale'=>array( 'Id' => 'Id','Email' => 'Email','Email2' => 'Email2','contact' => 'contact','Builder' => 'Builder','Project' => 'Project','Executive' => 'Executive','Refer Executive Name' => 'Refer Executive Name','Second Name' => 'Second Name','Unit Type' => 'Unit Type','Unit No' => 'Unit No','Tower' => 'Tower','Area' => 'Area','Floor' => 'Floor','Floor' => 'Floor')); 
	    $this->set(compact('data','headers'));*/
		
		
		
		$this->layout='ajax';
	}
	
	
	
	
	}
