<?php
App::uses('AppController', 'Controller');
/**
 * FacilityDetails Controller
 *
 * @property Ngo $GeographicalNgo
 * @property PaginatorComponent $Paginator
 */
class VhsncUntiedfundsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Upload');

    var  $uses = array('VhsncUntiedfund','VhsncUntiedfundDetail','VhsncConstitution','Geographical','Ngo','User','Project','Village','Panchayat','Ward','Country','City','Block','Designation','ReportingPeriod','Bpccc','Bpc','Dpo');
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
    $condition['OR']=array('VhsncUntiedfund.id LIKE'=>'%'.$searchKey.'%','VhsncUntiedfund.expenditure_details LIKE'=>'%'.$searchKey.'%','VhsncUntiedfund.expenditure_amount LIKE'=>'%'.$searchKey.'%'); 
	
	}
//		
		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition['AND']=array('date(VhsncUntiedfund.balance_check_date) >='=>$fromdate,'date(VhsncUntiedfund.balance_check_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=date('Y-m-d',strtotime($this->request->query['from_date']));  
				$condition['VhsncUntiedfund.balance_check_date']=$fromdate;	
				}
				
			}
//		
              if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBuilderId=trim($this->request->query['block']); 
		$condition['VhsncUntiedfund.block']=$searchBuilderId;
		}
		if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchPanchayatId=trim($this->request->query['panchayat']); 
		$condition['VhsncUntiedfund.panchayat']=$searchPanchayatId;
		}
		
		if(isset($this->request->query['village']) and ($this->request->query['village']!=0) and ($this->request->query['village']!='')){$searchProjectId=trim($this->request->query['village']);
		$condition['VhsncUntiedfund.village']=$searchProjectId;
		}
               // print_r($condition);
		
	}
        if(CakeSession::read('User.type')==='regular'){
             //echo CakeSession::read('User.subrole');
            // die();
             if(CakeSession::read('User.subrole')==='CC'){
		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'))));
                      if($r){ 
                          if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchPanchayatId=trim($this->request->query['panchayat']); 
		$condition['VhsncUntiedfund.panchayat']=$searchPanchayatId;
		} else {
                      // $condition='VhsncMember.panchayat='.$r['Bpccc']['allocated_panchayat'];
                       $condition=['VhsncUntiedfund.panchayat IN' =>explode(',',$r['Bpccc']['allocated_panchayat'])];
                }
                
		if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('VhsncUntiedfund.id LIKE'=>'%'.$searchKey.'%','VhsncUntiedfund.expenditure_details LIKE'=>'%'.$searchKey.'%','VhsncUntiedfund.expenditure_amount LIKE'=>'%'.$searchKey.'%'); 
	
	}
                if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition['AND']=array('date(VhsncUntiedfund.balance_check_date) >='=>$fromdate,'date(VhsncUntiedfund.balance_check_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=date('Y-m-d',strtotime($this->request->query['from_date']));  
				$condition['VhsncUntiedfund.balance_check_date']=$fromdate;	
				}
				
			}
                      } 
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Village yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
			//$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
			  $panchayats=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Panchayat.id IN'=>explode(',',$r['Bpccc']['allocated_panchayat']))));
                    	
		}
                
                 elseif(CakeSession::read('User.subrole')==='BPC'){
		   $r = $this->Bpc->find('first',array('conditions'=>array('Bpc.first_name='.CakeSession::read('User.id'))));
                      if($r){ 
                           if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBuilderId=trim($this->request->query['block']); 
		$condition['VhsncUntiedfund.block']=$searchBuilderId;
		} else {
                      // $condition='VhsncMember.block='.$r['Bpc']['allocated_block'];
                       $condition=['VhsncUntiedfund.block IN' =>explode(',',$r['Bpc']['allocated_block'])];
                }
                
		if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('VhsncUntiedfund.id LIKE'=>'%'.$searchKey.'%','VhsncUntiedfund.expenditure_details LIKE'=>'%'.$searchKey.'%','VhsncUntiedfund.expenditure_amount LIKE'=>'%'.$searchKey.'%'); 
	
	}
                if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition['AND']=array('date(VhsncUntiedfund.balance_check_date) >='=>$fromdate,'date(VhsncUntiedfund.balance_check_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=date('Y-m-d',strtotime($this->request->query['from_date']));
                                $condition['VhsncUntiedfund.balance_check_date']=$fromdate;	
				}
				
			}
                      } 
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Village yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
			//$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
			  $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id IN'=>explode(',',$r['Bpc']['allocated_block']))));
                   	
		}
                
                
                 else {
		   $r = $this->Dpo->find('first',array('conditions'=>array('Dpo.first_name='.CakeSession::read('User.id'))));
                      if($r){ 
                           if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBuilderId=trim($this->request->query['block']); 
		$condition['VhsncUntiedfund.block']=$searchBuilderId;
		} else {
                       $condition='VhsncUntiedfund.district='.$r['Dpo']['district'];
                       
                }
                     
		if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('VhsncUntiedfund.id LIKE'=>'%'.$searchKey.'%','VhsncUntiedfund.expenditure_details LIKE'=>'%'.$searchKey.'%','VhsncUntiedfund.expenditure_amount LIKE'=>'%'.$searchKey.'%'); 
	
	}  
                       if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition['AND']=array('date(VhsncUntiedfund.balance_check_date) >='=>$fromdate,'date(VhsncUntiedfund.balance_check_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=date('Y-m-d',strtotime($this->request->query['from_date']));
                                $condition['VhsncUntiedfund.balance_check_date']=$fromdate;	
				}
				
			}
                      } 
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Village yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
			//$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
			 $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.City_id'=>$r['Dpo']['district'])));
                        $panchayats=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Panchayat.city_id'=>$r['Dpo']['district'])));
                        $villages=$this->Village->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Village.city_id'=>$r['Dpo']['district'])));	
		}
         }
         else if(CakeSession::read('User.type')==='user'){
	   $r = $this->Ngo->find('first',array('conditions'=>array('Ngo.chief_functionary_name='.CakeSession::read('User.id'))));
                 if($r){
                     $blo=array();
                   $blo= [$r['Ngo']['allocated_block_one'],$r['Ngo']['allocated_block_two']];
                     if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){
                              $searchBlockId=trim($this->request->query['block']);
		         $condition['VhsncUntiedfund.block']=$searchBlockId;
		        }else {
                            
                       $condition=['VhsncUntiedfund.block IN' =>$blo];
                       
                      }
                      
		if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('VhsncUntiedfund.id LIKE'=>'%'.$searchKey.'%','VhsncUntiedfund.expenditure_details LIKE'=>'%'.$searchKey.'%','VhsncUntiedfund.expenditure_amount LIKE'=>'%'.$searchKey.'%'); 
	
	}  
          if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition['AND']=array('date(VhsncUntiedfund.balance_check_date) >='=>$fromdate,'date(VhsncUntiedfund.balance_check_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=date('Y-m-d',strtotime($this->request->query['from_date']));
                                $condition['VhsncUntiedfund.balance_check_date']=$fromdate;	
				}
				
			}
		}
                 $blocks=$this->Block->find('list',array('order' => array('name' => 'asc'),'conditions'=>array('Block.id IN'=>$blo)));
                 $ngos=$this->Ngo->find('list',array('conditions'=>array('Ngo.id'=>$r['Ngo']['id'])));
                     
         }
         else {
             $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc')));
                $panchayats=$this->Panchayat->find('list',array('order'=>array('name'=>'asc')));
                $villages=$this->Village->find('list',array('order'=>array('name'=>'asc')));
         }
		
		$this->Paginator->settings = array('VhsncUntiedfund' => array('limit' =>20,'group'=>array('panchayat'),'order' => array('id' => 'desc'),'conditions'=>array($condition,'VhsncUntiedfund.status'=>'active')));
		$this->VhsncUntiedfund->recursive = 0;
		$this->set('untiedfunds', $this->Paginator->paginate());
		
			
//			$users = $this->User->find('list',array('fields'=>array('parent'),'conditions'=>array('status'=>'active')));
//			$builders=$this->Builder->find('list');
			$this->set(compact('users','blocks','panchayats','villages'));
			
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->VhsncUntiedfund->exists($id)) {
			throw new NotFoundException(__('Invalid Untiedfund'));
		}
		$options = array('conditions' => array('VhsncUntiedfund.' . $this->VhsncUntiedfund->primaryKey => $id));
		$this->set('untiedfund', $this->VhsncUntiedfund->find('first', $options));
		$this->layout='newdefault';
	}
	
	
	public function viewdetails($id = null) {
//		if (!$this->VhsncUntiedfund->exists($id)) {
//			throw new NotFoundException(__('Invalid Untiedfund'));
//		}
            $r=  explode(',',$id);
		$options = array('conditions' => array('VhsncUntiedfund.panchayat' => $r['0'],'VhsncUntiedfund.status' =>'active'));
		$this->set('untiedfunds', $this->VhsncUntiedfund->find('all', $options));
		$this->layout='newdefault';
	}
/**
 * add method
 *
 * @return void
 */
	public function add() {




		if ($this->request->is('post')) {
			$this->VhsncUntiedfund->create();
                      // print_r($this->request->data);
                       //die();
                        $total='';
                          //$organization =  $this->request->data['VhsncUntiedfund']['organization'];
                          for($i=0;$i<count($this->request->data['VhsncUntiedfund']['expenditure_date']);$i++){
                              
                           
                          $district =  $this->request->data['VhsncUntiedfund']['district'];
                          $block =  $this->request->data['VhsncUntiedfund']['block'];
                          $panchayat =  $this->request->data['VhsncUntiedfund']['panchayat'];
                          $village =  $this->request->data['VhsncUntiedfund']['village'];
                          $ward =  $this->request->data['VhsncUntiedfund']['ward']; 
                          $vhsnc_name =  $this->request->data['VhsncUntiedfund']['vhsnc_name']; 
                          $balance_check_date = date('Y-m-d',strtotime($this->request->data['VhsncUntiedfund']['balance_check_date'])); 
                          $total_expenditure =  $this->request->data['VhsncUntiedfund']['total_expenditure'];
                          $balance_on_date =  $this->request->data['VhsncUntiedfund']['balance_on_date']-$this->request->data['VhsncUntiedfund']['current_total_amount'];
                          $current_total_amount =  $this->request->data['VhsncUntiedfund']['current_total_amount'];
                          $expenditure_date =  date('Y-m-d',strtotime($this->request->data['VhsncUntiedfund']['expenditure_date'][$i]));
                          $expenditure_details =  $this->request->data['VhsncUntiedfund']['expenditure_details'][$i];
                          $expenditure_amount =  $this->request->data['VhsncUntiedfund']['expenditure_amount'][$i];
                          
                            
                $data= array (
                            
                             'district' => $district,
                             'block' => $block ,
                             'panchayat' => $panchayat,
                             'village' => $village ,
                             'ward' => $ward,
                             'vhsnc_name' => $vhsnc_name,
                             'total_expenditure' => $total_expenditure ,
                             'balance_check_date' => $balance_check_date ,
                             'balance_on_date' => $balance_on_date ,
                             'current_total_amount' => $current_total_amount,
                             'expenditure_date' => $expenditure_date ,
                             'expenditure_details' => $expenditure_details ,
                             'expenditure_amount' => $expenditure_amount,
                             'updated' => 0 
                      ) ;  
                          $save=$this->VhsncUntiedfund->saveAll($data);
                          }
			if ($save) {
				$this->Session->setFlash(__('The Untiedfund Detail has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Untiedfund Detail could not be saved. Please, try again.'));
			}
		}
                if(CakeSession::read('User.type')==='regular'){
                     
                     if(CakeSession::read('User.subrole')==='CC'){
		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'))));
                       
                       
	            $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Bpccc']['allocated_district'])));
                    $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id'=>$r['Bpccc']['allocated_block'])));
                    $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Panchayat.id IN'=>explode(',',$r['Bpccc']['allocated_panchayat']))));
                    
                   $village=$this->Village->find('list',array('order'=>array('name'=>'asc')));
				
		}
                
                 elseif(CakeSession::read('User.subrole')==='BPC'){
		  $r = $this->Bpc->find('first',array('conditions'=>array('Bpc.first_name='.CakeSession::read('User.id'))));
                         
	            $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Bpc']['allocated_district'])));
                    $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id IN'=>explode(',',$r['Bpc']['allocated_block']))));
                   
                    
                    $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc')));
                    $village=$this->Village->find('list',array('order'=>array('name'=>'asc')));
		}
                
                
                 else {
		  $r = $this->Dpo->find('first',array('conditions'=>array('Dpo.first_name='.CakeSession::read('User.id'))));
                         
	            $cities=$this->City->find('list',array('conditions'=>array('City.id'=>$r['Dpo']['district'])));
                   $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc')));
                    $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc')));
                    $village=$this->Village->find('list',array('order'=>array('name'=>'asc')));
		}
		   }
                else {
                    $cities=$this->City->find('list',array('order'=>array('name'=>'asc')));
                    $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc')));
                    $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc')));
                    $village=$this->Village->find('list',array('order'=>array('name'=>'asc')));
                }
		//$executives=$this->User->find('list',array('conditions'=>array('User.status'=>'active','User.role'=>'regular')));
		 $reporting_periods=$this->ReportingPeriod->query("select * from reporting_periods");
                //$cities=$this->City->find('list');
                $desig=$this->Designation->find('list');
		//$blocks=$this->Block->find('list');
		$ngos=$this->Ngo->find('list');
                //$panchayat=$this->Panchayat->find('list');
                //$village=$this->Village->find('list');
                $ward=$this->Ward->find('list');
		$this->set(compact('panchayat','cities','ngos','blocks','desig','village','reporting_periods','ward'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->VhsncUntiedfund->exists($id)) {
			throw new NotFoundException(__('Invalid Untiedfund'));
		}
		if ($this->request->is(array('post', 'put'))) {
                     //print_r($this->request->data);
                      //  die();
                          $district =  $this->request->data['VhsncUntiedfund']['district'];
                          $block =  $this->request->data['VhsncUntiedfund']['block'];
                          $panchayat =  $this->request->data['VhsncUntiedfund']['panchayat'];
                          $village =  $this->request->data['VhsncUntiedfund']['village'];
                          $ward =  $this->request->data['VhsncUntiedfund']['ward'];
                          $vhsnc_name =  $this->request->data['VhsncUntiedfund']['vhsnc_name']; 
                          $total_expenditure =  $this->request->data['VhsncUntiedfund']['total_expenditure'];
                          $balance_check_date =  date('Y-m-d',strtotime($this->request->data['VhsncUntiedfund']['balance_check_date']));
                          $current_total_amount =  $this->request->data['VhsncUntiedfund']['current_total_amount'];
                          $expenditure_date =  date('Y-m-d',strtotime($this->request->data['VhsncUntiedfund']['expenditure_date']));
                          $expenditure_details =  $this->request->data['VhsncUntiedfund']['expenditure_details'];
                          $expenditure_amount =  $this->request->data['VhsncUntiedfund']['expenditure_amount'];
                          // $balance_on_date =  $this->request->data['VhsncUntiedfund']['balance_on_date'];
                           if($this->request->data['VhsncUntiedfund']['current_total_amount'] > $this->request->data['VhsncUntiedfund']['current_total_amount1']) {
                                  $total = $this->request->data['VhsncUntiedfund']['current_total_amount']- $this->request->data['VhsncUntiedfund']['current_total_amount1'];
                                  $balance_on_date =  $this->request->data['VhsncUntiedfund']['balance_on_date']-$total;
                           }
                           elseif($this->request->data['VhsncUntiedfund']['current_total_amount'] < $this->request->data['VhsncUntiedfund']['current_total_amount1']){
                                  $total = $this->request->data['VhsncUntiedfund']['current_total_amount1']- $this->request->data['VhsncUntiedfund']['current_total_amount'];
                                  $balance_on_date =  $this->request->data['VhsncUntiedfund']['balance_on_date']+$total;
                           }
                            else {
                                 $balance_on_date =  $this->request->data['VhsncUntiedfund']['balance_on_date'];
                              }
                            
                $data= array (
                            
                             'district' => $district,
                             'block' => $block ,
                             'panchayat' => $panchayat,
                             'village' => $village ,
                             'ward' => $ward ,
                             'vhsnc_name' => $vhsnc_name,
                             'total_expenditure' => $total_expenditure ,
                             'balance_check_date' => $balance_check_date ,
                             'balance_on_date' => $balance_on_date ,
                             'current_total_amount' => $current_total_amount,
                             'expenditure_date' => $expenditure_date ,
                             'expenditure_details' => $expenditure_details ,
                             'expenditure_amount' => $expenditure_amount ,
                              'updated' => 1 ,
                              'id'=>$id
                      ) ; 
                       
			if ($this->VhsncUntiedfund->save($data)) {
                            
                          $membersdata1=$this->VhsncUntiedfund->query("update vhsnc_untiedfunds set current_total_amount='".$current_total_amount."' where vhsnc_name='".$this->request->data['VhsncUntiedfund']['vhsnc_name']."'and balance_check_date=".date('Y-m-d',strtotime($this->request->data['VhsncUntiedfund']['balance_check_date'])));
	
                          $membersdata=$this->VhsncUntiedfund->query("update vhsnc_untiedfunds set balance_on_date='".$balance_on_date."' where vhsnc_name='".$this->request->data['VhsncUntiedfund']['vhsnc_name']."'and balance_check_date=".date('Y-m-d',strtotime($this->request->data['VhsncUntiedfund']['balance_check_date'])));
	                 
 
                           if($membersdata1) {
				$this->Session->setFlash(__('The VHSNC  Untiedfund Detail has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The VHSNC Untiedfund Detail could not be saved. Please, try again.'));
			}
                        }
		} else {
			$options = array('conditions' => array('VhsncUntiedfund.' . $this->VhsncUntiedfund->primaryKey => $id));
			$this->request->data = $this->VhsncUntiedfund->find('first', $options);
                     
                        }
                        
                     if(CakeSession::read('User.type')==='regular'){
                     
                     if(CakeSession::read('User.subrole')==='CC'){
		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'))));
                       
                       
	            $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Bpccc']['allocated_district'])));
                    $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id'=>$r['Bpccc']['allocated_block'])));
                    $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Panchayat.id IN'=>explode(',',$r['Bpccc']['allocated_panchayat']))));
                     if($this->request->data['VhsncUntiedfund']['panchayat']!=0 and $this->request->data['VhsncUntiedfund']['panchayat']!='')
			{
		     $village=$this->Village->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Village.panchayat_id'=>$this->request->data['VhsncUntiedfund']['panchayat'])));
		    } 
                    else {
                   $village=$this->Village->find('list',array('order'=>array('name'=>'asc')));
                    }	
		}
                
                 elseif(CakeSession::read('User.subrole')==='BPC'){
		  $r = $this->Bpc->find('first',array('conditions'=>array('Bpc.first_name='.CakeSession::read('User.id'))));
                         
	            $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Bpc']['allocated_district'])));
                    $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id IN'=>explode(',',$r['Bpc']['allocated_block']))));
                      if($this->request->data['VhsncUntiedfund']['panchayat']!=0 and $this->request->data['VhsncUntiedfund']['panchayat']!='')
			{
		     $village=$this->Village->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Village.panchayat_id'=>$this->request->data['VhsncUntiedfund']['panchayat'])));
		    } 
                    else {
                   $village=$this->Village->find('list',array('order'=>array('name'=>'asc')));
                    }
                   if($this->request->data['VhsncUntiedfund']['panchayat']!=0 and $this->request->data['VhsncUntiedfund']['panchayat']!='')
			{
		     $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Panchayat.id'=>$this->request->data['VhsncUntiedfund']['panchayat'])));
		    }
                    else {
                         $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc')));
                    }
                  
                   // $village=$this->Village->find('list');
		}
                
                
                 else {
		  $r = $this->Dpo->find('first',array('conditions'=>array('Dpo.first_name='.CakeSession::read('User.id'))));
                         
	            $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Dpo']['district'])));
                   
                     if($this->request->data['VhsncUntiedfund']['block']!=0 and $this->request->data['VhsncUntiedfund']['block']!='')
			{
		     $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id'=>$this->request->data['VhsncUntiedfund']['block'])));
		    } 
                    else {
                    $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc')));
                    }
                   
                    if($this->request->data['VhsncUntiedfund']['panchayat']!=0 and $this->request->data['VhsncUntiedfund']['panchayat']!='')
			{
		     $village=$this->Village->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Village.panchayat_id'=>$this->request->data['VhsncUntiedfund']['panchayat'])));
		    } 
                    else {
                   $village=$this->Village->find('list',array('order'=>array('name'=>'asc')));
                    }
                   if($this->request->data['VhsncUntiedfund']['panchayat']!=0 and $this->request->data['VhsncUntiedfund']['panchayat']!='')
			{
		     $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Panchayat.id'=>$this->request->data['VhsncUntiedfund']['panchayat'])));
		    }
                    else {
                         $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc')));
                    }
		}
		   }
                else {
                    $cities=$this->City->find('list',array('order'=>array('name'=>'asc')));
                    if($this->request->data['VhsncUntiedfund']['block']!=0 and $this->request->data['VhsncUntiedfund']['block']!='')
			{
		     $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id'=>$this->request->data['VhsncUntiedfund']['block'])));
		    } 
                    else {
                    $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc')));
                    }
                   
                    if($this->request->data['VhsncUntiedfund']['panchayat']!=0 and $this->request->data['VhsncUntiedfund']['panchayat']!='')
			{
		     $village=$this->Village->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Village.panchayat_id'=>$this->request->data['VhsncUntiedfund']['panchayat'])));
		    } 
                    else {
                   $village=$this->Village->find('list',array('order'=>array('name'=>'asc')));
                    }
                   if($this->request->data['VhsncUntiedfund']['panchayat']!=0 and $this->request->data['VhsncUntiedfund']['panchayat']!='')
			{
		     $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Panchayat.id'=>$this->request->data['VhsncUntiedfund']['panchayat'])));
		    }
                    else {
                         $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc')));
                    }
                }
                $vhsnc=$this->VhsncConstitution->find('list',array('conditions'=>array('VhsncConstitution.id'=>$this->request->data['VhsncUntiedfund']['vhsnc_name'])));
		$reporting_periods=$this->ReportingPeriod->query("select * from reporting_periods");	
	       //$cities=$this->City->find('list');
                $desig=$this->Designation->find('list');
		//$blocks=$this->Block->find('list');
		$ngos=$this->Ngo->find('list');
               // $panchayat=$this->Panchayat->find('list');
               // $village=$this->Village->find('list');
                 $ward=$this->Ward->find('list');
		$this->set(compact('panchayat','cities','ngos','blocks','desig','village','reporting_periods','ward','vhsnc'));
		
	}
	
	
/**  
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
//	public function delete($id = null,$status='deactive') {
//		$this->VhsncUntiedfund->id = $id;
//		if (!$this->VhsncUntiedfund->exists()) {
//			throw new NotFoundException(__('Invalid Facility Detail'));
//		}
//		    //$this->request->onlyAllow('post', 'delete');
//		    $this->VhsncUntiedfund->read(null,$id);
//			$this->VhsncUntiedfund->set(array('status'=>$status));
//		
//		if ($this->VhsncUntiedfund->save()) {
//			$this->Session->setFlash(__('The Facility has been '.$status));
//		} else {
//			$this->Session->setFlash(__('Nothing happen. Please, try again.'));
//		}
//		return $this->redirect(array('action' => 'index'));
//	}
	public function delete($id = null) {
		$this->VhsncUntiedfund->id = $id;
		if (!$this->VhsncUntiedfund->exists()) {
			throw new NotFoundException(__('Invalid Vhsnc Untiedfund'));
		}
		//$this->request->allowMethod('post', 'delete');
		if ($this->VhsncUntiedfund->delete()) {
			$this->Session->setFlash(__('The Vhsnc Untiedfund has been deleted.'));
		} else {
			$this->Session->setFlash(__('The Vhsnc Untiedfund could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	public function getbalance() {
	    $this->layout='ajax';
            $this->autoRender = false;
            $getdate=$this->params->query['bal'];
            $v=$this->params->query['v'];
            $date= date('Y-m-d',strtotime($getdate));
          // echo $v;
           // die();
	    // $reporting_periods=$this->ReportingPeriod->query("select * from reporting_periods");
              
		$subcatlist=$this->VhsncUntiedfund->find('first',array('conditions'=>array('(VhsncUntiedfund.balance_check_date) <='=>$date,'VhsncUntiedfund.vhsnc_name'=>$v),'order'=>array('VhsncUntiedfund.id'=>'desc')));
		 $balance=$this->VhsncUntiedfundDetail->find('first',array('conditions'=>array('VhsncUntiedfundDetail.vhsnc_name'=>$v),'order'=>array('VhsncUntiedfundDetail.id'=>'desc')));
                  // print_r($balance);
                 
                if(isset($subcatlist['VhsncUntiedfund']['expenditure_amount'])!=''){
                   $data = $balance['VhsncUntiedfundDetail']['vhsnc_funds_recieved']+$balance['VhsncUntiedfundDetail']['amount_recieved_from_other_source']+$balance['VhsncUntiedfundDetail']['opening_balance']+$balance['VhsncUntiedfundDetail']['bank_interest_credit']-$balance['VhsncUntiedfundDetail']['bank_charge_deduct']-$subcatlist['VhsncUntiedfund']['current_total_amount'];
                   
                } else {
            
                    $data = $balance['VhsncUntiedfundDetail']['vhsnc_funds_recieved']+$balance['VhsncUntiedfundDetail']['amount_recieved_from_other_source']+$balance['VhsncUntiedfundDetail']['opening_balance']+$balance['VhsncUntiedfundDetail']['bank_interest_credit']-$balance['VhsncUntiedfundDetail']['bank_charge_deduct'];
          
        }
               
               
		return $data;
	}
        
        
        
        public function getcurrbalance($vhsnc) {
	  
            $date= date('Y-m-d');
         
		 $balance=$this->VhsncUntiedfundDetail->find('first',array('conditions'=>array('VhsncUntiedfundDetail.vhsnc_name'=>$vhsnc),'order'=>array('VhsncUntiedfundDetail.id'=>'desc')));
                //print_r($balance);
                 if(!empty($balance)) {
                   $data = $balance['VhsncUntiedfundDetail']['vhsnc_funds_recieved']+$balance['VhsncUntiedfundDetail']['amount_recieved_from_other_source']+$balance['VhsncUntiedfundDetail']['opening_balance']+$balance['VhsncUntiedfundDetail']['bank_interest_credit']-$balance['VhsncUntiedfundDetail']['bank_charge_deduct'];
                 
		return $data;
                 }
	}
        
        public function getprevious() {
	   $this->layout='ajax';
            $this->autoRender = false;
            $getdate=$this->params->query['bal'];
            $v=$this->params->query['v'];
            $date= date('Y-m-d',strtotime($getdate));
	    // $reporting_periods=$this->ReportingPeriod->query("select * from reporting_periods");
              
		$subcatlist=$this->VhsncUntiedfund->find('all',array('conditions'=>array('VhsncUntiedfund.vhsnc_name'=>$v,'VhsncUntiedfund.status'=>'active')));
		
                   if(isset($subcatlist)){
                    $data = count($subcatlist);
                  }
                   else {
                    $data =0;
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
                   $condition2.=' and VhsncUntiedfund.id LIKE %'.$searchKey.'% || VhsncUntiedfund.expenditure_details LIKE %'.$searchKey.'% || VhsncUntiedfund.expenditure_amount LIKE %'.$searchKey.'%';
	
	}
	
	
	
	if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(VhsncUntiedfund.balance_check_date)>="'.$fromdate.'" and date(VhsncUntiedfund.balance_check_date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(VhsncUntiedfund.balance_check_date)="'.$fromdate.'"';
				}
				else
				{
					
					}
			}
			
			
  
//		if(isset($this->request->query['organization']) and ($this->request->query['organization']!=0) and ($this->request->query['organization']!='')){$searchBuilderId=trim($this->request->query['organization']);  //$condition['Enquiry.country_id']=$searchCountryId;
//		$condition2.=' and VhsncMember.organization='.$searchBuilderId;
//		
//		}
//		
		if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBlockId=trim($this->request->query['block']); //$condition['Enquiry.builder_id']=$searchBuilderId;
		$condition2.=' and VhsncUntiedfund.block='.$searchBlockId;
		}
		
		if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchProjectId=trim($this->request->query['panchayat']); //$condition['Enquiry.project_id']=$searchProjectId;
		$condition2.=' and VhsncUntiedfund.panchayat='.$searchProjectId;
		}
               
                if(isset($this->request->query['village']) and ($this->request->query['village']!=0) and ($this->request->query['village']!='')){$searchVillageId=trim($this->request->query['village']); //$condition['Enquiry.project_id']=$searchProjectId;
		$condition2.=' and VhsncUntiedfund.village='.$searchVillageId;
		}
		
		
		
		}
		else {
		if(CakeSession::read('User.type')==='regular'){
             //echo CakeSession::read('User.subrole');
            // die();
             if(CakeSession::read('User.subrole')==='CC'){
		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'))));
                      if($r){ 
                          if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){
                           $searchProjectId=trim($this->request->query['panchayat']);
		          //  $condition['VhsncAfc.panchayat']=$searchProjectId;
                             $condition2.=' and VhsncUntiedfund.panchayat='.$searchProjectId;
		           }   else { 
                        ///$condition=['VhsncAfc.panchayat IN' =>explode(',',$r['Bpccc']['allocated_panchayat'])]; 
                         $condition2.=' and VhsncUntiedfund.panchayat IN ('.$r['Bpccc']['allocated_panchayat'].')';
                      }
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
                   $condition2.=' and VhsncUntiedfund.id LIKE %'.$searchKey.'% || VhsncUntiedfund.expenditure_details LIKE %'.$searchKey.'% || VhsncUntiedfund.expenditure_amount LIKE %'.$searchKey.'%';
	
	}
	
	
	
	if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(VhsncUntiedfund.balance_check_date)>="'.$fromdate.'" and date(VhsncUntiedfund.balance_check_date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(VhsncUntiedfund.balance_check_date)="'.$fromdate.'"';
				}
				else
				{
					
					}
			}
                      }
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Village yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
	            //$blocks=$this->Block->find('list',array('conditions'=>array('Block.id'=>$r['Bpccc']['allocated_block'])));
                    $panchayats=$this->Panchayat->find('list',array('order' => array('name' => 'asc'),'conditions'=>['Panchayat.id IN'=>explode(',',$r['Bpccc']['allocated_panchayat'])]));
                   	
		}
                
                 elseif(CakeSession::read('User.subrole')==='BPC'){
		   $r = $this->Bpc->find('first',array('conditions'=>array('Bpc.first_name='.CakeSession::read('User.id'))));
                      if($r){ 
                          if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){
                              $searchBlockId=trim($this->request->query['block']);
		        $condition2.=' and VhsncUntiedfund.block='.$searchBlockId;
		        }else {
                            
                       $condition2.=' and VhsncUntiedfund.block IN ('.$r['Bpc']['allocated_block'].')';
                       
                      }
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
                   $condition2.=' and VhsncUntiedfund.id LIKE %'.$searchKey.'% || VhsncUntiedfund.expenditure_details LIKE %'.$searchKey.'% || VhsncUntiedfund.expenditure_amount LIKE %'.$searchKey.'%';
	
	}
	
	
	
	if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(VhsncUntiedfund.balance_check_date)>="'.$fromdate.'" and date(VhsncUntiedfund.balance_check_date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(VhsncUntiedfund.balance_check_date)="'.$fromdate.'"';
				}
				else
				{
					
					}
			}
                      }
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Block yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
		     //$blocks=$this->Block->find('list',array('order' => array('name' => 'asc'),'conditions'=>array('Block.id IN'=>explode(',',$r['Bpc']['allocated_block']))));
                   //$villages=$this->Village->find('list');
                   //$panchayats=$this->Panchayat->find('list');
                    //$condition2['OR']=array('Ngo.allocated_block_one'=>explode(',',$r['Bpc']['allocated_block']),'Ngo.allocated_block_two'=>explode(',',$r['Bpc']['allocated_block'])); 
                    //$ngos=$this->Ngo->find('list',array('conditions'=>$condition2));
                    
		}
                
                
                 else {
		   $r = $this->Dpo->find('first',array('conditions'=>array('Dpo.first_name='.CakeSession::read('User.id'))));
                      if($r){ 
                          
                          if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){
                              $searchBlockId=trim($this->request->query['block']);
                               $condition2.=' and VhsncUntiedfund.block='.$searchBlockId;
		        // $condition['VhsncAfc.block']=$searchBlockId;
		        }else {
                       //$condition='VhsncAfc.district='.$r['Dpo']['district'];
                        $condition2.=' and VhsncUntiedfund.district IN ('.$r['Dpo']['district'].')';
                        }
                        if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
                   $condition2.=' and VhsncUntiedfund.id LIKE %'.$searchKey.'% || VhsncUntiedfund.expenditure_details LIKE %'.$searchKey.'% || VhsncUntiedfund.expenditure_amount LIKE %'.$searchKey.'%';
	
	}
	
	
	
	if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(VhsncUntiedfund.balance_check_date)>="'.$fromdate.'" and date(VhsncUntiedfund.balance_check_date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(VhsncUntiedfund.balance_check_date)="'.$fromdate.'"';
				}
				else
				{
					
					}
			}
                      } 
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Village yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
			//$blocks=$this->Block->find('list',array('order' => array('name' => 'asc'),'conditions'=>array('Block.city_id IN'=>explode(',',$r['Dpo']['district']))));
                     //$ngos=$this->Ngo->find('list',array('conditions'=>array('Ngo.allocated_district IN'=>explode(',',$r['Dpo']['district']))));
                     
		}
         }
		else {
		
		}
		}
		//$condition['NOT']=array('Enquiry.status'=>"trash");
		$condition2.=' and VhsncUntiedfund.status="active"';
		$this->response->download("VhsncUntiedfund.csv");
		//print_r($condition); exit;
	    $data=$this->VhsncUntiedfund->query('select VhsncUntiedfund.id,VhsncUntiedfund.vhsnc_name,VhsncUntiedfund.total_expenditure,City.name,Block.name,Panchayat.name,Village.name,Ward.name,VhsncUntiedfund.balance_check_date,VhsncUntiedfund.balance_on_date,VhsncUntiedfund.current_total_amount,VhsncUntiedfund.expenditure_date,VhsncUntiedfund.expenditure_details,VhsncUntiedfund.expenditure_amount,VhsncUntiedfund.status from vhsnc_untiedfunds as VhsncUntiedfund left join cities as City  on VhsncUntiedfund.district=City.id left join blocks as Block  on VhsncUntiedfund.block=Block.id  left join panchayats as Panchayat on VhsncUntiedfund.panchayat=Panchayat.id left join villages as Village on VhsncUntiedfund.village=Village.id left join wards as Ward on VhsncUntiedfund.ward=Ward.id where 1 '.$condition2 );
		
		
		//$data = $this->Geographical->find('all', array('conditions'=>$condition2));
		
		//$log = $this->Enquiry->getDataSource()->getLog(false, false);
        //debug($log);
		//exit;
		
            $headers = array('VhsncUntiedfundDetail'=>array( 'Id' => 'Id','District' => 'District', 'Block' => 'Block','Panchayat' => 'Panchayat','VHSNC Name'=>'VHSNC Name','Total Expenditure Previous'=>'Total Expenditure Previous','Balance as on Date'=>'Balance as on Date','Balance Amount as on Date'=>'Balance Amount as on Date','Expenditure Date'=>'Expenditure Date','Expenditure Details'=>'Expenditure Details','Expenditure Amount'=>'Expenditure Amount','Status'=>'Status')); 
	    $this->set(compact('data','headers'));
		$this->layout = 'ajax';
		return;
		
		}
  ////  reports section ---///// 
	
	}
	
	
	
	
