<?php
App::uses('AppController', 'Controller');
/**
 * CrmUsers Controller
 *
 * @property Crmser $CrmUser
 * @property PaginatorComponent $Paginator
 */
class CrmUsersController extends AppController {

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
		$this->CrmUser->recursive = 0;
		$this->set('crmUsers', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->CrmUser->exists($id)) {
			throw new NotFoundException(__('Invalid crm user'));
		}
		$options = array('conditions' => array('CrmUser.' . $this->CrmUser->primaryKey => $id));
		$this->set('crmUser', $this->CrmUser->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->CrmUser->create();
			if ($this->CrmUser->save($this->request->data)) {
				$this->Session->setFlash(__('The crm user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The crm user could not be saved. Please, try again.'));
			}
		}
		$crmGroups = $this->CrmUser->CrmGroup->find('list');
		$this->set(compact('crmGroups'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->CrmUser->exists($id)) {
			throw new NotFoundException(__('Invalid crm user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->CrmUser->save($this->request->data)) {
				$this->Session->setFlash(__('The crm user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The crm user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('CrmUser.' . $this->CrmUser->primaryKey => $id));
			$this->request->data = $this->CrmUser->find('first', $options);
		}
		$crmGroups = $this->CrmUser->CrmGroup->find('list');
		$this->set(compact('crmGroups'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->CrmUser->id = $id;
		if (!$this->CrmUser->exists()) {
			throw new NotFoundException(__('Invalid crm user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->CrmUser->delete()) {
			$this->Session->setFlash(__('The crm user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The crm user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	public function getUser($groupid) {
	    //$this->layout='ajax';
        $this->autoRender = false;
	    $data='<option value="">SELECT USER</option>';
		$subcatlist=$this->CrmUser->query('select name,userid from hcohoney_users where hcohoney_group_id='.$groupid);
		foreach($subcatlist as $key=>$value){ $data.='<option value="'.$value['hcohoney_users']['userid'].'">'.$value['hcohoney_users']['name'].'</option>';}
		return $data;
	}
	
	
	}
