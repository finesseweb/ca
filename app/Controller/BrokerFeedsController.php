<?php
App::uses('AppController', 'Controller');
/**
 * BrokerFeeds Controller
 *
 * @property BrokerFeed $BrokerFeed
 * @property PaginatorComponent $Paginator
 */
class BrokerFeedsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Upload');

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
				  $searchKey=$this->params->query['search_key']; $condition['OR']=array('BrokerFeed.name LIKE'=>'%'.$searchKey.'%','BrokerFeed.email LIKE'=>'%'.$searchKey.'%',
				  'BrokerFeed.contact_no LIKE'=>'%'.$searchKey.'%','BrokerFeed.address LIKE'=>'%'.$searchKey.'%','BrokerFeed.primary LIKE'=>'%'.$searchKey.'%');
				  }
				  }
				  $this->BrokerFeed->recursive = 0;
				  $this->Paginator->settings = array('BrokerFeed' => array('limit' =>15,'order' => array('id' => 'desc'),'conditions'=>$condition));
				  $this->set('brokerFeeds', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->BrokerFeed->exists($id)) {
			throw new NotFoundException(__('Invalid broker feed'));
		}
		if ($this->request->is('ajax')) {
		$options = array('conditions' => array('BrokerFeed.' . $this->BrokerFeed->primaryKey => $id));
		$this->set('brokerFeed', $this->BrokerFeed->find('first', $options));
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
			$this->BrokerFeed->create();
			$destinationorig = realpath('../webroot/img/visiting-card/orig/') . '/';
	        $destinationthumb =realpath('../webroot/img/visiting-card/thumb/') . '/';
			$resultval="" ;
			$file = $this->request->data['BrokerFeed']['visiting_card'];
			if($file['name']!=""){ 
			$resultval = $this->Upload->uploadimg($file,$destinationorig,$destinationthumb,352,240); }
			$this->request->data['BrokerFeed']['visiting_card']=$resultval;
			if ($this->BrokerFeed->save($this->request->data)) {
				$this->Session->setFlash(__('The broker feed has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The broker feed could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->BrokerFeed->exists($id)) {
			throw new NotFoundException(__('Invalid broker feed'));
		}
		if ($this->request->is(array('post', 'put'))) {
			
			$destinationorig = realpath('../webroot/img/visiting-card/orig/') . '/';
	        $destinationthumb = realpath('../webroot/img/visiting-card/thumb/') . '/';
			$resultval="" ;
			if($this->request->data['BrokerFeed']['visiting_card_new']['size']!=0){
			@unlink($destinationorig.$this->request->data['BrokerFeed']['visiting_card']);
			@unlink($destinationthumb.$this->request->data['BrokerFeed']['visiting_card']);
			$file = $this->request->data['BrokerFeed']['visiting_card_new'];
			$resultval = $this->Upload->uploadimg($file,$destinationorig,$destinationthumb,162,76); 
			$this->request->data['BrokerFeed']['visiting_card']=$resultval;}
			
			if ($this->BrokerFeed->save($this->request->data)) {
				$this->Session->setFlash(__('The broker feed has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The broker feed could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('BrokerFeed.' . $this->BrokerFeed->primaryKey => $id));
			$this->request->data = $this->BrokerFeed->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->BrokerFeed->id = $id;
		if (!$this->BrokerFeed->exists()) {
			throw new NotFoundException(__('Invalid broker feed'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->BrokerFeed->delete()) {
			$this->Session->setFlash(__('The broker feed has been deleted.'));
		} else {
			$this->Session->setFlash(__('The broker feed could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	public function printFeeds($id = null) {
		if (!$this->BrokerFeed->exists($id)) {
			throw new NotFoundException(__('Invalid remote'));
		}
		$options = array('conditions' => array('BrokerFeed.' . $this->BrokerFeed->primaryKey => $id));
		$this->set('brokerFeed', $this->BrokerFeed->find('first', $options));
		$this->layout='print';
	}
	
	}
