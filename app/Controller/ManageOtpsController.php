<?php
App::uses('AppController', 'Controller');
/**
 * ManageOtps Controller
 *
 * @property ManageOtp $ManageOtp
 * @property PaginatorComponent $Paginator
 */
class ManageOtpsController extends AppController {

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
		$this->Paginator->settings = array('ManageOtp' => array('limit' =>20,'order' => array('id' => 'desc')));
		$this->ManageOtp->recursive = 0;
		$this->set('manageOtps', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ManageOtp->exists($id)) {
			throw new NotFoundException(__('Invalid manage otp'));
		}
		$options = array('conditions' => array('ManageOtp.' . $this->ManageOtp->primaryKey => $id));
		$this->set('manageOtp', $this->ManageOtp->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ManageOtp->create();
			if ($this->ManageOtp->save($this->request->data)) {
				$this->Session->setFlash(__('The manage otp has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The manage otp could not be saved. Please, try again.'));
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
		if (!$this->ManageOtp->exists($id)) {
			throw new NotFoundException(__('Invalid manage otp'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ManageOtp->save($this->request->data)) {
				$this->Session->setFlash(__('The manage otp has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The manage otp could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ManageOtp.' . $this->ManageOtp->primaryKey => $id));
			$this->request->data = $this->ManageOtp->find('first', $options);
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
		$this->ManageOtp->id = $id;
		if (!$this->ManageOtp->exists()) {
			throw new NotFoundException(__('Invalid manage otp'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ManageOtp->delete()) {
			$this->Session->setFlash(__('The manage otp has been deleted.'));
		} else {
			$this->Session->setFlash(__('The manage otp could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
