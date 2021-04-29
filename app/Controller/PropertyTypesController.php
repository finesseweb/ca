<?php
App::uses('AppController', 'Controller');
/**
 * PropertyTypes Controller
 *
 * @property PropertyType $PropertyType
 * @property PaginatorComponent $Paginator
 */
class PropertyTypesController extends AppController {

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
		$this->PropertyType->recursive = 0;
		$this->set('propertyTypes', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->PropertyType->exists($id)) {
			throw new NotFoundException(__('Invalid property type'));
		}
		$options = array('conditions' => array('PropertyType.' . $this->PropertyType->primaryKey => $id));
		$this->set('propertyType', $this->PropertyType->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->PropertyType->create();
			if ($this->PropertyType->save($this->request->data)) {
				$this->Session->setFlash(__('The property type has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The property type could not be saved. Please, try again.'));
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
		if (!$this->PropertyType->exists($id)) {
			throw new NotFoundException(__('Invalid property type'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->PropertyType->save($this->request->data)) {
				$this->Session->setFlash(__('The property type has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The property type could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('PropertyType.' . $this->PropertyType->primaryKey => $id));
			$this->request->data = $this->PropertyType->find('first', $options);
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
		$this->PropertyType->id = $id;
		if (!$this->PropertyType->exists()) {
			throw new NotFoundException(__('Invalid property type'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->PropertyType->delete()) {
			$this->Session->setFlash(__('The property type has been deleted.'));
		} else {
			$this->Session->setFlash(__('The property type could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
