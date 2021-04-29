<?php
App::uses('AppController', 'Controller');
/**
 * MoreCustomerFeeds Controller
 *
 * @property MoreCustomerFeed $MoreCustomerFeed
 * @property PaginatorComponent $Paginator
 */
class MoreCustomerFeedsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
	var  $uses = array('MoreCustomerFeed','CustomerFeedback');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$condition='';
		$searchKey='';
		if(isset($this->params->query['confirm'])) {
		
		if(isset($this->params->query['customer_feedback_id']) && ($this->params->query['customer_feedback_id']!="" ||  $this->params->query['customer_feedback_id']!=0)) {$condition['MoreCustomerFeed.customer_feedback_id']=trim($this->params->query['customer_feedback_id']);}	
		}
		
		$this->MoreCustomerFeed->recursive = 0;
		$this->Paginator->settings = array('MoreCustomerFeed' => array('limit' =>15,'order' => array('id' => 'desc'),'conditions'=>$condition));
		$this->set('moreCustomerFeeds', $this->Paginator->paginate());
		$this->set('customerFeedbacks', $this->CustomerFeedback->find('list'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->MoreCustomerFeed->exists($id)) {
			throw new NotFoundException(__('Invalid more customer feed'));
		}
		if ($this->request->is('ajax')) {
		$options = array('conditions' => array('MoreCustomerFeed.' . $this->MoreCustomerFeed->primaryKey => $id));
		$this->set('moreCustomerFeed', $this->MoreCustomerFeed->find('first', $options));
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
			
			if(!empty($this->request->data['MoreCustomerFeed']['project'])) {
			foreach( $this->request->data['MoreCustomerFeed']['project'] as $key=>$value)
			{
			$this->MoreCustomerFeed->create();
			
			$customer_feedback_id=$this->request->data['MoreCustomerFeed']['customer_feedback_id'];
			$project=$this->request->data['MoreCustomerFeed']['project'][$key];
			$sector=$this->request->data['MoreCustomerFeed']['sector'][$key];
			$location=$this->request->data['MoreCustomerFeed']['location'][$key];
			$projecttype=$this->request->data['MoreCustomerFeed']['projecttype'][$key];
			$area=$this->request->data['MoreCustomerFeed']['area'][$key];
			$bhk=$this->request->data['MoreCustomerFeed']['bhk'][$key];
			$tower=$this->request->data['MoreCustomerFeed']['tower'][$key];
			$floor=$this->request->data['MoreCustomerFeed']['floor'][$key];
			$plc=$this->request->data['MoreCustomerFeed']['plc'][$key];
			$rate=$this->request->data['MoreCustomerFeed']['rate'][$key];
			$demand=$this->request->data['MoreCustomerFeed']['demand'][$key];
			$paid=$this->request->data['MoreCustomerFeed']['paid'][$key];
			
			$this->MoreCustomerFeed->set(array('project'=>$project,'sector'=>$sector,'location'=>$location,'projecttype'=>$projecttype,'area'=>$area,'bhk'=>$bhk,
			'tower'=>$tower,'floor'=>$floor,'plc'=>$plc,'rate'=>$rate,'demand'=>$demand,'paid'=>$paid,'customer_feedback_id'=>$customer_feedback_id));

		    $savedata=$this->MoreCustomerFeed->save();
			}
			} 
			if ($savedata) {
				$this->Session->setFlash(__('The more customer feed has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The more customer feed could not be saved. Please, try again.'));
			}
		}
		$customerFeedbacks = $this->MoreCustomerFeed->CustomerFeedback->find('list');
		$this->set(compact('customerFeedbacks'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->MoreCustomerFeed->exists($id)) {
			throw new NotFoundException(__('Invalid more customer feed'));
		}
		if ($this->request->is(array('post', 'put'))) {
			
			if(!empty($this->request->data['MoreCustomerFeed']['project'])) {
			$id=$this->request->data['MoreCustomerFeed']['id'][0];
			foreach( $this->request->data['MoreCustomerFeed']['project'] as $key=>$value)
			{
				
			$customer_feedback_id=$this->request->data['MoreCustomerFeed']['customer_feedback_id'];
			$project=$this->request->data['MoreCustomerFeed']['project'][$key];
			$sector=$this->request->data['MoreCustomerFeed']['sector'][$key];
			$location=$this->request->data['MoreCustomerFeed']['location'][$key];
			$projecttype=$this->request->data['MoreCustomerFeed']['projecttype'][$key];
			$area=$this->request->data['MoreCustomerFeed']['area'][$key];
			$bhk=$this->request->data['MoreCustomerFeed']['bhk'][$key];
			$tower=$this->request->data['MoreCustomerFeed']['tower'][$key];
			$floor=$this->request->data['MoreCustomerFeed']['floor'][$key];
			$plc=$this->request->data['MoreCustomerFeed']['plc'][$key];
			$rate=$this->request->data['MoreCustomerFeed']['rate'][$key];
			$demand=$this->request->data['MoreCustomerFeed']['demand'][$key];
			$paid=$this->request->data['MoreCustomerFeed']['paid'][$key];
			
			if(!empty($this->request->data['MoreCustomerFeed']['id'][$key])) {
				
			$this->MoreCustomerFeed->read(null, $id);
			$this->MoreCustomerFeed->set(array('project'=>$project,'sector'=>$sector,'location'=>$location,'projecttype'=>$projecttype,'area'=>$area,'bhk'=>$bhk,
			'tower'=>$tower,'floor'=>$floor,'plc'=>$plc,'rate'=>$rate,'demand'=>$demand,'paid'=>$paid,'customer_feedback_id'=>$customer_feedback_id));
			}
			else
			{    
			$this->MoreCustomerFeed->create();
			$this->MoreCustomerFeed->set(array('project'=>$project,'sector'=>$sector,'location'=>$location,'projecttype'=>$projecttype,'area'=>$area,'bhk'=>$bhk,
			'tower'=>$tower,'floor'=>$floor,'plc'=>$plc,'rate'=>$rate,'demand'=>$demand,'paid'=>$paid,'customer_feedback_id'=>$customer_feedback_id));
			}
			$savedata=$this->MoreCustomerFeed->save();
			}
            
		    
			}
			
			if ($savedata) {
				$this->Session->setFlash(__('The more customer feed has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The more customer feed could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('MoreCustomerFeed.' . $this->MoreCustomerFeed->primaryKey => $id));
			$this->request->data = $this->MoreCustomerFeed->find('first', $options);
		}
		$customerFeedbacks = $this->MoreCustomerFeed->CustomerFeedback->find('list');
		$this->set(compact('customerFeedbacks'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->MoreCustomerFeed->id = $id;
		if (!$this->MoreCustomerFeed->exists()) {
			throw new NotFoundException(__('Invalid more customer feed'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->MoreCustomerFeed->delete()) {
			$this->Session->setFlash(__('The more customer feed has been deleted.'));
		} else {
			$this->Session->setFlash(__('The more customer feed could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
