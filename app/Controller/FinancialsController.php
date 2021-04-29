<?php
App::uses('AppController', 'Controller');
/**
 * Cities Controller
 *
 * @property City $City
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class FinancialsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
	var  $uses = array('Financial','Overhead');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Paginator->settings = array('Financial' => array('limit' =>10,'order' => array('name' => 'asc')));
		$this->Financial->recursive = 0;
		$this->set('financials', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Financial->exists($id)) {
			throw new NotFoundException(__('Invalid city'));
		}
		$options = array('conditions' => array('Financial.' . $this->Financial->primaryKey => $id));
		$this->set('financial', $this->Financial->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Financial->create();
			if ($this->Financial->save($this->request->data)) {
				$this->Session->setFlash(__('The Financial has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Financial could not be saved. Please, try again.'));
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
		if (!$this->Financial->exists($id)) {
			throw new NotFoundException(__('Invalid city'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Financial->save($this->request->data)) {
				$this->Session->setFlash(__('The Financial has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Financial category could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Financial.' . $this->Financial->primaryKey => $id));
			$this->request->data = $this->Financial->find('first', $options);
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
		$this->Financial->id = $id;
		if (!$this->Financial->exists()) {
			throw new NotFoundException(__('Invalid category'));
		}
		//$this->request->allowMethod('post', 'delete');
		if ($this->Financial->delete()) {
			$this->Session->setFlash(__('The category has been deleted.'));
		} else {
			$this->Session->setFlash(__('The category could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
        
        public function getblocks($stateid) {
	    $this->layout='ajax';
        $this->autoRender = false;
	    $data='<option value="">Select Block</option>';
		$subcatlist=$this->Financial->find('list',array("conditions"=>array('city_id'=>$stateid)));
		foreach($subcatlist as $key=>$value){ $data.='<option value="'.$key.'">'.$value.'</option>';}
		return $data;
	}
       public function getcat($stateid) {
	    $this->layout='ajax';
        $this->autoRender = false;
	    $data='<option value="">--Select--</option>';
		$subcatlist=$this->Financial->find('list');
		foreach($subcatlist as $key=>$value){ $data.='<option value="'.$key.'">'.$value.'</option>';}
		return $data;
	}  
        
        public function getcate($stateid) {
	    $this->layout='ajax';
            $this->autoRender = false;
            $data='';
	      $overhead=$this->Overhead->find('first',array("conditions"=>array('Overhead.organization'=>$stateid)));
                $p= $overhead['Overhead']['category'];
             
		$subcatlist=$this->Financial->find('list',array('conditions'=>array('Financial.id IN'=>explode(',',$overhead['Overhead']['category']),'Financial.status'=>'active')));
		  // print_r($subcatlist);
                foreach($subcatlist as $key=>$value){ $data.='<option value="'.$key.'" selected>'.$value.'</option>';}
		return $data;
	}  
        
          public function getcatename($stateid) {
	    $this->layout='ajax';
            $this->autoRender = false;
            $data='';
	      $overhead=$this->Overhead->find('first',array("conditions"=>array('Overhead.organization'=>$stateid)));
          if(!empty($overhead)){
		$subcatlist=$this->Financial->find('list',array('conditions'=>array('Financial.id IN'=>explode(',',$overhead['Overhead']['category']),'Financial.status'=>'active')));
           // print_r($subcatlist);
                foreach($subcatlist as $key=>$value){ $data.=$value.',';}
		return $data;
                 }
	}  
                
}
