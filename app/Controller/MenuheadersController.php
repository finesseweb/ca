<?php
App::uses('AppController', 'Controller');
/**
 * Menuheaders Controller
 *
 * @property Menuheader $Menuheader
 * @property PaginatorComponent $Paginator
 */
class MenuheadersController extends AppController {

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
                $this->Paginator->settings = array('Menuheader' => array('limit' =>10,'order' => array('name' => 'asc'),'conditions'=>array('status'=>'active')));
		$this->Menuheader->recursive = 0;
		$this->set('menuheaders', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Menuheader->exists($id)) {
			throw new NotFoundException(__('Invalid menuheader'));
		}
		$options = array('conditions' => array('Menuheader.' . $this->Menuheader->primaryKey => $id));
		$this->set('menuheader', $this->Menuheader->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Menuheader->create();
			if ($this->Menuheader->save($this->request->data)) {
				$this->Session->setFlash(__('The menuheader has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The menuheader could not be saved. Please, try again.'));
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
		if (!$this->Menuheader->exists($id)) {
			throw new NotFoundException(__('Invalid menuheader'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Menuheader->save($this->request->data)) {
				$this->Session->setFlash(__('The menuheader has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The menuheader could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Menuheader.' . $this->Menuheader->primaryKey => $id));
			$this->request->data = $this->Menuheader->find('first', $options);
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
		$this->Menuheader->id = $id;
		if (!$this->Menuheader->exists()) {
			throw new NotFoundException(__('Invalid menuheader'));
		}
		//$this->request->onlyAllow('post', 'delete');
		if ($this->Menuheader->delete()) {
			$this->Session->setFlash(__('The menuheader has been deleted.'));
		} else {
			$this->Session->setFlash(__('The menuheader could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	
	
	public function menu() { 
		$result=$this->Menuheader->query("select mh.name,mh.action,mh.id from menuheaders as mh where mh.status='active' order by mh.navid desc");
		return $result;
	}
	}
