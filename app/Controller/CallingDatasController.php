<?php
class CallingDatasController extends AppController{
	
	public $components = array('Paginator', 'Session', 'Pagination','Mail','Sms','Upload');
	
	
	public function index(){
		
		
		
		if(isset($this->params->query['confirm'])) {
	    
	/*	if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
		
		  $searchKey=trim($this->request->query['search_key']); 
		  $condition['OR']=array('CallingData.id LIKE'=>'%'.$searchKey.'%'); 
		} */
	
	   if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim($this->request->query['from_date']);
				$todate=trim($this->request->query['to_date']);
				$condition['AND']=array('date(CallingData.called_on) >='=>$fromdate,'date(CallingData.called_on) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim($this->request->query['from_date']);  
				$condition['date(CallingData.called_on)']=$fromdate;	
				}
				else
				{
					
					}
			}
					
     if(isset($this->request->query['search_user']) and ($this->request->query['search_user']!='' || $this->request->query['search_user']!=0) and (CakeSession::read('User.type')!='regular'))
		{   
		    $searchUserId=trim($this->request->query['search_user']);
			$condition['CallingData.user_id']=$searchUserId;
			$pending['CallingData.user_id']=$searchUserId;
		}	
		
		if(isset($this->request->query['search_user']) and ($this->request->query['search_user']!='' || $this->request->query['search_user']!=0) and (CakeSession::read('User.type')=='regular'))
		{   
		    $searchUserId=trim($this->request->query['search_user']);
			if ($this->checkOnlyUser($searchUserId)==false) {
			throw new NotFoundException(__('Invalid Data'));
		}	
		 $condition['CallingData.user_id']=$searchUserId;
		 $pending['CallingData.user_id']=$searchUserId;
		 }
		 
		 if(isset($this->request->query['search_user']) and ($this->request->query['search_user']=='' || $this->request->query['search_user']==0) and (CakeSession::read('User.type')=='regular'))
		{
		$condition['CallingData.user_id']=CakeSession::read('User.id');
		//$condition['NOT']=array('Enquiry.marked_or_not'=>'Y');
		//$pending['CallingData.user_id']=CakeSession::read('User.id');
		//$pending['NOT']=array('Enquiry.marked_or_not'=>'Y');
		}
		
		if(!isset($this->request->query['search_user']) and (CakeSession::read('User.type')=='regular'))
		{
		$condition['CallingData.user_id']=CakeSession::read('User.id');
		//$pending['CallingData.user_id']=CakeSession::read('User.id');
		}
		}
		
		else {
		
		if(CakeSession::read('User.type')==='regular'){
			$condition['CallingData.user_id']=CakeSession::read('User.id');
			//$condition['date(CallingData.updated_on)']=date('Y-m-d');
		}
		else {
		//$condition['date(CallingData.updated_on)']=date('Y-m-d');
		$condition='';
		}
		}
		
		$this->Paginator->settings = array('CallingData' => array('fields'=>array('CallingData.id','CallingData.user_id','CallingData.follow_ups','CallingData.total_call','CallingData.meeting_set','CallingData.crm_updation','CallingData.update_by','CallingData.called_on'),'limit' =>10,'order' => array('id' => 'desc'),'conditions'=>$condition));
		$this->CallingData->recursive = 0;
		$this->set('callingdatas', $this->Paginator->paginate());
		
			
				
		
		
		//$callingdatas = $this->CallingData->find('all',array('fields'=>array('CallingData.id','CallingData.user_id','CallingData.total_call','CallingData.follow_ups','CallingData.meeting_set','CallingData.crm_updation','CallingData.update_by','CallingData.updated_on','CallingData.called_on'),'conditions'=>$condition));
		//$this->set('callingdatas', $callingdatas);
		//$this->set('callingdatas', $this->CallingData->find('all'));
		}
		
/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->CallingData->create();
			$this->request->data['CallingData']['update_by']=CakeSession::read('User.id');
			$this->request->data['CallingData']['updated_on']=date("Y-m-d H:i:s");
			$this->request->data['CallingData']['called_on']=date("Y-m-d H:i:s");
			if ($this->CallingData->save($this->request->data)) {
				$this->Session->setFlash(__('The Calling Data has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Calling Data could not be saved. Please, try again.'));
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
		if (!$this->CallingData->exists($id)) {
			throw new NotFoundException(__('Invalid CallingData'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$this->request->data['CallingData']['update_by']=CakeSession::read('User.id');
			$this->request->data['CallingData']['updated_on']=date("Y-m-d H:i:s");
			
			if ($this->CallingData->save($this->request->data)) {
				$this->Session->setFlash(__('The CallingData has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The CallingData could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('CallingData.'.$this->CallingData->primaryKey => $id));
			$this->request->data=$this->CallingData->find('first', $options);
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
		$this->CallingData->id = $id;
		if (!$this->CallingData->exists()) {
			throw new NotFoundException(__('Invalid CallingData'));
		}
		if ($this->CallingData->delete()) {
			$this->Session->setFlash(__('The CallingData has been deleted.'));
		} else {
			$this->Session->setFlash(__('The CallingData could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	

public function export(){
		$data='';$searchKey=null;$searchUserId=null;$searchCountryId=null;$searchBuilderId=null;$searchProjectId=null;
		$searchStatus=null;$pages=null;$condition='';$querySrting=''; $condition=array();$condition2='';
		$conc='';
		//$username=$this->User->findById(CakeSession::read('User.id'));
		if(isset($this->params->query['confirm'])) {
	   
		/*if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
		
		$searchKey=trim($this->request->query['search_key']);  
		$condition2.=' and CallingData.id LIKE %'.$searchKey.'% || CallingData.name LIKE %'.$searchKey.'% || CallingData.email LIKE %'.$searchKey.'% || CallingData.contact LIKE %'.$searchKey.'%';
	
	}*/
	
	if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim($this->request->query['from_date']);
				$todate=trim($this->request->query['to_date']);
				$condition2.=' and date(CallingData.called_on)>="'.$fromdate.'" and date(CallingData.called_on)<="'.$todate.'"';
				//$condition['AND']=array('date(CallingData.posted_date) >='=>$fromdate,'date(CallingData.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim($this->request->query['from_date']);  
				//$condition['CallingData.posted_date']=$fromdate;	
				$condition2.=' and date(CallingData.called_on)="'.$fromdate.'"';
				}
				else
				{
					
					}
			}
			
		if(isset($this->request->query['search_user']) and ($this->request->query['search_user']!='' || $this->request->query['search_user']!=0) and (CakeSession::read('User.type')!='regular'))
		{   
		    $searchUserId=trim($this->request->query['search_user']);
			$condition2.=' and CallingData.user_id='.$searchUserId;
		}
		
		if(isset($this->request->query['search_user']) and ($this->request->query['search_user']!='' || $this->request->query['search_user']!=0) and (CakeSession::read('User.type')=='regular'))
		{   
		    $searchUserId=trim($this->request->query['search_user']);
			if ($this->checkOnlyUser($searchUserId)==false) {
			throw new NotFoundException(__('Invalid Data'));
		}	
		 $condition2.=' and CallingData.user_id='.$searchUserId;
		 }
		 
		 if(isset($this->request->query['search_user']) and ($this->request->query['search_user']=='' || $this->request->query['search_user']==0) and (CakeSession::read('User.type')=='regular'))
		{
		$condition2.=' and CallingData.user_id='.CakeSession::read('User.id');
		}
		
		if(!isset($this->request->query['search_user']) and (CakeSession::read('User.type')=='regular'))
		{
		$condition2.=' and CallingData.user_id='.CakeSession::read('User.id');
		}
		}
		else {
		if(CakeSession::read('User.type')==='regular'){
			$condition2.=' and CallingData.user_id='.CakeSession::read('User.id');
		}
		else {
		
		}
		}
		$this->response->download("callingdata.csv");
		$data=$this->CallingData->query('select CallingData.id,CallingData.total_call,CallingData.follow_ups,CallingData.meeting_set,CallingData.crm_updation,CallingData.called_on,CallingData.user_id,User.username from calling_datas as CallingData left join users as User on CallingData.user_id=User.id where 1 '.$condition2 );
		
			
		
	$headers = array('CallingData'=>array( 'Id' => 'Id','Total Call' => 'Total Call', 'Follow Ups' => 'Follow Ups', 'Meeting Set' => 'Meeting Set', 'Crm Updation' => 'Crm Updation', 'Called On' => 'Called On', 'User' => 'User')); 
	// echo 'richa';
	   $this->set(compact('data','headers'));
		
	//exit;
		$this->layout = 'ajax';
	//	exit;
		return;
		
		}	
	
	
	
	
}





