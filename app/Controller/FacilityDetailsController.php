<?php
App::uses('AppController', 'Controller');
/**
 * FacilityDetails Controller
 *
 * @property Ngo $FacilityDetailNgo
 * @property PaginatorComponent $Paginator
 */
class FacilityDetailsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Upload');

    var  $uses = array('FacilityDetail','FacilityDetail','Ngo','User','Project','Village','Panchayat','Location','Country','City','Block','Designation','Bpccc','Bpc','Dpo');
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
    $condition['OR']=array('FacilityDetail.id LIKE'=>'%'.$searchKey.'%','FacilityDetail.health_facility_name LIKE'=>'%'.$searchKey.'%','FacilityDetail.doctor_name LIKE '=>'%'.$searchKey.'%','FacilityDetail.anm_name LIKE '=>'%'.$searchKey.'%','FacilityDetail.facility_type LIKE '=>'%'.$searchKey.'%'); 
	
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
		
		if(isset($this->request->query['organization']) and ($this->request->query['organization']!=0) and ($this->request->query['organization']!='')){$searchBuilderId=trim($this->request->query['organization']); 
		$condition['FacilityDetail.organization']=$searchBuilderId;
		}
		
		if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBlockId=trim($this->request->query['block']);
		$condition['FacilityDetail.block']=$searchBlockId;
		}
                if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchProjectId=trim($this->request->query['panchayat']);
		$condition['FacilityDetail.panchayat']=$searchProjectId;
		}
                if(isset($this->request->query['village']) and ($this->request->query['village']!=0) and ($this->request->query['village']!='')){$searchVillageId=trim($this->request->query['village']);
		$condition['FacilityDetail.village']=$searchVillageId;
		}
		
	} 
        if(CakeSession::read('User.type')==='regular'){
             //echo CakeSession::read('User.subrole');
            // die();
             if(CakeSession::read('User.subrole')==='CC'){
		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'))));
                      if($r){ 
                          if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){
                           $searchProjectId=trim($this->request->query['panchayat']);
		            $condition['FacilityDetail.panchayat']=$searchProjectId;
		           }   else { 
                        $condition=['FacilityDetail.panchayat IN' =>explode(',',$r['Bpccc']['allocated_panchayat'])]; 
                        
                      }
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('FacilityDetail.id LIKE'=>'%'.$searchKey.'%','FacilityDetail.health_facility_name LIKE'=>'%'.$searchKey.'%','FacilityDetail.doctor_name LIKE '=>'%'.$searchKey.'%','FacilityDetail.anm_name LIKE '=>'%'.$searchKey.'%','FacilityDetail.facility_type LIKE '=>'%'.$searchKey.'%'); 
	
	}
                      }
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Village yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
	            //$blocks=$this->Block->find('list',array('conditions'=>array('Block.id'=>$r['Bpccc']['allocated_block'])));
                    $panchayats=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>['Panchayat.id IN'=>explode(',',$r['Bpccc']['allocated_panchayat'])]));
                   	
		}
                
                 elseif(CakeSession::read('User.subrole')==='BPC'){
		   $r = $this->Bpc->find('first',array('conditions'=>array('Bpc.first_name='.CakeSession::read('User.id'))));
                      if($r){ 
                          if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){
                        $searchBlockId=trim($this->request->query['block']);
		         $condition['FacilityDetail.block']=$searchBlockId;
		        }else {
                       $condition=['FacilityDetail.block IN' =>explode(',',$r['Bpc']['allocated_block'])];
                       
                      }
                       if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('FacilityDetail.id LIKE'=>'%'.$searchKey.'%','FacilityDetail.health_facility_name LIKE'=>'%'.$searchKey.'%','FacilityDetail.doctor_name LIKE '=>'%'.$searchKey.'%','FacilityDetail.anm_name LIKE '=>'%'.$searchKey.'%','FacilityDetail.facility_type LIKE '=>'%'.$searchKey.'%'); 
	
	}
                      }
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Block yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
		     $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id IN'=>explode(',',$r['Bpc']['allocated_block']))));
                   //$villages=$this->Village->find('list');
                   //$panchayats=$this->Panchayat->find('list');
                    $condition2['OR']=array('Ngo.allocated_block_one'=>explode(',',$r['Bpc']['allocated_block']),'Ngo.allocated_block_two'=>explode(',',$r['Bpc']['allocated_block'])); 
                    $ngos=$this->Ngo->find('list',array('conditions'=>$condition2));
                    
		}
                
                
                 else {
		   $r = $this->Dpo->find('first',array('conditions'=>array('Dpo.first_name='.CakeSession::read('User.id'))));
                      if($r){
                          if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){
                        $searchBlockId=trim($this->request->query['block']);
		         $condition['FacilityDetail.block']=$searchBlockId;
		        } 
                        else {  
                       $condition='FacilityDetail.district='.$r['Dpo']['district'];
                        }
                         if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('FacilityDetail.id LIKE'=>'%'.$searchKey.'%','FacilityDetail.health_facility_name LIKE'=>'%'.$searchKey.'%','FacilityDetail.doctor_name LIKE '=>'%'.$searchKey.'%','FacilityDetail.anm_name LIKE '=>'%'.$searchKey.'%','FacilityDetail.facility_type LIKE '=>'%'.$searchKey.'%'); 
	
	}
                      } 
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Village yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
		    $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.city_id IN'=>explode(',',$r['Dpo']['district']))));
                     $ngos=$this->Ngo->find('list',array('conditions'=>array('Ngo.allocated_district IN'=>explode(',',$r['Dpo']['district']))));
                     
		}
         }
         else if(CakeSession::read('User.type')==='user'){
	   $r = $this->Ngo->find('first',array('conditions'=>array('Ngo.chief_functionary_name='.CakeSession::read('User.id'))));
                 if($r){
                     $blo=array();
                   $blo= [$r['Ngo']['allocated_block_one'],$r['Ngo']['allocated_block_two']];
                     if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){
                              $searchBlockId=trim($this->request->query['block']);
		         $condition['FacilityDetail.block']=$searchBlockId;
		        }else {
                            
                       $condition=['FacilityDetail.block IN' =>$blo];
                       
                      }
                       if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('FacilityDetail.id LIKE'=>'%'.$searchKey.'%','FacilityDetail.health_facility_name LIKE'=>'%'.$searchKey.'%','FacilityDetail.doctor_name LIKE '=>'%'.$searchKey.'%','FacilityDetail.anm_name LIKE '=>'%'.$searchKey.'%','FacilityDetail.facility_type LIKE '=>'%'.$searchKey.'%'); 
	
	}
		}
                 $blocks=$this->Block->find('list',array('order' => array('name' => 'asc'),'conditions'=>array('Block.id IN'=>$blo)));
                 $ngos=$this->Ngo->find('list',array('conditions'=>array('Ngo.id'=>$r['Ngo']['id'])));
                     
         }
         else {
             $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc')));
             $panchayats=$this->Panchayat->find('list',array('order'=>array('name'=>'asc')));
              $villages=$this->Village->find('list',array('order'=>array('name'=>'asc')));
              $ngos=$this->Ngo->find('list');
             
         }
		
		$this->Paginator->settings = array('FacilityDetail' => array('limit' =>20,'order' => array('id' => 'desc'),'conditions'=>array($condition,'FacilityDetail.status'=>'active')));
		$this->FacilityDetail->recursive = 0;
		$this->set('geographicals', $this->Paginator->paginate());
		//$blocks=$this->Block->find('list');
		//$panchayats=$this->Panchayat->find('list');
		//$villages=$this->Village->find('list');
               // $ngos=$this->Ngo->find('list');
			
//			$users = $this->User->find('list',array('fields'=>array('parent'),'conditions'=>array('status'=>'active')));
//			$builders=$this->Builder->find('list');
			$this->set(compact('users','blocks','panchayats','villages','ngos'));
			
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->FacilityDetail->exists($id)) {
			throw new NotFoundException(__('Invalid FacilityDetail'));
		}
		$options = array('conditions' => array('FacilityDetail.' . $this->FacilityDetail->primaryKey => $id));
		$this->set('geographical', $this->FacilityDetail->find('first', $options));
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
			$this->FacilityDetail->create();
                        //print_r($this->request->data);
                       //die();
                       for($i=0;$i<count($this->request->data['FacilityDetail']['anm_name']);$i++){
                           
                          
                            $district =  $this->request->data['FacilityDetail']['district'];
                            $block =  $this->request->data['FacilityDetail']['block'];
                            $panchayat =  $this->request->data['FacilityDetail']['panchayat'];
                            $village =  $this->request->data['FacilityDetail']['village'];
                            $organization=  $this->request->data['FacilityDetail']['organization']; 
                            $health_facility_name =  $this->request->data['FacilityDetail']['health_facility_name'];
                            $facility_type =  $this->request->data['FacilityDetail']['facility_type'];
                            $health_facility_place =  $this->request->data['FacilityDetail']['health_facility_place'];
                            $functionality =  $this->request->data['FacilityDetail']['functionality'];
                            $doctor_name=  $this->request->data['FacilityDetail']['doctor_name'];
                            $doctor_mobile=  $this->request->data['FacilityDetail']['doctor_mobile'];
                            $remarks=  $this->request->data['FacilityDetail']['remarks'];
                            $anm_name=  $this->request->data['FacilityDetail']['anm_name'][$i];
                            $anm_mobile=  $this->request->data['FacilityDetail']['anm_mobile'][$i];
                          
                            $data=array(
                                
                                	'organization'=>$organization,
                                	'district'=>$district,
                                        'block'=>$block,
                                	'panchayat'=>$panchayat,
                                        'village'=>$village,
                                	'health_facility_name'=>$health_facility_name,
                                	'facility_type'=>$facility_type,
                                	'health_facility_place'=>$health_facility_place,
                                        'functionality'=>$functionality,
                                	'doctor_name'=>$doctor_name,
                                	'doctor_mobile'=>$doctor_mobile,
                                        'anm_name'=>$remarks,
                                        'anm_mobile'=>$anm_name,
                                	'remarks'=>$anm_mobile
                            );
                           
                            $save=$this->FacilityDetail->saveAll($data);
                       }
			if ($save) {
				$this->Session->setFlash(__('The Facility Detail has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Facility Detail could not be saved. Please, try again.'));
			}
		}
                if(CakeSession::read('User.type')==='regular'){
                     
                     if(CakeSession::read('User.subrole')==='CC'){
		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'))));
                       
                     
	            $cities=$this->City->find('list',array('conditions'=>array('City.id'=>$r['Bpccc']['allocated_district'])));
                    $blocks=$this->Block->find('list',array('conditions'=>array('Block.id'=>$r['Bpccc']['allocated_block'])));
                    $panchayat=$this->Panchayat->find('list',array('conditions'=>['Panchayat.id IN'=>explode(',',$r['Bpccc']['allocated_panchayat'])]));
                    $condition['OR']=array('Ngo.allocated_block_one'=>$r['Bpccc']['allocated_block'],'Ngo.allocated_block_two'=>$r['Bpccc']['allocated_block']); 

                    $ngos=$this->Ngo->find('list',array('conditions'=>$condition));
// print_r($panchayat);
                    //die();
                    $village=$this->Village->find('list');	
		}
                
                 elseif(CakeSession::read('User.subrole')==='BPC'){
		  $r = $this->Bpc->find('first',array('conditions'=>array('Bpc.first_name='.CakeSession::read('User.id'))));
                       
                     
	            $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Bpc']['allocated_district'])));
                    $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id IN'=>explode(',',$r['Bpc']['allocated_block']))));
                   
                    $condition['OR']=array('Ngo.allocated_block_one'=>explode(',',$r['Bpc']['allocated_block']),'Ngo.allocated_block_two'=>explode(',',$r['Bpc']['allocated_block'])); 
                    $ngos=$this->Ngo->find('list',array('conditions'=>$condition));
                    
                    $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc')));
                    $village=$this->Village->find('list',array('order'=>array('name'=>'asc')));
                  
		}
                
                
                 else {
		  $r = $this->Dpo->find('first',array('conditions'=>array('Dpo.first_name='.CakeSession::read('User.id'))));
                         
	            $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Dpo']['district'])));
                   $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc')));
                    $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc')));
                    $village=$this->Village->find('list',array('order'=>array('name'=>'asc')));
                    $ngos=$this->Ngo->find('list',array('conditions'=>array('Ngo.allocated_district'=>$r['Dpo']['district'])));
		}
		   }
                else {
                    $cities=$this->City->find('list',array('order'=>array('name'=>'asc')));
                    $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc')));
                    $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc')));
                    $village=$this->Village->find('list',array('order'=>array('name'=>'asc')));
                    $ngos=$this->Ngo->find('list');
                }
		//$executives=$this->User->find('list',array('conditions'=>array('User.status'=>'active','User.role'=>'regular')));
		//$cities=$this->City->find('list');
                $desig=$this->Designation->find('list');
		//$blocks=$this->Block->find('list');
		//$ngos=$this->Ngo->find('list');
               // $panchayat=$this->Panchayat->find('list');
                //$village=$this->Village->find('list');
		$this->set(compact('panchayat','cities','ngos','blocks','desig','village'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->FacilityDetail->exists($id)) {
			throw new NotFoundException(__('Invalid booking'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->FacilityDetail->save($this->request->data)) {
				$this->Session->setFlash(__('The Facility Detail has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Facility Detail could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('FacilityDetail.' . $this->FacilityDetail->primaryKey => $id));
			$this->request->data = $this->FacilityDetail->find('first', $options);
                }
                
                 if(CakeSession::read('User.type')==='regular'){
                     
                     if(CakeSession::read('User.subrole')==='CC'){
		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'))));
                       
                     
	            $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Bpccc']['allocated_district'])));
                    $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id'=>$r['Bpccc']['allocated_block'])));
                    $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>['Panchayat.id IN'=>explode(',',$r['Bpccc']['allocated_panchayat'])]));
                   // print_r($panchayat);
                    //die();
                    if($this->request->data['FacilityDetail']['panchayat']!=0 and $this->request->data['FacilityDetail']['panchayat']!='')
			{
				$village=$this->Village->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Village.panchayat_id'=>$this->request->data['FacilityDetail']['panchayat'])));
				}
                                else {
                    $village=$this->Village->find('list',array('order'=>array('name'=>'asc')));
                    
                                }
                                
                                
                     if($this->request->data['FacilityDetail']['organization']!=0 and $this->request->data['FacilityDetail']['organization']!='')
			{
				$ngos=$this->Ngo->find('list',array('conditions'=>array('Ngo.id'=>$this->request->data['FacilityDetail']['organization'])));
			}
                     else {
                    $condition['OR']=array('Ngo.allocated_block_one'=>$r['Bpccc']['allocated_block'],'Ngo.allocated_block_two'=>$r['Bpccc']['allocated_block']); 

                    $ngos=$this->Ngo->find('list',array('conditions'=>$condition));
                    
                      } 
		}
                
                 elseif(CakeSession::read('User.subrole')==='BPC'){
		  $r = $this->Bpc->find('first',array('conditions'=>array('Bpc.first_name='.CakeSession::read('User.id'))));
                       
                     
	            $cities=$this->City->find('list',array('conditions'=>array('City.id'=>$r['Bpc']['allocated_district'])));
                    $blocks=$this->Block->find('list',array('conditions'=>array('Block.id IN'=>explode(',',$r['Bpc']['allocated_block']))));
                     if($this->request->data['FacilityDetail']['panchayat']!=0 and $this->request->data['FacilityDetail']['panchayat']!='')
			{
		     $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Panchayat.id'=>$this->request->data['FacilityDetail']['panchayat'])));
				}
                                else {
                      $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc')));
                    
                                }
                   
                    
                     if($this->request->data['FacilityDetail']['panchayat']!=0 and $this->request->data['FacilityDetail']['panchayat']!='')
			{
				$village=$this->Village->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Village.panchayat_id'=>$this->request->data['FacilityDetail']['panchayat'])));
			}
                     else {
                      $village=$this->Village->find('list',array('order'=>array('name'=>'asc')));
                      }
                      
                      if($this->request->data['FacilityDetail']['organization']!=0 and $this->request->data['FacilityDetail']['organization']!='')
			{
				$ngos=$this->Ngo->find('list',array('conditions'=>array('Ngo.id'=>$this->request->data['FacilityDetail']['organization'])));
			}
                     else {
                   $condition['OR']=array('Ngo.allocated_block_one'=>explode(',',$r['Bpc']['allocated_block']),'Ngo.allocated_block_two'=>explode(',',$r['Bpc']['allocated_block'])); 
                    $ngos=$this->Ngo->find('list',array('conditions'=>$condition));
                    
                      } 
		}
                
                
                 else {
		  $r = $this->Dpo->find('first',array('conditions'=>array('Dpo.first_name='.CakeSession::read('User.id'))));
                         
	            $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Dpo']['district'])));
                    
                     if($this->request->data['FacilityDetail']['block']!=0 and $this->request->data['FacilityDetail']['block']!='')
			{
		     $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id'=>$this->request->data['FacilityDetail']['block'])));
				}
                                else {
                       $blocks=$this->Block->find('list');
                    
                                }
                  
                    if($this->request->data['FacilityDetail']['panchayat']!=0 and $this->request->data['FacilityDetail']['panchayat']!='')
			{
		     $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Panchayat.id'=>$this->request->data['FacilityDetail']['panchayat'])));
				}
                                else {
                      $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc')));
                    
                                }
                   
                    
                     if($this->request->data['FacilityDetail']['panchayat']!=0 and $this->request->data['FacilityDetail']['panchayat']!='')
			{
				$village=$this->Village->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Village.panchayat_id'=>$this->request->data['FacilityDetail']['panchayat'])));
			}
                     else {
                      $village=$this->Village->find('list',array('order'=>array('name'=>'asc')));
                      }
                      
                      if($this->request->data['FacilityDetail']['organization']!=0 and $this->request->data['FacilityDetail']['organization']!='')
			{
				$ngos=$this->Ngo->find('list',array('conditions'=>array('Ngo.id'=>$this->request->data['FacilityDetail']['organization'])));
			}
                     else {
                    $ngos=$this->Ngo->find('list',array('conditions'=>array('Ngo.allocated_district'=>$r['Dpo']['district'])));
		
                      } 
		}
		   }
                else {
                    
                    if($this->request->data['FacilityDetail']['district']!=0 and $this->request->data['FacilityDetail']['district']!='')
			{
		     $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$this->request->data['FacilityDetail']['district'])));
				}
                                else {
                     $cities=$this->City->find('list');
                    
                                }
                    if($this->request->data['FacilityDetail']['block']!=0 and $this->request->data['FacilityDetail']['block']!='')
			{
		     $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id'=>$this->request->data['FacilityDetail']['block'])));
				}
                                else {
                       $blocks=$this->Block->find('list');
                    
                                }
                  
                    if($this->request->data['FacilityDetail']['panchayat']!=0 and $this->request->data['FacilityDetail']['panchayat']!='')
			{
		     $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Panchayat.id'=>$this->request->data['FacilityDetail']['panchayat'])));
				}
                                else {
                      $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc')));
                    
                                }
                   
                    
                     if($this->request->data['FacilityDetail']['panchayat']!=0 and $this->request->data['FacilityDetail']['panchayat']!='')
			{
				$village=$this->Village->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Village.panchayat_id'=>$this->request->data['FacilityDetail']['panchayat'])));
			}
                     else {
                      $village=$this->Village->find('list',array('order'=>array('name'=>'asc')));
                      } 
                      
                       if($this->request->data['FacilityDetail']['organization']!=0 and $this->request->data['FacilityDetail']['organization']!='')
			{
				$ngos=$this->Ngo->find('list',array('conditions'=>array('Ngo.id'=>$this->request->data['FacilityDetail']['organization'])));
			}
                     else {
                     $ngos=$this->Ngo->find('list');
                      } 
                }
                    
	        //$cities=$this->City->find('list');
                $desig=$this->Designation->find('list');
		//$blocks=$this->Block->find('list');
		//$ngos=$this->Ngo->find('list');
                //$panchayat=$this->Panchayat->find('list');
                //$village=$this->Village->find('list');
		$this->set(compact('panchayat','cities','ngos','blocks','desig','village'));
		
	}
	
	
	
/**  
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null,$status='deactive') {
		$this->FacilityDetail->id = $id;
		if (!$this->FacilityDetail->exists()) {
			throw new NotFoundException(__('Invalid Facility Detail'));
		}
                 if(CakeSession::read('User.type')==='regular'){
                  $menu= $this->Session->read('User.mainmenu');
                if (in_array($this->request->params['controller'].":".$this->request->params['action'], $menu)) { 
             
		    //$this->request->onlyAllow('post', 'delete');
		    $this->FacilityDetail->read(null,$id);
			$this->FacilityDetail->set(array('status'=>$status));
		
		if ($this->FacilityDetail->save()) {
			$this->Session->setFlash(__('The Facility has been '.$status));
		} else {
			$this->Session->setFlash(__('Nothing happen. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
                 } else {
                    
                    $this->requestAction(array('controller' => 'users', 'action' => 'checkRestriction'));
                }
                 } else {
                     $this->FacilityDetail->read(null,$id);
			$this->FacilityDetail->set(array('status'=>$status));
		
		if ($this->FacilityDetail->save()) {
			$this->Session->setFlash(__('The Facility has been '.$status));
		} else {
			$this->Session->setFlash(__('Nothing happen. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index')); 
                 }
	}
	
	
	
	
	
	public function getall() {
	
		$subcatlist=$this->FacilityDetail->find('all');
		
		return $subcatlist;
	}
        
        
        public function getalltype($id) {
	
		$subcatlist=$this->FacilityDetail->find('all',array('conditions'=>array('FacilityDetail.id'=>$id)));
		
		return $subcatlist;
	}
	
	 public function getAnm($id=null) {
	
		  $this->layout='ajax';
        $this->autoRender = false; 
		  $data= "<option>--Select--</option>";
          $subcatlist=$this->FacilityDetail->find('all',array('conditions'=>array('FacilityDetail.village'=>$id)));
		
            foreach($subcatlist as $key=>$value) {
               $data.= '<option value="'.$value['FacilityDetail']['id'].'">'.$value['FacilityDetail']['anm_name'].'</option>';
            }
            
            return $data;
	}
        
        
         public function getfacility($id=null) {
	
		  $this->layout='ajax';
        $this->autoRender = false; 
		  $data= "<option>--Select--</option>";
          $subcatlist=$this->FacilityDetail->find('list',array('conditions'=>array('FacilityDetail.panchayat'=>$id)));
		
            foreach($subcatlist as $key=>$value) {
               $data.= '<option value="'.$key.'">'.$value.'</option>';
            }
            
            return $data;
	}
        
        
        
         public function gettype($id=null) {
	
		  $this->layout='ajax';
        $this->autoRender = false; 
		  $data= "<option>--Select--</option>";
          $subcatlist=$this->FacilityDetail->find('all',array('conditions'=>array('FacilityDetail.id'=>$id)));
		
            foreach($subcatlist as $key=>$value) {
               $data.= '<option value="'.$value['FacilityDetail']['id'].'">'.$value['FacilityDetail']['facility_type'].'</option>';
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
    //$condition['OR']=array('FacilityDetail.id LIKE'=>'%'.$searchKey.'%','FacilityDetail.ward LIKE'=>'%'.$searchKey.'%','FacilityDetail.awc_code LIKE'=>'%'.$searchKey.'%','FacilityDetail.awc_worker LIKE '=>'%'.$searchKey.'%','FacilityDetail.asha_name LIKE '=>'%'.$searchKey.'%'); 
	$condition2.=' and FacilityDetail.id LIKE %'.$searchKey.'% || FacilityDetail.health_facility_name LIKE %'.$searchKey.'% || FacilityDetail.doctor_name LIKE %'.$searchKey.'% || FacilityDetail.anm_name LIKE %'.$searchKey.'% || FacilityDetail.facility_type LIKE %'.$searchKey.'%';
	
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
		$condition2.=' and FacilityDetail.organization='.$searchBuilderId;
		
		}
		
		if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBlockId=trim($this->request->query['block']); //$condition['Enquiry.builder_id']=$searchBuilderId;
		$condition2.=' and FacilityDetail.block='.$searchBlockId;
		}
		
		if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchProjectId=trim($this->request->query['panchayat']); //$condition['Enquiry.project_id']=$searchProjectId;
		$condition2.=' and FacilityDetail.panchayat='.$searchProjectId;
		}
               
                if(isset($this->request->query['village']) and ($this->request->query['village']!=0) and ($this->request->query['village']!='')){$searchVillageId=trim($this->request->query['village']); //$condition['Enquiry.project_id']=$searchProjectId;
		$condition2.=' and FacilityDetail.village='.$searchVillageId;
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
		          //  $condition['FacilityDetail.panchayat']=$searchProjectId;
                             $condition2.=' and FacilityDetail.panchayat='.$searchProjectId;
		           }   else { 
                        ///$condition=['FacilityDetail.panchayat IN' =>explode(',',$r['Bpccc']['allocated_panchayat'])]; 
                         $condition2.=' and FacilityDetail.panchayat IN ('.$r['Bpccc']['allocated_panchayat'].')';
                      }
                       if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('FacilityDetail.id LIKE'=>'%'.$searchKey.'%','FacilityDetail.health_facility_name LIKE'=>'%'.$searchKey.'%','FacilityDetail.doctor_name LIKE '=>'%'.$searchKey.'%','FacilityDetail.anm_name LIKE '=>'%'.$searchKey.'%','FacilityDetail.facility_type LIKE '=>'%'.$searchKey.'%'); 
	
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
		        $condition2.=' and FacilityDetail.block='.$searchBlockId;
		        }else {
                            
                       $condition2.=' and FacilityDetail.block IN ('.$r['Bpc']['allocated_block'].')';
                       
                      }
                       if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('FacilityDetail.id LIKE'=>'%'.$searchKey.'%','FacilityDetail.health_facility_name LIKE'=>'%'.$searchKey.'%','FacilityDetail.doctor_name LIKE '=>'%'.$searchKey.'%','FacilityDetail.anm_name LIKE '=>'%'.$searchKey.'%','FacilityDetail.facility_type LIKE '=>'%'.$searchKey.'%'); 
	
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
                               $condition2.=' and FacilityDetail.block='.$searchBlockId;
		        // $condition['FacilityDetail.block']=$searchBlockId;
		        }else {
                       //$condition='FacilityDetail.district='.$r['Dpo']['district'];
                        $condition2.=' and FacilityDetail.district IN ('.$r['Dpo']['district'].')';
                        }
                         if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('FacilityDetail.id LIKE'=>'%'.$searchKey.'%','FacilityDetail.health_facility_name LIKE'=>'%'.$searchKey.'%','FacilityDetail.doctor_name LIKE '=>'%'.$searchKey.'%','FacilityDetail.anm_name LIKE '=>'%'.$searchKey.'%','FacilityDetail.facility_type LIKE '=>'%'.$searchKey.'%'); 
	
	}
                      } 
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Village yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
			$blocks=$this->Block->find('list',array('order' => array('name' => 'asc'),'conditions'=>array('Block.city_id IN'=>explode(',',$r['Dpo']['district']))));
                     $ngos=$this->Ngo->find('list',array('conditions'=>array('Ngo.allocated_district IN'=>explode(',',$r['Dpo']['district']))));
                     
		}
         }
		else {
		
		}
		}
		//$condition['NOT']=array('Enquiry.status'=>"trash");
		$condition2.=' and FacilityDetail.status="active"';
		$this->response->download("FacilityDetail.csv");
		//print_r($condition); exit;
		$data=$this->FacilityDetail->query('select FacilityDetail.id,FacilityDetail.health_facility_name,FacilityDetail.facility_type,FacilityDetail.health_facility_place,FacilityDetail.functionality,FacilityDetail.doctor_name,FacilityDetail.doctor_mobile,FacilityDetail.anm_name,FacilityDetail.anm_mobile,FacilityDetail.status,City.name,Block.name,Panchayat.name,Village.name from facility_details as FacilityDetail left join cities as City  on FacilityDetail.district=City.id left join blocks as Block  on FacilityDetail.block=Block.id left join panchayats as Panchayat  on FacilityDetail.panchayat=Panchayat.id left join  villages as Village on FacilityDetail.village=Village.id where 1 '.$condition2 );
		
		
		//$data = $this->FacilityDetail->find('all', array('conditions'=>$condition2));
		
		//$log = $this->Enquiry->getDataSource()->getLog(false, false);
        //debug($log);
		//exit;
		
            $headers = array('FacilityDetail'=>array( 'Id' => 'Id', 'District' => 'District', 'Block' => 'Block', 'Panchayat' => 'Panchayat','Village' => 'Village','Health Facility Name'=>'Health Facility Name','Facility Type'=>'Facility Type','Health Facility Place'=>'Health Facility Place','Functionality'=>'Functionality','Doctor Name'=>'Doctor Name', 'Doctor Mobile' => 'Doctor Mobile','ANM Name' => 'ANM Name', 'ANM Mobile' => 'ANM Mobile','Status' => 'Status')); 
	    $this->set(compact('data','headers'));
		$this->layout = 'ajax';
		return;
		
		}
  ////  reports section ---/////   

	}
	
	
	
	
