<?php
App::uses('AppController', 'Controller');
/**
 * ResaleBookings Controller
 *
 * @property ResaleBooking $ResaleBooking
 * @property PaginatorComponent $Paginator
 */
class ResaleBookingsController extends AppController {

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
		$this->ResaleBooking->recursive = 0;
		$this->set('resaleBookings', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ResaleBooking->exists($id)) {
			throw new NotFoundException(__('Invalid resale booking'));
		}
		$options = array('conditions' => array('ResaleBooking.' . $this->ResaleBooking->primaryKey => $id));
		$this->set('resaleBooking', $this->ResaleBooking->find('first', $options));
		$this->layout='ajax';
	}
	
	public function report($id = null) {
		if (!$this->ResaleBooking->exists($id)) {
			throw new NotFoundException(__('Invalid resale booking'));
		}
		$options = array('conditions' => array('ResaleBooking.' . $this->ResaleBooking->primaryKey => $id));
		$this->set('resaleBooking', $this->ResaleBooking->find('first', $options));
		$this->layout='sub-default';
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ResaleBooking->create();
			if ($this->ResaleBooking->save($this->request->data)) {
				$this->Session->setFlash(__('The resale booking has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The resale booking could not be saved. Please, try again.'));
			}
		}
		$builders = $this->ResaleBooking->Builder->find('list');
		$projects = $this->ResaleBooking->Project->find('list');
		$locations = $this->ResaleBooking->Location->find('list');
		$users = $this->ResaleBooking->User->find('list',array('fields'=>array('id','username')));
		$this->set(compact('builders', 'projects', 'locations', 'users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->ResaleBooking->exists($id)) {
			throw new NotFoundException(__('Invalid resale booking'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ResaleBooking->save($this->request->data)) {
				$this->Session->setFlash(__('The resale booking has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The resale booking could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ResaleBooking.' . $this->ResaleBooking->primaryKey => $id));
			$this->request->data = $this->ResaleBooking->find('first', $options);
		}
		$builders = $this->ResaleBooking->Builder->find('list');
		$projects = $this->ResaleBooking->Project->find('list');
		$locations = $this->ResaleBooking->Location->find('list');
		$users = $this->ResaleBooking->User->find('list',array('fields'=>array('id','username')));
		$this->set(compact('builders', 'projects', 'locations', 'users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->ResaleBooking->id = $id;
		if (!$this->ResaleBooking->exists()) {
			throw new NotFoundException(__('Invalid resale booking'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ResaleBooking->delete()) {
			$this->Session->setFlash(__('The resale booking has been deleted.'));
		} else {
			$this->Session->setFlash(__('The resale booking could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
