<?php
App::uses('AppController', 'Controller');
/**
 * FacilityDetails Controller
 *
 * @property Ngo $GeographicalNgo
 * @property PaginatorComponent $Paginator
 */
class VhsncUntiedfundDetailsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Upload');

    var  $uses = array('VhsncUntiedfundDetail','VhsncConstitution','Ngo','User','Project','Village','Panchayat','Ward','Country','City','Block','Designation','ReportingPeriod','Bpccc','Bpc','Dpo');
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
    $condition['OR']=array('VhsncUntiedfundDetail.id LIKE'=>'%'.$searchKey.'%','VhsncUntiedfundDetail.bank_account_number LIKE'=>'%'.$searchKey.'%','VhsncUntiedfundDetail.ifsc LIKE'=>'%'.$searchKey.'%','VhsncUntiedfundDetail.vhsnc_funds_recieved LIKE '=>'%'.$searchKey.'%'); 
	
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
//		
                if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBuilderId=trim($this->request->query['block']); 
		$condition['VhsncUntiedfundDetail.block']=$searchBuilderId;
		}
		if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchPanchayatId=trim($this->request->query['panchayat']); 
		$condition['VhsncUntiedfundDetail.panchayat']=$searchPanchayatId;
		}
		
		if(isset($this->request->query['village']) and ($this->request->query['village']!=0) and ($this->request->query['village']!='')){$searchProjectId=trim($this->request->query['village']);
		$condition['VhsncUntiedfundDetail.village']=$searchProjectId;
		}		
	}
		 if(CakeSession::read('User.type')==='regular'){
             //echo CakeSession::read('User.subrole');
            // die();
             if(CakeSession::read('User.subrole')==='CC'){
		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'))));
                      if($r){ 
                          if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchPanchayatId=trim($this->request->query['panchayat']); 
		           $condition['VhsncUntiedfundDetail.panchayat']=$searchPanchayatId;
		            }
                            else {
                      // $condition='VhsncMember.panchayat='.$r['Bpccc']['allocated_panchayat'];
                       $condition=['VhsncUntiedfundDetail.panchayat IN' =>explode(',',$r['Bpccc']['allocated_panchayat'])];
                            }
                            if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
   $condition['OR']=array('VhsncUntiedfundDetail.id LIKE'=>'%'.$searchKey.'%','VhsncUntiedfundDetail.bank_account_number LIKE'=>'%'.$searchKey.'%','VhsncUntiedfundDetail.ifsc LIKE'=>'%'.$searchKey.'%','VhsncUntiedfundDetail.vhsnc_funds_recieved LIKE '=>'%'.$searchKey.'%'); 
	
	}
                       
                            } 
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Village yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
                       $panchayats=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Panchayat.id IN'=>explode(',',$r['Bpccc']['allocated_panchayat']))));
                    
			//$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
				
		}
                
                 elseif(CakeSession::read('User.subrole')==='BPC'){
		   $r = $this->Bpc->find('first',array('conditions'=>array('Bpc.first_name='.CakeSession::read('User.id'))));
                      if($r){ 
                          
                           if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBuilderId=trim($this->request->query['block']); 
		           $condition['VhsncUntiedfundDetail.block']=$searchBuilderId;
		              }
                              else {
                      // $condition='VhsncMember.block='.$r['Bpc']['allocated_block'];
                       $condition=['VhsncUntiedfundDetail.block IN' =>explode(',',$r['Bpc']['allocated_block'])];
                              }
                              if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('VhsncUntiedfundDetail.id LIKE'=>'%'.$searchKey.'%','VhsncUntiedfundDetail.bank_account_number LIKE'=>'%'.$searchKey.'%','VhsncUntiedfundDetail.ifsc LIKE'=>'%'.$searchKey.'%','VhsncUntiedfundDetail.vhsnc_funds_recieved LIKE '=>'%'.$searchKey.'%'); 
	
	}
                       
                              } 
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Village yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
                       $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id IN'=>explode(',',$r['Bpc']['allocated_block']))));
                    
			
		}
                
                
                 else {
		   $r = $this->Dpo->find('first',array('conditions'=>array('Dpo.first_name='.CakeSession::read('User.id'))));
                      if($r){ 
                          if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBuilderId=trim($this->request->query['block']); 
		           $condition['VhsncUntiedfundDetail.block']=$searchBuilderId;
		              } else {
                       $condition='VhsncUntiedfundDetail.district='.$r['Dpo']['district'];
                              } 
                       if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('VhsncUntiedfundDetail.id LIKE'=>'%'.$searchKey.'%','VhsncUntiedfundDetail.bank_account_number LIKE'=>'%'.$searchKey.'%','VhsncUntiedfundDetail.ifsc LIKE'=>'%'.$searchKey.'%','VhsncUntiedfundDetail.vhsnc_funds_recieved LIKE '=>'%'.$searchKey.'%'); 
	
	}
                      } 
                      
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Village yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
			//$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
			 $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.City_id'=>$r['Dpo']['district'])));
                         $panchayats=$this->Panchayat->find('list',array('order'=>array('name'=>'asc')));
                          $villages=$this->Village->find('list',array('order'=>array('name'=>'asc')));	
		}
         }else if(CakeSession::read('User.type')==='user'){
	   $r = $this->Ngo->find('first',array('conditions'=>array('Ngo.chief_functionary_name='.CakeSession::read('User.id'))));
                 if($r){
                     $blo=array();
                   $blo= [$r['Ngo']['allocated_block_one'],$r['Ngo']['allocated_block_two']];
                     if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){
                              $searchBlockId=trim($this->request->query['block']);
		         $condition['VhsncUntiedfundDetail.block']=$searchBlockId;
		        }else {
                            
                       $condition=['VhsncUntiedfundDetail.block IN' =>$blo];
                       
                      }
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
   $condition['OR']=array('VhsncUntiedfundDetail.id LIKE'=>'%'.$searchKey.'%','VhsncUntiedfundDetail.bank_account_number LIKE'=>'%'.$searchKey.'%','VhsncUntiedfundDetail.ifsc LIKE'=>'%'.$searchKey.'%','VhsncUntiedfundDetail.vhsnc_funds_recieved LIKE '=>'%'.$searchKey.'%'); 
	
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
		$this->Paginator->settings = array('VhsncUntiedfundDetail' => array('limit' =>20,'order' => array('id' => 'desc'),'conditions'=>array($condition,'VhsncUntiedfundDetail.status'=>'active')));
		$this->VhsncUntiedfundDetail->recursive = 0;
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
		if (!$this->VhsncUntiedfundDetail->exists($id)) {
			throw new NotFoundException(__('Invalid Untiedfund'));
		}
		$options = array('conditions' => array('VhsncUntiedfundDetail.' . $this->VhsncUntiedfundDetail->primaryKey => $id));
		$this->set('untiedfund', $this->VhsncUntiedfundDetail->find('first', $options));
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
			$this->VhsncUntiedfundDetail->create();
                      // print_r($this->request->data);
                       //die();
                        $data=$this->request->data;
                          //$organization =  $this->request->data['VhsncUntiedfund']['organization'];
                          ///for($i=0;$i<count($this->request->data['VhsncUntiedfund']['expenditure_date']);$i++){
                              
                           
//                          $district =  $this->request->data['VhsncUntiedfund']['district'];
//                          $block =  $this->request->data['VhsncUntiedfund']['block'];
//                          $panchayat =  $this->request->data['VhsncUntiedfund']['panchayat'];
//                          $village =  $this->request->data['VhsncUntiedfund']['village'];
//                          $ward =  $this->request->data['VhsncUntiedfund']['ward'];
//                          $bank_account_number=  $this->request->data['VhsncUntiedfund']['bank_account_number'];
//                          $financial_year =  $this->request->data['VhsncUntiedfund']['financial_year'];
//                          $vhsnc_funds_recieved=  $this->request->data['VhsncUntiedfund']['vhsnc_funds_recieved'];
//                          $amount_recieved_from_other_source =  $this->request->data['VhsncUntiedfund']['amount_recieved_from_other_source'];
//                          $amount_received_from =  $this->request->data['VhsncUntiedfund']['amount_received_from'];
//                          $payment_mode =  $this->request->data['VhsncUntiedfund']['payment_mode'];
//                          $payment_received_date =  $this->request->data['VhsncUntiedfund']['payment_received_date'];
//                          $bank_interest_credit =  $this->request->data['VhsncUntiedfund']['bank_interest_credit'];
//                          $bank_charge_deduct =  $this->request->data['VhsncUntiedfund']['bank_charge_deduct'];
//                          $total_expenditure =  $this->request->data['VhsncUntiedfund']['total_expenditure'];
//                          $balance_check_date =  date('Y-m-d',strtotime($this->request->data['VhsncUntiedfund']['balance_check_date']));
//                          
//                          if($this->request->data['VhsncUntiedfund']['balance_on_date']==0){
//                              $balance_on_date =  $this->request->data['VhsncUntiedfund']['vhsnc_funds_recieved']+$this->request->data['VhsncUntiedfund']['amount_recieved_from_other_source']-$this->request->data['VhsncUntiedfund']['current_total_amount'];  
//                          }
//                          else {
//                              $balance_on_date =  $this->request->data['VhsncUntiedfund']['balance_on_date']-$this->request->data['VhsncUntiedfund']['current_total_amount'];
//                          }
//                          
//                          $current_total_amount =  $this->request->data['VhsncUntiedfund']['current_total_amount'];
//                          $expenditure_date =  date('Y-m-d',strtotime($this->request->data['VhsncUntiedfund']['expenditure_date'][$i]));
//                          $expenditure_details =  $this->request->data['VhsncUntiedfund']['expenditure_details'][$i];
//                          $expenditure_amount =  $this->request->data['VhsncUntiedfund']['expenditure_amount'][$i];
//                          
//                            
//                $data= array (
//                            
//                             'district' => $district,
//                             'block' => $block ,
//                             'panchayat' => $panchayat,
//                             'village' => $village ,
//                             'ward' => $ward ,
//                             'bank_account_number' => $bank_account_number ,
//                             'vhsnc_funds_recieved' => $vhsnc_funds_recieved ,
//                             'amount_recieved_from_other_source' => $amount_recieved_from_other_source ,
//                             'amount_received_from' => $amount_received_from ,
//                             'payment_mode' => $payment_mode ,
//                             'payment_received_date' => $payment_received_date ,
//                             'bank_interest_credit'=> $bank_interest_credit ,
//                             'bank_charge_deduct' => $bank_charge_deduct ,
//                             'financial_year' => $financial_year ,
//                             'total_expenditure' => $total_expenditure ,
//                             'balance_check_date' => $balance_check_date ,
//                             'balance_on_date' => $balance_on_date ,
//                             'current_total_amount' => $current_total_amount,
//                             'expenditure_date' => $expenditure_date ,
//                             'expenditure_details' => $expenditure_details ,
//                             'expenditure_amount' => $expenditure_amount 
//                      ) ;  
                          $save=$this->VhsncUntiedfundDetail->saveAll($data);
                         // }
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
                         
	            $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Dpo']['district'])));
                   $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.City_id'=>$r['Dpo']['district'])));
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
		//$panchayat=$this->Panchayat->find('list');
                // $village=$this->Village->find('list'); 
                $reporting_periods=$this->ReportingPeriod->query("select * from reporting_periods");
                $desig=$this->Designation->find('list');
		$ngos=$this->Ngo->find('list'); 
                $vhsnc=$this->VhsncConstitution->find('list');
                $ward=$this->Ward->find('list');
		$this->set(compact('panchayat','cities','ngos','blocks','desig','village','reporting_periods','ward','vhsnc'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->VhsncUntiedfundDetail->exists($id)) {
			throw new NotFoundException(__('Invalid Untiedfund'));
		}
		if ($this->request->is(array('post', 'put'))) {
                        $data=$this->request->data;
                     //print_r($this->request->data);
                      //  die();
//                        $district =  $this->request->data['VhsncUntiedfund']['district'];
//                          $block =  $this->request->data['VhsncUntiedfund']['block'];
//                          $panchayat =  $this->request->data['VhsncUntiedfund']['panchayat'];
//                          $village =  $this->request->data['VhsncUntiedfund']['village'];
//                          $ward =  $this->request->data['VhsncUntiedfund']['ward'];
//                          $bank_account_number=  $this->request->data['VhsncUntiedfund']['bank_account_number'];
//                          $financial_year =  $this->request->data['VhsncUntiedfund']['financial_year'];
//                          $vhsnc_funds_recieved=  $this->request->data['VhsncUntiedfund']['vhsnc_funds_recieved'];
//                          $amount_recieved_from_other_source =  $this->request->data['VhsncUntiedfund']['amount_recieved_from_other_source'];
//                          $amount_received_from =  $this->request->data['VhsncUntiedfund']['amount_received_from'];
//                          $payment_mode =  $this->request->data['VhsncUntiedfund']['payment_mode'];
//                          $payment_received_date =  $this->request->data['VhsncUntiedfund']['payment_received_date'];
//                          $bank_interest_credit =  $this->request->data['VhsncUntiedfund']['bank_interest_credit'];
//                          $bank_charge_deduct =  $this->request->data['VhsncUntiedfund']['bank_charge_deduct'];
//                          $total_expenditure =  $this->request->data['VhsncUntiedfund']['total_expenditure'];
//                          $balance_check_date =  date('Y-m-d',strtotime($this->request->data['VhsncUntiedfund']['balance_check_date']));
//                          $balance_on_date =  $this->request->data['VhsncUntiedfund']['balance_on_date'];
//                          $current_total_amount =  $this->request->data['VhsncUntiedfund']['current_total_amount'];
//                          $expenditure_date =  date('Y-m-d',strtotime($this->request->data['VhsncUntiedfund']['expenditure_date']));
//                          $expenditure_details =  $this->request->data['VhsncUntiedfund']['expenditure_details'];
//                          $expenditure_amount =  $this->request->data['VhsncUntiedfund']['expenditure_amount'];
//                          
//                            
//                $data= array (
//                            
//                             'district' => $district,
//                             'block' => $block ,
//                             'panchayat' => $panchayat,
//                             'village' => $village ,
//                             'ward' => $ward ,
//                             'bank_account_number' => $bank_account_number ,
//                             'vhsnc_funds_recieved' => $vhsnc_funds_recieved ,
//                             'amount_recieved_from_other_source' => $amount_recieved_from_other_source ,
//                             'amount_received_from' => $amount_received_from ,
//                             'payment_mode' => $payment_mode ,
//                             'payment_received_date' => $payment_received_date ,
//                             'bank_interest_credit'=> $bank_interest_credit ,
//                             'bank_charge_deduct' => $bank_charge_deduct ,
//                             'financial_year' => $financial_year ,
//                             'total_expenditure' => $total_expenditure ,
//                             'balance_check_date' => $balance_check_date ,
//                             'balance_on_date' => $balance_on_date ,
//                             'current_total_amount' => $current_total_amount,
//                             'expenditure_date' => $expenditure_date ,
//                             'expenditure_details' => $expenditure_details ,
//                             'expenditure_amount' => $expenditure_amount ,
//                              'id'=>$id
//                      ) ; 
			if ($this->VhsncUntiedfundDetail->save($data)) {
				$this->Session->setFlash(__('The VHSNC  Untiedfund Detail has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The VHSNC Untiedfund Detail could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('VhsncUntiedfundDetail.' . $this->VhsncUntiedfundDetail->primaryKey => $id));
			$this->request->data = $this->VhsncUntiedfundDetail->find('first', $options);
                	}
                        
                  if(CakeSession::read('User.type')==='regular'){
                     
                     if(CakeSession::read('User.subrole')==='CC'){
		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'))));
                       
                       
	            $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Bpccc']['allocated_district'])));
                    $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id'=>$r['Bpccc']['allocated_block'])));
                    $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Panchayat.id IN'=>explode(',',$r['Bpccc']['allocated_panchayat']))));
                     if($this->request->data['VhsncUntiedfundDetail']['panchayat']!=0 and $this->request->data['VhsncUntiedfundDetail']['panchayat']!='')
			{
		     $village=$this->Village->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Village.panchayat_id'=>$this->request->data['VhsncUntiedfundDetail']['panchayat'])));
		    } 
                    else {
                        $village=$this->Village->find('list',array('order'=>array('name'=>'asc','conditions'=>array('Village.panchayat_id'=>$r['Bpccc']['allocated_panchayat'])))); 
                    }
                  
				
		}
                
                 elseif(CakeSession::read('User.subrole')==='BPC'){
		  $r = $this->Bpc->find('first',array('conditions'=>array('Bpc.first_name='.CakeSession::read('User.id'))));
                         
	            $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Bpc']['allocated_district'])));
                    $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id IN'=>explode(',',$r['Bpc']['allocated_block']))));
                    if($this->request->data['VhsncUntiedfundDetail']['panchayat']!=0 and $this->request->data['VhsncUntiedfundDetail']['panchayat']!='')
			{
		     $village=$this->Village->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Village.panchayat_id'=>$this->request->data['VhsncUntiedfundDetail']['panchayat'])));
		    } 
                    else {
                        $village=$this->Village->find('list',array('order'=>array('name'=>'asc','conditions'=>array('Village.block_id'=>$r['Bpc']['allocated_block'])))); 
                    }
                   if($this->request->data['VhsncUntiedfundDetail']['panchayat']!=0 and $this->request->data['VhsncUntiedfundDetail']['panchayat']!='')
			{
		     $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Panchayat.id'=>$this->request->data['VhsncUntiedfundDetail']['panchayat'])));
		    }
                    else{
                       $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Panchayat.block_id'=>$r['Bpc']['allocated_block'])));  
                    }
                  
                   // $village=$this->Village->find('list');
		}
                
                
                 else {
		  $r = $this->Dpo->find('first',array('conditions'=>array('Dpo.first_name='.CakeSession::read('User.id'))));
                         
	            $cities=$this->City->find('list',array('conditions'=>array('City.id'=>$r['Dpo']['district'])));
                  if($this->request->data['VhsncUntiedfundDetail']['block']!=0 and $this->request->data['VhsncUntiedfundDetail']['block']!='')
			{
		     $blocks=$this->Block->find('list',array('conditions'=>array('Block.id'=>$this->request->data['VhsncUntiedfundDetail']['block'])));
		    } 
                    else {
                        $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.City_id'=>$r['Dpo']['district'])));
                  
                    }
                    
                    
                    if($this->request->data['VhsncUntiedfundDetail']['panchayat']!=0 and $this->request->data['VhsncUntiedfundDetail']['panchayat']!='')
			{
		     $village=$this->Village->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Village.panchayat_id'=>$this->request->data['VhsncUntiedfundDetail']['panchayat'])));
		    } 
                    else {
                        $village=$this->Village->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Village.city_id'=>$r['Dpo']['district']))); 
                    }
                   if($this->request->data['VhsncUntiedfundDetail']['panchayat']!=0 and $this->request->data['VhsncUntiedfundDetail']['panchayat']!='')
			{
		     $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Panchayat.id'=>$this->request->data['VhsncUntiedfundDetail']['panchayat'])));
		    }
                    else{
                       $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Panchayat.city_id'=>$r['Dpo']['district'])));  
                    }
		}
		   }
                else {
                    $cities=$this->City->find('list');
                    if($this->request->data['VhsncUntiedfundDetail']['block']!=0 and $this->request->data['VhsncUntiedfundDetail']['block']!='')
			{
		     $blocks=$this->Block->find('list',array('conditions'=>array('Block.id'=>$this->request->data['VhsncUntiedfundDetail']['block'])));
		    } 
                    else {
                        $blocks=$this->Block->find('list');
                    }
                    
                    
                    if($this->request->data['VhsncUntiedfundDetail']['panchayat']!=0 and $this->request->data['VhsncUntiedfundDetail']['panchayat']!='')
			{
		     $village=$this->Village->find('list',array('conditions'=>array('Village.panchayat_id'=>$this->request->data['VhsncUntiedfundDetail']['panchayat'])));
		    } 
                    else {
                        $village=$this->Village->find('list'); 
                    }
                   if($this->request->data['VhsncUntiedfundDetail']['panchayat']!=0 and $this->request->data['VhsncUntiedfundDetail']['panchayat']!='')
			{
		     $panchayat=$this->Panchayat->find('list',array('conditions'=>array('Panchayat.id'=>$this->request->data['VhsncUntiedfundDetail']['panchayat'])));
		    }
                    else{
                       $panchayat=$this->Panchayat->find('list');  
                    }
                }
		$reporting_periods=$this->ReportingPeriod->query("select * from reporting_periods");	
	       //$cities=$this->City->find('list');
                $desig=$this->Designation->find('list');
		//$blocks=$this->Block->find('list');
		$ngos=$this->Ngo->find('list');
               // $panchayat=$this->Panchayat->find('list');
                //$village=$this->Village->find('list');
                 $ward=$this->Ward->find('list');
                $vhsnc=$this->VhsncConstitution->find('list');
		$this->set(compact('panchayat','cities','ngos','blocks','desig','village','reporting_periods','ward','vhsnc'));
		
	}
	
	
/**  
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null,$status='deactive') {
		$this->VhsncUntiedfundDetail->id = $id;
		if (!$this->VhsncUntiedfundDetail->exists()) {
			throw new NotFoundException(__('Invalid Facility Detail'));
		}
		    //$this->request->onlyAllow('post', 'delete');
		    $this->VhsncUntiedfundDetail->read(null,$id);
			$this->VhsncUntiedfundDetail->set(array('status'=>$status));
		
		if ($this->VhsncUntiedfundDetail->save()) {
			$this->Session->setFlash(__('The Facility has been '.$status));
		} else {
			$this->Session->setFlash(__('Nothing happen. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	public function getbalance($getdate) {
	    $this->layout='ajax';
        $this->autoRender = false;
             $date= date('Y-m-d',strtotime($getdate));
	    // $reporting_periods=$this->ReportingPeriod->query("select * from reporting_periods");
              
		$subcatlist=$this->VhsncUntiedfundDetail->find('first',array('conditions'=>array('(VhsncUntiedfund.balance_check_date) <='=>$date),'order'=>array('VhsncUntiedfund.id'=>'desc')));
		
                if(isset($subcatlist['VhsncUntiedfund']['balance_on_date'])!=''){
                    $data = $subcatlist['VhsncUntiedfund']['balance_on_date'];
                }
        else {
                    $data =0;
        }
               
               
		return $data;
	}
        
        public function getprevious($getdate) {
	    $this->layout='ajax';
        $this->autoRender = false;
             $date= date('Y-m-d',strtotime($getdate));
	    // $reporting_periods=$this->ReportingPeriod->query("select * from reporting_periods");
              
		$subcatlist=$this->VhsncUntiedfundDetail->find('all');
		
                   if(isset($subcatlist)){
                    $data = count($subcatlist);
                  }
                   else {
                    $data =0;
                     }
               
               
		return $data;
	              }
        
	 public function getvhsnc($stateid) {
	    $this->layout='ajax';
        $this->autoRender = false;
//	       $data='<option value="">Select VHSNC</option>';
//		   $subcatlist=$this->VhsncUntiedfundDetail->find('list',array("conditions"=>array('panchayat'=>$stateid)));
//                  foreach($subcatlist as $key=>$value){ $data.='<option value="'.$key.'">'.$value.'</option>';}
                  $subcatlist=$this->VhsncUntiedfundDetail->find('first',array("conditions"=>array('panchayat'=>$stateid)));
                  $data = $subcatlist['VhsncUntiedfundDetail']['vhsnc_name'];
		return $data;
		
	}
         public function getvvhsnc($stateid) {
	    $this->layout='ajax';
        $this->autoRender = false;
//	       $data='<option value="">Select VHSNC</option>';
//		   $subcatlist=$this->VhsncUntiedfundDetail->find('list',array("conditions"=>array('panchayat'=>$stateid)));
//                  foreach($subcatlist as $key=>$value){ $data.='<option value="'.$key.'">'.$value.'</option>';}
                  $subcatlist=$this->VhsncUntiedfundDetail->find('first',array("conditions"=>array('village'=>$stateid)));
                  $data = $subcatlist['VhsncUntiedfundDetail']['vhsnc_name'];
		return $data;
		
	}
        public function getwvhsnc($stateid) {
	    $this->layout='ajax';
        $this->autoRender = false;
//	       $data='<option value="">Select VHSNC</option>';
//		   $subcatlist=$this->VhsncUntiedfundDetail->find('list',array("conditions"=>array('panchayat'=>$stateid)));
//                  foreach($subcatlist as $key=>$value){ $data.='<option value="'.$key.'">'.$value.'</option>';}
                  $subcatlist=$this->VhsncUntiedfundDetail->find('first',array("conditions"=>array('ward'=>$stateid)));
                  $data = $subcatlist['VhsncUntiedfundDetail']['vhsnc_name'];
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
                  $condition2.=' and VhsncUntiedfundDetail.id LIKE %'.$searchKey.'% || VhsncUntiedfundDetail.bank_account_number LIKE %'.$searchKey.'% VhsncUntiedfundDetail.ifsc LIKE %'.$searchKey.'% || VhsncUntiedfundDetail.vhsnc_funds_recieved LIKE %'.$searchKey.'%';
	
	           }
	
	
		if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBlockId=trim($this->request->query['block']); //$condition['Enquiry.builder_id']=$searchBuilderId;
		$condition2.=' and VhsncUntiedfundDetail.block='.$searchBlockId;
		}
		
		if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchProjectId=trim($this->request->query['panchayat']); //$condition['Enquiry.project_id']=$searchProjectId;
		$condition2.=' and VhsncUntiedfundDetail.panchayat='.$searchProjectId;
		}
               
                if(isset($this->request->query['village']) and ($this->request->query['village']!=0) and ($this->request->query['village']!='')){$searchVillageId=trim($this->request->query['village']); //$condition['Enquiry.project_id']=$searchProjectId;
		$condition2.=' and VhsncUntiedfundDetail.village='.$searchVillageId;
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
                             $condition2.=' and VhsncUntiedfundDetail.panchayat='.$searchProjectId;
		           }   else { 
                        ///$condition=['VhsncAfc.panchayat IN' =>explode(',',$r['Bpccc']['allocated_panchayat'])]; 
                         $condition2.=' and VhsncUntiedfundDetail.panchayat IN ('.$r['Bpccc']['allocated_panchayat'].')';
                      }
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
                   $condition2.=' and VhsncUntiedfundDetail.id LIKE %'.$searchKey.'% || VhsncUntiedfundDetail.bank_account_number LIKE %'.$searchKey.'% VhsncUntiedfundDetail.ifsc LIKE %'.$searchKey.'% || VhsncUntiedfundDetail.vhsnc_funds_recieved LIKE %'.$searchKey.'%';
	
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
		        $condition2.=' and VhsncUntiedfundDetail.block='.$searchBlockId;
		        }else {
                            
                       $condition2.=' and VhsncUntiedfundDetail.block IN ('.$r['Bpc']['allocated_block'].')';
                       
                      }
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
                        $condition2.=' and VhsncUntiedfundDetail.id LIKE %'.$searchKey.'% || VhsncUntiedfundDetail.bank_account_number LIKE %'.$searchKey.'% VhsncUntiedfundDetail.ifsc LIKE %'.$searchKey.'% || VhsncUntiedfundDetail.vhsnc_funds_recieved LIKE %'.$searchKey.'%';
	
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
                               $condition2.=' and VhsncUntiedfundDetail.block='.$searchBlockId;
		        // $condition['VhsncAfc.block']=$searchBlockId;
		        }else {
                       //$condition='VhsncAfc.district='.$r['Dpo']['district'];
                        $condition2.=' and VhsncUntiedfundDetail.district IN ('.$r['Dpo']['district'].')';
                        }
                        if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
                        $condition2.=' and VhsncUntiedfundDetail.id LIKE %'.$searchKey.'% || VhsncUntiedfundDetail.bank_account_number LIKE %'.$searchKey.'% VhsncUntiedfundDetail.ifsc LIKE %'.$searchKey.'% || VhsncUntiedfundDetail.vhsnc_funds_recieved LIKE %'.$searchKey.'%';
	
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
		$condition2.=' and VhsncUntiedfundDetail.status="active"';
		$this->response->download("VhsncUntiedfundDetail.csv");
		//print_r($condition); exit;
	    $data=$this->VhsncUntiedfundDetail->query('select VhsncUntiedfundDetail.id,VhsncConstitution.vhsnc_name,VhsncUntiedfundDetail.bank_account_number,City.name,Block.name,VhsncUntiedfundDetail.ifsc,Panchayat.name,VhsncUntiedfundDetail.opening_balance,VhsncUntiedfundDetail.vhsnc_funds_recieved,VhsncUntiedfundDetail.amount_recieved_from_other_source,VhsncUntiedfundDetail.amount_received_from,VhsncUntiedfundDetail.payment_mode,VhsncUntiedfundDetail.payment_received_date,VhsncUntiedfundDetail.bank_interest_credit,VhsncUntiedfundDetail.bank_charge_deduct,Period.from_date,Period.to_date,VhsncUntiedfundDetail.create_date,VhsncUntiedfundDetail.status from vhsnc_untiedfund_details as VhsncUntiedfundDetail left join cities as City  on VhsncUntiedfundDetail.district=City.id left join blocks as Block  on VhsncUntiedfundDetail.block=Block.id left join vhsnc_constitutions as VhsncConstitution  on VhsncUntiedfundDetail.vhsnc_name=VhsncConstitution.id left join panchayats as Panchayat on VhsncUntiedfundDetail.panchayat=Panchayat.id left join periods as Period on VhsncUntiedfundDetail.financial_year=Period.id where 1 '.$condition2 );
		
		
		//$data = $this->Geographical->find('all', array('conditions'=>$condition2));
		
		//$log = $this->Enquiry->getDataSource()->getLog(false, false);
        //debug($log);
		//exit;
		
            $headers = array('VhsncUntiedfundDetail'=>array( 'Id' => 'Id','District' => 'District', 'Block' => 'Block','Panchayat' => 'Panchayat','VHSNC Name'=>'VHSNC Name','Bank Account Number'=>'Bank Account Number','IFS CODE'=>'IFS CODE','Opening Balance'=>'Opening Balance','Financial Years'=>'Financial Years','VHSNC Funds Recieved'=>'VHSNC Funds Recieved','Amount Recieved From Other Source'=>'Amount Recieved From Other Source','Amount Received From'=>'Amount Received From','Payment Mode'=>'Payment Mode','Payment Received Date'=>'Payment Received Date','Interest Credited by Bank'=>'Interest Credited by Bank','Charge Deducted by Bank'=>'Charge Deducted by Bank','Date'=>'Date','Status'=>'Status')); 
	    $this->set(compact('data','headers'));
		$this->layout = 'ajax';
		return;
		
		}
  ////  reports section ---///// 
	
	}
	
	
	
	
