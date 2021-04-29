<?php
App::uses('AppController', 'Controller');
/**
 * BrokerCompanies Controller
 *
 * @property BrokerCompany $BrokerCompany
 * @property PaginatorComponent $Paginator
 */
class BrokerCompaniesController extends AppController {

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
		$this->BrokerCompany->recursive = 0;
		$this->set('brokerCompanies', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->BrokerCompany->exists($id)) {
			throw new NotFoundException(__('Invalid broker company'));
		}
		$options = array('conditions' => array('BrokerCompany.' . $this->BrokerCompany->primaryKey => $id));
		$this->set('brokerCompany', $this->BrokerCompany->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->BrokerCompany->create();
			if ($this->BrokerCompany->save($this->request->data)) {
				$this->Session->setFlash(__('The broker company has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The broker company could not be saved. Please, try again.'));
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
		if (!$this->BrokerCompany->exists($id)) {
			throw new NotFoundException(__('Invalid broker company'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->BrokerCompany->save($this->request->data)) {
				$this->Session->setFlash(__('The broker company has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The broker company could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('BrokerCompany.' . $this->BrokerCompany->primaryKey => $id));
			$this->request->data = $this->BrokerCompany->find('first', $options);
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
		$this->BrokerCompany->id = $id;
		if (!$this->BrokerCompany->exists()) {
			throw new NotFoundException(__('Invalid broker company'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->BrokerCompany->delete()) {
			$this->Session->setFlash(__('The broker company has been deleted.'));
		} else {
			$this->Session->setFlash(__('The broker company could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
