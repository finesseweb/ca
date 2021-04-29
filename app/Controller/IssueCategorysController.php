<?php
App::uses('AppController', 'Controller');
/**
 * Cities Controller
 *
 * @property City $City
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class IssueCategorysController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
	var  $uses = array('IssueCategory');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Paginator->settings = array('IssueCategory' => array('limit' =>10,'order' => array('name' => 'asc')));
		$this->IssueCategory->recursive = 0;
		$this->set('issuecategorys', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->IssueCategory->exists($id)) {
			throw new NotFoundException(__('Invalid Issue Category'));
		}
		$options = array('conditions' => array('IssueCategory.' . $this->IssueCategory->primaryKey => $id));
		$this->set('issueCategory', $this->IssueCategory->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->IssueCategory->create();
			if ($this->IssueCategory->save($this->request->data)) {
				$this->Session->setFlash(__('The Issue Category has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Issue Category could not be saved. Please, try again.'));
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
		if (!$this->IssueCategory->exists($id)) {
			throw new NotFoundException(__('Invalid Issue Category'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->IssueCategory->save($this->request->data)) {
				$this->Session->setFlash(__('The Issue Category has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Issue category could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('IssueCategory.' . $this->IssueCategory->primaryKey => $id));
			$this->request->data = $this->IssueCategory->find('first', $options);
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
		$this->IssueCategory->id = $id;
		if (!$this->IssueCategory->exists()) {
			throw new NotFoundException(__('Invalid category'));
		}
		//$this->request->allowMethod('post', 'delete');
		if ($this->IssueCategory->delete()) {
			$this->Session->setFlash(__('The category has been deleted.'));
		} else {
			$this->Session->setFlash(__('The category could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
        
        public function getissue() {
	    $this->layout='ajax';
        $this->autoRender = false;
	    $data='<option value="">--Select--</option>';
		$subcatlist=$this->IssueCategory->find('list');
		foreach($subcatlist as $key=>$value){ $data.='<option value="'.$key.'">'.$value.'</option>';}
		return $data;
	}
                
                
}
