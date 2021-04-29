<?php
App::uses('AppController', 'Controller');
/**
 * MailerFeeds Controller
 *
 * @property MailerFeed $MailerFeed
 * @property PaginatorComponent $Paginator
 */
class MailerFeedsController extends AppController {

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
		$this->Paginator->settings = array('MailerFeed' => array('limit' =>20,'order' => array('id' => 'desc')));
		$this->MailerFeed->recursive = 0;
		$this->set('mailerFeeds', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->MailerFeed->exists($id)) {
			throw new NotFoundException(__('Invalid mailer feed'));
		}
		$options = array('conditions' => array('MailerFeed.' . $this->MailerFeed->primaryKey => $id));
		$this->set('mailerFeed', $this->MailerFeed->find('first', $options));
	}
	
	public function dailyAll() {
		$yesterday=date('Y-m-d',strtotime("-1 days"));
		$options = array('conditions' => array('date(MailerFeed.posted)'=>$yesterday));
		$data=$this->MailerFeed->find('all', $options);
		return $data; 
		//$log = $this->MailerFeed->getDataSource()->getLog(false, false);
        //debug($log);
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->MailerFeed->create();
			if ($this->MailerFeed->save($this->request->data)) {
				$this->Session->setFlash(__('The mailer feed has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mailer feed could not be saved. Please, try again.'));
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
		if (!$this->MailerFeed->exists($id)) {
			throw new NotFoundException(__('Invalid mailer feed'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->MailerFeed->save($this->request->data)) {
				$this->Session->setFlash(__('The mailer feed has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mailer feed could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('MailerFeed.' . $this->MailerFeed->primaryKey => $id));
			$this->request->data = $this->MailerFeed->find('first', $options);
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
	}}
