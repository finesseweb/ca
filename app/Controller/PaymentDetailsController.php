<?php

App::uses('AppController', 'Controller');

/**

 * Cities Controller

 *

 * @property City $City

 * @property PaginatorComponent $Paginator

 * @property SessionComponent $Session

 */

class PaymentDetailsController extends AppController {



/**

 * Components

 *

 * @var array

 */

	public $components = array('Paginator', 'Session');

	var  $uses = array('PaymentDetail','Finance','CompanyDetail','ClientDetail','Period','ReportingPeriod','Ngo','Subcategory','OverheadDetail','PaymentDetailstatus');



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

    $condition['OR']=array('PaymentDetail.id LIKE'=>'%'.$searchKey.'%','PaymentDetail.unit_cost LIKE'=>'%'.$searchKey.'%','PaymentDetail.no_of_unit LIKE'=>'%'.$searchKey.'%','PaymentDetail.frequecy LIKE'=>'%'.$searchKey.'%','PaymentDetail.amount LIKE'=>'%'.$searchKey.'%'); 

	

	}

		

		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){

			

			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))

			{

				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));

				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));

				$condition['AND']=array('date(PaymentDetail.billing_date) >='=>$fromdate,'date(PaymentDetail.billing_date) <='=>$todate);

				}

				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){

					

				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  

				$condition['PaymentDetail.billing_date']=$fromdate;	

				}

				

			}

		

		if(isset($this->request->query['company_name']) and ($this->request->query['company_name']!=0) and ($this->request->query['company_name']!='')){$searchBuilderId=trim($this->request->query['company_name']); 

		$condition['PaymentDetail.company_name']=$searchBuilderId;

		}

		

//		if(isset($this->request->query['subcat_id']) and ($this->request->query['subcat_id']!=0) and ($this->request->query['subcat_id']!='')){$searchProjectId=trim($this->request->query['subcat_id']);

//		$condition['PaymentDetail.subcat_id']=$searchProjectId;

//		}

////		

//		if(isset($this->request->query['search_user']) and ($this->request->query['search_user']!=0) and ($this->request->query['search_user']!='')){$searchUserId=trim($this->request->query['search_user']);

//		$condition['OR']=array('Ngo.booked_by'=>$searchUserId,'Ngo.booked_by_2'=>$searchUserId);

//		}

//		

	}

		 $company=$this->CompanyDetail->find('list');

	         $this->Paginator->settings = array('PaymentDetail' => array('limit' =>20,'order' => array('id' => 'desc'),'conditions'=>array($condition)));

		$this->PaymentDetail->recursive = 0;

		$this->set('financials', $this->Paginator->paginate());

		 //$subcat=$this->Subcategory->find('list',array('order'=>array('name'=>'asc')));

		 $period=$this->Period->query("select * from periods");	

                  $client=$this->ClientDetail->find('list');

		$this->set(compact('users','blocks','panchayats','client','company','period'));	

			

	}

        

        

        

        public function report() {

		

		$data='';$searchKey=null;$searchUserId=null;$searchBuilderId=null;$searchProjectId=null;$fromdate=null;$todate=null;

		$condition='';$querySrting=''; $condition=array();

		$conc='';

		

		if(isset($this->request->query)) {

                    $company=$this->request->query['com'];

                    $client=$this->request->query['cl'];

                    $slip=$this->request->query['slip'];

	    

//		if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 

//			$searchKey=trim($this->request->query['search_key']);  

//    $condition['OR']=array('PaymentDetail.id LIKE'=>'%'.$searchKey.'%','PaymentDetail.unit_cost LIKE'=>'%'.$searchKey.'%','PaymentDetail.no_of_unit LIKE'=>'%'.$searchKey.'%','PaymentDetail.frequecy LIKE'=>'%'.$searchKey.'%','PaymentDetail.amount LIKE'=>'%'.$searchKey.'%'); 

//	

//	}

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

//		

//		if(isset($this->request->query['organization']) and ($this->request->query['organization']!=0) and ($this->request->query['organization']!='')){$searchBuilderId=trim($this->request->query['organization']); 

//		$condition['PaymentDetail.organization']=$searchBuilderId;

//		}

//                

//                if(isset($this->request->query['organization']) and ($this->request->query['organization']!=0) and ($this->request->query['organization']!='')){$searchorgId=trim($this->request->query['organization']); 

//		$condition1['PaymentDetailstatus.organization']=$searchorgId;

//		}

//		

//		if(isset($this->request->query['period_id']) and ($this->request->query['period_id']!=0) and ($this->request->query['period_id']!='')){$searchPeriodId=trim($this->request->query['period_id']);

//		$condition['PaymentDetail.period_id']=$searchPeriodId;

//		}

//                if(isset($this->request->query['period_id']) and ($this->request->query['period_id']!=0) and ($this->request->query['period_id']!='')){$searchPeriodsId=trim($this->request->query['period_id']);

//		$condition1['PaymentDetailstatus.period_id']=$searchPeriodsId;

//		}

////		

//		if(isset($this->request->query['reporting_period']) and ($this->request->query['reporting_period']!=0) and ($this->request->query['reporting_period']!='')){$searchreporting=trim($this->request->query['reporting_period']);

//		$condition['PaymentDetail.reporting_period']=$searchreporting;

//		}

//                if(isset($this->request->query['reporting_period']) and ($this->request->query['reporting_period']!=0) and ($this->request->query['reporting_period']!='')){$searchreportingId=trim($this->request->query['reporting_period']);

//		$condition1['PaymentDetailstatus.reporting_period']=$searchreportingId;

//		}

                

                $invoicedetails=$this->PaymentDetail->find('all',array('conditions'=>array('PaymentDetail.company'=>$company,'PaymentDetail.company_name'=>$client,'PaymentDetail.slip'=>$slip)));

               // print_r($invoicedetails);

               //die();

//	         $getAll=$this->PaymentDetail->find('first',array('order'=>array('PaymentDetail.cat_id'=>'asc'),'conditions'=>$condition));

//	        $period=$this->Period->query("select * from periods where id=".$this->request->query['period_id']);

//                //$reporting_periods=$this->ReportingPeriod->query("select * from reporting_periods where id=".$this->request->query['reporting_period']);

//                $ngos=$this->Ngo->find('first',array('conditions'=>array('Ngo.id'=>$this->request->query['organization'])));

//                $overs=$this->OverheadDetail->find('first',array('conditions'=>array('OverheadDetail.organization'=>$this->request->query['organization'])));

//                $fundstaus=$this->PaymentDetailstatus->find('first',array('order'=>array('PaymentDetailstatus.id'=>'desc'),'conditions'=>$condition1));

//	        

                } 

        else {

            

             

                $period=$this->Period->query("select * from periods");

                $reporting_periods=$this->ReportingPeriod->query("select * from reporting_periods");

                $ngos=$this->Ngo->find('list');

             

        }

		

	        $this->Paginator->settings = array('PaymentDetail' => array('limit' =>20,'order' => array('id' => 'desc'),'conditions'=>array($condition,'PaymentDetail.status'=>'active')));

		$this->PaymentDetail->recursive = 0;

		$this->set('financials', $this->Paginator->paginate());

		

		$this->set(compact('invoicedetails','users','blocks','panchayats','subcat','ngos','period','reporting_periods','category','overs','getAll'));	

		$this->layout='newdefault';	

	}



/**

 * view method

 *

 * @throws NotFoundException

 * @param string $id

 * @return void

 */

	public function view($id = null) {

            

            

		if (!$this->PaymentDetail->exists($id)) {

			throw new NotFoundException(__('Invalid financial details'));

		}

		$options = array('conditions' => array('PaymentDetail.' . $this->PaymentDetail->primaryKey => $id));

		$this->set('financial', $this->PaymentDetail->find('first', $options));

                $this->layout='newdefault';

	}

public function viewdetails($id = null) {

            

            

		 $r = explode(',',$id);

                 //print_r($r);

                // die();

		$options = array('conditions' => array('PaymentDetail.company_name'=> $r['0'],'PaymentDetail.slip'=> $r['1']));

		 $this->set('financials', $this->PaymentDetail->find('all', $options));

             

                $this->layout='newdefault';

	}



/**

 * add method

 *

 * @return void

 */

	public function add() {

		if ($this->request->is('post')) {

			$this->PaymentDetail->create();

                         //print_r($this->request->data);

                      // die();

                       //$bill=  explode('/',$this->request->data['PaymentDetail']['bill_number']);

                     

                         //  for($i=0;$i<count($this->request->data['PaymentDetail']['amount']);$i++){

                            

                            $company =  $this->request->data['PaymentDetail']['company'];

                          //  $financial_year =  $this->request->data['PaymentDetail']['financial_year'];

                            $bill_number =  $this->request->data['PaymentDetail']['bill_number'];

                            $company_name =  $this->request->data['PaymentDetail']['company_name'];

                           // $description =  $this->request->data['PaymentDetail']['description'][$i];

                            $billing_amount =  $this->request->data['PaymentDetail']['billing_amount'];

                            $paid_amount =  $this->request->data['PaymentDetail']['paid_amount'];

                            $due_amount =  $this->request->data['PaymentDetail']['due_amount'];

                            $payment_mode =  $this->request->data['PaymentDetail']['payment_mode'];

                            $bank_name =  $this->request->data['PaymentDetail']['bank_name'];
                            $ifsc =  $this->request->data['PaymentDetail']['ifsc'];
                             $transction_number=  $this->request->data['PaymentDetail']['transction_number'];

                            $payment_date =  date('Y-m-d',strtotime($this->request->data['PaymentDetail']['payment_date']));
                            if($due_amount=='0'){
                                $due_status='0';
                            }
                           // $slip= $bill['1'];

                            $data = array(

                            	'company'=>$company,

                            	//'financial_year'=>$financial_year,

                                'bill_number'=>$bill_number,

                            	'billing_amount'=>$billing_amount,

                            	'company_name'=>$company_name,

                            	//'description'=>$description,

                                'paid_amount'=>$paid_amount,

                                'due_amount'=>$due_amount,

                                'payment_mode'=>$payment_mode,

                                'ifsc'=>$ifsc,

                                'transction_number'=>$transction_number,

                                'payment_date'=>$payment_date

                                

                            

                        );

                          $save=$this->PaymentDetail->saveAll($data);

				

                            

                       // }

			if ($save) {
                          $membersdata1=$this->Finance->query("UPDATE finances SET due_status='".$due_status."'WHERE slip='".$this->request->data['PaymentDetail']['bill_number']);
	
				$this->Session->setFlash(__('The Financial has been saved.'));

				return $this->redirect(array('action' => 'index'));

			} else {

				$this->Session->setFlash(__('The Financial could not be saved. Please, try again.'));

			}

		}

               

		$period=$this->Period->query("select * from periods order by id desc");

              //  $reporting_periods=$this->ReportingPeriod->query("select * from reporting_periods");

                 $company=$this->CompanyDetail->find('list',array('conditions'=>array('CompanyDetail.status'=>'active'))); 

                 $client=$this->ClientDetail->find('list',array('conditions'=>array('ClientDetail.status'=>'active')));

                 //////foreach($period as $key=>$value) {

                   // print_r($value);

		//$periods = $value['periods']['from_date'].'  '.$value['periods']['to_date'];

                //}

		$this->set(compact('cat','period','ngo','subcat','reporting_periods','company','client'));

		

	}

        

        

        

        public function fundstatus() {

		if ($this->request->is('post')) {

			$this->PaymentDetailstatus->create();

                        

                       

                            

                            $organization =  $this->request->data['PaymentDetailstatus']['organization'];

                            $period_id =  $this->request->data['PaymentDetailstatus']['period_id'];

                            $reporting_period =  $this->request->data['PaymentDetailstatus']['reporting_period'];

                            $opening_balance =  $this->request->data['PaymentDetailstatus']['opening_balance'];

                           // $grant_received_from_pfi =  $this->request->data['PaymentDetailstatus']['grant_received_from_pfi'];

                            //$interest_earned =  $this->request->data['PaymentDetailstatus']['interest_earned'];

                            $closing_fund_balance =  $this->request->data['PaymentDetailstatus']['closing_fund_balance'];

                           

                           

                            $data = array(

                            	'organization'=>$organization,

                            	'period_id'=>$period_id,

                                'reporting_period'=>$reporting_period,

                            	'opening_balance'=>$opening_balance,

                            //	'grant_received_from_pfi'=>$grant_received_from_pfi,

                            //	'interest_earned'=>$interest_earned,

                                'closing_fund_balance'=>$closing_fund_balance,

                                

                            

                        );

                          $save=$this->PaymentDetailstatus->saveAll($data);

				

                            

                        

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

		$period=$this->Period->query("select * from periods");

                $reporting_periods=$this->ReportingPeriod->query("select * from reporting_periods");

                ////foreach($period as $key=>$value) {

                   // print_r($value);

		//$periods = $value['periods']['from_date'].'  '.$value['periods']['to_date'];

                //}

		$this->set(compact('cat','period','ngo','subcat','reporting_periods'));

		

	}



/**

 * edit method

 *

 * @throws NotFoundException

 * @param string $id

 * @return void

 */

	public function edit($id = null) {

		if (!$this->PaymentDetail->exists($id)) {

			throw new NotFoundException(__('Invalid Financial'));

		}

		if ($this->request->is(array('post', 'put'))) {

                    

                            $description_details =  $this->request->data['PaymentDetail']['description_details'];

                            $amount =  $this->request->data['PaymentDetail']['amount'];

                        

                            $data = array(

                            	'description_details'=>$organization,

                            	'amount'=>$amount,

                                'id'=>$id

                            

                        );

                         $save=$this->PaymentDetail->saveAll($data);   

			if ($save) {

				$this->Session->setFlash(__('The Financial details has been saved.'));

				return $this->redirect(array('action' => 'index'));

			} else {

				$this->Session->setFlash(__('The Financial details could not be saved. Please, try again.'));

			}

		} else {

			$options = array('conditions' => array('PaymentDetail.' . $this->PaymentDetail->primaryKey => $id));

			$this->request->data = $this->PaymentDetail->find('first', $options);

		}

		

		$period=$this->Period->query("select * from periods");

               // $reporting_periods=$this->ReportingPeriod->query("select * from reporting_periods");

                 $company=$this->CompanyDetail->find('list'); 

                 $client=$this->ClientDetail->find('list');

                 //////foreach($period as $key=>$value) {

                   // print_r($value);

		//$periods = $value['periods']['from_date'].'  '.$value['periods']['to_date'];

                //}

		$this->set(compact('cat','period','ngo','subcat','reporting_periods','company','client'));

	}



/**

 * delete method

 *

 * @throws NotFoundException

 * @param string $id

 * @return void

 */

	

        

        public function delete($id = null) {

             

		 $get=$this->PaymentDetail->find('first',array("conditions"=>array('PaymentDetail.slip'=>$id)));

             //print_r($get['PaymentDetail']['status']); die();

              if($get['PaymentDetail']['status']=='active'){

                  $status='deactive';

              }else { $status='active';} 

              // $this->PaymentDetail->read(null,$id);

              

              $total = $this->PaymentDetail->query("UPDATE finances SET status='$status' where slip=$id");

		$this->Session->setFlash(__('The PaymentDetail has been '.$status));

		

		return $this->redirect(array('action' => 'index'));

                 

	}

	

	public function getclosingbalance() {

	    

	       $this->layout='ajax';

                $this->autoRender = false;

                 $rid=$this->params->query['rid'];

	         $gid=$this->params->query['gid'];

                 $pid=$this->params->query['pid'];

	   

		//$subcatlist=$this->FinancialDetail->find('first',array("conditions"=>array('FinancialDetail.organization'=>$gid,'FinancialDetail.cat_id'=>$cat_id)));

		$total = $this->PaymentDetail->query('select SUM(amount) as totalamount,SUM(current_expediture) as totalexp from finances where organization='.$gid.' and period_id='.$pid.' and reporting_period='.$rid);

		//print_r($total);

                //die();

                return $total['0']['0']['totalamount']-$total['0']['0']['totalexp'];;

                

               // return $total['FinancialDetail']['ctotal'];

	}

        

        public function getopenigbalance() {

	    

	       $this->layout='ajax';

                $this->autoRender = false;

                 $rid=$this->params->query['rid'];

	         $gid=$this->params->query['gid'];

                 $pid=$this->params->query['pid'];

	   

		//$subcatlist=$this->FinancialDetail->find('first',array("conditions"=>array('FinancialDetail.organization'=>$gid,'FinancialDetail.cat_id'=>$cat_id)));

		$total = $this->PaymentDetailstatus->query('select opening_balance from financestatuses where organization='.$gid.' and period_id='.$pid.' and reporting_period='.$rid);

		//print_r($total);

                //die();

                return $total['0']['financestatuses']['opening_balance'];

                

               // return $total['FinancialDetail']['ctotal'];

	}

        

        public function getblocks($stateid) {

	    $this->layout='ajax';

        $this->autoRender = false;

	    $data='<option value="">Select Block</option>';

		$subcatlist=$this->Financial->find('list',array("conditions"=>array('city_id'=>$stateid)));

		foreach($subcatlist as $key=>$value){ $data.='<option value="'.$key.'">'.$value.'</option>';}

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

	$condition2.=' and PaymentDetail.id LIKE %'.$searchKey.'% || PaymentDetail.unit_cost LIKE %'.$searchKey.'% || PaymentDetail.no_of_unit LIKE %'.$searchKey.'% || PaymentDetail.frequecy LIKE %'.$searchKey.'% || PaymentDetail.amount LIKE %'.$searchKey.'%' ;

	

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

		$condition2.=' and PaymentDetail.organization='.$searchBuilderId;

		

		}

		

		if(isset($this->request->query['subcat_id']) and ($this->request->query['subcat_id']!=0) and ($this->request->query['subcat_id']!='')){$searchProjectId=trim($this->request->query['subcat_id']); //$condition['Enquiry.project_id']=$searchProjectId;

		$condition2.=' and PaymentDetail.subcat_id='.$searchProjectId;

		}

               

	

		

		

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

		$condition2.=' and PaymentDetail.status="active"';

		$this->response->download("PaymentDetail.csv");

		//print_r($condition); exit;

		$data=$this->PaymentDetail->query('select PaymentDetail.id,PaymentDetail.unit_cost,PaymentDetail.no_of_unit,PaymentDetail.frequecy,PaymentDetail.amount,PaymentDetail.grant_received_from_pfi,PaymentDetail.previous_expenditure,PaymentDetail.opening_balance,PaymentDetail.closing_fund_balance,PaymentDetail.reporting_period,PaymentDetail.current_expediture,PaymentDetail.cumulative_expenditure,PaymentDetail.variane,PaymentDetail.variance_percentage,PaymentDetail.reason_variance,PaymentDetail.next_quater_projection,PaymentDetail.interest_earned,Financialsubcategory.name,Ngo.name_of_ngo,Period.from_date,Period.to_date,Report.from_date,Report.to_date,PaymentDetail.status from finances as PaymentDetail left join reporting_periods as Report  on PaymentDetail.reporting_period=Report.id left join financial_subcategory as Financialsubcategory  on PaymentDetail.subcat_id=Financialsubcategory.id left join ngos as Ngo  on PaymentDetail.organization=Ngo.id left join periods as Period on PaymentDetail.period_id=Period.id where 1 '.$condition2 );

		

		

		//$data = $this->Geographical->find('all', array('conditions'=>$condition2));

		

		//$log = $this->Enquiry->getDataSource()->getLog(false, false);

        //debug($log);

		//exit;

		

            $headers = array('PaymentDetail'=>array( 'Id' => 'Id', 'Organization' => 'Organization', 'Activity' => 'Activity','Unit Cost'=>'Unit Cost','No of Unit'=>'No of Unit','Frequecy'=>'Frequecy','Amount'=>'Amount','Grant Period' => 'Grant Period','Reporting Period' => 'Reporting Period','Previous Expenditure'=>'Previous Expenditure','Current Expediture'=>'Current Expediture','Cumulative Expenditure'=>'Cumulative Expenditure','Variane'=>'Variane','Variance Percentage'=>'Variance Percentage','Reason for Variance'=>'Reason for Variance','Opening Balance'=>'Opening Balance','Projection For Next Quater'=>'Projection For Next Quater','Grant Received From PFI'=>'Grant Received From PFI','Interest Earned'=>'Interest Earned','Closing Fund Balance'=>'Closing Fund Balance','Status'=>'Status')); 

	    $this->set(compact('data','headers'));

		$this->layout = 'ajax';

		return;

		

		}

  ////  reports section ---/////    

                

                

                

                

        public function getAll($stateid) {

	    $this->layout='ajax';

            $this->autoRender = false;

           

	     

		$subcatlist=$this->PaymentDetail->find('all',array('conditions'=>array('PaymentDetail.cat_id'=>$stateid,'PaymentDetail.status'=>'active')));

       

               

                    return $subcatlist;  

                

                 }

}

