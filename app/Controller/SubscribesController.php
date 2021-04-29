<?php
App::uses('AppController', 'Controller');
/**
 * MailerFeeds Controller
 *
 * @property MailerFeed $MailerFeed
 * @property PaginatorComponent $Paginator
 */
class SubscribesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Mail');

/**
 * index method
 *
 * @return void
 */
	public function index($status="Not verified") {
		$this->Paginator->settings = array('Subscribe' => array('limit' =>20,'conditions'=>array("status"=>$status),'order' => array('id' => 'desc')));
		$this->Subscribe->recursive = 0;
		$this->set('subscribes', $this->Paginator->paginate());
	}


    private function cheackLead($id=null){	
	if($id){

		$data=$this->Subscribe->findById($id);
		if(!empty($data['Subscribe']['email']))
		{
			return $data['Subscribe']['email']."##".$data['Subscribe']['website'];
		}
		else {
			
			return false;
			}
		
		}
	}
 
 public function sendSubscription() {
		
	 $this->layout="ajax";
	 $this->autoRender =false;
	 
	 if($this->request->is('ajax')) {
		$msg='';
		$email=array();
		$website=array();
		if (isset($this->request->query['params']) and $this->request->query['params']!="") {
		$params=trim($this->request->query['params'],'{   }');
		$ids=@explode(',',$params);
		if (!empty($ids)) { 
		               foreach($ids as $key=>$value) 
					    {
			             $emailAndWeb=$this->cheackLead($value);
			              if($emailAndWeb!=false)
			               {  
						    list($e,$w) =@explode("##",$emailAndWeb);
						     $email[$value]=$e;
							 $website[$value]=$w;
				             //$this->Enquiry->query("update  enquiries set marked_or_not='Y' where id=".$value);
				             //$msg="Marking done";
				           }
				             
			
			
		}
		if(!empty($email))
		{ 
		$keys=implode(",", array_keys($email));
		$this->Subscribe->query("update  subscribes set mail_sent='Yes' ,mail_counter=mail_counter+1,mail_sent_on=now() where id in ( ".$keys." )");
		$this->Mail->sendSubscriptionMail($email,$website);
		$msg="mail sent successfully";
		$this->Session->setFlash(__('mail sent successfully'));
		}
		else
			{
			 $msg="Error occure .Please try again";
			 $this->Session->setFlash(__('Error occure .Please try again'));
			}
			
		}
		
		}
	 }
	 else {
			
			$msg='Invalid request';
		}
		
		echo $msg ;	
			
	}
	


	public function view($id = null) {
		if (!$this->Subscribe->exists($id)) {
			throw new NotFoundException(__('Invalid id'));
		}
		$emailAndWeb=$this->cheackLead($id);
		 if($emailAndWeb!=false)
			               {  
						    list($e,$w) =@explode("##",$emailAndWeb);
						     $email[$id]=$e;
							 $website[$id]=$w;
							 $this->Subscribe->query("update  subscribes set mail_sent='Yes' ,mail_counter=mail_counter+1,mail_sent_on='now()' where id in ( ".$id." )");
				           }
		$this->Mail->sendSubscriptionMail($email,$website);
		$this->Session->setFlash(__('mail sent successfully'));
		return $this->redirect(array('action' => 'index'));
	}
	
	
	/*public function delete($id = null) {
		$this->MailerFeed->id = $id;
		if (!$this->MailerFeed->exists()) {
			throw new NotFoundException(__('Invalid mailer feed'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->MailerFeed->delete()) {
			$this->Session->setFlash(__('The mailer feed has been deleted.'));
		} else {
			$this->Session->setFlash(__('The mailer feed could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}*/
	
	
	
	}
