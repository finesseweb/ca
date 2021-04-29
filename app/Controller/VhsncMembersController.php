<?php
App::uses('AppController', 'Controller');
/**
 * Ngos Controller
 *
 * @property Ngo $GeographicalNgo
 * @property PaginatorComponent $Paginator
 */
class VhsncMembersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Upload');

    var  $uses = array('VhsncMember','VhsncConstitution','Geographical','Ngo','User','Project','Village','Panchayat','Ward','Country','City','Block','Designation','VhsncAfc','Bpccc','Bpc','Dpo');
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
    $condition['OR']=array('VhsncMember.id LIKE'=>'%'.$searchKey.'%','VhsncMember.member_mobile LIKE'=>'%'.$searchKey.'%','VhsncMember.status LIKE'=>'%'.$searchKey.'%'); 
	
	}
	 
	   
               if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBuilderId=trim($this->request->query['block']); 
		$condition['VhsncMember.block']=$searchBuilderId;
		}
		if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchpanchayatId=trim($this->request->query['panchayat']); 
		$condition['VhsncMember.panchayat']=$searchpanchayatId;
		}
		
		if(isset($this->request->query['village']) and ($this->request->query['village']!=0) and ($this->request->query['village']!='')){$searchProjectId=trim($this->request->query['village']);
		$condition['VhsncMember.village']=$searchProjectId;
		}	
	}
           
        
                   if(CakeSession::read('User.type')==='regular'){
             
                       if(CakeSession::read('User.subrole')==='CC'){
		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'))));
                      if($r){ 
                          
                          if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchpanchayatId=trim($this->request->query['panchayat']); 
		        $condition['VhsncMember.panchayat']=$searchpanchayatId;
		          }
                          else {
                     $condition=['VhsncMember.panchayat IN' =>explode(',',$r['Bpccc']['allocated_panchayat'])];
                          }
                          if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('VhsncMember.id LIKE'=>'%'.$searchKey.'%','VhsncMember.member_mobile LIKE'=>'%'.$searchKey.'%','VhsncMember.status LIKE'=>'%'.$searchKey.'%'); 
	
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
		$condition['VhsncMember.block']=$searchBuilderId;
		}   else {
                      // $condition='VhsncMember.block='.$r['Bpc']['allocated_block'];
                       $condition=['VhsncMember.block IN' =>explode(',',$r['Bpc']['allocated_block'])];
                }
                if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('VhsncMember.id LIKE'=>'%'.$searchKey.'%','VhsncMember.member_mobile LIKE'=>'%'.$searchKey.'%','VhsncMember.status LIKE'=>'%'.$searchKey.'%'); 
	
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
		$condition['VhsncMember.block']=$searchBuilderId;
		} else {
                       $condition='VhsncMember.district='.$r['Dpo']['district'];
                }
                if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('VhsncMember.id LIKE'=>'%'.$searchKey.'%','VhsncMember.member_mobile LIKE'=>'%'.$searchKey.'%','VhsncMember.status LIKE'=>'%'.$searchKey.'%'); 
	
	}
                      } 
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Village yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
			  $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.city_id IN'=>explode(',',$r['Dpo']['district']))));
                   
                //$panchayats=$this->Panchayat->find('list');
                //$villages=$this->Village->find('list');
		}
         }
          else if(CakeSession::read('User.type')==='user'){
	   $r = $this->Ngo->find('first',array('conditions'=>array('Ngo.chief_functionary_name='.CakeSession::read('User.id'))));
                 if($r){
                     $blo=array();
                   $blo= [$r['Ngo']['allocated_block_one'],$r['Ngo']['allocated_block_two']];
                     if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){
                              $searchBlockId=trim($this->request->query['block']);
		         $condition['VhsncMember.block']=$searchBlockId;
		        }else {
                            
                       $condition=['VhsncMember.block IN' =>$blo];
                       
                      }
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('VhsncMember.id LIKE'=>'%'.$searchKey.'%','VhsncMember.member_mobile LIKE'=>'%'.$searchKey.'%','VhsncMember.status LIKE'=>'%'.$searchKey.'%'); 
	
	}
		}
                 $blocks=$this->Block->find('list',array('order' => array('name' => 'asc'),'conditions'=>array('Block.id IN'=>$blo)));
                 $ngos=$this->Ngo->find('list',array('conditions'=>array('Ngo.id'=>$r['Ngo']['id'])));
                     
         }
         else {
             $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc')));
             $panchayats=$this->Panchayat->find('list',array('order'=>array('name'=>'asc')));
              $villages=$this->Village->find('list',array('order'=>array('name'=>'asc')));
              //$ngos=$this->Ngo->find('list');
             
         }
		$this->Paginator->settings = array('VhsncMember' => array('limit' =>20,'group' => array('VhsncMember.panchayat'),'order' => array('id' => 'desc'),'conditions'=>array($condition,'VhsncMember.status'=>'active')));
		$this->VhsncMember->recursive = 0;
		$this->set('vhsncs', $this->Paginator->paginate());
		
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
		if (!$this->VhsncMember->exists($id)) {
			throw new NotFoundException(__('Invalid VHSNC Member'));
		}
		$options = array('conditions' => array('VhsncMember.' . $this->VhsncMember->primaryKey => $id));
		$this->set('vhsnc', $this->VhsncMember->find('first', $options));
		$this->layout='newdefault';
	}
	public function viewmembers($id = null) {
//		if (!$this->VhsncMember->exists($id)) {
//			throw new NotFoundException(__('Invalid VHSNC Member'));
//		}
		$options = array('conditions' => array('VhsncMember.vhsnc_name'=>$id,'VhsncMember.status'=>'active'));
		$this->set('vhsncs', $this->VhsncMember->find('all', $options));
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
			$this->VhsncMember->create();
                     // print_r($this->request->data);
                       
                       // echo count($this->request->data['VhsncAfc']['member_name']);
                       //die();
                         for($i=0;$i<count($this->request->data['VhsncMember']['member_name']);$i++){
                            $district =  $this->request->data['VhsncMember']['district'];
                            $block =  $this->request->data['VhsncMember']['block'];
                            $panchayat =  $this->request->data['VhsncMember']['panchayat'];
                            $village =  $this->request->data['VhsncMember']['village'];
                            $ward =  $this->request->data['VhsncMember']['ward'];
                            $vhsnc_name =  $this->request->data['VhsncMember']['vhsnc_id'];
                            $total_members=  $this->request->data['VhsncMember']['total_members'];
                            $member_name =  $this->request->data['VhsncMember']['member_name'][$i];
                            $mobile =  $this->request->data['VhsncMember']['member_mobile'][$i];
                            $designation=  $this->request->data['VhsncMember']['designation'][$i];
                            $vhsnc_desig =  $this->request->data['VhsncMember']['vhsnc_desig'][$i];
                            $members_type=  $this->request->data['VhsncMember']['members_type'][$i];
                           // $induction_training_date =  date('Y-m-d',strtotime($this->request->data['VhsncMember']['induction_training_date']));
                            //$refresher_date =  date('Y-m-d',strtotime($this->request->data['VhsncMember']['refresher_date']));
                            //$status =  $this->request->data['VhsncMember']['status'];
                           
                    $data=array (
                                'district'=>$district,
                                'block'=>$block,
                                'panchayat' =>$panchayat,
                                'village' =>$village,
                                'ward'=>$ward,
                                'vhsnc_name'=>$vhsnc_name,
                                'member_name'=>$member_name,
                                'member_mobile'=>$mobile,
                                'designation'=>$designation,
                                'vhsnc_desig'=>$vhsnc_desig,
                                'members_type' =>$members_type,
                                //'induction_training_date' =>$induction_training_date,
                                //'refresher_date'=>$refresher_date,
                                //'status'=>$status ,
                                'updated'=>0 
                                );  
                            
                           $save=$this->VhsncMember->saveAll($data);
				
                        }///} } }   
                         
                             
                         if($save) {
                             
                             
                            $membersdata=  $this->VhsncConstitution->query('select total_members from vhsnc_constitutions where id='.$this->request->data['VhsncMember']['vhsnc_id']);
                           $totmem=  $membersdata[0]['vhsnc_constitutions']['total_members'];
                           $subtotal = $totmem+$this->request->data['VhsncMember']['total_members'];
                          //die();
                            $memdata=  $this->VhsncConstitution->set(array('total_members'=>$subtotal,'updated'=>'0','id'=>$this->request->data['VhsncMember']['vhsnc_id']));
                          //print_r($memdata);
                         // die();
                            //echo $memdata;
                            //die();
                            if($this->VhsncConstitution->save($memdata)) {
                               $this->Session->setFlash(__('The VHSNC Member has been saved.'));
				return $this->redirect(array('action' => 'index'));

                        } else {
				$this->Session->setFlash(__('The VHSNC Member could not be saved. Please, try again.'));
			}
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
                    $village=$this->Village->find('list',array('order' => array('name' => 'asc')));
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
		if (!$this->VhsncMember->exists($id)) {
			throw new NotFoundException(__('Invalid VhsncAfc'));
		}
		if ($this->request->is(array('post', 'put'))) {
                    //print_r($this->request->data);
                    //die();
                            $member_name =  $this->request->data['VhsncMember']['member_name'];
                            $mobile =  $this->request->data['VhsncMember']['member_mobile'];
                            $designation =  $this->request->data['VhsncMember']['designation'];
                            $vhsnc_desig =  $this->request->data['VhsncMember']['vhsnc_desig'];
                            $members_type =  $this->request->data['VhsncMember']['members_type'];
                            //$induction_training_date =  date('Y-m-d',strtotime($this->request->data['VhsncMember']['induction_training_date']));
                            //$total_members=  $this->request->data['VhsncMember']['total_members'];
                           // $refresher_date =  date('Y-m-d',strtotime($this->request->data['VhsncMember']['refresher_date']));
                            $status =  $this->request->data['VhsncMember']['status'];
                            
                    $data=array (
                                'member_name'=>$member_name,
                                'member_mobile'=>$mobile,
                                'designation'=>$designation,
                                'vhsnc_desig'=>$vhsnc_desig,
                                'members_type' =>$members_type,
                                //'induction_training_date' =>$induction_training_date,
                                //'refresher_date'=>$refresher_date,
                                'status'=>$status, 
                                'updated'=>1, 
                                'id'=>$id
                                );
                      $save=$this->VhsncMember->saveAll($data);
			if ($save) {
				$this->Session->setFlash(__('The VHSNC Member has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The VHSNC Member could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('VhsncMember.' . $this->VhsncMember->primaryKey => $id));
			$this->request->data = $this->VhsncMember->find('first', $options);
			$executives=$this->User->find('list',array('conditions'=>array('User.status'=>'active','User.role'=>'regular')));
//			
                }
                 if(CakeSession::read('User.type')==='regular'){
                     
                     if(CakeSession::read('User.subrole')==='CC'){
		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'))));
                       
                      
	            $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Bpccc']['allocated_district'])));
                    $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id'=>$r['Bpccc']['allocated_block'])));
                    $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Panchayat.id IN'=>explode(',',$r['Bpccc']['allocated_panchayat']))));
                    if($this->request->data['VhsncMember']['village']!=0 and $this->request->data['VhsncMember']['village']!='')
			{
		     $village=$this->Village->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Village.id'=>$this->request->data['VhsncMember']['village'])));
		    } 
                   //$village=$this->Village->find('list');
				
		}
                
                 elseif(CakeSession::read('User.subrole')==='BPC'){
		  $r = $this->Bpc->find('first',array('conditions'=>array('Bpc.first_name='.CakeSession::read('User.id'))));
                        
	            $cities=$this->City->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('City.id'=>$r['Bpc']['allocated_district'])));
                    $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.id IN'=>explode(',',$r['Bpc']['allocated_block']))));
                     if($this->request->data['VhsncMember']['village']!=0 and $this->request->data['VhsncMember']['village']!='')
			{
		     $village=$this->Village->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Village.id'=>$this->request->data['VhsncMember']['village'])));
		    }
                    
                   if($this->request->data['VhsncMember']['panchayat']!=0 and $this->request->data['VhsncMember']['panchayat']!='')
			{
		     $panchayat=$this->Panchayat->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Panchayat.id'=>$this->request->data['VhsncMember']['panchayat'])));
		    }
                    //$panchayat=$this->Panchayat->find('list');
                    //$village=$this->Village->find('list');
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
		$this->VhsncMember->id = $id;
		if (!$this->VhsncMember->exists()) {
			throw new NotFoundException(__('Invalid VHSNC Member Detail'));
		}
		    //$this->request->onlyAllow('post', 'delete');
		    $this->VhsncMember->read(null,$id);
	           $this->VhsncMember->set(array('status'=>$status));
		
		if ($this->VhsncMember->save()) {
			$this->Session->setFlash(__('The VHSNC Member has been '.$status));
		} else {
			$this->Session->setFlash(__('Nothing happen. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
        
         public function getmembers($village) {
	    $this->layout='ajax';
        $this->autoRender = false;
	    $data='<option value="">--Select--</option>';
		$subcatlist=$this->VhsncMember->find('list',array('conditions'=>array('VhsncMember.village'=>$village)));
		foreach($subcatlist as $key=>$value){ $data.='<option value="'.$key.'">'.$value.'</option>';}
		return $data;
	}
        
	  public function getmember($village) {
	    
		$subcatlist=$this->VhsncMember->find('list',array('conditions'=>array('VhsncMember.village'=>$village)));
		
		return $subcatlist;
	}
        public function getall($vhsnc) {
	    
		$subcatlist=$this->VhsncMember->find('count',array('conditions'=>array('VhsncMember.vhsnc_name'=>$vhsnc,'VhsncMember.status'=>'active')));
		
		return $subcatlist;
	}
        
         public function getmems($id) {
	    
		$subcatlist=$this->VhsncMember->find('first',array('conditions'=>array('VhsncMember.id'=>$id)));
		
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
	$condition2.=' and VhsncMember.id LIKE %'.$searchKey.'% || VhsncMember.mobile LIKE %'.$searchKey.'% VhsncMember.member_name LIKE %'.$searchKey.'%';
	
	}
	
	
	
//	if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
//			
//			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
//			{
//				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
//				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
//				$condition2.=' and date(VhsncConstitution.constitution_date)>="'.$fromdate.'" and date(VhsncConstitution.constitution_date)<="'.$todate.'"';
//				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
//				}
//				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
//					
//				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
//				//$condition['Enquiry.posted_date']=$fromdate;	
//				$condition2.=' and date(VhsncConstitution.constitution_date)="'.$fromdate.'"';
//				}
//				else
//				{
//					
//					}
//			}
			
			
  
//		if(isset($this->request->query['organization']) and ($this->request->query['organization']!=0) and ($this->request->query['organization']!='')){$searchBuilderId=trim($this->request->query['organization']);  //$condition['Enquiry.country_id']=$searchCountryId;
//		$condition2.=' and VhsncMember.organization='.$searchBuilderId;
//		
//		}
//		
		if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBlockId=trim($this->request->query['block']); //$condition['Enquiry.builder_id']=$searchBuilderId;
		$condition2.=' and VhsncMember.block='.$searchBlockId;
		}
		
		if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchProjectId=trim($this->request->query['panchayat']); //$condition['Enquiry.project_id']=$searchProjectId;
		$condition2.=' and VhsncMember.panchayat='.$searchProjectId;
		}
               
                if(isset($this->request->query['village']) and ($this->request->query['village']!=0) and ($this->request->query['village']!='')){$searchVillageId=trim($this->request->query['village']); //$condition['Enquiry.project_id']=$searchProjectId;
		$condition2.=' and VhsncMember.village='.$searchVillageId;
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
                             $condition2.=' and VhsncMember.panchayat='.$searchProjectId;
		           }   else { 
                        ///$condition=['VhsncAfc.panchayat IN' =>explode(',',$r['Bpccc']['allocated_panchayat'])]; 
                         $condition2.=' and VhsncMember.panchayat IN ('.$r['Bpccc']['allocated_panchayat'].')';
                      }
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('VhsncMember.id LIKE'=>'%'.$searchKey.'%','VhsncMember.member_mobile LIKE'=>'%'.$searchKey.'%','VhsncMember.status LIKE'=>'%'.$searchKey.'%'); 
	
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
		        $condition2.=' and VhsncMember.block='.$searchBlockId;
		        }else {
                            
                       $condition2.=' and VhsncMember.block IN ('.$r['Bpc']['allocated_block'].')';
                       
                      }
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('VhsncMember.id LIKE'=>'%'.$searchKey.'%','VhsncMember.member_mobile LIKE'=>'%'.$searchKey.'%','VhsncMember.status LIKE'=>'%'.$searchKey.'%'); 
	
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
                               $condition2.=' and VhsncMember.block='.$searchBlockId;
		        // $condition['VhsncAfc.block']=$searchBlockId;
		        }else {
                       //$condition='VhsncAfc.district='.$r['Dpo']['district'];
                        $condition2.=' and VhsncMember.district IN ('.$r['Dpo']['district'].')';
                        }
                        if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('VhsncMember.id LIKE'=>'%'.$searchKey.'%','VhsncMember.member_mobile LIKE'=>'%'.$searchKey.'%','VhsncMember.status LIKE'=>'%'.$searchKey.'%'); 
	
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
		$condition2.=' and VhsncMember.status="active"';
		$this->response->download("VhsncMember.csv");
		//print_r($condition); exit;
	    $data=$this->VhsncMember->query('select VhsncMember.id,VhsncMember.member_name,VhsncMember.member_mobile,City.name,Block.name,VhsncConstitution.vhsnc_name,Panchayat.name,Designation.name,VhsncMember.designation,VhsncMember.members_type,VhsncMember.status from vhsnc_members as VhsncMember left join cities as City  on VhsncMember.district=City.id left join blocks as Block  on VhsncMember.block=Block.id left join vhsnc_constitutions as VhsncConstitution  on VhsncMember.vhsnc_name=VhsncConstitution.id left join panchayats as Panchayat on VhsncMember.panchayat=Panchayat.id left join designations as Designation on VhsncMember.vhsnc_desig=Designation.id where 1 '.$condition2 );
		
		
		//$data = $this->Geographical->find('all', array('conditions'=>$condition2));
		
		//$log = $this->Enquiry->getDataSource()->getLog(false, false);
        //debug($log);
		//exit;
		
            $headers = array('VhsncMember'=>array( 'Id' => 'Id','District' => 'District', 'Block' => 'Block','Panchayat' => 'Panchayat','VHSNC Name'=>'VHSNC Name','Member Name'=>'Member Name','Member Mobile'=>'Member Mobile','Designation'=>'Designation','VHSNC Designation'=>'VHSNC Designation','Type of VHSNC Member'=>'Type of VHSNC Member','Status'=>'Status')); 
	    $this->set(compact('data','headers'));
		$this->layout = 'ajax';
		return;
		
		}
  ////  reports section ---///// 
        
        
	}
	
	
	
	
