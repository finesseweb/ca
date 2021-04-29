<?php
App::uses('AppController', 'Controller');
/**
 * Ngos Controller
 *
 * @property Ngo $YouthleaderNgo
 * @property PaginatorComponent $Paginator
 */
class YouthleadersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Upload');

    var  $uses = array('Youthleader','Youthleader','Ngo','User','Project','Village','Panchayat','Location','Country','City','Block','Designation','Youthleader','Bpccc','Bpc','Dpo');
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
    $condition['OR']=array('Youthleader.id LIKE'=>'%'.$searchKey.'%','Youthleader.first_name LIKE'=>'%'.$searchKey.'%','Youthleader.last_name LIKE'=>'%'.$searchKey.'%','Youthleader.mobile LIKE '=>'%'.$searchKey.'%','Youthleader.email LIKE '=>'%'.$searchKey.'%'); 
	
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
		if(isset($this->request->query['district']) and ($this->request->query['district']!=0) and ($this->request->query['district']!='')){$searchBuilderId=trim($this->request->query['district']); 
		$condition['Youthleader.allocated_district']=$searchBuilderId;
		}
		
		if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchProjectId=trim($this->request->query['block']);
		$condition['Youthleader.allocated_block']=$searchProjectId;
		}
		
		if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchUserId=trim($this->request->query['panchayat']);
		$condition['Youthleader.allocated_panchayat']=$searchUserId;
		}
		
	}
         if(CakeSession::read('User.type')==='regular'){
             //echo CakeSession::read('User.subrole');
            // die();
             if(CakeSession::read('User.subrole')==='CC'){
		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'))));
                      if($r){ 
                        if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchUserId=trim($this->request->query['panchayat']);
		$condition['Youthleader.allocated_panchayat']=$searchUserId;
		} else {
                      // $condition='VhsncFeedback.panchayat='.$r['Youthleader']['allocated_panchayat'];
                        $condition=['Youthleader.allocated_panchayat IN' =>explode(',',$r['Bpccc']['allocated_panchayat'])];
                }
                      } 
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Panchayat yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
			//$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
			$panchayats=$this->Panchayat->find('list',array('order' => array('name' => 'asc'),'conditions'=>array('Panchayat.id IN'=>explode(',',$r['Bpccc']['allocated_panchayat']))));
                     	
		}
                
                 elseif(CakeSession::read('User.subrole')==='BPC'){
		   $r = $this->Bpc->find('first',array('conditions'=>array('Bpc.first_name='.CakeSession::read('User.id'))));
                      if($r){
                        if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchProjectId=trim($this->request->query['block']);
		$condition['Youthleader.allocated_block']=$searchProjectId;
		} else {
                       //$condition='VhsncFeedback.block='.$r['Bpc']['allocated_block'];
                       $condition=['Youthleader.allocated_block IN' =>explode(',',$r['Bpc']['allocated_block'])];
                }
                      } 
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Block yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
			//$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
                      $blocks=$this->Block->find('list',array('order' => array('name' => 'asc'),'conditions'=>array('Block.id IN'=>explode(',',$r['Bpc']['allocated_block']))));
                  	
		}
                
                
                 else {
		   $r = $this->Dpo->find('first',array('conditions'=>array('Dpo.first_name='.CakeSession::read('User.id'))));
                      if($r){
                            if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchProjectId=trim($this->request->query['block']);
		            $condition['Youthleader.allocated_block']=$searchProjectId;
                            //echo $searchProjectId;
                            //die();
		            }
                           else if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchUserId=trim($this->request->query['panchayat']);
		            $condition['Youthleader.allocated_panchayat']=$searchUserId;
		            } else {
                           $condition='Youthleader.allocated_district='.$r['Dpo']['district'];
                            }
                      } 
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated District yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
			//$condition2.=' and Enquiry.user_id='.CakeSession::read('User.id');
		      $cities=$this->City->find('list' ,array('order' => array('name' => 'asc'),'conditions'=>array('City.id'=>$r['Dpo']['district'])));
                
		}
         }
         else if(CakeSession::read('User.type')==='user'){
	   $r = $this->Ngo->find('first',array('conditions'=>array('Ngo.chief_functionary_name='.CakeSession::read('User.id'))));
                 if($r){
                     $blo=array();
                   $blo= [$r['Ngo']['allocated_block_one'],$r['Ngo']['allocated_block_two']];
                     if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){
                              $searchBlockId=trim($this->request->query['block']);
		         $condition['Youthleader.allocated_block']=$searchBlockId;
		        }else {
                            
                       $condition=['Youthleader.allocated_block IN' =>$blo];
                       
                      } 
		}
                 $blocks=$this->Block->find('list',array('order' => array('name' => 'asc'),'conditions'=>array('Block.id IN'=>$blo)));
                 $ngos=$this->Ngo->find('list',array('conditions'=>array('Ngo.id'=>$r['Ngo']['id'])));
                     
         }
         else {
               $cities=$this->City->find('list',array('order' => array('name' => 'asc')));
                $blocks=$this->Block->find('list',array('order' => array('name' => 'asc')));
                $panchayats=$this->Panchayat->find('list',array('order' => array('name' => 'asc')));
         }
		
		$this->Paginator->settings = array('Youthleader' => array('limit' =>20,'group'=>array('Youthleader.allocated_village'),'order' => array('id' => 'desc'),'conditions'=>array($condition,'Youthleader.status'=>'active')));
		$this->Youthleader->recursive = 0;
		$this->set('geographicals', $this->Paginator->paginate());
		
               
		      
			$this->set(compact('users','cities','blocks','panchayats'));
			
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
//	public function view($id = null) {
////		if (!$this->Youthleader->exists($id)) {
////			throw new NotFoundException(__('Invalid Youth leader'));
////		}
//		$options = array('conditions' => array('Youthleader.' . $this->Youthleader->primaryKey => $id));
//		$this->set('bpccc', $this->Youthleader->find('first', $options));
//		$this->layout='newdefault';
//	}
	
	public function view($id = null) {
//		if (!$this->Youthleader->exists($id)) {
//			throw new NotFoundException(__('Invalid Youth leader'));
//		}
		$options = array('conditions' => array('Youthleader.allocated_village' => $id,'Youthleader.status'=>'active'));
		$this->set('youthleaders', $this->Youthleader->find('all', $options));
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
			$this->Youthleader->create();
//                        print_r($this->request->data);
//                        die();
                        
                    for($i=0;$i<count($this->request->data['Youthleader']['first_name']);$i++)
                    {
                            $first_name =  $this->request->data['Youthleader']['first_name'][$i];
                            $last_name=  $this->request->data['Youthleader']['last_name'][$i];
                            $designation =  $this->request->data['Youthleader']['designation'][$i];
                            $gender=  $this->request->data['Youthleader']['gender'][$i];
                            $mobile =  $this->request->data['Youthleader']['mobile'][$i];
                            $email_id =  $this->request->data['Youthleader']['email'][$i];
                            $address =  $this->request->data['Youthleader']['address'][$i];
                            $district =  $this->request->data['Youthleader']['allocated_district'];
                            $block =  $this->request->data['Youthleader']['allocated_block'];
                            $allocated_panchayat =  implode(',',$this->request->data['Youthleader']['allocated_panchayat']);
                            $allocated_village =  $this->request->data['Youthleader']['allocated_village'];
                            $date_of_joining =  date('Y-m-d',strtotime($this->request->data['Youthleader']['date_of_joining'][$i]));
                            $group_name = $this->request->data['Youthleader']['group_name'];
                            $age =  $this->request->data['Youthleader']['age'][$i];
                            $qualification =  $this->request->data['Youthleader']['qualification'][$i];
                            $remarks =  $this->request->data['Youthleader']['remarks'];
                            //$status =  $this->request->data['Youthleader']['status'];
                    $data=array (
                                
                                'first_name' => $first_name ,
                                'last_name' => $last_name,
                                'designation' => $designation,
                                'gender' => $gender,
                                'mobile' => $mobile,
                                'email' => $email_id,
                                'address' => $address,
                                'allocated_district' =>$district,
                                'allocated_block' =>$block,
                                'allocated_panchayat'=>$allocated_panchayat,
                                'allocated_village'=> $allocated_village,
                                'date_of_joining'=>$date_of_joining,
                                'group_name'=>$group_name,
                                'age'=>$age,
                                'qualification' =>$qualification,
                                'remarks'=>$remarks,
                               
                                );  
                            $save=$this->Youthleader->saveAll($data);
                    }    
			if ($save) {
				$this->Session->setFlash(__('The Youth leader has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Youth leader could not be saved. Please, try again.'));
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
                    $village=$this->Village->find('list',array('order' => array('name' => 'asc')));	
		}
                
                 elseif(CakeSession::read('User.subrole')==='BPC'){
		  $r = $this->Bpc->find('first',array('conditions'=>array('Bpc.first_name='.CakeSession::read('User.id'))));
                       
                     
	            $cities=$this->City->find('list',array('order' => array('name' => 'asc'),'conditions'=>array('City.id'=>$r['Bpc']['allocated_district'])));
                    $blocks=$this->Block->find('list',array('order' => array('name' => 'asc'),'conditions'=>array('Block.id IN'=>explode(',',$r['Bpc']['allocated_block']))));
                   
                    $condition['OR']=array('Ngo.allocated_block_one'=>explode(',',$r['Bpc']['allocated_block']),'Ngo.allocated_block_two'=>explode(',',$r['Bpc']['allocated_block'])); 
                    $ngos=$this->Ngo->find('list',array('conditions'=>$condition));
                    
                    $panchayat=$this->Panchayat->find('list',array('order' => array('name' => 'asc')));
                    $village=$this->Village->find('list',array('order' => array('name' => 'asc')));
                   
		}
                
                
                 else {
		  $r = $this->Dpo->find('first',array('conditions'=>array('Dpo.first_name='.CakeSession::read('User.id'))));
                         
	            $cities=$this->City->find('list',array('order' => array('name' => 'asc'),'conditions'=>array('City.id'=>$r['Dpo']['district'])));
                   $blocks=$this->Block->find('list',array('order' => array('name' => 'asc')));
                    $panchayat=$this->Panchayat->find('list',array('order' => array('name' => 'asc')));
                    $village=$this->Village->find('list',array('order' => array('name' => 'asc')));
                    $ngos=$this->Ngo->find('list');
		}
		   }
                else {
                    $cities=$this->City->find('list',array('order' => array('name' => 'asc')));
                    $blocks=$this->Block->find('list',array('order' => array('name' => 'asc')));
                    $panchayat=$this->Panchayat->find('list',array('order' => array('name' => 'asc')));
                    $village=$this->Village->find('list',array('order' => array('name' => 'asc')));
                    $ngos=$this->Ngo->find('list');
                }
                //$executives=$this->User->find('list',array('conditions'=>array('User.status'=>'active','User.role'=>'regular')));
		//$cities=$this->City->find('list');
                $desig=$this->Designation->find('list');
		//$blocks=$this->Block->find('list');
		//$ngos=$this->Ngo->find('list');
                //$panchayat=$this->Panchayat->find('list');
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
		if (!$this->Youthleader->exists($id)) {
			throw new NotFoundException(__('Invalid booking'));
		}
		if ($this->request->is(array('post', 'put'))) {
                    
                    $first_name =  $this->request->data['Youthleader']['first_name'];
                            $last_name=  $this->request->data['Youthleader']['last_name'];
                            $designation =  $this->request->data['Youthleader']['designation'];
                            $gender=  $this->request->data['Youthleader']['gender'];
                            $mobile =  $this->request->data['Youthleader']['mobile'];
                            $email_id =  $this->request->data['Youthleader']['email'];
                            $address =  $this->request->data['Youthleader']['address'];
                            $district =  $this->request->data['Youthleader']['allocated_district'];
                            $block =  $this->request->data['Youthleader']['allocated_block'];
                            $allocated_panchayat = implode(',',$this->request->data['Youthleader']['allocated_panchayat']);
                            $allocated_village =  $this->request->data['Youthleader']['allocated_village'];
                            $date_of_joining =  date('Y-m-d',strtotime($this->request->data['Youthleader']['date_of_joining']));
                            $group_name = $this->request->data['Youthleader']['group_name'];
                            $age =  $this->request->data['Youthleader']['age'];
                            $qualification =  $this->request->data['Youthleader']['qualification'];
                            $remarks =  $this->request->data['Youthleader']['remarks'];
                            $status =  $this->request->data['Youthleader']['status'];
                    $data=array (
                                'first_name' => $first_name ,
                                'last_name' => $last_name,
                                'designation' => $designation,
                                'gender' => $gender,
                                'mobile' => $mobile,
                                'email' => $email_id,
                                'address' => $address,
                                'allocated_district' =>$district,
                                'allocated_block' =>$block,
                                'allocated_panchayat'=>$allocated_panchayat,
                                'allocated_village'=> $allocated_village,
                                'date_of_joining'=>$date_of_joining,
                                'group_name'=>$group_name,
                                'age'=>$age,
                                'qualification' =>$qualification,
                                'remarks'=>$remarks,
                                'status'=>$status,
                                'id'=>$id
                                );  
                            
			if ($this->Youthleader->save($data)) {
				$this->Session->setFlash(__('The Youth leader has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Youth leader could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Youthleader.' . $this->Youthleader->primaryKey => $id));
			$this->request->data = $this->Youthleader->find('first', $options);
                }
                        
                       // $executives=$this->User->find('list',array('conditions'=>array('User.status'=>'active','User.role'=>'regular')));
			 if(CakeSession::read('User.type')==='regular'){
                     
                     if(CakeSession::read('User.subrole')==='CC'){
		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'))));
                       
                     
	            $cities=$this->City->find('list',array('order' => array('name' => 'asc'),'conditions'=>array('City.id'=>$r['Bpccc']['allocated_district'])));
                    $blocks=$this->Block->find('list',array('order' => array('name' => 'asc'),'conditions'=>array('Block.id'=>$r['Bpccc']['allocated_block'])));
                    $panchayat=$this->Panchayat->find('list',array('order' => array('name' => 'asc'),'conditions'=>['Panchayat.id IN'=>explode(',',$r['Bpccc']['allocated_panchayat'])]));
                   // print_r($panchayat);
                    //die();
                    if($this->request->data['Youthleader']['allocated_panchayat']!=0 and $this->request->data['Youthleader']['allocated_panchayat']!='')
			{
				$village=$this->Village->find('list',array('order' => array('name' => 'asc'),'conditions'=>array('Village.panchayat_id'=>$this->request->data['Youthleader']['allocated_panchayat'])));
				}
                                else {
                    $village=$this->Village->find('list',array('order' => array('name' => 'asc')));
                    
                                }
		}
                
                 elseif(CakeSession::read('User.subrole')==='BPC'){
		  $r = $this->Bpc->find('first',array('conditions'=>array('Bpc.first_name='.CakeSession::read('User.id'))));
                       
                     
	            $cities=$this->City->find('list',array('order' => array('name' => 'asc'),'conditions'=>array('City.id'=>$r['Bpc']['allocated_district'])));
                    $blocks=$this->Block->find('list',array('order' => array('name' => 'asc'),'conditions'=>array('Block.id IN'=>explode(',',$r['Bpc']['allocated_block']))));
                     if($this->request->data['Youthleader']['allocated_panchayat']!=0 and $this->request->data['Youthleader']['allocated_panchayat']!='')
			{
		     $panchayat=$this->Panchayat->find('list',array('order' => array('name' => 'asc'),'conditions'=>array('Panchayat.id'=>$this->request->data['Youthleader']['allocated_panchayat'])));
				}
                                else {
                      $panchayat=$this->Panchayat->find('list',array('order' => array('name' => 'asc')));
                    
                                }
                   
                    
                     if($this->request->data['Youthleader']['allocated_panchayat']!=0 and $this->request->data['Youthleader']['allocated_panchayat']!='')
			{
				$village=$this->Village->find('list',array('order' => array('name' => 'asc'),'conditions'=>array('Village.panchayat_id'=>$this->request->data['Youthleader']['allocated_panchayat'])));
			}
                     else {
                      $village=$this->Village->find('list',array('order' => array('name' => 'asc')));
                      } 
		}
                
                
                 else {
		  $r = $this->Dpo->find('first',array('conditions'=>array('Dpo.first_name='.CakeSession::read('User.id'))));
                         
	            $cities=$this->City->find('list',array('conditions'=>array('City.id'=>$r['Dpo']['district'])));
                    
                     if($this->request->data['Youthleader']['allocated_block']!=0 and $this->request->data['Youthleader']['allocated_block']!='')
			{
		     $blocks=$this->Block->find('list',array('order' => array('name' => 'asc'),'conditions'=>array('Block.id'=>$this->request->data['Youthleader']['allocated_block'])));
				}
                                else {
                       $blocks=$this->Block->find('list',array('order' => array('name' => 'asc')));
                    
                                }
                  
                    if($this->request->data['Youthleader']['allocated_panchayat']!=0 and $this->request->data['Youthleader']['allocated_panchayat']!='')
			{
		     $panchayat=$this->Panchayat->find('list',array('order' => array('name' => 'asc'),'conditions'=>array('Panchayat.id'=>$this->request->data['Youthleader']['allocated_panchayat'])));
				}
                                else {
                      $panchayat=$this->Panchayat->find('list',array('order' => array('name' => 'asc')));
                    
                                }
                   
                    
                     if($this->request->data['Youthleader']['allocated_panchayat']!=0 and $this->request->data['Youthleader']['allocated_panchayat']!='')
			{
				$village=$this->Village->find('list',array('order' => array('name' => 'asc'),'conditions'=>array('Village.panchayat_id'=>$this->request->data['Youthleader']['allocated_panchayat'])));
			}
                     else {
                      $village=$this->Village->find('list',array('order' => array('name' => 'asc')));
                      } 
		}
		   }
                else {
                    
                    if($this->request->data['Youthleader']['allocated_district']!=0 and $this->request->data['Youthleader']['allocated_district']!='')
			{
		     $cities=$this->City->find('list',array('order' => array('name' => 'asc'),'conditions'=>array('City.id'=>$this->request->data['Youthleader']['allocated_district'])));
				}
                                else {
                     $cities=$this->City->find('list',array('order' => array('name' => 'asc')));
                    
                                }
                    if($this->request->data['Youthleader']['allocated_block']!=0 and $this->request->data['Youthleader']['allocated_block']!='')
			{
		     $blocks=$this->Block->find('list',array('order' => array('name' => 'asc'),'conditions'=>array('Block.id'=>$this->request->data['Youthleader']['allocated_block'])));
				}
                                else {
                       $blocks=$this->Block->find('list',array('order' => array('name' => 'asc')));
                    
                                }
                  
                    if($this->request->data['Youthleader']['allocated_panchayat']!=0 and $this->request->data['Youthleader']['allocated_panchayat']!='')
			{
		     $panchayat=$this->Panchayat->find('list',array('order' => array('name' => 'asc'),'conditions'=>array('Panchayat.id'=>$this->request->data['Youthleader']['allocated_panchayat'])));
				}
                                else {
                      $panchayat=$this->Panchayat->find('list',array('order' => array('name' => 'asc')));
                    
                                }
                   
                    
                     if($this->request->data['Youthleader']['allocated_panchayat']!=0 and $this->request->data['Youthleader']['allocated_panchayat']!='')
			{
				$village=$this->Village->find('list',array('order' => array('name' => 'asc'),'conditions'=>array('Village.panchayat_id'=>$this->request->data['Youthleader']['allocated_panchayat'])));
			}
                     else {
                      $village=$this->Village->find('list',array('order' => array('name' => 'asc')));
                      } 
                }
		//$cities=$this->City->find('list');
                $desig=$this->Designation->find('list');
		//$blocks=$this->Block->find('list');
		$ngos=$this->Ngo->find('list');
                //$panchayat=$this->Panchayat->find('list');
               // $village=$this->Village->find('list');
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
		$this->Youthleader->id = $id;
		if (!$this->Youthleader->exists()) {
			throw new NotFoundException(__('Invalid Youth leader Detail'));
		}
		   
                 if(CakeSession::read('User.type')==='regular'){
                 $menu= $this->Session->read('User.mainmenu');
                if (in_array($this->request->params['controller'].":".$this->request->params['action'], $menu)) { 
             
		    $this->Youthleader->read(null,$id);
			$this->Youthleader->set(array('status'=>$status));
		
		if ($this->Youthleader->save()) {
			$this->Session->setFlash(__('The Youthleader has been '.$status));
		} else {
			$this->Session->setFlash(__('Nothing happen. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
                
                } else {
                    
                    $this->requestAction(array('controller' => 'users', 'action' => 'checkRestriction'));
                }
                 }
                 else {
                        $this->Youthleader->read(null,$id);
			$this->Youthleader->set(array('status'=>$status));
		
		if ($this->Youthleader->save()) {
			$this->Session->setFlash(__('The Youthleader has been '.$status));
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
	$condition2.=' and Youthleader.id LIKE %'.$searchKey.'% || Youthleader.mobile LIKE %'.$searchKey.'% || Youthleader.first_name LIKE %'.$searchKey.'% || Youthleader.last_name LIKE %'.$searchKey.'% || Youthleader.email LIKE %'.$searchKey.'%';
	
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
			

		
		if(isset($this->request->query['district']) and ($this->request->query['district']!=0) and ($this->request->query['district']!='')){$searchProjectId=trim($this->request->query['district']); //$condition['Enquiry.project_id']=$searchProjectId;
		$condition2.=' and Youthleader.allocated_district='.$searchProjectId;
		}
		if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBlockId=trim($this->request->query['block']); //$condition['Enquiry.builder_id']=$searchBuilderId;
		$condition2.=' and Youthleader.allocated_block='.$searchBlockId;
		}
		
		
               if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchBuilderId=trim($this->request->query['panchayat']);  //$condition['Enquiry.country_id']=$searchCountryId;
		$condition2.=' and Youthleader.allocated_panchayat='.$searchBuilderId;
		
		}
//                if(isset($this->request->query['village']) and ($this->request->query['village']!=0) and ($this->request->query['village']!='')){$searchVillageId=trim($this->request->query['village']); //$condition['Enquiry.project_id']=$searchProjectId;
//		$condition2.=' and Youthleader.village='.$searchVillageId;
//		}
		
		
		
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
		          //  $condition['Youthleader.panchayat']=$searchProjectId;
                             $condition2.=' and Bpccc.allocated_panchayat='.$searchProjectId;
		           }   else { 
                        ///$condition=['Youthleader.panchayat IN' =>explode(',',$r['Youthleader']['allocated_panchayat'])]; 
                         $condition2.=' and Youthleader.allocated_panchayat IN ('.$r['Bpccc']['allocated_panchayat'].')';
                      } 
                      }
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Village yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
	            //$blocks=$this->Block->find('list',array('conditions'=>array('Block.id'=>$r['Youthleader']['allocated_block'])));
                    $panchayats=$this->Panchayat->find('list',array('order' => array('name' => 'asc'),'conditions'=>['Panchayat.id IN'=>explode(',',$r['Youthleader']['allocated_panchayat'])]));
                   	
		}
                
                 elseif(CakeSession::read('User.subrole')==='BPC'){
		   $r = $this->Bpc->find('first',array('conditions'=>array('Bpc.first_name='.CakeSession::read('User.id'))));
                      if($r){ 
                          if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){
                              $searchBlockId=trim($this->request->query['block']);
		        $condition2.=' and Youthleader.allocated_block='.$searchBlockId;
		        }else {
                            
                       $condition2.=' and Youthleader.allocated_block IN ('.$r['Bpc']['allocated_block'].')';
                       
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
                               $condition2.=' and Youthleader.allocated_block='.$searchBlockId;
		        // $condition['Youthleader.block']=$searchBlockId;
		        }else {
                       //$condition='Youthleader.district='.$r['Dpo']['district'];
                        $condition2.=' and Youthleader.allocated_district IN ('.$r['Dpo']['district'].')';
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
		$condition2.=' and Youthleader.status="active"';
		$this->response->download("Youthleader.csv");
		//print_r($condition); exit;
		$data=$this->Youthleader->query('select Youthleader.id,Youthleader.first_name,Youthleader.last_name,Youthleader.gender,Youthleader.age,Youthleader.mobile,Youthleader.email,Youthleader.qualification,Youthleader.designation,Youthleader.address,Youthleader.date_of_joining,Youthleader.group_name,Youthleader.remarks,City.name,Block.name,Panchayat.name,Village.name,Youthleader.status from youthleaders as Youthleader left join cities as City  on Youthleader.allocated_district=City.id left join blocks as Block  on Youthleader.allocated_block=Block.id left join panchayats as Panchayat  on Youthleader.allocated_panchayat=Panchayat.id left join  villages as Village on Youthleader.allocated_village=Village.id where 1 '.$condition2 );
		
		
		//$data = $this->Geographical->find('all', array('conditions'=>$condition2));
		
		//$log = $this->Enquiry->getDataSource()->getLog(false, false);
        //debug($log);
		//exit;
		
            $headers = array('Youthleader'=>array( 'Id' => 'Id', 'District' => 'District', 'Block' => 'Block', 'Panchayat' => 'Panchayat','Village' => 'Village','Group Name'=>'Group Name','First Name'=>'First Name','Last Name'=>'Last Name','Designation'=>'Designation','Gender'=>'Gender','Age'=>'Age', 'Mobile' => 'Mobile','Email' => 'Email', 'Education' => 'Education','Address' => 'Address','Date of Joining' => 'Date of Joining','Remarks'=>'Remarks','Status' => 'Status')); 
	    $this->set(compact('data','headers'));
		$this->layout = 'ajax';
		return;
		
		}
  ////  reports section ---/////                 

                
     public function gettitle($id) {
	  
		$options = array('conditions' => array('Youthleader.allocated_village' => $id,'Youthleader.status'=>'active'));
		$data=$this->Youthleader->find('all',$options);
		return $data;
	}             
          public function getcount($id) {
	    $this->layout='ajax';
        $this->autoRender = false;
		$options = array('conditions' => array('Youthleader.allocated_village' => $id,'Youthleader.status'=>'active'));
		$data=$this->Youthleader->find('all',$options);
		return count($data);
	} 
        
         public function getgroup($id) {
	    $this->layout='ajax';
        $this->autoRender = false;
		$data='<option value="">--Select--</option>';
		$subcatlist=$this->Youthleader->find('list',array("conditions"=>array('allocated_village'=>$id,'status'=>'active')));
		  foreach($subcatlist as $key=>$value){ $data.='<option value="'.$key.'">'.$value.'</option>';}
                  return $data;
	} 
	}
	
	
	
	
