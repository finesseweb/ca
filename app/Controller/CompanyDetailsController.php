<?php
App::uses('AppController', 'Controller');
/**
 * CompanyDetails Controller
 *
 * @property CompanyDetail $CompanyDetail
 * @property PaginatorComponent $Paginator
 */
class CompanyDetailsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Upload');

    var  $uses = array('CompanyDetail','User','Project','Feedback','Finance','Location','Country','City','Block','Designation');
/**
 * index method
 *
 * @return void
 */
	public function index() {
		
		$data='';$searchKey=null;$searchUserId=null;$searchBuilderId=null;$searchProjectId=null;$fromdate=null;$todate=null;
		$condition='';$querySrting=''; $condition=array();
		$conc='';
                
                $sessionval=$this->Session->read('User.type'); 
                $sessionid=$this->Session->read('User.id'); 
 
              //$sessionval;
		
		if(isset($this->params->query['confirm'])) {
	   
		if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('CompanyDetail.id LIKE'=>'%'.$searchKey.'%','CompanyDetail.name_of_company LIKE'=>'%'.$searchKey.'%'); 
	
	}
//		
//		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
//			
//			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
//			{
//				$fromdate=trim($this->request->query['from_date']);
//				$todate=trim($this->request->query['to_date']);
//				$condition['AND']=array('date(CompanyDetail.date_of_booking) >='=>$fromdate,'date(CompanyDetail.date_of_booking) <='=>$todate);
//				}
//				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
//					
//				$fromdate=trim($this->request->query['from_date']);  
//				$condition['CompanyDetail.date_of_booking']=$fromdate;	
//				}
//				
//			}
//		
//		if(isset($this->request->query['district']) and ($this->request->query['district']!=0) and ($this->request->query['district']!='')){$searchBuilderId=trim($this->request->query['district']); 
//		$condition['CompanyDetail.allocated_district']=$searchBuilderId;
//		}
//		
//		
//		if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchUserId=trim($this->request->query['block']);
//		$condition['OR']=array('CompanyDetail.allocated_block_one'=>$searchUserId,'CompanyDetail.allocated_block_two'=>$searchUserId);
//		}
//		
       
        
	}
	
        
	        $this->Paginator->settings = array('CompanyDetail' => array('limit' =>20,'order' => array('id' => 'desc'),'conditions'=>array($condition)));
		$this->CompanyDetail->recursive = 0;
		$this->set('bookings', $this->Paginator->paginate());
		//$cities=$this->City->find('list');
		//$blocks=$this->Block->find('list');	
			$users = $this->User->find('list',array('fields'=>array('parent'),'conditions'=>array('status'=>'active')));
			
			$this->set(compact('users','cities','blocks'));
			
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->CompanyDetail->exists($id)) {
			throw new NotFoundException(__('Invalid booking'));
		}
		$options = array('conditions' => array('CompanyDetail.' . $this->CompanyDetail->primaryKey => $id));
		$this->set('booking', $this->CompanyDetail->find('first', $options));
		$this->layout='newdefault';
	}
	
	
	public function report($id = null) {
		
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {




		if ($this->request->is('post')) {
			$this->CompanyDetail->create();
                        $destinationorig  = realpath('../webroot/images/') . '/';
	       
			
                        $file = $this->request->data['CompanyDetail']['company_logo'];
                        $signature = $this->request->data['CompanyDetail']['signature'];
			$resultval = $this->Upload->uploadimg($file,$destinationorig,'','',''); 
                        $sing= $this->Upload->uploadimg($signature,$destinationorig,'','','');
			 $this->request->data['CompanyDetail']['company_logo']=$resultval;
                          $this->request->data['CompanyDetail']['signature']=$sing;
                         
                           $compnay_logo=  $this->request->data['CompanyDetail']['company_logo'];
                           $upsing=  $this->request->data['CompanyDetail']['signature'];
                            $name_of_company=  $this->request->data['CompanyDetail']['name_of_company'];
                            $company_phone =  $this->request->data['CompanyDetail']['company_phone'];
                            $company_email=  $this->request->data['CompanyDetail']['company_email'];
                            
                            $permanent_address =  $this->request->data['CompanyDetail']['permanent_address'];
                            $permanent_pincode =  $this->request->data['CompanyDetail']['permanent_pincode'];
                            $correspondence_address =  $this->request->data['CompanyDetail']['correspondence_address'];
                            $correspondence_pincode =  $this->request->data['CompanyDetail']['correspondence_pincode'];
                            $company_bank_ac_no =  $this->request->data['CompanyDetail']['company_bank_ac_no'];
                            $name_of_bank = $this->request->data['CompanyDetail']['name_of_bank'];
                            $ifsc =  $this->request->data['CompanyDetail']['ifsc'];
                            $branch =  $this->request->data['CompanyDetail']['branch'];
                            $gst =  $this->request->data['CompanyDetail']['gst'];
                            $gst_number =  $this->request->data['CompanyDetail']['gst_number'];
                            $post_office_p =  $this->request->data['CompanyDetail']['post_office_p'];
                            $district_p =  $this->request->data['CompanyDetail']['district_p'];
                            $state_p =  $this->request->data['CompanyDetail']['state_p'];
                            $post_office_c =  $this->request->data['CompanyDetail']['post_office_c'];
                            $district_c =  $this->request->data['CompanyDetail']['district_c'];
                            $state_c     =  $this->request->data['CompanyDetail']['state_c'];
                            $country_c     =  $this->request->data['CompanyDetail']['country_c'];
                            $country_p     =  $this->request->data['CompanyDetail']['country_p'];
                            $remarks =  $this->request->data['CompanyDetail']['remarks'];
                            $pan_number =  $this->request->data['CompanyDetail']['pan_number'];
                            $digital_signature =  $this->request->data['CompanyDetail']['digital_signature'];
                            $data=array (
                                'name_of_company' => $name_of_company,
                                'company_phone' => $company_phone ,
                                'company_email' => $company_email,
                                'permanent_address' => $permanent_address,
                                'permanent_pincode' => $permanent_pincode,
                                'company_bank_ac_no' => $company_bank_ac_no,
                                'name_of_bank' => $name_of_bank,
                                'ifsc' => $ifsc,
                                'branch'=>$branch,
                                'correspondence_address'=> $correspondence_address,
                                'correspondence_pincode	'=>$correspondence_pincode,
                                'post_office_p'=>$post_office_p,
                                'district_p'=>$district_p,
                                'state_p' =>$state_p,
                                'post_office_c'=>$post_office_c,
                                'district_c' =>$district_c,
                                'state_c'=>$state_c,
                                'country_c' =>$country_c,
                                'country_p' =>$country_p,
                                'gst'=>$gst,
                                'gst_number'=>$gst_number,
                                'pan_number'=>$pan_number,
                                'digital_signature' => $digital_signature,
                                'company_logo'=>$compnay_logo,
                                'signature'=>$upsing,
                                'remarks' =>$remarks,
                                
                                
                                );
                            
                            if ($this->CompanyDetail->save($data)) {
                            
				$this->Session->setFlash(__('The Company has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Company could not be saved. Please, try again.'));
			}
		}
		$executives=$this->User->find('all',array('conditions'=>array('User.status'=>'active','User.role'=>'user')));
		$cities=$this->City->find('list');
      
	//	$locations=$this->Location->find('list');
	//	$block=$this->Block->find('list');
                //$name=$this->CompanyDetailname->find('list');
		$this->set(compact('executives','cities','block','locations','desig','name'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->CompanyDetail->exists($id)) {
			throw new NotFoundException(__('Invalid NGO'));
		}
		if ($this->request->is(array('post', 'put'))) {
                    $destinationorig  = realpath('../webroot/images/') . '/';
                 
                        $file = $this->request->data['CompanyDetail']['company_logo'];
                        $signature = $this->request->data['CompanyDetail']['signature'];
                        $sing= $this->Upload->uploadimg($signature,$destinationorig,'','','');
			$resultval = $this->Upload->uploadimg($file,$destinationorig,'','',''); 
                         
			 $this->request->data['CompanyDetail']['signature']=$sing;
                         $this->request->data['CompanyDetail']['company_logo']=$resultval;
                      if($this->request->data['CompanyDetail']['company_logo']!=''){
                          $compnay_logo=  $this->request->data['CompanyDetail']['company_logo'];
                      }else {
                           $compnay_logo=  $this->request->data['CompanyDetail']['company_logo1'];
                      }
                      
                      if($this->request->data['CompanyDetail']['signature']!=''){
                          $upsing=  $this->request->data['CompanyDetail']['signature'];
                      }else {
                           $upsing=  $this->request->data['CompanyDetail']['signature1'];
                      }
                     //  die();
                          //  $upsing=  $this->request->data['CompanyDetail']['signature'];
                           // $compnay_logo=  $this->request->data['CompanyDetail']['company_logo'];
                            $name_of_company=  $this->request->data['CompanyDetail']['name_of_company'];
                            $company_phone =  $this->request->data['CompanyDetail']['company_phone'];
                            $company_email=  $this->request->data['CompanyDetail']['company_email'];
                            
                            $permanent_address =  $this->request->data['CompanyDetail']['permanent_address'];
                            $permanent_pincode =  $this->request->data['CompanyDetail']['permanent_pincode'];
                            $correspondence_address =  $this->request->data['CompanyDetail']['correspondence_address'];
                            $correspondence_pincode =  $this->request->data['CompanyDetail']['correspondence_pincode'];
                            $company_bank_ac_no =  $this->request->data['CompanyDetail']['company_bank_ac_no'];
                            $name_of_bank = $this->request->data['CompanyDetail']['name_of_bank'];
                            $ifsc =  $this->request->data['CompanyDetail']['ifsc'];
                            $branch =  $this->request->data['CompanyDetail']['branch'];
                            $gst =  $this->request->data['CompanyDetail']['gst'];
                            $gst_number =  $this->request->data['CompanyDetail']['gst_number'];
                            $post_office_p =  $this->request->data['CompanyDetail']['post_office_p'];
                            $district_p =  $this->request->data['CompanyDetail']['district_p'];
                            $state_p =  $this->request->data['CompanyDetail']['state_p'];
                            $post_office_c =  $this->request->data['CompanyDetail']['post_office_c'];
                            $district_c =  $this->request->data['CompanyDetail']['district_c'];
                            $state_c     =  $this->request->data['CompanyDetail']['state_c'];
                            $country_c     =  $this->request->data['CompanyDetail']['country_c'];
                            $country_p     =  $this->request->data['CompanyDetail']['country_p'];
                            $remarks =  $this->request->data['CompanyDetail']['remarks'];
                            $pan_number =  $this->request->data['CompanyDetail']['pan_number'];
                            $digital_signature =  $this->request->data['CompanyDetail']['digital_signature'];
                            
                            $data=array (
                                'name_of_company' => $name_of_company,
                                'company_phone' => $company_phone ,
                                'company_email' => $company_email,
                                'permanent_address' => $permanent_address,
                                'permanent_pincode' => $permanent_pincode,
                                'company_bank_ac_no' => $company_bank_ac_no,
                                'name_of_bank' => $name_of_bank,
                                'ifsc' => $ifsc,
                                'branch'=>$branch,
                                'correspondence_address'=> $correspondence_address,
                                'correspondence_pincode	'=>$correspondence_pincode,
                                'post_office_p'=>$post_office_p,
                                'district_p'=>$district_p,
                                'state_p' =>$state_p,
                                'post_office_c'=>$post_office_c,
                                'district_c' =>$district_c,
                                'state_c'=>$state_c,
                                'country_c' =>$country_c,
                                'country_p' =>$country_p,
                                'gst'=>$gst,
                                'gst_number'=>$gst_number,
                                'pan_number'=>$pan_number,
                                'digital_signature' => $digital_signature,
                                'company_logo'=>$compnay_logo,
                                'signature'=>$upsing,
                                
                                'remarks' =>$remarks,
                                'id'=>$id
                                
                                ); 
                            
                          //  print_r($data);
                            //die();
			if ($this->CompanyDetail->save($data)) {
				$this->Session->setFlash(__('The Company has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Company could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('CompanyDetail.' . $this->CompanyDetail->primaryKey => $id));
			$this->request->data = $this->CompanyDetail->find('first', $options);
		
//			
                        $executives=$this->User->find('all',array('conditions'=>array('User.status'=>'active','User.role'=>'user')));
		        $cities=$this->City->find('list');
                 //       $desig=$this->Designation->find('list');
			//$block=$this->Block->find('list');
                      
                       /// $name=$this->CompanyDetailname->find('list');
			$this->set(compact('executives','desig','cities','block','name'));
		}
	}
	
	
	

/**  
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null,$status=null) {
		$this->CompanyDetail->id = $id;
		if (!$this->CompanyDetail->exists()) {
			throw new NotFoundException(__('Invalid booking'));
		}
                
                    $get=$this->CompanyDetail->find('first',array("conditions"=>array('CompanyDetail.id'=>$id)));
              //print_r($get['CompanyDetail']['status']); die();
              if($get['CompanyDetail']['status']=='active'){
                  $status='deactive';
              }else { $status='active';}  
              $this->CompanyDetail->read(null,$id);
		    $this->CompanyDetail->set(array('status'=>$status));
		
		if ($this->CompanyDetail->save()) {
			$this->Session->setFlash(__('The Details has been '.$status));
		} else {
                    //mysql_error();die();
			$this->Session->setFlash(__('Nothing happen. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
                
	}
	
	public function getngodistrict($id) {
	    $this->layout='ajax';
        $this->autoRender = false;
         $options = array('conditions' => array('CompanyDetail.' . $this->CompanyDetail->primaryKey => $id));
                $nog = $this->CompanyDetail->find('first',$options);
	       $data='<option value="">Select District</option>';
		$subcatlist=$this->City->find('list',array("conditions"=>array('id'=>$nog['CompanyDetail']['allocated_district'])));
		foreach($subcatlist as $key=>$value){ $data.='<option value="'.$key.'">'.$value.'</option>';}
		return $data;
	}
        
 public function getcompanydesc($id) {
	    $this->layout='ajax';
        $this->autoRender = false;
          $data='<option value="">--Select--</option>';
         $options = array('conditions' => array('Feedback.company_id'=> $id,'Feedback.status'=>'active'));
               $com = $this->Feedback->find('list',$options);
               //print_r($com);die();
               if($com){
	       foreach($com as $key=>$value){ $data.='<option value="'.$key.'">'.$value.'</option>';}
		
		return $data;
               }
	} 
        
        
    public function getbillnumber() {
	$this->layout='ajax';
        $this->autoRender = false;
        $c=$this->params->query['c'];
	$y=$this->params->query['y'];
        $options = array('order' => array('Finance.id' => 'desc'),'conditions' => array('Finance.company'=> $c,'Finance.financial_year'=> $y));
         $com = $this->Finance->find('first',$options);
          
               if($com){
                   
	      $da= $com['Finance']['invoice_number'];
              $d= explode('/',$da);
              
              $num =$d['1']+1;
              $data =$d['0'].'/'.$num;
              //print_r($d['0']);
          //die();
		return $data;
               }
               else {
                 if(date('m')>3){
    $nestyear =date('Y')+1;
     $nestyear1 =date('y')+1;
    $curryear =date('Y');
    $curryear1 =date('y');
    $finacialyear= $curryear.'-'.$nestyear;
    $finacialyear1= $curryear1.'-'.$nestyear1;
}
else {
    $preyear =date('Y')-1;
     $preyear1 =date('y')-1;
    $curryear =date('Y');
     $curryear1 =date('y');
    $finacialyear=  $preyear.'-'.$curryear;
    $finacialyear1=  $preyear1.'-'.$curryear1;
    //echo $finacialyear;
    //echo date('Y',strtotime($finacialyear));
}
$data = $finacialyear1.'/'.'1';
return $data;
               }
	} 
   
              
    ////  reports section ---/////
                
  public function export(){
            $data='';$searchKey=null;$searchUserId=null;$searchCountryId=null;$searchBuilderId=null;$searchProjectId=null;
		$searchStatus=null;$pages=null;$condition='';$querySrting=''; $condition=array();$condition2='';
		$conc='';
		//$username=$this->User->findById(CakeSession::read('User.id'));
		if(isset($this->params->query['confirm'])) {
	   
		if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    //$condition['OR']=array('CompanyDetail.id LIKE'=>'%'.$searchKey.'%','CompanyDetail.ward LIKE'=>'%'.$searchKey.'%','CompanyDetail.awc_code LIKE'=>'%'.$searchKey.'%','CompanyDetail.awc_worker LIKE '=>'%'.$searchKey.'%','CompanyDetail.asha_name LIKE '=>'%'.$searchKey.'%'); 
	$condition2.=' and CompanyDetail.id LIKE %'.$searchKey.'% || CompanyDetail.name_of_ngo LIKE %'.$searchKey.'% || CompanyDetail.abbreviation LIKE %'.$searchKey.'%';
	
	}
	
	
		if(isset($this->request->query['district']) and ($this->request->query['district']!=0) and ($this->request->query['district']!='')){$searchBuilderId=trim($this->request->query['district']);  //$condition['Enquiry.country_id']=$searchCountryId;
		$condition2.=' and CompanyDetail.allocated_district='.$searchBuilderId;
		
		}
		
		if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBlockId=trim($this->request->query['block']); //$condition['Enquiry.builder_id']=$searchBuilderId;
		$condition2.=' and CompanyDetail.allocated_block_one='.$searchBlockId;
		}
                if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchId=trim($this->request->query['block']); //$condition['Enquiry.builder_id']=$searchBuilderId;
		$condition2.=' and CompanyDetail.allocated_block_two='.$searchId;
		}
		
		
		
		
		}
		else {
		 if(CakeSession::read('User.type')==='user'){
			$condition='CompanyDetail.chief_functionary_name='.CakeSession::read('User.id');
			//$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
				
		}
		else {
		
		}
		}
		//$condition['NOT']=array('Enquiry.status'=>"trash");
		$condition2.=' and CompanyDetail.status="active"';
		$this->response->download("CompanyDetail.csv");
		//print_r($condition); exit;
		$data=$this->CompanyDetail->query('select CompanyDetail.id,CompanyDetail.name_of_ngo,CompanyDetail.abbreviation,CompanyDetail.chief_functionary_name,CompanyDetail.mobile_one,CompanyDetail.mobile_two,CompanyDetail.email_id,CompanyDetail.project_emailid,CompanyDetail.permanent_address,CompanyDetail.permanent_pincode,CompanyDetail.fcra_number,City.name,b1.name,b2.name,User.name,User.last_name,Designation.name,CompanyDetail.fcra_registration_date,CompanyDetail.fcra_registration_valid_till,CompanyDetail.society_registration_no,CompanyDetail.society_registration_date,CompanyDetail.fcra_bank_ac_no,CompanyDetail.name_of_bank,CompanyDetail.ifsc,CompanyDetail.branch,CompanyDetail.project_name,CompanyDetail.agreement_no,CompanyDetail.agreement_sign_date,CompanyDetail.project_start_date,CompanyDetail.project_end_date,CompanyDetail.correspondence_address,CompanyDetail.correspondence_pincode,CompanyDetail.post_office_p,CompanyDetail.district_p,CompanyDetail.state_p,CompanyDetail.post_office_c,CompanyDetail.district_c,CompanyDetail.state_c,CompanyDetail.status from ngos as CompanyDetail left join cities as City  on CompanyDetail.allocated_district=City.id left join blocks b1 on CompanyDetail.allocated_block_one=b1.id left join blocks b2 on CompanyDetail.allocated_block_two=b2.id left join designations as Designation  on CompanyDetail.designation=Designation.id left join users as User on CompanyDetail.chief_functionary_name=User.id where 1 '.$condition2 );
		
		
		//$data = $this->CompanyDetail->find('all', array('conditions'=>$condition2));
		
		//$log = $this->Enquiry->getDataSource()->getLog(false, false);
        //debug($log);
		//exit;
		
	$headers = array('CompanyDetail'=>array( 'Id' => 'Id','NGO' => 'NGO', 'Abbreviation' => 'Abbreviation', 'District' => 'District', 'Block' => 'Block', 'Chief Functionary Name' => 'Chief Functionary Name','Designation' => 'Designation', 'Mobile' => 'Mobile','Email' => 'Email','Project Email ID' => 'Project Email ID','House/Street' => 'House/Street','Post Office' => 'Post Office','City' => 'City','State' => 'State','Pincode' => 'Pincode','House/Street(Correspondence)' => 'House/Street(Correspondence)','Post office' => 'Post office','City' => 'City','State' => 'State','Pincode'=>'Pincode','FCRA Number'=>'FCRA Number','FCRA Registration Date'=>'FCRA Registration Date','FCRA Registration Valid Till'=>'FCRA Registration Valid Till','Society Registration No'=>'Society Registration No','Society Registration Date'=>'Society Registration Date','FCRA Bank Account No'=>'FCRA Bank Account No','Name of Bank'=>'Name of Bank','IFSC'=>'IFSC','Branch'=>'Branch','Project Name'=>'Project Name','Agreement No'=>'Agreement No','Date of Signing the agreement'=>'Date of Signing the agreement','Project Start Date'=>'Project Start Date','Project End Date'=>'Project End Date','Status' => 'Status')); 
	    $this->set(compact('data','headers'));
		$this->layout = 'ajax';
		return;
		
		}
        
 ///// report  export section end  ---------/////           
	}
	
	
	
	
