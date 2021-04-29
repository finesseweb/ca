<?php
App::uses('AppController', 'Controller');
/**
 * Cities Controller
 *
 * @property City $City
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class PanchayatsController extends AppController {

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
               if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchBuilderId=trim($this->request->query['panchayat']); 
		$condition['Panchayat.id']=$searchBuilderId;
		} 
            }
		$this->Paginator->settings = array('Panchayat' => array('limit' =>10,'order' => array('name' => 'asc'),'conditions'=>$condition));
		$this->Panchayat->recursive = 0;
		$this->set('panchayats', $this->Paginator->paginate());
                
                $panch=$this->Panchayat->find('list',array('order' =>array('name' => 'asc')));
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
		if (!$this->Panchayat->exists($id)) {
			throw new NotFoundException(__('Invalid city'));
		}
		$options = array('conditions' => array('Panchayat.' . $this->Panchayat->primaryKey => $id));
		$this->set('panchayat', $this->Panchayat->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Panchayat->create();
			if ($this->Panchayat->save($this->request->data)) {
				$this->Session->setFlash(__('The Panchayat has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Panchayat could not be saved. Please, try again.'));
			}
		}
		$cities = $this->Panchayat->City->find('list',array('order'=>array('name'=>'asc')));
		$blocks = $this->Panchayat->Block->find('list',array('order'=>array('name'=>'asc')));
		$this->set(compact('cities'));
		$this->set(compact('blocks'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Panchayat->exists($id)) {
			throw new NotFoundException(__('Invalid city'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Panchayat->save($this->request->data)) {
				$this->Session->setFlash(__('The Panchayat has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Panchayat could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Panchayat.' . $this->Panchayat->primaryKey => $id));
			$this->request->data = $this->Panchayat->find('first', $options);
		}
		$blocks = $this->Panchayat->Block->find('list');
                $cities = $this->Panchayat->City->find('list',array('order'=>array('name'=>'asc')));
		$this->set(compact('blocks'));
                $this->set(compact('cities'));  
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Panchayat->id = $id;
		if (!$this->Panchayat->exists()) {
			throw new NotFoundException(__('Invalid Panchayat'));
		}
		//$this->request->allowMethod('post', 'delete');
		if ($this->Panchayat->delete()) {
			$this->Session->setFlash(__('The Panchayat has been deleted.'));
		} else {
			$this->Session->setFlash(__('The Panchayat could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
        
        public function getpanchayats($cityid) {
	    $this->layout='ajax';
        $this->autoRender = false;
	    $data='<option value="0">All Panchayats</option>';
	    //$subcatlist=$this->Project->find('list',array('conditions'=>array('builder_id'=>$builderid),array('order'=>array('name'=>'asc'))));
	      $subcatlist=$this->Panchayat->find('list',array('conditions'=>array('block_id'=>$cityid),'order' => array('name'=>'asc')));
	     foreach($subcatlist as $key=>$value){ $data.='<option value="'.$key.'">'.$value.'</option>';}
		return $data;
	}
        
        public function getallpanchayats() {
	    $this->layout='ajax';
        $this->autoRender = false;
         $c=$this->params->query['c'];
	 $p=$this->params->query['p'];
	    $data='';
	    //$subcatlist=$this->Project->find('list',array('conditions'=>array('builder_id'=>$builderid),array('order'=>array('name'=>'asc'))));
	      $subcatlist=$this->Panchayat->find('list',array('conditions'=>array('block_id'=>$c,'Panchayat.id IN'=>explode(',',$p)),'order' => array('name'=>'asc')));
	     foreach($subcatlist as $key=>$value){ $data.='<option value="'.$key.'" checked>'.$value.'</option>';}
		return $data;
	}
        
         public function gettitle($id) {
	  
		$options = array('conditions' => array('Panchayat.' . $this->Panchayat->primaryKey => $id));
		$data=$this->Panchayat->find('first',$options);
		return $data;
	}  
}
