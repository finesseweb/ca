<?php
App::uses('AppController', 'Controller');
/**
 * subcategorys Controller
 *
 * @property City $City
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class IssueSubcategorysController extends AppController {

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
		$this->Paginator->settings = array('IssueSubcategory' => array('limit' =>10,'order' => array('name' => 'asc')));
		$this->IssueSubcategory->recursive = 0;
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
		if (!$this->IssueSubcategory->exists($id)) {
			throw new NotFoundException(__('Invalid city'));
		}
		$options = array('conditions' => array('IssueSubcategory.' . $this->IssueSubcategory->primaryKey => $id));
		$this->set('subcategory', $this->IssueSubcategory->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->IssueSubcategory->create();
                        //print_r($this->request->data);
                           // die();
			if ($this->IssueSubcategory->save($this->request->data)) {
                            
                            
				$this->Session->setFlash(__('The Financial Subcategory has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Financial Subcategory could not be saved. Please, try again.'));
			}
		}
		$financials = $this->IssueSubcategory->IssueCategory->find('list');
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
		if (!$this->IssueSubcategory->exists($id)) {
			throw new NotFoundException(__('Invalid city'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->IssueSubcategory->save($this->request->data)) {
				$this->Session->setFlash(__('The Issue Subcategory has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Issue Subcategorycould not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('IssueSubcategory.' . $this->IssueSubcategory->primaryKey => $id));
			$this->request->data = $this->IssueSubcategory->find('first', $options);
		}
		$financials = $this->IssueSubcategory->IssueCategory->find('list');
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
		$this->IssueSubcategory->id = $id;
		if (!$this->IssueSubcategory->exists()) {
			throw new NotFoundException(__('Invalid Issue Subcategory'));
		}
		//$this->request->allowMethod('post', 'delete');
		if ($this->IssueSubcategory->delete()) {
			$this->Session->setFlash(__('The Issue Subcategory has been deleted.'));
		} else {
			$this->Session->setFlash(__('The Issue Subcategory could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
        
        public function getsubcat() {
	    $this->layout='ajax';
        $this->autoRender = false;
	    $data='<option value="">--Select--</option>';
		$subcatlist=$this->IssueSubcategory->find('list');
		foreach($subcatlist as $key=>$value){ $data.='<option value="'.$key.'">'.$value.'</option>';}
		return $data;
	}
        public function fetchsubcat($stateid) {
	    $this->layout='ajax';
        $this->autoRender = false;
	    $data='<option value="">--Select--</option>';
		$subcatlist=$this->IssueSubcategory->find('list',array("conditions"=>array('cat_id'=>$stateid)));
		foreach($subcatlist as $key=>$value){ $data.='<option value="'.$key.'">'.$value.'</option>';}
		return $data;
	}
                
                
}
