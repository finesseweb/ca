<?php
App::uses('AppController', 'Controller');
/**
 * Cities Controller
 *
 * @property City $City
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class InitiateBillController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
	var  $uses = array('InitiateBill','Financial','CompanyDetail','Overhead','OverheadDetail','Period','ReportingPeriod','Ngo','Subcategory','Bpc','Bpccc','Dpo');

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
	   
		if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('InitiateBill.id LIKE'=>'%'.$searchKey.'%','InitiateBill.amount LIKE'=>'%'.$searchKey.'%'); 
	
	}
//		
//		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
//			
//			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
//			{
//				$fromdate=trim($this->request->query['from_date']);
//				$todate=trim($this->request->query['to_date']);
//				$condition['AND']=array('date(Ngo.date_of_booking) >='=>$fromdate,'date(Ngo.date_of_booking) <='=>$todate);
//				}
//				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
//					
//				$fromdate=trim($this->request->query['from_date']);  
//				$condition['Ngo.date_of_booking']=$fromdate;	
//				}
//				
//			}
		
		if(isset($this->request->query['organization']) and ($this->request->query['organization']!=0) and ($this->request->query['organization']!='')){$searchBuilderId=trim($this->request->query['organization']); 
		$condition['InitiateBill.organization']=$searchBuilderId;
		}
		
		if(isset($this->request->query['category']) and ($this->request->query['category']!=0) and ($this->request->query['category']!='')){$searchProjectId=trim($this->request->query['category']);
		$condition['InitiateBill.cat_id']=$searchProjectId;
		}
		
		if(isset($this->request->query['subcategory']) and ($this->request->query['subcategory']!=0) and ($this->request->query['category']!='')){$searchSubID=trim($this->request->query['subcategory']);
		$condition['InitiateBill.subcat_id']=$searchSubID;
		}
		
	}
        
       	
	        $this->Paginator->settings = array('InitiateBill' => array('limit' =>20,'order' => array('id' => 'desc'),'conditions'=>array($condition,'InitiateBill.status'=>'active')));
		$this->InitiateBill->recursive = 0;
		$this->set('financials', $this->Paginator->paginate());
		
		 $ngos=$this->Ngo->find('list');
                 $cats=$this->Financial->find('list',array('order'=>array('name'=>'asc')));
                 $subcats=$this->Subcategory->find('list',array('order'=>array('name'=>'asc')));
                 $this->set(compact('ngos','cats','subcats'));
			
			
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function viewdetails($id = null) {
//		if (!$this->InitiateBill->exists($id)) {
//			throw new NotFoundException(__('Invalid financial details'));
//		}
		$options = array('conditions' => array('InitiateBill.cat_id' => $id));
		$this->set('financials', $this->InitiateBill->find('all', $options));
                $this->layout='newdefault';
	}
        
        
        public function listoverhead() {
//		if (!$this->InitiateBill->exists($id)) {
//			throw new NotFoundException(__('Invalid financial details'));
//		}
                $this->Paginator->settings = array('OverheadDetail' => array('limit' =>20,'order' => array('id' => 'desc'),'conditions'=>array('OverheadDetail.status'=>'active'),'table'=>'overhead_details'));
		$this->OverheadDetail->recursive = 0;
		$this->set('financials', $this->Paginator->paginate('OverheadDetail'));
		
		
	}
        
        
        public function view($id = null) {
		if (!$this->InitiateBill->exists($id)) {
			throw new NotFoundException(__('Invalid financial details'));
		}
		$options = array('conditions' => array('InitiateBill.' . $this->InitiateBill->primaryKey => $id));
		$this->set('financial', $this->InitiateBill->find('first', $options));
                $this->layout='newdefault';
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->InitiateBill->create();
                        
                        ///for($i=0;$i<count($this->request->data['InitiateBill']['cat_id']);$i++){
                            
                            $company =  $this->request->data['InitiateBill']['compnay'];
                            $period_id =  $this->request->data['InitiateBill']['period_id'];
                            $remarks =  $this->request->data['InitiateBill']['remarks'];
                            $bill_number=  $this->request->data['InitiateBill']['bill_number'];
                           
                       
                            
                            $data = array(
                            	'compnay'=>$company,
                                'period_id'=>$period_id,
                            	'bill_number'=>$bill_number,
                                'remarks'=>$remarks
                            
                        );
                          $save=$this->InitiateBill->saveAll($data);
				
                            
                       // }
                        
			if ($save) {
				$this->Session->setFlash(__('The Financial has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Financial could not be saved. Please, try again.'));
			}
		}
                $cat=$this->Financial->find('list',array('order'=>array('name'=>'asc')));
                $subcat=$this->Subcategory->find('list',array('order'=>array('name'=>'asc')));
                $ngo=$this->Ngo->find('list');
                $company=$this->CompanyDetail->find('list');
		$period=$this->Period->query("select * from periods");
                $reporting_periods=$this->ReportingPeriod->query("select * from reporting_periods");
                ////foreach($period as $key=>$value) {
                   // print_r($value);
		//$periods = $value['periods']['from_date'].'  '.$value['periods']['to_date'];
                //}
		$this->set(compact('cat','period','company','subcat','reporting_periods'));
		
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->InitiateBill->exists($id)) {
			throw new NotFoundException(__('Invalid Financial'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->InitiateBill->save($this->request->data)) {
				$this->Session->setFlash(__('The Financial details has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Financial details could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('InitiateBill.' . $this->InitiateBill->primaryKey => $id));
			$this->request->data = $this->InitiateBill->find('first', $options);
		}
		$cat=$this->Financial->find('list');
                $subcat=$this->Subcategory->find('list');
                $ngo=$this->Ngo->find('list');
		$period=$this->Period->query("select * from periods");
                $reporting_periods=$this->ReportingPeriod->query("select * from reporting_periods");
                ////foreach($period as $key=>$value) {
                   // print_r($value);
		//$periods = $value['periods']['from_date'].'  '.$value['periods']['to_date'];
                //}
                  $company=$this->CompanyDetail->find('list');
		$this->set(compact('cat','period','company','subcat','reporting_periods'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null,$status='deactive') {
		$this->InitiateBill->id = $id;
		if (!$this->InitiateBill->exists()) {
			throw new NotFoundException(__('Invalid Financial Detail'));
		}
                if(CakeSession::read('User.type')==='regular'){
                  $menu= $this->Session->read('User.mainmenu');
                if (in_array($this->request->params['controller'].":".$this->request->params['action'], $menu)) { 
             
		  $this->InitiateBill->read(null,$id);
			$this->InitiateBill->set(array('status'=>$status));
		
		if ($this->InitiateBill->save()) {
			$this->Session->setFlash(__('The Financial Detail has been Deactive.'));
		} else {
			$this->Session->setFlash(__('The Financial Detail could not be Deactive. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
                } else {
                    
                    $this->requestAction(array('controller' => 'users', 'action' => 'checkRestriction'));
                }
                } else {
                     $this->InitiateBill->read(null,$id);
			$this->InitiateBill->set(array('status'=>$status));
		
                    if ($this->InitiateBill->save()) {
			$this->Session->setFlash(__('The Financial Detail has been Deactive.'));
		} else {
			$this->Session->setFlash(__('The Financial Detail could not be Deactive. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
                }
                
	}
        
        
        public function deleteoverhead($id = null,$status='deactive') {
		$this->OverheadDetail->id = $id;
		if (!$this->OverheadDetail->exists()) {
			throw new NotFoundException(__('Invalid Financial Detail'));
		}
                if(CakeSession::read('User.type')==='regular'){
                  $menu= $this->Session->read('User.mainmenu');
                if (in_array($this->request->params['controller'].":".$this->request->params['action'], $menu)) { 
             
		  $this->OverheadDetail->read(null,$id);
			$this->OverheadDetail->set(array('status'=>$status));
		
		if ($this->OverheadDetail->save()) {
			$this->Session->setFlash(__('The Financial Detail has been Deactive.'));
		} else {
			$this->Session->setFlash(__('The Financial Detail could not be Deactive. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
                } else {
                    
                    $this->requestAction(array('controller' => 'users', 'action' => 'checkRestriction'));
                }
                } else {
                     $this->OverheadDetail->read(null,$id);
			$this->OverheadDetail->set(array('status'=>$status));
		
                    if ($this->OverheadDetail->save()) {
			$this->Session->setFlash(__('The Financial Detail has been Deactive.'));
		} else {
			$this->Session->setFlash(__('The Financial Detail could not be Deactive. Please, try again.'));
		}
		return $this->redirect(array('action' => 'listoverhead'));
                }
                
	}
        
        public function getblocks($stateid) {
	    $this->layout='ajax';
        $this->autoRender = false;
	    $data='<option value="">Select Block</option>';
		$subcatlist=$this->Financial->find('list',array("conditions"=>array('city_id'=>$stateid)));
		foreach($subcatlist as $key=>$value){ $data.='<option value="'.$key.'">'.$value.'</option>';}
		return $data;
	}
        
        
        
         public function getDetails() {
	    $this->layout='ajax';
          $this->autoRender = false;
          $cat_id=$this->params->query['cat_id'];
	  $gid=$this->params->query['gid'];
	   
		$subcatlist=$this->InitiateBill->find('first',array("conditions"=>array('InitiateBill.organization'=>$gid,'InitiateBill.subcat_id'=>$cat_id)));
		if(!empty($subcatlist))
		return $subcatlist['InitiateBill']['amount'];
	}
        public function getUnits() {
	    $this->layout='ajax';
          $this->autoRender = false;
          $cat_id=$this->params->query['cat_id'];
	  $gid=$this->params->query['gid'];
	   
		$subcatlist=$this->InitiateBill->find('first',array("conditions"=>array('InitiateBill.organization'=>$gid,'InitiateBill.subcat_id'=>$cat_id)));
		if(!empty($subcatlist))
		return $subcatlist['InitiateBill']['no_of_unit'];
	}
       public function getUnitCost() {
	    $this->layout='ajax';
          $this->autoRender = false;
          $cat_id=$this->params->query['cat_id'];
	  $gid=$this->params->query['gid'];
	   
		$subcatlist=$this->InitiateBill->find('first',array("conditions"=>array('InitiateBill.organization'=>$gid,'InitiateBill.subcat_id'=>$cat_id)));
		if(!empty($subcatlist))
		return $subcatlist['InitiateBill']['unit_cost'];
	}
        public function getFrequecy() {
	    $this->layout='ajax';
          $this->autoRender = false;
          $cat_id=$this->params->query['cat_id'];
	  $gid=$this->params->query['gid'];
	   
		$subcatlist=$this->InitiateBill->find('first',array("conditions"=>array('InitiateBill.organization'=>$gid,'InitiateBill.subcat_id'=>$cat_id)));
		if(!empty($subcatlist))
		return $subcatlist['InitiateBill']['frequency'];
	}
        
        
         public function getall($cat_id=null) {
	    
	   
		//$subcatlist=$this->InitiateBill->find('first',array("conditions"=>array('InitiateBill.organization'=>$gid,'InitiateBill.cat_id'=>$cat_id)));
		$total = $this->InitiateBill->query('select SUM(amount) as totalamount from financial_details where cat_id='.$cat_id);
		
                return $total['0']['0']['totalamount'];
                
               // return $total['InitiateBill']['ctotal'];
	}
        
        
        public function getgrantbalance() {
	    
	     $this->layout='ajax';
          $this->autoRender = false;
          $pid=$this->params->query['pid'];
	  $gid=$this->params->query['gid'];
		//$subcatlist=$this->InitiateBill->find('first',array("conditions"=>array('InitiateBill.organization'=>$gid,'InitiateBill.cat_id'=>$cat_id)));
		$total = $this->InitiateBill->query('select SUM(amount) as totalamount from financial_details where period_id='.$pid.' and organization='.$gid);
		
                return $total['0']['0']['totalamount'];
                
               // return $total['InitiateBill']['ctotal'];
	}
        
        
        
        
        public function addoverhead() {
		if ($this->request->is('post')) {
			$this->OverheadDetail->create();
                        
                       
                            
                            $organization =  $this->request->data['OverheadDetail']['organization'];
                            $period_id =  $this->request->data['OverheadDetail']['period_id'];
                            $category =  implode(',',$this->request->data['OverheadDetail']['category']);
                            $totalamount =  $this->request->data['OverheadDetail']['totalamount'];
                            $percentage =  $this->request->data['OverheadDetail']['percentage'];
                            $overhead_amount =  $this->request->data['OverheadDetail']['overhead_amount'];
                            $remarks =  $this->request->data['OverheadDetail']['remarks'];
                           
                            
                            
                            $data = array(
                            	'organization'=>$organization,
                        	'period_id'=>$period_id,
                                'category'=>$category,
                            	'totalamount'=>$totalamount,
                            	'percentage'=>$percentage,
                            	'overhead_amount'=>$overhead_amount, 
                                'remarks'=>$remarks
                            
                        );
                          $save=$this->OverheadDetail->saveAll($data);
				
                            
                        
                        
			if ($save) {
				$this->Session->setFlash(__('The Overhead Detail has been saved.'));
				return $this->redirect(array('action' => 'listoverhead'));
			} else {
				$this->Session->setFlash(__('The Overhead Detail could not be saved. Please, try again.'));
			}
		}
                $cat=$this->Financial->find('list',array('order'=>array('name'=>'asc')));
                $subcat=$this->Subcategory->find('list',array('order'=>array('name'=>'asc')));
                $ngo=$this->Ngo->find('list');
		$period=$this->Period->query("select * from periods");
                $reporting_periods=$this->ReportingPeriod->query("select * from reporting_periods");
                ////foreach($period as $key=>$value) {
                   // print_r($value);
		//$periods = $value['periods']['from_date'].'  '.$value['periods']['to_date'];
                //}
		$this->set(compact('cat','period','ngo','subcat','reporting_periods'));
		
	}
       
        public function editoverhead($id = null) {
		if (!$this->OverheadDetail->exists($id)) {
			throw new NotFoundException(__('Invalid Financial'));
		}
		if ($this->request->is(array('post', 'put'))) {
                    
                   //print_r($this->request->data);
                   //die();
                    
                      $organization =  $this->request->data['OverheadDetail']['organization'];
                            $period_id =  $this->request->data['OverheadDetail']['period_id'];
                            $category =  implode(',',$this->request->data['OverheadDetail']['category']);
                            $totalamount =  $this->request->data['OverheadDetail']['totalamount'];
                            $percentage =  $this->request->data['OverheadDetail']['percentage'];
                            $overhead_amount =  $this->request->data['OverheadDetail']['overhead_amount'];
                            $remarks =  $this->request->data['OverheadDetail']['remarks'];
                             $status =  $this->request->data['OverheadDetail']['status'];
                            
                            $data = array(
                            	'organization'=>$organization,
                        	'period_id'=>$period_id,
                                'category'=>$category,
                            	'totalamount'=>$totalamount,
                            	'percentage'=>$percentage,
                            	'overhead_amount'=>$overhead_amount, 
                                'remarks'=>$remarks,
                                'status'=>$status ,
                                 'id'=>$id
                            
                        );
                          $save=$this->OverheadDetail->saveAll($data);
				
                            
			if ($save) {
				$this->Session->setFlash(__('The Overhead  details has been saved.'));
				return $this->redirect(array('action' => 'listoverhead'));
			} else {
				$this->Session->setFlash(__('The Overhead details could not be saved. Please, try again.'));
			}
		} else {
                    
			$options = array('conditions' => array('OverheadDetail.' . $this->OverheadDetail->primaryKey => $id));
			$this->request->data = $this->OverheadDetail->find('first', $options);
		}
		$cat=$this->Financial->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Financial.id IN'=>explode(',',$this->request->data['OverheadDetail']['category']))));
                    
                $subcat=$this->Subcategory->find('list',array('order'=>array('name'=>'asc')));
                $ngo=$this->Ngo->find('list');
		$period=$this->Period->query("select * from periods");
                $reporting_periods=$this->ReportingPeriod->query("select * from reporting_periods");
                ////foreach($period as $key=>$value) {
                   // print_r($value);
		//$periods = $value['periods']['from_date'].'  '.$value['periods']['to_date'];
                //}
		$this->set(compact('cat','period','ngo','subcat','reporting_periods'));
	}
        
         public function gettotal($stateid) {
	    $this->layout='ajax';
            $this->autoRender = false;
        
        
	      // $data='<option value="">--Select--</option>';
               
                $overhead=$this->Overhead->find('first',array("conditions"=>array('Overhead.organization'=>$stateid)));
                //$p= $overhead['Overhead']['category'];
                if($overhead)
                $ftotol = $this->InitiateBill->find('all',array('fields' => array('sum(InitiateBill.amount) AS totalamount'),'conditions'=>array('InitiateBill.cat_id IN'=>explode(',',$overhead['Overhead']['category']),'InitiateBill.status'=>'active')));
                if(isset($ftotol)){
                    $data= $ftotol['0']['0']['totalamount'];
                } else {
                    $data='0';
                }
                return $data;
	}  
                
      //// report export section start------------//////     
 
        public function export(){
            $data='';$searchKey=null;$searchUserId=null;$searchCountryId=null;$searchBuilderId=null;$searchProjectId=null;
		$searchStatus=null;$pages=null;$condition='';$querySrting=''; $condition=array();$condition2='';
		$conc='';
		//$username=$this->User->findById(CakeSession::read('User.id'));
		if(isset($this->params->query['confirm'])) {
	   
		if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    //$condition['OR']=array('Geographical.id LIKE'=>'%'.$searchKey.'%','Geographical.ward LIKE'=>'%'.$searchKey.'%','Geographical.awc_code LIKE'=>'%'.$searchKey.'%','Geographical.awc_worker LIKE '=>'%'.$searchKey.'%','Geographical.asha_name LIKE '=>'%'.$searchKey.'%'); 
	$condition2.=' and InitiateBill.id LIKE %'.$searchKey.'% || InitiateBill.amount LIKE %'.$searchKey.'%';
	
	}
	
	
	
//	if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
//			
//			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
//			{
//				$fromdate=trim($this->request->query['from_date']);
//				$todate=trim($this->request->query['to_date']);
//				$condition2.=' and date(Enquiry.posted_date)>="'.$fromdate.'" and date(Enquiry.posted_date)<="'.$todate.'"';
//				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
//				}
//				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
//					
//				$fromdate=trim($this->request->query['from_date']);  
//				//$condition['Enquiry.posted_date']=$fromdate;	
//				$condition2.=' and date(Enquiry.posted_date)="'.$fromdate.'"';
//				}
//				else
//				{
//					
//					}
//			}
//			
			
  
		if(isset($this->request->query['organization']) and ($this->request->query['organization']!=0) and ($this->request->query['organization']!='')){$searchBuilderId=trim($this->request->query['organization']);  //$condition['Enquiry.country_id']=$searchCountryId;
		$condition2.=' and InitiateBill.organization='.$searchBuilderId;
		
		}
		
		if(isset($this->request->query['category']) and ($this->request->query['block']!=0) and ($this->request->query['category']!='')){$searchBlockId=trim($this->request->query['category']); //$condition['Enquiry.builder_id']=$searchBuilderId;
		$condition2.=' and InitiateBill.cat_id='.$searchBlockId;
		}
		
		if(isset($this->request->query['subcategory']) and ($this->request->query['panchayat']!=0) and ($this->request->query['subcategory']!='')){$searchProjectId=trim($this->request->query['subcategory']); //$condition['Enquiry.project_id']=$searchProjectId;
		$condition2.=' and InitiateBill.subcat_id='.$searchProjectId;
		}
               
//                if(isset($this->request->query['village']) and ($this->request->query['village']!=0) and ($this->request->query['village']!='')){$searchVillageId=trim($this->request->query['village']); //$condition['Enquiry.project_id']=$searchProjectId;
//		$condition2.=' and InitiateBill.village='.$searchVillageId;
//		}
//		
		
		
		}
//		else {
//		if(CakeSession::read('User.type')==='regular'){
//			$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
//			//$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
//				
//		}
//		else {
//		
//		}
//		}
		//$condition['NOT']=array('Enquiry.status'=>"trash");
		$condition2.=' and InitiateBill.status="active"';
		$this->response->download("InitiateBill.csv");
		//print_r($condition); exit;
		$data=$this->InitiateBill->query('select InitiateBill.id,InitiateBill.unit_cost,InitiateBill.no_of_unit,InitiateBill.frequecy,InitiateBill.amount,Financialcategory.name,Financialsubcategory.name,Ngo.name_of_ngo,Period.from_date,Period.to_date,InitiateBill.status from financial_details as InitiateBill left join financial_category as Financialcategory  on InitiateBill.cat_id=Financialcategory.id left join financial_subcategory as Financialsubcategory  on InitiateBill.subcat_id=Financialsubcategory.id left join ngos as Ngo  on InitiateBill.organization=Ngo.id left join periods as Period on InitiateBill.period_id=Period.id where 1 '.$condition2 );
		
		
		//$data = $this->Geographical->find('all', array('conditions'=>$condition2));
		
		//$log = $this->Enquiry->getDataSource()->getLog(false, false);
        //debug($log);
		//exit;
		
            $headers = array('InitiateBill'=>array( 'Id' => 'Id', 'Organization' => 'Organization', 'Category' => 'Category', 'Subcategory' => 'Subcategory','Grant Period' => 'Grant Period','Unit Cost'=>'Unit Cost','No of Unit'=>'No of Unit','Frequecy'=>'Frequecy','Amount'=>'Amount','Status'=>'Status')); 
	    $this->set(compact('data','headers'));
		$this->layout = 'ajax';
		return;
		
		}
  ////  reports section ---/////              
}
