<?php
App::uses('AppController', 'Controller');
/**
 * Cities Controller
 *
 * @property City $City
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class OverheadsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
	var  $uses = array('Overhead','Ngo','Financial','Period');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Paginator->settings = array('Overhead' => array('limit' =>10,'order' => array('name' => 'asc')));
		$this->Overhead->recursive = 0;
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
		if (!$this->Overhead->exists($id)) {
			throw new NotFoundException(__('Invalid city'));
		}
		$options = array('conditions' => array('Overhead.' . $this->Overhead->primaryKey => $id));
		$this->set('financial', $this->Overhead->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Overhead->create();
                            $organization =  $this->request->data['Overhead']['organization'];
                            $period_id =  $this->request->data['Overhead']['period_id'];
                            $remarks =  $this->request->data['Overhead']['remarks'];
                            $cat_id = implode(',',$this->request->data['Overhead']['category']);
                            $data = array( 
                               	'organization'=>$organization,
                                'period_id'=>$period_id,
                                'category'=>$cat_id,
                                'remarks'=>$remarks,
                            );
                             $save=$this->Overhead->saveAll($data);
                                                   
			if ($save) {
				$this->Session->setFlash(__('The Overhead has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Overhead could not be saved. Please, try again.'));
			}
		}
		 $ngo=$this->Ngo->find('list');
                 $cats=$this->Financial->find('list',array('order'=>array('name'=>'asc')));
                 $period=$this->Period->query("select * from periods");
                 $this->set(compact('ngo','cats','period'));
	
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Overhead->exists($id)) {
			throw new NotFoundException(__('Invalid city'));
		}
		if ($this->request->is(array('post', 'put'))) {
                    
                           $organization =  $this->request->data['Overhead']['organization'];
                            $period_id =  $this->request->data['Overhead']['period_id'];
                            $remarks =  $this->request->data['Overhead']['remarks'];
                            $cat_id = implode(',',$this->request->data['Overhead']['category']);
                            $data = array( 
                               	'organization'=>$organization,
                                'period_id'=>$period_id,
                                'category'=>$cat_id,
                                'remarks'=>$remarks,
                                'id'=>$id
                            );
                             $save=$this->Overhead->saveAll($data);
                               
                    
			if ($save) {
				$this->Session->setFlash(__('The Overhead has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Overhead category could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Overhead.' . $this->Overhead->primaryKey => $id));
			$this->request->data = $this->Overhead->find('first', $options);
		}
		 $ngo=$this->Ngo->find('list');
                 $cats=$this->Financial->find('list',array('order'=>array('name'=>'asc')));
                 $period=$this->Period->query("select * from periods");
                 $this->set(compact('ngo','cats','period'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Overhead->id = $id;
		if (!$this->Overhead->exists()) {
			throw new NotFoundException(__('Invalid category'));
		}
		//$this->request->allowMethod('post', 'delete');
		if ($this->Overhead->delete()) {
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
		$subcatlist=$this->Overhead->find('list',array("conditions"=>array('city_id'=>$stateid)));
		foreach($subcatlist as $key=>$value){ $data.='<option value="'.$key.'">'.$value.'</option>';}
		return $data;
	}
       public function getcat($stateid) {
	    $this->layout='ajax';
        $this->autoRender = false;
	    $data='<option value="">--Select--</option>';
		$subcatlist=$this->Overhead->find('list');
		foreach($subcatlist as $key=>$value){ $data.='<option value="'.$key.'">'.$value.'</option>';}
		return $data;
	}         
                
}
