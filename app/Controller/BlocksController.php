<?php
App::uses('AppController', 'Controller');
/**
 * Cities Controller
 *
 * @property City $City
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class BlocksController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
       var  $uses = array('Block','Ngo');
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Paginator->settings = array('Block' => array('limit' =>10,'order' => array('name' => 'asc')));
		$this->Block->recursive = 0;
		$this->set('blocks', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Block->exists($id)) {
			throw new NotFoundException(__('Invalid city'));
		}
		$options = array('conditions' => array('Block.' . $this->Block->primaryKey => $id));
		$this->set('block', $this->Block->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Block->create();
			if ($this->Block->save($this->request->data)) {
				$this->Session->setFlash(__('The Block has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Block could not be saved. Please, try again.'));
			}
		}
		$cities = $this->Block->City->find('list');
		$this->set(compact('cities'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Block->exists($id)) {
			throw new NotFoundException(__('Invalid city'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Block->save($this->request->data)) {
				$this->Session->setFlash(__('The city has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The city could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Block.' . $this->Block->primaryKey => $id));
			$this->request->data = $this->Block->find('first', $options);
		}
		$cities = $this->Block->City->find('list');
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
		$this->Block->id = $id;
		if (!$this->Block->exists()) {
			throw new NotFoundException(__('Invalid block'));
		}
		//$this->request->allowMethod('post', 'delete');
		if ($this->Block->delete()) {
			$this->Session->setFlash(__('The city has been deleted.'));
		} else {
			$this->Session->setFlash(__('The city could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
        
        public function getblocks($stateid) {
	    $this->layout='ajax';
        $this->autoRender = false;
	    $data='<option value="">All Blocks</option>';
           //$data.='<option value="0">All Blocks</option>';
		$subcatlist=$this->Block->find('list',array("conditions"=>array('city_id'=>$stateid)));
		foreach($subcatlist as $key=>$value){ $data.='<option value="'.$key.'">'.$value.'</option>';}
		return $data;
	}
        
        
     public function getusers($stateid) {
	    $this->layout='ajax';
        $this->autoRender = false;
	    $data='<option value="">--Select--</option>';
            $row=$this->Block->query('select Block.id,Bpc.first_name,Bpccc.first_name,User1.id,User2.id,User1.name,User1.last_name,User2.name,User2.last_name from blocks as Block left join bpcccs as Bpccc on Bpccc.allocated_block=Block.id left join bpcs as Bpc on Bpc.allocated_block=Block.id left join users as User1 on Bpc.first_name=User1.id left join users as User2 on Bpccc.first_name=User2.id where Block.id='.$stateid);
		//print_r($row);
                //die();
		//$subcatlist=$this->Block->find('list',array("conditions"=>array('city_id'=>$stateid)));
		foreach($row as $key=>$value){
                    
                    $data.='<option value="'.$value['User1']['id'].'">'.$value['User1']['name'].'</option>';
                    $data.='<option value="'.$value['User2']['id'].'">'.$value['User2']['name'].'</option>';
                }
		return $data;
	}
        
        
        public function getblocksngo() {
	    $this->layout='ajax';
        $this->autoRender = false;
         $city=$this->params->query['c'];
	 $id=$this->params->query['nid'];
               $options = array('conditions' => array('Ngo.' . $this->Ngo->primaryKey => $id));
                $nog = $this->Ngo->find('all',$options);
	    $data='<option value="">--Select--</option>';
		$subcatlist=$this->Block->find('list',array("conditions"=>array('city_id'=>$city,'id'=>$nog['Ngo']['allocated_block'])));
		foreach($subcatlist as $key=>$value){ $data.='<option value="'.$key.'">'.$value.'</option>';}
		return $data;
	}
                
        public function gettitle($id) {
	  
		$options = array('conditions' => array('Block.' . $this->Block->primaryKey => $id));
		$data=$this->Block->find('first',$options);
		return $data;
	}         
}
