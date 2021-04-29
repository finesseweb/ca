<?php
App::uses('AppController', 'Controller');
/**
 * PeriodsController
 *
 * @property City $City
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ReportingPeriodsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
	var  $uses = array('ReportingPeriod');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Paginator->settings = array('ReportingPeriod' => array('limit' =>10,'order' => array('name' => 'asc')));
		$this->ReportingPeriod->recursive = 0;
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
		if (!$this->ReportingPeriod->exists($id)) {
			throw new NotFoundException(__('Invalid Reporting Period'));
		}
		$options = array('conditions' => array('ReportingPeriod.' . $this->ReportingPeriod->primaryKey => $id));
		$this->set('periods', $this->ReportingPeriod->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ReportingPeriod->create();
                        $frmdate= date('Y-m-d',strtotime($this->request->data['ReportingPeriod']['from_date']));
                        $todate = date('Y-m-d',strtotime($this->request->data['ReportingPeriod']['to_date']));
                        $status =  $this->request->data['ReportingPeriod']['status'];
                        $data = array('from_date' =>$frmdate,'to_date'=>$todate,'status'=>$status);
			if ($this->ReportingPeriod->save($data)) {
				$this->Session->setFlash(__('The Reporting Period has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Financial Period could not be saved. Please, try again.'));
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
		if (!$this->ReportingPeriod->exists($id)) {
			throw new NotFoundException(__('Invalid Reporting Period'));
		}
		if ($this->request->is(array('post', 'put'))) {
                        $frmdate= date('Y-m-d',strtotime($this->request->data['ReportingPeriod']['from_date']));
                        $todate = date('Y-m-d',strtotime($this->request->data['ReportingPeriod']['to_date']));
                        $status =  $this->request->data['ReportingPeriod']['status'];
                        $data = array('from_date' =>$frmdate,'to_date'=>$todate,'status'=>$status,'id'=>$id);
                    
			if ($this->ReportingPeriod->save($data)) {
				$this->Session->setFlash(__('The Reporting Period has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Reporting Period could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ReportingPeriod.' . $this->ReportingPeriod->primaryKey => $id));
			$this->request->data = $this->ReportingPeriod->find('first', $options);
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
		$this->ReportingPeriod->id = $id;
		if (!$this->ReportingPeriod->exists()) {
			throw new NotFoundException(__('Invalid Reporting Period'));
		}
		//$this->request->allowMethod('post', 'delete');
		if ($this->ReportingPeriod->delete()) {
			$this->Session->setFlash(__('The Reporting Period has been deleted.'));
		} else {
			$this->Session->setFlash(__('The Reporting Period could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
        
         
                
}
