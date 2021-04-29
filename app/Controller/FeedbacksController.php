<?php
App::uses('AppController', 'Controller');
/**
 * Cities Controller
 *
 * @property City $City
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class FeedbacksController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
	var  $uses = array('Feedback','CompanyDetail');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Paginator->settings = array('Feedback' => array('limit' =>10,'order' => array('name' => 'asc')));
		$this->Feedback->recursive = 0;
		$this->set('issuecategorys', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Feedback->exists($id)) {
			throw new NotFoundException(__('Invalid Feedback'));
		}
		$options = array('conditions' => array('Feedback.' . $this->Feedback->primaryKey => $id));
		$this->set('feedback', $this->Feedback->find('first',$options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Feedback->create();
			if ($this->Feedback->save($this->request->data)) {
                          //  print_r($this->request->data); die();
				$this->Session->setFlash(__('The Feedback has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Issue Category could not be saved. Please, try again.'));
			}
		}
                
		$this->set('company', $this->CompanyDetail->find('list'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Feedback->exists($id)) {
			throw new NotFoundException(__('Invalid Feedback'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Feedback->save($this->request->data)) {
				$this->Session->setFlash(__('The Feedback has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The  Feedback could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Feedback.' . $this->Feedback->primaryKey => $id));
			$this->request->data = $this->Feedback->find('first', $options);
		}
	$this->set('company', $this->CompanyDetail->find('list'));	
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	 public function delete($id = null,$status=null) {
		$this->Feedback->id = $id;
		if (!$this->Feedback->exists()) {
			throw new NotFoundException(__('Invalid Description Detail'));
		}
		    //$this->request->onlyAllow('post', 'delete');
               $get=$this->Feedback->find('first',array("conditions"=>array('Feedback.id'=>$id)));
              //print_r($get['Feedback']['status']); die();
              if($get['Feedback']['status']=='active'){
                  $status='deactive';
              }else { $status='active';} 
		    $this->Feedback->read(null,$id);
			$this->Feedback->set(array('status'=>$status));
		
		if ($this->Feedback->save()) {
			$this->Session->setFlash(__('Description has been '.$status));
		} else {
			$this->Session->setFlash(__('Nothing happen. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
        public function getblocks($stateid) {
	    $this->layout='ajax';
        $this->autoRender = false;
	    $data='<option value="">Select Block</option>';
		$subcatlist=$this->IssueCategory->find('list',array("conditions"=>array('city_id'=>$stateid)));
		foreach($subcatlist as $key=>$value){ $data.='<option value="'.$key.'">'.$value.'</option>';}
		return $data;
	}
        
        public function gettitle($id) {
	  
		$options = array('conditions' => array('Feedback.' . $this->Feedback->primaryKey => $id));
		$data=$this->Feedback->find('first',$options);
		return $data;
	}
             
        
          public function gettitles($id) {
	   $this->layout='ajax';
        $this->autoRender = false;
        $data='<option value="">--Select--</option>';
		$options = array('conditions' => array('Feedback.category'=> $id));
		$subcatlist=$this->Feedback->find('list',$options);
		foreach($subcatlist as $key=>$value){ $data.='<option value="'.$key.'">'.$value.'</option>';}
		return $data;
	}
             
                
}
