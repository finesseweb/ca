<?php
App::uses('AppController', 'Controller');
/**
 * Projects Controller
 *
 * @property Project $Project
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ProjectsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
	var  $uses = array('Project','Country','City','State','Enquiry');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$id='';
		if(isset($this->request->query['builder_id']) and $this->request->query['builder_id']!='' and $this->request->query['builder_id']!=0) { 
		$id=$this->request->query['builder_id'];
		$this->Paginator->settings = array('Project'=> array('conditions' => array('Project.builder_id' => $id),'limit' => 20,'order' => array('Project.name' => 'asc'),));
		}
	else {  $this->Paginator->settings = array('Project' => array('limit' => 20,'order' => array('Project.name' => 'asc'),)); } 
	
		$this->Project->recursive = 0;
		$this->set('projects', $this->Paginator->paginate());
		$builders = $this->Project->Builder->find('list');
		
		$this->set('builders',$builders);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Project->exists($id)) {
			throw new NotFoundException(__('Invalid project'));
		}
		$options = array('conditions' => array('Project.' . $this->Project->primaryKey => $id));
		$this->set('project', $this->Project->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Project->create();
			if ($this->Project->save($this->request->data)) {
				$this->Session->setFlash(__('The project has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The project could not be saved. Please, try again.'));
			}
		}
		$builders = $this->Project->Builder->find('list');
		$states = $this->Project->State->find('list');
		$cities = $this->Project->City->find('list');
		$propertyTypes = $this->Project->PropertyType->find('list');
		$this->set(compact('builders', 'states', 'cities','propertyTypes'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Project->exists($id)) {
			throw new NotFoundException(__('Invalid project'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Project->save($this->request->data)) {
				$this->Session->setFlash(__('The project has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The project could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Project.' . $this->Project->primaryKey => $id));
			$this->request->data = $this->Project->find('first', $options);
		}
		$builders = $this->Project->Builder->find('list');
		$states = $this->Project->State->find('list');
		$cities = $this->Project->City->find('list');
		$propertyTypes = $this->Project->PropertyType->find('list');
		$this->set(compact('builders', 'states', 'cities','propertyTypes'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	/*public function delete($id = null) {
		$this->Project->id = $id;
		if (!$this->Project->exists()) {
			throw new NotFoundException(__('Invalid project'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Project->delete()) {
			$this->Session->setFlash(__('The project has been deleted.'));
		} else {
			$this->Session->setFlash(__('The project could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}*/
	
	public function delete($id = null) {
		
			$this->Session->setFlash(__('The project could not be deleted.'));
		return $this->redirect(array('action' => 'index'));
	}
	
	public function getstate($countryid) {
	    $this->layout='ajax';
        $this->autoRender = false;
	    $data='<option value="">SELECT STATE</option>';
		$subcatlist=$this->State->find('list',array("conditions"=>array('country_id'=>$countryid)));
		foreach($subcatlist as $key=>$value){ $data.='<option value="'.$key.'">'.$value.'</option>';}
		return $data;
	}
	
	
	public function getcity($stateid) {
	    $this->layout='ajax';
        $this->autoRender = false;
	    $data='<option value="">SELECT CITY</option>';
		$subcatlist=$this->City->find('list',array("conditions"=>array('state_id'=>$stateid)));
		foreach($subcatlist as $key=>$value){ $data.='<option value="'.$key.'">'.$value.'</option>';}
		return $data;
	}
	
	public function getproject($builderid) {
	    $this->layout='ajax';
        $this->autoRender = false;
	    $data='<option value="">SELECT PROJECT</option>';
	    //$subcatlist=$this->Project->find('list',array('conditions'=>array('builder_id'=>$builderid),array('order'=>array('name'=>'asc'))));
	      $subcatlist=$this->Project->find('list',array('conditions'=>array('builder_id'=>$builderid),'order' => array('name'=>'asc')));
	     
	     
	     
	     
	     
	
		
		foreach($subcatlist as $key=>$value){ $data.='<option value="'.$key.'">'.$value.'</option>';}
		return $data;
	}
	
	
	public function getprojectNameOnID($id=null) {
	    $this->layout='ajax';
        $this->autoRender = false;
		$projects=$this->Project->find('first',array("conditions"=>array('Project.id'=>$id)));

		return $projects;
	}
	
   public function getprojectajax($builderid) {
	    $this->layout='ajax';
        $this->autoRender = false;
	    $data='<option value="">SELECT PROJECT</option>';
		$subcatlist=$this->Project->find('list',array("conditions"=>array('builder_id'=>$builderid),array('order'=>array('name'=>'asc'))));
		foreach($subcatlist as $key=>$value){ $data.='<option value="'.$key.'##'.$value.'">'.$value.'</option>';}
		return $data;
	}
	
	
}
