<?php
App::uses('AppController', 'Controller');
/**
 * CustomerFeedbacks Controller
 *
 * @property CustomerFeedback $CustomerFeedback
 * @property PaginatorComponent $Paginator
 */
class CustomerFeedbacksController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
	var  $uses = array('CustomerFeedback','MoreCustomerFeed','User');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		
			$condition='';
			$searchKey='';
			if(isset($this->params->query['confirm'])) {
					
			if(isset($this->params->query['search_key']) && (trim($this->params->query['search_key'])!="")) { 
			$searchKey=$this->params->query['search_key']; $condition['OR']=array('CustomerFeedback.name LIKE'=>'%'.$searchKey.'%','CustomerFeedback.email LIKE'=>'%'.$searchKey.'%',
			'CustomerFeedback.contact LIKE'=>'%'.$searchKey.'%');}
			
			if(isset($this->params->query['meeting_done_by']) && ($this->params->query['meeting_done_by']!="" ||  $this->params->query['meeting_done_by']!=0)) {$condition['CustomerFeedback.meeting_done_by']=trim($this->params->query['meeting_done_by']);}
			
			if(isset($this->params->query['user_id']) && ($this->params->query['user_id']!="" ||  $this->params->query['user_id']!=0)) {$condition['CustomerFeedback.user_id']=trim($this->params->query['user_id']);}
			
			if(isset($this->params->query['meeting_place']) && (trim($this->params->query['meeting_place'])!="")) {$condition['CustomerFeedback.meeting_place']=trim($this->params->query['meeting_place']);}
			
			if(isset($this->params->query['reference']) && ($this->params->query['reference']!="" ||  $this->params->query['reference']!=0)) {$condition['OR']=array('CustomerFeedback.reference like '=>'%'.trim($this->params->query['reference']).'%');}
		
			
			if(isset($this->params->query['customer_type']) && ($this->params->query['customer_type']!="" ||  $this->params->query['customer_type']!=0)) {$condition['CustomerFeedback.customer_type']=trim($this->params->query['customer_type']);}
			}
			
			$this->CustomerFeedback->recursive = 0;
			$this->Paginator->settings = array('CustomerFeedback' => array('limit' =>15,'order' => array('id' => 'desc'),'conditions'=>$condition));
			$this->set('customerFeedbacks', $this->Paginator->paginate());
			$users = $this->User->find('list',array('fields'=>array('parent'),'conditions'=>array('status'=>'active')));
			$this->set('users', $users);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->CustomerFeedback->exists($id)) {
			throw new NotFoundException(__('Invalid customer feedback'));
		}
		if ($this->request->is('ajax')) {
		$moreCustomerFeeds='';
		$moreCustomerFeedcount=0;
		$options = array('conditions' => array('CustomerFeedback.' . $this->CustomerFeedback->primaryKey => $id));
		$moreCustomerFeedcount=$this->MoreCustomerFeed->find('count',array('conditions'=>array('MoreCustomerFeed.customer_feedback_id'=>$id)));
		if($moreCustomerFeedcount!=0){
		$moreCustomerFeeds=$this->MoreCustomerFeed->find('all',array('conditions'=>array('MoreCustomerFeed.customer_feedback_id'=>$id)));	
			}
		$this->set('customerFeedback', $this->CustomerFeedback->find('first', $options));
		$this->set('moreCustomerFeeds',$moreCustomerFeeds);
		$this->set('moreCustomerFeedcount',$moreCustomerFeedcount);
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
		$lookingfor='';
		$reference='';
			$this->CustomerFeedback->create();
			
			if(!empty($this->request->data['CustomerFeedback']['lookingfor'])){$lookingfor=serialize($this->request->data['CustomerFeedback']['lookingfor']);}	
			else{$lookingfor='';}
			
			if(!empty($this->request->data['CustomerFeedback']['reference'])){$reference=serialize($this->request->data['CustomerFeedback']['reference']);}	
			else{$reference='';}
			
			$this->request->data['CustomerFeedback']['lookingfor']=$lookingfor;
			$this->request->data['CustomerFeedback']['reference']=$reference;
			
			if ($this->CustomerFeedback->save($this->request->data)) {
				$this->Session->setFlash(__('The customer feedback has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The customer feedback could not be saved. Please, try again.'));
			}
		}
		$users = $this->CustomerFeedback->User->find('list',array('conditions'=>array('User.status'=>'active','User.role'=>array('regular','admin')),'fields'=>array('id','username')));
		$this->set(compact('users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->CustomerFeedback->exists($id)) {
			throw new NotFoundException(__('Invalid customer feedback'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$lookingfor='';
			$reference='';
			$this->CustomerFeedback->create();
			if(!empty($this->request->data['CustomerFeedback']['lookingfor'])){$lookingfor=serialize($this->request->data['CustomerFeedback']['lookingfor']);}	
			else{$lookingfor='';}
			
			if(!empty($this->request->data['CustomerFeedback']['reference'])){$reference=serialize($this->request->data['CustomerFeedback']['reference']);}	
			else{$reference='';}
			
			
			$this->request->data['CustomerFeedback']['lookingfor']=$lookingfor;
			$this->request->data['CustomerFeedback']['reference']=$reference;
			if ($this->CustomerFeedback->save($this->request->data)) {
				$this->Session->setFlash(__('The customer feedback has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The customer feedback could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('CustomerFeedback.' . $this->CustomerFeedback->primaryKey => $id));
			$this->request->data = $this->CustomerFeedback->find('first', $options);
		}
		$users = $this->CustomerFeedback->User->find('list',array('conditions'=>array('User.status'=>'active','User.role'=>array('regular','admin')),'fields'=>array('id','username')));
		$this->set(compact('users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->CustomerFeedback->id = $id;
		if (!$this->CustomerFeedback->exists()) {
			throw new NotFoundException(__('Invalid customer feedback'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->CustomerFeedback->delete()) {
			$this->Session->setFlash(__('The customer feedback has been deleted.'));
		} else {
			$this->Session->setFlash(__('The customer feedback could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	public function printFeeds($id = null) {
		if (!$this->CustomerFeedback->exists($id)) {
			throw new NotFoundException(__('Invalid remote'));
		}
		$options = array('conditions' => array('CustomerFeedback.' . $this->CustomerFeedback->primaryKey => $id));
		$this->set('customerFeedback', $this->CustomerFeedback->find('first', $options));
		$this->layout='print';
	}
	
	}
