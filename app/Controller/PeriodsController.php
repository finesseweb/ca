<?php
App::uses('AppController', 'Controller');
/**
 * PeriodsController
 *
 * @property City $City
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class PeriodsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
	var  $uses = array('Period','Overhead');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Paginator->settings = array('Period' => array('limit' =>10,'order' => array('name' => 'asc'),'conditions'=>array('Period.status'=>'active')));
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
                        $frmdate= date('Y-m-d',strtotime($this->request->data['Period']['from_date']));
                        $todate = date('Y-m-d',strtotime($this->request->data['Period']['to_date']));
                        $financial_year= date('Y',strtotime($this->request->data['Period']['from_date'])).'-'.date('Y',strtotime($this->request->data['Period']['to_date']));
                        $status =  $this->request->data['Period']['status'];
                        $data = array('from_date' =>$frmdate,'to_date'=>$todate,'financial_year'=>$financial_year,'status'=>$status);
                        
                        
			if ($this->Period->save($data)) {
                            
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
                    
                       $frmdate= date('Y-m-d',strtotime($this->request->data['Period']['from_date']));
                        $todate = date('Y-m-d',strtotime($this->request->data['Period']['to_date']));
                        $status =  $this->request->data['Period']['status'];
                        $data = array('from_date' =>$frmdate,'to_date'=>$todate,'status'=>$status,'id'=>$id);
			if ($this->Period->save($data)) {
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
//	public function delete($id = null) {
//		$this->Period->id = $id;
//		if (!$this->Period->exists()) {
//			throw new NotFoundException(__('Invalid Period'));
//		}
//		//$this->request->allowMethod('post', 'delete');
//		if ($this->Period->delete()) {
//			$this->Session->setFlash(__('The Period has been deleted.'));
//		} else {
//			$this->Session->setFlash(__('The Period could not be deleted. Please, try again.'));
//		}
//		return $this->redirect(array('action' => 'index'));
//	}
//        
      public function delete($id = null,$status='deactive') {
		$this->Period->id = $id;
		if (!$this->Period->exists()) {
			throw new NotFoundException(__('Invalid Financial Detail'));
		}
		    //$this->request->onlyAllow('post', 'delete');
              //  $get=$this->Period->find('first',array("conditions"=>array('Period.id'=>$id)));
              ///print_r(); die();
		    $this->Period->read(null,$id);
			$this->Period->set(array('status'=>$status));
		
		if ($this->Period->save()) {
			$this->Session->setFlash(__('Financial has been '.$status));
		} else {
			$this->Session->setFlash(__('Nothing happen. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	} 
     public function getmonths($stateid) {
	    $this->layout='ajax';
        $this->autoRender = false;
	   
		$subcatlist=$this->Period->find('first',array("conditions"=>array('id'=>$stateid)));
		$frmdate= $subcatlist['Period']['from_date'];
                $tdate = $subcatlist['Period']['to_date'];
                //$diff = $tdate-$frmdate;.
                        
                        $ts1 = strtotime($frmdate);
                        $ts2 = strtotime($tdate);

                        $year1 = date('Y', $ts1);
                        $year2 = date('Y', $ts2);

                        $month1 = date('m', $ts1);
                        $month2 = date('m', $ts2);

                        $data = (($year2 - $year1) * 12) + ($month2);
                
		return $data;
	}  
        
        public function getperiod($stateid) {
	    $this->layout='ajax';
            $this->autoRender = false;
        
        
	      // $data='<option value="">--Select--</option>';
               
                $overhead=$this->Overhead->find('first',array("conditions"=>array('Overhead.organization'=>$stateid)));
                $p= $overhead['Overhead']['period_id'];
		$subcatlist=$this->Period->find('first',array("conditions"=>array('Period.id'=>$p)));
               //print_r($p);
		//$frmdate= $subcatlist['Period']['from_date'];
                //$tdate = $subcatlist['Period']['to_date'];
                $data='<option value="'.$subcatlist['Period']['id'].'">'.date('d-m-Y',strtotime($subcatlist['Period']['from_date'])).' '.date('d-m-Y',strtotime($subcatlist['Period']['to_date'])).'</option>';
		return $data;
	}  
                
}
