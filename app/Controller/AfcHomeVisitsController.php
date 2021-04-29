<?php
App::uses('AppController', 'Controller');
/**
 * Ngos Controller
 *
 * @property Ngo $GeographicalNgo
 * @property PaginatorComponent $Paginator
 */
class AfcHomeVisitsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Upload');

    var  $uses = array('AfcHomeVisit','Contraceptive','VhsncConstitution','Geographical','Ngo','User','Project','Village','Panchayat','Ward','Country','City','Block','Designation','VhsncAfc','Bpccc','ReasonCategory','Reason','Bpc','Dpo');
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
    $condition['OR']=array('AfcHomeVisit.id LIKE'=>'%'.$searchKey.'%','AfcHomeVisit.mobile LIKE'=>'%'.$searchKey.'%','AfcHomeVisit.couple_name LIKE'=>'%'.$searchKey.'%','AfcHomeVisit.gender LIKE'=>'%'.$searchKey.'%','AfcHomeVisit.age LIKE'=>'%'.$searchKey.'%','AfcHomeVisit.sterilisation_of_month LIKE'=>'%'.$searchKey.'%'); 
	
	}
		
		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition['AND']=array('date(AfcHomeVisit.visit_date) >='=>$fromdate,'date(AfcHomeVisit.visit_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['AfcHomeVisit.visit_date']=$fromdate;	
				}
				
			}
		
             if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBuilderId=trim($this->request->query['block']); 
		$condition['AfcHomeVisit.block']=$searchBuilderId;
		}
		if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchPanchayatId=trim($this->request->query['panchayat']); 
		$condition['AfcHomeVisit.panchayat']=$searchPanchayatId;
		}
		
		if(isset($this->request->query['village']) and ($this->request->query['village']!=0) and ($this->request->query['village']!='')){$searchProjectId=trim($this->request->query['village']);
		$condition['AfcHomeVisit.village']=$searchProjectId;
		}
		
	}
         if(CakeSession::read('User.type')==='regular'){
             //echo CakeSession::read('User.subrole');
            // die();
             if(CakeSession::read('User.subrole')==='CC'){
		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'))));
                      if($r){ 
                          if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchPanchayatId=trim($this->request->query['panchayat']); 
		$condition['AfcHomeVisit.panchayat']=$searchPanchayatId;
		} else {
                       //$condition='AfcHomeVisit.panchayat='.$r['Bpccc']['allocated_panchayat'];
                        $condition=['AfcHomeVisit.panchayat IN' =>explode(',',$r['Bpccc']['allocated_panchayat'])];
                }
                if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('AfcHomeVisit.id LIKE'=>'%'.$searchKey.'%','AfcHomeVisit.mobile LIKE'=>'%'.$searchKey.'%','AfcHomeVisit.couple_name LIKE'=>'%'.$searchKey.'%','AfcHomeVisit.gender LIKE'=>'%'.$searchKey.'%','AfcHomeVisit.age LIKE'=>'%'.$searchKey.'%','AfcHomeVisit.sterilisation_of_month LIKE'=>'%'.$searchKey.'%'); 
	
	}
		
		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition['AND']=array('date(AfcHomeVisit.visit_date) >='=>$fromdate,'date(AfcHomeVisit.visit_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['AfcHomeVisit.visit_date']=$fromdate;	
				}
				
			}
                      } 
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Village yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
			//$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
			  $panchayats=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>['Panchayat.id IN'=>explode(',',$r['Bpccc']['allocated_panchayat'])]));
                   	
		}
                
                 elseif(CakeSession::read('User.subrole')==='BPC'){
		   $r = $this->Bpc->find('first',array('conditions'=>array('Bpc.first_name='.CakeSession::read('User.id'))));
                      if($r){ 
                          if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBuilderId=trim($this->request->query['block']); 
		$condition['AfcHomeVisit.block']=$searchBuilderId;
		} else {
                       //$condition='AfcHomeVisit.block='.$r['Bpc']['allocated_block'];
                       $condition=['AfcHomeVisit.block IN' =>explode(',',$r['Bpc']['allocated_block'])];
                }
                if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('AfcHomeVisit.id LIKE'=>'%'.$searchKey.'%','AfcHomeVisit.mobile LIKE'=>'%'.$searchKey.'%','AfcHomeVisit.couple_name LIKE'=>'%'.$searchKey.'%','AfcHomeVisit.gender LIKE'=>'%'.$searchKey.'%','AfcHomeVisit.age LIKE'=>'%'.$searchKey.'%','AfcHomeVisit.sterilisation_of_month LIKE'=>'%'.$searchKey.'%'); 
	
	}
		
		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition['AND']=array('date(AfcHomeVisit.visit_date) >='=>$fromdate,'date(AfcHomeVisit.visit_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['AfcHomeVisit.visit_date']=$fromdate;	
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
		$condition['AfcHomeVisit.block']=$searchBuilderId;
		}   else {
                       $condition='AfcHomeVisit.district='.$r['Dpo']['district'];
                } 
                       
                       if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('AfcHomeVisit.id LIKE'=>'%'.$searchKey.'%','AfcHomeVisit.mobile LIKE'=>'%'.$searchKey.'%','AfcHomeVisit.couple_name LIKE'=>'%'.$searchKey.'%','AfcHomeVisit.gender LIKE'=>'%'.$searchKey.'%','AfcHomeVisit.age LIKE'=>'%'.$searchKey.'%','AfcHomeVisit.sterilisation_of_month LIKE'=>'%'.$searchKey.'%'); 
	
	}
		
		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition['AND']=array('date(AfcHomeVisit.visit_date) >='=>$fromdate,'date(AfcHomeVisit.visit_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['AfcHomeVisit.visit_date']=$fromdate;	
				}
				
			}
                      } 
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Village yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
			//$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
			$blocks=$this->Block->find('list',array('order'=>array('name'=>'asc')));
                       $panchayats=$this->Panchayat->find('list',array('order'=>array('name'=>'asc')));
                       $villages=$this->Village->find('list',array('order'=>array('name'=>'asc')));	
		}
         }
          else if(CakeSession::read('User.type')==='user'){
	   $r = $this->Ngo->find('first',array('conditions'=>array('Ngo.chief_functionary_name='.CakeSession::read('User.id'))));
                 if($r){
                     $blo=array();
                   $blo= [$r['Ngo']['allocated_block_one'],$r['Ngo']['allocated_block_two']];
                     if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){
                              $searchBlockId=trim($this->request->query['block']);
		         $condition['AfcHomeVisit.block']=$searchBlockId;
		        }else {
                            
                       $condition=['AfcHomeVisit.block IN' =>$blo];
                       
                      }
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('AfcHomeVisit.id LIKE'=>'%'.$searchKey.'%','AfcHomeVisit.mobile LIKE'=>'%'.$searchKey.'%','AfcHomeVisit.couple_name LIKE'=>'%'.$searchKey.'%','AfcHomeVisit.gender LIKE'=>'%'.$searchKey.'%','AfcHomeVisit.age LIKE'=>'%'.$searchKey.'%','AfcHomeVisit.sterilisation_of_month LIKE'=>'%'.$searchKey.'%'); 
	
	}
		
		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition['AND']=array('date(AfcHomeVisit.visit_date) >='=>$fromdate,'date(AfcHomeVisit.visit_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['AfcHomeVisit.visit_date']=$fromdate;	
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
		
		$this->Paginator->settings = array('AfcHomeVisit' => array('limit' =>20,'order' => array('id' => 'desc'),'conditions'=>array($condition,'AfcHomeVisit.status'=>'active')));
		$this->AfcHomeVisit->recursive = 0;
		$this->set('afcs', $this->Paginator->paginate());
		
			
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
		if (!$this->AfcHomeVisit->exists($id)) {
			throw new NotFoundException(__('Invalid Afc Home Visit Member'));
		}
		$options = array('conditions' => array('AfcHomeVisit.' . $this->AfcHomeVisit->primaryKey => $id));
		$this->set('afc', $this->AfcHomeVisit->find('first', $options));
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
			$this->AfcHomeVisit->create();
                     // print_r($this->request->data);
                       
                       // echo count($this->request->data['VhsncAfc']['member_name']);
                      // die();
                        // for($i=0;$i<count($this->request->data['VhsncMember']['member_name']);$i++){
                            $district =  $this->request->data['AfcHomeVisit']['district'];
                            $block =  $this->request->data['AfcHomeVisit']['block'];
                            $panchayat =  $this->request->data['AfcHomeVisit']['panchayat'];
                            $village =  $this->request->data['AfcHomeVisit']['village'];
                            $ward =  $this->request->data['AfcHomeVisit']['ward'];
                            $date =date('Y-m-d',strtotime($this->request->data['AfcHomeVisit']['visit_date']));
                            $asha_accompanied=  $this->request->data['AfcHomeVisit']['asha_accompanied'];
                            if(isset($this->request->data['AfcHomeVisit']['asha_reason'])){
                                
                            $asha_reason=  $this->request->data['AfcHomeVisit']['asha_reason'];
                            }
                            else {
                                $asha_reason='';
                            }
                            $aww_accompanied =  $this->request->data['AfcHomeVisit']['aww_accompanied'];
                             if(isset($this->request->data['AfcHomeVisit']['aww_reason'])){
                                
                             $aww_reason=  $this->request->data['AfcHomeVisit']['aww_reason'];
                            }
                            else {
                                $aww_reason='';
                            }
                          
                            $pri_accompanied=  $this->request->data['AfcHomeVisit']['pri_accompanied'];
                             if(isset($this->request->data['AfcHomeVisit']['pri_reason'])){
                                
                             $pri_reason=  $this->request->data['AfcHomeVisit']['pri_reason'];
                            }
                            else {
                                $pri_reason='';
                            }
                            
                             $shg_accompanied=  $this->request->data['AfcHomeVisit']['shg_accompanied'];
                             if(isset($this->request->data['AfcHomeVisit']['shg_reason'])){
                                
                             $shg_reason=  $this->request->data['AfcHomeVisit']['shg_reason'];
                            }
                            else {
                                $shg_reason='';
                            }
                           
                            $couple_name=  $this->request->data['AfcHomeVisit']['couple_name'];
                            $age =  $this->request->data['AfcHomeVisit']['age'];
                            $gender=  $this->request->data['AfcHomeVisit']['gender'];
                            $mobile=  $this->request->data['AfcHomeVisit']['mobile'];
                            $no_of_child=  $this->request->data['AfcHomeVisit']['no_of_child'];
                            $yonger_child_age=  $this->request->data['AfcHomeVisit']['yonger_child_age'];
                            $current_contraceptives=  $this->request->data['AfcHomeVisit']['current_contraceptives'];
                            $commodities_regular_supply=  $this->request->data['AfcHomeVisit']['commodities_regular_supply'];
                               if(isset($this->request->data['AfcHomeVisit']['commodities_reason'])){
                                
                             $commodities_reason=  $this->request->data['AfcHomeVisit']['commodities_reason'];
                            }
                            else {
                                $commodities_reason='';
                            }
                            
                            $beneficiary_couselled=  implode(',',$this->request->data['AfcHomeVisit']['beneficiary_couselled']);
                            $convinced=  $this->request->data['AfcHomeVisit']['convinced'];
                            $contraceptives_delivery_date=   date('Y-m-d',strtotime($this->request->data['AfcHomeVisit']['contraceptives_delivery_date']));
                            $sterilisation_of_month=  $this->request->data['AfcHomeVisit']['sterilisation_of_month'];
                            $follow_visit_date=   date('Y-m-d',strtotime($this->request->data['AfcHomeVisit']['follow_visit_date']));
                            $remarks=  $this->request->data['AfcHomeVisit']['remarks'];
                      
                    $data=array (
                                
                                'district' =>$district,
                                'block' =>$block,
                                'panchayat' =>$panchayat,
                                'village' =>$village,
                                'ward'=>$ward,
                                'visit_date'=> $date,
                                'asha_accompanied'=>$asha_accompanied,
                                'asha_reason'=>$asha_reason,
                                'aww_accompanied'=>$aww_accompanied,
                                'aww_reason'=>$aww_reason,
                                'pri_accompanied'=>$pri_accompanied,
                                'pri_reason' =>$pri_reason,
                                'shg_accompanied'=>$shg_accompanied,
                                'shg_reason'=>$shg_reason,
                                'couple_name' =>$couple_name,
                                'age'=>$age,
                                'gender'=>$gender,
                                'mobile'=>$mobile,
                                'no_of_child'=>$no_of_child,
                                'yonger_child_age'=>$yonger_child_age,
                                'current_contraceptives'=>$current_contraceptives,
                                'commodities_regular_supply'=>$commodities_regular_supply,
                                'commodities_reason'=>$commodities_reason,
                                'beneficiary_couselled'=>$beneficiary_couselled,
                                'convinced'=>$convinced,
                                'contraceptives_delivery_date'=>$contraceptives_delivery_date,
                                'sterilisation_of_month'=>$sterilisation_of_month,
                                'follow_visit_date'=>$follow_visit_date,
                                'remarks'=>$remarks,
                                'updated'=>0
                                );  
                            
                           $save=$this->AfcHomeVisit->saveAll($data);
				
                       //  }///} } }   
                         
                             
                         if($save) {
                             
                             
                               $this->Session->setFlash(__('The AFC Member has been saved.'));
				//return $this->redirect(array('action' => 'index'));
                                echo "Your Record has been saved";

                        } else {
				$this->Session->setFlash(__('The AFC Member could not be saved. Please, try again.'));
			}
                         
                    }   
                 if(CakeSession::read('User.type')==='regular'){
                     
                     if(CakeSession::read('User.subrole')==='CC'){
		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'))));
                       
	            $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Bpccc']['allocated_district'])));
                    $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id'=>$r['Bpccc']['allocated_block'])));
                    $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>['Panchayat.id IN'=>explode(',',$r['Bpccc']['allocated_panchayat'])]));
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
		//$cities=$this->City->find('list');
                $desig=$this->Designation->find('list');
		//$blocks=$this->Block->find('list');
		$ngos=$this->Ngo->find('list');
                //$panchayat=$this->Panchayat->find('list');
                //$village=$this->Village->find('list');
                $ward=$this->Ward->find('list');
                $vhsnc=$this->VhsncConstitution->find('list');
                $opt=$this->Contraceptive->find('list');
                $vhsncmembers=$this->VhsncAfc->find('list',array('conditions'=>array('VhsncAfc.member_type'=>'AFC')));
                $reasoncatafcb=$this->ReasonCategory->find('first',array('conditions'=>array('ReasonCategory.name LIKE'=>'%'.'AFC-Beneficiary'.'%')));
                $reasoncatafcv=$this->ReasonCategory->find('first',array('conditions'=>array('ReasonCategory.name LIKE'=>'%'.'AFC-Visit'.'%')));
                $reasonafcb=$this->Reason->find('list',array('conditions'=>array('Reason.cat_id'=>$reasoncatafcb['ReasonCategory']['id'])));
                $reasonafcv=$this->Reason->find('list',array('conditions'=>array('Reason.cat_id'=>$reasoncatafcv['ReasonCategory']['id'])));
               
		$this->set(compact('cities','panchayat','ngos','blocks','desig','village','ward','vhsnc','vhsncmembers','opt','reasonafcb','reasonafcv'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->AfcHomeVisit->exists($id)) {
			throw new NotFoundException(__('Invalid VhsncAfc'));
		}
		if ($this->request->is(array('post', 'put'))) {
                    //print_r($this->request->data);
                    //die();
                            $district =  $this->request->data['AfcHomeVisit']['district'];
                            $block =  $this->request->data['AfcHomeVisit']['block'];
                            $panchayat =  $this->request->data['AfcHomeVisit']['panchayat'];
                            $village =  $this->request->data['AfcHomeVisit']['village'];
                            $ward =  $this->request->data['AfcHomeVisit']['ward'];
                            $date =   date('Y-m-d',strtotime($this->request->data['AfcHomeVisit']['visit_date']));
                            $asha_accompanied=  $this->request->data['AfcHomeVisit']['asha_accompanied'];
                            if(isset($this->request->data['AfcHomeVisit']['asha_reason'])){
                                
                            $asha_reason=  $this->request->data['AfcHomeVisit']['asha_reason'];
                            }
                            else {
                                $asha_reason='';
                            }
                            $aww_accompanied =  $this->request->data['AfcHomeVisit']['aww_accompanied'];
                             if(isset($this->request->data['AfcHomeVisit']['aww_reason'])){
                                
                             $aww_reason=  $this->request->data['AfcHomeVisit']['aww_reason'];
                            }
                            else {
                                $aww_reason='';
                            }
                          
                            $pri_accompanied=  $this->request->data['AfcHomeVisit']['pri_accompanied'];
                             if(isset($this->request->data['AfcHomeVisit']['pri_reason'])){
                                
                             $pri_reason=  $this->request->data['AfcHomeVisit']['pri_reason'];
                            }
                            else {
                                $pri_reason='';
                            }
                           
                            $couple_name=  $this->request->data['AfcHomeVisit']['couple_name'];
                            $age =  $this->request->data['AfcHomeVisit']['age'];
                            $gender=  $this->request->data['AfcHomeVisit']['gender'];
                            $mobile=  $this->request->data['AfcHomeVisit']['mobile'];
                            $no_of_child=  $this->request->data['AfcHomeVisit']['no_of_child'];
                            $yonger_child_age=  $this->request->data['AfcHomeVisit']['yonger_child_age'];
                            $current_contraceptives=  $this->request->data['AfcHomeVisit']['current_contraceptives'];
                            $commodities_regular_supply=  $this->request->data['AfcHomeVisit']['commodities_regular_supply'];
                               if(isset($this->request->data['AfcHomeVisit']['commodities_reason'])){
                                
                             $commodities_reason=  $this->request->data['AfcHomeVisit']['commodities_reason'];
                            }
                            else {
                                $commodities_reason='';
                            }
                            
                            $beneficiary_couselled=  implode(',',$this->request->data['AfcHomeVisit']['beneficiary_couselled']);
                            $convinced=  $this->request->data['AfcHomeVisit']['convinced'];
                            $contraceptives_delivery_date=   date('Y-m-d',strtotime($this->request->data['AfcHomeVisit']['contraceptives_delivery_date']));
                            $sterilisation_of_month=  $this->request->data['AfcHomeVisit']['sterilisation_of_month'];
                            if(isset($this->request->data['AfcHomeVisit']['follow_visit_date'])){
                                
                            $follow_visit_date=   date('Y-m-d',strtotime($this->request->data['AfcHomeVisit']['follow_visit_date']));
                          
                            }
                              $remarks=  $this->request->data['AfcHomeVisit']['remarks'];
                      
                    $data=array (
                        
                                'district' =>$district,
                                'block' =>$block,
                                'panchayat' =>$panchayat,
                                'village' =>$village,
                                'ward'=>$ward,
                                'visit_date'=> $date,
                                'asha_accompanied'=>$asha_accompanied,
                                'asha_reason'=>$asha_reason,
                                'aww_accompanied'=>$aww_accompanied,
                                'aww_reason'=>$aww_reason,
                                'pri_accompanied'=>$pri_accompanied,
                                'pri_reason' =>$pri_reason,
                                'couple_name' =>$couple_name,
                                'age'=>$age,
                                'gender'=>$gender,
                                'mobile'=>$mobile,
                                'no_of_child'=>$no_of_child,
                                'yonger_child_age'=>$yonger_child_age,
                                'current_contraceptives'=>$current_contraceptives,
                                'commodities_regular_supply'=>$commodities_regular_supply,
                                'commodities_reason'=>$commodities_reason,
                                'beneficiary_couselled'=>$beneficiary_couselled,
                                'convinced'=>$convinced,
                                'contraceptives_delivery_date'=>$contraceptives_delivery_date,
                                'sterilisation_of_month'=>$sterilisation_of_month,
                                'follow_visit_date'=>$follow_visit_date,
                                'remarks'=>$remarks,
                                'updated'=>1,
                                'id'=>$id
                                );  
                      $save=$this->AfcHomeVisit->saveAll($data);
			if ($save) {
				$this->Session->setFlash(__('The AFC Member has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The AFC Member could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('AfcHomeVisit.' . $this->AfcHomeVisit->primaryKey => $id));
			$this->request->data = $this->AfcHomeVisit->find('first', $options);
			$executives=$this->User->find('list',array('conditions'=>array('User.status'=>'active','User.role'=>'regular')));
//			
                }
                 if(CakeSession::read('User.type')==='regular'){
                     
                     if(CakeSession::read('User.subrole')==='CC'){
		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'))));
                       
                       
	            $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Bpccc']['allocated_district'])));
                    $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id'=>$r['Bpccc']['allocated_block'])));
                    $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>['Panchayat.id IN'=>explode(',',$r['Bpccc']['allocated_panchayat'])]));
                     if($this->request->data['AfcHomeVisit']['panchayat']!=0 and $this->request->data['AfcHomeVisit']['panchayat']!='')
			{
		     $village=$this->Village->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Village.panchayat_id'=>$this->request->data['AfcHomeVisit']['panchayat'])));
		    } 
                    else {
                    $village=$this->Village->find('list',array('order'=>array('name'=>'asc'),'order'=>array('name'=>'asc')));
                        
                    }	
		}
                
                 elseif(CakeSession::read('User.subrole')==='BPC'){
		  $r = $this->Bpc->find('first',array('conditions'=>array('Bpc.first_name='.CakeSession::read('User.id'))));
                       
                       
	            $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Bpc']['allocated_district'])));
                   $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id IN'=>explode(',',$r['Bpc']['allocated_block']))));
                     if($this->request->data['AfcHomeVisit']['panchayat']!=0 and $this->request->data['AfcHomeVisit']['panchayat']!='')
			{
		     $village=$this->Village->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Village.panchayat_id'=>$this->request->data['AfcHomeVisit']['panchayat'])));
		    } 
                    else {
                    $village=$this->Village->find('list');
                        
                    }
                   if($this->request->data['AfcHomeVisit']['panchayat']!=0 and $this->request->data['AfcHomeVisit']['panchayat']!='')
			{
		     $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Panchayat.id'=>$this->request->data['AfcHomeVisit']['panchayat'])));
		    }
                    else {
                        $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'))); 
                    }
                   
                    //$village=$this->Village->find('list');
		}
                
                
                 else {
		  $r = $this->Dpo->find('first',array('conditions'=>array('Dpo.first_name='.CakeSession::read('User.id'))));
                         
	            $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Dpo']['district'])));
                    if($this->request->data['AfcHomeVisit']['block']!=0 and $this->request->data['AfcHomeVisit']['block']!='')
			{
		     $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id'=>$this->request->data['AfcHomeVisit']['block'])));
		    } 
                    else {
                    $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc')));
                        
                    }
                    if($this->request->data['AfcHomeVisit']['panchayat']!=0 and $this->request->data['AfcHomeVisit']['panchayat']!='')
			{
		     $village=$this->Village->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Village.panchayat_id'=>$this->request->data['AfcHomeVisit']['panchayat'])));
		    } 
                    else {
                    $village=$this->Village->find('list',array('order'=>array('name'=>'asc')));
                        
                    }
                   if($this->request->data['AfcHomeVisit']['panchayat']!=0 and $this->request->data['AfcHomeVisit']['panchayat']!='')
			{
		     $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Panchayat.id'=>$this->request->data['AfcHomeVisit']['panchayat'])));
		    }
                    else {
                        $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'))); 
                    }
		}
		   }
                else {
                    $cities=$this->City->find('list',array('order'=>array('name'=>'asc')));
                   if($this->request->data['AfcHomeVisit']['block']!=0 and $this->request->data['AfcHomeVisit']['block']!='')
			{
		     $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id'=>$this->request->data['AfcHomeVisit']['block'])));
		    } 
                    else {
                    $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc')));
                        
                    }
                    if($this->request->data['AfcHomeVisit']['panchayat']!=0 and $this->request->data['AfcHomeVisit']['panchayat']!='')
			{
		     $village=$this->Village->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Village.panchayat_id'=>$this->request->data['AfcHomeVisit']['panchayat'])));
		    } 
                    else {
                    $village=$this->Village->find('list',array('order'=>array('name'=>'asc')));
                        
                    }
                   if($this->request->data['AfcHomeVisit']['panchayat']!=0 and $this->request->data['AfcHomeVisit']['panchayat']!='')
			{
		     $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Panchayat.id'=>$this->request->data['AfcHomeVisit']['panchayat'])));
		    }
                    else {
                        $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'))); 
                    }
                }
				
		//$cities=$this->City->find('list');
                $desig=$this->Designation->find('list');
		//$blocks=$this->Block->find('list');
		$ngos=$this->Ngo->find('list');
                //$panchayat=$this->Panchayat->find('list');
                //$village=$this->Village->find('list');
                $ward=$this->Ward->find('list');
                $opt=$this->Contraceptive->find('list');
                $vhsnc=$this->VhsncConstitution->find('list');
                $vhsncmembers=$this->VhsncAfc->find('list',array('conditions'=>array('VhsncAfc.member_type'=>'AFC')));
		$reasoncatafcb=$this->ReasonCategory->find('first',array('conditions'=>array('ReasonCategory.name LIKE'=>'%'.'AFC-Beneficiary'.'%')));
                $reasoncatafcv=$this->ReasonCategory->find('first',array('conditions'=>array('ReasonCategory.name LIKE'=>'%'.'AFC-Visit'.'%')));
                $reasonafcb=$this->Reason->find('list',array('conditions'=>array('Reason.cat_id'=>$reasoncatafcb['ReasonCategory']['id'])));
                $reasonafcv=$this->Reason->find('list',array('conditions'=>array('Reason.cat_id'=>$reasoncatafcv['ReasonCategory']['id'])));
		$this->set(compact('cities','panchayat','ngos','blocks','desig','village','ward','vhsnc','vhsncmembers','opt','reasonafcb','reasonafcv'));
		
	}
	
	
	
/**  
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null,$status='deactive') {
		$this->AfcHomeVisit->id = $id;
		if (!$this->AfcHomeVisit->exists()) {
			throw new NotFoundException(__('Invalid AFC Detail'));
		}
		    //$this->request->onlyAllow('post', 'delete');
		    $this->AfcHomeVisit->read(null,$id);
	           $this->AfcHomeVisit->set(array('status'=>$status));
		
		if ($this->AfcHomeVisit->save()) {
			$this->Session->setFlash(__('The AFC Detail has been '.$status));
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
	$condition2.=' and AfcHomeVisit.id LIKE %'.$searchKey.'% || AfcHomeVisit.mobile LIKE %'.$searchKey.'% AfcHomeVisit.couple_name LIKE %'.$searchKey.'% || AfcHomeVisit.gender LIKE %'.$searchKey.'% || AfcHomeVisit.age LIKE %'.$searchKey.'% || AfcHomeVisit.sterilisation_of_month LIKE %'.$searchKey.'%';
	
	}
	
	
	
	if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(AfcHomeVisit.visit_date)>="'.$fromdate.'" and date(AfcHomeVisit.visit_date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(AfcHomeVisit.visit_date)="'.$fromdate.'"';
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
		$condition2.=' and AfcHomeVisit.block='.$searchBlockId;
		}
		
		if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchProjectId=trim($this->request->query['panchayat']); //$condition['Enquiry.project_id']=$searchProjectId;
		$condition2.=' and AfcHomeVisit.panchayat='.$searchProjectId;
		}
               
                if(isset($this->request->query['village']) and ($this->request->query['village']!=0) and ($this->request->query['village']!='')){$searchVillageId=trim($this->request->query['village']); //$condition['Enquiry.project_id']=$searchProjectId;
		$condition2.=' and AfcHomeVisit.village='.$searchVillageId;
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
                             $condition2.=' and AfcHomeVisit.panchayat='.$searchProjectId;
		           }   else { 
                        ///$condition=['VhsncAfc.panchayat IN' =>explode(',',$r['Bpccc']['allocated_panchayat'])]; 
                         $condition2.=' and AfcHomeVisit.panchayat IN ('.$r['Bpccc']['allocated_panchayat'].')';
                      }
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    //$condition['OR']=array('Geographical.id LIKE'=>'%'.$searchKey.'%','Geographical.ward LIKE'=>'%'.$searchKey.'%','Geographical.awc_code LIKE'=>'%'.$searchKey.'%','Geographical.awc_worker LIKE '=>'%'.$searchKey.'%','Geographical.asha_name LIKE '=>'%'.$searchKey.'%'); 
	$condition2.=' and AfcHomeVisit.id LIKE %'.$searchKey.'% || AfcHomeVisit.mobile LIKE %'.$searchKey.'% AfcHomeVisit.couple_name LIKE %'.$searchKey.'% || AfcHomeVisit.gender LIKE %'.$searchKey.'% || AfcHomeVisit.age LIKE %'.$searchKey.'% || AfcHomeVisit.sterilisation_of_month LIKE %'.$searchKey.'%';
	
	}
	
	
	
	if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(AfcHomeVisit.visit_date)>="'.$fromdate.'" and date(AfcHomeVisit.visit_date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(AfcHomeVisit.visit_date)="'.$fromdate.'"';
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
		        $condition2.=' and AfcHomeVisit.block='.$searchBlockId;
		        }else {
                            
                       $condition2.=' and AfcHomeVisit.block IN ('.$r['Bpc']['allocated_block'].')';
                       
                      }
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    //$condition['OR']=array('Geographical.id LIKE'=>'%'.$searchKey.'%','Geographical.ward LIKE'=>'%'.$searchKey.'%','Geographical.awc_code LIKE'=>'%'.$searchKey.'%','Geographical.awc_worker LIKE '=>'%'.$searchKey.'%','Geographical.asha_name LIKE '=>'%'.$searchKey.'%'); 
	$condition2.=' and AfcHomeVisit.id LIKE %'.$searchKey.'% || AfcHomeVisit.mobile LIKE %'.$searchKey.'% AfcHomeVisit.couple_name LIKE %'.$searchKey.'% || AfcHomeVisit.gender LIKE %'.$searchKey.'% || AfcHomeVisit.age LIKE %'.$searchKey.'% || AfcHomeVisit.sterilisation_of_month LIKE %'.$searchKey.'%';
	
	}
	
	
	
	if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(AfcHomeVisit.visit_date)>="'.$fromdate.'" and date(AfcHomeVisit.visit_date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(AfcHomeVisit.visit_date)="'.$fromdate.'"';
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
                               $condition2.=' and AfcHomeVisit.block='.$searchBlockId;
		        // $condition['VhsncAfc.block']=$searchBlockId;
		        }else {
                       //$condition='VhsncAfc.district='.$r['Dpo']['district'];
                        $condition2.=' and AfcHomeVisit.district IN ('.$r['Dpo']['district'].')';
                        }
                        if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    //$condition['OR']=array('Geographical.id LIKE'=>'%'.$searchKey.'%','Geographical.ward LIKE'=>'%'.$searchKey.'%','Geographical.awc_code LIKE'=>'%'.$searchKey.'%','Geographical.awc_worker LIKE '=>'%'.$searchKey.'%','Geographical.asha_name LIKE '=>'%'.$searchKey.'%'); 
	$condition2.=' and AfcHomeVisit.id LIKE %'.$searchKey.'% || AfcHomeVisit.mobile LIKE %'.$searchKey.'% AfcHomeVisit.couple_name LIKE %'.$searchKey.'% || AfcHomeVisit.gender LIKE %'.$searchKey.'% || AfcHomeVisit.age LIKE %'.$searchKey.'% || AfcHomeVisit.sterilisation_of_month LIKE %'.$searchKey.'%';
	
	}
	
	
	
	if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(AfcHomeVisit.visit_date)>="'.$fromdate.'" and date(AfcHomeVisit.visit_date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(AfcHomeVisit.visit_date)="'.$fromdate.'"';
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
		$condition2.=' and AfcHomeVisit.status="active"';
		$this->response->download("AfcHomeVisit.csv");
		//print_r($condition); exit;
	    $data=$this->AfcHomeVisit->query('select AfcHomeVisit.id,AfcHomeVisit.visit_date,AfcHomeVisit.asha_accompanied,AfcHomeVisit.aww_accompanied,AfcHomeVisit.pri_accompanied,AfcHomeVisit.shg_accompanied,AfcHomeVisit.couple_name,AfcHomeVisit.age,AfcHomeVisit.gender,AfcHomeVisit.mobile,r1.name as name1,r2.name as name2,r3.name as name3,r4.name as name4,r5.name as name8,c1.name as name5,c2.name as name6,c3.name as name7,AfcHomeVisit.no_of_child,AfcHomeVisit.yonger_child_age,AfcHomeVisit.commodities_regular_supply,AfcHomeVisit.contraceptives_delivery_date,AfcHomeVisit.sterilisation_of_month,AfcHomeVisit.follow_visit_date,City.name,Block.name,Panchayat.name,Village.name,Ward.name,AfcHomeVisit.status from afc_home_visits as AfcHomeVisit left join cities as City  on AfcHomeVisit.district=City.id left join blocks as Block  on AfcHomeVisit.block=Block.id left join villages as Village  on AfcHomeVisit.village=Village.id left join panchayats as Panchayat on AfcHomeVisit.panchayat=Panchayat.id left join wards as Ward on AfcHomeVisit.ward=Ward.id left join reasons r1 on AfcHomeVisit.asha_reason=r1.id left join reasons r2 on AfcHomeVisit.aww_reason=r2.id left join reasons r3 on AfcHomeVisit.pri_reason=r3.id left join reasons r4 on AfcHomeVisit.shg_reason=r4.id left join reasons r5 on AfcHomeVisit.commodities_reason=r5.id left join contraceptives c1 on AfcHomeVisit.current_contraceptives=c1.id left join contraceptives c2 on AfcHomeVisit.beneficiary_couselled=c2.id left join contraceptives c3 on AfcHomeVisit.convinced=c3.id  where 1 '.$condition2 );
		
		
		//$data = $this->Geographical->find('all', array('conditions'=>$condition2));
		
		//$log = $this->Enquiry->getDataSource()->getLog(false, false);
        //debug($log);
		//exit;
		
            $headers = array('AfcHomeVisit'=>array( 'Id' => 'Id','District' => 'District', 'Block' => 'Block','Panchayat' => 'Panchayat','Village'=>'Village','Ward'=>'Ward','Visit Date'=>'Visit Date','Is ASHA Accompanied'=>'Is ASHA Accompanied','ASHA Reason'=>'ASHA Reason','Is AWW Accompanied'=>'Is AWW Accompanied','AWW Reason'=>'AWW Reason ','Is PRI Accompanied'=>'Is PRI Accompanied','PRI Reason'=>'PRI Reason','Is SHG Accompanied'=>'Is SHG Accompanied','SHG Reason'=>'SHG Reason','Name'=>'Name','Age'=>'Age','Gender'=>'Gender','Mobile'=>'Mobile','No of child'=>'No of child','Age of younger child'=>'Age of younger child','Currently using Contraceptives'=>'Currently using Contraceptives','If spacing methods Commodities regular supplied'=>'If spacing methods Commodities regular supplied','Commodities Reason'=>'Commodities Reason','Counselled by AFC to beneficiary'=>'Counselled by AFC to beneficiary','Convinced to Opt'=>'Convinced to Opt','Date for delivery of contraceptives'=>'Date for delivery of contraceptives','Month of Sterilisation'=>'Month of Sterilisation','Follow Visit Date'=>'Follow Visit Date','Status'=>'Status')); 
	    $this->set(compact('data','headers'));
		$this->layout = 'ajax';
		return;
		
		}
  ////  reports section ---///// 
	   
	
	}
	
	
	
	
