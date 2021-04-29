<?php
App::uses('AppController', 'Controller');
/**
 * Ngos Controller
 *
 * @property Ngo $GeographicalNgo
 * @property PaginatorComponent $Paginator
 */
class VhsncConstitutionsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Upload');

    var  $uses = array('VhsncConstitution','Geographical','Ngo','User','Project','Village','Panchayat','Ward','Country','City','Block','Designation','Bpccc','Bpc','Dpo');
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
    $condition['OR']=array('VhsncConstitution.id LIKE'=>'%'.$searchKey.'%','VhsncConstitution.vhsnc_name LIKE'=>'%'.$searchKey.'%','VhsncConstitution.vhsnc_constitution_level LIKE'=>'%'.$searchKey.'%','VhsncConstitution.primary_signatory LIKE '=>'%'.$searchKey.'%','VhsncConstitution.secondary_signatory LIKE '=>'%'.$searchKey.'%'); 
	
	}
		
		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition['AND']=array('date(VhsncConstitution.constitution_date) >='=>$fromdate,'date(VhsncConstitution.constitution_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['VhsncConstitution.constitution_date']=$fromdate;	
				}
				
			}
		
                if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBuilderId=trim($this->request->query['block']); 
		$condition['VhsncConstitution.block']=$searchBuilderId;
		}
		if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchBuilderId=trim($this->request->query['panchayat']); 
		$condition['VhsncConstitution.panchayat']=$searchBuilderId;
		}
		
		if(isset($this->request->query['village']) and ($this->request->query['village']!=0) and ($this->request->query['village']!='')){$searchProjectId=trim($this->request->query['village']);
		$condition['VhsncConstitution.village']=$searchProjectId;
		}
	}
         if(CakeSession::read('User.type')==='regular'){
            // echo CakeSession::read('User.subrole');
            ////die();
             if(CakeSession::read('User.subrole')==='CC'){
		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'),'Bpccc.status'=>'active')));
                      
                     if($r){ 
                         
                        
                        if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchBuilderId=trim($this->request->query['panchayat']); 
		           $condition['VhsncConstitution.panchayat']=$searchBuilderId;
		            }
                       else {
                           $condition=['VhsncConstitution.panchayat IN' =>explode(',',$r['Bpccc']['allocated_panchayat'])];  
                      
                       }
                       if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('VhsncConstitution.id LIKE'=>'%'.$searchKey.'%','VhsncConstitution.vhsnc_name LIKE'=>'%'.$searchKey.'%','VhsncConstitution.vhsnc_constitution_level LIKE'=>'%'.$searchKey.'%','VhsncConstitution.primary_signatory LIKE '=>'%'.$searchKey.'%','VhsncConstitution.secondary_signatory LIKE '=>'%'.$searchKey.'%'); 
	
	}
		
		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition['AND']=array('date(VhsncConstitution.constitution_date) >='=>$fromdate,'date(VhsncConstitution.constitution_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['VhsncConstitution.constitution_date']=$fromdate;	
				}
				
			}
                         } 
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Village yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
			//$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
			 $panchayats=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Panchayat.id IN'=>explode(',',$r['Bpccc']['allocated_panchayat']))));
                  // print_r($r['Bpccc']['allocated_panchayat']);
                  // die();
		}
                
                 elseif(CakeSession::read('User.subrole')==='BPC'){
		   $r = $this->Bpc->find('first',array('conditions'=>array('Bpc.first_name='.CakeSession::read('User.id'),'Bpc.status'=>'active')));
                      
                     if($r){ 
                      // $condition='VhsncConstitution.block='.$r['Bpc']['allocated_block'];
                         
                         
                         if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBuilderId=trim($this->request->query['block']); 
		         $condition['VhsncConstitution.block']=$searchBuilderId;
		         } 
                        
                       else {
                        
                           $condition=['VhsncConstitution.block IN' =>explode(',',$r['Bpc']['allocated_block'])];
                      
                       }
                       if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('VhsncConstitution.id LIKE'=>'%'.$searchKey.'%','VhsncConstitution.vhsnc_name LIKE'=>'%'.$searchKey.'%','VhsncConstitution.vhsnc_constitution_level LIKE'=>'%'.$searchKey.'%','VhsncConstitution.primary_signatory LIKE '=>'%'.$searchKey.'%','VhsncConstitution.secondary_signatory LIKE '=>'%'.$searchKey.'%'); 
	
	}
		
		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition['AND']=array('date(VhsncConstitution.constitution_date) >='=>$fromdate,'date(VhsncConstitution.constitution_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['VhsncConstitution.constitution_date']=$fromdate;	
				}
				
			}
                       } 
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Block yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
                        $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id IN'=>explode(',',$r['Bpc']['allocated_block']))));
                   
			//$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
				
		}
                
                
                 else {
		   $r = $this->Dpo->find('first',array('conditions'=>array('Dpo.first_name='.CakeSession::read('User.id'),'Dpo.status'=>'active')));
                      if($r){
                          
                          if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBuilderId=trim($this->request->query['block']); 
		         $condition['VhsncConstitution.block']=$searchBuilderId;
		         } else {
                       $condition='VhsncConstitution.district='.$r['Dpo']['district'];
                         }
                         
                         if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('VhsncConstitution.id LIKE'=>'%'.$searchKey.'%','VhsncConstitution.vhsnc_name LIKE'=>'%'.$searchKey.'%','VhsncConstitution.vhsnc_constitution_level LIKE'=>'%'.$searchKey.'%','VhsncConstitution.primary_signatory LIKE '=>'%'.$searchKey.'%','VhsncConstitution.secondary_signatory LIKE '=>'%'.$searchKey.'%'); 
	
	}
		
		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition['AND']=array('date(VhsncConstitution.constitution_date) >='=>$fromdate,'date(VhsncConstitution.constitution_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['VhsncConstitution.constitution_date']=$fromdate;	
				}
				
			}
                      } 
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Village yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
                      
                       $blocks=$this->Block->find('list',array('conditions'=>array('Block.city_id IN'=>explode(',',$r['Dpo']['district']))));
                   
                        //$panchayats=$this->Panchayat->find('list');
                        //$villages=$this->Village->find('list');
			//$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
				
		}
         }
         else if(CakeSession::read('User.type')==='user'){
	   $r = $this->Ngo->find('first',array('conditions'=>array('Ngo.chief_functionary_name='.CakeSession::read('User.id'))));
                 if($r){
                     $blo=array();
                   $blo= [$r['Ngo']['allocated_block_one'],$r['Ngo']['allocated_block_two']];
                     if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){
                              $searchBlockId=trim($this->request->query['block']);
		         $condition['VhsncConstitution.block']=$searchBlockId;
		        }else {
                            
                       $condition=['VhsncConstitution.block IN' =>$blo];
                       
                      } 
                      
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('VhsncConstitution.id LIKE'=>'%'.$searchKey.'%','VhsncConstitution.vhsnc_name LIKE'=>'%'.$searchKey.'%','VhsncConstitution.vhsnc_constitution_level LIKE'=>'%'.$searchKey.'%','VhsncConstitution.primary_signatory LIKE '=>'%'.$searchKey.'%','VhsncConstitution.secondary_signatory LIKE '=>'%'.$searchKey.'%'); 
	
	}
		
		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition['AND']=array('date(VhsncConstitution.constitution_date) >='=>$fromdate,'date(VhsncConstitution.constitution_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['VhsncConstitution.constitution_date']=$fromdate;	
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
        
                //$condition=' and VhsncConstitution.status="active"';
		$this->Paginator->settings = array('VhsncConstitution' => array('limit' =>20,'order' => array('id' => 'desc'),'conditions'=>array($condition,'VhsncConstitution.status'=>'active')));
		$this->VhsncConstitution->recursive = 0;
		$this->set('vhsncs', $this->Paginator->paginate());
		
			
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
		if (!$this->VhsncConstitution->exists($id)) {
			throw new NotFoundException(__('Invalid VHSNC/Constitution'));
		}
		$options = array('conditions' => array('VhsncConstitution.' . $this->VhsncConstitution->primaryKey => $id));
		$this->set('vhsnc', $this->VhsncConstitution->find('first', $options));
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
			$this->VhsncConstitution->create();
                      // print_r($this->request->data['VhsncConstitution']['member_name']);
                       
                       // echo count($this->request->data['VhsncConstitution']['member_name']);
                        //die();
                        
                            $district =  $this->request->data['VhsncConstitution']['district'];
                            $block =  $this->request->data['VhsncConstitution']['block'];
                            $panchayat =  $this->request->data['VhsncConstitution']['panchayat'];
                            $village =  $this->request->data['VhsncConstitution']['village'];
                            $ward =  $this->request->data['VhsncConstitution']['ward'];
                            $constitution_date =  date('Y-m-d',strtotime($this->request->data['VhsncConstitution']['constitution_date']));
                            $vhsnc_constitution_level=  $this->request->data['VhsncConstitution']['vhsnc_constitution_level'];
                            $vhsnc_member_type =  $this->request->data['VhsncConstitution']['vhsnc_bank_name'];
                            $vhsnc_name =  $this->request->data['VhsncConstitution']['vhsnc_name'];
                            $account_type =  $this->request->data['VhsncConstitution']['account_type'];
                            $opening_balance =  $this->request->data['VhsncConstitution']['opening_balance'];
                            $account_no =  $this->request->data['VhsncConstitution']['account_no'];
                            $ifsc =  $this->request->data['VhsncConstitution']['ifsc'];
                            $branch_address=  $this->request->data['VhsncConstitution']['branch_address'];
                            $primary_signatory=  $this->request->data['VhsncConstitution']['primary_signatory'];
                            $secondary_signatory=  $this->request->data['VhsncConstitution']['secondary_signatory'];
                            $remarks=  $this->request->data['VhsncConstitution']['remarks'];
                           
                    $data=array (
                                'district'=>$district,
                                'block'=>$block,
                                'panchayat' =>$panchayat,
                                'village' =>$village,
                                'ward'=>$ward,
                                'constitution_date'=> $constitution_date,
                                'vhsnc_constitution_level'=>$vhsnc_constitution_level,
                                'vhsnc_bank_name'=>$vhsnc_member_type,
                                'account_type'=>$account_type,
                                'opening_balance'=>$opening_balance,
                                'account_no' =>$account_no,
                                'ifsc'=>$ifsc,
                                'branch_address'=>$branch_address,
                                'primary_signatory'=>$primary_signatory,
                                'secondary_signatory'=>$secondary_signatory,
                                'remarks'=>$remarks,
                                'vhsnc_name'=>$vhsnc_name,
                                'updated'=>'0'
                                 
                                );  
                    
                           $save=$this->VhsncConstitution->saveAll($data);
				
                        // }///} } }   
                         
                             
                         if($save) {
                         $this->Session->setFlash(__('The VHSNC/Constitution has been saved.'));
				return $this->redirect(array('action' => 'index'));

                        } else {
				$this->Session->setFlash(__('The Vhsnc/Constitution could not be saved. Please, try again.'));
			}
			
                    }  
                    
                    
                 if(CakeSession::read('User.type')==='regular'){
                     
                     if(CakeSession::read('User.subrole')==='CC'){
		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'))));
                       
                     
	            $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Bpccc']['allocated_district'])));
                    $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id'=>$r['Bpccc']['allocated_block'])));
                    $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>['Panchayat.id IN'=>explode(',',$r['Bpccc']['allocated_panchayat'])]));
                   // print_r($panchayat);
                    //die();
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
		$this->set(compact('cities','panchayat','ngos','blocks','desig','village','ward'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->VhsncConstitution->exists($id)) {
			throw new NotFoundException(__('Invalid VhsncConstitution'));
		}
		if ($this->request->is(array('post', 'put'))) {
                    //print_r($this->request->data);
                    //die();
                            $district =  $this->request->data['VhsncConstitution']['district'];
                            $block =  $this->request->data['VhsncConstitution']['block'];
                            $panchayat =  $this->request->data['VhsncConstitution']['panchayat'];
                            $village =  $this->request->data['VhsncConstitution']['village'];
                            $ward =  $this->request->data['VhsncConstitution']['ward'];
                            $constitution_date =  date('Y-m-d',strtotime($this->request->data['VhsncConstitution']['constitution_date']));
                            $vhsnc_constitution_level=  $this->request->data['VhsncConstitution']['vhsnc_constitution_level'];
                            $vhsnc_member_type =  $this->request->data['VhsncConstitution']['vhsnc_bank_name'];
                            $vhsnc_name =  $this->request->data['VhsncConstitution']['vhsnc_name'];
                            $account_type =  $this->request->data['VhsncConstitution']['account_type'];
                             $opening_balance =  $this->request->data['VhsncConstitution']['opening_balance'];
                            $account_no =  $this->request->data['VhsncConstitution']['account_no'];
                            $ifsc =  $this->request->data['VhsncConstitution']['ifsc'];
                            $branch_address=  $this->request->data['VhsncConstitution']['branch_address'];
                            $primary_signatory=  $this->request->data['VhsncConstitution']['primary_signatory'];
                            $secondary_signatory=  $this->request->data['VhsncConstitution']['secondary_signatory'];
                            $remarks=  $this->request->data['VhsncConstitution']['remarks'];
                            $status=  $this->request->data['VhsncConstitution']['status'];
                            
                    $data=array (
                                'district'=>$district,
                                'block'=>$block,
                                'panchayat' =>$panchayat,
                                'village' =>$village,
                                'ward'=>$ward,
                                'constitution_date'=> $constitution_date,
                                'vhsnc_constitution_level'=>$vhsnc_constitution_level,
                                'vhsnc_bank_name'=>$vhsnc_member_type,
                                'account_type'=>$account_type,
                                'opening_balance'=>$opening_balance,
                                'account_no' =>$account_no,
                                'ifsc'=>$ifsc,
                                'branch_address'=>$branch_address,
                                'primary_signatory'=>$primary_signatory,
                                'secondary_signatory'=>$secondary_signatory,
                                'remarks'=>$remarks,
                                'vhsnc_name'=>$vhsnc_name,
                                'updated'=>'1',
                                'status'=>$status,
                                'id'=>$id
                                );
			if ($this->VhsncConstitution->save($data)) {
				$this->Session->setFlash(__('The Vhsnc/Afc has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Vhsnc/Afc could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('VhsncConstitution.' . $this->VhsncConstitution->primaryKey => $id));
			$this->request->data = $this->VhsncConstitution->find('first', $options);
			$executives=$this->User->find('list',array('conditions'=>array('User.status'=>'active','User.role'=>'regular')));
//			
                }
                      
                 if(CakeSession::read('User.type')==='regular'){
                     
                     if(CakeSession::read('User.subrole')==='CC'){
		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'))));
                       
                      
	            $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Bpccc']['allocated_district'])));
                    $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id'=>$r['Bpccc']['allocated_block'])));
                    $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>['Panchayat.id IN'=>explode(',',$r['Bpccc']['allocated_panchayat'])]));
                     if($this->request->data['VhsncConstitution']['panchayat']!=0 and $this->request->data['VhsncConstitution']['panchayat']!='')
			{
		     $village=$this->Village->find('list',array('conditions'=>array('Village.panchayat_id'=>$this->request->data['VhsncConstitution']['panchayat'])));
		    }
                   // $village=$this->Village->find('list');
				
		}
                
                 elseif(CakeSession::read('User.subrole')==='BPC'){
		  $r = $this->Bpc->find('first',array('conditions'=>array('Bpc.first_name='.CakeSession::read('User.id'))));
                       
                       //$condition='VhsncConstitution.village='.$r['Bpccc']['allocated_village'];
                        
			//$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
                       
	            $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Bpc']['allocated_district'])));
                    $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id IN'=>explode(',',$r['Bpc']['allocated_block']))));
                    
                     if($this->request->data['VhsncConstitution']['panchayat']!=0 and $this->request->data['VhsncConstitution']['panchayat']!='')
			{
		     $village=$this->Village->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Village.panchayat_id'=>$this->request->data['VhsncConstitution']['panchayat'])));
		    }
                    else {
                       $village=$this->Village->find('list',array('order'=>array('name'=>'asc'))); 
                    }
                    
                   if($this->request->data['VhsncConstitution']['panchayat']!=0 and $this->request->data['VhsncConstitution']['panchayat']!='')
			{
		     $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Panchayat.id'=>$this->request->data['VhsncConstitution']['panchayat'])));
		    }
                   else {
                       $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc')));
                   }
                    //$panchayat=$this->Panchayat->find('list');
                    //$village=$this->Village->find('list');
		}
                
                
                 else {
		  $r = $this->Dpo->find('first',array('conditions'=>array('Dpo.first_name='.CakeSession::read('User.id'))));
                         
	            $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Dpo']['district'])));
                    if($this->request->data['VhsncConstitution']['block']!=0 and $this->request->data['VhsncConstitution']['block']!='')
			{
		     $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id'=>$this->request->data['VhsncConstitution']['block'])));
		    }
                    else {
                       $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc')));
                    }
                    if($this->request->data['VhsncConstitution']['panchayat']!=0 and $this->request->data['VhsncConstitution']['panchayat']!='')
			{
		     $village=$this->Village->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Village.panchayat_id'=>$this->request->data['VhsncConstitution']['panchayat'])));
		    }
                    else {
                       $village=$this->Village->find('list',array('order'=>array('name'=>'asc'))); 
                    }
                    
                   if($this->request->data['VhsncConstitution']['panchayat']!=0 and $this->request->data['VhsncConstitution']['panchayat']!='')
			{
		     $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Panchayat.id'=>$this->request->data['VhsncConstitution']['panchayat'])));
		    }
                   else {
                       $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),));
                   }
		}
		   }
                else {
                    $cities=$this->City->find('list',array('order'=>array('name'=>'asc')));
                      if($this->request->data['VhsncConstitution']['block']!=0 and $this->request->data['VhsncConstitution']['block']!='')
			{
		     $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id'=>$this->request->data['VhsncConstitution']['block'])));
		    }
                    else {
                       $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc')));
                    }
                    if($this->request->data['VhsncConstitution']['panchayat']!=0 and $this->request->data['VhsncConstitution']['panchayat']!='')
			{
		     $village=$this->Village->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Village.panchayat_id'=>$this->request->data['VhsncConstitution']['panchayat'])));
		    }
                    else {
                       $village=$this->Village->find('list',array('order'=>array('name'=>'asc'))); 
                    }
                    
                   if($this->request->data['VhsncConstitution']['panchayat']!=0 and $this->request->data['VhsncConstitution']['panchayat']!='')
			{
		     $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Panchayat.id'=>$this->request->data['VhsncConstitution']['panchayat'])));
		    }
                   else {
                       $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc')));
                   }
                   // $blocks=$this->Block->find('list');
                    //$panchayat=$this->Panchayat->find('list');
                    //$village=$this->Village->find('list');
                }
		//$cities=$this->City->find('list');
                $desig=$this->Designation->find('list');
		//$blocks=$this->Block->find('list');
		$ngos=$this->Ngo->find('list');
                //$panchayat=$this->Panchayat->find('list');
                //$village=$this->Village->find('list');
                $ward=$this->Ward->find('list');
                
		$this->set(compact('cities','panchayat','ngos','blocks','desig','village','ward'));
		
	}
	
	
	
/**  
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null,$status='deactive') {
		$this->VhsncConstitution->id = $id;
		if (!$this->VhsncConstitution->exists()) {
			throw new NotFoundException(__('Invalid VhsncConstitution Detail'));
		}
		    //$this->request->onlyAllow('post', 'delete');
		    $this->VhsncConstitution->read(null,$id);
	           $this->VhsncConstitution->set(array('status'=>$status));
		
		if ($this->VhsncConstitution->save()) {
			$this->Session->setFlash(__('The VhsncConstitution has been '.$status));
		} else {
			$this->Session->setFlash(__('Nothing happen. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	public function getpvhsnc($stateid) {
	    $this->layout='ajax';
        $this->autoRender = false;
	 
		    $subcatlist = $this->VhsncConstitution->find('first',array("conditions"=>array('panchayat'=>$stateid)));
                   
                    if(!empty($subcatlist)){
		    $data=  $subcatlist['VhsncConstitution']['vhsnc_name'];
                    return $data;
                    }
		
	}
        public function getvvhsnc($stateid) {
	    $this->layout='ajax';
        $this->autoRender = false;
	 
		$subcatlist=$this->VhsncConstitution->find('first',array("conditions"=>array('village'=>$stateid)));
		 if(!empty($subcatlist)){
		    $data=  $subcatlist['VhsncConstitution']['vhsnc_name'];
                    return $data;
                    }
	}
        public function getwvhsnc($stateid) {
	    $this->layout='ajax';
        $this->autoRender = false;
	   
		$subcatlist=$this->VhsncConstitution->find('first',array("conditions"=>array('ward'=>$stateid)));
		 if(!empty($subcatlist)){
		    $data=  $subcatlist['VhsncConstitution']['vhsnc_name'];
                    return $data;
                    }
	}
        
        public function getname($stateid) {
	   $this->layout='ajax';
        $this->autoRender = false;
		$subcatlist=$this->VhsncConstitution->find('first',array("conditions"=>array('panchayat'=>$stateid)));
		 if(!empty($subcatlist)){
		    $data=  $subcatlist['VhsncConstitution']['vhsnc_name'];
                    return $data;
                    }
	}
        
        
        /////
        
        public function getpvhsncId($stateid) {
	    $this->layout='ajax';
        $this->autoRender = false;
	 
		    $subcatlist = $this->VhsncConstitution->find('first',array("conditions"=>array('panchayat'=>$stateid)));
                   
                    if(!empty($subcatlist)){
		    $data=  $subcatlist['VhsncConstitution']['id'];
                    return $data;
                    }
		
	}
        public function getvvhsncId($stateid) {
	    $this->layout='ajax';
        $this->autoRender = false;
	 
		$subcatlist=$this->VhsncConstitution->find('first',array("conditions"=>array('village'=>$stateid)));
		 if(!empty($subcatlist)){
		    $data=  $subcatlist['VhsncConstitution']['id'];
                    return $data;
                    }
	}
        public function getwvhsncId($stateid) {
	    $this->layout='ajax';
        $this->autoRender = false;
	   
		$subcatlist=$this->VhsncConstitution->find('first',array("conditions"=>array('ward'=>$stateid)));
		 if(!empty($subcatlist)){
		    $data=  $subcatlist['VhsncConstitution']['id'];
                    return $data;
                    }
	}
        
        
        
        /////
        
        public function getbankname($id) {
	    $this->layout='ajax';
        $this->autoRender = false;
	                  $options = array('conditions' => array('VhsncConstitution.' . $this->VhsncConstitution->primaryKey => $id));
			
		         $subcatlist=$this->request->data = $this->VhsncConstitution->find('first', $options);
                       $data=  $subcatlist['VhsncConstitution']['account_no'];
                         
		//foreach($subcatlist as $key=>$value){ 
                //    print_r($value);   }
		return $data;
	}
        
        
         public function getifsc($id) {
	    $this->layout='ajax';
        $this->autoRender = false;
	                  $options = array('conditions' => array('VhsncConstitution.' . $this->VhsncConstitution->primaryKey => $id));
			
		         $subcatlist=$this->request->data = $this->VhsncConstitution->find('first', $options);
                       $data=  $subcatlist['VhsncConstitution']['ifsc'];
                         
		//foreach($subcatlist as $key=>$value){ 
                //    print_r($value);   }
		return $data;
	}
        
          public function getopenbal($id) {
	    $this->layout='ajax';
        $this->autoRender = false;
	                  $options = array('conditions' => array('VhsncConstitution.' . $this->VhsncConstitution->primaryKey => $id));
			
		         $subcatlist=$this->request->data = $this->VhsncConstitution->find('first', $options);
                       $data=  $subcatlist['VhsncConstitution']['opening_balance'];
                         
		//foreach($subcatlist as $key=>$value){ 
                //    print_r($value);   }
		return $data;
	}
        
        
        public function gevhsncname($id) {
	    $this->layout='ajax';
        $this->autoRender = false;
                 $data='<option value="">--Select--</option>';
	                  $options = array('conditions' => array('VhsncConstitution.' . $this->VhsncConstitution->primaryKey => $id));
		            $subcatlist=$this->request->data = $this->VhsncConstitution->find('list', $options);
                       //$data=  $subcatlist['VhsncConstitution']['vhsnc_name'];
                        foreach($subcatlist as $key=>$value){ $data.='<option value="'.$key.'">'.$value.'</option>';}
		return $data;
	}
        
        
        
        
        /////
        
        
        
        public function getpvhsncn($stateid) {
	    $this->layout='ajax';
        $this->autoRender = false;
	         $data='<option value="">--Select--</option>';
		    $subcatlist = $this->VhsncConstitution->find('list',array("conditions"=>array('panchayat'=>$stateid,'status'=>'active')));
                   
                   foreach($subcatlist as $key=>$value){ $data.='<option value="'.$key.'">'.$value.'</option>';}
		return $data;
	}
        public function getvvhsncn($stateid) {
	    $this->layout='ajax';
        $this->autoRender = false;
	   $data='<option value="">--Select--</option>';
		$subcatlist=$this->VhsncConstitution->find('list',array("conditions"=>array('village'=>$stateid,'status'=>'active')));
		  foreach($subcatlist as $key=>$value){ $data.='<option value="'.$key.'">'.$value.'</option>';}
                  return $data;
	}
        public function getwvhsncn($stateid) {
	    $this->layout='ajax';
        $this->autoRender = false;
	     $data='<option value="">--Select--</option>';
		$subcatlist=$this->VhsncConstitution->find('list',array("conditions"=>array('ward'=>$stateid,'status'=>'active')));
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
	$condition2.=' and VhsncConstitution.id LIKE %'.$searchKey.'% || VhsncConstitution.vhsnc_name LIKE %'.$searchKey.'% VhsncConstitution.vhsnc_constitution_level LIKE %'.$searchKey.'% || VhsncConstitution.primary_signatory LIKE %'.$searchKey.'% || VhsncConstitution.secondary_signatory %'.$searchKey.'%';
	
	}
	
	
	
	if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(VhsncConstitution.constitution_date)>="'.$fromdate.'" and date(VhsncConstitution.constitution_date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(VhsncConstitution.constitution_date)="'.$fromdate.'"';
				}
				else
				{
					
					}
			}
			
			
  
		if(isset($this->request->query['organization']) and ($this->request->query['organization']!=0) and ($this->request->query['organization']!='')){$searchBuilderId=trim($this->request->query['organization']);  //$condition['Enquiry.country_id']=$searchCountryId;
		$condition2.=' and VhsncConstitution.organization='.$searchBuilderId;
		
		}
		
		if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBlockId=trim($this->request->query['block']); //$condition['Enquiry.builder_id']=$searchBuilderId;
		$condition2.=' and VhsncConstitution.block='.$searchBlockId;
		}
		
		if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchProjectId=trim($this->request->query['panchayat']); //$condition['Enquiry.project_id']=$searchProjectId;
		$condition2.=' and VhsncConstitution.panchayat='.$searchProjectId;
		}
               
                if(isset($this->request->query['village']) and ($this->request->query['village']!=0) and ($this->request->query['village']!='')){$searchVillageId=trim($this->request->query['village']); //$condition['Enquiry.project_id']=$searchProjectId;
		$condition2.=' and VhsncConstitution.village='.$searchVillageId;
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
                             $condition2.=' and VhsncConstitution.panchayat='.$searchProjectId;
		           }   else { 
                        ///$condition=['VhsncAfc.panchayat IN' =>explode(',',$r['Bpccc']['allocated_panchayat'])]; 
                         $condition2.=' and VhsncConstitution.panchayat IN ('.$r['Bpccc']['allocated_panchayat'].')';
                      }
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    //$condition['OR']=array('Geographical.id LIKE'=>'%'.$searchKey.'%','Geographical.ward LIKE'=>'%'.$searchKey.'%','Geographical.awc_code LIKE'=>'%'.$searchKey.'%','Geographical.awc_worker LIKE '=>'%'.$searchKey.'%','Geographical.asha_name LIKE '=>'%'.$searchKey.'%'); 
	$condition2.=' and VhsncConstitution.id LIKE %'.$searchKey.'% || VhsncConstitution.vhsnc_name LIKE %'.$searchKey.'% VhsncConstitution.vhsnc_constitution_level LIKE %'.$searchKey.'% || VhsncConstitution.primary_signatory LIKE %'.$searchKey.'% || VhsncConstitution.secondary_signatory %'.$searchKey.'%';
	
	}
	
	
	
	if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(VhsncConstitution.constitution_date)>="'.$fromdate.'" and date(VhsncConstitution.constitution_date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(VhsncConstitution.constitution_date)="'.$fromdate.'"';
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
		        $condition2.=' and VhsncConstitution.block='.$searchBlockId;
		        }else {
                            
                       $condition2.=' and VhsncConstitution.block IN ('.$r['Bpc']['allocated_block'].')';
                       
                      }
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    //$condition['OR']=array('Geographical.id LIKE'=>'%'.$searchKey.'%','Geographical.ward LIKE'=>'%'.$searchKey.'%','Geographical.awc_code LIKE'=>'%'.$searchKey.'%','Geographical.awc_worker LIKE '=>'%'.$searchKey.'%','Geographical.asha_name LIKE '=>'%'.$searchKey.'%'); 
	$condition2.=' and VhsncConstitution.id LIKE %'.$searchKey.'% || VhsncConstitution.vhsnc_name LIKE %'.$searchKey.'% VhsncConstitution.vhsnc_constitution_level LIKE %'.$searchKey.'% || VhsncConstitution.primary_signatory LIKE %'.$searchKey.'% || VhsncConstitution.secondary_signatory %'.$searchKey.'%';
	
	}
	
	
	
	if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(VhsncConstitution.constitution_date)>="'.$fromdate.'" and date(VhsncConstitution.constitution_date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(VhsncConstitution.constitution_date)="'.$fromdate.'"';
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
                               $condition2.=' and VhsncConstitution.block='.$searchBlockId;
		        // $condition['VhsncAfc.block']=$searchBlockId;
		        }else {
                       //$condition='VhsncAfc.district='.$r['Dpo']['district'];
                        $condition2.=' and VhsncConstitution.district IN ('.$r['Dpo']['district'].')';
                        }
                        if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    //$condition['OR']=array('Geographical.id LIKE'=>'%'.$searchKey.'%','Geographical.ward LIKE'=>'%'.$searchKey.'%','Geographical.awc_code LIKE'=>'%'.$searchKey.'%','Geographical.awc_worker LIKE '=>'%'.$searchKey.'%','Geographical.asha_name LIKE '=>'%'.$searchKey.'%'); 
	$condition2.=' and VhsncConstitution.id LIKE %'.$searchKey.'% || VhsncConstitution.vhsnc_name LIKE %'.$searchKey.'% VhsncConstitution.vhsnc_constitution_level LIKE %'.$searchKey.'% || VhsncConstitution.primary_signatory LIKE %'.$searchKey.'% || VhsncConstitution.secondary_signatory %'.$searchKey.'%';
	
	}
	
	
	
	if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(VhsncConstitution.constitution_date)>="'.$fromdate.'" and date(VhsncConstitution.constitution_date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(VhsncConstitution.constitution_date)="'.$fromdate.'"';
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
		$condition2.=' and VhsncConstitution.status="active"';
		$this->response->download("VhsncConstitution.csv");
		//print_r($condition); exit;
	    $data=$this->VhsncConstitution->query('select VhsncConstitution.id,VhsncConstitution.constitution_date,VhsncConstitution.vhsnc_constitution_level,VhsncConstitution.vhsnc_name,City.name,Block.name,Ward.name,Panchayat.name,Village.name,VhsncConstitution.vhsnc_name,VhsncConstitution.vhsnc_bank_name,VhsncConstitution.account_type,VhsncConstitution.account_no,VhsncConstitution.ifsc,VhsncConstitution.branch_address,VhsncConstitution.primary_signatory,VhsncConstitution.secondary_signatory,VhsncConstitution.opening_balance,VhsncConstitution.total_members,VhsncConstitution.status from vhsnc_constitutions as VhsncConstitution left join cities as City  on VhsncConstitution.district=City.id left join blocks as Block  on VhsncConstitution.block=Block.id left join wards as Ward  on VhsncConstitution.ward=Ward.id left join panchayats as Panchayat on VhsncConstitution.panchayat=Panchayat.id left join villages as Village on VhsncConstitution.village=Village.id where 1 '.$condition2 );
		
		
		//$data = $this->Geographical->find('all', array('conditions'=>$condition2));
		
		//$log = $this->Enquiry->getDataSource()->getLog(false, false);
        //debug($log);
		//exit;
		
            $headers = array('VhsncConstitution'=>array( 'Id' => 'Id','District' => 'District', 'Block' => 'Block','Panchayat' => 'Panchayat','Village'=>'Village','Ward'=>'Ward','Constitution Date'=>'Constitution Date','VHSNC Constitution Level'=>'VHSNC Constitution Level','VHSNC Name'=>'VHSNC Name','VHSNC Bank Name'=>'VHSNC Bank Name','Account Type'=>'Account Type','Account No'=>'Account No','IFS CODE'=>'IFS CODE','Branch Address'=>'Branch Address','Opening Balance'=>'Opening Balance','Primary Signatory'=>'Primary Signatory','Secondary Signatory'=>'Secondary Signatory','Total Member'=>'Total Member','Status'=>'Status')); 
	    $this->set(compact('data','headers'));
		$this->layout = 'ajax';
		return;
		
		}
  ////  reports section ---///// 
	}
	
	
	
	
