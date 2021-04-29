<?php
App::uses('AppController', 'Controller');
/**
 * Cities Controller
 *
 * @property City $City
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class VillagesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
       /// var  $uses = array('City','Block');

/**
 * index method
 *
 * @return void
 */
	public function index() {
            $condition='';$querySrting=''; $condition=array();
            if(isset($this->params->query['confirm'])) {
               if(isset($this->request->query['village']) and ($this->request->query['village']!=0) and ($this->request->query['village']!='')){$searchBuilderId=trim($this->request->query['village']); 
		$condition['Village.id']=$searchBuilderId;
		} 
            }
		$this->Paginator->settings = array('Village' => array('limit' =>10,'order' => array('name' => 'asc'),'conditions'=>$condition));
		$this->Village->recursive = 0;
		$this->set('villages', $this->Paginator->paginate());
                
                $panch=$this->Village->find('list',array('order' =>array('name' => 'asc')));
                $this->set(compact('panch'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Village->exists($id)) {
			throw new NotFoundException(__('Invalid Village'));
		}
		$options = array('conditions' => array('Village.' . $this->Village->primaryKey => $id));
		$this->set('village', $this->Village->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Village->create();
			if ($this->Village->save($this->request->data)) {
				$this->Session->setFlash(__('The Village has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Village could not be saved. Please, try again.'));
			}
		}
		$cities = $this->Village->City->find('list',array('order'=>array('name'=>'asc')));
		$blocks = $this->Village->Block->find('list',array('order'=>array('name'=>'asc')));
                $panchayats = $this->Village->Panchayat->find('list',array('order'=>array('name'=>'asc')));
		$this->set(compact('cities'));
		$this->set(compact('blocks'));
                $this->set(compact('panchayats'));
	
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Village->exists($id)) {
			throw new NotFoundException(__('Invalid Village'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Village->save($this->request->data)) {
				$this->Session->setFlash(__('The Village has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Village could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Village.' . $this->Village->primaryKey => $id));
			$this->request->data = $this->Village->find('first', $options);
		}
		$cities = $this->Village->City->find('list',array('order'=>array('name'=>'asc')));
		$blocks = $this->Village->Block->find('list',array('order'=>array('name'=>'asc')));
                $panchayats = $this->Village->Panchayat->find('list',array('order'=>array('name'=>'asc')));
		$this->set(compact('cities'));
		$this->set(compact('blocks'));
                $this->set(compact('panchayats'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Village->id = $id;
		if (!$this->Village->exists()) {
			throw new NotFoundException(__('Invalid Village'));
		}
		//$this->request->allowMethod('post', 'delete');
		if ($this->Village->delete()) {
			$this->Session->setFlash(__('The Village has been deleted.'));
		} else {
			$this->Session->setFlash(__('The Village could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
        
      
        
        public function getvillages($blockid) {
	    $this->layout='ajax';
        $this->autoRender = false;
	    $data='<option value="">All Village</option>';
	    //$subcatlist=$this->Project->find('list',array('conditions'=>array('builder_id'=>$builderid),array('order'=>array('name'=>'asc'))));
	      $subcatlist=$this->Village->find('list',array('conditions'=>array('panchayat_id'=>$blockid),'order' => array('name'=>'asc')));
	    
		foreach($subcatlist as $key=>$value){ $data.='<option value="'.$key.'">'.$value.'</option>';}
		return $data;
	}
}
