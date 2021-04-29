<?php
App::uses('AppController', 'Controller');
/**
 * Enquiries Controller
 *
 * @property Enquiry $Enquiry
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class EnquiriesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'Pagination','Mail','Sms','Upload');
	var  $uses = array('Enquiry','Builder','User','Menuheader','Menu','Remark','Project','Country','DailyReport','LeadSource','CrmGroup','CrmUser','CloseReason');
/**
 * index method
 *
 * @return void
 */   
	public function export(){$data='';$searchKey=null;$searchUserId=null;$searchCountryId=null;$searchBuilderId=null;$searchProjectId=null;
		$searchStatus=null;$pages=null;$condition='';$querySrting=''; $condition=array();$condition2='';
		$conc='';
		//$username=$this->User->findById(CakeSession::read('User.id'));
		if(isset($this->params->query['confirm'])) {
	   
		if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
		
		$searchKey=trim($this->request->query['search_key']);  
		/*$condition['OR']=array('Enquiry.id LIKE'=>'%'.$searchKey.'%','Enquiry.name LIKE'=>'%'.$searchKey.'%',
'Enquiry.email LIKE'=>'%'.$searchKey.'%','Enquiry.contact LIKE'=>'%'.$searchKey.'%'); */
    $condition2.=' and Enquiry.id LIKE %'.$searchKey.'% || Enquiry.name LIKE %'.$searchKey.'% || Enquiry.email LIKE %'.$searchKey.'% || Enquiry.contact LIKE %'.$searchKey.'%';
	
	}
	
	if(isset($this->request->query['hot_lead']) and ($this->request->query['hot_lead']=='Y')){
		  $hotlead=trim($this->request->query['hot_lead']);  
		  $condition2.=' and date(Enquiry.hot_lead)="'.$hotlead.'"';
		//$condition2.=' and Enquiry.country_id='.$searchCountryId;
		}
	
	
	if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim($this->request->query['from_date']);
				$todate=trim($this->request->query['to_date']);
				$condition2.=' and date(Enquiry.posted_date)>="'.$fromdate.'" and date(Enquiry.posted_date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim($this->request->query['from_date']);  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(Enquiry.posted_date)="'.$fromdate.'"';
				}
				else
				{
					
					}
			}
			
			
		
		if(isset($this->request->query['search_country']) and ($this->request->query['search_country']!=0) and ($this->request->query['search_country']!='')){$searchCountryId=trim($this->request->query['search_country']);  //$condition['Enquiry.country_id']=$searchCountryId;
		$condition2.=' and Enquiry.country_id='.$searchCountryId;
		
		}
		
		if(isset($this->request->query['search_builder']) and ($this->request->query['search_builder']!=0) and ($this->request->query['search_builder']!='')){$searchBuilderId=trim($this->request->query['search_builder']); //$condition['Enquiry.builder_id']=$searchBuilderId;
		$condition2.=' and Enquiry.builder_id='.$searchBuilderId;
		}
		
		if(isset($this->request->query['search_project']) and ($this->request->query['search_project']!=0) and ($this->request->query['search_project']!='')){$searchProjectId=trim($this->request->query['search_project']); //$condition['Enquiry.project_id']=$searchProjectId;
		$condition2.=' and Enquiry.project_id='.$searchProjectId;
		}
		
		if(isset($this->request->query['close_reasons']) and ($this->request->query['close_reasons']!=0) and ($this->request->query['close_reasons']!='')){$searchReasonId=trim($this->request->query['close_reasons']);  //$condition['Enquiry.close_reason_id']=$searchReasonId;
		$condition2.=' and Enquiry.close_reason_id='.$searchReasonId;
		}
		
		if(isset($this->request->query['lead_source_id']) and ($this->request->query['lead_source_id']!=0) and ($this->request->query['lead_source_id']!='')){$lead_source_id=trim($this->request->query['lead_source_id']);  //$condition['Enquiry.lead_source_id']=$lead_source_id;
		$condition2.=' and Enquiry.lead_source_id='.$lead_source_id;
		}
		
		if(isset($this->request->query['search_status']) and ($this->request->query['search_status']!='')){$searchStatus=trim($this->request->query['search_status']);  //$condition['Enquiry.status']=$searchStatus;
		$condition2.=' and Enquiry.status="'.$searchStatus.'"';
		}	
		
		if(isset($this->request->query['search_user']) and ($this->request->query['search_user']!='' || $this->request->query['search_user']!=0) and (CakeSession::read('User.type')!='regular'))
		{   
		    $searchUserId=trim($this->request->query['search_user']);
			$condition2.=' and Enquiry.user_id='.$searchUserId;
		}
		
		if(isset($this->request->query['search_user']) and ($this->request->query['search_user']!='' || $this->request->query['search_user']!=0) and (CakeSession::read('User.type')=='regular'))
		{   
		    $searchUserId=trim($this->request->query['search_user']);
			if ($this->checkOnlyUser($searchUserId)==false) {
			throw new NotFoundException(__('Invalid enquiry'));
		}	
		 $condition2.=' and Enquiry.user_id='.$searchUserId;
		 }
		 
		 if(isset($this->request->query['search_user']) and ($this->request->query['search_user']=='' || $this->request->query['search_user']==0) and (CakeSession::read('User.type')=='regular'))
		{
		$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
		}
		
		if(!isset($this->request->query['search_user']) and (CakeSession::read('User.type')=='regular'))
		{
		$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
		}
		}
		else {
		if(CakeSession::read('User.type')==='regular'){
			$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
			//$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
				
		}
		else {
		
		}
		}
		//$condition['NOT']=array('Enquiry.status'=>"trash");
		$condition2.=' and Enquiry.status!="trash"';
		$this->response->download("data.csv");
		//print_r($condition); exit;
		$data=$this->Enquiry->query('select Enquiry.id,Enquiry.posted_date,Enquiry.name,Enquiry.email,Enquiry.contact,Project.name,Country.name,Enquiry.status,LeadSource.name from enquiries as Enquiry left join users as User on Enquiry.user_id=User.id left join projects as Project  on Enquiry.project_id=Project.id left join countries as Country   on Enquiry.country_id=Country.id left join lead_sources as LeadSource  on Enquiry.lead_source_id=LeadSource.id  where 1 '.$condition2 );
		
		
		//$data = $this->Enquiry->find('all', array('fields'=>array('Enquiry.id','Posted On' => 'Posted On','Enquiry.name','Enquiry.email','Enquiry.contact','Project.name','Country.name','Enquiry.status','LeadSource.name'),'order' => array('id' => 'desc'),'conditions'=>$condition));
		
		//$log = $this->Enquiry->getDataSource()->getLog(false, false);
        //debug($log);
		//exit;
		
	$headers = array('Enquiry'=>array( 'Id' => 'Id','Posted On' => 'Posted On', 'Name' => 'Name', 'Email' => 'Email', 'Contact' => 'Contact', 'Project' => 'Project', 'Country' => 'Country', 'Status' => 'Status', 'Lead Source' => 'Lead Source', 'Remark 3' => 'Remark 3', 'Remark 2' => 'Remark 2', 'Remark 1' => 'Remark 1')); 
	    $this->set(compact('data','headers'));
		$this->layout = 'ajax';
		return;
		
		}



  public function export_remark(){$data='';$searchKey=null;$searchUserId=null;$searchCountryId=null;$searchBuilderId=null;$searchProjectId=null;
		$searchStatus=null;$pages=null;$condition='';$querySrting=''; $condition=array();$condition2='';
		$conc='';
		//$username=$this->User->findById(CakeSession::read('User.id'));
		if(isset($this->params->query['confirm'])) {
	   
		if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
		
		$searchKey=trim($this->request->query['search_key']);  
		/*$condition['OR']=array('Enquiry.id LIKE'=>'%'.$searchKey.'%','Enquiry.name LIKE'=>'%'.$searchKey.'%',
'Enquiry.email LIKE'=>'%'.$searchKey.'%','Enquiry.contact LIKE'=>'%'.$searchKey.'%'); */
    $condition2.=' and Enquiry.id LIKE %'.$searchKey.'% || Enquiry.name LIKE %'.$searchKey.'% || Enquiry.email LIKE %'.$searchKey.'% || Enquiry.contact LIKE %'.$searchKey.'%';
	
	}
	
	if(isset($this->request->query['hot_lead']) and ($this->request->query['hot_lead']=='Y')){
		  $hotlead=trim($this->request->query['hot_lead']);  
		  $condition2.=' and date(Enquiry.hot_lead)="'.$hotlead.'"';
		//$condition2.=' and Enquiry.country_id='.$searchCountryId;
		}
	
	
	if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim($this->request->query['from_date']);
				$todate=trim($this->request->query['to_date']);
				$condition2.=' and date(Enquiry.posted_date)>="'.$fromdate.'" and date(Enquiry.posted_date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim($this->request->query['from_date']);  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(Enquiry.posted_date)="'.$fromdate.'"';
				}
				else
				{
					
					}
			}
			
			
		
		if(isset($this->request->query['search_country']) and ($this->request->query['search_country']!=0) and ($this->request->query['search_country']!='')){$searchCountryId=trim($this->request->query['search_country']);  //$condition['Enquiry.country_id']=$searchCountryId;
		$condition2.=' and Enquiry.country_id='.$searchCountryId;
		
		}
		
		if(isset($this->request->query['search_builder']) and ($this->request->query['search_builder']!=0) and ($this->request->query['search_builder']!='')){$searchBuilderId=trim($this->request->query['search_builder']); //$condition['Enquiry.builder_id']=$searchBuilderId;
		$condition2.=' and Enquiry.builder_id='.$searchBuilderId;
		}
		
		if(isset($this->request->query['search_project']) and ($this->request->query['search_project']!=0) and ($this->request->query['search_project']!='')){$searchProjectId=trim($this->request->query['search_project']); //$condition['Enquiry.project_id']=$searchProjectId;
		$condition2.=' and Enquiry.project_id='.$searchProjectId;
		}
		
		if(isset($this->request->query['close_reasons']) and ($this->request->query['close_reasons']!=0) and ($this->request->query['close_reasons']!='')){$searchReasonId=trim($this->request->query['close_reasons']);  //$condition['Enquiry.close_reason_id']=$searchReasonId;
		$condition2.=' and Enquiry.close_reason_id='.$searchReasonId;
		}
		
		if(isset($this->request->query['lead_source_id']) and ($this->request->query['lead_source_id']!=0) and ($this->request->query['lead_source_id']!='')){$lead_source_id=trim($this->request->query['lead_source_id']);  //$condition['Enquiry.lead_source_id']=$lead_source_id;
		$condition2.=' and Enquiry.lead_source_id='.$lead_source_id;
		}
		
		if(isset($this->request->query['search_status']) and ($this->request->query['search_status']!='')){$searchStatus=trim($this->request->query['search_status']);  //$condition['Enquiry.status']=$searchStatus;
		$condition2.=' and Enquiry.status="'.$searchStatus.'"';
		}	
		
		if(isset($this->request->query['search_user']) and ($this->request->query['search_user']!='' || $this->request->query['search_user']!=0) and (CakeSession::read('User.type')!='regular'))
		{   
		    $searchUserId=trim($this->request->query['search_user']);
			$condition2.=' and Enquiry.user_id='.$searchUserId;
		}
		
		if(isset($this->request->query['search_user']) and ($this->request->query['search_user']!='' || $this->request->query['search_user']!=0) and (CakeSession::read('User.type')=='regular'))
		{   
		    $searchUserId=trim($this->request->query['search_user']);
			if ($this->checkOnlyUser($searchUserId)==false) {
			throw new NotFoundException(__('Invalid enquiry'));
		}	
		 $condition2.=' and Enquiry.user_id='.$searchUserId;
		 }
		 
		 if(isset($this->request->query['search_user']) and ($this->request->query['search_user']=='' || $this->request->query['search_user']==0) and (CakeSession::read('User.type')=='regular'))
		{
		$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
		}
		
		if(!isset($this->request->query['search_user']) and (CakeSession::read('User.type')=='regular'))
		{
		$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
		}
		}
		else {
		if(CakeSession::read('User.type')==='regular'){
			$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
			//$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
				
		}
		else {
		
		}
		}
		//$condition['NOT']=array('Enquiry.status'=>"trash");
		$condition2.=' and Enquiry.status!="trash"';
		$this->response->download("data.csv");
		//print_r($condition); exit;
		$data=$this->Enquiry->query('select Enquiry.id,Enquiry.user_id,Enquiry.posted_date,Enquiry.name,Enquiry.email,Enquiry.contact,Project.name,Country.name,Enquiry.status,LeadSource.name from enquiries as Enquiry left join users as User on Enquiry.user_id=User.id left join projects as Project  on Enquiry.project_id=Project.id left join countries as Country   on Enquiry.country_id=Country.id left join lead_sources as LeadSource  on Enquiry.lead_source_id=LeadSource.id  where 1 '.$condition2 );
		
		
		//$data = $this->Enquiry->find('all', array('fields'=>array('Enquiry.id','Posted On' => 'Posted On','Enquiry.name','Enquiry.email','Enquiry.contact','Project.name','Country.name','Enquiry.status','LeadSource.name'),'order' => array('id' => 'desc'),'conditions'=>$condition));
		
		//$log = $this->Enquiry->getDataSource()->getLog(false, false);
        //debug($log);
		//exit;
		
	$headers = array('Enquiry'=>array( 'Id' => 'Id','Executive Name' => 'Executive Name','Posted On' => 'Posted On', 'Name' => 'Name', 'Email' => 'Email', 'Contact' => 'Contact', 'Project' => 'Project', 'Country' => 'Country', 'Status' => 'Status', 'Lead Source' => 'Lead Source', 'Remark 3' => 'Remark 3', 'Remark 2' => 'Remark 2', 'Remark 1' => 'Remark 1')); 
	    $this->set(compact('data','headers'));
		$this->layout = 'ajax';
		return;
		
		}
		
	public function index() {
		$data='';$searchKey=null;$searchUserId=null;$searchCountryId=null;$searchBuilderId=null;$searchProjectId=null;$fromdate=null;$todate=null;$movedfrom="";
		$searchStatus=null;$pages=null;$condition='';$querySrting=''; $condition=array();
		$conc='';$conditionencrypt='';
		
		if(isset($this->params->query['confirm'])) {
	    
		if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
		
		  $searchKey=trim($this->request->query['search_key']); 
		  $condition['OR']=array('Enquiry.id LIKE'=>'%'.$searchKey.'%','Enquiry.name LIKE'=>'%'.$searchKey.'%','Enquiry.email LIKE'=>'%'.$searchKey.'%','Enquiry.contact LIKE'=>'%'.$searchKey.'%'); 
		 
		  /*$condition2.=' and Enquiry.id LIKE %'.$searchKey.'% || Enquiry.name LIKE %'.$searchKey.'% || Enquiry.email LIKE %'.$searchKey.'% || Enquiry.contact LIKE %'.$searchKey.'%';*/
    }
	
	   if(isset($this->request->query['hot_lead']) and ($this->request->query['hot_lead']=='Y')){
		   $hotlead=trim($this->request->query['hot_lead']);  
		   $condition['Enquiry.hot_lead']=$hotlead;
		//$condition2.=' and Enquiry.country_id='.$searchCountryId;
		}
		
		
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
		
		
		if(isset($this->request->query['search_country']) and ($this->request->query['search_country']!=0) and ($this->request->query['search_country']!='')){$searchCountryId=trim($this->request->query['search_country']);  
		$condition['Enquiry.country_id']=$searchCountryId;
		//$condition2.=' and Enquiry.country_id='.$searchCountryId;
		}
		
		if(isset($this->request->query['moved_from']) and ((int)trim($this->request->query['moved_from'])!=0) and (trim($this->request->query['moved_from'])!='')){$moved_from=(int)trim($this->request->query['moved_from']);
		 
		$condition['Enquiry.lead_of']=$moved_from;
		$condition['NOT'][]=array('Enquiry.user_id'=>$moved_from);
		
		//$condition2.=' and Enquiry.country_id='.$searchCountryId;
		}
		
		if(isset($this->request->query['search_builder']) and ($this->request->query['search_builder']!=0) and ($this->request->query['search_builder']!='')){$searchBuilderId=trim($this->request->query['search_builder']); $condition['Enquiry.builder_id']=$searchBuilderId;
		//$condition2.=' and Enquiry.builder_id='.$searchBuilderId;
		}
		
		if(isset($this->request->query['search_project']) and ($this->request->query['search_project']!=0) and ($this->request->query['search_project']!='')){$searchProjectId=trim($this->request->query['search_project']); $condition['Enquiry.project_id']=$searchProjectId;
		//$condition2.=' and Enquiry.project_id='.$searchProjectId;
		}
		
		if(isset($this->request->query['close_reasons']) and ($this->request->query['close_reasons']!=0) and ($this->request->query['close_reasons']!='')){$searchReasonId=trim($this->request->query['close_reasons']);  $condition['Enquiry.close_reason_id']=$searchReasonId;
		//$condition2.=' and Enquiry.close_reason_id='.$searchReasonId;
		}
		
		if(isset($this->request->query['lead_source_id']) and ($this->request->query['lead_source_id']!=0) and ($this->request->query['lead_source_id']!='')){$lead_source_id=trim($this->request->query['lead_source_id']);  $condition['Enquiry.lead_source_id']=$lead_source_id;
		//$condition2.=' and Enquiry.lead_source_id='.$lead_source_id;
		}
		
		if(isset($this->request->query['search_status']) and ($this->request->query['search_status']!='')){$searchStatus=trim($this->request->query['search_status']);  $condition['Enquiry.status']=$searchStatus;
		//$condition2.=' and Enquiry.status="'.$searchStatus.'"';
		}
		
     if(isset($this->request->query['search_user']) and ($this->request->query['search_user']!='' || $this->request->query['search_user']!=0) and (CakeSession::read('User.type')!='regular'))
		{   
		    $searchUserId=trim($this->request->query['search_user']);
			$condition['Enquiry.user_id']=$searchUserId;
			$pending['Enquiry.user_id']=$searchUserId;
		}	
		
		if(isset($this->request->query['search_user']) and ($this->request->query['search_user']!='' || $this->request->query['search_user']!=0) and (CakeSession::read('User.type')=='regular'))
		{   
		    $searchUserId=trim($this->request->query['search_user']);
			if ($this->checkOnlyUser($searchUserId)==false) {
			throw new NotFoundException(__('Invalid enquiry'));
		}	
		 $condition['Enquiry.user_id']=$searchUserId;
		 $pending['Enquiry.user_id']=$searchUserId;
		 }
		 
		 if(isset($this->request->query['search_user']) and ($this->request->query['search_user']=='' || $this->request->query['search_user']==0) and (CakeSession::read('User.type')=='regular'))
		{
		$condition['Enquiry.user_id']=CakeSession::read('User.id');
		$condition['NOT']=array('Enquiry.marked_or_not'=>'Y');
		$pending['Enquiry.user_id']=CakeSession::read('User.id');
		$pending['NOT']=array('Enquiry.marked_or_not'=>'Y');
		}
		
		if(!isset($this->request->query['search_user']) and (CakeSession::read('User.type')=='regular'))
		{
		$condition['Enquiry.user_id']=CakeSession::read('User.id');
		$pending['Enquiry.user_id']=CakeSession::read('User.id');
		}
		}
		
		else {
		if(CakeSession::read('User.type')==='regular'){
			$condition['Enquiry.user_id']=CakeSession::read('User.id');
			$condition['date(Enquiry.posted_date)']=date('Y-m-d');
			//$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
				
		}
		else {
		$condition['date(Enquiry.posted_date)']=date('Y-m-d');
		}
		}
		
		if(CakeSession::read('User.type')==='regular')
		{
			 $movedfrom=$this->Enquiry->query("select e.lead_of,u.name,u.last_name,u.colorcode from enquiries as e join users as u on e.lead_of=u.id where e.user_id=".CakeSession::read('User.id')." and  e.lead_of!=e.user_id and e.status='open' group by e.lead_of");
			
		}
		else {
			
			$movedfrom=$this->Enquiry->query("select e.lead_of,u.name,u.last_name,u.colorcode from enquiries as e join users as u on e.lead_of=u.id where e.lead_of!=e.user_id and e.status='open' group by e.lead_of");
			
			}

		//$condition['NOT']=array('Enquiry.status'=>"trash");
		$condition['NOT'][]=array('Enquiry.status'=>"trash");
		//$condition2.=' and Enquiry.status!="trash"';
		
		$this->Paginator->settings = array('Enquiry' => array('fields'=>array('Enquiry.status','Enquiry.hot_lead','CloseReason.name','LeadSource.name','Enquiry.name','LeadSource.flag','User.username','User.colorcode','User.parent','Enquiry.posted_date','Enquiry.email','Builder.name','Project.name','Country.name','Enquiry.is_discrepency','Enquiry.id','Enquiry.reminder_date','Enquiry.is_reminder','Enquiry.user_id','Enquiry.is_meeting','Enquiry.contact','Enquiry.lead_of','Enquiry.marked_or_not'),'limit' =>10,'order' => array('id' => 'desc'),'conditions'=>$condition));
		//$conditionencrypt = $this->Enquiry->find('sql', array('conditions'=>$condition));
		$this->Enquiry->recursive = 0;
		$this->set('enquiries', $this->Paginator->paginate());
		
		$this->set('movedfrom', $movedfrom);
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
	












	public function dubai() {
		$data='';$searchKey=null;$searchUserId=null;$searchCountryId=null;$searchBuilderId=null;$searchProjectId=null;$fromdate=null;$todate=null;
		$searchStatus=null;$pages=null;$condition='';$querySrting=''; $condition=array();
		$conc='';$conditionencrypt='';
		
		if(isset($this->params->query['confirm'])) {
	    
		if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
		
		  $searchKey=trim($this->request->query['search_key']); 
		  $condition['OR']=array('Enquiry.id LIKE'=>'%'.$searchKey.'%','Enquiry.name LIKE'=>'%'.$searchKey.'%','Enquiry.email LIKE'=>'%'.$searchKey.'%','Enquiry.contact LIKE'=>'%'.$searchKey.'%'); 
		 
		  /*$condition2.=' and Enquiry.id LIKE %'.$searchKey.'% || Enquiry.name LIKE %'.$searchKey.'% || Enquiry.email LIKE %'.$searchKey.'% || Enquiry.contact LIKE %'.$searchKey.'%';*/
    }
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
		
		
		$condition['Enquiry.country_id']=6;
		//$condition2.=' and Enquiry.country_id='.$searchCountryId;
		
		if(isset($this->request->query['search_builder']) and ($this->request->query['search_builder']!=0) and ($this->request->query['search_builder']!='')){$searchBuilderId=trim($this->request->query['search_builder']); $condition['Enquiry.builder_id']=$searchBuilderId;
		//$condition2.=' and Enquiry.builder_id='.$searchBuilderId;
		}
		
		if(isset($this->request->query['search_project']) and ($this->request->query['search_project']!=0) and ($this->request->query['search_project']!='')){$searchProjectId=trim($this->request->query['search_project']); $condition['Enquiry.project_id']=$searchProjectId;
		//$condition2.=' and Enquiry.project_id='.$searchProjectId;
		}
		
		if(isset($this->request->query['close_reasons']) and ($this->request->query['close_reasons']!=0) and ($this->request->query['close_reasons']!='')){$searchReasonId=trim($this->request->query['close_reasons']);  $condition['Enquiry.close_reason_id']=$searchReasonId;
		//$condition2.=' and Enquiry.close_reason_id='.$searchReasonId;
		}
		
		if(isset($this->request->query['lead_source_id']) and ($this->request->query['lead_source_id']!=0) and ($this->request->query['lead_source_id']!='')){$lead_source_id=trim($this->request->query['lead_source_id']);  $condition['Enquiry.lead_source_id']=$lead_source_id;
		//$condition2.=' and Enquiry.lead_source_id='.$lead_source_id;
		}
		
		if(isset($this->request->query['search_status']) and ($this->request->query['search_status']!='')){$searchStatus=trim($this->request->query['search_status']);  $condition['Enquiry.status']=$searchStatus;
		//$condition2.=' and Enquiry.status="'.$searchStatus.'"';
		}
		
     if(isset($this->request->query['search_user']) and ($this->request->query['search_user']!='' || $this->request->query['search_user']!=0) and (CakeSession::read('User.type')!='regular'))
		{   
		    $searchUserId=trim($this->request->query['search_user']);
			$condition['Enquiry.user_id']=$searchUserId;
			$pending['Enquiry.user_id']=$searchUserId;
		}	
		
		if(isset($this->request->query['search_user']) and ($this->request->query['search_user']!='' || $this->request->query['search_user']!=0) and (CakeSession::read('User.type')=='regular'))
		{   
		    $searchUserId=trim($this->request->query['search_user']);
			if ($this->checkOnlyUser($searchUserId)==false) {
			throw new NotFoundException(__('Invalid enquiry'));
		}	
		 $condition['Enquiry.user_id']=$searchUserId;
		 $pending['Enquiry.user_id']=$searchUserId;
		 }
		 
		 if(isset($this->request->query['search_user']) and ($this->request->query['search_user']=='' || $this->request->query['search_user']==0) and (CakeSession::read('User.type')=='regular'))
		{
		$condition['Enquiry.user_id']=CakeSession::read('User.id');
		$pending['Enquiry.user_id']=CakeSession::read('User.id');
		}
		
		if(!isset($this->request->query['search_user']) and (CakeSession::read('User.type')=='regular'))
		{
		$condition['Enquiry.user_id']=CakeSession::read('User.id');
		$pending['Enquiry.user_id']=CakeSession::read('User.id');
		}
		}
		
		else {
		if(CakeSession::read('User.type')==='regular'){
			$condition['Enquiry.user_id']=CakeSession::read('User.id');
			$condition['date(Enquiry.posted_date)']=date('Y-m-d');
			//$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
				
		}
		else {
		$condition['date(Enquiry.posted_date)']=date('Y-m-d');
		}
		$condition['Enquiry.country_id']=6;
		}

		$condition['NOT']=array('Enquiry.status'=>"trash");
		//$condition2.=' and Enquiry.status!="trash"';
		
		$this->Paginator->settings = array('Enquiry' => array('fields'=>array('Enquiry.status','CloseReason.name','LeadSource.name','Enquiry.name','LeadSource.flag','User.username','User.parent','Enquiry.posted_date','Enquiry.email','Builder.name','Project.name','Country.name','Enquiry.is_discrepency','Enquiry.id','Enquiry.reminder_date','Enquiry.is_reminder','Enquiry.user_id','Enquiry.is_meeting','Enquiry.contact'),'limit' =>10,'order' => array('id' => 'desc'),'conditions'=>$condition));
		//$conditionencrypt = $this->Enquiry->find('sql', array('conditions'=>$condition));
		$this->Enquiry->recursive = 0;
		$this->set('enquiries', $this->Paginator->paginate());

		//$users = $this->Enquiry->User->find('all',array('fields'=>array('id','name','username','parent'),'conditions'=>array('status'=>'active')));
		$users = $this->User->find('list',array('fields'=>array('parent'),'conditions'=>array('status'=>'active')));
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
	
	public function currentReminders() {
		
		
		
		$data='';$searchUserId=null;$pages=null;$condition='';$pending='';$querySrting=''; $condition=array();$reminderDate=date('Y-m-d');$lastreminderDate=date('Y-m-d');
		$conc='';
		
		if(isset($this->params->query['confirm'])) {
			
			if(isset($this->request->query['from_date']) and $this->request->query['from_date']!=''){
				
			$reminderDate=$this->request->query['from_date'];
				
			}
			
	   
	    if(isset($this->request->query['search_user']) and ($this->request->query['search_user']!='' || $this->request->query['search_user']!=0) and (CakeSession::read('User.type')!='regular'))
		{   
		    $searchUserId=trim($this->request->query['search_user']);
			$condition['Enquiry.user_id']=$searchUserId;
			$pending['Enquiry.user_id']=$searchUserId;
		}	
		
		else if(isset($this->request->query['search_user']) and ($this->request->query['search_user']!='' || $this->request->query['search_user']!=0) and (CakeSession::read('User.type')=='regular'))
		{   
		    $searchUserId=trim($this->request->query['search_user']);
			if ($this->checkOnlyUser($searchUserId)==false) {
			throw new NotFoundException(__('Invalid enquiry'));

		}	

		 $condition['Enquiry.user_id']=$searchUserId;
		 $pending['Enquiry.user_id']=$searchUserId;
		 }
		 
		 else if(isset($this->request->query['search_user']) and ($this->request->query['search_user']=='' || $this->request->query['search_user']==0) and (CakeSession::read('User.type')=='regular'))
		{
		$condition['Enquiry.user_id']=CakeSession::read('User.id');
		$pending['Enquiry.user_id']=CakeSession::read('User.id');
		}
		
		else if(!isset($this->request->query['search_user']) and (CakeSession::read('User.type')=='regular'))
		{
		$condition['Enquiry.user_id']=CakeSession::read('User.id');
		$pending['Enquiry.user_id']=CakeSession::read('User.id');
		}
		 
		}
		else {
		if(CakeSession::read('User.type')==='regular'){	
		$condition['Enquiry.user_id']=CakeSession::read('User.id');
		$pending['Enquiry.user_id']=CakeSession::read('User.id');
		}
		else {
		//$pending['Enquiry.user_id']=CakeSession::read('User.id');
		}
		}
		//$condition['date(Enquiry.reminder_date)']=$reminderDate;
		$condition['Enquiry.status']='open';
		$condition['OR']=array('date(Enquiry.reminder_date)'=>$reminderDate,'date(Enquiry.last_reminder_update_date)'=>$reminderDate);
		
		$pending['OR']=array('date(Enquiry.reminder_date) < '=>$reminderDate,'date(Enquiry.reminder_date)'=>'0000-00-00 00:00:00');
		$pending['Enquiry.status']='open';
		//$pending['Enquiry.is_reminder']='yes';
		$this->Paginator->settings = array('Enquiry' => array('fields'=>array('Enquiry.last_reminder_update_date','Enquiry.name','User.username','User.name','User.parent','Enquiry.posted_date','Enquiry.email','Builder.name','Project.name','Project.id','Country.name','Country.id','Enquiry.is_discrepency','Enquiry.id','Enquiry.reminder_date','Enquiry.is_reminder','Enquiry.user_id','Enquiry.is_meeting','Enquiry.contact'),'limit' =>20,'order' => array('id' => 'desc'),'conditions'=>$condition));
		$this->Enquiry->recursive = 0;
		$this->set('enquiries', $this->Paginator->paginate());
		
		
		if(CakeSession::read('User.type')==='regular' || (isset($this->request->query['search_user']) and $this->request->query['search_user']!=0 and $this->request->query['search_user']!='')){	

		$this->set('pending', $this->Enquiry->find('all',array('fields'=>array('Enquiry.last_reminder_update_date','Enquiry.name','User.username','User.name','User.parent','Enquiry.posted_date','Enquiry.email','Builder.name','Project.name','Project.id','Country.name','Country.id','Enquiry.is_discrepency','Enquiry.id','Enquiry.reminder_date','Enquiry.is_reminder','Enquiry.user_id','Enquiry.is_meeting','Enquiry.contact'),'conditions'=>$pending)));
		
        }
		
		$users = $this->User->find('list',array('fields'=>array('parent'),'conditions'=>array('status'=>'active')));
		$this->set('users',$users);
		
		//$log = $this->Enquiry->getDataSource()->getLog(false, false);
        //debug($log);
		
		///// testing mail       
		
		
		
		 
	}
	
	public function currentExport() {
		
		$data='';$searchUserId=null;$pages=null;$condition='';$querySrting=''; $condition=array();
		$conc='';$reminderDate=date('Y-m-d');$searchUserId=CakeSession::read('User.id');
		//$username=$this->User->findById(CakeSession::read('User.id'));
	
	    
		//$username=$this->User->findById($searchUserId);
		
		if(isset($this->request->query['from_date']) and $this->request->query['from_date']!='')
		{
		$reminderDate=$this->request->query['from_date'];
		}	
	    if(isset($this->request->query['search_user']) and trim($this->request->query['search_user'])!=0)
		{ 
		if(CakeSession::read('User.type')==='regular'){	
		$condition['Enquiry.user_id']=CakeSession::read('User.id');
		}
		else {	
		$condition['Enquiry.user_id']=trim($this->request->query['search_user']);
		}
		}
		$condition['Enquiry.status']='open';
		//$condition['Enquiry.status']='open';
		$condition['date(Enquiry.reminder_date)']=$reminderDate;
		$this->response->download("reminders.csv");
		$data = $this->Enquiry->find('all', array('fields'=>array('Enquiry.id','Enquiry.name','Enquiry.email','Enquiry.contact','Project.name','Country.name','Enquiry.status','LeadSource.name'),'order' => array('id' => 'desc'),'conditions'=>$condition));
		
		//print_r($data); 
		
		//$log = $this->Enquiry->getDataSource()->getLog(false, false);
        //debug($log); 
		//exit;
	$headers = array('Enquiry'=>array( 'Id' => 'Id', 'Name' => 'Name', 'Email' => 'Email', 'Contact' => 'Contact', 'Project' => 'Project', 'Country' => 'Country', 'Status' => 'Status', 'Lead Source' => 'Lead Source', 'Remark' => 'Remark')); 
	    $this->set(compact('data','headers'));
		$this->layout = 'ajax';
		return;
	
	}
	
	public function pendingExport() {
		
		$data='';$searchUserId=null;$pages=null;$condition='';$querySrting=''; $condition=array();
		$conc='';$searchUserId=CakeSession::read('User.id');
		//$username=$this->User->findById(CakeSession::read('User.id'));
	    
		//$username=$this->User->findById($searchUserId);
			
	    if(isset($this->request->query['search_user']) and trim($this->request->query['search_user'])!=0)
		{ 
		if(CakeSession::read('User.type')==='regular'){	
		$condition['Enquiry.user_id']=CakeSession::read('User.id');
		}
		else {	
		$condition['Enquiry.user_id']=trim($this->request->query['search_user']);
		}
		}
		$condition['NOT']=array('Enquiry.status'=>"trash");
		$condition['Enquiry.status']='open';
		$condition['date(Enquiry.reminder_date) <']=date('Y-m-d');

		$this->response->download("pendingreminders.csv");
		$data = $this->Enquiry->find('all', array('fields'=>array('Enquiry.id','Enquiry.name','Enquiry.email','Enquiry.contact','Enquiry.reminder_date','Project.name','Country.name','Enquiry.status','LeadSource.name'),'order' => array('id' => 'desc'),'conditions'=>$condition));
		
		//$log = $this->Enquiry->getDataSource()->getLog(false, false);
        //debug($log); 
		//exit;
	$headers = array('Enquiry'=>array( 'Id' => 'Id', 'Name' => 'Name', 'Email' => 'Email', 'Contact' => 'Contact', 'Reminder Date' => 'Reminder Date', 'Project' => 'Project', 'Country' => 'Country', 'Status' => 'Status', 'Lead Source' => 'Lead Source', 'Remark' => 'Remark')); 
	    $this->set(compact('data','headers'));
		$this->layout = 'ajax';
		return;
	
	}

	public function view($id = null,$user=null) {
		if (!$this->Enquiry->exists($id)   || $this->checkUser($id,$user)==false) {
			throw new NotFoundException(__('Invalid enquiry'));
		}
		
		if ($this->request->is('post')) {
			
			echo "Please wait.We are saving you information.";
			
			$destinationorig = realpath('../webroot/img/remarks/') . '/';
	        $destinationthumb ='';
			$resultval="" ;
			
			$file = $this->request->data['Remark']['other_info'];
			if($file['name']!=""){ 
			$resultval = $this->Upload->uploadimg($file,$destinationorig,$destinationthumb,"",""); }
			$this->request->data['Remark']['other_info']=$resultval;
			$this->Remark->create();
			$this->request->data['Remark']['posted_date']=date("Y-m-d H:i:s");
			$this->request->data['Remark']['feedBy']=CakeSession::read('User.id');
			if ($this->Remark->save($this->request->data)) {
        
		   $this->Enquiry->query("update enquiries set reminder_date='".$this->request->data['Remark']['reminder_date']."',is_reminder='yes',updated_date='".date("Y-m-d H:i:s")."',last_reminder_update_date='".date("Y-m-d H:i:s")."' where id=".$id);
			
			
			
			if(isset($this->request->data['Remark']['lead_source_id'])){
			if($this->DailyReport->hasAny(array('DailyReport.enquiry_id' =>$id))){
			$this->DailyReport->read(null,$id);
			$this->DailyReport->set(array('customer_type'=>$this->request->data['Remark']['customer_type'],'enquiry_id'=>$id,'user_id'=>$this->request->data['Remark']['user_id'],'attend_by'=>$this->request->data['Remark']['user_id'],'lead_source_id'=>$this->request->data['Remark']['lead_source_id'],'response'=>$this->request->data['Remark']['response'],'msgsent'=>$this->request->data['Remark']['msgsent']));
			$this->DailyReport->save();	
			}	
			else {
			$this->DailyReport->set(array('customer_type'=>$this->request->data['Remark']['customer_type'],'enquiry_id'=>$id,'user_id'=>$this->request->data['Remark']['user_id'],'attend_by'=>CakeSession::read('User.id'),'lead_source_id'=>$this->request->data['Remark']['lead_source_id'],'response'=>$this->request->data['Remark']['response'],'msgsent'=>$this->request->data['Remark']['msgsent'],'posted'=>date("Y-m-d H:i:s")));
		$this->DailyReport->save();
			}
			}
			
			
			$this->Session->setFlash(__('The remark has been saved.'));
			return $this->redirect(array('controller' => 'enquiries','action' => 'view',$id));
			} 
			else {
			$this->Session->setFlash(__('The remark could not be saved. Please, try again.'));
			}
		}
		$options = array('conditions' => array('Enquiry.' . $this->Enquiry->primaryKey => $id));
		$dailyReports = $this->DailyReport->query('select DailyReport.* from daily_reports as DailyReport where DailyReport.enquiry_id='.$id);
		$this->set('enquiry', $this->Enquiry->find('first', $options));
		$this->set('remarks', $this->Remark->find('all', array('conditions'=>array('Remark.enquiry_id'=>$id),'order'=>array('Remark.id'=>'asc'))));
		$this->set('dailyReports',$dailyReports);
		$this->layout="sub-default";
	}



    public function movedView($id = null,$user=null) {
		if (!$this->Enquiry->exists($id)) {
			throw new NotFoundException(__('Invalid enquiry'));
		}
		if ($this->request->is('post')) {
			$this->Remark->create();
			$this->request->data['Remark']['posted_date']=date("Y-m-d H:i:s");
			$this->request->data['Remark']['feedBy']=CakeSession::read('User.id');
			if ($this->Remark->save($this->request->data)) {
        
		   $this->Enquiry->query("update enquiries set reminder_date='".$this->request->data['Remark']['reminder_date']."',is_reminder='yes',updated_date='".date("Y-m-d H:i:s")."',last_reminder_update_date='".date("Y-m-d H:i:s")."' where id=".$id);
			
			
			
			if(isset($this->request->data['Remark']['lead_source_id'])){
			if($this->DailyReport->hasAny(array('DailyReport.enquiry_id' =>$id))){
			$this->DailyReport->read(null,$id);
			$this->DailyReport->set(array('customer_type'=>$this->request->data['Remark']['customer_type'],'enquiry_id'=>$id,'user_id'=>$this->request->data['Remark']['user_id'],'attend_by'=>$this->request->data['Remark']['user_id'],'lead_source_id'=>$this->request->data['Remark']['lead_source_id'],'response'=>$this->request->data['Remark']['response'],'msgsent'=>$this->request->data['Remark']['msgsent']));
			$this->DailyReport->save();	
			}	
			else {
			$this->DailyReport->set(array('customer_type'=>$this->request->data['Remark']['customer_type'],'enquiry_id'=>$id,'user_id'=>$this->request->data['Remark']['user_id'],'attend_by'=>CakeSession::read('User.id'),'lead_source_id'=>$this->request->data['Remark']['lead_source_id'],'response'=>$this->request->data['Remark']['response'],'msgsent'=>$this->request->data['Remark']['msgsent'],'posted'=>date("Y-m-d H:i:s")));
		$this->DailyReport->save();
			}
			}
			
			
			$this->Session->setFlash(__('The remark has been saved.'));
			return $this->redirect(array('controller' => 'enquiries','action' => 'view',$id));
			} 
			else {
			$this->Session->setFlash(__('The remark could not be saved. Please, try again.'));
			}
		}
		$options = array('conditions' => array('Enquiry.' . $this->Enquiry->primaryKey => $id));
		$dailyReports = $this->DailyReport->query('select DailyReport.* from daily_reports as DailyReport where DailyReport.enquiry_id='.$id);
		$this->set('enquiry', $this->Enquiry->find('first', $options));
		$this->set('remarks', $this->Remark->find('all', array('conditions'=>array('Remark.enquiry_id'=>$id),'order'=>array('Remark.id'=>'asc'))));
		$this->set('dailyReports',$dailyReports);
		$this->layout="sub-default";
	}


	
	public function getCurrentReminders() {
		if ($this->request->is('ajax')) {
		
		$data='';$searchUserId=null;$pages=null;$condition='';$querySrting=''; $condition=array();
		$conc='';
		
		if(isset($this->request->query['search_user']) and CakeSession::read('User.type')!='regular'){$searchUserId=trim($this->request->query['search_user']); if($searchUserId){ $condition['Enquiry.user_id']=$searchUserId;}}
		else if(CakeSession::read('User.type')=='regular'){$condition['Enquiry.user_id']=CakeSession::read('User.id');}
		else { 
		$condition['Enquiry.user_id']=0;
		}
		$pages=trim($this->request->query['startpage']);
		if($pages)
		{
		$pg = $pages;
		$page = $pages; 
		}
		else
		{
		$pg = 1;
		$page = 1;
		}
		$cur_page = $page;
		$page -= 1;
		$per_page = 20;
		$start = $page * $per_page;
		
		
		 $condition['date(Enquiry.reminder_date)']=date('Y-m-d');
		 
		 $this->Paginator->settings = array('Enquiry' => array('limit' =>20,'order' => array('id' => 'desc'),'conditions'=>$condition));
		
		$this->Enquiry->recursive = 0;
	    $data=$this->Paginator->paginate();
	    //$log = $this->Enquiry->getDataSource()->getLog(false, false);
        //debug($log);
		
		$count=$this->Enquiry->find('count',array('conditions'=>$condition)); 
		
		$this->set('enquiries', $this->Paginator->paginate());
		$this->set('currentpage',$cur_page);
	    $this->set('total',$count);
		
		}
		else
		{
			echo "<h3>404<br/>Invalid request.</h3>";
		}
		$this->layout='ajax';
        //$this->autoRender = false;
	}

	public function add() {
		$projectName='';
		$countryName='';
		$userName='';
		if ($this->request->is('post')) {
			$this->request->data['Enquiry']['lead_of']=$this->request->data['Enquiry']['user_id'];
			$this->Enquiry->create();
			if ($this->Enquiry->save($this->request->data)) {		
			$projectName=$this->Project->findById($this->request->data['Enquiry']['project_id']);
			$countryName=$this->Country->findById($this->request->data['Enquiry']['country_id']);
			$userName=$this->User->findById($this->request->data['Enquiry']['user_id']);	
			$this->request->data['Enquiry']['history_by_project']=$this->request->data['Enquiry']['project_id'];
			
			$this->Mail->sendEnquiryMail($userName['User']['name'],$userName['User']['last_name'],$userName['User']['email'],addslashes($this->request->data['Enquiry']['name']),addslashes($this->request->data['Enquiry']['email']),addslashes($this->request->data['Enquiry']['contact']),$projectName['Project']['name'],$countryName['Country']['name'],addslashes($this->request->data['Enquiry']['query']));
			
			
			
			
			$phonenum = $userName['User']['phone']; 
            $message = 'Name : '.$this->request->data['Enquiry']['name'].',contact : '.$this->request->data['Enquiry']['contact'].',Email : '.$this->request->data['Enquiry']['email'].',Project : '.$projectName['Project']['name'].',Executive : '.$userName['User']['username'].',Country : '.$countryName['Country']['name'];
            $debug = true;
		    if($phonenum!=''){$this->Sms->smsSend($phonenum,$message,$debug);}
				
				
				$this->Session->setFlash(__('The enquiry has been saved.'));
				return $this->redirect($this->request->data['Enquiry']['referer']);
			} else {
				$this->Session->setFlash(__('The enquiry could not be saved. Please, try again.'));
			}
		}
		//$users = $this->Enquiry->User->find('list');
		$users = $this->Enquiry->User->find('list',array('fields'=>array('parent'),'conditions'=>array('status'=>'active')));
		//$projects = $this->Enquiry->Project->find('list');
		$builders = $this->Enquiry->Builder->find('list',array('order'=>array('name'=>'asc')));
		$countries = $this->Enquiry->Country->find('list');
		$states = $this->Enquiry->State->find('list');
		$cities = $this->Enquiry->City->find('list');
		$closeReasons = $this->Enquiry->CloseReason->find('list');
		$leadSources = $this->Enquiry->LeadSource->find('list');
		//$projects = $this->Enquiry->Project->find('list');
		$this->set(compact('users', 'builders', 'countries', 'states', 'cities', 'closeReasons', 'leadSources'));
	}

	public function edit($id = null) {
		if (!$this->Enquiry->exists($id)  || $this->checkUser($id)==false) {
			throw new NotFoundException(__('Invalid enquiry'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if($this->request->data['Enquiry']['status']==='open') { $this->request->data['Enquiry']['close_reason_id']=0; }

			$this->request->data['Enquiry']['updated_date']=date('Y-m-d H:i:s');
            $this->request->data['Enquiry']['updateBy']=CakeSession::read('User.id');

            if($this->request->data['Enquiry']['leadof']!==$this->request->data['Enquiry']['user_id']) {  
			$this->request->data['Enquiry']['moved_date']=date('Y-m-d H:i:s');
			if($this->request->data['Enquiry']['history_of_lead']!=="")
			{
			$this->request->data['Enquiry']['history_of_lead']=$this->request->data['Enquiry']['history_of_lead']."#".$this->request->data['Enquiry']['leadof']; 
			 }
			 else
			 {
				 $this->request->data['Enquiry']['history_of_lead']=$this->request->data['Enquiry']['leadof'];
				 } 
			
			}

		        
			$userName=$this->User->findById($this->request->data['Enquiry']['user_id']);
			$projectName=$this->Project->findById($this->request->data['Enquiry']['project_id']);
			$countryName=$this->Country->findById($this->request->data['Enquiry']['country_id']);
			if ($this->Enquiry->save($this->request->data)) {
				$this->DailyReport->query("update daily_reports set customer_type='".$this->request->data['Enquiry']['type']."' where enquiry_id=".$id);
				if($this->request->data['Enquiry']['send_mail']=='yes'){
				$this->Mail->sendEnquiryMail($userName['User']['name'],$userName['User']['last_name'],$userName['User']['email'],addslashes($this->request->data['Enquiry']['name']),addslashes($this->request->data['Enquiry']['email']),addslashes($this->request->data['Enquiry']['contact']),$projectName['Project']['name'],$countryName['Country']['name'],addslashes($this->request->data['Enquiry']['query']),addslashes($this->request->data['type_of_lead']));
				
				$this->sendToenquiryMail($userName['User']['name'],$userName['User']['last_name'],$userName['User']['email'],addslashes($this->request->data['Enquiry']['name']),addslashes($this->request->data['Enquiry']['email']),addslashes($this->request->data['Enquiry']['contact']),$projectName['Project']['name'],$countryName['Country']['name'],addslashes($this->request->data['Enquiry']['query']),addslashes($this->request->data['type_of_lead']));
				}
				if($this->request->data['Enquiry']['send_sms']=='yes'){
				$phonenum = $userName['User']['phone']; 
                $message = 'Name : '.$this->request->data['Enquiry']['name'].',contact : '.$this->request->data['Enquiry']['contact'].',Email : '.$this->request->data['Enquiry']['email'].',Project : '.$projectName['Project']['name'].',Executive : '.$userName['User']['username'].',Country : '.$countryName['Country']['name'].',Type Of Lead : '.$this->request->data['type_of_lead'];;
                $debug = true;
				if($phonenum!=''){$this->Sms->smsSend($phonenum,$message,$debug);}
				}
				$this->Session->setFlash(__('The enquiry has been saved.'));
				return $this->redirect($this->request->data['Enquiry']['referer']);
				
						
			} else {
				$this->Session->setFlash(__('The enquiry could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Enquiry.' . $this->Enquiry->primaryKey => $id));
			$this->request->data = $this->Enquiry->find('first', $options);
		}
		if($this->request->data['Enquiry']['builder_id']!=0){ $condition=array('Project.builder_id'=>$this->request->data['Enquiry']['builder_id']);}
		$users = $this->Enquiry->User->find('list',array('fields'=>array('parent'),'conditions'=>array('status'=>'active')));
		$projects = $this->Enquiry->Project->find('list',array('conditions'=>$condition));
		$builders = $this->Enquiry->Builder->find('list',array('order'=>array('name'=>'asc')));
		$countries = $this->Enquiry->Country->find('list');
		$states = $this->Enquiry->State->find('list');
		$cities = $this->Enquiry->City->find('list');
		$closeReasons = $this->Enquiry->CloseReason->find('list');
		$leadSources = $this->Enquiry->LeadSource->find('list');
		$this->set(compact('users','projects', 'builders', 'countries', 'states', 'cities', 'closeReasons', 'leadSources'));
	}
	
	public function delete($id = null) {
		$this->Enquiry->id = $id;
		if (!$this->Enquiry->exists() || $this->checkUser($id)==false) {
			throw new NotFoundException(__('Invalid enquiry'));
		}
		$this->request->allowMethod('post', 'delete');
		//$this->Enquiry->delete()
		$this->Enquiry->read(null,$this->User->id);
	    $this->Enquiry->set(array('status'=>'trash'));
		
		if ($this->Enquiry->save()) {
			$this->Session->setFlash(__('The enquiry has been deleted.'));
		} else {
			$this->Session->setFlash(__('The enquiry could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
		
	public function usersOnParent($user=null) {
		    $conditions='';$data='';
			/*if($user){
			$conditions.=' and Enquiry.user_id='.$user;									
			}*/
			
			$data=$this->User->query("select user.name,user.last_name,user.id,user.username from users as user where user.status ='active' and (user.parent=".$user." || user.id=".$user.")");
		    //$data=$this->User->find('all',array('fields'=>array('name','last_name','id','username'),'conditions'=>array('OR'=>array('parent'=>$user,'id'=>$user))));
			
			
			
		    return $data;
		   
		}
		public function usersunderParent($user=null) {
		    $conditions='';$data='';
			/*if($user){
			$conditions.=' and Enquiry.user_id='.$user;									
			}*/
			
			$data=$this->User->query("select user.name,user.last_name,user.id,user.username from users as user where user.status ='active' and user.parent=".$user."");
		    //$data=$this->User->find('all',array('fields'=>array('name','last_name','id','username'),'conditions'=>array('OR'=>array('parent'=>$user,'id'=>$user))));
			
			
			
		    return $data;
		   
		}
		public function usersOnParentdata($user=null) {


		    $conditions='';$data='';
			/*if($user){
			$conditions.=' and Enquiry.user_id='.$user;									
			}*/
			
			$data=$this->User->query("select user.name,user.last_name,user.id,user.username from users as user where user.status ='active' and (user.parent=".$user." || user.id=".$user.")");
		    //$data=$this->User->find('all',array('fields'=>array('name','last_name','id','username'),'conditions'=>array('OR'=>array('parent'=>$user,'id'=>$user))));
			
			
			
		    return $data;
		   
		}
			
	public function dailyReport() {
		$conditions='';$date=date('Y-m-d',strtotime("-1 days"));$users='';$total='';
		if(isset($this->params->query['confirm'])) {
			if(isset($this->params->query['date']) && ($this->params->query['date']!="")){
			$date=date('Y-m-d',strtotime($this->params->query['date']));
			
			}
		}
		
			
			$condition['date(Enquiry.posted_date)']=$date;
			$condition['NOT']=array('Enquiry.status'=>'trash');
			
		$users=$this->User->query("select user.id,user.name,user.last_name,user.priority  from users as user where user.status ='active' && user.parent=0 && user.type='marketing' && ( user.role='regular' || user.role='admin' )
ORDER BY case when user.priority in(0, NULL) then 1 end,user.priority ASC");
		$total=$this->Enquiry->find('count',array('conditions'=>$condition));
		
	
		
		$this->set('total',$total);
		$this->set('data',$users);
		$this->set('date',$date);
		
		
		//$log = $this->Enquiry->getDataSource()->getLog(false, false);
        //debug($log); exit;
		}
		
	public function dailyAll($date=null,$user=null) {
		$conditions='';$data='';
		
			if($date){
			
			//$date=date('Y-m-d',strtotime($this->params->query['date']));
			$conditions=' and date(Enquiry.posted_date)="'.$date.'"';
			$condition['date(Enquiry.posted_date)']=$date;
			}
			if($user){
			
			//$date=date('Y-m-d',strtotime($this->params->query['date']));
			$conditions.=' and Enquiry.user_id='.$user;
			$condition['Enquiry.user_id']=$user;
			
			}
			
			
			$condition['NOT']=array('Enquiry.status'=>'trash');
			$conditions.=' and Enquiry.status != "trash" '; 
	
		//$data=$this->Enquiry->find('all',array('conditions'=>$condition));
		
		
		$data=$this->Enquiry->query("select Enquiry.name,Enquiry.status,Enquiry.id,Enquiry.lead_source_id,Country.name,Project.name from enquiries as Enquiry left join countries as Country ON Enquiry.country_id = Country.id left join projects as Project on Enquiry.project_id=Project.id where 1 ".$conditions);
		
		//$data=$this->Enquiry->query("select Enquiry.*,DailyReport.* from enquiries as Enquiry left join daily_reports as DailyReport on Enquiry.id=DailyReport.enquiry_id  where 1  ".$conditions);
		

		

		return $data;
		
		}
		
   public function dailyLeadCountByUser($date=null,$user=null) {
		$conditions='';$data='';
			if($date){
			
			//$date=date('Y-m-d',strtotime($this->params->query['date']));
			$conditions=' and date(Enquiry.posted_date)="'.$date.'"';
			$condition['date(Enquiry.posted_date)']=$date;
			}
			if($user){
		$usersdata=$this->User->query("select user.id from users as user where 1 and (user.parent=".$user." || user.id=".$user.")");		
		$array=array();
		if(!empty($usersdata)) { 
		foreach ($usersdata as $usr){
		$array[]=$usr['user']['id'];
		}
		    $userlist=@implode(',',$array);
			$conditions.=' and Enquiry.user_id in ('.$userlist.')';
			$condition['Enquiry.user_id']=$user;
		}
			}
			
			
			$condition['NOT']=array('Enquiry.status'=>'trash');
			$conditions.=' and Enquiry.status != "trash" '; 
	
		
		$data=$this->Enquiry->query("select count(*) as total from enquiries as Enquiry where 1 ".$conditions);
		print_r($data[0][0]['total']);
		
		//$data=$this->Enquiry->query("select Enquiry.*,DailyReport.* from enquiries as Enquiry left join daily_reports as DailyReport on Enquiry.id=DailyReport.enquiry_id  where 1  ".$conditions);
		
		
		//return $data;
		
		}
		
	public function teamUser($user=null){
		
		$usersdata=$this->User->query("select count(*) as total from users as user where 1 and (user.parent=".$user." || user.id=".$user.")");		
		print_r($usersdata[0][0]['total']);
		
		//$data=$this->Enquiry->query("select Enquiry.*,DailyReport.* from enquiries as Enquiry left join daily_reports as DailyReport on Enquiry.id=DailyReport.enquiry_id  where 1  ".$conditions);
		
		
		//return $data;
		
		}
	public function totalUser(){
	
		$totalusersdata=$this->User->query("SELECT count(*) as total  FROM `users` WHERE `role` = 'regular' AND `type` = 'marketing' AND `status` = 'active'");		
		print_r(($totalusersdata[0][0]['total'])-3);
	
	// (-3 is use to remove developer person, other & marketing)
		}	
		
	public function weeklyMonthlyReport() {
		
		$conditions='';$date='';$data='';$fromdate='';$todate='';$total='';$users='';$searchProjectId='0';$projects="";
		if(isset($this->params->query['confirm'])) {
			if(isset($this->params->query['from_date']) && isset($this->params->query['to_date'])){
				
			if($this->params->query['from_date']!='' && $this->params->query['to_date']!='') {
				
			$fromdate=$this->params->query['from_date'];$todate=$this->params->query['to_date'];
			$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
			$condition['NOT']=array('Enquiry.status'=>'trash');
			$date='REPORT FROM '.$fromdate.' TO '.$todate;
			
			}
			}
			
			if(isset($this->request->query['projectid']) and ($this->request->query['projectid']!=0) and ($this->request->query['projectid']!='')){
				$searchProjectId=trim($this->request->query['projectid']); 
				$projectName=$this->Project->findById($searchProjectId); 
				$condition['Enquiry.project_id']=$searchProjectId;
				$date.=" OF ".strtoupper($projectName['Project']['name']);
		
		}
			
			
		$users=$this->User->query("select user.id,user.name,user.last_name from users as user where user.status !='deactive' && user.parent=0 && user.type='marketing' &&  ( user.role='regular' || user.role='admin' ) ");
		
		$total=$this->Enquiry->find('count',array('conditions'=>$condition));
		
		}
		
		$builders = $this->Builder->find('list',array('order'=>array('name'=>'asc')));
		if(isset($this->request->query['search_builder']) and ($this->request->query['search_builder']!=0 || $this->request->query['search_builder']!='')){$projects = $this->Project->find('list',array('conditions'=>array("Project.builder_id"=>$this->request->query['search_builder'])));}
		
		
		$this->set('builders',$builders);
		$this->set('projects',$projects);
		$this->set('searchProjectId',$searchProjectId);
		$this->set('fromdate',$fromdate);
		$this->set('todate',$todate);
		$this->set('date',$date);
		$this->set('total',$total);
		$this->set('data',$users);
		
		
		//$log = $this->Enquiry->getDataSource()->getLog(false, false);
       // debug($log); exit;
		
		}
		
	public function printWeekly() {
		
		$conditions='';$date='';$data='';$fromdate='';$todate='';$total='';$users='';$searchProjectId='0';
		if(isset($this->params->query['confirm'])) {
			if(isset($this->params->query['from_date']) && isset($this->params->query['to_date'])){
				
			if($this->params->query['from_date']!='' && $this->params->query['to_date']!='') {
				
			$fromdate=$this->params->query['from_date'];$todate=$this->params->query['to_date'];
			$frmdate= date('d-m-Y',strtotime($fromdate)); 
			$toodate= date('d-m-Y',strtotime($todate));
			$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
			$condition['NOT']=array('Enquiry.status'=>'trash');
			$date='REPORT FROM '.$frmdate.' TO '.$toodate;
			

			}
			}
			
			if(isset($this->request->query['projectid']) and ($this->request->query['projectid']!=0) and ($this->request->query['projectid']!='')){
				$searchProjectId=trim($this->request->query['projectid']);
				$projectName=$this->Project->findById($searchProjectId); 
				$condition['Enquiry.project_id']=$searchProjectId;
				$date.=" OF ".strtoupper($projectName['Project']['name']);
		
		}
			
			
		$users=$this->User->query("select user.id,user.name,user.last_name from users as user where user.status='active' && user.parent=0 && user.type='marketing' &&  ( user.role='regular' || user.role='admin' )");
		
		$total=$this->Enquiry->find('count',array('conditions'=>$condition));
		}
		
		
		$this->set('searchProjectId',$searchProjectId);
		$this->set('fromdate',$fromdate);
		$this->set('todate',$todate);
		$this->set('date',$date);
		$this->set('total',$total);
		$this->set('data',$users);
		
		
		//$log = $this->Enquiry->getDataSource()->getLog(false, false);
       // debug($log); exit;
		$this->layout='print';
		}
		
	public function printDaily() {
		$conditions='';$date='';$users='';$total='';
		if(isset($this->params->query['confirm'])) {
			if(isset($this->params->query['date']) && ($this->params->query['date']!="")){
			$date=date('Y-m-d',strtotime($this->params->query['date']));
			
			}
		}
		else {
			$date=date('Y-m-d',strtotime("-1 days"));
			}
			
			$condition['date(Enquiry.posted_date)']=$date;
			$condition['NOT']=array('Enquiry.status'=>'trash');
			
		$users=$this->User->query("select user.id,user.name,user.last_name,user.priority  from users as user where user.status ='active' && user.parent=0 && user.type='marketing' && ( user.role='regular' || user.role='admin' )
ORDER BY 
    case when user.priority in(0, NULL) then 1 end,
    user.priority ASC");
		$total=$this->Enquiry->find('count',array('conditions'=>$condition));
		
		
		
		$this->set('total',$total);
		$this->set('data',$users);
		$this->set('date',$date);
		
		$this->layout='print';
		//$log = $this->Enquiry->getDataSource()->getLog(false, false);
        //debug($log); exit;
		}
		
	public function weeklyAll($fromdate=null,$todate=null,$projectid=null,$user=null) {
		$conditions='';$data='';
		
	        if($projectid!=0){ $conditions.=" and enq.project_id=".$projectid;}

			/*if($user){
			$conditions.=' and enq.user_id='.$user;
		
			}*/
			
	
		$data=$this->Enquiry->query("select enq.user_id from enquiries as enq  where date(enq.posted_date)>='".$fromdate."' and date(enq.posted_date)<= '".$todate."' and enq.status!='trash' $conditions group by enq.user_id");
		return $data;
		
		}
		
	public function counter() {
		
	 if((CakeSession::read('User.type')=='regular')) 
	 { 
		$data=$this->Enquiry->find('all',array('fields'=>array('User.id','User.name','User.last_name','count(Enquiry.id) as total'),'conditions'=>array('date(Enquiry.posted_date)'=>date('Y-m-d'),'Enquiry.user_id'=>CakeSession::read('User.id'),'NOT'=>array('Enquiry.status'=>'trash')),'group'=>array('Enquiry.user_id')));
		
		}
		else
		{
	
		$data=$this->Enquiry->find('all',array('fields'=>array('User.id','User.name','User.last_name','count(Enquiry.id) as total'),'conditions'=>array('date(Enquiry.posted_date)'=>date('Y-m-d'),'NOT'=>array('Enquiry.status'=>'trash')),'group'=>array('Enquiry.user_id')));
		}
		$this->set('data',$data);
		 //$log = $this->User->getDataSource()->getLog(false, false);
        //debug($log); exit;
		}
	
	public function leadsource($id){
		if($id) {
	$name=$this->LeadSource->query("select name from lead_sources where id='$id'");
		}
	if(!empty($name[0]['lead_sources']['name'])) {
	return $name[0]['lead_sources']['name'];}
	//else { return;}
	}
	
	public function countWeeklyUserLeads($fromdate,$todate,$projectid,$user){
	
		$projectcond="";
	        if($projectid!='0'){ $projectcond=" and project_id=".$projectid;}	
	$result=$this->Enquiry->query("select count(*) as total  from enquiries where status!='trash' and date(posted_date)>='".$fromdate."' and date(posted_date)<= '".$todate."' $projectcond and user_id=".$user);
	return $result[0][0]['total'];
	}
	
	public function countopenWeeklyUserLeads($fromdate,$todate,$projectid,$user){
	
		$projectcond="";
	        if($projectid!='0'){ $projectcond=" and project_id=".$projectid;}	
	$result=$this->Enquiry->query("select count(*) as total  from enquiries where status='open' and date(posted_date)>='".$fromdate."' and date(posted_date)<= '".$todate."' $projectcond and user_id=".$user);
	return $result[0][0]['total'];
	}
	
	public function countcloseWeeklyUserLeads($fromdate,$todate,$projectid,$user){
	
		$projectcond="";
	        if($projectid!='0'){ $projectcond=" and project_id=".$projectid;}	
	$result=$this->Enquiry->query("select count(*) as total  from enquiries where status='close' and date(posted_date)>='".$fromdate."' and date(posted_date)<= '".$todate."' $projectcond and user_id=".$user);
	return $result[0][0]['total'];
	}
	
     public function countdoneWeeklyUserLeads($fromdate,$todate,$projectid,$user){
	
		$projectcond="";
	        if($projectid!='0'){ $projectcond=" and project_id=".$projectid;}	
	$result=$this->Enquiry->query("select count(*) as total  from enquiries where status='done' and date(posted_date)>='".$fromdate."' and date(posted_date)<= '".$todate."' $projectcond and user_id=".$user);
	return $result[0][0]['total'];
	}
	
	public function sourceWiseLeadsCounter($date){
	$res='';
	//$sql=$this->Enquiry->find('all',array('fields',array('Enquiry.lead_source_id','count(Enquiry.id) as total'),'conditions'=>array('date(Enquiry.posted_date)'=>$date),'group'=>array('Enquiry.lead_source_id')));	
	$sql=$this->Enquiry->query("select enquiries.lead_source_id,count(*) as total,lead_sources.priority from enquiries INNER JOIN lead_sources ON enquiries.lead_source_id=lead_sources.id AND  date(posted_date)='".$date."' and enquiries.status!='trash' group by lead_source_id ORDER BY lead_sources.priority");	
	
	
	
//	$sql=$this->Enquiry->query("select lead_source_id,count(*) as total from enquiries where date(posted_date)='".$date."'  and status!='trash' group by lead_source_id");	
	
	foreach ($sql as $data){
		if($data['enquiries']['lead_source_id']=='14')
		{
			$res.="<b> Microsites </b> : ".$data[0]['total']." , ";
		}
		else
		{
			$res.="<b>".$this->leadsource($data['enquiries']['lead_source_id'])."</b> : ".$data[0]['total']." , ";
		}
	
	}
	
	return $res;
	}

	public function customerTypeUserLeadsWeekly($fromdate,$todate,$projectid,$noofquery=0){
	$sql='';$total='';$response='';$projectcond="";
	if($projectid!='0'){ $projectcond=" and enq.project_id=".$projectid;}
	$sql=$this->Enquiry->query("select attend.customer_type, count(attend.customer_type) as tot from enquiries as enq right join daily_reports as attend on enq.id=attend.enquiry_id where date(enq.posted_date)>='".$fromdate."' and date(enq.posted_date)<= '".$todate."' $projectcond group by attend.customer_type");
	
	
	
	foreach ($sql as $data){ 
	$total+=$data[0]['tot'];
	$response.="<b>".$data['attend']['customer_type']." : ".$data[0]['tot']." <b>,";
	}
	if((int)$noofquery >(int)$total){  return $response."<b>Blank : ".((int)$noofquery-(int)$total)." </b>";}
	else {return $response;} 
	}	
	
	public function customerTypeUserLeads($fromdate,$todate,$projectid,$user=null,$noofquery=null){ 
	$sql='';$total='';$response='';$tot='';
	
	$projectcond="";
	if($projectid!='0'){ $projectcond=" and enq.project_id=".$projectid;}
	
	if($user) {
	$sql=$this->Enquiry->query("select attend.customer_type, count(attend.customer_type) as tot from enquiries as enq right join daily_reports as attend on enq.id=attend.enquiry_id where date(enq.posted_date)>='".$fromdate."' and date(enq.posted_date)<= '".$todate."' and enq.user_id='".$user."' $projectcond group by attend.customer_type");
	foreach ($sql as $data){  
	$total+=$data[0]['tot'];
	$response.=$data['attend']['customer_type']."(".$data[0]['tot']."),";
	}
	if((int)$noofquery >(int)$total){  return $response."Blank (".((int)$noofquery-(int)$total).")";}
	else {return $response;} 
	}
	else {return $response;}
	}
	
	public function responseUserLeads($fromdate,$todate,$projectid,$user){
		
	$projectcond="";
	if($projectid!='0'){ $projectcond=" and enq.project_id=".$projectid;}
	
	$totalres=$this->Enquiry->query("select count(*) as tot from enquiries as enq right join daily_reports as attend on enq.id=attend.enquiry_id where date(enq.posted_date)>='".$fromdate."' and date(enq.posted_date)<= '".$todate."' and enq.user_id=$user and attend.response>='49' $projectcond");
	
	return $totalres[0][0]['tot'];
	}

	public function leadsFromSource($fromdate,$todate,$projectid,$user,$type){
	$totalres='';$sourcecount=0;$total=0;
	
	$projectcond="";
	if($projectid!='0'){ $projectcond=" and project_id=".$projectid;}
	
	$totalres=$this->Enquiry->query("select lead_source_id from enquiries  where date(posted_date)>='".$fromdate."' and date(posted_date)<= '".$todate."' and status!='trash' and user_id=$user $projectcond");
	foreach ($totalres as $data){  
	$total=$this->LeadSource->find('count',array('conditions'=>array('id'=>$data['enquiries']['lead_source_id'],'type'=>$type),'group'=>array('id')));
	$sourcecount+=$total;
	}
	return $sourcecount;
	}
	
	private function checkUser($id,$user=null) { 
		
		if(CakeSession::read('User.type')==="regular") {
		$thischeck=$this->Enquiry->query("select enq.user_id,us.parent from enquiries as enq join users as us on enq.user_id=us.id where enq.id=".$id); 
		if(CakeSession::read('User.id')===$thischeck[0]['enq']['user_id'])
		{ return true; }
		else if(CakeSession::read('User.id')===$thischeck[0]['us']['parent'])
		{  return true; }	
		else if($this->checkTree(CakeSession::read('User.id'),$thischeck[0]['enq']['user_id'])===true)
		{   
			return true;
			}
			else{
				
			return false;	
			}
		}
		else
		{
			return true;
			}
		
		
	}
	
	private function checkTree($parentId = 0,$userid) {
	$res=false;
	//$sel=$userid;	
	$thischeck=$this->User->query("select id,name,role,level,parent from users where parent=".$parentId." and status='active'  ORDER BY id DESC,level asc");	
	foreach ($thischeck as $value) {
		
	if($value['users']['id']==$userid) { $res=true;}	
	else if ($this->checkChild($value['users']['id']) and $res==false) {
	$this->checkTree($value['users']['id'],$userid);
			}
			else
			{
				$res=false;
				}
				
		
	}
	return $res;
	
  }
	
	private function checkChild($param) {
		
		if($param!=0) {
		$countall=$this->User->find('count',array('condition'=>array('User.parent' => $param)));
		
		// $log = $this->User->getDataSource()->getLog(false, false);
        //debug($log); exit;
		
	    if($countall){ return true ;} else { return false;}
		}

		return false;
		
	}
	
	private function checkOnlyUser($id) {
		if($id){
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
		else
		{
			return false;
			}
	}
	
	public  function getResult() {
		if ($this->request->is('ajax')) {
		
		$data='';$searchKey=null;$searchUserId=null;$searchCountryId=null;$searchBuilderId=null;$searchProjectId=null;$searchStatus=null;$pages=null;$condition='';$querySrting=''; $condition=array();
		$conc='';
		
		if(isset($this->request->query['search_key'])){$searchKey=trim($this->request->query['search_key']); if($searchKey){  $condition['OR']=array('Enquiry.id LIKE'=>'%'.$searchKey.'%','Enquiry.name LIKE'=>'%'.$searchKey.'%','Enquiry.email LIKE'=>'%'.$searchKey.'%','Enquiry.contact LIKE'=>'%'.$searchKey.'%'); }}
		
		if(isset($this->request->query['search_country'])){$searchCountryId=trim($this->request->query['search_country']); if($searchCountryId){ $condition['Enquiry.country_id']=$searchCountryId;}}
		if(isset($this->request->query['search_builder'])){$searchBuilderId=trim($this->request->query['search_builder']); if($searchBuilderId){ $condition['Enquiry.builder_id']=$searchBuilderId;}}
		if(isset($this->request->query['search_project'])){$searchProjectId=trim($this->request->query['search_project']); if($searchProjectId){ $condition['Enquiry.project_id']=$searchProjectId;}}
		if(isset($this->request->query['close_reasons'])){$searchReasonId=trim($this->request->query['close_reasons']); if($searchReasonId){ $condition['Enquiry.close_reason_id']=$searchReasonId;}}
		if(isset($this->request->query['search_status'])){$searchStatus=trim($this->request->query['search_status']); if($searchStatus){ $condition['Enquiry.status']=$searchStatus;}}
		
		$condition['NOT']=array('Enquiry.status'=>"trash");
		$pages=trim($this->request->query['startpage']);
		
		if($pages)
		{
		$pg = $pages;
		$page = $pages; 
		}
		else
		{
		$pg = 1;
		$page = 1;
		}
		$cur_page = $page;
		$page -= 1;
		$per_page = 40;
		$start = $page * $per_page;
		
		if(trim($this->request->query['search_user'])!=''){$searchUserId=trim($this->request->query['search_user']); if($searchUserId){ $condition['Enquiry.user_id']=$searchUserId;}}
		else if(trim($this->request->query['search_user'])=='' and CakeSession::read('User.type')=='regular'){ $condition['Enquiry.user_id']=CakeSession::read('User.id');}
		else { }
		
		//$querySrting=print_r($condition); 
		$this->Paginator->settings = array('Enquiry' => array('limit' =>$per_page,'offset' => $start,'order' => array('id' => 'desc'),'conditions'=>$condition));
	    $this->Enquiry->recursive = 0;
	    $data=$this->Paginator->paginate();
	    //$log = $this->Enquiry->getDataSource()->getLog(false, false);
        //debug($log);
		$count=$this->Enquiry->find('count',array('conditions'=>$condition)); 
		
		$this->set('enquiries', $this->Paginator->paginate());
		$this->set('currentpage',$cur_page);
	    $this->set('total',$count);
		
		}
		else
		{
			echo "<h3>404<br/>Invalid request.</h3>";
		}
		$this->layout='ajax';
        //$this->autoRender = false;
	}
	
	public  function todayReminders() {
 		$this->response->download("export.csv");
 		$data = $this->User->find('all');
		$this->set(compact('data'));
 		$this->layout = 'ajax';
 		return;
 	}
	
	public  function ajaxpaging($pagenumber,$total) {
	$resultval = $this->Pagination->ajaxPagination($pagenumber,$total);
	}
	
	public  function remoredata(){       
	$this->layout='ajax';
            $this->autoRender = false;
	if(!empty($this->request->data['name'])){
			$this->Enquiry->query("insert into enquiries set user_id=".$this->request->data['user_id'].",posted_date='".$this->request->data['posted_date']."',name='".$this->request->data['name']."',email='".$this->request->data['email']."',contact='".$this->request->data['contact']."',project_id=".$this->request->data['project_id'].",builder_id=".$this->request->data['builder_id'].",country_id=".$this->request->data['country_id'].",query='".$this->request->data['query']."'");
		}
	}
	
	public  function dailyExecutiveReminderMailReport(){  
	//if (!defined('CRON_DISPATCHER')) { $this->redirect('/'); exit(); }     
	$this->layout='ajax';
	$this->autoRender = false;
	$message='';
	$userslist=$this->Enquiry->find('all',array('conditions'=>array('OR'=>array('DATE(reminder_date)'=>date('Y-m-d'),'DATE(last_reminder_update_date)'=>date('Y-m-d'))),'group'=>array('Enquiry.user_id'),'fields' => array('Enquiry.user_id','User.name','User.last_name','User.email')));
	if(!empty($userslist))
	{   

	
		foreach($userslist as $key=>$value) {
		
	
	
		$k=1;
		$alldata=$this->Enquiry->find('all',array('conditions'=>array('OR'=>array('DATE(reminder_date)'=>date('Y-m-d'),'DATE(last_reminder_update_date)'=>date('Y-m-d')),'user_id'=>$value['Enquiry']['user_id']),'fields' => array('Enquiry.last_reminder_update_date','Enquiry.name','User.name','User.last_name','Enquiry.id','Project.name','Enquiry.contact','Enquiry.email','Enquiry.reminder_date')));
		
		
		if(!empty($alldata) and ($value['User']['email']!=''))
	   {
	$message.='<table cellpadding="5" cellspacing="0" align="center" style="border:1px solid #ccc; border-collapse:collapse;" width="100%">
	<tr>
	<td width="8%">S.N</td>
	<td width="6%">Lead No.</td>
	<td width="15%">Project Name</td>
	<td width="12%">Client Name</td>
	<td width="7%">Phone</td>
	<td width="6%">Email</td>
	<td width="23%">Reminder</td>
	<td width="23%">Remarks</td>
	</tr>';
		 $message.='<tr><td colspan="8" style="background-color:#F99;">'.$value['User']['name'].' '.$value['User']['last_name'].' : CURRENT REMINDERS</td></tr>';
		foreach($alldata as $key2=>$value2) {
		
		$message.='<tr><td class="rptData">'.$k ;
		
		if($value2['Enquiry']['last_reminder_update_date']!='0000-00-00 00:00:00' && date("Y-m-d", strtotime($value2['Enquiry']['last_reminder_update_date']))==date("Y-m-d")){ $message.='<span style="padding:0 0 0 10px"><img src="http://crmtech.co.in/images/icon_success.gif" title="Done"/></span>'; } else{ $message.='<span style="padding:0 0 0 10px"><img src="http://crmtech.co.in/images/icon_maybe.gif" title="Pending" /></span>'; }
		$message.='</td>
		<td>'.$value2['Enquiry']['id'].'</td>
		<td>'.$value2['Project']['name'].'</td>
		<td>'.ucwords($value2['Enquiry']['name']).'</td>
		<td>'.$value2['Enquiry']['contact'].'</td>
		<td>'.$value2['Enquiry']['email'].'</td>
		<td>'.date("d-M-y", strtotime($value2['Enquiry']['reminder_date'])).'</td>
		<td>'.$this->getLastRemark($value2['Enquiry']['id']).'</td></tr>';
		$k++; 
			}
		$message.='</table>';
		$this->Mail->sendDailyExecutiveReminderMail($value['User']['email'],$message);
		
		$message='';
		
		}
		
		
		}
		echo "!! DAILY STATUS REPORT SEND SUCCESSFULLY !!";	
		
		}
		else {
			
			
			}
			
	}
	
	public  function dailyReminderMailReport(){  
	
	if (!defined('CRON_DISPATCHER')) { $this->redirect('/'); exit(); }
	     
	$this->layout='ajax';
	$this->autoRender = false;
	$message='';
	$userslist=$this->Enquiry->find('all',array('conditions'=>array('OR'=>array('DATE(reminder_date)'=>date('Y-m-d'),'DATE(last_reminder_update_date)'=>date('Y-m-d'))),'group'=>array('Enquiry.user_id'),'fields' => array('Enquiry.user_id','User.name','User.last_name','User.email')));
	if(!empty($userslist))
	
	{   

	$message.='<table cellpadding="5" cellspacing="0" align="center" style="border:1px solid #ccc; border-collapse:collapse;" width="100%">
	<tr>
	<td width="8%">S.N</td>
	<td width="6%">Lead No.</td>
	<td width="15%">Project Name</td>
	<td width="12%">Client Name</td>
	<td width="7%">Phone</td>
	<td width="6%">Email</td>
	<td width="23%">Reminder</td>
	<td width="23%">Remarks</td>
	</tr>';
		foreach($userslist as $key=>$value) {
		$k=1;
		$alldata=$this->Enquiry->find('all',array('conditions'=>array('OR'=>array('DATE(reminder_date)'=>date('Y-m-d'),'DATE(last_reminder_update_date)'=>date('Y-m-d')),'user_id'=>$value['Enquiry']['user_id']),'fields' => array('Enquiry.last_reminder_update_date','Enquiry.name','User.name','User.last_name','Enquiry.id','Project.name','Enquiry.contact','Enquiry.email','Enquiry.reminder_date')));
		
		
		if(!empty($alldata))
	   {
		 $message.='<tr><td colspan="8" style="background-color:#F99;">'.$value['User']['name'].' '.$value['User']['last_name'].' : CURRENT REMINDERS</td></tr>';
		foreach($alldata as $key2=>$value2) {
		
		$message.='<tr><td class="rptData">'.$k ;
		
		if($value2['Enquiry']['last_reminder_update_date']!='0000-00-00 00:00:00' && date("Y-m-d", strtotime($value2['Enquiry']['last_reminder_update_date']))==date("Y-m-d")){ $message.='<span style="padding:0 0 0 10px"><img src="http://crmtech.co.in/images/icon_success.gif" title="Done"/></span>'; } else{ $message.='<span style="padding:0 0 0 10px"><img src="http://crmtech.co.in/images/icon_maybe.gif" title="Pending" /></span>'; }
		$message.='</td>
		<td>'.$value2['Enquiry']['id'].'</td>
		<td>'.$value2['Project']['name'].'</td>
		<td>'.ucwords($value2['Enquiry']['name']).'</td>
		<td>'.$value2['Enquiry']['contact'].'</td>
		<td>'.$value2['Enquiry']['email'].'</td>
		<td>'.date("d-M-y", strtotime($value2['Enquiry']['reminder_date'])).'</td>
		<td>'.$this->getLastRemark($value2['Enquiry']['id']).'</td></tr>';
		$k++; 
			}
		}
		
		
		}
		$message.='</table>';
		if($value['User']['email']!='') {		
		$this->Mail->sendDailyReminderMail($message);
		
		}
		echo "!! DAILY STATUS REPORT SEND SUCCESSFULLY !!";
		}
		else {
			
			
			}
			
	}
	
	private function getLastRemark($enqId=null){
		
		if($enqId){
			
		$remark=$this->Remark->find('first',array('fields'=>array('name'),'conditions'=>array('Remark.enquiry_id'=>$enqId),'order'=>array('Remark.id'=>'desc')));
		if($remark){
			
			return $remark['Remark']['name'];
			}
			else
			{
			return 'no more remark';	
				}
			}
		}
		
	public function moveToRemoteServer() {
		$data='';$searchKey=null;$searchUserId=null;$searchCountryId=null;$searchBuilderId=null;$searchProjectId=null;$fromdate=null;$todate=null;
		$searchStatus=null;$pages=null;$condition='';$querySrting=''; $condition=array();
		$conc='';$conditionencrypt='';
		
		if(isset($this->params->query['confirm'])) {
	    
		if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
		
		$searchKey=trim($this->request->query['search_key']);  $condition['OR']=array('Enquiry.id LIKE'=>'%'.$searchKey.'%','Enquiry.name LIKE'=>'%'.$searchKey.'%',
'Enquiry.email LIKE'=>'%'.$searchKey.'%','Enquiry.contact LIKE'=>'%'.$searchKey.'%'); 
    }
		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim($this->request->query['from_date']);
				$todate=trim($this->request->query['to_date']);
				$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim($this->request->query['from_date']);  
				$condition['Enquiry.posted_date']=$fromdate;	
				print_r($condition);	
				}
				else
				{
					
					}
			}
		
		
		if(isset($this->request->query['search_country']) and ($this->request->query['search_country']!=0) and ($this->request->query['search_country']!='')){$searchCountryId=trim($this->request->query['search_country']);  $condition['Enquiry.country_id']=$searchCountryId;}
		
		if(isset($this->request->query['search_builder']) and ($this->request->query['search_builder']!=0) and ($this->request->query['search_builder']!='')){$searchBuilderId=trim($this->request->query['search_builder']); $condition['Enquiry.builder_id']=$searchBuilderId;}
		

		if(isset($this->request->query['search_project']) and ($this->request->query['search_project']!=0) and ($this->request->query['search_project']!='')){$searchProjectId=trim($this->request->query['search_project']); $condition['Enquiry.project_id']=$searchProjectId;}
		
		if(isset($this->request->query['close_reasons']) and ($this->request->query['close_reasons']!=0) and ($this->request->query['close_reasons']!='')){$searchReasonId=trim($this->request->query['close_reasons']);  $condition['Enquiry.close_reason_id']=$searchReasonId;}
		
		if(isset($this->request->query['lead_source_id']) and ($this->request->query['lead_source_id']!=0) and ($this->request->query['lead_source_id']!='')){$lead_source_id=trim($this->request->query['lead_source_id']);  $condition['Enquiry.lead_source_id']=$lead_source_id;}
		
		if(isset($this->request->query['search_status']) and ($this->request->query['search_status']!='')){$searchStatus=trim($this->request->query['search_status']);  $condition['Enquiry.status']=$searchStatus;}
		
      if(isset($this->request->query['search_user']) and ($this->request->query['search_user']!=0) and ($this->request->query['search_user']!='')){ 
	  $searchUserId=trim($this->request->query['search_user']);
	 
	 if((CakeSession::read('User.type')!='regular')) 
	 { 
			$condition['Enquiry.user_id']=$searchUserId;
		
		}	
		else
		{  
		if ($this->checkOnlyUser($searchUserId)==false) 
		 {
			throw new NotFoundException(__('Invalid enquiry'));
			}
			$condition['Enquiry.user_id']=$searchUserId;
			}
	  }
	  else
	  {
		  
		if(CakeSession::read('User.type')==='regular'){
			$condition['Enquiry.user_id']=CakeSession::read('User.id');
			//$condition['NOT']=array('Enquiry.status'=>"trash");	
		}
		else {
		//$condition['NOT']=array('Enquiry.status'=>"trash");
		}  
		  }
		}
		
		else {
		if(CakeSession::read('User.type')==='regular'){
			$condition['Enquiry.user_id']=CakeSession::read('User.id');
				
		}
		else {
		//$condition['NOT']=array('Enquiry.status'=>"trash");
		}
		}

		$condition['NOT']=array('Enquiry.status'=>"trash");
		
		
		$this->Paginator->settings = array('Enquiry' => array('fields'=>array('Enquiry.status','CloseReason.name','LeadSource.name','Enquiry.name','LeadSource.flag','User.username','User.parent','Enquiry.posted_date','Enquiry.email','Builder.name','Project.name','Country.name','Enquiry.is_discrepency','Enquiry.id','Enquiry.reminder_date','Enquiry.is_reminder','Enquiry.user_id','Enquiry.is_meeting','Enquiry.contact'),'limit' =>20,'order' => array('id' => 'desc'),'conditions'=>$condition));
		//$conditionencrypt = $this->Enquiry->find('sql', array('conditions'=>$condition));
		$this->Enquiry->recursive = 0;
		$this->set('enquiries', $this->Paginator->paginate());
		//$users = $this->Enquiry->User->find('list');
		$builders = $this->Enquiry->Builder->find('list',array('order'=>array('name'=>'asc')));
		$countries = $this->Enquiry->Country->find('list');
		$leadSources = $this->Enquiry->LeadSource->find('list');
		$hcohoneyGroups = $this->HcohoneyGroup->query('select name,groupid from hcohoney_group');
		$hcohoneyUsers = $this->HcohoneyUser->query('select name,userid from hcohoney_users');
		if(isset($this->request->query['search_builder']) and ($this->request->query['search_builder']!=0) and ($this->request->query['search_builder']!='')){$projects = $this->Enquiry->Project->find('list',array('conditions'=>array("Project.builder_id"=>$this->request->query['search_builder'])));}
		$closeReasons = $this->Enquiry->CloseReason->find('list');
		$this->set(compact('users', 'builders', 'countries','closeReasons','projects','leadSources','hcohoneyGroups','hcohoneyUsers'));
		$this->set('conditionencrypt');
		
	}
	
	public function transferToHcohoney($id=null,$dealerid=null,$dealergroup=null,$withremark=null){
		$data='';
		if($id){$data=$this->Enquiry->find('all',array('conditions'=>array('Enquiry.id'=>$id)));}
 
		$remarks='';
		if($withremark==1) {
		foreach($data[0]['Remark'] as $keyy=>$valuee){
			
			if($keyy==0){$remarks.=$valuee['name'];}else{ $remarks.='#'.$valuee['name'];}
			}
			}
		$remoteid=$data[0]['Enquiry']['id'];$assignGroupTo=$dealergroup;$executive_name=$dealerid;$name=$data[0]['Enquiry']['name'];$builder_name=$data[0]['Builder']['name'];$builder_id=$data[0]['Enquiry']['builder_id'];$contact_no=$data[0]['Enquiry']['contact'];$project_name=$data[0]['Project']['name'];$project_id=$data[0]['Enquiry']['project_id'];$email_id=$data[0]['Enquiry']['email'];$countryname=$data[0]['Enquiry']['country_id'];$status='2';$comment=$data[0]['Enquiry']['query'];$type=$data[0]['Enquiry']['lead_source_id'];	
		
		
	$fields_string='';	
	$url = '';
	$fields = array(
	'remoteid' => $remoteid,
	'assignGroupTo' => $assignGroupTo,
	'executive_name' => $executive_name,
	'name' => $name,
	'builder_name' => $builder_name,
	'builder_id' => $builder_id,
	'contact_no' => $contact_no,
	'project_name' => $project_name,
	'project_id' => $project_id,
	'email_id' => $email_id,
	'countryname' => $countryname,
	'status' => $status,
	'comment' => $comment,
	'type' => $type,
	'remarks' => $remarks
	);
	
	foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
	@rtrim($fields_string, '&');
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL, $url);
	curl_setopt($ch,CURLOPT_POST, count($fields));
	curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_exec($ch);
	//$resultStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    //echo $resultStatus ;
	curl_close($ch);
	$this->Enquiry->query('update enquiries set status="trash" , close_reason_id=62 where id='.$id);
    echo 1; exit;
       }
	   
	public function counterDetails($id=null){
		$this->autoRender = false;
		if ($this->request->is('ajax')) {
		if($id) {
			//"select id,name,email,contact,query from enquiries where user_id=".$id." and date(posted_date)='".date('Y-m-d')."'"
		$alldata=$this->Enquiry->find('all',array('conditions'=>array('Enquiry.user_id'=>$id,'date(Enquiry.posted_date)'=>date('Y-m-d'))));
		
		if(!empty($alldata)){
			$data='';
			$data.="<table><tr><th>ID</th><th>NAME</th><th>PROJECT</th><th>SOURCE</th><th>EMAIL</th><th>PHONE</th><th>MESSAGE</th></tr>";
			foreach($alldata as $key=>$value){
			$data.="<tr><td>".$value['Enquiry']['id']."</td><td>".$value['Enquiry']['name']."</td><td>".$value['Project']['name']."</td><td>".$value['LeadSource']['name']."</td><td>".$value['Enquiry']['email']."</td><td>".$value['Enquiry']['contact']."</td><td>".$value['Enquiry']['query']."</td></tr>";

				
				}
			}	
			$data.="</table>";
			}
			return $data;
		}
			
	}
	
	
	public function counterOnparent($parent=null) {
		$this->autoRender = false;
		$data='';
		if($parent) {
			$data=$this->Enquiry->find('all',array('fields'=>array('User.id','User.name','User.last_name','count(Enquiry.id) as total'),'conditions'=>array('date(Enquiry.posted_date)'=>date('Y-m-d'),'Enquiry.user_id'=>$parent,'NOT'=>array('Enquiry.status'=>'trash')),'group'=>array('Enquiry.user_id')));
		}
		
	return $data;
		
	}


   public function moveThis($enqid,$stat){
	$this->autoRender = false;
	$this->layout='ajax';
	if($stat=='Yes'){ $stat='No';}else if($stat=='No'){$stat='Yes';}else{$stat='No';};	
	$result=$this->Enquiry->query("update enquiries set moved='".$stat."',moved_date=NOW() where id=".$enqid);
	echo "1#$stat";
	}



    public function movedData() {
		   $date=date('Y-m-d',strtotime("-1 days"));
		
		$data='';$searchKey=null;$searchUserId=null;$searchCountryId=null;$searchBuilderId=null;$searchProjectId=null;$fromdate=null;$todate=null;
		$searchStatus=null;$pages=null;$condition='';$querySrting=''; $condition=array();
		$conc='';$conditionencrypt='';
		
		if(isset($this->params->query['confirm'])) {
	    
		if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
		
		  $searchKey=trim($this->request->query['search_key']); 
		  $condition['OR']=array('Enquiry.id LIKE'=>'%'.$searchKey.'%','Enquiry.name LIKE'=>'%'.$searchKey.'%','Enquiry.email LIKE'=>'%'.$searchKey.'%','Enquiry.contact LIKE'=>'%'.$searchKey.'%'); 
		 
		  /*$condition2.=' and Enquiry.id LIKE %'.$searchKey.'% || Enquiry.name LIKE %'.$searchKey.'% || Enquiry.email LIKE %'.$searchKey.'% || Enquiry.contact LIKE %'.$searchKey.'%';*/
    }
		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim($this->request->query['from_date']);


				$todate=trim($this->request->query['to_date']);
				$condition['AND']=array('date(Enquiry.moved_date) >='=>$fromdate,'date(Enquiry.moved_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim($this->request->query['from_date']);  
				$condition['date(Enquiry.moved_date)']=$fromdate;	
				}
				else
				{
					
					}
			}
		
		
		if(isset($this->request->query['search_country']) and ($this->request->query['search_country']!=0) and ($this->request->query['search_country']!='')){$searchCountryId=trim($this->request->query['search_country']);  
		$condition['Enquiry.country_id']=$searchCountryId;
		//$condition2.=' and Enquiry.country_id='.$searchCountryId;
		}
		
		if(isset($this->request->query['search_builder']) and ($this->request->query['search_builder']!=0) and ($this->request->query['search_builder']!='')){$searchBuilderId=trim($this->request->query['search_builder']); $condition['Enquiry.builder_id']=$searchBuilderId;
		//$condition2.=' and Enquiry.builder_id='.$searchBuilderId;
		}
		
		if(isset($this->request->query['search_project']) and ($this->request->query['search_project']!=0) and ($this->request->query['search_project']!='')){$searchProjectId=trim($this->request->query['search_project']); $condition['Enquiry.project_id']=$searchProjectId;
		//$condition2.=' and Enquiry.project_id='.$searchProjectId;
		}
		
		if(isset($this->request->query['close_reasons']) and ($this->request->query['close_reasons']!=0) and ($this->request->query['close_reasons']!='')){$searchReasonId=trim($this->request->query['close_reasons']);  $condition['Enquiry.close_reason_id']=$searchReasonId;
		//$condition2.=' and Enquiry.close_reason_id='.$searchReasonId;
		}
		
		if(isset($this->request->query['lead_source_id']) and ($this->request->query['lead_source_id']!=0) and ($this->request->query['lead_source_id']!='')){$lead_source_id=trim($this->request->query['lead_source_id']);  $condition['Enquiry.lead_source_id']=$lead_source_id;
		//$condition2.=' and Enquiry.lead_source_id='.$lead_source_id;
		}
		
		if(isset($this->request->query['search_status']) and ($this->request->query['search_status']!='')){$searchStatus=trim($this->request->query['search_status']);  $condition['Enquiry.status']=$searchStatus;
		//$condition2.=' and Enquiry.status="'.$searchStatus.'"';
		}
		
     if(isset($this->request->query['search_user']) and ($this->request->query['search_user']!='' || $this->request->query['search_user']!=0) and (CakeSession::read('User.type')!='regular'))
		{   
		    $searchUserId=trim($this->request->query['search_user']);
			$condition['Enquiry.user_id']=$searchUserId;
			$pending['Enquiry.user_id']=$searchUserId;
		}	
		
		if(isset($this->request->query['search_user']) and ($this->request->query['search_user']!='' || $this->request->query['search_user']!=0) and (CakeSession::read('User.type')=='regular'))
		{   
		    $searchUserId=trim($this->request->query['search_user']);
			if ($this->checkOnlyUser($searchUserId)==false) {
			throw new NotFoundException(__('Invalid enquiry'));
		}	
		 $condition['Enquiry.user_id']=$searchUserId;
		 $pending['Enquiry.user_id']=$searchUserId;
		 }
		 
		 if(isset($this->request->query['search_user']) and ($this->request->query['search_user']=='' || $this->request->query['search_user']==0) and (CakeSession::read('User.type')=='regular'))
		{
		$condition['Enquiry.user_id']=CakeSession::read('User.id');
		$pending['Enquiry.user_id']=CakeSession::read('User.id');
		}
		
		if(!isset($this->request->query['search_user']) and (CakeSession::read('User.type')=='regular'))
		{
		$condition['Enquiry.user_id']=CakeSession::read('User.id');
		$pending['Enquiry.user_id']=CakeSession::read('User.id');
		}
		}
		
		else {
		$condition['date(Enquiry.moved_date)']=$date;	
		}
        
   if(CakeSession::read('User.type')==='regular')
		{
			 $movedfrom=$this->Enquiry->query("select e.lead_of,u.name,u.last_name,u.colorcode from enquiries as e join users as u on e.lead_of=u.id where e.user_id=".CakeSession::read('User.id')." and  e.lead_of!=e.user_id and e.status='open' group by e.lead_of");
			
		}
		else {
			
			$movedfrom=$this->Enquiry->query("select e.lead_of,u.name,u.last_name,u.colorcode from enquiries as e join users as u on e.lead_of=u.id where e.lead_of!=e.user_id and e.status='open' group by e.lead_of");
			
			}
		//$condition['moved_date']=$date ;
		//$condition2.=' and Enquiry.status!="trash"';
		
		$this->Paginator->settings = array('Enquiry' => array('fields'=>array('Enquiry.status','CloseReason.name','LeadSource.name','Enquiry.name','LeadSource.flag','User.username','User.parent','User.colorcode','Enquiry.posted_date','Enquiry.email','Builder.name','Project.name','Country.name','Enquiry.is_discrepency','Enquiry.id','Enquiry.reminder_date','Enquiry.is_reminder','Enquiry.user_id','Enquiry.is_meeting','Enquiry.lead_of','Enquiry.contact','Enquiry.moved'),'limit' =>50,'order' => array('moved_date' => 'desc'),'conditions'=>$condition));
		//$conditionencrypt = $this->Enquiry->find('sql', array('conditions'=>$condition));
		$this->Enquiry->recursive = 0;
		$this->set('enquiries', $this->Paginator->paginate());
		//$users = $this->Enquiry->User->find('all',array('fields'=>array('id','name','username','parent'),'conditions'=>array('status'=>'active')));
		$users = $this->User->find('list',array('fields'=>array('parent'),'conditions'=>array('status'=>'active')));
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
	
	
	public function markHot($val,$enqid){
	$this->autoRender = false;
	$this->layout='ajax';
	$stat="Nothing Happen";
	if($val=='Y'){$val='N';$stat='Unmarked Successfully'; }else{ $val='Y';$stat='Marked Successfully';};	
	$result=$this->Enquiry->query("update enquiries set hot_lead='".$val."',updated_date=NOW() where id=".$enqid);
	echo $val."##".$stat;
	}
	
	
	 public function movedToLeads($date) {
//echo $date;
	$data=$this->Enquiry->query("select count(*) as total from enquiries where user_id!=lead_of and lead_of!=0 and date(moved_date)='$date'");
	echo " Recycle : ".$data[0][0]['total'];	

}
 public function exportrecycle(){
	   $date=date('Y-m-d',strtotime("-1 days"));
	 $data='';$searchKey=null;$searchUserId=null;$searchCountryId=null;$searchBuilderId=null;$searchProjectId=null;
		$searchStatus=null;$pages=null;$condition='';$querySrting=''; $condition=array();$condition2='';
		$conc='';
		//$username=$this->User->findById(CakeSession::read('User.id'));
		if(isset($this->params->query['confirm'])) {
	   
		if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
		
		$searchKey=trim($this->request->query['search_key']);  
		/*$condition['OR']=array('Enquiry.id LIKE'=>'%'.$searchKey.'%','Enquiry.name LIKE'=>'%'.$searchKey.'%',
'Enquiry.email LIKE'=>'%'.$searchKey.'%','Enquiry.contact LIKE'=>'%'.$searchKey.'%'); */
    $condition2.=' and Enquiry.id LIKE %'.$searchKey.'% || Enquiry.name LIKE %'.$searchKey.'% || Enquiry.email LIKE %'.$searchKey.'% || Enquiry.contact LIKE %'.$searchKey.'%';
	
	}

    if(isset($this->request->query['hot_lead']) and ($this->request->query['hot_lead']=='Y')){
		  $hotlead=trim($this->request->query['hot_lead']);  
		  $condition2.=' and Enquiry.hot_lead="'.$hotlead.'"';
		}
	
	
	if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim($this->request->query['from_date']);
				$todate=trim($this->request->query['to_date']);
				$condition2.=' and date(Enquiry.moved_date)>="'.$fromdate.'" and date(Enquiry.moved_date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim($this->request->query['from_date']);  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(Enquiry.moved_date)="'.$fromdate.'"';
				}
				else
				{
					
					}
			}
			
			

		
		if(isset($this->request->query['search_country']) and ($this->request->query['search_country']!=0) and ($this->request->query['search_country']!='')){$searchCountryId=trim($this->request->query['search_country']);  //$condition['Enquiry.country_id']=$searchCountryId;
		$condition2.=' and Enquiry.country_id='.$searchCountryId;
		
		}
		
		if(isset($this->request->query['search_builder']) and ($this->request->query['search_builder']!=0) and ($this->request->query['search_builder']!='')){$searchBuilderId=trim($this->request->query['search_builder']); //$condition['Enquiry.builder_id']=$searchBuilderId;
		$condition2.=' and Enquiry.builder_id='.$searchBuilderId;
		}
		
		if(isset($this->request->query['search_project']) and ($this->request->query['search_project']!=0) and ($this->request->query['search_project']!='')){$searchProjectId=trim($this->request->query['search_project']); //$condition['Enquiry.project_id']=$searchProjectId;
		$condition2.=' and Enquiry.project_id='.$searchProjectId;
		}
		
		if(isset($this->request->query['close_reasons']) and ($this->request->query['close_reasons']!=0) and ($this->request->query['close_reasons']!='')){$searchReasonId=trim($this->request->query['close_reasons']);  //$condition['Enquiry.close_reason_id']=$searchReasonId;
		$condition2.=' and Enquiry.close_reason_id='.$searchReasonId;
		}
		
		if(isset($this->request->query['lead_source_id']) and ($this->request->query['lead_source_id']!=0) and ($this->request->query['lead_source_id']!='')){$lead_source_id=trim($this->request->query['lead_source_id']);  //$condition['Enquiry.lead_source_id']=$lead_source_id;
		$condition2.=' and Enquiry.lead_source_id='.$lead_source_id;
		}
		
		if(isset($this->request->query['search_status']) and ($this->request->query['search_status']!='')){$searchStatus=trim($this->request->query['search_status']);  //$condition['Enquiry.status']=$searchStatus;
		$condition2.=' and Enquiry.status="'.$searchStatus.'"';
		}	
		
		if(isset($this->request->query['search_user']) and ($this->request->query['search_user']!='' || $this->request->query['search_user']!=0) and (CakeSession::read('User.type')!='regular'))
		{   
		    $searchUserId=trim($this->request->query['search_user']);
			$condition2.=' and Enquiry.user_id='.$searchUserId;
		}
		
		if(isset($this->request->query['search_user']) and ($this->request->query['search_user']!='' || $this->request->query['search_user']!=0) and (CakeSession::read('User.type')=='regular'))
		{   
		    $searchUserId=trim($this->request->query['search_user']);
			if ($this->checkOnlyUser($searchUserId)==false) {
			throw new NotFoundException(__('Invalid enquiry'));
		}	
		 $condition2.=' and Enquiry.user_id='.$searchUserId;
		 }
		 
		 if(isset($this->request->query['search_user']) and ($this->request->query['search_user']=='' || $this->request->query['search_user']==0) and (CakeSession::read('User.type')=='regular'))
		{
		$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
		}
		
		if(!isset($this->request->query['search_user']) and (CakeSession::read('User.type')=='regular'))
		{
		$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
		}
		}
		else {
		if(CakeSession::read('User.type')==='regular'){
			$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
			//$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
            
				
		}
		else {
		  	
		}
         $condition2.=' and date(Enquiry.moved_date)="'.$date.'"';
		}
		//$condition['NOT']=array('Enquiry.status'=>"trash");
        
		$condition2.=' and Enquiry.status!="trash"';
		$this->response->download("data.csv");
		//print_r($condition); exit;
		$data=$this->Enquiry->query('select Enquiry.id,Enquiry.posted_date,Enquiry.name,Enquiry.email,Enquiry.contact,Project.name,Country.name,Enquiry.status,LeadSource.name from enquiries as Enquiry left join users as User on Enquiry.user_id=User.id left join projects as Project  on Enquiry.project_id=Project.id left join countries as Country   on Enquiry.country_id=Country.id left join lead_sources as LeadSource  on Enquiry.lead_source_id=LeadSource.id  where 1 '.$condition2.'order by moved_date desc');
		
		
		//$data = $this->Enquiry->find('all', array('fields'=>array('Enquiry.id','Posted On' => 'Posted On','Enquiry.name','Enquiry.email','Enquiry.contact','Project.name','Country.name','Enquiry.status','LeadSource.name'),'order' => array('id' => 'desc'),'conditions'=>$condition));
		
		//$log = $this->Enquiry->getDataSource()->getLog(false, false);
        //debug($log);
		//exit;
		
	$headers = array('Enquiry'=>array( 'Id' => 'Id','Posted On' => 'Posted On', 'Name' => 'Name', 'Email' => 'Email', 'Contact' => 'Contact', 'Project' => 'Project', 'Country' => 'Country', 'Status' => 'Status', 'Lead Source' => 'Lead Source', 'Remark 3' => 'Remark 3', 'Remark 2' => 'Remark 2', 'Remark 1' => 'Remark 1')); 
	    $this->set(compact('data','headers'));
		$this->layout = 'ajax';
		return;
		
		}
	
	public function show($contact= null) {
		 //echo $phone;
		 //die();
		

		//$condition['NOT']=array('Enquiry.status'=>"trash");
		$condition=$rnumber;
		//$condition['Enquiry.user_id']=='243';
		
		$this->Paginator->settings = array('Enquiry' => array('fields'=>array('Enquiry.status','Enquiry.hot_lead','CloseReason.name','LeadSource.name','Enquiry.name','LeadSource.flag','User.username','User.colorcode','User.parent','Enquiry.posted_date','Enquiry.email','Builder.name','Project.name','Country.name','Enquiry.is_discrepency','Enquiry.id','Enquiry.reminder_date','Enquiry.is_reminder','Enquiry.user_id','Enquiry.is_meeting','Enquiry.contact','Enquiry.lead_of','Enquiry.marked_or_not'),'limit' =>10,'order' => array('id' => 'desc'),
		'conditions'=>array('contact'=>$contact)));
		//$conditionencrypt = $this->Enquiry->find('sql', array('conditions'=>$condition));
		$this->Enquiry->recursive = 0;
		$this->set('enquiries', $this->Paginator->paginate());
		
		$this->set('movedfrom', $movedfrom);
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
		
	
	
	
}