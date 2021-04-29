<?php
App::uses('AppController', 'Controller');
/**
 * subcategorys Controller
 *
 * @property City $City
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class SubcategorysController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
	//var  $uses = array('Subcategory','Financial');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Paginator->settings = array('Subcategory' => array('limit' =>10,'order' => array('name' => 'asc')));
		$this->Subcategory->recursive = 0;
		$this->set('subcategorys', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Subcategory->exists($id)) {
			throw new NotFoundException(__('Invalid Subcategory'));
		}
		$options = array('conditions' => array('Subcategory.' . $this->Subcategory->primaryKey => $id));
		$this->set('subcategory', $this->Subcategory->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Subcategory->create();
                        //print_r($this->request->data);
                           // die();
			if ($this->Subcategory->save($this->request->data)) {
                            
                            
				$this->Session->setFlash(__('The Financial Subcategory has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Financial Subcategory could not be saved. Please, try again.'));
			}
		}
		$financials = $this->Subcategory->Financial->find('list');
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
		if (!$this->Subcategory->exists($id)) {
			throw new NotFoundException(__('Invalid Subcategory'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Subcategory->save($this->request->data)) {
				$this->Session->setFlash(__('The Subcategory has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Financial category could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Subcategory.' . $this->Subcategory->primaryKey => $id));
			$this->request->data = $this->Subcategory->find('first', $options);
		}
		$financials = $this->Subcategory->Financial->find('list');
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
		$this->Subcategory->id = $id;
		if (!$this->Subcategory->exists()) {
			throw new NotFoundException(__('Invalid block'));
		}
		//$this->request->allowMethod('post', 'delete');
		if ($this->Subcategory->delete()) {
			$this->Session->setFlash(__('The Subcategory has been deleted.'));
		} else {
			$this->Session->setFlash(__('The Subcategory could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
        
        public function getsubcat($stateid) {
	    $this->layout='ajax';
        $this->autoRender = false;
	    $data='<option value="">Select Subcategory</option>';
		$subcatlist=$this->Subcategory->find('list',array("conditions"=>array('cat_id'=>$stateid)));
		foreach($subcatlist as $key=>$value){ $data.='<option value="'.$key.'">'.$value.'</option>';}
		return $data;
	}
                
                
}
