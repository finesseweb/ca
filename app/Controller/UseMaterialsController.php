<?php
App::uses('AppController', 'Controller');
/**
 * Cities Controller
 *
 * @property City $City
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UseMaterialsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
	//var  $uses = array('RegisterMember');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Paginator->settings = array('UseMaterial' => array('limit' =>10,'order' => array('name' => 'asc')));
		$this->UseMaterial->recursive = 0;
		$this->set('materials', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->UseMaterial->exists($id)) {
			throw new NotFoundException(__('Invalid city'));
		}
		$options = array('conditions' => array('UseMaterial.' . $this->UseMaterial->primaryKey => $id));
		$this->set('material', $this->UseMaterial->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->UseMaterial->create();
			if ($this->UseMaterial->save($this->request->data)) {
				$this->Session->setFlash(__('The Register Member has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Register Member could not be saved. Please, try again.'));
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
		if (!$this->UseMaterial->exists($id)) {
			throw new NotFoundException(__('Invalid city'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->UseMaterial->save($this->request->data)) {
				$this->Session->setFlash(__('The Register Member has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Register Member  could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('UseMaterial.' . $this->UseMaterial->primaryKey => $id));
			$this->request->data = $this->UseMaterial->find('first', $options);
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
		$this->UseMaterial->id = $id;
		if (!$this->UseMaterial->exists()) {
			throw new NotFoundException(__('Invalid Register Member'));
		}
		//$this->request->allowMethod('post', 'delete');
		if ($this->UseMaterial->delete()) {
			$this->Session->setFlash(__('The Register Member has been deleted.'));
		} else {
			$this->Session->setFlash(__('The Register Member could not be deleted. Please, try again.'));
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
            public function gettitle($id) {
	  
		$options = array('conditions' => array('RegisterMember.' . $this->RegisterMember->primaryKey => $id));
		$data=$this->RegisterMember->find('first',$options);
		return $data;
	}    
                
}
