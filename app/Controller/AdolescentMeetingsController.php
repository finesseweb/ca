<?php
App::uses('AppController', 'Controller');
/**
 * Ngos Controller
 *
 * @property Ngo $GeographicalNgo
 * @property PaginatorComponent $Paginator
 */
class AdolescentMeetingsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Upload');

    var  $uses = array('AdolescentMeeting','Youthleader','Contraceptive','VhsncConstitution','Geographical','Ngo','User','MeetingFacilitated','Village','Panchayat','Ward','Country','City','Block','Designation','VhsncAfc','Discussion','Bpccc','UseMaterial','Bpc','Dpo');
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
    $condition['OR']=array('AdolescentMeeting.id LIKE'=>'%'.$searchKey.'%','AdolescentMeeting.total_member LIKE'=>'%'.$searchKey.'%','AdolescentMeeting.group_name LIKE'=>'%'.$searchKey.'%'); 
	
	}
		
		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition['AND']=array('date(AdolescentMeeting.date) >='=>$fromdate,'date(AdolescentMeeting.date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['AdolescentMeeting.date']=$fromdate;	
				}
				
			}
		
               if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBuilderId=trim($this->request->query['block']); 
		$condition['AdolescentMeeting.block']=$searchBuilderId;
		}
		if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchPanchayatId=trim($this->request->query['panchayat']); 
		$condition['AdolescentMeeting.panchayat']=$searchPanchayatId;
		}
		
		if(isset($this->request->query['village']) and ($this->request->query['village']!=0) and ($this->request->query['village']!='')){$searchProjectId=trim($this->request->query['village']);
		$condition['AdolescentMeeting.village']=$searchProjectId;
		}
	}
        if(CakeSession::read('User.type')==='regular'){
             //echo CakeSession::read('User.subrole');
            // die();
             if(CakeSession::read('User.subrole')==='CC'){
		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'))));
                      if($r){ 
                          if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchPanchayatId=trim($this->request->query['panchayat']); 
		$condition['AdolescentMeeting.panchayat']=$searchPanchayatId;
		} else {
                      // $condition='AdolescentMeeting.panchayat='.$r['Bpccc']['allocated_panchayat'];
                       $condition=['AdolescentMeeting.panchayat IN' =>explode(',',$r['Bpccc']['allocated_panchayat'])];
                }
                if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('AdolescentMeeting.id LIKE'=>'%'.$searchKey.'%','AdolescentMeeting.total_member LIKE'=>'%'.$searchKey.'%','AdolescentMeeting.group_name LIKE'=>'%'.$searchKey.'%'); 
	
	}
		
		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition['AND']=array('date(AdolescentMeeting.date) >='=>$fromdate,'date(AdolescentMeeting.date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['AdolescentMeeting.date']=$fromdate;	
				}
				
			}
                      } 
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Village yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
			 $panchayats=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>['Panchayat.id IN'=>explode(',',$r['Bpccc']['allocated_panchayat'])]));
                   
		}
                
                 elseif(CakeSession::read('User.subrole')==='BPC'){
		   $r = $this->Bpc->find('first',array('conditions'=>array('Bpc.first_name='.CakeSession::read('User.id'))));
                      if($r){ 
                          if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBuilderId=trim($this->request->query['block']); 
		            $condition['AdolescentMeeting.block']=$searchBuilderId;
		          } else {
                       //$condition='AdolescentMeeting.block='.$r['Bpc']['allocated_block'];
                       $condition=['AdolescentMeeting.block IN' =>explode(',',$r['Bpc']['allocated_block'])];
                          }
                          if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('AdolescentMeeting.id LIKE'=>'%'.$searchKey.'%','AdolescentMeeting.total_member LIKE'=>'%'.$searchKey.'%','AdolescentMeeting.group_name LIKE'=>'%'.$searchKey.'%'); 
	
	}
		
		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition['AND']=array('date(AdolescentMeeting.date) >='=>$fromdate,'date(AdolescentMeeting.date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['AdolescentMeeting.date']=$fromdate;	
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
		            $condition['AdolescentMeeting.block']=$searchBuilderId;
		          } else {
                       $condition='AdolescentMeeting.district='.$r['Dpo']['district'];
                          }
                       if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('AdolescentMeeting.id LIKE'=>'%'.$searchKey.'%','AdolescentMeeting.total_member LIKE'=>'%'.$searchKey.'%','AdolescentMeeting.group_name LIKE'=>'%'.$searchKey.'%'); 
	
	}
		
		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition['AND']=array('date(AdolescentMeeting.date) >='=>$fromdate,'date(AdolescentMeeting.date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['AdolescentMeeting.date']=$fromdate;	
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
		         $condition['AdolescentMeeting.block']=$searchBlockId;
		        }else {
                            
                       $condition=['AdolescentMeeting.block IN' =>$blo];
                       
                      }
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('AdolescentMeeting.id LIKE'=>'%'.$searchKey.'%','AdolescentMeeting.total_member LIKE'=>'%'.$searchKey.'%','AdolescentMeeting.group_name LIKE'=>'%'.$searchKey.'%'); 
	
	}
		
		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition['AND']=array('date(AdolescentMeeting.date) >='=>$fromdate,'date(AdolescentMeeting.date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['AdolescentMeeting.date']=$fromdate;	
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
		
		$this->Paginator->settings = array('AdolescentMeeting' => array('limit' =>20,'order' => array('id' => 'desc'),'conditions'=>array($condition,'AdolescentMeeting.status'=>'active')));
		$this->AdolescentMeeting->recursive = 0;
		$this->set('adolescentmeetings', $this->Paginator->paginate());
//		$blocks=$this->Block->find('list');
//                $panchayats=$this->Panchayat->find('list');
//                $villages=$this->Village->find('list');
			
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
		if (!$this->AdolescentMeeting->exists($id)) {
			throw new NotFoundException(__('Invalid Afc Home Visit Member'));
		}
		$options = array('conditions' => array('AdolescentMeeting.' . $this->AdolescentMeeting->primaryKey => $id));
		$this->set('adolescentmeeting', $this->AdolescentMeeting->find('first', $options));
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
			$this->AdolescentMeeting->create();
                      //print_r($this->request->data);
                       
                      //die();
                           $data= $this->request->data;
                           $save=$this->AdolescentMeeting->saveAll($data);    
                         if($save) {
                               $this->Session->setFlash(__('The Adolescent Meeting has been saved.'));
				return $this->redirect(array('action' => 'index'));

                        } else {
				$this->Session->setFlash(__('The Adolescent Meeting could not be saved. Please, try again.'));
			}
                         
                    }   
                 if(CakeSession::read('User.type')==='regular'){
                     
                     if(CakeSession::read('User.subrole')==='CC'){
		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'))));
                       
                       //$condition='VhsncConstitution.village='.$r['Bpccc']['allocated_village'];
                        
			//$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
                       
	            $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Bpccc']['allocated_district'])));
                    $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id'=>$r['Bpccc']['allocated_block'])));
                    $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>['Panchayat.id IN'=>explode(',',$r['Bpccc']['allocated_panchayat'])]));
                    $village=$this->Village->find('list',array('order'=>array('name'=>'asc')));	
		}
                
                 elseif(CakeSession::read('User.subrole')==='BPC'){
		  $r = $this->Bpc->find('first',array('conditions'=>array('Bpc.first_name='.CakeSession::read('User.id'))));
                       
                       //$condition='VhsncConstitution.village='.$r['Bpccc']['allocated_village'];
                        
			//$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
                       
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
                $facilitated=$this->MeetingFacilitated->find('list');
                $topic=$this->Discussion->find('list');
                $marerial=$this->UseMaterial->find('list');
                $group=$this->Youthleader->find('list',array('group'=>array('allocated_village')));
                $vhsncmembers=$this->VhsncAfc->find('list',array('conditions'=>array('VhsncAfc.member_type'=>'VHSNC')));
		$this->set(compact('cities','group','panchayat','ngos','blocks','desig','village','ward','vhsnc','vhsncmembers','opt','facilitated','topic','marerial'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->AdolescentMeeting->exists($id)) {
			throw new NotFoundException(__('Invalid VhsncAfc'));
		}
		if ($this->request->is(array('post', 'put'))) {
                             $data=$this->request->data;
                           $save=$this->AdolescentMeeting->saveAll($data);
			if ($save) {
				$this->Session->setFlash(__('The Adolescent Meeting has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Adolescent Meeting could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('AdolescentMeeting.' . $this->AdolescentMeeting->primaryKey => $id));
			$this->request->data = $this->AdolescentMeeting->find('first', $options);
			$executives=$this->User->find('list',array('conditions'=>array('User.status'=>'active','User.role'=>'regular')));
//			
                }
                
                 if(CakeSession::read('User.type')==='regular'){
                     
                     if(CakeSession::read('User.subrole')==='CC'){
		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'))));
                       
                     
	            $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Bpccc']['allocated_district'])));
                    $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id'=>$r['Bpccc']['allocated_block'])));
                    $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>['Panchayat.id IN'=>explode(',',$r['Bpccc']['allocated_panchayat'])]));
                    if($this->request->data['AdolescentMeeting']['panchayat']!=0 and $this->request->data['AdolescentMeeting']['panchayat']!='')
			{
		     $village=$this->Village->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Village.panchayat_id'=>$this->request->data['AdolescentMeeting']['panchayat'])));
		    } 
                    else {
                       $village=$this->Village->find('list',array('order'=>array('name'=>'asc')));  
                    }
                   	
		}
                
                 elseif(CakeSession::read('User.subrole')==='BPC'){
		  $r = $this->Bpc->find('first',array('conditions'=>array('Bpc.first_name='.CakeSession::read('User.id'))));
                       
                       
	            $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Bpc']['allocated_district'])));
                    $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id IN'=>explode(',',$r['Bpc']['allocated_block']))));
                   if($this->request->data['AdolescentMeeting']['panchayat']!=0 and $this->request->data['AdolescentMeeting']['panchayat']!='')
			{
		     $village=$this->Village->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Village.panchayat_id'=>$this->request->data['AdolescentMeeting']['panchayat'])));
		    } 
                    else {
                       $village=$this->Village->find('list',array('order'=>array('name'=>'asc')));  
                    }
                    
                   if($this->request->data['AdolescentMeeting']['panchayat']!=0 and $this->request->data['AdolescentMeeting']['panchayat']!='')
			{
		     $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Panchayat.id'=>$this->request->data['AdolescentMeeting']['panchayat'])));
		    }
                    else {
                         $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'))); 
                    }
                  
                    // $village=$this->Village->find('list');
		}
                
                
                 else {
		  $r = $this->Dpo->find('first',array('conditions'=>array('Dpo.first_name='.CakeSession::read('User.id'))));
                         
	            $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Dpo']['district'])));
                    if($this->request->data['AdolescentMeeting']['block']!=0 and $this->request->data['AdolescentMeeting']['block']!='')
			{
		     $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id'=>$this->request->data['AdolescentMeeting']['block'])));
		    } 
                    else {
                     $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc')));
                    }
                   
                    if($this->request->data['AdolescentMeeting']['panchayat']!=0 and $this->request->data['AdolescentMeeting']['panchayat']!='')
			{
		     $village=$this->Village->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Village.panchayat_id'=>$this->request->data['AdolescentMeeting']['panchayat'])));
		    } 
                    else {
                       $village=$this->Village->find('list',array('order'=>array('name'=>'asc')));  
                    }
                    
                   if($this->request->data['AdolescentMeeting']['panchayat']!=0 and $this->request->data['AdolescentMeeting']['panchayat']!='')
			{
		     $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Panchayat.id'=>$this->request->data['AdolescentMeeting']['panchayat'])));
		    }
                    else {
                         $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'))); 
                    }
		}
		   }
                else {
                    $cities=$this->City->find('list',array('order'=>array('name'=>'asc')));
                    if($this->request->data['AdolescentMeeting']['block']!=0 and $this->request->data['AdolescentMeeting']['block']!='')
			{
		     $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id'=>$this->request->data['AdolescentMeeting']['block'])));
		    } 
                    else {
                     $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc')));
                    }
                   
                    if($this->request->data['AdolescentMeeting']['panchayat']!=0 and $this->request->data['AdolescentMeeting']['panchayat']!='')
			{
		     $village=$this->Village->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Village.panchayat_id'=>$this->request->data['AdolescentMeeting']['panchayat'])));
		    } 
                    else {
                       $village=$this->Village->find('list',array('order'=>array('name'=>'asc')));  
                    }
                    
                   if($this->request->data['AdolescentMeeting']['panchayat']!=0 and $this->request->data['AdolescentMeeting']['panchayat']!='')
			{
		     $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Panchayat.id'=>$this->request->data['AdolescentMeeting']['panchayat'])));
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
                // $village=$this->Village->find('list');
                $ward=$this->Ward->find('list');
                $opt=$this->Contraceptive->find('list');
                $vhsnc=$this->VhsncConstitution->find('list');
                  $facilitated=$this->MeetingFacilitated->find('list');
                $topic=$this->Discussion->find('list');
                 $marerial=$this->UseMaterial->find('list');
                 $group=$this->Youthleader->find('list',array('group'=>array('allocated_village')));
                $vhsncmembers=$this->VhsncAfc->find('list',array('conditions'=>array('VhsncAfc.member_type'=>'VHSNC')));
		$this->set(compact('cities','group','panchayat','ngos','blocks','desig','village','ward','vhsnc','vhsncmembers','opt','facilitated','topic','marerial'));
		
	}
	
	
	
/**  
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null,$status='deactive') {
		$this->AdolescentMeeting->id = $id;
		if (!$this->AdolescentMeeting->exists()) {
			throw new NotFoundException(__('Invalid Adolescent Meeting Detail'));
		}
                 if(CakeSession::read('User.type')==='regular'){
                 $menu= $this->Session->read('User.mainmenu');
                if (in_array($this->request->params['controller'].":".$this->request->params['action'], $menu)) { 
             
		    //$this->request->onlyAllow('post', 'delete');
		    $this->AdolescentMeeting->read(null,$id);
	           $this->AdolescentMeeting->set(array('status'=>$status));
		
		if ($this->AdolescentMeeting->save()) {
			$this->Session->setFlash(__('The Adolescent Meeting Detail has been '.$status));
		} else {
			$this->Session->setFlash(__('Nothing happen. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
                  } else {
                    
                    $this->requestAction(array('controller' => 'users', 'action' => 'checkRestriction'));
                }
                 } else {
                      $this->AdolescentMeeting->read(null,$id);
	           $this->AdolescentMeeting->set(array('status'=>$status));
		
		if ($this->AdolescentMeeting->save()) {
			$this->Session->setFlash(__('The Adolescent Meeting Detail has been '.$status));
		} else {
			$this->Session->setFlash(__('Nothing happen. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
                 }
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
	$condition2.=' and AdolescentMeeting.id LIKE %'.$searchKey.'% || AdolescentMeeting.total_member LIKE %'.$searchKey.'% AdolescentMeeting.group_name LIKE %'.$searchKey.'%';
	
	}
	
	
	
	if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(AdolescentMeeting.date)>="'.$fromdate.'" and date(AdolescentMeeting.date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(AdolescentMeeting.date)="'.$fromdate.'"';
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
		$condition2.=' and AdolescentMeeting.block='.$searchBlockId;
		}
		
		if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchProjectId=trim($this->request->query['panchayat']); //$condition['Enquiry.project_id']=$searchProjectId;
		$condition2.=' and AdolescentMeeting.panchayat='.$searchProjectId;
		}
               
                if(isset($this->request->query['village']) and ($this->request->query['village']!=0) and ($this->request->query['village']!='')){$searchVillageId=trim($this->request->query['village']); //$condition['Enquiry.project_id']=$searchProjectId;
		$condition2.=' and AdolescentMeeting.village='.$searchVillageId;
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
                             $condition2.=' and AdolescentMeeting.panchayat='.$searchProjectId;
		           }   else { 
                        ///$condition=['VhsncAfc.panchayat IN' =>explode(',',$r['Bpccc']['allocated_panchayat'])]; 
                         $condition2.=' and AdolescentMeeting.panchayat IN ('.$r['Bpccc']['allocated_panchayat'].')';
                      }
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    //$condition['OR']=array('Geographical.id LIKE'=>'%'.$searchKey.'%','Geographical.ward LIKE'=>'%'.$searchKey.'%','Geographical.awc_code LIKE'=>'%'.$searchKey.'%','Geographical.awc_worker LIKE '=>'%'.$searchKey.'%','Geographical.asha_name LIKE '=>'%'.$searchKey.'%'); 
	$condition2.=' and AdolescentMeeting.id LIKE %'.$searchKey.'% || AdolescentMeeting.total_member LIKE %'.$searchKey.'% AdolescentMeeting.group_name LIKE %'.$searchKey.'%';
	
	}
	
	
	
	if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(AdolescentMeeting.date)>="'.$fromdate.'" and date(AdolescentMeeting.date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(AdolescentMeeting.date)="'.$fromdate.'"';
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
		        $condition2.=' and AdolescentMeeting.block='.$searchBlockId;
		        }else {
                            
                       $condition2.=' and AdolescentMeeting.block IN ('.$r['Bpc']['allocated_block'].')';
                       
                      } 
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    //$condition['OR']=array('Geographical.id LIKE'=>'%'.$searchKey.'%','Geographical.ward LIKE'=>'%'.$searchKey.'%','Geographical.awc_code LIKE'=>'%'.$searchKey.'%','Geographical.awc_worker LIKE '=>'%'.$searchKey.'%','Geographical.asha_name LIKE '=>'%'.$searchKey.'%'); 
	$condition2.=' and AdolescentMeeting.id LIKE %'.$searchKey.'% || AdolescentMeeting.total_member LIKE %'.$searchKey.'% AdolescentMeeting.group_name LIKE %'.$searchKey.'%';
	
	}
	
	
	
	if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(AdolescentMeeting.date)>="'.$fromdate.'" and date(AdolescentMeeting.date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(AdolescentMeeting.date)="'.$fromdate.'"';
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
                               $condition2.=' and AdolescentMeeting.block='.$searchBlockId;
		        // $condition['VhsncAfc.block']=$searchBlockId;
		        }else {
                       //$condition='VhsncAfc.district='.$r['Dpo']['district'];
                        $condition2.=' and AdolescentMeeting.district IN ('.$r['Dpo']['district'].')';
                        }
                        if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    //$condition['OR']=array('Geographical.id LIKE'=>'%'.$searchKey.'%','Geographical.ward LIKE'=>'%'.$searchKey.'%','Geographical.awc_code LIKE'=>'%'.$searchKey.'%','Geographical.awc_worker LIKE '=>'%'.$searchKey.'%','Geographical.asha_name LIKE '=>'%'.$searchKey.'%'); 
	$condition2.=' and AdolescentMeeting.id LIKE %'.$searchKey.'% || AdolescentMeeting.total_member LIKE %'.$searchKey.'% AdolescentMeeting.group_name LIKE %'.$searchKey.'%';
	
	}
	
	
	
	if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(AdolescentMeeting.date)>="'.$fromdate.'" and date(AdolescentMeeting.date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(AdolescentMeeting.date)="'.$fromdate.'"';
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
		$condition2.=' and AdolescentMeeting.status="active"';
		$this->response->download("AdolescentMeeting.csv");
		//print_r($condition); exit;
	    $data=$this->AdolescentMeeting->query('select AdolescentMeeting.id,AdolescentMeeting.date,Youthleader.group_name,AdolescentMeeting.total_member,AdolescentMeeting.no_of_participants,Meetingfacilitated.name,Discussion.name,Usematerial.name,City.name,Block.name,Panchayat.name,Village.name,Ward.name,AdolescentMeeting.status from adolescent_meetings as AdolescentMeeting left join cities as City  on AdolescentMeeting.district=City.id left join blocks as Block  on AdolescentMeeting.block=Block.id left join villages as Village  on AdolescentMeeting.village=Village.id left join panchayats as Panchayat on AdolescentMeeting.panchayat=Panchayat.id left join wards as Ward on AdolescentMeeting.ward=Ward.id left join meeting_facilitateds as Meetingfacilitated on AdolescentMeeting.meeting_facilitated_by=Meetingfacilitated.id left join discussions as Discussion on AdolescentMeeting.topic_discussed=Discussion.id left join use_materials as Usematerial on AdolescentMeeting.material_used=Usematerial.id left join youthleaders as Youthleader on AdolescentMeeting.group_name=Youthleader.id where 1 '.$condition2 );
		
		
		//$data = $this->Geographical->find('all', array('conditions'=>$condition2));
		
		//$log = $this->Enquiry->getDataSource()->getLog(false, false);
        //debug($log);
		//exit;
		
            $headers = array('AdolescentMeeting'=>array( 'Id' => 'Id','District' => 'District', 'Block' => 'Block','Panchayat' => 'Panchayat','Village'=>'Village','Ward'=>'Ward','Visit Date'=>'Visit Date','Group Name'=>'Group Name','Total Member'=>'Total Member','No. of Participants'=>'No. of Participants','Meeting Facilitated By'=>'Meeting Facilitated By','Topic Discussed'=>'Topic Discussed','Material Used'=>'Material Used','Status'=>'Status')); 
	    $this->set(compact('data','headers'));
		$this->layout = 'ajax';
		return;
		
		}
  ////  reports section ---///// 
	     
	
	}
	
	
	
	
