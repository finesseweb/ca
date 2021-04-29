<?php
App::uses('AppController', 'Controller');
/**
 * UserAccesses Controller
 *
 * @property UserAccess $UserAccess
 * @property PaginatorComponent $Paginator
 */
class UserAccessesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
    var  $uses = array('UserAccess','ManageOtp','User');

/**
 * index method
 *
 * @return void
 */
	public function index() {
            
           $data='';$searchKey=null;$searchUserId=null;$searchBuilderId=null;$searchProjectId=null;$fromdate=null;$todate=null;
		$condition='';$querySrting=''; $condition=array();
		$conc='';
		if(isset($this->params->query['confirm'])) {
                    
                if(isset($this->request->query['user'])){$searchProjectId=trim($this->request->query['user']);
		$condition['UserAccess.name']=$searchProjectId;
                
		}  
               
                }
		if ($this->request->is(array('post', 'put'))) {
			if(!empty($this->request->data['UserAccess']['id'])) {
			foreach($this->request->data['UserAccess']['id'] as $key=>$value){
			
			$id=$this->request->data['UserAccess']['id'][$key];
			$name=$this->request->data['UserAccess']['name'][$key];
			$type=$this->request->data['UserAccess']['type'][$key];
			if(trim($name)!='') {
			$this->UserAccess->read(null,$id);
			$this->UserAccess->set(array('name'=>$name,'type'=>$type));
			$savedata=$this->UserAccess->save();
			}
			else
			{
				$this->UserAccess->delete($id);
				}
				
			}
			$this->Session->setFlash(__('Data updated successfully'));
			return $this->redirect(array('action' => 'index'));
		}
		}
                
                $executives=$this->User->find('all',array('order'=>array('username'=>'asc'),'conditions'=>array('User.status'=>'active')));
	          
		$this->Paginator->settings = array('UserAccess' => array('limit' =>50,'order' => array('id' => 'desc'),'conditions'=>$condition));
		$this->UserAccess->recursive = 0;
		$this->set('userAccesses', $this->Paginator->paginate());
		$this->set(compact('executives'));
	}
	
	public function changeIp() {
		
		if ($this->request->is(array('post', 'put'))) {
			if(trim($this->request->data['UserAccess']['password'])==''){ 
			$this->Session->setFlash(__('Password should not be left blank.'));
			return $this->redirect(array('action' => 'changeIp'));
			}
			else if(!empty($this->request->data['UserAccess']['name']) and ($this->request->data['UserAccess']['password']==='')) {
			foreach($this->request->data['UserAccess']['name'] as $key=>$value){
			
			$id=$this->request->data['UserAccess']['id'][$key];
			$name=$this->request->data['UserAccess']['name'][$key];
		    $type='ip';
			if(!empty($id) && !empty($name)) { 
			$this->UserAccess->read(null,$id);
			$this->UserAccess->set(array('name'=>$name,'type'=>$type));
			$savedata=$this->UserAccess->save();
			}
			else if(empty($id) && !empty($name)) {
			$this->UserAccess->create();
			$this->UserAccess->set(array('name'=>$name,'type'=>$type));
			$savedata=$this->UserAccess->save();
			}
			else
			{	
				}
				
			}
			$this->Session->setFlash(__('Data updated successfully'));
			return $this->redirect(array('action' => 'changeIp'));
		}
			else
			{
			$this->Session->setFlash(__('nothing happen.Wrong Password'));
			return $this->redirect(array('action' => 'changeIp'));
				}
		}
		
		$this->UserAccess->recursive = 0;
		$this->Paginator->settings = array('UserAccess' => array('conditions'=>array('UserAccess.type'=>'ip')));
		$this->set('userAccesses', $this->Paginator->paginate());
		$this->layout='ajax';
		
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->UserAccess->exists($id)) {
			throw new NotFoundException(__('Invalid user access'));
		}
		$options = array('conditions' => array('UserAccess.' . $this->UserAccess->primaryKey => $id));
		$this->set('userAccess', $this->UserAccess->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$date=date('Y-m-d H:i:s');
			$this->request->data['UserAccess']['updated_date']=$date;
			$this->request->data['UserAccess']['updated_by']=CakeSession::read('User.id');
			$this->UserAccess->create();
			if ($this->UserAccess->save($this->request->data)) {
				$this->Session->setFlash(__('The user access has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user access could not be saved. Please, try again.'));
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
		if (!$this->UserAccess->exists($id)) {
			throw new NotFoundException(__('Invalid user access'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->UserAccess->save($this->request->data)) {
				$this->Session->setFlash(__('The user access has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user access could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('UserAccess.' . $this->UserAccess->primaryKey => $id));
			$this->request->data = $this->UserAccess->find('first', $options);
		}
	}
	
	
	public function otpOnPassword() {
	$this->layout='ajax';
	
		if ($this->request->is(array('post', 'put'))) {
		
		if(trim($this->request->data['userAccesses']['username'])=='' || trim($this->request->data['userAccesses']['password'])==''){ 
			$this->Session->setFlash(__('Username and Password should not be left blank.'));
			return $this->redirect(array('action' => 'otpOnPassword'));
			}
			else if(!empty($this->request->data['userAccesses']['username']) and (!empty($this->request->data['userAccesses']['password']))  and ($this->request->data['userAccesses']['username']==='admin@crmtech') and ($this->request->data['userAccesses']['password']==='')) {
			
			$this->Session->write('OTP',array('VALIDUSER'=>"admin@crmtech"));
		    return $this->redirect(array('action' => 'otpOnPassword'));
		}
		else
		{
		
		$this->Session->setFlash(__('Invalid Username and Password .'));
		return $this->redirect(array('action' => 'otpOnPassword'));
		}
		
		}
		if(isset($this->request->params['pass'][0]))
		{
		$this->Session->delete('OTP');
	    $this->Session->setFlash('You have successfully logged out.');
	   $this->redirect(array('action'=>'otpOnPassword'));
		}
		else if ($this->Session->check('OTP')) {
		$otps=$this->ManageOtp->find('all',array('fields'=>array('ManageOtp.name','ManageOtp.otp'),'conditions'=>array('date(otptime)'=>date('Y-m-d')),'limit' =>50,'order'=>array('id'=>'desc')));
		//$this->Paginator->settings = array('ManageOtp' => array('fields'=>array('ManageOtp.name','ManageOtp.otp'),'conditions'=>array('date(ManageOtp.otptime)'=>'curdate()'),'limit' =>50));
		$this->set('otps', $otps);
		}
		
		else{
		
		$this->set('otps', '');
		}
		
		
	}
	

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	/*public function delete($id = null) {
		$this->UserAccess->id = $id;
		if (!$this->UserAccess->exists()) {
			throw new NotFoundException(__('Invalid user access'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->UserAccess->delete()) {
			$this->Session->setFlash(__('The user access has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user access could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}*/
	
	}
