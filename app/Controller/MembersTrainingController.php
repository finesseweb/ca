<?php
App::uses('AppController', 'Controller');
/**
 * Ngos Controller
 *
 * @property Ngo $GeographicalNgo
 * @property PaginatorComponent $Paginator
 */
class MembersTrainingController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Upload');

    var  $uses = array('MembersTraining','VhsncConstitution','Geographical','Ngo','User','Project','Village','Panchayat','Ward','Country','City','Block','Designation','VhsncAfc','Bpccc','Bpc','Dpo');
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
    $condition['OR']=array('MembersTraining.id LIKE'=>'%'.$searchKey.'%','MembersTraining.member_mobile LIKE'=>'%'.$searchKey.'%','MembersTraining.member_name LIKE'=>'%'.$searchKey.'%','MembersTraining.members_type LIKE'=>'%'.$searchKey.'%'); 
	
	}
		
		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition['AND']=array('date(MembersTraining.from_date) >='=>$fromdate,'date(MembersTraining.from_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim($this->request->query['from_date']);  
				$condition['MembersTraining.from_date']=$fromdate;	
				}
				
			}
		
                if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBuilderId=trim($this->request->query['block']); 
		$condition['MembersTraining.block']=$searchBuilderId;
		}
		if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchPanchayatId=trim($this->request->query['panchayat']); 
		$condition['MembersTraining.panchayat']=$searchPanchayatId;
		}
		
		if(isset($this->request->query['village']) and ($this->request->query['village']!=0) and ($this->request->query['village']!='')){$searchProjectId=trim($this->request->query['village']);
		$condition['MembersTraining.village']=$searchProjectId;
		}
	}
		 if(CakeSession::read('User.type')==='regular'){
             //echo CakeSession::read('User.subrole');
            // die();
             if(CakeSession::read('User.subrole')==='CC'){
		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'))));
                      if($r){ 
                          if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchPanchayatId=trim($this->request->query['panchayat']); 
		$condition['MembersTraining.panchayat']=$searchPanchayatId;
		} else {
                      // $condition='VhsncFeedback.panchayat='.$r['Bpccc']['allocated_panchayat'];
                        $condition=['MembersTraining.panchayat IN' =>explode(',',$r['Bpccc']['allocated_panchayat'])];
                }
                if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('MembersTraining.id LIKE'=>'%'.$searchKey.'%','MembersTraining.member_mobile LIKE'=>'%'.$searchKey.'%','MembersTraining.member_name LIKE'=>'%'.$searchKey.'%','MembersTraining.members_type LIKE'=>'%'.$searchKey.'%'); 
	
	}
		
		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition['AND']=array('date(MembersTraining.from_date) >='=>$fromdate,'date(MembersTraining.from_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim($this->request->query['from_date']);  
				$condition['MembersTraining.from_date']=$fromdate;	
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
		$condition['MembersTraining.block']=$searchBuilderId;
		} else {
                       //$condition='VhsncFeedback.block='.$r['Bpc']['allocated_block'];
                       $condition=['MembersTraining.block IN' =>explode(',',$r['Bpc']['allocated_block'])];
                }
                if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('MembersTraining.id LIKE'=>'%'.$searchKey.'%','MembersTraining.member_mobile LIKE'=>'%'.$searchKey.'%','MembersTraining.member_name LIKE'=>'%'.$searchKey.'%','MembersTraining.members_type LIKE'=>'%'.$searchKey.'%'); 
	
	}
		
		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition['AND']=array('date(MembersTraining.from_date) >='=>$fromdate,'date(MembersTraining.from_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim($this->request->query['from_date']);  
				$condition['MembersTraining.from_date']=$fromdate;	
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
		$condition['MembersTraining.block']=$searchBuilderId;
		}  else {
                       $condition='MembersTraining.district='.$r['Dpo']['district'];
                }
                       if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('MembersTraining.id LIKE'=>'%'.$searchKey.'%','MembersTraining.member_mobile LIKE'=>'%'.$searchKey.'%','MembersTraining.member_name LIKE'=>'%'.$searchKey.'%','MembersTraining.members_type LIKE'=>'%'.$searchKey.'%'); 
	
	}
		
		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition['AND']=array('date(MembersTraining.from_date) >='=>$fromdate,'date(MembersTraining.from_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim($this->request->query['from_date']);  
				$condition['MembersTraining.from_date']=$fromdate;	
				}
				
			}
                      } 
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Village yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
			//$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
		$panchayats=$this->Panchayat->find('list',array('order'=>array('name'=>'asc')));
                $villages=$this->Village->find('list',array('order'=>array('name'=>'asc')));
                //$wards=$this->Ward->find('list');
                $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc')));	
		}
         }
         else {
                $panchayats=$this->Panchayat->find('list',array('order'=>array('name'=>'asc')));
                $villages=$this->Village->find('list',array('order'=>array('name'=>'asc')));
               // $wards=$this->Ward->find('list');
                $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc')));
         }
		$this->Paginator->settings = array('MembersTraining' => array('limit' =>20,'group'=>array('MembersTraining.from_date','MembersTraining.panchayat'),'order' => array('id' => 'desc'),'conditions'=>array($condition,'MembersTraining.status'=>'active')));
		$this->MembersTraining->recursive = 0;
		$this->set('vhsncs', $this->Paginator->paginate());
		//$blocks=$this->Block->find('list');
                //$panchayats=$this->Panchayat->find('list');
                //$villages=$this->Village->find('list');
			
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
		if (!$this->MembersTraining->exists($id)) {
			throw new NotFoundException(__('Invalid VHSNC Member'));
		}
		$options = array('conditions' => array('MembersTraining.' . $this->MembersTraining->primaryKey => $id));
		$this->set('vhsnc', $this->MembersTraining->find('first', $options));
		$this->layout='newdefault';
	}
	
	
	public function viewdetails($id = null) {
		
		$r = explode(",",$id);
                
              $options = array('conditions' => array('MembersTraining.from_date' => $r[0],'MembersTraining.panchayat' =>$r[1]));
		$this->set('vhsncs', $this->MembersTraining->find('all', $options));
		$this->layout='newdefault';
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {




		if ($this->request->is('post')) {
			$this->MembersTraining->create();
                     // print_r($this->request->data);
                       
                       // echo count($this->request->data['VhsncAfc']['member_name']);
                        //die();
                         for($i=0;$i<count($this->request->data['MembersTraining']['member_name']);$i++){
                            $district =  $this->request->data['MembersTraining']['district'];
                            $block =  $this->request->data['MembersTraining']['block'];
                            $panchayat =  $this->request->data['MembersTraining']['panchayat'];
                            $village =  $this->request->data['MembersTraining']['village'];
                            //$ward =  $this->request->data['MembersTraining']['ward'];
                            //$vhsnc_name =  $this->request->data['MembersTraining']['vhsnc_name'];
                            //$total_members=  $this->request->data['MembersTraining']['total_members'];
                             $member_name= $this->request->data['MembersTraining']['member_name'][$i];
                           // $member_name =  $this->request->data['MembersTraining']['member_name'];
                             $mobile =  $this->request->data['MembersTraining']['member_mobile'][$i];
                            //$designation=  $this->request->data['MembersTraining']['designation'];
                            //$vhsnc_desig =  $this->request->data['MembersTraining']['vhsnc_desig'];
                            $members_type=  $this->request->data['MembersTraining']['members_type'][$i];
                            $from_date =  date('Y-m-d',strtotime($this->request->data['MembersTraining']['from_date']));
                            $to_date =  date('Y-m-d',strtotime($this->request->data['MembersTraining']['to_date']));
                            $remarks =  $this->request->data['MembersTraining']['remarks'][$i];
                           
                    $data=array (
                                'district'=>$district,
                                'block'=>$block,
                                'panchayat' =>$panchayat,
                                'village' =>$village,
                                //'ward'=>$ward,
                                //'vhsnc_name'=> $vhsnc_name,
                                'member_name'=>$member_name,
                                'member_mobile'=>$mobile,
                                //'designation'=>$designation,
                                //'vhsnc_desig'=>$vhsnc_desig,
                                'members_type' =>$members_type,
                                'from_date' =>$from_date,
                                'to_date'=>$to_date,
                                'remarks'=>$remarks ,
                                'updated'=>0 
                                );  
                            
                           $save=$this->MembersTraining->saveAll($data);
				
                       }///} } }   
                         
                             
                         if($save) {
                             
                      
                               $this->Session->setFlash(__('The VHSNC Member has been saved.'));
				return $this->redirect(array('action' => 'index'));

                        } else {
				$this->Session->setFlash(__('The VHSNC Member could not be saved. Please, try again.'));
			
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
		
                $desig=$this->Designation->find('list');
		$ngos=$this->Ngo->find('list');
                $ward=$this->Ward->find('list');
                $vhsnc=$this->VhsncConstitution->find('list');
                $vhsncmembers=$this->VhsncAfc->find('list',array('conditions'=>array('VhsncAfc.member_type'=>'VHSNC')));
		$this->set(compact('cities','panchayat','ngos','blocks','desig','village','ward','vhsnc','vhsncmembers'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->MembersTraining->exists($id)) {
			throw new NotFoundException(__('Invalid VhsncAfc'));
		}
		if ($this->request->is(array('post', 'put'))) {
                    //print_r($this->request->data);
                    //die();
                            $district =  $this->request->data['MembersTraining']['district'];
                            $block =  $this->request->data['MembersTraining']['block'];
                            $panchayat =  $this->request->data['MembersTraining']['panchayat'];
                            $village =  $this->request->data['MembersTraining']['village'];
                            $member_name= $this->request->data['MembersTraining']['member_name'];
                            $mobile=  $this->request->data['MembersTraining']['member_mobile'];
                            $members_type=  $this->request->data['MembersTraining']['members_type'];
                            $from_date =  date('Y-m-d',strtotime($this->request->data['MembersTraining']['from_date']));
                            $to_date =  date('Y-m-d',strtotime($this->request->data['MembersTraining']['to_date']));
                            //$total_members=  $this->request->data['MembersTraining']['total_members'];
                           // $refresher_date =  date('Y-m-d',strtotime($this->request->data['MembersTraining']['refresher_date']));
                            $remarks =  $this->request->data['MembersTraining']['remarks'];
                            $status =  $this->request->data['MembersTraining']['status'];
                            
                    $data=array (
                                'district'=>$district,
                                'block'=>$block,
                                'panchayat' =>$panchayat,
                                'village' =>$village,
                                //'ward'=>$ward,
                                //'vhsnc_name'=> $vhsnc_name,
                                'member_name'=>$member_name,
                                'member_mobile'=>$mobile,
                                //'designation'=>$designation,
                                //'vhsnc_desig'=>$vhsnc_desig,
                                'members_type' =>$members_type,
                                'from_date' =>$from_date,
                                'to_date'=>$to_date,
                                'remarks'=>$remarks ,
                                'status'=>$status,
                                'updated'=>1 ,
                                'id'=>$id
                                );
                      $save=$this->MembersTraining->saveAll($data);
			if ($save) {
				$this->Session->setFlash(__('The VHSNC Member has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The VHSNC Member could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('MembersTraining.' . $this->MembersTraining->primaryKey => $id));
			$this->request->data = $this->MembersTraining->find('first', $options);
			//$executives=$this->User->find('list',array('conditions'=>array('User.status'=>'active','User.role'=>'regular')));
//			
                }
                if(CakeSession::read('User.type')==='regular'){
                     
                     if(CakeSession::read('User.subrole')==='CC'){
		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'))));
                       
                       
	            $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Bpccc']['allocated_district'])));
                    $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id'=>$r['Bpccc']['allocated_block'])));
                    $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Panchayat.id IN'=>explode(',',$r['Bpccc']['allocated_panchayat']))));
                    
                    if($this->request->data['MembersTraining']['panchayat']!=0 and $this->request->data['MembersTraining']['panchayat']!='')
			{
		     $village=$this->Village->find('list',array('conditions'=>array('Village.panchayat_id'=>$this->request->data['MembersTraining']['panchayat'])));
		    }
                    else {
                       $village=$this->Village->find('list',array('order'=>array('name'=>'asc'))); 
                    }
				
		}
                
                 elseif(CakeSession::read('User.subrole')==='BPC'){
		  $r = $this->Bpc->find('first',array('conditions'=>array('Bpc.first_name='.CakeSession::read('User.id'))));
                         
	            $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Bpc']['allocated_district'])));
                    $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id IN'=>explode(',',$r['Bpc']['allocated_block']))));
                   
                     if($this->request->data['MembersTraining']['panchayat']!=0 and $this->request->data['MembersTraining']['panchayat']!='')
			{
		     $village=$this->Village->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Village.panchayat_id'=>$this->request->data['MembersTraining']['panchayat'])));
		    }
                    else {
                       $village=$this->Village->find('list'); 
                    }
                    
                   if($this->request->data['MembersTraining']['panchayat']!=0 and $this->request->data['MembersTraining']['panchayat']!='')
			{
		     $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Panchayat.id'=>$this->request->data['MembersTraining']['panchayat'])));
		    }
                   else {
                       $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc')));
                   }
		}
                
                
                 else {
		  $r = $this->Dpo->find('first',array('conditions'=>array('Dpo.first_name='.CakeSession::read('User.id'))));
                         
	            $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Dpo']['district'])));
                    if($this->request->data['MembersTraining']['block']!=0 and $this->request->data['MembersTraining']['block']!='')
			{
		     $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id'=>$this->request->data['MembersTraining']['block'])));
		    }
                    else {
                        $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc')));
                    }
                   
                    if($this->request->data['MembersTraining']['panchayat']!=0 and $this->request->data['MembersTraining']['panchayat']!='')
			{
		     $village=$this->Village->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Village.panchayat_id'=>$this->request->data['MembersTraining']['panchayat'])));
		    }
                    else {
                       $village=$this->Village->find('list',array('order'=>array('name'=>'asc'))); 
                    }
                    
                   if($this->request->data['MembersTraining']['panchayat']!=0 and $this->request->data['MembersTraining']['panchayat']!='')
			{
		     $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Panchayat.id'=>$this->request->data['MembersTraining']['panchayat'])));
		    }
                   else {
                       $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc')));
                   }
		}
		   }
                else {
                    $cities=$this->City->find('list',array('order'=>array('name'=>'asc')));
                    if($this->request->data['MembersTraining']['block']!=0 and $this->request->data['MembersTraining']['block']!='')
			{
		     $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id'=>$this->request->data['MembersTraining']['block'])));
		    }
                    else {
                        $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc')));
                    }
                   
                    if($this->request->data['MembersTraining']['panchayat']!=0 and $this->request->data['MembersTraining']['panchayat']!='')
			{
		     $village=$this->Village->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Village.panchayat_id'=>$this->request->data['MembersTraining']['panchayat'])));
		    }
                    else {
                       $village=$this->Village->find('list',array('order'=>array('name'=>'asc'))); 
                    }
                    
                   if($this->request->data['MembersTraining']['panchayat']!=0 and $this->request->data['MembersTraining']['panchayat']!='')
			{
		     $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Panchayat.id'=>$this->request->data['MembersTraining']['panchayat'])));
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
                $vhsnc=$this->VhsncConstitution->find('list');
                $vhsncmembers=$this->VhsncAfc->find('list',array('conditions'=>array('VhsncAfc.member_type'=>'VHSNC')));
		
		$this->set(compact('cities','panchayat','ngos','blocks','desig','village','ward','vhsnc','vhsncmembers'));
		
	}
	
	
	
/**  
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null,$status='deactive') {
		$this->MembersTraining->id = $id;
		if (!$this->MembersTraining->exists()) {
			throw new NotFoundException(__('Invalid VHSNC Member Detail'));
		}
		    //$this->request->onlyAllow('post', 'delete');
		    $this->MembersTraining->read(null,$id);
	           $this->MembersTraining->set(array('status'=>$status));
		
		if ($this->MembersTraining->save()) {
			$this->Session->setFlash(__('The VHSNC Member has been '.$status));
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
	$condition2.=' and MembersTraining.id LIKE %'.$searchKey.'% || MembersTraining.member_name LIKE %'.$searchKey.'% MembersTraining.member_mobile LIKE %'.$searchKey.'% MembersTraining.members_type LIKE %'.$searchKey.'%';
	
	}
	
	
	
	if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(MembersTraining.from_date)>="'.$fromdate.'" and date(MembersTraining.from_date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(MembersTraining.from_date)="'.$fromdate.'"';
				}
				else
				{
					
					}
			}
			
			
  
//		if(isset($this->request->query['organization']) and ($this->request->query['organization']!=0) and ($this->request->query['organization']!='')){$searchBuilderId=trim($this->request->query['organization']);  //$condition['Enquiry.country_id']=$searchCountryId;
//		$condition2.=' and VhsncMeeting.organization='.$searchBuilderId;
//		
//		}
//		
		if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBlockId=trim($this->request->query['block']); //$condition['Enquiry.builder_id']=$searchBuilderId;
		$condition2.=' and MembersTraining.block='.$searchBlockId;
		}
		
		if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchProjectId=trim($this->request->query['panchayat']); //$condition['Enquiry.project_id']=$searchProjectId;
		$condition2.=' and MembersTraining.panchayat='.$searchProjectId;
		}
               
                if(isset($this->request->query['village']) and ($this->request->query['village']!=0) and ($this->request->query['village']!='')){$searchVillageId=trim($this->request->query['village']); //$condition['Enquiry.project_id']=$searchProjectId;
		$condition2.=' and MembersTraining.village='.$searchVillageId;
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
                             $condition2.=' and MembersTraining.panchayat='.$searchProjectId;
		           }   else { 
                        ///$condition=['VhsncAfc.panchayat IN' =>explode(',',$r['Bpccc']['allocated_panchayat'])]; 
                         $condition2.=' and MembersTraining.panchayat IN ('.$r['Bpccc']['allocated_panchayat'].')';
                      } 
                      	if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    //$condition['OR']=array('Geographical.id LIKE'=>'%'.$searchKey.'%','Geographical.ward LIKE'=>'%'.$searchKey.'%','Geographical.awc_code LIKE'=>'%'.$searchKey.'%','Geographical.awc_worker LIKE '=>'%'.$searchKey.'%','Geographical.asha_name LIKE '=>'%'.$searchKey.'%'); 
	$condition2.=' and MembersTraining.id LIKE %'.$searchKey.'% || MembersTraining.member_name LIKE %'.$searchKey.'% MembersTraining.member_mobile LIKE %'.$searchKey.'% MembersTraining.members_type LIKE %'.$searchKey.'%';
	
	}
	
	
	
	if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(MembersTraining.from_date)>="'.$fromdate.'" and date(MembersTraining.from_date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(MembersTraining.from_date)="'.$fromdate.'"';
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
		        $condition2.=' and MembersTraining.block='.$searchBlockId;
		        }else {
                            
                       $condition2.=' and MembersTraining.block IN ('.$r['Bpc']['allocated_block'].')';
                       
                      } 
                      	if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    //$condition['OR']=array('Geographical.id LIKE'=>'%'.$searchKey.'%','Geographical.ward LIKE'=>'%'.$searchKey.'%','Geographical.awc_code LIKE'=>'%'.$searchKey.'%','Geographical.awc_worker LIKE '=>'%'.$searchKey.'%','Geographical.asha_name LIKE '=>'%'.$searchKey.'%'); 
	$condition2.=' and MembersTraining.id LIKE %'.$searchKey.'% || MembersTraining.member_name LIKE %'.$searchKey.'% MembersTraining.member_mobile LIKE %'.$searchKey.'% MembersTraining.members_type LIKE %'.$searchKey.'%';
	
	}
	
	
	
	if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(MembersTraining.from_date)>="'.$fromdate.'" and date(MembersTraining.from_date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(MembersTraining.from_date)="'.$fromdate.'"';
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
                               $condition2.=' and MembersTraining.block='.$searchBlockId;
		        // $condition['VhsncAfc.block']=$searchBlockId;
		        }else {
                       //$condition='VhsncAfc.district='.$r['Dpo']['district'];
                        $condition2.=' and MembersTraining.district IN ('.$r['Dpo']['district'].')';
                        }
                        	if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    //$condition['OR']=array('Geographical.id LIKE'=>'%'.$searchKey.'%','Geographical.ward LIKE'=>'%'.$searchKey.'%','Geographical.awc_code LIKE'=>'%'.$searchKey.'%','Geographical.awc_worker LIKE '=>'%'.$searchKey.'%','Geographical.asha_name LIKE '=>'%'.$searchKey.'%'); 
	$condition2.=' and MembersTraining.id LIKE %'.$searchKey.'% || MembersTraining.member_name LIKE %'.$searchKey.'% MembersTraining.member_mobile LIKE %'.$searchKey.'% MembersTraining.members_type LIKE %'.$searchKey.'%';
	
	}
	
	
	
	if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(MembersTraining.from_date)>="'.$fromdate.'" and date(MembersTraining.from_date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(MembersTraining.from_date)="'.$fromdate.'"';
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
		$condition2.=' and MembersTraining.status="active"';
		$this->response->download("MembersTraining.csv");
		//print_r($condition); exit;
	    $data=$this->MembersTraining->query('select MembersTraining.id,MembersTraining.from_date,MembersTraining.to_date,MembersTraining.member_name,MembersTraining.member_mobile,MembersTraining.members_type,MembersTraining.remarks,City.name,Block.name,Panchayat.name,Village.name,Ward.name,MembersTraining.status from members_trainings as MembersTraining left join cities as City  on MembersTraining.district=City.id left join blocks as Block  on MembersTraining.block=Block.id left join villages as Village  on MembersTraining.village=Village.id left join panchayats as Panchayat on MembersTraining.panchayat=Panchayat.id left join wards as Ward on MembersTraining.ward=Ward.id  where 1 '.$condition2 );
		
		
		//$data = $this->Geographical->find('all', array('conditions'=>$condition2));
		
		//$log = $this->Enquiry->getDataSource()->getLog(false, false);
        //debug($log);
		//exit;
		
            $headers = array('MembersTraining'=>array( 'Id' => 'Id','District' => 'District', 'Block' => 'Block','Panchayat' => 'Panchayat','Village'=>'Village','From Date'=>'From Date','To Date'=>'To Date','Members Name'=>'Members Name','Members Mobile'=>'Members Mobile','Members Type'=>'Members Type','Remarks'=>'Remarks','Status'=>'Status')); 
	    $this->set(compact('data','headers'));
		$this->layout = 'ajax';
		return;
		
		}
  ////  reports section ---/////  
	
	
	}
	
	
	
	
