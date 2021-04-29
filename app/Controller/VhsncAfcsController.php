<?php
App::uses('AppController', 'Controller');
/**
 * Ngos Controller
 *
 * @property Ngo $VhsncAfcNgo
 * @property PaginatorComponent $Paginator
 */
class VhsncAfcsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Upload');

    var  $uses = array('VhsncAfc','Ngo','User','Project','Village','Panchayat','Location','Country','City','Block','Designation','Bpccc','Bpc','Dpo');
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
    $condition['OR']=array('VhsncAfc.id LIKE'=>'%'.$searchKey.'%','VhsncAfc.mobile LIKE '=>'%'.$searchKey.'%','VhsncAfc.member_name LIKE '=>'%'.$searchKey.'%'); 
	
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
		$condition['VhsncAfc.organization']=$searchBuilderId;
		}
		
		if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBlockId=trim($this->request->query['block']);
		$condition['VhsncAfc.block']=$searchBlockId;
		}
                if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchPanchayatId=trim($this->request->query['panchayat']);
		$condition['VhsncAfc.panchayat']=$searchPanchayatId;
		}
                if(isset($this->request->query['village']) and ($this->request->query['village']!=0) and ($this->request->query['village']!='')){$searchvillageId=trim($this->request->query['village']);
		$condition['VhsncAfc.village']=$searchvillageId;
		}
		
	}
        if(CakeSession::read('User.type')==='regular'){
             //echo CakeSession::read('User.subrole');
            // die();
             if(CakeSession::read('User.subrole')==='CC'){
		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'))));
                      if($r){ 
                          if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){
                           $searchPanchayatId=trim($this->request->query['panchayat']);
		            $condition['VhsncAfc.panchayat']=$searchPanchayatId;
		           }   else { 
                        $condition=['VhsncAfc.panchayat IN' =>explode(',',$r['Bpccc']['allocated_panchayat'])]; 
                        
                      }
                      if(isset($this->request->query['organization']) and ($this->request->query['organization']!=0) and ($this->request->query['organization']!='')){$searchBuilderId=trim($this->request->query['organization']); 
		$condition['VhsncAfc.organization']=$searchBuilderId;
		}
          if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
             $condition['OR']=array('VhsncAfc.id LIKE'=>'%'.$searchKey.'%','VhsncAfc.mobile LIKE '=>'%'.$searchKey.'%','VhsncAfc.member_name LIKE '=>'%'.$searchKey.'%'); 
	
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
		         $condition['VhsncAfc.block']=$searchBlockId;
		        }else {
                       $condition=['VhsncAfc.block IN' =>explode(',',$r['Bpc']['allocated_block'])];
                       
                      } 
                      if(isset($this->request->query['organization']) and ($this->request->query['organization']!=0) and ($this->request->query['organization']!='')){$searchBuilderId=trim($this->request->query['organization']); 
		$condition['VhsncAfc.organization']=$searchBuilderId;
		}
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
                    $condition['OR']=array('VhsncAfc.id LIKE'=>'%'.$searchKey.'%','VhsncAfc.mobile LIKE '=>'%'.$searchKey.'%','VhsncAfc.member_name LIKE '=>'%'.$searchKey.'%'); 
	
	}
                      }
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Block yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
		     $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id IN'=>explode(',',$r['Bpc']['allocated_block']))));
                   ///$villages=$this->Village->find('list');
                   //$panchayats=$this->Panchayat->find('list');
                    $condition2['OR']=array('Ngo.allocated_block_one'=>explode(',',$r['Bpc']['allocated_block']),'Ngo.allocated_block_two'=>explode(',',$r['Bpc']['allocated_block'])); 
                    $ngos=$this->Ngo->find('list',array('conditions'=>$condition2));
                    
		}
                
                
                 else {
		   $r = $this->Dpo->find('first',array('conditions'=>array('Dpo.first_name='.CakeSession::read('User.id'))));
                      if($r){ 
                           if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){
                              $searchBlockId=trim($this->request->query['block']);
		         $condition['VhsncAfc.block']=$searchBlockId;
                           } else {
                       $condition='VhsncAfc.district='.$r['Dpo']['district'];
                        }
                        if(isset($this->request->query['organization']) and ($this->request->query['organization']!=0) and ($this->request->query['organization']!='')){$searchBuilderId=trim($this->request->query['organization']); 
		$condition['VhsncAfc.organization']=$searchBuilderId;
		}
                        if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
                   $condition['OR']=array('VhsncAfc.id LIKE'=>'%'.$searchKey.'%','VhsncAfc.mobile LIKE '=>'%'.$searchKey.'%','VhsncAfc.member_name LIKE '=>'%'.$searchKey.'%'); 
	
	}
                      } 
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Village yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
	             $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.city_id IN'=>explode(',',$r['Dpo']['district']))));
                     $ngos=$this->Ngo->find('list',array('conditions'=>array('Ngo.allocated_district IN'=>explode(',',$r['Dpo']['district']))));
                     
		}
         }else if(CakeSession::read('User.type')==='user'){
	   $r = $this->Ngo->find('first',array('conditions'=>array('Ngo.chief_functionary_name='.CakeSession::read('User.id'))));
                 if($r){
                     $blo=array();
                   $blo= [$r['Ngo']['allocated_block_one'],$r['Ngo']['allocated_block_two']];
                     if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){
                              $searchBlockId=trim($this->request->query['block']);
		         $condition['VhsncAfc.block']=$searchBlockId;
		        }else {
                            
                       $condition=['VhsncAfc.block IN' =>$blo];
                       
                      }
                      if(isset($this->request->query['organization']) and ($this->request->query['organization']!=0) and ($this->request->query['organization']!='')){$searchBuilderId=trim($this->request->query['organization']); 
		$condition['VhsncAfc.organization']=$searchBuilderId;
		}
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
                  $condition['OR']=array('VhsncAfc.id LIKE'=>'%'.$searchKey.'%','VhsncAfc.mobile LIKE '=>'%'.$searchKey.'%','VhsncAfc.member_name LIKE '=>'%'.$searchKey.'%'); 
	
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
	
		
		$this->Paginator->settings = array('VhsncAfc' => array('limit' =>20,'group'=>array('village'),'order' => array('id' => 'desc'),'conditions'=>array($condition,'VhsncAfc.status'=>'active')));
		$this->VhsncAfc->recursive = 0;
		$this->set('vhsncafcs', $this->Paginator->paginate());
		//$blocks=$this->Block->find('list');
		//$panchayats=$this->Panchayat->find('list');
		//$villages=$this->Village->find('list');
                //$ngos=$this->Ngo->find('list');
			
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
//	public function view($id = null) {
//		if (!$this->VhsncAfc->exists($id)) {
//			throw new NotFoundException(__('Invalid VHSNC/AFV'));
//		}
//		$options = array('conditions' => array('VhsncAfc.' . $this->VhsncAfc->primaryKey => $id));
//		$this->set('vhsncAfc', $this->VhsncAfc->find('first', $options));
//		$this->layout='newdefault';
//	}
//        
        public function view($id = null) {
//		if (!$this->VhsncAfc->exists($id)) {
//			throw new NotFoundException(__('Invalid VHSNC/AFV'));
//		}
		$options = array('conditions' => array('VhsncAfc.village' => $id,'VhsncAfc.status'=>'active'));
		$this->set('vhsncAfcs', $this->VhsncAfc->find('all', $options));
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
			$this->VhsncAfc->create();
                      // print_r($this->request->data['VhsncAfc']['member_name']);
                       
                       // echo count($this->request->data['VhsncAfc']['member_name']);
                        //die();
                        for($i=0;$i<count($this->request->data['VhsncAfc']['member_name']);$i++){
                            
                            //echo $i;
                            //foreach($this->request->data['VhsncAfc']['member_name'] as $member) {
                                
                               // foreach($this->request->data['VhsncAfc']['mobile'] as $mobile) {
                                   // foreach($this->request->data['VhsncAfc']['induction_training_date'] as $induction_training_date) {
                                    //foreach($this->request->data['VhsncAfc']['refresher_date'] as $refresher_date) {
                          //print_r($mobile);
                          //die();
                            $organization =  $this->request->data['VhsncAfc']['organization'];
                           
                            $district =  $this->request->data['VhsncAfc']['district'];
                            $block =  $this->request->data['VhsncAfc']['block'];
                            $panchayat =  $this->request->data['VhsncAfc']['panchayat'];
                            $village =  $this->request->data['VhsncAfc']['village'];
                           // $cc_name =  $this->request->data['VhsncAfc']['cc_name'];
                            //$vhsnc_member_type =  $this->request->data['VhsncAfc']['vhsnc_type'];
                             $member_type =  $this->request->data['VhsncAfc']['member_type'][$i];
                            $member_name =  $this->request->data['VhsncAfc']['member_name'][$i];
                            $mobile =  $this->request->data['VhsncAfc']['mobile'][$i];
                           // $designation =  $this->request->data['VhsncConstitution']['designation'][$i];
                           // $vhsnc_desig = $this->request->data['VhsncConstitution']['vhsnc_desig'][$i];
                           //$induction_training_date =  date('Y-m-d',strtotime($this->request->data['VhsncAfc']['induction_training_date'][$i]));
                            //$refresher_date =  date('Y-m-d',strtotime($this->request->data['VhsncAfc']['refresher_date'][$i]));
                           
                    $data=array (
                                'organization'=>$organization,
                                'member_type'=>$member_type,
                                'district' =>$district,
                                'block' =>$block,
                                'panchayat'=>$panchayat,
                                'village'=> $village,
                                //'cc_name'=>$cc_name,
                               // 'vhsnc_type'=>$vhsnc_member_type,
                                'member_name'=>$member_name,
                                'mobile' =>$mobile,
                                //'designation'=>$designation,
                                //'vhsnc_desig'=>$vhsnc_desig,
                                //'induction_training_date'=>$induction_training_date,
                                //'refresher_date'=>$refresher_date
                                );  
                    
                           $save=$this->VhsncAfc->saveAll($data);
				
                         }///} } }   
                         
                             
                         if($save) {
                         $this->Session->setFlash(__('The AFC has been saved.'));
				return $this->redirect(array('action' => 'index'));

                        } else {
				$this->Session->setFlash(__('The Vhsnc/Afc could not be saved. Please, try again.'));
			}
			
                    }   
                if(CakeSession::read('User.type')==='regular'){
                     
                     if(CakeSession::read('User.subrole')==='CC'){
		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'))));
                       
                     
	            $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Bpccc']['allocated_district'])));
                    $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id'=>$r['Bpccc']['allocated_block'])));
                    $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>['Panchayat.id IN'=>explode(',',$r['Bpccc']['allocated_panchayat'])]));
                    $condition['OR']=array('Ngo.allocated_block_one'=>$r['Bpccc']['allocated_block'],'Ngo.allocated_block_two'=>$r['Bpccc']['allocated_block']); 

                    $ngos=$this->Ngo->find('list',array('conditions'=>$condition));
// print_r($panchayat);
                    //die();
                    $village=$this->Village->find('list',array('order'=>array('name'=>'asc')));	
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
                //$panchayat=$this->Panchayat->find('list');
               // $village=$this->Village->find('list');
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
		if (!$this->VhsncAfc->exists($id)) {
			throw new NotFoundException(__('Invalid VhsncAfc'));
		}
		if ($this->request->is(array('post', 'put'))) {
                    
                    $organization =  $this->request->data['VhsncAfc']['organization'];
                            $member_type =  $this->request->data['VhsncAfc']['member_type'];
                            $district =  $this->request->data['VhsncAfc']['district'];
                            $block =  $this->request->data['VhsncAfc']['block'];
                            $panchayat =  $this->request->data['VhsncAfc']['panchayat'];
                            $village =  $this->request->data['VhsncAfc']['village'];
                            //$cc_name =  $this->request->data['VhsncAfc']['cc_name'];
                           // $vhsnc_member_type = $this->request->data['VhsncAfc']['vhsnc_type'];
                            $member_name =  $this->request->data['VhsncAfc']['member_name'];
                            $mobile =  $this->request->data['VhsncAfc']['mobile'];
                            //$designation =  $this->request->data['VhsncAfc']['designation'];
                            //$vhsnc_desig = $this->request->data['VhsncAfc']['vhsnc_desig'];
                           // $induction_training_date =  date('Y-m-d',strtotime($this->request->data['VhsncAfc']['induction_training_date']));
                           // $refresher_date =  date('Y-m-d',strtotime($this->request->data['VhsncAfc']['refresher_date']));
                            $status =  $this->request->data['VhsncAfc']['status'];
                           
                    $data=array (
                                'organization'=>$organization,
                                'member_type'=>$member_type,
                                'district' =>$district,
                                'block' =>$block,
                                'panchayat'=>$panchayat,
                                'village'=> $village,
                               // 'cc_name'=>$cc_name,
                               // 'vhsnc_type'=>$vhsnc_member_type,
                                'member_name'=>$member_name,
                                'mobile' =>$mobile,
                              //  'designation'=>$designation,
                              //  'vhsnc_desig'=>$vhsnc_desig,
                               // 'induction_training_date'=>$induction_training_date,
                              //  'refresher_date'=>$refresher_date,
                                'status'=>$status,
                                 'id'=>$id
                                );  
                    
			if ($this->VhsncAfc->save($data)) {
				$this->Session->setFlash(__('The Afc has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Afc could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('VhsncAfc.' . $this->VhsncAfc->primaryKey => $id));
			$this->request->data = $this->VhsncAfc->find('first', $options);
			
			}
                        
                          if(CakeSession::read('User.type')==='regular'){
                     
                     if(CakeSession::read('User.subrole')==='CC'){
		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'))));
                       
                     
	            $cities=$this->City->find('list',array('conditions'=>array('City.id'=>$r['Bpccc']['allocated_district'])));
                    $blocks=$this->Block->find('list',array('conditions'=>array('Block.id'=>$r['Bpccc']['allocated_block'])));
                    $panchayat=$this->Panchayat->find('list',array('conditions'=>['Panchayat.id IN'=>explode(',',$r['Bpccc']['allocated_panchayat'])]));
                   // print_r($panchayat);
                    //die();
                    if($this->request->data['VhsncAfc']['panchayat']!=0 and $this->request->data['VhsncAfc']['panchayat']!='')
			{
				$village=$this->Village->find('list',array('conditions'=>array('Village.panchayat_id'=>$this->request->data['VhsncAfc']['panchayat'])));
				}
                                else {
                    $village=$this->Village->find('list',array('order'=>array('name'=>'asc')));
                    
                                }
                                
                   $condition['OR']=array('Ngo.allocated_block_one'=>$r['Bpccc']['allocated_block'],'Ngo.allocated_block_two'=>$r['Bpccc']['allocated_block']); 

                    $ngos=$this->Ngo->find('list',array('conditions'=>$condition));
		}
                
                 elseif(CakeSession::read('User.subrole')==='BPC'){
		  $r = $this->Bpc->find('first',array('conditions'=>array('Bpc.first_name='.CakeSession::read('User.id'))));
                       
                     
	            $cities=$this->City->find('list',array('conditions'=>array('City.id'=>$r['Bpc']['allocated_district'])));
                    $blocks=$this->Block->find('list',array('conditions'=>array('Block.id IN'=>explode(',',$r['Bpc']['allocated_block']))));
                     if($this->request->data['VhsncAfc']['panchayat']!=0 and $this->request->data['VhsncAfc']['panchayat']!='')
			{
		     $panchayat=$this->Panchayat->find('list',array('conditions'=>array('Panchayat.id'=>$this->request->data['VhsncAfc']['panchayat'])));
				}
                                else {
                      $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc')));
                    
                                }
                   
                    
                     if($this->request->data['VhsncAfc']['panchayat']!=0 and $this->request->data['VhsncAfc']['panchayat']!='')
			{
				$village=$this->Village->find('list',array('conditions'=>array('Village.panchayat_id'=>$this->request->data['VhsncAfc']['panchayat'])));
			}
                     else {
                      $village=$this->Village->find('list',array('order'=>array('name'=>'asc')));
                      }
                      
                      $condition['OR']=array('Ngo.allocated_block_one'=>explode(',',$r['Bpc']['allocated_block']),'Ngo.allocated_block_two'=>explode(',',$r['Bpc']['allocated_block'])); 
                    $ngos=$this->Ngo->find('list',array('conditions'=>$condition));
                    
		}
                
                
                 else {
		  $r = $this->Dpo->find('first',array('conditions'=>array('Dpo.first_name='.CakeSession::read('User.id'))));
                         
	            $cities=$this->City->find('list',array('conditions'=>array('City.id'=>$r['Dpo']['district'])));
                    
                     if($this->request->data['VhsncAfc']['block']!=0 and $this->request->data['VhsncAfc']['block']!='')
			{
		     $blocks=$this->Block->find('list',array('conditions'=>array('Block.id'=>$this->request->data['VhsncAfc']['block'])));
				}
                                else {
                       $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc')));
                    
                                }
                  
                    if($this->request->data['VhsncAfc']['panchayat']!=0 and $this->request->data['VhsncAfc']['panchayat']!='')
			{
		     $panchayat=$this->Panchayat->find('list',array('conditions'=>array('Panchayat.id'=>$this->request->data['VhsncAfc']['panchayat'])));
				}
                                else {
                      $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc')));
                    
                                }
                   
                    
                     if($this->request->data['VhsncAfc']['panchayat']!=0 and $this->request->data['VhsncAfc']['panchayat']!='')
			{
				$village=$this->Village->find('list',array('conditions'=>array('Village.panchayat_id'=>$this->request->data['VhsncAfc']['panchayat'])));
			}
                     else {
                      $village=$this->Village->find('list',array('order'=>array('name'=>'asc')));
                      }
                      
                       if($this->request->data['VhsncAfc']['organization']!=0 and $this->request->data['VhsncAfc']['organization']!='')
			{
				$ngos=$this->Ngo->find('list',array('conditions'=>array('Ngo.id'=>$this->request->data['VhsncAfc']['organization'])));
			}
                     else {
                     $ngos=$this->Ngo->find('list',array('conditions'=>array('Ngo.allocated_district'=>$r['Dpo']['district'])));
                      }
                      
		}
		   }
                else {
                    
                    if($this->request->data['VhsncAfc']['district']!=0 and $this->request->data['VhsncAfc']['district']!='')
			{
		     $cities=$this->City->find('list',array('conditions'=>array('City.id'=>$this->request->data['VhsncAfc']['district'])));
				}
                                else {
                     $cities=$this->City->find('list',array('order'=>array('name'=>'asc')));
                    
                                }
                    if($this->request->data['VhsncAfc']['block']!=0 and $this->request->data['VhsncAfc']['block']!='')
			{
		     $blocks=$this->Block->find('list',array('conditions'=>array('Block.id'=>$this->request->data['VhsncAfc']['block'])));
				}
                                else {
                       $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc')));
                    
                                }
                  
                    if($this->request->data['VhsncAfc']['panchayat']!=0 and $this->request->data['VhsncAfc']['panchayat']!='')
			{
		     $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Panchayat.id'=>$this->request->data['VhsncAfc']['panchayat'])));
				}
                                else {
                      $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'order'=>array('name'=>'asc')));
                    
                                }
                   
                    
                     if($this->request->data['VhsncAfc']['panchayat']!=0 and $this->request->data['VhsncAfc']['panchayat']!='')
			{
				$village=$this->Village->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Village.panchayat_id'=>$this->request->data['VhsncAfc']['panchayat'])));
			}
                     else {
                      $village=$this->Village->find('list',array('order'=>array('name'=>'asc')));
                      } 
                     if($this->request->data['VhsncAfc']['organization']!=0 and $this->request->data['VhsncAfc']['organization']!='')
			{
				$ngos=$this->Ngo->find('list',array('conditions'=>array('Ngo.id'=>$this->request->data['VhsncAfc']['organization'])));
			}
                     else {
                     $ngos=$this->Ngo->find('list');
                      }
                }
		//$cities=$this->City->find('list');
                $desig=$this->Designation->find('list');
		//$blocks=$this->Block->find('list');
		
                ////$panchayat=$this->Panchayat->find('list');
                //$village=$this->Village->find('list');
		$this->set(compact('panchayat','cities','ngos','blocks','desig','village'));
		
	}
	
	
	
	

	
	public function delete($id = null,$status='deactive') {
		$this->VhsncAfc->id = $id;
		if (!$this->VhsncAfc->exists()) {
			throw new NotFoundException(__('Invalid Afc Detail'));
		}
                 if(CakeSession::read('User.type')==='regular'){
		     if (in_array($this->request->params['controller'].":".$this->request->params['action'], $menu)) { 
            
		    $this->VhsncAfc->read(null,$id);
			$this->VhsncAfc->set(array('status'=>$status));
		
		if ($this->VhsncAfc->save()) {
			$this->Session->setFlash(__('The Afc has been '.$status));
		} else {
			$this->Session->setFlash(__('Nothing happen. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
                     } else {
                         
                          $this->requestAction(array('controller' => 'users', 'action' => 'checkRestriction'));
                     }
                 } else {
                       $this->VhsncAfc->read(null,$id);
                       //echo $id;
                       //die();
			$this->VhsncAfc->set(array('status'=>$status));
		
		if ($this->VhsncAfc->save()) {
                    
			$this->Session->setFlash(__('The Afc has been '.$status));
		} else {
			$this->Session->setFlash(__('Nothing happen. Please, try again.'));
		}
                return $this->redirect(array('action' => 'index'));
                 }
	}
	
	
	public function getvhsnc() {
	    $this->layout='ajax';
        $this->autoRender = false;
	    $data='<option value="">Select VHSNC</option>';
		$subcatlist=$this->VhsncAfc->find('list',array('conditions'=>array('VhsncAfc.member_type'=>'VHSNC')));
		foreach($subcatlist as $key=>$value){ $data.='<option value="'.$key.'">'.$value.'</option>';}
		return $data;
	}
        public function getmobile($id) {
	    $this->layout='ajax';
        $this->autoRender = false;
	    
		$subcatlist=$this->VhsncAfc->find('all',array('conditions'=>array('VhsncAfc.id'=>$id)));
		foreach($subcatlist as $key=>$value){ $data =$value['VhsncAfc']['mobile'];
               // die();
                }
		return $data;
	}
        public function getmembers($village) {
	    $this->layout='ajax';
        $this->autoRender = false;
	    $data='<option value="">--Select--</option>';
		$subcatlist=$this->VhsncAfc->find('list',array('conditions'=>array('VhsncAfc.village'=>$village)));
		foreach($subcatlist as $key=>$value){ $data.='<option value="'.$key.'">'.$value.'</option>';}
		return $data;
	}
        
        public function getmember($village) {
	    
		$subcatlist=$this->VhsncAfc->find('list',array('conditions'=>array('VhsncAfc.village'=>$village)));
		
		return $subcatlist;
	}
        public function gettotal($village) {
	    
		$subcatlist=$this->VhsncAfc->find('all',array('conditions'=>array('VhsncAfc.village'=>$village,'VhsncAfc.status'=>'active')));
		
		return $subcatlist;
	}
	public function getmems($id) {
	    
		$subcatlist=$this->VhsncAfc->find('first',array('conditions'=>array('VhsncAfc.id'=>$id)));
		
		return $subcatlist;
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
	$condition2.=' and VhsncAfc.id LIKE %'.$searchKey.'% || VhsncAfc.mobile LIKE %'.$searchKey.'% VhsncAfc.member_name LIKE %'.$searchKey.'%';
	
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
		$condition2.=' and VhsncAfc.organization='.$searchBuilderId;
		
		}
		
		if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBlockId=trim($this->request->query['block']); //$condition['Enquiry.builder_id']=$searchBuilderId;
		$condition2.=' and VhsncAfc.block='.$searchBlockId;
		}
		
		if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchProjectId=trim($this->request->query['panchayat']); //$condition['Enquiry.project_id']=$searchProjectId;
		$condition2.=' and VhsncAfc.panchayat='.$searchProjectId;
		}
               
                if(isset($this->request->query['village']) and ($this->request->query['village']!=0) and ($this->request->query['village']!='')){$searchVillageId=trim($this->request->query['village']); //$condition['Enquiry.project_id']=$searchProjectId;
		$condition2.=' and VhsncAfc.village='.$searchVillageId;
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
                             $condition2.=' and VhsncAfc.panchayat='.$searchProjectId;
		           }   else { 
                        ///$condition=['VhsncAfc.panchayat IN' =>explode(',',$r['Bpccc']['allocated_panchayat'])]; 
                         $condition2.=' and VhsncAfc.panchayat IN ('.$r['Bpccc']['allocated_panchayat'].')';
                      }
                      if(isset($this->request->query['organization']) and ($this->request->query['organization']!=0) and ($this->request->query['organization']!='')){$searchBuilderId=trim($this->request->query['organization']);  //$condition['Enquiry.country_id']=$searchCountryId;
		$condition2.=' and VhsncAfc.organization='.$searchBuilderId;
		
		}
		
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('VhsncAfc.id LIKE'=>'%'.$searchKey.'%','VhsncAfc.mobile LIKE '=>'%'.$searchKey.'%','VhsncAfc.member_name LIKE '=>'%'.$searchKey.'%'); 
	
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
		        $condition2.=' and VhsncAfc.block='.$searchBlockId;
		        }else {
                            
                       $condition2.=' and VhsncAfc.block IN ('.$r['Bpc']['allocated_block'].')';
                       
                      }
                      if(isset($this->request->query['organization']) and ($this->request->query['organization']!=0) and ($this->request->query['organization']!='')){$searchBuilderId=trim($this->request->query['organization']);  //$condition['Enquiry.country_id']=$searchCountryId;
		$condition2.=' and VhsncAfc.organization='.$searchBuilderId;
		
		}
		
                      
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('VhsncAfc.id LIKE'=>'%'.$searchKey.'%','VhsncAfc.mobile LIKE '=>'%'.$searchKey.'%','VhsncAfc.member_name LIKE '=>'%'.$searchKey.'%'); 
	
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
                               $condition2.=' and VhsncAfc.block='.$searchBlockId;
		        // $condition['VhsncAfc.block']=$searchBlockId;
		        }else {
                       //$condition='VhsncAfc.district='.$r['Dpo']['district'];
                        $condition2.=' and VhsncAfc.district IN ('.$r['Dpo']['district'].')';
                        }
                        if(isset($this->request->query['organization']) and ($this->request->query['organization']!=0) and ($this->request->query['organization']!='')){$searchBuilderId=trim($this->request->query['organization']);  //$condition['Enquiry.country_id']=$searchCountryId;
		$condition2.=' and VhsncAfc.organization='.$searchBuilderId;
		
		}
		
                        if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('VhsncAfc.id LIKE'=>'%'.$searchKey.'%','VhsncAfc.mobile LIKE '=>'%'.$searchKey.'%','VhsncAfc.member_name LIKE '=>'%'.$searchKey.'%'); 
	
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
		$condition2.=' and VhsncAfc.status="active"';
		$this->response->download("VhsncAfc.csv");
		//print_r($condition); exit;
	    $data=$this->VhsncAfc->query('select VhsncAfc.id,VhsncAfc.member_type,VhsncAfc.member_name,VhsncAfc.mobile,City.name,Block.name,Ngo.name_of_ngo,Panchayat.name,Village.name,VhsncAfc.status from vhsnc_afcs as VhsncAfc left join cities as City  on VhsncAfc.district=City.id left join blocks as Block  on VhsncAfc.block=Block.id left join ngos as Ngo  on VhsncAfc.organization=Ngo.id left join panchayats as Panchayat on VhsncAfc.panchayat=Panchayat.id left join villages as Village on VhsncAfc.village=Village.id where 1 '.$condition2 );
		
		
		//$data = $this->Geographical->find('all', array('conditions'=>$condition2));
		
		//$log = $this->Enquiry->getDataSource()->getLog(false, false);
        //debug($log);
		//exit;
		
            $headers = array('VhsncAfc'=>array( 'Id' => 'Id', 'Organization' => 'Organization', 'District' => 'District', 'Block' => 'Block','Panchayat' => 'Panchayat','Village'=>'Village','Member Type'=>'Member Type','Member Name'=>'Member Name','Mobile'=>'Mobile','Status'=>'Status')); 
	    $this->set(compact('data','headers'));
		$this->layout = 'ajax';
		return;
		
		}
  ////  reports section ---/////   
	
	}
	
	
	
	
