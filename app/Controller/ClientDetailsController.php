<?php
App::uses('AppController', 'Controller');
/**
 * Ngos Controller
 *
 * @property Ngo $ClientDetailNgo
 * @property PaginatorComponent $Paginator
 */
class ClientDetailsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Upload');

    var  $uses = array('ClientDetail','Ngo','User','Project','Village','Panchayat','Ward','Country','City','Block','Designation','Bpccc','Bpc','Dpo');
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
    $condition['OR']=array('ClientDetail.id LIKE'=>'%'.$searchKey.'%','ClientDetail.name_of_client LIKE'=>'%'.$searchKey.'%','ClientDetail.client_phone LIKE'=>'%'.$searchKey.'%','ClientDetail.company_name LIKE '=>'%'.$searchKey.'%','ClientDetail.client_email LIKE '=>'%'.$searchKey.'%'); 
	
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
		$condition['ClientDetail.organization']=$searchBuilderId;
		}
		
		if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBlockId=trim($this->request->query['block']);
		$condition['ClientDetail.block']=$searchBlockId;
		}
                if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchProjectId=$this->request->query['panchayat'];
		$condition['ClientDetail.panchayat']=$searchProjectId;
               // $condition=['ClientDetail.panchayat IN' =>explode(',',$searchProjectId)]; 
                        
		}
                if(isset($this->request->query['village']) and ($this->request->query['village']!=0) and ($this->request->query['village']!='')){$searchVillageId=trim($this->request->query['village']);
		$condition['ClientDetail.village']=$searchVillageId;
		}
		
		
		

		
		
		
	}
        
		
		$this->Paginator->settings = array('ClientDetail' => array('limit' =>20,'order' => array('id' => 'desc'),'conditions'=>array($condition)));
		$this->ClientDetail->recursive = 0;
		$this->set('geographicals', $this->Paginator->paginate());
		

			
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
		if (!$this->ClientDetail->exists($id)) {
			throw new NotFoundException(__('Invalid ClientDetail'));
		}
		$options = array('conditions' => array('ClientDetail.' . $this->ClientDetail->primaryKey => $id));
		$this->set('client', $this->ClientDetail->find('first', $options));
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
			$this->ClientDetail->create();
                        //print_r($this->request->data);
                       // die();
			if ($this->ClientDetail->save($this->request->data)) {
				$this->Session->setFlash(__('The ClientDetail has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ClientDetail could not be saved. Please, try again.'));
			}
		}
                // $desig=$this->Designation->find('list');
		
               // $ward=$this->Ward->find('list');
		$this->set(compact('panchayat','cities','ngos','blocks','desig','village','ward'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->ClientDetail->exists($id)) {
			throw new NotFoundException(__('Invalid booking'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ClientDetail->save($this->request->data)) {
				$this->Session->setFlash(__('The ClientDetail has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ClientDetail could not be saved. Please, try again.'));
			}
		} else {
                    $options = array('conditions' => array('ClientDetail.' . $this->ClientDetail->primaryKey => $id));
		  $this->request->data = $this->ClientDetail->find('first', $options);
                }
	
	    
            //    $desig=$this->Designation->find('list');
		 // $ward=$this->Ward->find('list');
		$this->set(compact('panchayat','cities','ngos','blocks','desig','village','ward'));
		
	}
	
	
	
/**  
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null,$status='deactive') {
		$this->ClientDetail->id = $id;
		if (!$this->ClientDetail->exists()) {
			throw new NotFoundException(__('Invalid ClientDetail Detail'));
		}
                $get=$this->ClientDetail->find('first',array("conditions"=>array('ClientDetail.id'=>$id)));
              //print_r($get['CompanyDetail']['status']); die();
              if($get['ClientDetail']['status']=='active'){
                  $status='deactive';
              }else { $status='active';} 
               $this->ClientDetail->read(null,$id);
			$data= $this->ClientDetail->set(array('status'=>$status));
		if ($this->ClientDetail->save($data)) {
			$this->Session->setFlash(__('The ClientDetail has been '.$status));
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
    //$condition['OR']=array('ClientDetail.id LIKE'=>'%'.$searchKey.'%','ClientDetail.ward LIKE'=>'%'.$searchKey.'%','ClientDetail.awc_code LIKE'=>'%'.$searchKey.'%','ClientDetail.awc_worker LIKE '=>'%'.$searchKey.'%','ClientDetail.asha_name LIKE '=>'%'.$searchKey.'%'); 
	$condition2.=' and ClientDetail.id LIKE %'.$searchKey.'% || ClientDetail.ward_member_name LIKE %'.$searchKey.'% || ClientDetail.awc_code LIKE %'.$searchKey.'% || ClientDetail.awc_worker LIKE %'.$searchKey.'% || ClientDetail.asha_name LIKE %'.$searchKey.'%';
	
	}
	
	
		if(isset($this->request->query['organization']) and ($this->request->query['organization']!=0) and ($this->request->query['organization']!='')){$searchBuilderId=trim($this->request->query['organization']);  //$condition['Enquiry.country_id']=$searchCountryId;
		$condition2.=' and ClientDetail.organization='.$searchBuilderId;
		
		}
		
		if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBlockId=trim($this->request->query['block']); //$condition['Enquiry.builder_id']=$searchBuilderId;
		$condition2.=' and ClientDetail.block='.$searchBlockId;
		}
		
		if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchProjectId=trim($this->request->query['panchayat']); //$condition['Enquiry.project_id']=$searchProjectId;
		$condition2.=' and ClientDetail.panchayat='.$searchProjectId;
		}
               
                if(isset($this->request->query['village']) and ($this->request->query['village']!=0) and ($this->request->query['village']!='')){$searchVillageId=trim($this->request->query['village']); //$condition['Enquiry.project_id']=$searchProjectId;
		$condition2.=' and ClientDetail.village='.$searchVillageId;
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
		          //  $condition['ClientDetail.panchayat']=$searchProjectId;
                             $condition2.=' and ClientDetail.panchayat='.$searchProjectId;
		           }   else { 
                        ///$condition=['ClientDetail.panchayat IN' =>explode(',',$r['Bpccc']['allocated_panchayat'])]; 
                         $condition2.=' and ClientDetail.panchayat IN ('.$r['Bpccc']['allocated_panchayat'].')';
                      }
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('ClientDetail.id LIKE'=>'%'.$searchKey.'%','ClientDetail.ward LIKE'=>'%'.$searchKey.'%','ClientDetail.awc_code LIKE'=>'%'.$searchKey.'%','ClientDetail.awc_worker LIKE '=>'%'.$searchKey.'%','ClientDetail.asha_name LIKE '=>'%'.$searchKey.'%'); 
	
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
		        $condition2.=' and ClientDetail.block='.$searchBlockId;
		        }else {
                            
                       $condition2.=' and ClientDetail.block IN ('.$r['Bpc']['allocated_block'].')';
                       
                      }
                      if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('ClientDetail.id LIKE'=>'%'.$searchKey.'%','ClientDetail.ward LIKE'=>'%'.$searchKey.'%','ClientDetail.awc_code LIKE'=>'%'.$searchKey.'%','ClientDetail.awc_worker LIKE '=>'%'.$searchKey.'%','ClientDetail.asha_name LIKE '=>'%'.$searchKey.'%'); 
	
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
                               $condition2.=' and ClientDetail.block='.$searchBlockId;
		        // $condition['ClientDetail.block']=$searchBlockId;
		        }else {
                       //$condition='ClientDetail.district='.$r['Dpo']['district'];
                        $condition2.=' and ClientDetail.district IN ('.$r['Dpo']['district'].')';
                        }
                        if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('ClientDetail.id LIKE'=>'%'.$searchKey.'%','ClientDetail.ward LIKE'=>'%'.$searchKey.'%','ClientDetail.awc_code LIKE'=>'%'.$searchKey.'%','ClientDetail.awc_worker LIKE '=>'%'.$searchKey.'%','ClientDetail.asha_name LIKE '=>'%'.$searchKey.'%'); 
	
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
		$condition2.=' and ClientDetail.status="active"';
		$this->response->download("ClientDetail.csv");
		//print_r($condition); exit;
		$data=$this->ClientDetail->query('select ClientDetail.id,ClientDetail.no_of_house,ClientDetail.population,ClientDetail.ward_member_name,ClientDetail.ward_member_mobile,ClientDetail.awc_code,ClientDetail.aww_name,ClientDetail.aww_mobile,ClientDetail.asha_name,ClientDetail.asha_mobile,Ngo.name_of_ngo,City.name,Block.name,Panchayat.name,Village.name,Ward.name,ClientDetail.phc_name,ClientDetail.aphc_name,ClientDetail.hsc_name,ClientDetail.status from geographicals as ClientDetail left join ngos as Ngo on ClientDetail.organization=Ngo.id left join cities as City  on ClientDetail.district=City.id left join blocks as Block  on ClientDetail.block=Block.id left join panchayats as Panchayat  on ClientDetail.panchayat=Panchayat.id left join villages as Village  on ClientDetail.village=Village.id left join wards as Ward on ClientDetail.ward=Ward.id where 1 '.$condition2 );
		
		
		//$data = $this->ClientDetail->find('all', array('conditions'=>$condition2));
		
		//$log = $this->Enquiry->getDataSource()->getLog(false, false);
        //debug($log);
		//exit;
		
	$headers = array('ClientDetail'=>array( 'Id' => 'Id','NGO' => 'NGO', 'District' => 'District', 'Block' => 'Block', 'Panchayat' => 'Panchayat', 'Village' => 'Village','Ward' => 'Ward', 'Household' => 'Household','Population' => 'Population','Ward Member Name' => 'Ward Member Name','Ward Member Mobile' => 'Ward Member Mobile','AWC Code' => 'AWC Code','AWW Name' => 'AWW Name','AWW Mobile' => 'AWW Mobile','ASHA Name' => 'ASHA Name','ASHA Mobile' => 'ASHA Mobile','PHC Name' => 'PHC Name','APHC Name' => 'APHC Name','HSC Name' => 'HSC Name','Status' => 'Status')); 
	    $this->set(compact('data','headers'));
		$this->layout = 'ajax';
		return;
		
		}
  ////  reports section ---/////
                
  public function reports() {
		
		$data='';$searchKey=null;$searchUserId=null;$searchBuilderId=null;$searchProjectId=null;$fromdate=null;$todate=null;
		$condition='';$querySrting=''; $condition=array();
		$conc='';
		
		if(isset($this->params->query['confirm'])) {
	   
		if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('ClientDetail.id LIKE'=>'%'.$searchKey.'%','ClientDetail.ward LIKE'=>'%'.$searchKey.'%','ClientDetail.awc_code LIKE'=>'%'.$searchKey.'%','ClientDetail.awc_worker LIKE '=>'%'.$searchKey.'%','ClientDetail.asha_name LIKE '=>'%'.$searchKey.'%'); 
	
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
		$condition['ClientDetail.organization']=$searchBuilderId;
		}
		
		if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBlockId=trim($this->request->query['block']);
		$condition['ClientDetail.block']=$searchBlockId;
		}
                if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchProjectId=$this->request->query['panchayat'];
		$condition['ClientDetail.panchayat']=$searchProjectId;
               // $condition=['ClientDetail.panchayat IN' =>explode(',',$searchProjectId)]; 
                        
		}
                if(isset($this->request->query['village']) and ($this->request->query['village']!=0) and ($this->request->query['village']!='')){$searchVillageId=trim($this->request->query['village']);
		$condition['ClientDetail.village']=$searchVillageId;
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
		            $condition['ClientDetail.panchayat']=$searchProjectId;
		           }   else { 
                        $condition=['ClientDetail.panchayat IN' =>explode(',',$r['Bpccc']['allocated_panchayat'])]; 
                        
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
		         $condition['ClientDetail.block']=$searchBlockId;
		        }else {
                            
                       $condition=['ClientDetail.block IN' =>explode(',',$r['Bpc']['allocated_block'])];
                       
                      } 
                      }
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Block yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
		     $blocks=$this->Block->find('list',array('order' => array('name' => 'asc'),'conditions'=>array('Block.id IN'=>explode(',',$r['Bpc']['allocated_block']))));
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
		         $condition['ClientDetail.block']=$searchBlockId;
		        }else {
                       $condition='ClientDetail.district='.$r['Dpo']['district'];
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
             $blocks=$this->Block->find('list',array('order' => array('name' => 'asc')));
             $panchayats=$this->Panchayat->find('list',array('order' => array('name' => 'asc')));
              $villages=$this->Village->find('list',array('order' => array('name' => 'asc')));
              $ngos=$this->Ngo->find('list');
             
         }
		
		$geographicals= $this->ClientDetail->find ('all',array('order' => array('ClientDetail.id' => 'desc'),'conditions'=>array($condition,'ClientDetail.status'=>'active')));
		//$this->ClientDetail->recursive = 0;
		$this->set('geographicals', $geographicals);
		

			
//			$users = $this->User->find('list',array('fields'=>array('parent'),'conditions'=>array('status'=>'active')));
//			$builders=$this->Builder->find('list');
			$this->set(compact('users','blocks','panchayats','villages','ngos'));
		$this->layout='reports';	
	}
        
 ///// report  export section end  ---------/////       
        
        
	}
	
	
	
	
