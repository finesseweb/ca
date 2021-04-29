<?php
App::uses('AppController', 'Controller');
/**
 * CrmGroups Controller
 *
 * @property CrmGroup $CrmGroup
 * @property PaginatorComponent $Paginator
 */
class CrmGroupsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->CrmGroup->recursive = 0;
		$this->set('crmGroups', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->CrmGroup->exists($id)) {
			throw new NotFoundException(__('Invalid crm group'));
		}
		$options = array('conditions' => array('CrmGroup.' . $this->CrmGroup->primaryKey => $id));
		$this->set('crmGroup', $this->CrmGroup->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->CrmGroup->create();
			if ($this->CrmGroup->save($this->request->data)) {
				$this->Session->setFlash(__('The crm group has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The crm group could not be saved. Please, try again.'));
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
		if (!$this->CrmGroup->exists($id)) {
			throw new NotFoundException(__('Invalid crm group'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->CrmGroup->save($this->request->data)) {
				$this->Session->setFlash(__('The crm group has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The crm group could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('CrmGroup.' . $this->CrmGroup->primaryKey => $id));
			$this->request->data = $this->CrmGroup->find('first', $options);
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
		$this->CrmGroup->id = $id;
		if (!$this->CrmGroup->exists()) {
			throw new NotFoundException(__('Invalid crm group'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->CrmGroup->delete()) {
			$this->Session->setFlash(__('The crm group has been deleted.'));
		} else {
			$this->Session->setFlash(__('The crm group could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
