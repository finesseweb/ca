<?php
App::uses('AppController', 'Controller');
/**
 * CloseReasons Controller
 *
 * @property CloseReason $CloseReason
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class CloseReasonsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->CloseReason->recursive = 0;
		$this->set('closeReasons', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->CloseReason->exists($id)) {
			throw new NotFoundException(__('Invalid close reason'));
		}
		$options = array('conditions' => array('CloseReason.' . $this->CloseReason->primaryKey => $id));
		$this->set('closeReason', $this->CloseReason->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->CloseReason->create();
			if ($this->CloseReason->save($this->request->data)) {
				$this->Session->setFlash(__('The close reason has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The close reason could not be saved. Please, try again.'));
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
		if (!$this->CloseReason->exists($id)) {
			throw new NotFoundException(__('Invalid close reason'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->CloseReason->save($this->request->data)) {
				$this->Session->setFlash(__('The close reason has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The close reason could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('CloseReason.' . $this->CloseReason->primaryKey => $id));
			$this->request->data = $this->CloseReason->find('first', $options);
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
		$this->CloseReason->id = $id;
		if (!$this->CloseReason->exists()) {
			throw new NotFoundException(__('Invalid close reason'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->CloseReason->delete()) {
			$this->Session->setFlash(__('The close reason has been deleted.'));
		} else {
			$this->Session->setFlash(__('The close reason could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
