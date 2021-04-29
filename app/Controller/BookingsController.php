<?php
App::uses('AppController', 'Controller');
/**
 * Bookings Controller
 *
 * @property Booking $Booking
 * @property PaginatorComponent $Paginator
 */
class BookingsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Upload');

    var  $uses = array('Booking','User','Project','Builder','BrokerCompany','Location','Country');
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
    $condition['OR']=array('Booking.id LIKE'=>'%'.$searchKey.'%','Booking.applicant_name1 LIKE'=>'%'.$searchKey.'%','Booking.unit_no LIKE'=>'%'.$searchKey.'%','Booking.unit_no LIKE '=>'%'.$searchKey.'%','Booking.area LIKE '=>'%'.$searchKey.'%'); 
	
	}
		
		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim($this->request->query['from_date']);
				$todate=trim($this->request->query['to_date']);
				$condition['AND']=array('date(Booking.date_of_booking) >='=>$fromdate,'date(Booking.date_of_booking) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim($this->request->query['from_date']);  
				$condition['Booking.date_of_booking']=$fromdate;	
				}
				
			}
		
		if(isset($this->request->query['search_builder']) and ($this->request->query['search_builder']!=0) and ($this->request->query['search_builder']!='')){$searchBuilderId=trim($this->request->query['search_builder']); 
		$condition['Booking.bulider_name']=$searchBuilderId;
		}
		
		if(isset($this->request->query['search_project']) and ($this->request->query['search_project']!=0) and ($this->request->query['search_project']!='')){$searchProjectId=trim($this->request->query['search_project']);
		$condition['Booking.project_name']=$searchProjectId;
		}
		
		if(isset($this->request->query['search_user']) and ($this->request->query['search_user']!=0) and ($this->request->query['search_user']!='')){$searchUserId=trim($this->request->query['search_user']);
		$condition['OR']=array('Booking.booked_by'=>$searchUserId,'Booking.booked_by_2'=>$searchUserId);
		}
		
		}
		
		
		$this->Paginator->settings = array('Booking' => array('limit' =>20,'order' => array('id' => 'desc'),'conditions'=>$condition));
		$this->Booking->recursive = 0;
		$this->set('bookings', $this->Paginator->paginate());
		
			if(isset($this->request->query['search_builder']) and ($this->request->query['search_builder']!=0 || $this->request->query['search_builder']!=''))
			{
				$projects=$this->Project->find('list',array('conditions'=>array('Project.builder_id'=>$this->request->query['search_builder'])));
				}
			else
			{
				$projects=$this->Project->find('list');
				}
			$users = $this->User->find('list',array('fields'=>array('parent'),'conditions'=>array('status'=>'active')));
			$builders=$this->Builder->find('list');
			$this->set(compact('users','projects','builders'));
			
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Booking->exists($id)) {
			throw new NotFoundException(__('Invalid booking'));
		}
		$options = array('conditions' => array('Booking.' . $this->Booking->primaryKey => $id));
		$this->set('booking', $this->Booking->find('first', $options));
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
			$this->Booking->create();
			if ($this->Booking->save($this->request->data)) {
				$this->Session->setFlash(__('The booking has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The booking could not be saved. Please, try again.'));
			}
		}
		$executives=$this->User->find('list',array('conditions'=>array('User.status'=>'active','User.role'=>'regular')));
		$projects=$this->Project->find('list');
		$locations=$this->Location->find('list');
		$builders=$this->Builder->find('list');
		$this->set(compact('executives','projects','builders','locations'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Booking->exists($id)) {
			throw new NotFoundException(__('Invalid booking'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Booking->save($this->request->data)) {
				$this->Session->setFlash(__('The booking has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The booking could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Booking.' . $this->Booking->primaryKey => $id));
			$this->request->data = $this->Booking->find('first', $options);
			$executives=$this->User->find('list',array('conditions'=>array('User.status'=>'active','User.role'=>'regular')));
			if($this->request->data['Booking']['bulider_name']!=0 and $this->request->data['Booking']['bulider_name']!='')
			{
				$projects=$this->Project->find('list',array('conditions'=>array('Project.builder_id'=>$this->request->data['Booking']['bulider_name'])));
				}
			else
			{
				$projects=$this->Project->find('list');
				}
			$locations=$this->Location->find('list');
			$builders=$this->Builder->find('list');
			$this->set(compact('executives','projects','builders','locations'));
		}
	}
	
	
	public function editDetails($id = null) {
		if (!$this->Booking->exists($id)) {
			throw new NotFoundException(__('Invalid booking'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Booking->save($this->request->data)) {
				$this->Session->setFlash(__('The booking has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The booking could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Booking.' . $this->Booking->primaryKey => $id));
			$this->request->data = $this->Booking->find('first', $options);
			$executives=$this->User->find('list',array('conditions'=>array('User.status'=>'active','User.role'=>'regular')));
			if($this->request->data['Booking']['bulider_name']!=0 and $this->request->data['Booking']['bulider_name']!='')
			{
				$projects=$this->Project->find('list',array('conditions'=>array('Project.builder_id'=>$this->request->data['Booking']['bulider_name'])));
				}
			else
			{
				$projects=$this->Project->find('list');
				}
			$locations=$this->Location->find('list');
			$countries=$this->Country->find('list');
			$builders=$this->Builder->find('list');
			$this->set(compact('executives','projects','builders','locations','countries'));
		}
	}
	
	public function bookingDetails($id = null) {
		if (!$this->Booking->exists($id)) {
			throw new NotFoundException(__('Invalid booking'));
		}
		$options = array('conditions' => array('Booking.' . $this->Booking->primaryKey => $id));
		$this->set('booking', $this->Booking->find('first', $options));
		$this->layout='newdefault';
	}
	
	
	public function bookingForm($id=null) {
		if (!$this->Booking->exists($id)) {
			throw new NotFoundException(__('Invalid banner'));
		}
		if ($this->request->is(array('post', 'put'))) {
		
		
		    $destinationorig  = realpath('../webroot/bookingform/') . '/';
	       
			$resultval="" ;
			if($this->request->data['Booking']['booking_pdf_new']['size']!=0){
			if(file_exists($destinationorig.$this->request->data['Booking']['booking_pdf']))	{
			@unlink($destinationorig.$this->request->data['Booking']['booking_pdf']);
			}
			
			$file = $this->request->data['Booking']['booking_pdf_new'];
			$resultval = $this->Upload->uploadimg($file,$destinationorig,'','',''); 
			$this->request->data['Booking']['booking_pdf']=$resultval;
			
			
			$this->Booking->read(null,$id);
			$this->Booking->set(array('booking_pdf'=>$this->request->data['Booking']['booking_pdf']));
			$this->Booking->save();
			
			$this->Session->setFlash(__('The data has been saved.'));
			return $this->redirect(array('action' => 'bookingForm',$id));
			} else {
				$this->Session->setFlash(__('The data could not be saved.PDF field should not be left blank.'));
			}
		} else {
			$options = array('fields'=>array('id','booking_pdf'),'conditions' => array('Booking.' . $this->Booking->primaryKey => $id));
			$this->request->data = $this->Booking->find('first', $options);
			//$this->set('booking', $this->Booking->find('first', $options));
		}
		$this->layout='ajax';
	}
	

/**  
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null,$status=null) {
		$this->Booking->id = $id;
		if (!$this->Booking->exists()) {
			throw new NotFoundException(__('Invalid booking'));
		}
		    $this->request->onlyAllow('post', 'delete');
		    $this->Booking->read(null,$id);
			$this->Booking->set(array('booking_canceled'=>$status));
		
		if ($this->Booking->save()) {
			$this->Session->setFlash(__('The booking has been '.$status));
		} else {
			$this->Session->setFlash(__('Nothing happen. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	public function getCommisionFromCompany() {
		                                  //"+bsp+"/"+area+"/"+rate+"/"+plc+"/"+carparking+"/"+other+"/"+val+"/"+incplc+"/"+incother+"/"+inccar
	    $this->layout='ajax';
        $this->autoRender = false;
		
		$bsp=$this->params->query['bsp'];
		$area=$this->params->query['area'];
		$rate=$this->params->query['rate'];
		$plc=$this->params->query['plc'];
		$carparking=$this->params->query['carparking'];
		$other=$this->params->query['other'];
		$val=$this->params->query['val'];
		$incplc=$this->params->query['incplc'];
		$incother=$this->params->query['incother'];
		$inccar=$this->params->query['inccar'];
		
		
		if( $incplc==0){ $plc=0;}
		if( $incother==0){ $other=0;}
		if( $inccar==0){ $carparking=0;}
		
		/*echo "bsp=".$bsp."</br>";
		echo "area=".$area."</br>";
		echo "rate=".$rate."</br>";
		echo "plc=".$plc."</br>";
		echo "carparking=".$carparking."</br>";
		echo "other=".$other."</br>";
		echo "val=".$val."</br>";
		echo "incplc=".$incplc."</br>";
		echo "incother=".$incother."</br>";
		echo "inccar=".$inccar."</br>";*/
  
  
  
  if( $rate==0 || $rate==''){  $total=($bsp+($area*$plc)+$other+$carparking)*$val/100; /*echo "($bsp+($area*$plc)+$other+$carparking)*$val/100";*/} 
  else{ $total=(($area*($rate+$plc))+$other+$carparking)*$val/100; /*echo "(($area*($rate+$plc))+$other+$carparking)*$val/100";*/}
  
  echo $total;
	
	}
	
	
	public function totalCommisionToCustomer() {
	    $this->layout='ajax';
        $this->autoRender = false;
		
		$commissioncoustomer=$this->params->query['commissioncoustomer'];
        $bsp=$this->params->query['bsp'];
        	
        $total=$bsp*$commissioncoustomer/100;
	   echo $total;
	}
	
	public function fetchcountry($country = null) {
		
		$result =$this->Country->query("select * from countries where id ='$country'");
	   
	   return $result;
	}
	
	
	
	public function fetchlocation($location = null) {
		
		$result =$this->Country->query("select * from locations where id ='$location'");
	   
	   return $result;
	}
	
	public function brokerageAmount() {
	$this->layout='ajax';
    $this->autoRender = false;
	
	$brokerage=$this->params->query['brokerage'];
	$bsp=$this->params->query['bsp'];
	$total=$bsp*$brokerage/100;
	echo $total;
    }
	
	public function customerCommisiOnPlc() {
	$this->layout='ajax';
    $this->autoRender = false;
	
	$plc=$this->params->query['plc'];
	$area=$this->params->query['area'];
	$customercommissionplc=$this->params->query['customercommissionplc'];
 	$total=($plc*$area*$customercommissionplc/100);
	echo $total;
    }
	
	public function customerCommisiOnCp() {
	$this->layout='ajax';
    $this->autoRender = false;
	
	$car=$this->params->query['car'];
	$customercommissioncp=$this->params->query['customercommissioncp'];
 	$total=($car*$customercommissioncp/100);
	echo $total;
    }
	
	
	public function totalCommisionToSubBroker() {
	$this->layout='ajax';
    $this->autoRender = false;
	
	$balance=$this->params->query['commissionbroker'];
 	$bsp=$this->params->query['bsp'];
	$total=$bsp*$balance/100;
	echo $total;
    }
	
	public function brokerCommisiOnPlc() {
	$this->layout='ajax';
    $this->autoRender = false;
	
	$plc=$this->params->query['plc'];
	$area=$this->params->query['area'];
	$brokercommissionplc=$this->params->query['brokercommissionplc'];
 	$total=($plc*$area*$brokercommissionplc/100);
	echo $total;
    }
	
	public function brokerCommisiOnCp() {
	$this->layout='ajax';
    $this->autoRender = false;
	
	$car=$this->params->query['car'];
	$brokercommissioncp=$this->params->query['brokercommissioncp'];
 	$total=($car*$brokercommissioncp/100);
	echo $total;
    }
	
	public function insentivePercent() {
	$this->layout='ajax';
    $this->autoRender = false;
	
		
  	$area=$this->params->query['area'];
	$rate=$this->params->query['rate'];
	$bsp=$this->params->query['bsp'];
	$plc=$this->params->query['plc'];
	$carparking=$this->params->query['carparking'];
	$other=$this->params->query['other'];
	$per=$this->params->query['insentive_per'];
	if($this->params->query['incplc']=='0')
	{
	$plc=0;
	}
	if($_GET['incother']=='0')
	{
	$other=0;
	}
	if($_GET['inccar']=='0')
	{
	$carparking=0;
	}
	if($rate=='0' || $rate==""){
	$total=$bsp*$per/100;
	} else
	{
	$total=(($area*($rate+$plc+$other))+$carparking)*$per/100;
	}
	echo $total;
    }
	
	public function insentiveTotalCommisionToCustomer() {
	$this->layout='ajax';
    $this->autoRender = false;
	
	$balance=$this->params->query['insentivecoustomer'];
	$bsp=$this->params->query['bsp'];
    $total=$bsp*$balance/100;
	echo $total;
    }
	
	public function insentiveCustomerCommisiOnPlc() {
	$this->layout='ajax';
    $this->autoRender = false;
	
	$plc=$this->params->query['plc'];
	$area=$this->params->query['area'];
	$customercommissionplc=$this->params->query['insentive_customercommissionplc'];
 	$total=($plc*$area*$customercommissionplc/100);
	echo $total;
    }
	
    public function insentiveCustomerCommisiOnCp() {
	$this->layout='ajax';
    $this->autoRender = false;
	
	$car=$this->params->query['car'];
	$customercommissioncp=$this->params->query['insentive_customercommissioncp'];
 	$total=($car*$customercommissioncp/100);
	echo $total;
    }
	
	public function insentiveTotalCommisionToSubbroker() {
	$this->layout='ajax';
    $this->autoRender = false;
	
	$balance=$this->params->query['insentive_commissionbroker'];
	$bsp=$this->params->query['bsp'];
    $total=$bsp*$balance/100;
	echo $total;
    }
	
	public function insentiveBrokerCommisionPlc() {
	$this->layout='ajax';
    $this->autoRender = false;
	
	$plc=$this->params->query['plc'];
	$area=$this->params->query['area'];
	$brokercommissionplc=$this->params->query['insentive_brokercommissionplc'];
 	$total=($plc*$area*$brokercommissionplc/100);
	echo $total;
    }
	
	public function insentiveBrokerCommisionCp() {
	$this->layout='ajax';
    $this->autoRender = false;
	
	$car=$this->params->query['car'];
	$brokercommissioncp=$this->params->query['insentive_brokercommissioncp'];
 	$total=($car*$brokercommissioncp/100);
	echo $total;
    }
	
	public function reportOptions() {
		$this->layout='ajax';

    $this->autoRender = false;
		$val='';$sql='';
	if(!empty($_GET['catid']))
{
	if($this->params->query['catid']=="all")
	{
	 $val="all#All";
	 if($val!="")
	 {
	 echo $val;
	 }
	 else
	 {
	 echo"#No result found";
	 }
	}
	
	if($this->params->query['catid']=="bulider")
	{
	$sql=$this->Builder->find('list');
	
	foreach($sql as $res=>$value)
	 {
		$val.=$res."#".$value."+";
	 }
	 $val=substr($val,0,-1);
	 if($val!="")
	 {
	 echo $val;
	 }
	 else
	 {
	 echo"#No result found";
	 }
	}
	
	if($this->params->query['catid']=="executive")
	{
	$sql=$this->User->find('list',array('fields'=>array('id','username'),'conditions'=>array('User.role'=>'regular')));
	foreach($sql as $res=>$value)
	 {
		$val.=$res."#".$value."+";
	 }
	 $val=substr($val,0,-1);
	 if($val!="")
	 {
	 echo $val;
	 }
	 else
	 {
	 echo"#No result found";
	 }
	 
	
	}
	
	if($this->params->query['catid']=="location")
	{
	$sql=$this->Location->find('list');
	foreach($sql as $res=>$value)
	 {
		$val.=$res."#".ucwords($value)."+";
	 }
	 $val=substr($val,0,-1);
	 if($val!="")
	 {
	 echo $val;
	 }
	 else
	 {
	 echo"#No result found";
	 }
	}
	
	if($this->params->query['catid']=="cheque")
	{
	$val="ok#ok+pending#pending";
	if($val!="")
	 {
	 echo $val;
	 }
	 else
	 {
	 echo"#No result found";
	 }
	 
	
	}

	if($this->params->query['catid']=="bookingstatus")
	{
$val="uncancel#Confirm+cancel#Cancel";
if($val!="")
	{
	echo $val;
	}
	else
	{
	echo"#No result found";
	}
}
}
	}
	
	
	
	public function getProject() {
	$this->layout='ajax';
    $this->autoRender = false;
	$sql='';$res='';$val='';
	$builder=$this->params->query['val'];
	$sql =$this->Project->find('list',array('conditions'=>array('Project.builder_id'=>$builder)));
	
		foreach($sql as $res=>$value)
		 {
		$val.=$res."#".$value."+";
	 }
	 $val=substr($val,0,-1);
	 if($val!="")
	 {
	 echo $val;
	 }
	 else
	 {
	 echo"#No result found";
	 }
    }
	
	public function detailedReport() {
	//$this->layout='sub-default';
	
	$startdate=$this->params->query['fdate'];
	$enddate=$this->params->query['ldate'];
	$condition='';
	$myquery='';
	$query="select * from bookings where ";
	
	if($this->params->query['type']=="bulider")
	{
	$query.="project_name='".$this->params->query['subcategory']."' and ";
	$condition['Booking.project_name']=$this->params->query['subcategory'];
	}
	elseif($this->params->query['type']=="executive")
	{
	$query.=" ( booked_by='".$this->params->query['category']."' || booked_by_2='".$this->params->query['category']."' ) and ";
	$condition['AND']=array('Booking.booked_by'=>$this->params->query['category'],'Booking.booked_by_2'=>$this->params->query['category']);
	}
	elseif($this->params->query['type']=="location")
	{
	$query.=" ( project_location='".$this->params->query['category']."' ) and ";
	$condition['Booking.project_location']=$this->params->query['category'];
	}
	elseif($this->params->query['type']=="cheque")
	{
	$query.=" ( cheque_clearance_status='".$this->params->query['category']."' ) and ";
	$condition['Booking.cheque_clearance_status']=$this->params->query['category'];
	}
	elseif($this->params->query['type']=="bookingstatus")
	{
	$query.=" ( booking_canceled='".trim($this->params->query['category'])."' )  and ";
	$condition['Booking.booking_canceled']=$this->params->query['category'];
	}
	$query.=" ( date(date_of_booking) between '".$startdate."' and '".$enddate."') and ( status='active' ) order by date_of_booking ";
	$condition['AND']=array('date(Booking.date_of_booking) >='=>$startdate,'date(Booking.date_of_booking) <='=>$enddate);

	//$myquery=$this->Booking->find('all',array('conditions'=>array($condition)));
	$myquery=$this->Booking->query($query);
	$this->set('myquery',$myquery);
	$this->set('startdate',$startdate);
	$this->set('enddate',$enddate);
  
	
    }
	
	
	public function applicantdetail() {
	//$this->layout='sub-default';
	
	$startdate=$this->params->query['afdate'];
	$enddate=$this->params->query['aldate'];

	
	//echo $startdate;
	//echo $enddate;
	$condition='';
	$myquery='';
	
	$query="select * from bookings where ";
	
	if($this->params->query['type']=="bulider")
	{
	$query.="project_name='".$this->params->query['subcategory']."' and ";
	}
	$query.="date_of_booking between '".$startdate."' and '".$enddate."' and status='active' order by date_of_booking";
	$applicantdetail=$this->Booking->query($query);
	
	//print_r($applicantdetail); exit;
	

	$this->set('applicantdetail',$applicantdetail);
	$this->set('startdate',$startdate);
	$this->set('enddate',$enddate);
  
	
    }  
	
	public function builderReport() {
	$startdate=$this->params->query['hfdate'];
	$enddate=$this->params->query['hldate'];
	$condition='';
	$myquery='';
	
	$query="select * from bookings where ";
	
	if($this->params->query['type']=="bulider")
	{
	$query.="project_name='".$this->params->query['subcategory']."' and ";
	}
	elseif($this->params->query['type']=="executive")
	{
	$query.="booked_by='".$this->params->query['category']."' || booked_by_2='".$this->params->query['category']."' and ";
	}
	elseif($this->params->query['type']=="location")
	{
	$query.="project_location='".$this->params->query['category']."' and ";
	}
	elseif($this->params->query['type']=="cheque")
	{
	$query.="cheque_clearance_status='".$this->params->query['category']."' and ";
	}
	elseif($this->params->query['type']=="bookingstatus")
	{
	$query.="booking_canceled='".trim($this->params->query['category'])."' and ";
	}
	$query.="date_of_booking between '".$startdate."' and '".$enddate."' and status='active' order by date_of_booking";

	$myquery=$this->Booking->query($query);
	$this->set('myquery',$myquery);
	$this->set('startdate',$startdate);
	$this->set('enddate',$enddate);
	
	
	}
	
	
	public function summaryReport() {
	//$this->layout='sub-default';
	$startdate=$this->params->query['sfdate'];
	$enddate=$this->params->query['sldate'];
	$condition='';
	$myquery='';
	
	
	$executivenames=$this->Booking->query("(select distinct booked_by as user from bookings where bookings.date_of_booking between '".$startdate."' and '".$enddate."') union (select distinct booked_by_2 as user from bookings where bookings.date_of_booking between '".$startdate."' and '".$enddate."')order by (select username from users where id='user' and status='active')");
	
	//print_r($executivenames); exit;
	

	$this->set('executivenames',$executivenames);
	$this->set('startdate',$startdate);
	$this->set('enddate',$enddate);
	
	
	}
	
	
	public function totalnum1($id=null,$startdate,$enddate) {
	$this->layout='ajax';
    $this->autoRender = false;
	
	
	$total=$this->Booking->query("select count(*) as total from bookings where booked_by='".$id."'  and booked_by_2='-1' and date_of_booking between '".$startdate."' and '".$enddate."'");

	return $total[0][0]['total'];
    }
	
	public function totalnum2($id=null,$startdate,$enddate) {
	$this->layout='ajax';
    $this->autoRender = false;
	
	$total=$this->Booking->query("select count(*) as total from bookings where ((booked_by='".$id."' and booked_by_2!='-1') or (booked_by!='-1' and booked_by_2='".$id."')) and date_of_booking between '".$startdate."' and '".$enddate."'");
	return $total[0][0]['total'];
    }
	
	public function executivenam() {
	$this->layout='ajax';
    $this->autoRender = false;
	
	$total=$this->Booking->query("select distinct( build.name),build.id From builders as build where build.status='active' order by build.name asc");
	return $total;
    }
	
	public function tp($builder=null,$startdate,$enddate) {
	$this->layout='ajax';
    $this->autoRender = false;
	
$total=$this->Booking->query("select count(*) as total from bookings where bulider_name='".$builder."' and date_of_booking between '".$startdate."' and '".$enddate."'");
	return $total[0][0]['total'];
	
    }
	
	/*public function executivenamm($startdate,$enddate) {
	$this->layout='ajax';
    $this->autoRender = false;
	
	$total=$this->Booking->query("select distinct book.project_location,loc.name from bookings as book join locations as loc on book.project_location=loc.id where status='active' and date_of_booking between '".$startdate."' and '".$enddate."' order by loc.name asc");
	return $total;

    }*/
	
	public function executivenamm($startdate,$enddate) {
	$this->layout='ajax';
    $this->autoRender = false;
	
	$total=$this->Booking->query("select distinct loc.name,loc.id from locations as loc where status='active' order by loc.name asc");
	return $total;
    }
	
	public function tpp($location=null,$startdate,$enddate) {
	$this->layout='ajax';
    $this->autoRender = false;
	
	$total=$this->Booking->query("select count(*) as total from bookings where status='active' and project_location='".$location."' and date_of_booking between '".$startdate."' and '".$enddate."'");

	return $total[0][0]['total'];
    }
	
	public function allexename() {
	$this->layout='ajax';
    $this->autoRender = false;
	
	$total=$this->Booking->query("select * from users where role='regular'   and status='active'  order by name asc");
	return $total;
    }
    public function totalUserbook(){
	
		$totalusersdata=$this->User->query("SELECT distinct id,name,last_name  FROM `users` WHERE `role` = 'regular' AND `type` = 'marketing' AND `status` = 'active'AND `phone` != '' order by name asc");
		return	 $totalusersdata;	
		//print_r(($totalusersdata[0][0]['total'])-3);
	
	// (-3 is use to remove developer person, other & marketing)
		}
	
	
	public function abc($startdate,$enddate) {
	$this->layout='ajax';
    $this->autoRender = false;
	
	$total=$this->Booking->query("(select distinct booked_by as user from bookings where status='active' and bookings.date_of_booking between '".$startdate."' and '".$enddate."') union (select distinct booked_by_2 as user from bookings where bookings.date_of_booking between '".$startdate."' and '".$enddate."')order by user");
	return $total;
    }
	public function countno_exe($startdate,$enddate) {
	$this->layout='ajax';
    $this->autoRender = false;
	
	$total=$this->Booking->query("(select Count(Distinct booked_by)  as total from bookings where bookings.date_of_booking between '".$startdate."' and '".$enddate."' and booked_by!='-1') union (select distinct booked_by_2 as user from bookings where bookings.date_of_booking between '".$startdate."' and '".$enddate."' and booked_by_2!='-1')");
	return $total[0][0]['total'];
    }
	
	
	public function executivenames($startdate,$enddate) {
	$this->layout='ajax';
    $this->autoRender = false;
	
	$total=$this->Booking->query("select count(project_name) as total from bookings where status='active' and date_of_booking between '".$startdate."' and '".$enddate."'");
	return $total[0][0]['total'];
    }
	
	public function countbuilder() {
	$this->layout='ajax';
    $this->autoRender = false;
	
	$total=$this->Booking->query("select count(distinct name) as total  from builders");
	return $total[0][0]['total'];
    }
	public function countbuilderactive() {
	$this->layout='ajax';
    $this->autoRender = false;
	
	$total=$this->Booking->query("select count(distinct name) as total  from builders where status='active'");
	return $total[0][0]['total'];
    }
	
	public function executivenamesss($startdate,$enddate) {
	$this->layout='ajax';
    $this->autoRender = false;
	
	$total=$this->Booking->query("select count(project_name) as total  from bookings where status='active' and date_of_booking between '".$startdate."' and '".$enddate."'");
	return $total[0][0]['total'];
    }
	
	/*public function countloc($startdate,$enddate) {
	$this->layout='ajax';
    $this->autoRender = false;
	
	$total=$this->Booking->query("select count(distinct project_location) as total from bookings where status='active' and date_of_booking between '".$startdate."' and '".$enddate."'");
	return $total[0][0]['total'];
    }*/
	public function countloc($startdate,$enddate) {
	$this->layout='ajax';
    $this->autoRender = false;
	
	$total=$this->Booking->query("select count(distinct name) as total from locations where status='active'");
	return $total[0][0]['total'];
    }
	}
	
	
	
	
