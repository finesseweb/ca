<?php
App::uses('AppController', 'Controller');
/**
 * Builders Controller
 *
 * @property Builder $Builder
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class BuildersController extends AppController {

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
		$this->Builder->recursive = 0;
		$this->set('builders', $this->Paginator->paginate());
		//$log = $this->Builder->getDataSource()->getLog(false, false);
        //debug($log['log']['1']['query']); 
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Builder->exists($id)) {
			throw new NotFoundException(__('Invalid builder'));
		}
		$options = array('conditions' => array('Builder.' . $this->Builder->primaryKey => $id));
		$this->set('builder', $this->Builder->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Builder->create();
			if ($this->Builder->save($this->request->data)) {
				$this->Session->setFlash(__('The builder has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The builder could not be saved. Please, try again.'));
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
		if (!$this->Builder->exists($id)) {
			throw new NotFoundException(__('Invalid builder'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Builder->save($this->request->data)) {
				$this->Session->setFlash(__('The builder has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The builder could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Builder.' . $this->Builder->primaryKey => $id));
			$this->request->data = $this->Builder->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	/*public function delete($id = null) {
		$this->Builder->id = $id;
		if (!$this->Builder->exists()) {
			throw new NotFoundException(__('Invalid builder'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Builder->delete()) {
			$this->Session->setFlash(__('The builder has been deleted.'));
		} else {
			$this->Session->setFlash(__('The builder could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}*/
	
	public function delete($id = null) {
		
			$this->Session->setFlash(__('The project could not be deleted.'));
		return $this->redirect(array('action' => 'index'));
	}
	
	
	public function getBuilder($id=null) {
	$builder=$this->Builder->find('first',array('conditions'=>array('Builder.id'=>$id),'order'=>'Builder.name ASC'));
	return  $builder;
    }
}
