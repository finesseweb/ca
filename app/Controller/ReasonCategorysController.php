<?php
App::uses('AppController', 'Controller');
/**
 * Cities Controller
 *
 * @property City $City
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ReasonCategorysController  extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
	//var  $uses = array('ReasonCategory');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Paginator->settings = array('ReasonCategory' => array('limit' =>10,'order' => array('name' => 'asc')));
		$this->ReasonCategory->recursive = 0;
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
		if (!$this->ReasonCategory->exists($id)) {
			throw new NotFoundException(__('Invalid city'));
		}
		$options = array('conditions' => array('ReasonCategory.' . $this->ReasonCategory->primaryKey => $id));
		$this->set('reason', $this->ReasonCategory->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ReasonCategory->create();
			if ($this->ReasonCategory->save($this->request->data)) {
				$this->Session->setFlash(__('The ReasonCategory has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ReasonCategory could not be saved. Please, try again.'));
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
		if (!$this->ReasonCategory->exists($id)) {
			throw new NotFoundException(__('Invalid city'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ReasonCategory->save($this->request->data)) {
				$this->Session->setFlash(__('The ReasonCategory has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ReasonCategory category could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ReasonCategory.' . $this->ReasonCategory->primaryKey => $id));
			$this->request->data = $this->ReasonCategory->find('first', $options);
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
		$this->ReasonCategory->id = $id;
		if (!$this->ReasonCategory->exists()) {
			throw new NotFoundException(__('Invalid category'));
		}
		//$this->request->allowMethod('post', 'delete');
		if ($this->ReasonCategory->delete()) {
			$this->Session->setFlash(__('The category has been deleted.'));
		} else {
			$this->Session->setFlash(__('The category could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
        
        public function getblocks($stateid) {
	    $this->layout='ajax';
        $this->autoRender = false;
	    $data='<option value="">Select Block</option>';
		$subcatlist=$this->ReasonCategory->find('list',array("conditions"=>array('city_id'=>$stateid)));
		foreach($subcatlist as $key=>$value){ $data.='<option value="'.$key.'">'.$value.'</option>';}
		return $data;
	}
                
                
}
