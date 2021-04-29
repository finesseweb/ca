<?php
App::uses('AppController', 'Controller');
/**
 * Cities Controller
 *
 * @property City $City
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ContraceptivesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
	var  $uses = array('Contraceptive');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Paginator->settings = array('Contraceptive' => array('limit' =>10,'order' => array('name' => 'asc')));
		$this->Contraceptive->recursive = 0;
		$this->set('contraceptives', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Contraceptive->exists($id)) {
			throw new NotFoundException(__('Invalid city'));
		}
		$options = array('conditions' => array('Contraceptive.' . $this->Contraceptive->primaryKey => $id));
		$this->set('contraceptive', $this->Contraceptive->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Contraceptive->create();
			if ($this->Contraceptive->save($this->request->data)) {
				$this->Session->setFlash(__('The Contraceptive has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Financial could not be saved. Please, try again.'));
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
		if (!$this->Contraceptive->exists($id)) {
			throw new NotFoundException(__('Invalid city'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Contraceptive->save($this->request->data)) {
				$this->Session->setFlash(__('The Contraceptive has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Contraceptive category could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Contraceptive.' . $this->Contraceptive->primaryKey => $id));
			$this->request->data = $this->Contraceptive->find('first', $options);
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
		$this->Contraceptive->id = $id;
		if (!$this->Contraceptive->exists()) {
			throw new NotFoundException(__('Invalid Contraceptive'));
		}
		//$this->request->allowMethod('post', 'delete');
		if ($this->Contraceptive->delete()) {
			$this->Contraceptive->setFlash(__('The Contraceptive has been deleted.'));
		} else {
			$this->Session->setFlash(__('The Contraceptive could not be deleted. Please, try again.'));
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
	  
		$options = array('conditions' => array('Contraceptive.' . $this->Contraceptive->primaryKey => $id));
		$data=$this->Contraceptive->find('first',$options);
		return $data;
	}    
        
                
                
}
