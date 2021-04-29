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
	//var  $uses = array('Period','ReportingPeriod');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Paginator->settings = array('Period' => array('limit' =>10,'order' => array('name' => 'asc')));
		$this->Period->recursive = 0;
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
		if (!$this->Period->exists($id)) {
			throw new NotFoundException(__('Invalid Period'));
		}
		$options = array('conditions' => array('Period.' . $this->Period->primaryKey => $id));
		$this->set('periods', $this->Period->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Period->create();
			if ($this->Period->save($this->request->data)) {
				$this->Session->setFlash(__('The Financial Period has been saved.'));
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
		if (!$this->Period->exists($id)) {
			throw new NotFoundException(__('Invalid city'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Period->save($this->request->data)) {
				$this->Session->setFlash(__('The Period has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Financial Period could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Period.' . $this->Period->primaryKey => $id));
			$this->request->data = $this->Period->find('first', $options);
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
		$this->Period->id = $id;
		if (!$this->Period->exists()) {
			throw new NotFoundException(__('Invalid block'));
		}
		//$this->request->allowMethod('post', 'delete');
		if ($this->Period->delete()) {
			$this->Session->setFlash(__('The city has been deleted.'));
		} else {
			$this->Session->setFlash(__('The city could not be deleted. Please, try again.'));
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
      public function reportingperiods() {
          $this->loadModel('ReportingPeriod');
		//$this->Paginator->settings = array('ReportingPeriod' => array('limit' =>10,'order' => array('name' => 'asc')));
		//$this->ReportingPeriod->recursive = 0;
		$report = $this->Paginator->settings = $this->ReportingPeriod->query("select * from reporting_periods");
                   $reportings =$this->recursive = $report;
                //print_r($reportings);
                if(isset($this->request->params['pass'][1])){
                    $type =$this->request->params['pass'][1];
                
                }
                switch ($type){
                    case 'add':
                        
                        //echo "i am here";
                        //die();
                     if ($this->request->is('post')) {
                         // print_r($this->request->data);
                         // die();
			$this->ReportingPeriod->create();
                       
                        
			if ($this->ReportingPeriod->save($this->request->data)) {
				$this->Session->setFlash(__('The Reproting Period has been saved.'));
				return $this->redirect(array('action' => 'reportingperiod'));
			} else {
				$this->Session->setFlash(__('The Financial Period could not be saved. Please, try again.'));
			}
		}   
                break;
                
            default :
                echo "do not save";
                break;
                }
                
                $this->set(compact('type','reportings'));
                //print_r($type) ;
	}          
                
}
