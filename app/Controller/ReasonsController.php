<?php
App::uses('AppController', 'Controller');
/**
 * subcategorys Controller
 *
 * @property City $City
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ReasonsController  extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
	//var  $uses = array('Reason','Financial');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Paginator->settings = array('Reason' => array('limit' =>10,'order' => array('name' => 'asc')));
		$this->Reason->recursive = 0;
		$this->set('reasons', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Reason->exists($id)) {
			throw new NotFoundException(__('Invalid city'));
		}
		$options = array('conditions' => array('Reason.' . $this->Reason->primaryKey => $id));
		$this->set('reason', $this->Reason->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Reason->create();
                        //print_r($this->request->data);
                           // die();
			if ($this->Reason->save($this->request->data)) {
                            
                            
				$this->Session->setFlash(__('The Financial Reason has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Financial Reason could not be saved. Please, try again.'));
			}
		}
		$financials = $this->Reason->ReasonCategory->find('list');
		$this->set(compact('financials'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Reason->exists($id)) {
			throw new NotFoundException(__('Invalid city'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Reason->save($this->request->data)) {
				$this->Session->setFlash(__('The city has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Financial category could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Reason.' . $this->Reason->primaryKey => $id));
			$this->request->data = $this->Reason->find('first', $options);
		}
		$financials = $this->Reason->ReasonCategory->find('list');
		$this->set(compact('financials'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Reason->id = $id;
		if (!$this->Reason->exists()) {
			throw new NotFoundException(__('Invalid block'));
		}
		//$this->request->allowMethod('post', 'delete');
		if ($this->Reason->delete()) {
			$this->Session->setFlash(__('The city has been deleted.'));
		} else {
			$this->Session->setFlash(__('The city could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
        
        public function getsubcat($stateid) {
	    $this->layout='ajax';
        $this->autoRender = false;
	    $data='<option value="">Select Reason</option>';
		$subcatlist=$this->Reason->find('list',array("conditions"=>array('cat_id'=>$stateid)));
		foreach($subcatlist as $key=>$value){ $data.='<option value="'.$key.'">'.$value.'</option>';}
		return $data;
	}
        public function gettitle($id) {
	  
		$options = array('conditions' => array('Reason.' . $this->Reason->primaryKey => $id));
		$data=$this->Reason->find('first',$options);
		return $data;
	}    
                   
                
}
