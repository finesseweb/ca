<?php
App::uses('AppController', 'Controller');
/**
 * PropertyTypes Controller
 *
 * @property PropertyType $PropertyType
 * @property PaginatorComponent $Paginator
 */
class NgonamesController  extends AppController {

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
		$this->Ngoname->recursive = 0;
		$this->set('ngonames', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Ngoname->exists($id)) {
			throw new NotFoundException(__('Invalid Ngoname '));
		}
		$options = array('conditions' => array('Ngoname.' . $this->Ngoname->primaryKey => $id));
		$this->set('designation', $this->Ngoname->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Ngoname->create();
			if ($this->Ngoname->save($this->request->data)) {
				$this->Session->setFlash(__('The Ngoname  has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Ngoname  could not be saved. Please, try again.'));
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
		if (!$this->Ngoname->exists($id)) {
			throw new NotFoundException(__('Invalid property type'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Ngoname->save($this->request->data)) {
				$this->Session->setFlash(__('The Ngoname  has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Ngoname  could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Ngoname.' . $this->Ngoname->primaryKey => $id));
			$this->request->data = $this->Ngoname->find('first', $options);
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
		$this->Ngoname->id = $id;
		if (!$this->Ngoname->exists()) {
			throw new NotFoundException(__('Invalid property type'));
		}
		//$this->request->onlyAllow('post', 'delete');
		if ($this->Ngoname->delete()) {
			$this->Session->setFlash(__('The Ngoname  has been deleted.'));
		} else {
			$this->Session->setFlash(__('The Ngoname  could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
