<?php
App::uses('AppController', 'Controller');
/**
 * Cities Controller
 *
 * @property City $City
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class TargetsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
	var  $uses = array('Target','Ngo','City','Block','Period','Panchayat');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Paginator->settings = array('Target' => array('limit' =>10,'order' => array('name' => 'asc')));
		$this->Target->recursive = 0;
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
		if (!$this->Target->exists($id)) {
			throw new NotFoundException(__('Invalid city'));
		}
		$options = array('conditions' => array('Target.' . $this->Target->primaryKey => $id));
		$this->set('financial', $this->Target->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Target->create();
                        
                           $panchayat= implode(',',$this->request->data['Target']['panchayat']);
                           $organization=$this->request->data['Target']['organization'];
                           $district=$this->request->data['Target']['district'];
                           $block= $this->request->data['Target']['block'];
                           $period_id= $this->request->data['Target']['period_id'];
                           $total_months= $this->request->data['Target']['total_months'];
                           $vhsnc_meeting_target= $this->request->data['Target']['vhsnc_meeting_target'];
                           $feedback_target=$this->request->data['Target']['feedback_target'];
                           $vhsnc_issue_target= $this->request->data['Target']['vhsnc_issue_target'];
                           $vhsnc_issueresolved_target= $this->request->data['Target']['vhsnc_issueresolved_target'];
                           $vhsnd_monitor_target= $this->request->data['Target']['vhsnd_monitor_target'];
                           $vhsnc_monitor_target= $this->request->data['Target']['vhsnc_monitor_target'];
                           $ivrs_feedback_target= $this->request->data['Target']['ivrs_feedback_target'];
                           $anm_meeting_target= $this->request->data['Target']['anm_meeting_target'];
                           $dpmc_meeting_target= $this->request->data['Target']['dpmc_meeting_target'];
                           $bpmc_meeting_target= $this->request->data['Target']['bpmc_meeting_target'];
                           $rks_meeting_target= $this->request->data['Target']['rks_meeting_target'];
                           $vhsnc_checklist_target= $this->request->data['Target']['vhsnc_checklist_target'];
                           $vhsnd_checklist_target= $this->request->data['Target']['vhsnd_checklist_target'];
                           $facility_assessement_target= $this->request->data['Target']['facility_assessement_target'];
                           $iucd_services_target= $this->request->data['Target']['iucd_services_target'];
                           $antara_services_target= $this->request->data['Target']['antara_services_target'];
                           $vhsnc_expenditure_total_target= $this->request->data['Target']['vhsnc_expenditure_total_target'];
                           $vhsnc_expenditure_allocation_target= $this->request->data['Target']['vhsnc_expenditure_allocation_target'];
                           $budget_utilized_target= $this->request->data['Target']['budget_utilized_target'];
                           $anc_service_target= $this->request->data['Target']['anc_service_target'];
                           $issue_pending_target= $this->request->data['Target']['issue_pending_target'];
                           //$status= $this->request->data['Target']['status'];
                         
                          
                          
                          
                          $data= array(
                              'organization'=>$organization,
                              'district'=>$district,
                              'block'=>$block,
                              'panchayat'=>$panchayat,
                              'period_id'=>$period_id,
                              'total_months'=>$total_months,
                              'vhsnc_meeting_target'=>$vhsnc_meeting_target,
                              'feedback_target'=>$feedback_target,
                              'vhsnc_issue_target'=>$vhsnc_issue_target,
                              'vhsnc_issueresolved_target'=>$vhsnc_issueresolved_target,
                              'vhsnd_monitor_target'=>$vhsnd_monitor_target,
                              'vhsnc_monitor_target'=>$vhsnc_monitor_target,
                              'ivrs_feedback_target'=>$ivrs_feedback_target,
                              'anm_meeting_target'=>$anm_meeting_target,
                              'dpmc_meeting_target'=>$dpmc_meeting_target,
                              'bpmc_meeting_target'=>$bpmc_meeting_target,
                              'rks_meeting_target'=>$rks_meeting_target,
                              'vhsnc_checklist_target'=>$vhsnc_checklist_target,
                              'vhsnd_checklist_target'=>$vhsnd_checklist_target,
                              'facility_assessement_target'=>$facility_assessement_target,
                              'iucd_services_target'=>$iucd_services_target,
                              'antara_services_target'=>$antara_services_target,
                              'vhsnc_expenditure_total_target'=>$vhsnc_expenditure_total_target,
                              'vhsnc_expenditure_allocation_target'=>$vhsnc_expenditure_allocation_target,
                              'budget_utilized_target'=>$budget_utilized_target,
                              'anc_service_target'=>$anc_service_target,
                              'issue_pending_target'=>$issue_pending_target,
                             );
                          
			if ($this->Target->save($data)) {
				$this->Session->setFlash(__('The Target has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Target could not be saved. Please, try again.'));
			}
		}
		$ngos=$this->Ngo->find('list');
                $cities=$this->City->find('list',array('order' => array('name' => 'asc')));
                $blocks=$this->Block->find('list',array('order' => array('name' => 'asc')));
                 $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc')));
                 $period=$this->Period->query("select * from periods");  
               $this->set(compact('cities','blocks','panchayat','period','ngos'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Target->exists($id)) {
			throw new NotFoundException(__('Invalid city'));
		}
		if ($this->request->is(array('post', 'put'))) {
                        
                          
                           $panchayat= implode(',',$this->request->data['Target']['panchayat']);
                           $organization=$this->request->data['Target']['organization'];
                           $district=$this->request->data['Target']['district'];
                           $block= $this->request->data['Target']['block'];
                           $period_id= $this->request->data['Target']['period_id'];
                           $total_months= $this->request->data['Target']['total_months'];
                           $vhsnc_meeting_target= $this->request->data['Target']['vhsnc_meeting_target'];
                           $feedback_target=$this->request->data['Target']['feedback_target'];
                           $vhsnc_issue_target= $this->request->data['Target']['vhsnc_issue_target'];
                           $vhsnc_issueresolved_target= $this->request->data['Target']['vhsnc_issueresolved_target'];
                           $vhsnd_monitor_target= $this->request->data['Target']['vhsnd_monitor_target'];
                           $vhsnc_monitor_target= $this->request->data['Target']['vhsnc_monitor_target'];
                           $ivrs_feedback_target= $this->request->data['Target']['ivrs_feedback_target'];
                           $anm_meeting_target= $this->request->data['Target']['anm_meeting_target'];
                           $dpmc_meeting_target= $this->request->data['Target']['dpmc_meeting_target'];
                           $bpmc_meeting_target= $this->request->data['Target']['bpmc_meeting_target'];
                           $rks_meeting_target= $this->request->data['Target']['rks_meeting_target'];
                           $vhsnc_checklist_target= $this->request->data['Target']['vhsnc_checklist_target'];
                           $vhsnd_checklist_target= $this->request->data['Target']['vhsnd_checklist_target'];
                           $facility_assessement_target= $this->request->data['Target']['facility_assessement_target'];
                           $iucd_services_target= $this->request->data['Target']['iucd_services_target'];
                           $antara_services_target= $this->request->data['Target']['antara_services_target'];
                           $vhsnc_expenditure_total_target= $this->request->data['Target']['vhsnc_expenditure_total_target'];
                           $vhsnc_expenditure_allocation_target= $this->request->data['Target']['vhsnc_expenditure_allocation_target'];
                           $budget_utilized_target= $this->request->data['Target']['budget_utilized_target'];
                           $anc_service_target= $this->request->data['Target']['anc_service_target'];
                           $issue_pending_target= $this->request->data['Target']['issue_pending_target'];
                           $status= $this->request->data['Target']['status'];
                         
                          
                          
                          
                          $data= array(
                              'organization'=>$organization,
                              'district'=>$district,
                              'block'=>$block,
                              'panchayat'=>$panchayat,
                              'period_id'=>$period_id,
                              'total_months'=>$total_months,
                              'vhsnc_meeting_target'=>$vhsnc_meeting_target,
                              'feedback_target'=>$feedback_target,
                              'vhsnc_issue_target'=>$vhsnc_issue_target,
                              'vhsnc_issueresolved_target'=>$vhsnc_issueresolved_target,
                              'vhsnd_monitor_target'=>$vhsnd_monitor_target,
                              'vhsnc_monitor_target'=>$vhsnc_monitor_target,
                              'ivrs_feedback_target'=>$ivrs_feedback_target,
                              'anm_meeting_target'=>$anm_meeting_target,
                              'dpmc_meeting_target'=>$dpmc_meeting_target,
                              'bpmc_meeting_target'=>$bpmc_meeting_target,
                              'rks_meeting_target'=>$rks_meeting_target,
                              'vhsnc_checklist_target'=>$vhsnc_checklist_target,
                              'vhsnd_checklist_target'=>$vhsnd_checklist_target,
                              'facility_assessement_target'=>$facility_assessement_target,
                              'iucd_services_target'=>$iucd_services_target,
                              'antara_services_target'=>$antara_services_target,
                              'vhsnc_expenditure_total_target'=>$vhsnc_expenditure_total_target,
                              'vhsnc_expenditure_allocation_target'=>$vhsnc_expenditure_allocation_target,
                              'budget_utilized_target'=>$budget_utilized_target,
                              'anc_service_target'=>$anc_service_target,
                              'issue_pending_target'=>$issue_pending_target,
                              'status'=>$status, 
                              'id'=>$id
                          );
                          //print_r($data);
                          //die();
			if ($this->Target->save($data)) {
				$this->Session->setFlash(__('The Target has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Target category could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Target.' . $this->Target->primaryKey => $id));
			$this->request->data = $this->Target->find('first', $options);
		}
               if($this->request->data['Target']['panchayat']!=0 and $this->request->data['Target']['panchayat']!='')
			{
		     $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>['Panchayat.id IN'=>explode(',',$this->request->data['Target']['panchayat'])]));
                  }
                  else {
                     $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc')));
                 
                  }
		$ngos=$this->Ngo->find('list');
                $cities=$this->City->find('list',array('order' => array('name' => 'asc')));
                $blocks=$this->Block->find('list',array('order' => array('name' => 'asc')));
                $period=$this->Period->query("select * from periods");  
                $this->set(compact('cities','blocks','panchayat','period','ngos'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Target->id = $id;
		if (!$this->Target->exists()) {
			throw new NotFoundException(__('Invalid category'));
		}
		//$this->request->allowMethod('post', 'delete');
		if ($this->Target->delete()) {
			$this->Session->setFlash(__('The category has been deleted.'));
		} else {
			$this->Session->setFlash(__('The category could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
        
        public function getpanchayats($stateid) {
	    $this->layout='ajax';
        $this->autoRender = false;
	    
		$subcatlist=$this->Target->find('first',array("conditions"=>array('organization'=>$stateid)));
		if($subcatlist) {
                $data=$subcatlist['Target']['panchayat'];
                
		return $data;
                }
	}
                
                
}
