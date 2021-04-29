<?php
App::uses('AppController', 'Controller');
/**
 * Wards Controller
 *
 * @property Sector $Sector
 * @property PaginatorComponent $Paginator
 */
class WardsController extends AppController {

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
		$this->Ward->recursive = 0;
		$this->set('wards', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Ward->exists($id)) {
			throw new NotFoundException(__('Invalid Ward'));
		}
		$options = array('conditions' => array('Ward.' . $this->Ward->primaryKey => $id));
		$this->set('ward', $this->Ward->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Ward->create();
			if ($this->Ward->save($this->request->data)) {
				$this->Session->setFlash(__('The Ward has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Ward could not be saved. Please, try again.'));
			}
		}
                $cities = $this->Ward->City->find('list',array('order'=>array('name'=>'asc')));
		$blocks = $this->Ward->Block->find('list',array('order'=>array('name'=>'asc')));
                $panchayats = $this->Ward->Panchayat->find('list',array('order'=>array('name'=>'asc')));
                $villages = $this->Ward->Village->find('list',array('order'=>array('name'=>'asc')));
		$this->set(compact('cities'));
		$this->set(compact('blocks'));
                $this->set(compact('panchayats'));
                $this->set(compact('villages'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Ward->exists($id)) {
			throw new NotFoundException(__('Invalid Ward'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Ward->save($this->request->data)) {
				$this->Session->setFlash(__('The Ward has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Ward could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Ward.' . $this->Ward->primaryKey => $id));
			$this->request->data = $this->Ward->find('first', $options);
		}
                $cities = $this->Ward->City->find('list',array('order'=>array('name'=>'asc')));
		$blocks = $this->Ward->Block->find('list',array('order'=>array('name'=>'asc')));
                $panchayats = $this->Ward->Panchayat->find('list',array('order'=>array('name'=>'asc')));
                $villages = $this->Ward->Village->find('list',array('order'=>array('name'=>'asc')));
		$this->set(compact('cities'));
		$this->set(compact('blocks'));
                $this->set(compact('panchayats'));
                $this->set(compact('villages'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Ward->id = $id;
		if (!$this->Ward->exists()) {
			throw new NotFoundException(__('Invalid Ward'));
		}
		//$this->request->onlyAllow('post', 'delete');
		if ($this->Ward->delete()) {
			$this->Session->setFlash(__('The Ward has been deleted.'));
		} else {
			$this->Session->setFlash(__('The Ward could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
        
        public function getwards($blockid) {
	    $this->layout='ajax';
        $this->autoRender = false;
	    $data='<option value="1">All Ward</option>';
	    //$subcatlist=$this->Project->find('list',array('conditions'=>array('builder_id'=>$builderid),array('order'=>array('name'=>'asc'))));
	      $subcatlist=$this->Ward->find('list',array('conditions'=>array('village_id'=>$blockid),'order' => array('name'=>'asc')));
	     
	     
	     
	     
	     
	
		
		foreach($subcatlist as $key=>$value){ $data.='<option value="'.$key.'">'.$value.'</option>';}
		return $data;
	}
        
        
                }
