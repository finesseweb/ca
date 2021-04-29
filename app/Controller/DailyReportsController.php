<?php
App::uses('AppController', 'Controller');
/**
 * DailyReports Controller
 *
 * @property DailyReport $DailyReport
 * @property PaginatorComponent $Paginator
 */
class DailyReportsController extends AppController {

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
		$this->DailyReport->recursive = 0;
		$this->set('dailyReports', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->DailyReport->exists($id)) {
			throw new NotFoundException(__('Invalid daily report'));
		}
		$options = array('conditions' => array('DailyReport.' . $this->DailyReport->primaryKey => $id));
		$this->set('dailyReport', $this->DailyReport->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->DailyReport->create();
			if ($this->DailyReport->save($this->request->data)) {
				$this->Session->setFlash(__('The daily report has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The daily report could not be saved. Please, try again.'));
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
		if (!$this->DailyReport->exists($id)) {
			throw new NotFoundException(__('Invalid daily report'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->DailyReport->save($this->request->data)) {
				$this->Session->setFlash(__('The daily report has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The daily report could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('DailyReport.' . $this->DailyReport->primaryKey => $id));
			$this->request->data = $this->DailyReport->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function reportOnEnquiry($enquiryid = null) {
		
		if($enquiryid){

        $data=$this->DailyReport->query("select DailyReport.customer_type,DailyReport.response,DailyReport.msgsent,DailyReport.attend_by from daily_reports as DailyReport where DailyReport.enquiry_id=".$enquiryid);

		//$data=$this->DailyReport->find('all',array('conditions'=>array('DailyReport.enquiry_id'=>$enquiryid)));	
		return $data;	
		}
      
	}
	
	
	}
