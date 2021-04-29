<?php
App::uses('AppController', 'Controller');
/**
 * Discrepencies Controller
 *
 * @property Discrepency $Discrepency
 * @property PaginatorComponent $Paginator
 */
class DiscrepenciesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Mail');
	 var  $uses = array('Discrepency','User','Enquiry','Remark');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Discrepency->recursive = 0;
		$this->set('discrepencies', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Enquiry->exists($id)) {
			throw new NotFoundException(__('Invalid Lead'));
		}
		
		$enquiry=$this->Enquiry->find('first', array('conditions' => array('Enquiry.' . $this->Enquiry->primaryKey => $id)));
		
		
		if ($this->request->is('post')) {
			if (!$this->Enquiry->exists($id)) {
			throw new NotFoundException(__('Invalid Lead'));
		}
			$this->Discrepency->create();
			$this->Discrepency->data['Discrepency']['posted']=date("Y-m-d H:i:s");
			$this->Discrepency->data['Discrepency']['feedBy']=CakeSession::read('User.id');;
			if ($this->Discrepency->save($this->request->data)) {
	
	$tldata='';
	if(isset($this->request->data['Discrepency']['status']) and $this->request->data['Discrepency']['status']=='D')
			{
			$this->Enquiry->query("update enquiries set is_discrepency='no' where id=".$id);
				}
				else
				{
					$this->Enquiry->query("update enquiries set is_discrepency='Y' where id=".$id);
					}
	
			$remarks=$this->Remark->query('select name,posted_date from remarks where enquiry_id="'.$id.'" order by id desc limit 3');	
			
			if($enquiry['User']['parent']!=0) { $tldata=$this->User->query('select name,username,email from users where id="'.$enquiry['User']['parent'].'"');}	
			
			$this->Mail->sendDiscrepencyMail($enquiry['Enquiry']['id'],$enquiry['Project']['name'],$enquiry['Enquiry']['name'],$enquiry['Enquiry']['email'],$enquiry['Enquiry']['contact'],$enquiry['Enquiry']['reminder_date'],$enquiry['User']['username'],$enquiry['User']['email'],addslashes($this->request->data['Discrepency']['comment']),$remarks,$tldata);
			
			
			
			
			$this->Session->setFlash(__('Your message has been sent successfully'));
			return $this->redirect(array('controller' => 'discrepencies','action' => 'view',$id));
			} 
			else {
			$this->Session->setFlash(__('error occure. Please, try again.'));
			}
		}
		
		$options = array('conditions' => array('Discrepency.enquiry_id' => $id),'order'=>array('Discrepency.id'=>'asc'));
		$discrepencies=$this->Discrepency->find('all', $options);
		
		//$projects = $this->Project->find('list');
		//$users = $this->User->find('list');
		//$projects = $this->Project->find('list');
		$this->set(compact('enquiry','discrepencies'));
		$this->layout="sub-default";
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Discrepency->create();
			if ($this->Discrepency->save($this->request->data)) {
				$this->Session->setFlash(__('The discrepency has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The discrepency could not be saved. Please, try again.'));
			}
		}
		$enquiries = $this->Discrepency->Enquiry->find('list');
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
		if (!$this->Discrepency->exists($id)) {
			throw new NotFoundException(__('Invalid discrepency'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Discrepency->save($this->request->data)) {
				$this->Session->setFlash(__('The discrepency has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The discrepency could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Discrepency.' . $this->Discrepency->primaryKey => $id));
			$this->request->data = $this->Discrepency->find('first', $options);
		}
		$enquiries = $this->Discrepency->Enquiry->find('list');
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
		$this->Discrepency->id = $id;
		if (!$this->Discrepency->exists()) {
			throw new NotFoundException(__('Invalid discrepency'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Discrepency->delete()) {
			$this->Session->setFlash(__('The discrepency has been deleted.'));
		} else {
			$this->Session->setFlash(__('The discrepency could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
