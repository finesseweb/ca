<?php
App::uses('AppController', 'Controller');
/**
 * Menus Controller
 *
 * @property Menu $Menu
 * @property PaginatorComponent $Paginator
 */
class MenusController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
    var  $uses = array('Menu','Menuheader','User');
/**
 * index method
 *
 * @return void
 */
	public function index() {
             $this->Paginator->settings = array('Menu' => array('limit' =>10,'order' => array('name' => 'asc'),'conditions' => array('Menu.status' => 'active')));
             // $this->Paginator->settings = array('conditions' => array('Menu.status' => 'active'));
		$this->Menu->recursive = 0;
		$this->set('menus', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Menu->exists($id)) {
			throw new NotFoundException(__('Invalid menu'));
		}
		$options = array('conditions' => array('Menu.' . $this->Menu->primaryKey => $id));
		$this->set('menu', $this->Menu->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Menu->create();
			if ($this->Menu->save($this->request->data)) {
				$this->Session->setFlash(__('The menu has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The menu could not be saved. Please, try again.'));
			}
		}
                $options = array('conditions' => array('status'=>'active'));
		$menuheaders = $this->Menu->Menuheader->find('list',$options);
		$this->set(compact('menuheaders'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Menu->exists($id)) {
			throw new NotFoundException(__('Invalid menu'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Menu->save($this->request->data)) {
				$this->Session->setFlash(__('The menu has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The menu could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Menu.' . $this->Menu->primaryKey => $id));
			$this->request->data = $this->Menu->find('first', $options);
		}
                $options = array('conditions' => array('status'=>'active'));
		$menuheaders = $this->Menu->Menuheader->find('list',$options);
		$this->set(compact('menuheaders'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Menu->id = $id;
		if (!$this->Menu->exists()) {
			throw new NotFoundException(__('Invalid menu'));
		}
		//$this->request->onlyAllow('post', 'delete');
		if ($this->Menu->delete()) {
			$this->Session->setFlash(__('The menu has been deleted.'));
		} else {
			$this->Session->setFlash(__('The menu could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	
	public function menu($pid) { 
	
		$result=$this->Menu->query("select m.name,m.action,m.controller from menus as m where m.status='active' and m.menuheader_id='$pid' order by m.navid desc");
		return $result;
	}
	
	public function checkMenu($cont,$act) { 
		$result=$this->Menu->query("select id,action from menus where 1 and controller='$cont'");
		if(!empty($result) and in_array($act,array('index','view','delete','edit'))){ return false; } else{ return true; }
	}
	
	public function assignMenu() {
		$menuheader='';
		$menuheader=$this->Menuheader->query("select name,action,id,controller,menuheader_id from menus as headers where 1 group by controller");
		$this->set("menuheaders",$menuheader);
		}
	
	
	}
