<?php
App::uses('AppController', 'Controller');
/**
 * Cities Controller
 *
 * @property City $City
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class MeetingFacilitatedController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
	var  $uses = array('MeetingFacilitated');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Paginator->settings = array('MeetingFacilitated' => array('limit' =>10,'order' => array('name' => 'asc')));
		$this->MeetingFacilitated->recursive = 0;
		$this->set('facilitateds', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->MeetingFacilitated->exists($id)) {
			throw new NotFoundException(__('Invalid city'));
		}
		$options = array('conditions' => array('MeetingFacilitated.' . $this->MeetingFacilitated->primaryKey => $id));
		$this->set('facilitated', $this->MeetingFacilitated->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->MeetingFacilitated->create();
			if ($this->MeetingFacilitated->save($this->request->data)) {
				$this->Session->setFlash(__('The Meeting Facilitated has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Meeting Facilitated could not be saved. Please, try again.'));
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
		if (!$this->MeetingFacilitated->exists($id)) {
			throw new NotFoundException(__('Invalid city'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->MeetingFacilitated->save($this->request->data)) {
				$this->Session->setFlash(__('The Meeting Facilitated has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Meeting Facilitated could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('MeetingFacilitated.' . $this->MeetingFacilitated->primaryKey => $id));
			$this->request->data = $this->MeetingFacilitated->find('first', $options);
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
		$this->MeetingFacilitated->id = $id;
		if (!$this->MeetingFacilitated->exists()) {
			throw new NotFoundException(__('Invalid Meeting Facilitated'));
		}
		//$this->request->allowMethod('post', 'delete');
		if ($this->MeetingFacilitated->delete()) {
			$this->Session->setFlash(__('The Meeting Facilitated has been deleted.'));
		} else {
			$this->Session->setFlash(__('The Meeting Facilitated could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
        
        public function getblocks($stateid) {
	    $this->layout='ajax';
        $this->autoRender = false;
	    $data='<option value="">Select Block</option>';
		$subcatlist=$this->Financial->find('list',array("conditions"=>array('city_id'=>$stateid)));
		foreach($subcatlist as $key=>$value){ $data.='<option value="'.$key.'">'.$value.'</option>';}
		return $data;
	}
                
                
}
