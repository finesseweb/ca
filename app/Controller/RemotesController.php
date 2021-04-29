<?php
App::uses('AppController', 'Controller');
/**
 * Remotes Controller
 *
 * @property Remote $Remote
 * @property PaginatorComponent $Paginator
 */
class RemotesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Mail','Sms');
    var  $uses = array('Remote','Enquiry','User','Builder','Project','Country','LeadSource');
/**
 * index method
 *
 * @return void
 */
	public function index() {
		if(isset($this->params->query['confirm'])) {
			//echo $this->request->query['search_project'];
			//die();
		if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
		
		  $searchKey=trim($this->request->query['search_key']); 
		  $condition['OR']=array('Remote.website LIKE'=>'%'.$searchKey.'%','Remote.project_name LIKE'=>'%'.$searchKey.'%','Remote.client LIKE'=>'%'.$searchKey.'%','Remote.phone LIKE'=>'%'.$searchKey.'%','Remote.email LIKE'=>'%'.$searchKey.'%'); 
		  }
		  /*if(isset($this->request->query['search_project']) and ($this->request->query['search_project']!=0) and ($this->request->query['search_project']!='')){$searchProject=$this->request->query['search_project']; 
		  $condition['OR']=array('Remote.project_name LIKE'=>$searchProject);}*/
		$this->Paginator->settings = array('Remote' => array('limit' =>20,'order' => array('posted_on' => 'desc'),'conditions'=>$condition));
		$this->Remote->recursive = 0;
		$this->set('remotes', $this->Paginator->paginate());
		}
		else {
		$this->Paginator->settings = array('Remote' => array('limit' =>20,'order' => array('posted_on' => 'desc')));
		$this->Remote->recursive = 0;
		$this->set('remotes', $this->Paginator->paginate());
		}
	
	$builders = $this->Builder->find('list',array('order'=>array('name'=>'asc')));
	if(isset($this->request->query['search_builder']) and ($this->request->query['search_builder']!=0 || $this->request->query['search_builder']!='')){$projects = $this->Project->find('list',array('conditions'=>array("Project.builder_id"=>$this->request->query['search_builder'])));}
	
	$this->set(compact('builders','projects'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Remote->exists($id)) {
			throw new NotFoundException(__('Invalid remote'));
		}
		$options = array('conditions' => array('Remote.' . $this->Remote->primaryKey => $id));
		$this->set('remote', $this->Remote->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Remote->create();
			if ($this->Remote->save($this->request->data)) {
				$this->Session->setFlash(__('The remote has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The remote could not be saved. Please, try again.'));
			}
		}
	}


/**
 * import method
 *
 * @return void
 */	
	
	
	public function import_remote() {
		if ($this->request->is('post')) {
			$this->Remote->create();
			  
   // Allowed mime types
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
    // Validate whether selected file is a CSV file
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
        
        // If the file is uploaded
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            
            // Skip the first line
            fgetcsv($csvFile);
            
            // Parse data from CSV file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
                // Get row data
                $website   = $line[0];
                $project_name  = $line[1];
                $client  = $line[2];
                $phone = $line[3];
				$email = $line[4];
				$country = $line[5];
				//$posted_on = NOW();
				$message = $line[7];
				//$source_link = $line[8];	
				//$enquiry_id = $line[8];
				
				$this->Remote->query("insert into remotes set website='".$website."',project_name='".$project_name."',client='".$client."',phone='".$phone."',email='".$email."',country='".$country."',posted_on='".date("Y-m-d H:i:s")."',message='".$message."'");
                
                    
            }
            
            // Close opened CSV file
            fclose($csvFile);
            
            $qstring = '?status=succ';
        }else{
            $qstring = '?status=err';
        }
    }else{
        $qstring = '?status=invalid_file';
    }

				$this->Session->setFlash(__('The remote has been saved.'));
				return $this->redirect(array('action' => 'index'));
			
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
		if (!$this->Remote->exists($id)) {
			throw new NotFoundException(__('Invalid remote'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Remote->save($this->request->data)) {

            
                $userid=@explode("##",$this->request->data['Remote']['user_id']);
				$countryid=@explode("##",$this->request->data['Remote']['country']);
				$projectid=@explode("##",$this->request->data['Remote']['project_id']);
				$userName=$this->User->findById($userid[0]);
				$phonenum = $userName['User']['phone']; 
                $message = 'Name : '.$this->request->data['Remote']['client'].',contact : '.$this->request->data['Remote']['phone'].',Email : '.$this->request->data['Remote']['email'].',Project : '.$projectid[1].',Executive : '.$userid[1].',Country : '.$countryid[1];
                $debug = true;
               // if($phonenum!=''){$this->Sms->smsSend($phonenum,$message,$debug);}

				$this->Enquiry->set(array('name'=>$this->request->data['Remote']['client'],'contact'=>$this->request->data['Remote']['phone'],'user_id'=>$userid[0],'lead_of'=>$userid[0],'email'=>$this->request->data['Remote']['email'],'country_id'=>$countryid[0],'query'=>$this->request->data['Remote']['message'],'builder_id'=>$this->request->data['Remote']['builder_id'],'project_id'=>$projectid[0],'history_by_project'=>$projectid[0],'lead_source_id'=>$this->request->data['Remote']['lead_source_id'],'posted_date'=>$this->request->data['Remote']['posted_date']));
		if($this->Enquiry->save()) {
		
		    $this->Remote->read(null,$id);
			$this->Remote->set(array('enquiry_id'=>$this->Enquiry->getLastInsertId()));
			$this->Remote->save();
			
			
			//$projectName=$this->Project->findById($this->request->data['Remote']['project_id']);
			//countryName=$this->Country->findById($this->request->data['Remote']['country']);
			
		
		$this->Mail->sendEnquiryMail($userName['User']['name'],$userName['User']['last_name'],$userName['User']['email'],addslashes($this->request->data['Remote']['client']),addslashes($this->request->data['Remote']['email']),addslashes($this->request->data['Remote']['phone']),$projectid[1],$countryid[1],addslashes($this->request->data['Remote']['message']));
		
		

		
				$this->Session->setFlash(__('The remote has been saved.'));
				return $this->redirect(array('action' => 'index'));
		}
			} else {
				$this->Session->setFlash(__('The entry is duplicate or another issue. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Remote.' . $this->Remote->primaryKey => $id));
			$this->request->data = $this->Remote->find('first', $options);
		}

        $countrdata="";$countryarray="";
			$countryarray=@explode("##",$this->request->data['Remote']['country']);
			if(!empty($countryarray)) { 
			if(isset($countryarray[1]) and $countryarray[1]!='') {  
			$countryval=$this->Country->query("select * from  countries where name like '%".$countryarray[1]."%'");
			if(empty($countryval)) {
		    $countryarray[1]=(int)$countryarray[1]; $countryval=$this->Country->query("select * from  countries where id =".$countryarray[1]);
			}
			}
			if(empty($countryval) and $countryarray[0]!='')  {  
			if(is_numeric($countryarray[0])){ $countryval=$this->Country->query("select * from  countries where id =".$countryarray[0]); }
			if(empty($countryval)) {   $countryval=$this->Country->query("select * from  countries where name like '%".$countryarray[0]."%'" );}
			}
			}
			if(!empty($countryval[0]['countries'])){
			$countrdata=$countryval[0]['countries']['id']."##".$countryval[0]['countries']['name'];
			}
			$this->set("selectedcon",$countrdata);
			$leadsourceval=14;
			$leadsource=array(9=>"LRGGroups.com");
			$website=strtolower($this->request->data['Remote']['website']);
			foreach($leadsource as $key=>$val)
			{
				if(strtolower($val)==$website)
				{ 
				$leadsourceval=$key;
				break;
				}
				
				}
			$this->set("leadsourceval",$leadsourceval);
		
		$builders = $this->Builder->find('list',array('order'=>array('name'=>'asc')));
		$users = $this->User->find('all',array('fields'=>array('name','last_name','id'),'conditions'=>array('status'=>'active')));
		$countries = $this->Country->find('list');
		$leadSources = $this->LeadSource->find('list');
		$this->set(compact('builders','countries','leadSources','users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Remote->id = $id;
		if (!$this->Remote->exists()) {
			throw new NotFoundException(__('Invalid remote'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Remote->delete()) {
			$this->Session->setFlash(__('The remote has been deleted.'));
		} else {
			$this->Session->setFlash(__('The remote could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	public  function remoteserver()
	{       $this->layout='ajax';
            $this->autoRender = false;
			if(!empty($this->request->data['client'])){
			$this->Remote->query("insert into remotes set website='".$this->request->data['website']."',project_name='".$this->request->data['project_name']."',client='".$this->request->data['client']."',phone='".$this->request->data['phone']."',email='".$this->request->data['email']."',country='".$this->request->data['country']."',posted_on='".date("Y-m-d H:i:s")."',message='".$this->request->data['message']."'");
			}
			
		}
		
		public function multidelete() {
		if(!empty($this->request['data']['multi_delete'])) {
		foreach ($this->request['data']['multi_delete'] as $key=>$value):
		$this->Remote->id=$value;
		$this->Remote->delete();
		endforeach;
		$this->Session->setFlash(__('data deleted successfully'));
		$this->redirect(array('action' => 'index'));
		}
		else
		{
		$this->Session->setFlash(__("can't deleted.Please select at leaste one row"));
		$this->redirect(array('action' => 'index'));
		
		}
		}
	

	
	}
