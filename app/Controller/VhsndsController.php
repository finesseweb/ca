<?php
App::uses('AppController', 'Controller');
/**
 * FacilityDetails Controller
 *
 * @property Ngo $GeographicalNgo
 * @property PaginatorComponent $Paginator
 */
class VhsndsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Upload');

    var  $uses = array('Vhsnd','Geographical','Ngo','User','Project','Village','Panchayat','Ward','Country','City','Block','Designation','ReportingPeriod','Bpccc','ReasonCategory','Reason','Bpc','Dpo');
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
    $condition['OR']=array('Vhsnd.id LIKE'=>'%'.$searchKey.'%','Vhsnd.it_availability LIKE'=>'%'.$searchKey.'%','Vhsnd.height_availability LIKE'=>'%'.$searchKey.'%','Vhsnd.hb_availability LIKE '=>'%'.$searchKey.'%','Vhsnd.weight_availability LIKE '=>'%'.$searchKey.'%','Vhsnd.calcium_availability LIKE '=>'%'.$searchKey.'%','Vhsnd.abdomen_availability LIKE '=>'%'.$searchKey.'%'); 
	
	}
//		
		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition['AND']=array('date(Vhsnd.visit_date) >='=>$fromdate,'date(Vhsnd.visit_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['Vhsnd.visit_date']=$fromdate;	
				}
				
			}
		
           if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBuilderId=trim($this->request->query['block']); 
		$condition['Vhsnd.block']=$searchBuilderId;
		}
		if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchPanchayatId=trim($this->request->query['panchayat']); 
		$condition['Vhsnd.panchayat']=$searchPanchayatId;
		}
		
		if(isset($this->request->query['village']) and ($this->request->query['village']!=0) and ($this->request->query['village']!='')){$searchProjectId=trim($this->request->query['village']);
		$condition['Vhsnd.village']=$searchProjectId;
		}		
	}
       if(CakeSession::read('User.type')==='regular'){
             //echo CakeSession::read('User.subrole');
            // die();
             if(CakeSession::read('User.subrole')==='CC'){
		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'))));
                      if($r){ 
                          if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchPanchayatId=trim($this->request->query['panchayat']); 
		$condition['Vhsnd.panchayat']=$searchPanchayatId;
		} else {
                       //$condition='Vhsnd.panchayat='.$r['Bpccc']['allocated_panchayat'];
                        $condition=['Vhsnd.panchayat IN' =>explode(',',$r['Bpccc']['allocated_panchayat'])];
                }
                if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('Vhsnd.id LIKE'=>'%'.$searchKey.'%','Vhsnd.it_availability LIKE'=>'%'.$searchKey.'%','Vhsnd.height_availability LIKE'=>'%'.$searchKey.'%','Vhsnd.hb_availability LIKE '=>'%'.$searchKey.'%','Vhsnd.weight_availability LIKE '=>'%'.$searchKey.'%','Vhsnd.calcium_availability LIKE '=>'%'.$searchKey.'%','Vhsnd.abdomen_availability LIKE '=>'%'.$searchKey.'%'); 
	
	}
//		
		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition['AND']=array('date(Vhsnd.visit_date) >='=>$fromdate,'date(Vhsnd.visit_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['Vhsnd.visit_date']=$fromdate;	
				}
				
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
		$condition['Vhsnd.block']=$searchBuilderId;
		} else {
                      // $condition='Vhsnd.block='.$r['Bpc']['allocated_block'];
                        $condition=['Vhsnd.block IN' =>explode(',',$r['Bpc']['allocated_block'])];
                }
                if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('Vhsnd.id LIKE'=>'%'.$searchKey.'%','Vhsnd.it_availability LIKE'=>'%'.$searchKey.'%','Vhsnd.height_availability LIKE'=>'%'.$searchKey.'%','Vhsnd.hb_availability LIKE '=>'%'.$searchKey.'%','Vhsnd.weight_availability LIKE '=>'%'.$searchKey.'%','Vhsnd.calcium_availability LIKE '=>'%'.$searchKey.'%','Vhsnd.abdomen_availability LIKE '=>'%'.$searchKey.'%'); 
	
	}
//		
		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition['AND']=array('date(Vhsnd.visit_date) >='=>$fromdate,'date(Vhsnd.visit_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['Vhsnd.visit_date']=$fromdate;	
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
		$condition['Vhsnd.block']=$searchBuilderId;
		} else {
                       $condition='Vhsnd.district='.$r['Dpo']['district'];
                }
                if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('Vhsnd.id LIKE'=>'%'.$searchKey.'%','Vhsnd.it_availability LIKE'=>'%'.$searchKey.'%','Vhsnd.height_availability LIKE'=>'%'.$searchKey.'%','Vhsnd.hb_availability LIKE '=>'%'.$searchKey.'%','Vhsnd.weight_availability LIKE '=>'%'.$searchKey.'%','Vhsnd.calcium_availability LIKE '=>'%'.$searchKey.'%','Vhsnd.abdomen_availability LIKE '=>'%'.$searchKey.'%'); 
	
	}
//		
		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition['AND']=array('date(Vhsnd.visit_date) >='=>$fromdate,'date(Vhsnd.visit_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['Vhsnd.visit_date']=$fromdate;	
				}
				
			}
                      } 
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Village yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
			//$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
			 $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.city_id IN'=>explode(',',$r['Dpo']['district']))));
                   
               // $panchayats=$this->Panchayat->find('list');
               // $villages=$this->Village->find('list');	
		}
         }
         else if(CakeSession::read('User.type')==='user'){
	   $r = $this->Ngo->find('first',array('conditions'=>array('Ngo.chief_functionary_name='.CakeSession::read('User.id'))));
                 if($r){
                     $blo=array();
                   $blo= [$r['Ngo']['allocated_block_one'],$r['Ngo']['allocated_block_two']];
                     if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){
                              $searchBlockId=trim($this->request->query['block']);
		         $condition['Vhsnd.block']=$searchBlockId;
		        }else {
                            
                       $condition=['Vhsnd.block IN' =>$blo];
                       
                      }
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('Vhsnd.id LIKE'=>'%'.$searchKey.'%','Vhsnd.it_availability LIKE'=>'%'.$searchKey.'%','Vhsnd.height_availability LIKE'=>'%'.$searchKey.'%','Vhsnd.hb_availability LIKE '=>'%'.$searchKey.'%','Vhsnd.weight_availability LIKE '=>'%'.$searchKey.'%','Vhsnd.calcium_availability LIKE '=>'%'.$searchKey.'%','Vhsnd.abdomen_availability LIKE '=>'%'.$searchKey.'%'); 
	
	}
//		
		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition['AND']=array('date(Vhsnd.visit_date) >='=>$fromdate,'date(Vhsnd.visit_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['Vhsnd.visit_date']=$fromdate;	
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
		$this->Paginator->settings = array('Vhsnd' => array('limit' =>20,'order' => array('id' => 'desc'),'conditions'=>array($condition,'Vhsnd.status'=>'active')));
		$this->Vhsnd->recursive = 0;
		$this->set('vhsnds', $this->Paginator->paginate());
		
			
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
		if (!$this->Vhsnd->exists($id)) {
			throw new NotFoundException(__('Invalid Vhsnd'));
		}
		$options = array('conditions' => array('Vhsnd.' . $this->Vhsnd->primaryKey => $id));
		$this->set('vhsnds', $this->Vhsnd->find('first', $options));
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
			$this->Vhsnd->create();
                        $data= $this->request->data;
                        //print_r($this->request->data);
                        //die();
//                          $organization =  $this->request->data['Vhsnd']['organization'];
//                          $district =  $this->request->data['Vhsnd']['district'];
//                          $block =  $this->request->data['Vhsnd']['block'];
//                          $panchayat =  $this->request->data['Vhsnd']['panchayat'];
//                          $cc_name =  $this->request->data['Vhsnd']['cc_name'];
//                          $member_num=  $this->request->data['Vhsnd']['member_num'];
//                          $constitution_date =  date('Y-m-d',strtotime($this->request->data['Vhsnd']['constitution_date']));
//                          $bank_account =  $this->request->data['Vhsnd']['bank_account'];
//                          $bank_name=  $this->request->data['Vhsnd']['bank_name'];
//                          $ifsc =  $this->request->data['Vhsnd']['ifsc'];
//                          $untied_funds_received =  $this->request->data['Vhsnd']['untied_funds_received'];
//                          $financial_year =  $this->request->data['Vhsnd']['financial_year'];
//                          $status =  $this->request->data['Vhsnd']['status'];
//                            
//                $data= array (
//                             'organization' => $organization ,
//                             'district' => $district,
//                             'block' => $block ,
//                             'panchayat' => $panchayat,
//                             'cc_name' => $cc_name ,
//                             'member_num' => $member_num ,
//                             'constitution_date' => $constitution_date ,
//                             'bank_account' => $bank_account ,
//                             'bank_name' => $bank_name ,
//                             'ifsc'=> $ifsc ,
//                             'untied_funds_received' => $untied_funds_received ,
//                             'financial_year' => $financial_year ,
//                             'status' => $status ) ;  
//                
			if ($this->Vhsnd->save($data)) {
				$this->Session->setFlash(__('The Vhsnd Detail has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Vhsnd Detail could not be saved. Please, try again.'));
			}
		}
                
                  if(CakeSession::read('User.type')==='regular'){
                     
                     if(CakeSession::read('User.subrole')==='CC'){
		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'))));
                       
                       //$condition='VhsncConstitution.village='.$r['Bpccc']['allocated_village'];
                        
			//$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
                       
	            $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Bpccc']['allocated_district'])));
                    $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id'=>$r['Bpccc']['allocated_block'])));
                    $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Panchayat.id IN'=>explode(',',$r['Bpccc']['allocated_panchayat']))));
                     $village=$this->Village->find('list');
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
                $reasoncatanc=$this->ReasonCategory->find('first',array('conditions'=>array('ReasonCategory.name LIKE'=>'%'.'VHSND-ANC'.'%')));
                $reasoncatchild=$this->ReasonCategory->find('first',array('conditions'=>array('ReasonCategory.name LIKE'=>'%'.'VHSND-CHILD'.'%')));
                $reasoncatfamily=$this->ReasonCategory->find('first',array('conditions'=>array('ReasonCategory.name LIKE'=>'%'.'VHSND-FAMILY'.'%')));
                $reasoncatado=$this->ReasonCategory->find('first',array('conditions'=>array('ReasonCategory.name LIKE'=>'%'.'VHSND-ADOLESCENT'.'%')));
                $reasonanc=$this->Reason->find('list',array('conditions'=>array('Reason.cat_id'=>$reasoncatanc['ReasonCategory']['id'])));
                $reasonchild=$this->Reason->find('list',array('conditions'=>array('Reason.cat_id'=>$reasoncatchild['ReasonCategory']['id'])));
                $reasonfamily=$this->Reason->find('list',array('conditions'=>array('Reason.cat_id'=>$reasoncatfamily['ReasonCategory']['id'])));
                $reasonado=$this->Reason->find('list',array('conditions'=>array('Reason.cat_id'=>$reasoncatado['ReasonCategory']['id'])));
                
               // print_r($reasoncat);
                //die();
                
                $ward=$this->Ward->find('list');
		$this->set(compact('panchayat','cities','ngos','blocks','desig','village','ward','reasonanc','reasonchild','reasonfamily','reasonado'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Vhsnd->exists($id)) {
			throw new NotFoundException(__('Invalid Vhsnd'));
		}
		if ($this->request->is(array('post', 'put'))) {
                       //print_r($this->request->data);
                       // die();
                       $data= $this->request->data;
//                    $organization =  $this->request->data['Vhsnd']['organization'];
//                          $district =  $this->request->data['Vhsnd']['district'];
//                          $block =  $this->request->data['Vhsnd']['block'];
//                          $panchayat =  $this->request->data['Vhsnd']['panchayat'];
//                          $cc_name =  $this->request->data['Vhsnd']['cc_name'];
//                          $member_num=  $this->request->data['Vhsnd']['member_num'];
//                          $constitution_date =  date('Y-m-d',strtotime($this->request->data['Vhsnd']['constitution_date']));
//                          $bank_account =  $this->request->data['Vhsnd']['bank_account'];
//                          $bank_name=  $this->request->data['Vhsnd']['bank_name'];
//                          $ifsc =  $this->request->data['Vhsnd']['ifsc'];
//                          $untied_funds_received =  $this->request->data['Vhsnd']['untied_funds_received'];
//                          $financial_year =  $this->request->data['Vhsnd']['financial_year'];
//                          $status =  $this->request->data['Vhsnd']['status'];
//                            
//                $data= array (
//                             'organization' => $organization ,
//                             'district' => $district,
//                             'block' => $block ,
//                             'panchayat' => $panchayat,
//                             'cc_name' => $cc_name ,
//                             'member_num' => $member_num ,
//                             'constitution_date' => $constitution_date ,
//                             'bank_account' => $bank_account ,
//                             'bank_name' => $bank_name ,
//                             'ifsc'=> $ifsc ,
//                             'untied_funds_received' => $untied_funds_received ,
//                             'financial_year' => $financial_year ,
//                             'status' => $status, 
//                             'id'=>$id) ;
			if ($this->Vhsnd->save($data)) {
				$this->Session->setFlash(__('The Vhsnd Detail has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Vhsnd Detail could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Vhsnd.' . $this->Vhsnd->primaryKey => $id));
			$this->request->data = $this->Vhsnd->find('first', $options);
                        
                }
                
                   if(CakeSession::read('User.type')==='regular'){
                     
                     if(CakeSession::read('User.subrole')==='CC'){
		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'))));
                       
                     
	            $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Bpccc']['allocated_district'])));
                    $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id'=>$r['Bpccc']['allocated_block'])));
                    $panchayat=$this->Panchayat->find('list',array('conditions'=>array('Panchayat.id IN'=>explode(',',$r['Bpccc']['allocated_panchayat']))));
                   if($this->request->data['Vhsnd']['panchayat']!=0 and $this->request->data['Vhsnd']['panchayat']!='')
			{
		     $village=$this->Village->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Village.panchayat_id'=>$this->request->data['Vhsnd']['panchayat'])));
		    }
                    else {
                      
                     $village=$this->Village->find('list',array('order'=>array('name'=>'asc')));
                        
                    }	
		}
                
                 elseif(CakeSession::read('User.subrole')==='BPC'){
		  $r = $this->Bpc->find('first',array('conditions'=>array('Bpc.first_name='.CakeSession::read('User.id'))));
                       
                      
	            $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Bpc']['allocated_district'])));
                    $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id IN'=>explode(',',$r['Bpc']['allocated_block']))));
                    if($this->request->data['Vhsnd']['panchayat']!=0 and $this->request->data['Vhsnd']['panchayat']!='')
			{
		     $village=$this->Village->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Village.panchayat_id'=>$this->request->data['Vhsnd']['panchayat'])));
		    }
                    else {
                      
                     $village=$this->Village->find('list');
                        
                    }
                   if($this->request->data['Vhsnd']['panchayat']!=0 and $this->request->data['Vhsnd']['panchayat']!='')
			{
		     $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Panchayat.id'=>$this->request->data['Vhsnd']['panchayat'])));
		    }
                    else {
                       $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc')));  
                    }
                  
                    //$village=$this->Village->find('list');
		}
                
                
                 else {
		  $r = $this->Dpo->find('first',array('conditions'=>array('Dpo.first_name='.CakeSession::read('User.id'))));
                         
	            $cities=$this->City->find('list',array('conditions'=>array('City.id'=>$r['Dpo']['district'])));
                   if($this->request->data['Vhsnd']['block']!=0 and $this->request->data['Vhsnd']['block']!='')
			{
		     $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id'=>$this->request->data['Vhsnd']['block'])));
		    }
                    else {
                      
                     $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc')));
                        
                    }
                    if($this->request->data['Vhsnd']['panchayat']!=0 and $this->request->data['Vhsnd']['panchayat']!='')
			{
		     $village=$this->Village->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Village.panchayat_id'=>$this->request->data['Vhsnd']['panchayat'])));
		    }
                    else {
                      
                     $village=$this->Village->find('list',array('order'=>array('name'=>'asc')));
                        
                    }
                   if($this->request->data['Vhsnd']['panchayat']!=0 and $this->request->data['Vhsnd']['panchayat']!='')
			{
		     $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Panchayat.id'=>$this->request->data['Vhsnd']['panchayat'])));
		    }
                    else {
                       $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc')));  
                    }
		}
		   }
                else {
                    $cities=$this->City->find('list',array('order'=>array('name'=>'asc')));
                    if($this->request->data['Vhsnd']['block']!=0 and $this->request->data['Vhsnd']['block']!='')
			{
		     $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id'=>$this->request->data['Vhsnd']['block'])));
		    }
                    else {
                      
                     $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc')));
                        
                    }
                    if($this->request->data['Vhsnd']['panchayat']!=0 and $this->request->data['Vhsnd']['panchayat']!='')
			{
		     $village=$this->Village->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Village.panchayat_id'=>$this->request->data['Vhsnd']['panchayat'])));
		    }
                    else {
                      
                     $village=$this->Village->find('list',array('order'=>array('name'=>'asc')));
                        
                    }
                   if($this->request->data['Vhsnd']['panchayat']!=0 and $this->request->data['Vhsnd']['panchayat']!='')
			{
		     $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Panchayat.id'=>$this->request->data['Vhsnd']['panchayat'])));
		    }
                    else {
                       $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc')));  
                    }
                }
		$reporting_periods=$this->ReportingPeriod->query("select * from reporting_periods");	
	       //$cities=$this->City->find('list');
                $desig=$this->Designation->find('list');
		//$blocks=$this->Block->find('list');
		$ngos=$this->Ngo->find('list');
                //$panchayat=$this->Panchayat->find('list');
                //$village=$this->Village->find('list');
                 $ward=$this->Ward->find('list');
                $reasoncatanc=$this->ReasonCategory->find('first',array('conditions'=>array('ReasonCategory.name LIKE'=>'%'.'VHSND-ANC'.'%')));
                $reasoncatchild=$this->ReasonCategory->find('first',array('conditions'=>array('ReasonCategory.name LIKE'=>'%'.'VHSND-CHILD'.'%')));
                $reasoncatfamily=$this->ReasonCategory->find('first',array('conditions'=>array('ReasonCategory.name LIKE'=>'%'.'VHSND-FAMILY'.'%')));
                $reasoncatado=$this->ReasonCategory->find('first',array('conditions'=>array('ReasonCategory.name LIKE'=>'%'.'VHSND-ADOLESCENT'.'%')));
                $reasonanc=$this->Reason->find('list',array('conditions'=>array('Reason.cat_id'=>$reasoncatanc['ReasonCategory']['id'])));
                $reasonchild=$this->Reason->find('list',array('conditions'=>array('Reason.cat_id'=>$reasoncatchild['ReasonCategory']['id'])));
                $reasonfamily=$this->Reason->find('list',array('conditions'=>array('Reason.cat_id'=>$reasoncatfamily['ReasonCategory']['id'])));
                $reasonado=$this->Reason->find('list',array('conditions'=>array('Reason.cat_id'=>$reasoncatado['ReasonCategory']['id'])));
		$this->set(compact('panchayat','cities','ngos','blocks','desig','village','ward','reasonanc','reasonchild','reasonfamily','reasonado'));
		
	}
	
	
	

/**  
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null,$status='deactive') {
		$this->Vhsnd->id = $id;
		if (!$this->Vhsnd->exists()) {
			throw new NotFoundException(__('Invalid VHSND Detail'));
		}
		    //$this->request->onlyAllow('post', 'delete');
		    $this->Vhsnd->read(null,$id);
			$this->Vhsnd->set(array('status'=>$status));
		
		if ($this->Vhsnd->save()) {
			$this->Session->setFlash(__('The VHSND has been '.$status));
		} else {
			$this->Session->setFlash(__('Nothing happen. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
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
	$condition2.=' and Vhsnd.id LIKE %'.$searchKey.'% || Vhsnd.it_availability LIKE %'.$searchKey.'% Vhsnd.height_availability LIKE %'.$searchKey.'% || Vhsnd.hb_availability LIKE %'.$searchKey.'% || Vhsnd.weight_availability LIKE %'.$searchKey.'% || Vhsnd.calcium_availability LIKE %'.$searchKey.'% || Vhsnd.abdomen_availability LIKE %'.$searchKey.'%';
	
	}
	
	
	
	if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(Vhsnd.visit_date)>="'.$fromdate.'" and date(Vhsnd.visit_date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(Vhsnd.visit_date)="'.$fromdate.'"';
				}
				else
				{
					
					}
			}
			
			
  
//		if(isset($this->request->query['organization']) and ($this->request->query['organization']!=0) and ($this->request->query['organization']!='')){$searchBuilderId=trim($this->request->query['organization']);  //$condition['Enquiry.country_id']=$searchCountryId;
//		$condition2.=' and Vhsnd.organization='.$searchBuilderId;
//		
//		}
//		
		if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBlockId=trim($this->request->query['block']); //$condition['Enquiry.builder_id']=$searchBuilderId;
		$condition2.=' and Vhsnd.block='.$searchBlockId;
		}
		
		if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchProjectId=trim($this->request->query['panchayat']); //$condition['Enquiry.project_id']=$searchProjectId;
		$condition2.=' and Vhsnd.panchayat='.$searchProjectId;
		}
               
                if(isset($this->request->query['village']) and ($this->request->query['village']!=0) and ($this->request->query['village']!='')){$searchVillageId=trim($this->request->query['village']); //$condition['Enquiry.project_id']=$searchProjectId;
		$condition2.=' and Vhsnd.village='.$searchVillageId;
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
                             $condition2.=' and Vhsnd.panchayat='.$searchProjectId;
		           }   else { 
                        ///$condition=['VhsncAfc.panchayat IN' =>explode(',',$r['Bpccc']['allocated_panchayat'])]; 
                         $condition2.=' and Vhsnd.panchayat IN ('.$r['Bpccc']['allocated_panchayat'].')';
                      }
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    //$condition['OR']=array('Geographical.id LIKE'=>'%'.$searchKey.'%','Geographical.ward LIKE'=>'%'.$searchKey.'%','Geographical.awc_code LIKE'=>'%'.$searchKey.'%','Geographical.awc_worker LIKE '=>'%'.$searchKey.'%','Geographical.asha_name LIKE '=>'%'.$searchKey.'%'); 
	$condition2.=' and Vhsnd.id LIKE %'.$searchKey.'% || Vhsnd.it_availability LIKE %'.$searchKey.'% Vhsnd.height_availability LIKE %'.$searchKey.'% || Vhsnd.hb_availability LIKE %'.$searchKey.'% || Vhsnd.weight_availability LIKE %'.$searchKey.'% || Vhsnd.calcium_availability LIKE %'.$searchKey.'% || Vhsnd.abdomen_availability LIKE %'.$searchKey.'%';
	
	}
	
	
	
	if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(Vhsnd.visit_date)>="'.$fromdate.'" and date(Vhsnd.visit_date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(Vhsnd.visit_date)="'.$fromdate.'"';
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
		        $condition2.=' and Vhsnd.block='.$searchBlockId;
		        }else {
                            
                       $condition2.=' and Vhsnd.block IN ('.$r['Bpc']['allocated_block'].')';
                       
                      }
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    //$condition['OR']=array('Geographical.id LIKE'=>'%'.$searchKey.'%','Geographical.ward LIKE'=>'%'.$searchKey.'%','Geographical.awc_code LIKE'=>'%'.$searchKey.'%','Geographical.awc_worker LIKE '=>'%'.$searchKey.'%','Geographical.asha_name LIKE '=>'%'.$searchKey.'%'); 
	$condition2.=' and Vhsnd.id LIKE %'.$searchKey.'% || Vhsnd.it_availability LIKE %'.$searchKey.'% Vhsnd.height_availability LIKE %'.$searchKey.'% || Vhsnd.hb_availability LIKE %'.$searchKey.'% || Vhsnd.weight_availability LIKE %'.$searchKey.'% || Vhsnd.calcium_availability LIKE %'.$searchKey.'% || Vhsnd.abdomen_availability LIKE %'.$searchKey.'%';
	
	}
	
	
	
	if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(Vhsnd.visit_date)>="'.$fromdate.'" and date(Vhsnd.visit_date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(Vhsnd.visit_date)="'.$fromdate.'"';
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
                               $condition2.=' and Vhsnd.block='.$searchBlockId;
		        // $condition['VhsncAfc.block']=$searchBlockId;
		        }else {
                       //$condition='VhsncAfc.district='.$r['Dpo']['district'];
                        $condition2.=' and Vhsnd.district IN ('.$r['Dpo']['district'].')';
                        }
                        if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    //$condition['OR']=array('Geographical.id LIKE'=>'%'.$searchKey.'%','Geographical.ward LIKE'=>'%'.$searchKey.'%','Geographical.awc_code LIKE'=>'%'.$searchKey.'%','Geographical.awc_worker LIKE '=>'%'.$searchKey.'%','Geographical.asha_name LIKE '=>'%'.$searchKey.'%'); 
	$condition2.=' and Vhsnd.id LIKE %'.$searchKey.'% || Vhsnd.it_availability LIKE %'.$searchKey.'% Vhsnd.height_availability LIKE %'.$searchKey.'% || Vhsnd.hb_availability LIKE %'.$searchKey.'% || Vhsnd.weight_availability LIKE %'.$searchKey.'% || Vhsnd.calcium_availability LIKE %'.$searchKey.'% || Vhsnd.abdomen_availability LIKE %'.$searchKey.'%';
	
	}
	
	
	
	if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(Vhsnd.visit_date)>="'.$fromdate.'" and date(Vhsnd.visit_date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(Vhsnd.visit_date)="'.$fromdate.'"';
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
		$condition2.=' and Vhsnd.status="active"';
		$this->response->download("Vhsnd.csv");
		//print_r($condition); exit;
	    $data=$this->Vhsnd->query('select Vhsnd.id,Geographical.awc_code,Geographical.aww_name,Geographical.asha_name,Vhsnd.anm_name,Vhsnd.pw_due_list,Vhsnd.child_due_list,Vhsnd.ec_due_list,Vhsnd.visit_date,Vhsnd.it_availability,r1.name as name1,r2.name as name2,r3.name as name3,r4.name as name4,r5.name as name5,r6.name as name6,r7.name as name7,r8.name as name8,r9.name as name9,r10.name as name10,r11.name as name11,r12.name as name12,r13.name as name13,r14.name as name14,r15.name as name15,r16.name as name16,r17.name as name17,Vhsnd.it_footfall_number,Vhsnd.height_availability,Vhsnd.height_reason,Vhsnd.height_footfall_number,Vhsnd.hb_availability,Vhsnd.hb_reason,Vhsnd.hb_footfall_number,Vhsnd.abdomen_availability,Vhsnd.abdomen_reason,Vhsnd.abdomen_footfall_number,Vhsnd.calcium_availability,Vhsnd.calcium_reason,Vhsnd.calcium_footfall_number,Vhsnd.weight_availability,Vhsnd.weight_reason,Vhsnd.weight_footfall_number,Vhsnd.bp_availability,Vhsnd.bp_reason,Vhsnd.bp_footfall_number,Vhsnd.urine_availability,Vhsnd.urine_reason,Vhsnd.urine_footfall_number,Vhsnd.ifa_availability,Vhsnd.ifa_reason,Vhsnd.ifa_footfall_number,Vhsnd.immunisation_availability,Vhsnd.immunisation_reason,Vhsnd.immunisation_footfall_number,Vhsnd.growth_availability,Vhsnd.growth_reason,Vhsnd.growth_footfall_number,Vhsnd.condom_availability,Vhsnd.condom_reason,Vhsnd.condom_footfall_number,Vhsnd.mala_n_availability,Vhsnd.mala_n_reason,Vhsnd.mala_n_footfall_number,Vhsnd.chaya_availability,Vhsnd.chaya_reason,Vhsnd.chaya_footfall_number,Vhsnd.antara_availability,Vhsnd.antara_reason,Vhsnd.antara_footfall_number,Vhsnd.td_availability,Vhsnd.td_reason,Vhsnd.td_footfall_number,Vhsnd.ifa_blue_availability,Vhsnd.ifa_blue_reason,Vhsnd.ifa_blue_footfall_number,Vhsnd.anc_counselling,Vhsnd.child_counselling,Vhsnd.adolescentc_ounselling,Vhsnd.pnc_visit,Vhsnd.family_counselling,City.name,Block.name,Panchayat.name,Village.name,Ward.name,Vhsnd.status from vhsnds as Vhsnd left join cities as City  on Vhsnd.district=City.id left join blocks as Block  on Vhsnd.block=Block.id left join villages as Village  on Vhsnd.village=Village.id left join panchayats as Panchayat on Vhsnd.panchayat=Panchayat.id left join wards as Ward on Vhsnd.ward=Ward.id left join geographicals as Geographical on Vhsnd.awc_code=Geographical.id left join reasons r1 on Vhsnd.it_reason=r1.id left join reasons r2 on Vhsnd.height_reason=r2.id left join reasons r3 on Vhsnd.weight_reason=r3.id left join reasons r4 on Vhsnd.ifa_reason=r4.id left join reasons r5 on Vhsnd.calcium_reason=r5.id left join reasons r6 on Vhsnd.bp_reason=r6.id left join reasons r7 on Vhsnd.hb_reason=r7.id left join reasons r8 on Vhsnd.urine_reason=r8.id left join reasons r9 on Vhsnd.abdomen_reason=r9.id left join reasons r10 on Vhsnd.immunisation_reason=r10.id left join reasons r11 on Vhsnd.growth_reason=r11.id left join reasons r12 on Vhsnd.condom_reason=r12.id left join reasons r13 on Vhsnd.mala_n_reason=r13.id left join reasons r14 on Vhsnd.chaya_reason=r14.id left join reasons r15 on Vhsnd.antara_reason=r15.id left join reasons r16 on Vhsnd.td_reason=r16.id left join reasons r17 on Vhsnd.ifa_blue_reason=r17.id  where 1 '.$condition2 );
		
		
		//$data = $this->Geographical->find('all', array('conditions'=>$condition2));
		
		//$log = $this->Enquiry->getDataSource()->getLog(false, false);
        //debug($log);
		//exit;
		
            $headers = array('Vhsnd'=>array( 'Id' => 'Id','District' => 'District', 'Block' => 'Block','Panchayat' => 'Panchayat','Village'=>'Village','Ward'=>'Ward','Visit Date'=>'Visit Date','AWC Code'=>'AWC Code','AWW Name'=>'AWW Name','ASHA Name'=>'ASHA Name','ANM Name'=>'ANM Name','PW in Due list'=>'PW in Due list','Child in Due list'=>'Child in Due list','EC in Due list'=>'EC in Due list','TD Service'=>'TD Service','TD Reason'=>'TD Reason','TD Footfall'=>'TD Footfall','Height Service'=>'Height Service','Height Reason'=>'Height Reason','Height Footfall'=>'Height Footfall','Weight Service'=>'Weight Service','Weight Reason'=>'Weight Reason','Weight Footfall'=>'Weight Footfall','IFA Service'=>'IFA Service','IFA Reason'=>'IFA Reason','IFA Footfall'=>'IFA Footfall','Calcium Service'=>'Calcium Service','Calcium Reason'=>'Calcium Reason','Calcium Footfall'=>'Calcium Footfall','B.P Check Service'=>'B.P Check Service','B.P Check Reason'=>'B.P Check Reason','B.P Check Footfall'=>'B.P Check Footfall','HB Test Service'=>'HB Test Service','HB Test Reason'=>'HB Test Reason','HB Test Footfall'=>'HB Test Footfall','Urine Test Service'=>'Urine Test Service','Urine Test Reason'=>'Urine Test Reason','Urine Test Footfall'=>'Urine Test Footfall','Abdomen Check Service'=>'Abdomen Check Service','Abdomen Check Reason'=>'Abdomen Check Reason','Abdomen Check Footfall'=>'Abdomen Check Footfall','Immunisation Service'=>'Immunisation Service','Immunisation Reason'=>'Immunisation Reason','Immunisation Footfall'=>'Immunisation Footfall','Growth Monitoring & Plotting Service'=>'Growth Monitoring & Plotting Service','Growth Monitoring & Plotting Reason'=>'Growth Monitoring & Plotting Reason','Growth Monitoring & Plotting Footfall'=>'Growth Monitoring & Plotting Footfall','Condom Service'=>'Condom Service','Condom Reason'=>'Condom Reason','Condom Footfall'=>'Condom Footfall','Mala N Service'=>'Mala N Service','Mala N Reason'=>'Mala N Reason','Mala N Footfall'=>'Mala N Footfall','Chaya Service'=>'Chaya Service','Chaya Reason'=>'Chaya Reason','Chaya Footfall'=>'Chaya Footfall','Antara Service'=>'Antara Service','Antara Reason'=>'Antara Reason','Antara Footfall'=>'Antara Footfall','TD Service'=>'TD Service','TD Reason'=>'TD Reason','TD Footfall'=>'TD Footfall','IFA Blue Service'=>'IFA Blue Service','IFA Blue Reason'=>'IFA Blue Reason','IFA Blue Footfall'=>'IFA Blue Footfall','Counselled ANC'=>'Counselled ANC','Counselled Child'=>'Counselled Child','Counselled Family Planning'=>'Counselled Family Planning','Counselled Adolescent'=>'Counselled Adolescent','PNC visit'=>'PNC visit','Status'=>'Status')); 
	    $this->set(compact('data','headers'));
		$this->layout = 'ajax';
		return;
		
		}
  ////  reports section ---///// 
	

	}
	
	
	
	
