<?php
App::uses('AppController', 'Controller');
/**
 * Meetings Controller
 *
 * @property Meeting $Meeting
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class MeetingsController extends AppController {

/**
 * Components
 *
 * @var array
 */ public $helpers = array('Time');
	public $components = array('Paginator','Session','Mail');
    var  $uses = array('Meeting','User','Enquiry','Project');
	
/**
 * index method
 *
 * @return void
 */
	public function index() {
		
		
		$searchUserId='';$condition='';$fromdate='';$todate='';
		if(isset($this->params->query['confirm'])) {
	    
		if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
		
		$searchKey=trim($this->request->query['search_key']);  $condition['OR']=array('Meeting.client_name LIKE'=>'%'.$searchKey.'%','Meeting.client_contact LIKE'=>'%'.$searchKey.'%'); 
    }
		if(isset($this->request->query['from_date']) and isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim($this->request->query['from_date']);
				$todate=trim($this->request->query['to_date']);
				$condition['AND']=array('date(Meeting.timing) >='=>$fromdate,'date(Meeting.timing) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim($this->request->query['from_date']);  
				$condition['date(Meeting.timing)']=$fromdate;		
				}
				else
				{
					
					}
			}
			
	if(isset($this->request->query['search_user']) and ($this->request->query['search_user']!=0) and ($this->request->query['search_user']!='')){ 
	  $searchUserId=trim($this->request->query['search_user']);
	 
	 if((CakeSession::read('User.type')!='regular')) 
	 { 
			$condition['Meeting.user_id']=$searchUserId;
		
		}	
		else
		{  
		if ($this->checkOnlyUser($searchUserId)==false) 
		 {
			throw new NotFoundException(__('Invalid enquiry'));
			}
			$condition['Meeting.user_id']=$searchUserId;
			}
	  }
		
		}
		else {
		if(CakeSession::read('User.type')==='regular'){
			$condition['Meeting.user_id']=CakeSession::read('User.id');
		}
		}
		
        $this->Paginator->settings = array('Meeting' => array('fields'=>array('Meeting.status','Meeting.id','Meeting.timing','Meeting.client_name','Meeting.client_contact','Meeting.meeting_place','Meeting.representative','Meeting.second_representative','Meeting.response','Meeting.form_received','Enquiry.name','User.username','Project.name'),'limit' =>20,'order' => array('id' => 'desc'),'conditions'=>$condition));
		$this->Meeting->recursive = 0;
		$projects = $this->Meeting->Project->find('list',array('order' => array('name' => 'asc')));
		$this->set('meetings', $this->Paginator->paginate());
		$users = $this->User->find('list',array('fields'=>array('parent'),'conditions'=>array('status'=>'active')));
		$this->set(compact('users'));
		//$log = $this->Enquiry->getDataSource()->getLog(false, false);
        //debug($log);
	}
	
	public function meetingStatusCounter($yesterday)
	  {
	  $res='';
	  $dataall=$this->Meeting->query("select status,count(*) as total from meetings where date(posted)='".$yesterday."' group by status");
	  if(empty($dataall))	 { $res='';}
	  else { foreach($dataall as $result)
	  {
	  $res.="<b>".ucfirst($result['meetings']['status'])."</b> : ".$result[0]['total']." , ";
	  }
	  }
	  
	  return $res;
	  }
	
	public function report($date=null) { 
		if($date) {
			$yesterday=$date;
			}
		else {
			$yesterday=date('Y-m-d',strtotime("-1 days"));
            $displaydata=date('l jS \of F Y',strtotime("-1 days"));
			}
		
		$searchUserId='';$condition='';$fromdate='';$todate='';
		$data='';
		
		$data = $this->Meeting->find('all',array('conditions'=>array('date(Meeting.posted)'=>$date),'Meeting.order' => array('Meeting.name' => 'asc')));
		//$log = $this->Meeting->getDataSource()->getLog(false, false);
        //debug($log);
//exit;
        if(!empty($data))	 {
		return $data;
		}
		//$this->set('data',$data);
		//$this->set('displaydata',$displaydata);
		//$this->set('yesterday',$yesterday);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		
		$projectName='';
		$countryName='';
		$userName='';
		$representative='';
		
		if (!$this->Enquiry->exists($id)) {
			throw new NotFoundException(__('Invalid Lead'));
		}
		if ($this->request->is('post')) {
			if (!$this->Enquiry->exists($id)) {
			throw new NotFoundException(__('Invalid Lead'));
		}
			$this->Meeting->create();
			$this->Meeting->data['Meeting']['posted']=date("Y-m-d H:i:s");
			$this->Meeting->data['Meeting']['feedBy']=CakeSession::read('User.id');
			if ($this->Meeting->save($this->request->data)) {
			
			
			$this->Enquiry->query("update enquiries set meeting_date='".$this->request->data['Meeting']['timing']."',is_meeting='".$this->request->data['Meeting']['status']."' where id=".$id);
				
			//$this->Enquiry->read(null,$id);
			//$this->Enquiry->set(array('meeting_date'=>$this->request->data['Meeting']['timing'],'is_meeting'=>$this->request->data['Meeting']['status']));
			//$this->Enquiry->save();
			
			
			$projectName=$this->Project->findById($this->request->data['Meeting']['project_id']);
			$userName=$this->User->findById($this->request->data['Meeting']['user_id']);
			$representative=$this->User->findById($this->request->data['Meeting']['representative']);
			//Array ( [month] => 12 [day] => 08 [year] => 2014 [hour] => 02 [min] => 39 [meridian] => pm ) 
			$timing=$this->request->data['Meeting']['timing']['year'].'-'.$this->request->data['Meeting']['timing']['month'].'-'.$this->request->data['Meeting']['timing']['day']." ".$this->request->data['Meeting']['timing']['hour'].":".$this->request->data['Meeting']['timing']['min']." ".$this->request->data['Meeting']['timing']['meridian'];
			
			
			
			
			
			
			$this->Mail->sendMeetingMail($this->request->data['Meeting']['enquiry_id'],$projectName['Project']['name'],$userName['User']['name'],$userName['User']['last_name'],$userName['User']['email'],addslashes($this->request->data['Meeting']['client_name']),addslashes($this->request->data['Meeting']['client_contact']),addslashes($this->request->data['Meeting']['meeting_place']),$representative['User']['name'],$representative['User']['email'],addslashes($this->request->data['Meeting']['status']),addslashes($this->request->data['Meeting']['response']),$timing);
			
			
			
			$this->Session->setFlash(__('The meeting has been saved.'));
			return $this->redirect(array('controller' => 'meetings','action' => 'view',$id));
			} 
			else {
			$this->Session->setFlash(__('The meeting could not be saved. Please, try again.'));
			}
		}
		$options = array('conditions' => array('Enquiry.' . $this->Enquiry->primaryKey => $id));
		$this->set('enquiry', $this->Enquiry->find('first', $options));
		$projects = $this->Project->find('list');
		$users = $this->Meeting->User->find('list',array('conditions'=>array('User.status'=>'active','User.type'=>'marketing'),'fields'=>array('id','username')));
		//$projects = $this->Project->find('list');
		$this->set(compact('projects','users'));
		$this->layout="sub-default";
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Meeting->create();
			if ($this->Meeting->save($this->request->data)) {
				$this->Session->setFlash(__('The meeting has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The meeting could not be saved. Please, try again.'));
			}
		}
		$enquiries = $this->Meeting->Enquiry->find('list');
		$users = $this->Meeting->User->find('list');
		$projects = $this->Meeting->Project->find('list');
		$this->set(compact('enquiries', 'users', 'projects'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Meeting->exists($id)) {
			throw new NotFoundException(__('Invalid meeting'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$this->Meeting->data['Meeting']['updated']=date("Y-m-d H:i:s");
			$this->Meeting->data['Meeting']['updateBy']=CakeSession::read('User.id');
			if ($this->Meeting->save($this->request->data) and !empty($this->request->data['Meeting']['enquiry_id'])) {
	//$this->Enquiry->query("update enquiries set meeting_date='".$this->request->data['Meeting']['timing']."',is_meeting='".$this->request->data['Meeting']['status']."' where id=".$id);
			
			$this->Enquiry->read(null,$this->request->data['Meeting']['enquiry_id']);
			$this->Enquiry->set(array('meeting_date'=>$this->request->data['Meeting']['timing'],'is_meeting'=>$this->request->data['Meeting']['status']));
			$this->Enquiry->save();
			
			
			
			if($this->request->data['Meeting']['send_mail']=='yes'){
			$projectName=$this->Project->findById($this->request->data['Meeting']['project_id']);
			$userName=$this->User->findById($this->request->data['Meeting']['user_id']);
			$representative=$this->User->findById($this->request->data['Meeting']['representative']);
			
			$timing=$this->request->data['Meeting']['timing']['year'].'-'.$this->request->data['Meeting']['timing']['month'].'-'.$this->request->data['Meeting']['timing']['day']." ".$this->request->data['Meeting']['timing']['hour'].":".$this->request->data['Meeting']['timing']['min']." ".$this->request->data['Meeting']['timing']['meridian'];
			
			
			$this->Mail->sendMeetingMail($this->request->data['Meeting']['enquiry_id'],$projectName['Project']['name'],$userName['User']['name'],$userName['User']['last_name'],$userName['User']['email'],addslashes($this->request->data['Meeting']['client_name']),addslashes($this->request->data['Meeting']['client_contact']),addslashes($this->request->data['Meeting']['meeting_place']),$representative['User']['name'],$representative['User']['email'],addslashes($this->request->data['Meeting']['status']),addslashes($this->request->data['Meeting']['response']),$timing);
			}
			
				$this->Session->setFlash(__('The meeting has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The meeting could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Meeting.' . $this->Meeting->primaryKey => $id));
			$this->request->data = $this->Meeting->find('first', $options);
		}
		$enquiries = $this->Meeting->Enquiry->find('list');
		$users = $this->Meeting->User->find('list',array('conditions'=>array('User.status'=>'active','User.type'=>'marketing'),'fields'=>array('id','username')));
		$projects = $this->Meeting->Project->find('list',array('order' => array('name' => 'asc')));
		$this->set(compact('enquiries', 'users', 'projects'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Session->setFlash(__('The meeting could not be deleted.'));
		return $this->redirect(array('action' => 'index'));
	}
	
	private function checkOnlyUser($id) {
		
		if(CakeSession::read('User.type')==="regular") {
		$thisdata=$this->User->find("first",array('fields'=>'parent','conditions'=>array('User.id' => $id)));
		if(CakeSession::read('User.id')==$id)
		{  return true; }
		else if(CakeSession::read('User.id')===$thisdata['User']['parent'])
		{   return true; }	
		else
		{
			return false;
			}
		}
		else
		{
			return true;
			}
		
		
	}
	
	
}
