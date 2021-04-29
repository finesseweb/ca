<?php
App::uses('AppController', 'Controller');
/**
 * LeadSources Controller
 *
 * @property LeadSource $LeadSource
 * @property PaginatorComponent $Paginator
 */
class LeadSourcesController extends AppController {

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
		$this->LeadSource->recursive = 0;
		$this->set('leadSources', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->LeadSource->exists($id)) {
			throw new NotFoundException(__('Invalid lead source'));
		}
		$options = array('conditions' => array('LeadSource.' . $this->LeadSource->primaryKey => $id));
		$this->set('leadSource', $this->LeadSource->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->LeadSource->create();
			if ($this->LeadSource->save($this->request->data)) {
				$this->Session->setFlash(__('The lead source has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The lead source could not be saved. Please, try again.'));
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
		if (!$this->LeadSource->exists($id)) {
			throw new NotFoundException(__('Invalid lead source'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->LeadSource->save($this->request->data)) {
				$this->Session->setFlash(__('The lead source has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The lead source could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('LeadSource.' . $this->LeadSource->primaryKey => $id));
			$this->request->data = $this->LeadSource->find('first', $options);
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
		$this->LeadSource->id = $id;
		if (!$this->LeadSource->exists()) {
			throw new NotFoundException(__('Invalid lead source'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->LeadSource->delete()) {
			$this->Session->setFlash(__('The lead source has been deleted.'));
		} else {
			$this->Session->setFlash(__('The lead source could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	
	  
	
	
	}
