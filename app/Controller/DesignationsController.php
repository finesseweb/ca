<?php
App::uses('AppController', 'Controller');
/**
 * PropertyTypes Controller
 *
 * @property PropertyType $PropertyType
 * @property PaginatorComponent $Paginator
 */
class DesignationsController extends AppController {

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
		$this->Designation->recursive = 0;
		$this->set('designations', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Designation->exists($id)) {
			throw new NotFoundException(__('Invalid Designation '));
		}
		$options = array('conditions' => array('Designation.' . $this->Designation->primaryKey => $id));
		$this->set('designation', $this->Designation->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Designation->create();
			if ($this->Designation->save($this->request->data)) {
				$this->Session->setFlash(__('The Designation  has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Designation  could not be saved. Please, try again.'));
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
		if (!$this->Designation->exists($id)) {
			throw new NotFoundException(__('Invalid property type'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Designation->save($this->request->data)) {
				$this->Session->setFlash(__('The Designation  has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Designation  could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Designation.' . $this->Designation->primaryKey => $id));
			$this->request->data = $this->Designation->find('first', $options);
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
		$this->Designation->id = $id;
		if (!$this->Designation->exists()) {
			throw new NotFoundException(__('Invalid property type'));
		}
		//$this->request->onlyAllow('post', 'delete');
		if ($this->Designation->delete()) {
			$this->Session->setFlash(__('The Designation  has been deleted.'));
		} else {
			$this->Session->setFlash(__('The Designation  could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
        
        public function getdesig(){
              $this->layout='ajax';
        $this->autoRender = false; 
        $data= "<option>Select Designation</option>";
            $desig=$this->Designation->find('list');
            foreach($desig as $key=>$value) {
               $data.='<option value="'.$key.'">'.$value.'</option>';
            }
            
            return $data;
        }
        
        
                }
