<?php
App::uses('AppController', 'Controller');
/**
 * Remarks Controller
 *
 * @property Remark $Remark
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class RemarksController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'Pagination','Mail','Sms','Upload');
	var  $uses = array('Enquiry','Builder','User','Remark','Mobilesms','Project','Country','LeadSource','CloseReason');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Paginator->settings = array('Remark' => array('fields'=>array('Remark.id','Remark.name','Remark.posted_date','Remark.feedBy','Enquiry.name','Enquiry.id'),'limit' =>20,'order' => array('posted_date' => 'desc')));
		$this->Remark->recursive = 0;
		$this->set('remarks', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Remark->exists($id)) {
			throw new NotFoundException(__('Invalid remark'));
		}
		$options = array('conditions' => array('Remark.' . $this->Remark->primaryKey => $id));
		$this->set('remark', $this->Remark->find('first', $options));
	}

    public function imageVsVideo($source = null) {
		$this->layout='ajax';
		$this->set("source",$source);
		}
	
	function lastRemarks($id=null)
	{   $name='';
		if($id){
		
			$name=$this->Remark->query("select name from remarks where enquiry_id=".$id." order by id desc limit 1");
			//$name=$this->Remark->find("first",array('order' => array('Remark.id' => 'desc'),'conditions'=>array("Remark.enquiry_id"=>$id)));
			
			/*if(!empty($name)) { foreach($name as $key=>$val) {$data.=$keyy."=>". preg_replace('/"/','""',$val['remarks']['name'])."  "; $keyy=$keyy-1; }
			return $data;*/
			
			if(!empty($name)) {
			//$data3=preg_replace('/"/','""','No Remark');$data2=preg_replace('/"/','""','No Remark');$data1=preg_replace('/"/','""','No Remark');
			if(isset($name['0']['remarks']['name'])) { $data3='","' . preg_replace('/"/','""',$name['0']['remarks']['name']);}
			//if(isset($name['1']['remarks']['name'])) { $data2= '","' . preg_replace('/"/','""',$name['1']['remarks']['name']);}
			//if(isset($name['2']['remarks']['name'])) { $data1='","' . preg_replace('/"/','""',$name['2']['remarks']['name']);}
			
			return $data3;
			//return $data3.$data2.$data1;
           }
			else
			{
				return 'No remark.';
				}
		}
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Remark->create();
			if ($this->Remark->save($this->request->data)) {
				$this->Session->setFlash(__('The remark has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The remark could not be saved. Please, try again.'));
			}
		}
		$enquiries = $this->Remark->Enquiry->find('list');
		$this->set(compact('enquiries'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Remark->exists($id)) {
			throw new NotFoundException(__('Invalid remark'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Remark->save($this->request->data)) {
				$this->Session->setFlash(__('The remark has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The remark could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Remark.' . $this->Remark->primaryKey => $id));
			$this->request->data = $this->Remark->find('first', $options);
		}
		$enquiries = $this->Remark->Enquiry->find('list');
		$this->set(compact('enquiries'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Remark->id = $id;
		if (!$this->Remark->exists()) {
			throw new NotFoundException(__('Invalid remark'));
		}
		//$this->request->allowMethod('post', 'delete');
		if ($this->Remark->delete()) {
			$this->Session->setFlash(__('The remark has been deleted.'));
		} else {
			$this->Session->setFlash(__('The remark could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

    public function queryMarking() {
		$data='';$searchKey=null;$searchUserId=null;$searchCountryId=null;$searchBuilderId=null;$searchProjectId=null;$fromdate=null;$todate=null;$movedfrom="";
		$searchStatus=null;$pages=null;$condition='';$querySrting=''; $condition=array();
		$conc='';$conditionencrypt='';
		
		if(isset($this->params->query['confirm'])) {
		
		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim($this->request->query['from_date']);
				$todate=trim($this->request->query['to_date']);
				$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim($this->request->query['from_date']);  
				$condition['date(Enquiry.posted_date)']=$fromdate;	
				}
				else
				{
					
					}
			}
		
		
	if (isset($this->request->query['search_country']) and ($this->request->query['search_country']!=0) and ($this->request->query['search_country']!='')) 
	{
		$searchCountryId=trim($this->request->query['search_country']);  
		$condition['Enquiry.country_id']=$searchCountryId;
		
		}
		
		
		if(isset($this->request->query['search_builder']) and ($this->request->query['search_builder']!=0) and ($this->request->query['search_builder']!='')){
			$searchBuilderId=trim($this->request->query['search_builder']); $condition['Enquiry.builder_id']=$searchBuilderId;
		
		}
		
		if(isset($this->request->query['search_project']) and ($this->request->query['search_project']!=0) and ($this->request->query['search_project']!='')){ 
		$searchProjectId=trim($this->request->query['search_project']); $condition['Enquiry.project_id']=$searchProjectId;
		
		}
		
     if(isset($this->request->query['search_user']) and ($this->request->query['search_user']!='' || $this->request->query['search_user']!=0) and (CakeSession::read('User.type')!='regular'))
		{   
		    $searchUserId=trim($this->request->query['search_user']);
			$condition['Enquiry.user_id']=$searchUserId;
			$pending['Enquiry.user_id']=$searchUserId;
		}
		
		if(isset($this->request->query['no_reminder'])){
			//$condition['Enquiry.is_reminder']='no'; exit;
			$condition['AND']=array('Enquiry.is_reminder'=>'no');
			//$condition['OR']=array('Enquiry.reminder_date'=>strtotime('0000-00-00 00:00:00'));
			}
			
		if(isset($this->request->query['no_remark_after_Week'])) {
			
		$condition['AND']=array('Enquiry.is_reminder'=>'yes','DATEDIFF(curdate(),date(Enquiry.reminder_date)) >='=>7,'Enquiry.reminder_date !='=>strtotime('0000-00-00 00:00:00'));
		
		}	
	    $condition['Enquiry.status']="open";
		}
		else {
		$condition=array('Enquiry.status'=>"open",'date(Enquiry.posted_date)'=>date('Y-m-d'));
		}
		
		//$condition['NOT'][]=array('Enquiry.status'=>"trash");
		//$condition2.=' and Enquiry.status!="trash"';
		
		
		
		$this->Paginator->settings = array('Enquiry' => array('fields'=>array('Enquiry.status','Enquiry.hot_lead','CloseReason.name','LeadSource.name','Enquiry.name','LeadSource.flag','User.username','User.colorcode','User.parent','Enquiry.posted_date','Enquiry.email','Builder.name','Project.name','Country.name','Enquiry.is_discrepency','Enquiry.id','Enquiry.reminder_date','Enquiry.is_reminder','Enquiry.user_id','Enquiry.is_meeting','Enquiry.contact','Enquiry.lead_of','Enquiry.marked_or_not'),'limit' =>10,'order' => array('id' => 'desc'),'conditions'=>$condition));
		//$conditionencrypt = $this->Enquiry->find('sql', array('conditions'=>$condition));
		$this->Enquiry->recursive = 0;
		$this->set('enquiries', $this->Paginator->paginate());
		
		
		//$log = $this->Enquiry->getDataSource()->getLog(false, false);
       // debug($log);
		//exit;
		//$users = $this->Enquiry->User->find('all',array('fields'=>array('id','name','username','parent'),'conditions'=>array('status'=>'active')));
		$users = $this->User->find('list',array('fields'=>array('parent'),'conditions'=>array('status !='=>'deactive')));
		$builders = $this->Builder->find('list',array('order'=>array('name'=>'asc')));
		$countries = $this->Country->find('list');
		$leadSources = $this->LeadSource->find('list');
		if(isset($this->request->query['search_builder']) and ($this->request->query['search_builder']!=0 || $this->request->query['search_builder']!='')){$projects = $this->Project->find('list',array('conditions'=>array("Project.builder_id"=>$this->request->query['search_builder'])));}
		$closeReasons = $this->CloseReason->find('list');
		$this->set(compact('users', 'builders', 'countries','closeReasons','projects','leadSources'));
		$this->set('conditionencrypt');
		
		
		//$log = $this->Enquiry->getDataSource()->getLog(false, false);
       // debug($log);
		
	
	}
	
	private function cheackLead($id=null){	
	if($id){

		$data=$this->Enquiry->findById($id);
		if(!empty($data['Enquiry']['name']))
		{
			return true;
		}
		else {
			
			return false;
			}
		
		}
	}
	
	public function dateMarking() {
		
	 $this->layout="newdefault";
	 $this->autoRender =false;
	 if($this->request->is('ajax')) {
	  $msg='';
		if (isset($this->request->query['params']) and $this->request->query['params']!="") {
		$params=trim($this->request->query['params'],'{   }');
		$ids=@explode(',',$params);
		if (!empty($ids)) {foreach($ids as $key=>$value) {
			
			if($this->cheackLead($value)==true)
			{ 
				$this->Enquiry->query("update  enquiries set marked_or_not='Y' where id=".$value);
				$msg="Marking done";
				}
				else
				{
					$msg="Not Exist";
				}
			
		    }
		 echo $msg;	
		}
		
		}
	 }
	 else
	 {
		 echo 'Invalid request;';
		 }
			
	}
	
	
	public function removeDateMarking(){
		
	 $this->layout="newdefault";
	 $this->autoRender =false;
	 if($this->request->is('ajax')) {
	 $msg='';
		if (isset($this->request->query['params']) and $this->request->query['params']!="") {
		$params=trim($this->request->query['params'],'{   }');
		$ids=@explode(',',$params);
		if (!empty($ids)) {foreach($ids as $key=>$value) {
			
			if($this->cheackLead($value)==true)
			{ 
				$this->Enquiry->query("update  enquiries set marked_or_not='N' where id=".$value);
				$msg="Unmark Complete";
				}
				else
				{
					$msg="Not Exist";
					}
			
			
		}
		echo $msg;
			
		}
		
		}
	 }
	  else
	 {
		 echo 'Invalid request;';
		 }
	
	}

   public function deleteByAjax($id = null) {
	 if($this->request->is('ajax')) {
		 
		if ($this->Remark->exists($id))	
		 {
		$destinationorig  = realpath('../webroot/img/remarks/') . '/';
		$data=$this->Remark->findById($id);
		if($data['Remark']['other_info']!='' || $data['Remark']['other_info']!=null){
			 if(file_exists($destinationorig.$data['Remark']['other_info'])) { unlink($destinationorig.$data['Remark']['other_info']); }
			}
		if($this->Remark->delete($id)) {
			echo 'The remark has been deleted.';
		 }
		 else {
			echo 'The remark could not be deleted. Please, try again.';
		}
		 		 
			 }
		else {
			
			echo 'Invalid remark';
		} 
	 }
	 else {
			
			echo 'Invalid request';
		}
			 $this->autoRender=false;
			 $this->layout='newdefault';
		
	}
	
	///mobilesms////
 public function mobilesms() {
		if ($this->request->is('post')) {
			$this->Mobilesms->create();
			$this->request->data['Mobilesms']['posted_date']=date("Y-m-d H:i:s");
			if ($this->Mobilesms->save($this->request->data)) {
				$this->Session->setFlash(__('The remark has been saved.'));
				return $this->redirect(array('action' => 'mobilesmsview'));
			} else {
				$this->Session->setFlash(__('The remark could not be saved. Please, try again.'));
			}
		}
		if(CakeSession::read('User.type')==="regular") {
		 $enquiries = $this->Mobilesms->Enquiry->find('list',array('conditions'=>array('Enquiry.user_id' => CakeSession::read('User.id'),'Enquiry.status'=>'open')));
		}
		else {
			$enquiries = $this->Mobilesms->Enquiry->find('list',array('conditions'=>array('Enquiry.status'=>'open')));
		}
		$this->set(compact('enquiries'));
	}

 public function mobilesmsview() {
		$mobilesmss= $this->Mobilesms->find('all');
		$this->set('mobilesmss',$mobilesmss);
	}

public function mobilesmsedit($id = null) {
	    if (!$this->Mobilesms->exists($id)) {
			throw new NotFoundException(__('Invalid remark'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$this->request->data['Mobilesms']['posted_date']=date("Y-m-d H:i:s");
			if ($this->Mobilesms->save($this->request->data)) {
				$this->Session->setFlash(__('The Mobilesms has been saved.'));
				return $this->redirect(array('action' => 'mobilesmsview'));
			} else {
				$this->Session->setFlash(__('The remark could not be saved. Please, try again.'));
			}
			
			
		}
		else {
			$options = array('conditions' => array('Mobilesms.' . $this->Mobilesms->primaryKey => $id));
			$this->request->data = $this->Mobilesms->find('first', $options);
		}
		$enquiries = $this->Mobilesms->Enquiry->find('list');
		   $this->set(compact('enquiries'));
	}

 
 ///mobilesms////
 
	
///////////////////smsm //////////////
	
	public  function dailyReminderSms(){  
	
	if (!defined('CRON_DISPATCHER')) { $this->redirect('/'); exit(); }
	     
	$this->layout='ajax';
	$this->autoRender = false;
	$message='';
	$time = date("H:i:00");
	$date =date("Y-m-d");
	$userslist= $this->Mobilesms->find('all',array('conditions'=>array('Mobilesms.reminder_time'=>$time,'Mobilesms.reminder_date'=>$date)));
	if(!empty($userslist))
	
	{    
	
	    foreach($userslist as $key=>$value) {  
		  $message =$value['Mobilesms']['remark'];
	      $alldata=$this->User->find('all',array('conditions'=>array('User.id'=>$value['Mobilesms']['user_id'])));
		  foreach($alldata as $key2=>$value2) {
			$phonenum = $value2['User']['phone'] ;   
		  
		  
		  }
		}
		$debug=true;
		if($phonenum!=''){$this->Sms->smsSend($phonenum,$message,$debug);}
		echo "!! DAILY SMS STATUS SEND SUCCESSFULLY !!";
	   } else {
			
			
			}
		
	}
	
}
