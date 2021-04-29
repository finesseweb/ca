<?php
App::uses('AppController', 'Controller');
/**
 * Ngos Controller
 *
 * @property Ngo $GeographicalNgo
 * @property PaginatorComponent $Paginator
 */
class IssuesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Upload');

    var  $uses = array('Issue','Geographical','Ngo','User','RegisterMember','Village','Panchayat','VhsncMeeting','Country','City','Block','Designation','Ward','IssueCategory','IssueSubcategory','Bpccc','Bpc','Dpo','Dpmc','Bpmc','AnmMeeting','SocialAudit');
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
    $condition['OR']=array('Issue.id LIKE'=>'%'.$searchKey.'%','Issue.new_issues_identified LIKE'=>'%'.$searchKey.'%','Issue.decision_taken LIKE'=>'%'.$searchKey.'%'); 
	
	}
		
		if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(Issue.meeting_date) >='=>$fromdate,'date(Issue.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['Issue.meeting_date']=$fromdate;	
				}
				
			}
		if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBuilderId=trim($this->request->query['block']); 
		$condition['Issue.block']=$searchBuilderId;
		}
		if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchPanchayatId=trim($this->request->query['panchayat']); 
		$condition['Issue.panchayat']=$searchPanchayatId;
		}
		
		if(isset($this->request->query['village']) and ($this->request->query['village']!=0) and ($this->request->query['village']!='')){$searchProjectId=trim($this->request->query['village']);
		$condition['Issue.village']=$searchProjectId;
		}
//                if(isset($this->request->query['ward']) and ($this->request->query['ward']!=0) and ($this->request->query['ward']!='')){$searchProjectId=trim($this->request->query['ward']);
//		$condition['Issue.ward']=$searchProjectId;
//		}
		
		
		
	}
		 if(CakeSession::read('User.type')==='regular'){
             //echo CakeSession::read('User.subrole');
            // die();
             if(CakeSession::read('User.subrole')==='CC'){
		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'))));
                      if($r){ 
                          if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchPanchayatId=trim($this->request->query['panchayat']); 
		          $condition['Issue.panchayat']=$searchPanchayatId;
		             }
                             else {
		
                      // $condition='Issue.panchayat='.$r['Bpccc']['allocated_panchayat'];
                        $condition=['Issue.panchayat IN' =>explode(',',$r['Bpccc']['allocated_panchayat'])];
                             }
                             
                             if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('Issue.id LIKE'=>'%'.$searchKey.'%','Issue.new_issues_identified LIKE'=>'%'.$searchKey.'%','Issue.decision_taken LIKE'=>'%'.$searchKey.'%'); 
	
	}
                             if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(Issue.meeting_date) >='=>$fromdate,'date(Issue.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['Issue.meeting_date']=$fromdate;	
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
		         $condition['Issue.block']=$searchBuilderId;
		           }
                           else {
                      // $condition='Issue.block='.$r['Bpc']['allocated_block'];
                       $condition=['Issue.block IN' =>explode(',',$r['Bpc']['allocated_block'])];
                           }
                           
                           if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('Issue.id LIKE'=>'%'.$searchKey.'%','Issue.new_issues_identified LIKE'=>'%'.$searchKey.'%','Issue.decision_taken LIKE'=>'%'.$searchKey.'%'); 
	
	}
                           if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(Issue.meeting_date) >='=>$fromdate,'date(Issue.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['Issue.meeting_date']=$fromdate;	
				}
				
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
		         $condition['Issue.block']=$searchBuilderId;
		           } else {
                       $condition['Issue.district']=$r['Dpo']['district'];
                           }
                           
                           if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    $condition['OR']=array('Issue.id LIKE'=>'%'.$searchKey.'%','Issue.new_issues_identified LIKE'=>'%'.$searchKey.'%','Issue.decision_taken LIKE'=>'%'.$searchKey.'%'); 
	
	}
                           if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(Issue.meeting_date) >='=>$fromdate,'date(Issue.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['Issue.meeting_date']=$fromdate;	
				}
				
			}
                      } 
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Village yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
                       $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.city_id IN'=>explode(',',$r['Dpo']['district']))));
                   
                ////$panchayats=$this->Panchayat->find('list');
                //$villages=$this->Village->find('list');
			
		}
         }
         else {
             $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc')));
             $panchayats=$this->Panchayat->find('list',array('order'=>array('name'=>'asc')));
              $villages=$this->Village->find('list',array('order'=>array('name'=>'asc')));
              $ngos=$this->Ngo->find('list');
             
         }
		$this->Paginator->settings = array('Issue' => array('limit' =>20,'group'=>array('Issue.meeting_date','Issue.panchayat'),'order' => array('id' => 'desc'),'conditions'=>array($condition,'Issue.status'=>'active')));
		$this->Issue->recursive = 0;
		$this->set('vhsncafcs', $this->Paginator->paginate());
		//$panchayats=$this->Panchayat->find('list');
                //$villages=$this->Village->find('list');
                $wards=$this->Ward->find('list');
		//$blocks=$this->Block->find('list');	
//			$users = $this->User->find('list',array('fields'=>array('parent'),'conditions'=>array('status'=>'active')));
//			$builders=$this->Builder->find('list');
			$this->set(compact('panchayats','villages','wards','blocks','ngos'));
			
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Issue->exists($id)) {
			throw new NotFoundException(__('Invalid Issue '));
		}
		$options = array('conditions' => array('Issue.' . $this->Issue->primaryKey => $id));
		$this->set('vhsncAfc', $this->Issue->find('first', $options));
		$this->layout='newdefault';
	}
	
	public function viewissues($id = null,$date=null) {
//		if (!$this->Issue->exists($id)) {
//			throw new NotFoundException(__('Invalid Issue '));
//		}
            $r=explode(',',$id);
		$options = array('conditions' => array('Issue.panchayat'=> $r['0'],'Issue.meeting_date'=> $r['1']));
		$this->set('vhsncAfcs', $this->Issue->find('all', $options));
		$this->layout='newdefault';
	}
        
        
        
        public function allissues() {
           $data='';$searchKey=null;$searchUserId=null;$searchBuilderId=null;$searchProjectId=null;$fromdate=null;$todate=null;
		$condition='';$condition1='';$condition2='';$condition3='';$condition4='';$querySrting=''; $condition=array();
		$conc='';
	       //$dpmcmeeting = $this->Dpmc->find('all',array('fields' => array('sum(Dpmc.issue_shared_dpmc) AS totalissue'),'group'=>array('district'),'conditions'=>array('Dpmc.status'=>'active')));	 	  	 
               //$bpmcmeeting = $this->Bpmc->find('all',array('fields' => array('sum(Bpmc.issue_shared_bpmc) AS totalissue'),'group'=>array('block'),'conditions'=>array('Bpmc.status'=>'active')));
              // $anmMeeting = $this->AnmMeeting->find('all',array('group'=>array('block'),'fields' => array('sum(AnmMeeting.no_of_issue) AS totalissue'),'conditions'=>array('AnmMeeting.status'=>'active')));
//         $anmMeeting =  $this->AnmMeeting->query('SELECT SUM(totnum) FROM (SELECT SUM(DISTINCT(`no_of_issue`)) as totnum FROM `anm_meetings` where status="active" GROUP BY meeting_date,block) as totalnum');
//         $vhsncmeeting =  $this->VhsncMeeting->query('SELECT SUM(totnum) FROM (SELECT SUM(DISTINCT(`new_issue`)) as totnum FROM `vhsnc_meetings` where status="active" GROUP BY meeting_date,panchayat) as totalnum');
//         $bpmcmeeting =  $this->Bpmc->query('SELECT SUM(totnum) FROM (SELECT SUM(DISTINCT(`issue_shared_bpmc`)) as totnum FROM `bpmcs` where status="active" GROUP BY meeting_date,block) as totalnum');
//         $dpmcmeeting =  $this->Dpmc->query('SELECT SUM(totnum) FROM (SELECT SUM(DISTINCT(`issue_shared_dpmc`)) as totnum FROM `dpmcs` where status="active" GROUP BY meeting_date,district) as totalnum');
//         $socialaudit =  $this->SocialAudit->query('SELECT SUM(totnum) FROM (SELECT SUM(DISTINCT(`issue_shared_jansamwad`)) as totnum FROM `social_audits` where status="active" GROUP BY meeting_date,block) as totalnum');
//         //print_r($anmMeeting[0][0]['SUM(totnum)']); 
            
            
            
         if(isset($this->params->query['confirm'])) {
	   if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(VhsncMeeting.meeting_date) >='=>$fromdate,'date(VhsncMeeting.meeting_date) <='=>$todate);
				$condition1['AND']=array('date(Bpmc.meeting_date) >='=>$fromdate,'date(Bpmc.meeting_date) <='=>$todate);
				$condition2['AND']=array('date(AnmMeeting.meeting_date) >='=>$fromdate,'date(AnmMeeting.meeting_date) <='=>$todate);
				$condition3['AND']=array('date(SocialAudit.meeting_date) >='=>$fromdate,'date(SocialAudit.meeting_date) <='=>$todate);
				$condition4['AND']=array('date(Dpmc.meeting_date) >='=>$fromdate,'date(Dpmc.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['VhsncMeeting.meeting_date']=$fromdate;
                                $condition1['Bpmc.meeting_date']=$fromdate;
                                $condition2['AnmMeeting.meeting_date']=$fromdate;
                                $condition3['SocialAudit.meeting_date']=$fromdate;
                                $condition4['Dpmc.meeting_date']=$fromdate;
				}
				
			}
		if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBuilderId=trim($this->request->query['block']); 
		$condition['VhsncMeeting.block']=$searchBuilderId;
                $condition1['Bpmc.block']=$searchBuilderId;
                $condition2['AnmMeeting.block']=$searchBuilderId;
                $condition3['SocialAudit.block']=$searchBuilderId;
		}
		if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchPanchayatId=trim($this->request->query['panchayat']); 
		$condition['VhsncMeeting.panchayat']=$searchPanchayatId;
		}
	
		
	}
         if(CakeSession::read('User.type')==='regular'){
           
             if(CakeSession::read('User.subrole')==='CC'){
		    }
                elseif(CakeSession::read('User.subrole')==='BPC'){
		   $r = $this->Bpc->find('first',array('conditions'=>array('Bpc.first_name='.CakeSession::read('User.id'))));
                      if($r){ 
                          if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){$searchBuilderId=trim($this->request->query['block']); 
                         $condition['VhsncMeeting.block']=$searchBuilderId;
                         $condition1['Bpmc.block']=$searchBuilderId;
                         $condition2['AnmMeeting.block']=$searchBuilderId;
                         $condition3['SocialAudit.block']=$searchBuilderId;
		           }
                           
                        else {
                              $condition=['VhsncMeeting.block IN' =>explode(',',$r['Bpc']['allocated_block'])];
                              $condition1=['Bpmc.block IN' =>explode(',',$r['Bpc']['allocated_block'])];
                              $condition2=['AnmMeeting.block IN' =>explode(',',$r['Bpc']['allocated_block'])];
                              $condition3=['SocialAudit.block IN' =>explode(',',$r['Bpc']['allocated_block'])];
                              $condition4=['Dpmc.district IN' =>explode(',',$r['Bpc']['allocated_district'])];
                           }  
                       if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(VhsncMeeting.meeting_date) >='=>$fromdate,'date(VhsncMeeting.meeting_date) <='=>$todate);
				$condition1['AND']=array('date(Bpmc.meeting_date) >='=>$fromdate,'date(Bpmc.meeting_date) <='=>$todate);
				$condition2['AND']=array('date(AnmMeeting.meeting_date) >='=>$fromdate,'date(AnmMeeting.meeting_date) <='=>$todate);
				$condition3['AND']=array('date(SocialAudit.meeting_date) >='=>$fromdate,'date(SocialAudit.meeting_date) <='=>$todate);
				$condition4['AND']=array('date(Dpmc.meeting_date) >='=>$fromdate,'date(Dpmc.meeting_date) <='=>$todate);
				
                                
                        }
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['VhsncMeeting.meeting_date']=$fromdate;
                                $condition1['Bpmc.meeting_date']=$fromdate;
                                $condition2['AnmMeeting.meeting_date']=$fromdate;
                                $condition3['SocialAudit.meeting_date']=$fromdate;
                                $condition4['Dpmc.meeting_date']=$fromdate;
				}
				
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
		          $condition['VhsncMeeting.block']=$searchBuilderId;
                         $condition1['Bpmc.block']=$searchBuilderId;
                         $condition2['AnmMeeting.block']=$searchBuilderId;
                         $condition3['SocialAudit.block']=$searchBuilderId;
		           } else {
                           $condition['VhsncMeeting.district']=$r['Dpo']['district'];
                           $condition1['Bpmc.district']=$r['Dpo']['district'];
                           $condition2['AnmMeeting.district']=$r['Dpo']['district'];
                           $condition3['SocialAudit.district']=$r['Dpo']['district'];
                           $condition4['Dpmc.district']=$r['Dpo']['district'];
                           }
                           
                           if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
			       $fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
                               //echo  $fromdate;
                               //die();
				$condition['AND']=array('date(VhsncMeeting.meeting_date) >='=>$fromdate,'date(VhsncMeeting.meeting_date) <='=>$todate);
				$condition1['AND']=array('date(Bpmc.meeting_date) >='=>$fromdate,'date(Bpmc.meeting_date) <='=>$todate);
				$condition2['AND']=array('date(AnmMeeting.meeting_date) >='=>$fromdate,'date(AnmMeeting.meeting_date) <='=>$todate);
				$condition3['AND']=array('date(SocialAudit.meeting_date) >='=>$fromdate,'date(SocialAudit.meeting_date) <='=>$todate);
				$condition4['AND']=array('date(Dpmc.meeting_date) >='=>$fromdate,'date(Dpmc.meeting_date) <='=>$todate);
				}
				if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				$condition['VhsncMeeting.meeting_date']=$fromdate;
                                $condition1['Bpmc.meeting_date']=$fromdate;
                                $condition2['AnmMeeting.meeting_date']=$fromdate;
                                $condition3['SocialAudit.meeting_date']=$fromdate;
                                $condition4['Dpmc.meeting_date']=$fromdate;
				}
				
			}
                      } 
                      else {
                           $this->Session->setFlash(__('You Have Not Allocated Village yet'));
				return $this->redirect(array('controller'=>'users','action' => 'welcome'));
                      }
                       $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc'),'conditions'=>array('Block.city_id IN'=>explode(',',$r['Dpo']['district']))));
               	
		}
         }
         else {
             $blocks=$this->Block->find('list',array('order'=>array('name'=>'asc')));
             $panchayats=$this->Panchayat->find('list',array('order'=>array('name'=>'asc')));
            
             
         }
         
         $dpmcverified = $this->Dpmc->find('count',array('conditions'=>array('Dpmc.status'=>'active','Dpmc.updated'=>'1',$condition4)));	 	  	 
         $vhsncverified = $this->VhsncMeeting->find('count',array('conditions'=>array('VhsncMeeting.status'=>'active','VhsncMeeting.updated'=>'1',$condition)));	 	  	 
         $bpmcverified = $this->Bpmc->find('count',array('conditions'=>array('Bpmc.status'=>'active','Bpmc.updated'=>'1',$condition1)));
         $anmverified = $this->AnmMeeting->find('count',array('conditions'=>array('AnmMeeting.status'=>'active','AnmMeeting.updated'=>'1',$condition2)));
         $socialverified = $this->SocialAudit->find('count',array('conditions'=>array('SocialAudit.status'=>'active','SocialAudit.updated'=>'1',$condition3)));
         
         $dpmcmeeting = $this->Dpmc->find('count',array('conditions'=>array('Dpmc.status'=>'active','Dpmc.issue_shared_dpmc !='=>'0',$condition4)));	 	  	 
         $vhsncmeeting = $this->VhsncMeeting->find('count',array('conditions'=>array('VhsncMeeting.status'=>'active','VhsncMeeting.new_issue !='=>'0',$condition)));	 	  	 
         $bpmcmeeting = $this->Bpmc->find('count',array('conditions'=>array('Bpmc.status'=>'active','Bpmc.issue_shared_bpmc !='=>'0',$condition1)));
         $anmMeeting = $this->AnmMeeting->find('count',array('conditions'=>array('AnmMeeting.status'=>'active','AnmMeeting.no_of_issue !='=>'0',$condition2)));
         $socialaudit = $this->SocialAudit->find('count',array('conditions'=>array('SocialAudit.status'=>'active','SocialAudit.issue_shared_jansamwad !='=>'0',$condition3)));
         
         $dpmcresolved = $this->Dpmc->find('count',array('conditions'=>array('Dpmc.status'=>'active','Dpmc.issue_resolved'=>'yes',$condition4)));	 	  	 
         $bpmcresolved = $this->Bpmc->find('count',array('conditions'=>array('Bpmc.status'=>'active','Bpmc.issue_resolved'=>'yes',$condition1)));
         $anmresolved = $this->AnmMeeting->find('count',array('conditions'=>array('AnmMeeting.status'=>'active','AnmMeeting.issue_resolved'=>'yes',$condition2)));
         $socialresolved = $this->SocialAudit->find('count',array('conditions'=>array('SocialAudit.status'=>'active','SocialAudit.issue_resolved'=>'yes',$condition3)));
         $vhsncresolved = $this->VhsncMeeting->find('count',array('conditions'=>array('VhsncMeeting.status'=>'active','VhsncMeeting.issue_resolved'=>'yes',$condition)));
         
         $dpmcpending = $this->Dpmc->find('count',array('conditions'=>array('Dpmc.status'=>'active','Dpmc.issue_resolved'=>'no',$condition4)));	 	  	 
         $bpmcpending = $this->Bpmc->find('count',array('conditions'=>array('Bpmc.status'=>'active','Bpmc.issue_resolved'=>'no',$condition1)));
         $anmpending = $this->AnmMeeting->find('count',array('conditions'=>array('AnmMeeting.status'=>'active','AnmMeeting.issue_resolved'=>'no',$condition2)));
         $socialpending = $this->SocialAudit->find('count',array('conditions'=>array('SocialAudit.status'=>'active','SocialAudit.issue_resolved'=>'no',$condition3)));
         $vhsncpending = $this->VhsncMeeting->find('count',array('conditions'=>array('VhsncMeeting.status'=>'active','VhsncMeeting.issue_resolved'=>'no',$condition)));
         $vhsncnot = $this->VhsncMeeting->find('count',array('conditions'=>array('VhsncMeeting.status'=>'active','VhsncMeeting.issue_resolved'=>'not applicable',$condition)));
        
         
         
         $this->set(compact('vhsncnot','blocks','panchayats','vhsncpending','vhsncresolved','vhsncverified','vhsncmeeting','dpmcmeeting','bpmcmeeting','anmMeeting','socialaudit','dpmcverified','bpmcverified','anmverified','socialverified','dpmcresolved','bpmcresolved','anmresolved','socialresolved','dpmcpending','bpmcpending','anmpending','socialpending'));
	  
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {




		if ($this->request->is('post')) {
			$this->Issue->create();
                      $data= $this->request->data;
                       
                       //print_r($this->request->data['Issue']['register_member']);
                       //$men= implode(',',$this->request->data['Issue']['register_member']);
                       //echo $men;
                        //die();
                        for($i=0;$i<count($this->request->data['Issue']['new_issues_identified']);$i++){
                            
                           $district =  $this->request->data['Issue']['district'];
                           $block =  $this->request->data['Issue']['block'];   
                           $panchayat =  $this->request->data['Issue']['panchayat'];
                           $village =  $this->request->data['Issue']['village'];
                           $ward =  $this->request->data['Issue']['ward'];
                           $meeting_date =  date('Y-m-d',strtotime($this->request->data['Issue']['meeting_date']));
                           $remarks =  $this->request->data['Issue']['remarks'];
                           $no_of_issue =  $this->request->data['Issue']['no_of_issue'];
                           $no_of_decision =  $this->request->data['Issue']['no_of_decision'];
                           $solved_issue =  $this->request->data['Issue']['solved_issue'];
                           $new_issues_identified =  $this->request->data['Issue']['new_issues_identified'][$i];
                           $issue_category =  $this->request->data['Issue']['issue_category'][$i];
                           $issue_level =  $this->request->data['Issue']['issue_level'][$i];
                           $decision_taken =  $this->request->data['Issue']['decision_taken'][$i];
                           $decision_details =  $this->request->data['Issue']['decision_details'][$i];
                           $issue_resolved =  $this->request->data['Issue']['issue_resolved'][$i];
                           $issue_resolved_date =  date('Y-m-d',strtotime($this->request->data['Issue']['issue_resolved_date'][$i]));
                           $described_resolved_issue = $this->request->data['Issue']['described_resolved_issue'][$i];
                       
                    $data=array (
                                'district'=>$district,
                                'block'=>$block,
                                'panchayat'=>$panchayat,
                                'village'=>$village,
                                'ward' =>$ward,
                                'meeting_date' =>$meeting_date,
                                'no_of_issue'=>$no_of_issue,
                                'no_of_decision'=>$no_of_decision,
                                'solved_issue'=>$solved_issue,
                                'new_issues_identified'=>$new_issues_identified,
                                'issue_category'=>$issue_category,
                                'issue_level'=>$issue_level,
                                'decision_taken'=>$decision_taken,
                                'decision_details'=>$decision_details,
                                'described_resolved_issue'=>$described_resolved_issue,
                                'issue_resolved'=>$issue_resolved,
                                'issue_resolved_date'=>$issue_resolved_date,
                                'remarks'=>$remarks,
                                'updated'=>0
                                
                        
                                );  
                    
                           $save=$this->Issue->saveAll($data);
				
                         }///} } }   
                         
                             
                         if($save) {
                         $this->Session->setFlash(__('The Issue has been saved.'));
				return $this->redirect(array('action' => 'index'));

                        } else {
				$this->Session->setFlash(__('The Issue could not be saved. Please, try again.'));
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
		$reg=$this->RegisterMember->find('list');
               // $panchayat=$this->Panchayat->find('list');
                //$village=$this->Village->find('list');
                $ward=$this->Ward->find('list');
                $issue=$this->IssueCategory->find('list');
                $subissue=$this->IssueSubcategory->find('list');
                $newissues=$this->VhsncMeeting->find('list');
                
		$this->set(compact('panchayat','cities','reg','blocks','desig','village','newissues','ward','issue','subissue'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Issue->exists($id)) {
			throw new NotFoundException(__('Invalid VhsncAfc'));
		}
		if ($this->request->is(array('post', 'put'))) {
                    
                            $district =  $this->request->data['Issue']['district'];
                            $block =  $this->request->data['Issue']['block'];   
                            $panchayat =  $this->request->data['Issue']['panchayat'];
                            $village =  $this->request->data['Issue']['village'];
                            $ward =  $this->request->data['Issue']['ward'];
                            $meeting_date =  date('Y-m-d',strtotime($this->request->data['Issue']['meeting_date']));
                            $remarks =  $this->request->data['Issue']['remarks'];
                            $new_issues_identified =  $this->request->data['Issue']['new_issues_identified'];
                           $no_of_decision =  $this->request->data['Issue']['no_of_decision'];
                           $solved_issue =  $this->request->data['Issue']['solved_issue'];
                           $issue_category =  $this->request->data['Issue']['issue_category'];
                            $issue_level =  $this->request->data['Issue']['issue_level'];
                            $decision_taken =  $this->request->data['Issue']['decision_taken'];
                            $decision_details =  $this->request->data['Issue']['decision_details'];
                            $issue_resolved_date =  date('Y-m-d',strtotime($this->request->data['Issue']['issue_resolved_date']));
                            $described_resolved_issue = $this->request->data['Issue']['described_resolved_issue'];
                            $issue_resolved =  $this->request->data['Issue']['issue_resolved'];
                           $data=array (
                               'district'=>$district,
                                'block'=>$block,
                                'panchayat'=>$panchayat,
                                'village'=>$village,
                                'ward' =>$ward,
                                'meeting_date' =>$meeting_date,
                                'new_issues_identified'=>$new_issues_identified,
                                'issue_category'=>$issue_category,
                                'issue_level'=>$issue_level,
                                'no_of_decision'=>$no_of_decision,
                                'solved_issue'=>$solved_issue,
                                'decision_taken'=>$decision_taken,
                                'decision_details'=>$decision_details,
                                'described_resolved_issue'=>$described_resolved_issue,
                                'issue_resolved_date'=>$issue_resolved_date,
                               'issue_resolved'=>$issue_resolved ,
                                'remarks'=>$remarks,
                                'updated'=>1,
                                 'id'=>$id
                                
                        
                                );  
			if ($this->Issue->save($data)) {
				$this->Session->setFlash(__('The Issue has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Issue could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Issue.' . $this->Issue->primaryKey => $id));
			$this->request->data = $this->Issue->find('first', $options);
			$executives=$this->User->find('list',array('conditions'=>array('User.status'=>'active','User.role'=>'regular')));

			}
                        if(CakeSession::read('User.type')==='regular'){
                     
                     if(CakeSession::read('User.subrole')==='CC'){
		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'))));
                       
                     
	            $cities=$this->City->find('list',array('conditions'=>array('City.id'=>$r['Bpccc']['allocated_district'])));
                    $blocks=$this->Block->find('list',array('conditions'=>array('Block.id'=>$r['Bpccc']['allocated_block'])));
                     $panchayat=$this->Panchayat->find('list',array('conditions'=>['Panchayat.id IN'=>explode(',',$r['Bpccc']['allocated_panchayat'])]));
                      if($this->request->data['Issue']['panchayat']!=0 and $this->request->data['Issue']['panchayat']!='')
			{
		     $village=$this->Village->find('list',array('conditions'=>array('Village.panchayat_id'=>$this->request->data['Issue']['panchayat'])));
		    } 
                    else {
                       $village=$this->Village->find('list');  
                    }
                    
		}
                
                 elseif(CakeSession::read('User.subrole')==='BPC'){
		  $r = $this->Bpc->find('first',array('conditions'=>array('Bpc.first_name='.CakeSession::read('User.id'))));
                       
                     
	            $cities=$this->City->find('list',array('conditions'=>array('City.id'=>$r['Bpc']['allocated_district'])));
                    $blocks=$this->Block->find('list',array('conditions'=>array('Block.id IN'=>explode(',',$r['Bpc']['allocated_block']))));
                    if($this->request->data['Issue']['panchayat']!=0 and $this->request->data['Issue']['panchayat']!='')
			{
		     $village=$this->Village->find('list',array('conditions'=>array('Village.panchayat_id'=>$this->request->data['Issue']['panchayat'])));
		    } 
                    else {
                       $village=$this->Village->find('list');  
                    }
                    
                   if($this->request->data['Issue']['panchayat']!=0 and $this->request->data['Issue']['panchayat']!='')
			{
		     $panchayat=$this->Panchayat->find('list',array('conditions'=>array('Panchayat.id'=>$this->request->data['Issue']['panchayat'])));
		    }
                    else {
                         $panchayat=$this->Panchayat->find('list'); 
                    }
		}
                
                
                 else {
		  $r = $this->Dpo->find('first',array('conditions'=>array('Dpo.first_name='.CakeSession::read('User.id'))));
                         
	            $cities=$this->City->find('list',array('conditions'=>array('City.id'=>$r['Dpo']['district'])));
                   if($this->request->data['Issue']['block']!=0 and $this->request->data['Issue']['block']!='')
			{
		     $blocks=$this->Block->find('list',array('conditions'=>array('Block.id'=>$this->request->data['Issue']['block'])));
		    } 
                    else {
                     $blocks=$this->Block->find('list');
                    }
                   
                    if($this->request->data['Issue']['panchayat']!=0 and $this->request->data['Issue']['panchayat']!='')
			{
		     $village=$this->Village->find('list',array('conditions'=>array('Village.panchayat_id'=>$this->request->data['Issue']['panchayat'])));
		    } 
                    else {
                       $village=$this->Village->find('list');  
                    }
                    
                   if($this->request->data['Issue']['panchayat']!=0 and $this->request->data['Issue']['panchayat']!='')
			{
		     $panchayat=$this->Panchayat->find('list',array('conditions'=>array('Panchayat.id'=>$this->request->data['Issue']['panchayat'])));
		    }
                    else {
                         $panchayat=$this->Panchayat->find('list'); 
                    }
		}
		   }
                else {
                    $cities=$this->City->find('list');
                    if($this->request->data['Issue']['block']!=0 and $this->request->data['Issue']['block']!='')
			{
		     $blocks=$this->Block->find('list',array('conditions'=>array('Block.id'=>$this->request->data['Issue']['block'])));
		    } 
                    else {
                     $blocks=$this->Block->find('list');
                    }
                   
                    if($this->request->data['Issue']['panchayat']!=0 and $this->request->data['Issue']['panchayat']!='')
			{
		     $village=$this->Village->find('list',array('conditions'=>array('Village.panchayat_id'=>$this->request->data['Issue']['panchayat'])));
		    } 
                    else {
                       $village=$this->Village->find('list');  
                    }
                    
                   if($this->request->data['Issue']['panchayat']!=0 and $this->request->data['Issue']['panchayat']!='')
			{
		     $panchayat=$this->Panchayat->find('list',array('conditions'=>array('Panchayat.id'=>$this->request->data['Issue']['panchayat'])));
		    }
                    else {
                         $panchayat=$this->Panchayat->find('list'); 
                    }
                }
				
				
		//$cities=$this->City->find('list');
                $desig=$this->Designation->find('list');
		//$blocks=$this->Block->find('list');
		$reg=$this->RegisterMember->find('list');
                //$panchayat=$this->Panchayat->find('list');
                //$village=$this->Village->find('list');
                $ward=$this->Ward->find('list');
                $issue=$this->IssueCategory->find('list');
                $subissue=$this->IssueSubcategory->find('list');
                //$facilitated=$this->MeetingFacilitated->find('list');
                $newissues=$this->VhsncMeeting->find('list');
		$this->set(compact('panchayat','cities','reg','blocks','desig','village','newissues','ward','issue','subissue'));
	
	}
	
	
	
	

	
	public function delete($id = null,$status='deactive') {
		$this->Issue->id = $id;
		if (!$this->Issue->exists()) {
			throw new NotFoundException(__('Invalid Vhsnc/Afc Detail'));
		}
		    //$this->request->onlyAllow('post', 'delete');
		    $this->Issue->read(null,$id);
			$this->Issue->set(array('status'=>$status));
		
		if ($this->Issue->save()) {
			$this->Session->setFlash(__('The Vhsnc Meeting has been '.$status));
		} else {
			$this->Session->setFlash(__('Nothing happen. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
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
	$condition2.=' and Issue.id LIKE %'.$searchKey.'% || Issue.new_issues_identified LIKE %'.$searchKey.'% Issue.decision_taken LIKE %'.$searchKey.'%';
	
	}
	
	
	
	if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(Issue.meeting_date)>="'.$fromdate.'" and date(Issue.meeting_date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(Issue.meeting_date)="'.$fromdate.'"';
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
		$condition2.=' and Issue.block='.$searchBlockId;
		}
		
		if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){$searchProjectId=trim($this->request->query['panchayat']); //$condition['Enquiry.project_id']=$searchProjectId;
		$condition2.=' and Issue.panchayat='.$searchProjectId;
		}
               
                if(isset($this->request->query['village']) and ($this->request->query['village']!=0) and ($this->request->query['village']!='')){$searchVillageId=trim($this->request->query['village']); //$condition['Enquiry.project_id']=$searchProjectId;
		$condition2.=' and Issue.village='.$searchVillageId;
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
                             $condition2.=' and Issue.panchayat='.$searchProjectId;
		           }   else { 
                        ///$condition=['VhsncAfc.panchayat IN' =>explode(',',$r['Bpccc']['allocated_panchayat'])]; 
                         $condition2.=' and Issue.panchayat IN ('.$r['Bpccc']['allocated_panchayat'].')';
                      } 
                      	if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    //$condition['OR']=array('Geographical.id LIKE'=>'%'.$searchKey.'%','Geographical.ward LIKE'=>'%'.$searchKey.'%','Geographical.awc_code LIKE'=>'%'.$searchKey.'%','Geographical.awc_worker LIKE '=>'%'.$searchKey.'%','Geographical.asha_name LIKE '=>'%'.$searchKey.'%'); 
	$condition2.=' and Issue.id LIKE %'.$searchKey.'% || Issue.new_issues_identified LIKE %'.$searchKey.'% Issue.decision_taken LIKE %'.$searchKey.'%';
	
	}
	
	
	
	if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(Issue.meeting_date)>="'.$fromdate.'" and date(Issue.meeting_date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(Issue.meeting_date)="'.$fromdate.'"';
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
		        $condition2.=' and Issue.block='.$searchBlockId;
		        }else {
                            
                       $condition2.=' and Issue.block IN ('.$r['Bpc']['allocated_block'].')';
                       
                      } 
                      	if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    //$condition['OR']=array('Geographical.id LIKE'=>'%'.$searchKey.'%','Geographical.ward LIKE'=>'%'.$searchKey.'%','Geographical.awc_code LIKE'=>'%'.$searchKey.'%','Geographical.awc_worker LIKE '=>'%'.$searchKey.'%','Geographical.asha_name LIKE '=>'%'.$searchKey.'%'); 
	$condition2.=' and Issue.id LIKE %'.$searchKey.'% || Issue.new_issues_identified LIKE %'.$searchKey.'% Issue.decision_taken LIKE %'.$searchKey.'%';
	
	}
	
	
	
	if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(Issue.meeting_date)>="'.$fromdate.'" and date(Issue.meeting_date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(Issue.meeting_date)="'.$fromdate.'"';
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
                               $condition2.=' and Issue.block='.$searchBlockId;
		        // $condition['VhsncAfc.block']=$searchBlockId;
		        }else {
                       //$condition='VhsncAfc.district='.$r['Dpo']['district'];
                        $condition2.=' and Issue.district IN ('.$r['Dpo']['district'].')';
                        }
                        	if(isset($this->request->query['search_key']) and (trim($this->request->query['search_key'])!='')){ 
			$searchKey=trim($this->request->query['search_key']);  
    //$condition['OR']=array('Geographical.id LIKE'=>'%'.$searchKey.'%','Geographical.ward LIKE'=>'%'.$searchKey.'%','Geographical.awc_code LIKE'=>'%'.$searchKey.'%','Geographical.awc_worker LIKE '=>'%'.$searchKey.'%','Geographical.asha_name LIKE '=>'%'.$searchKey.'%'); 
	$condition2.=' and Issue.id LIKE %'.$searchKey.'% || Issue.new_issues_identified LIKE %'.$searchKey.'% Issue.decision_taken LIKE %'.$searchKey.'%';
	
	}
	
	
	
	if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
			
			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
			{
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));
				$todate=trim(date('Y-m-d',strtotime($this->request->query['to_date'])));
				$condition2.=' and date(Issue.meeting_date)>="'.$fromdate.'" and date(Issue.meeting_date)<="'.$todate.'"';
				//$condition['AND']=array('date(Enquiry.posted_date) >='=>$fromdate,'date(Enquiry.posted_date) <='=>$todate);
				}
				else if(($this->request->query['from_date']!='') and ($this->request->query['to_date']=='')){
					
				$fromdate=trim(date('Y-m-d',strtotime($this->request->query['from_date'])));  
				//$condition['Enquiry.posted_date']=$fromdate;	
				$condition2.=' and date(Issue.meeting_date)="'.$fromdate.'"';
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
		$condition2.=' and Issue.status="active"';
		$this->response->download("Issue.csv");
		//print_r($condition); exit;
	    $data=$this->Issue->query('select Issue.id,Issue.meeting_date,Issue.new_issues_identified,Issuecategory.name,Issuesubcat.name,Issue.decision_taken,Issue.decision_details,Issue.issue_resolved_date,Issue.described_resolved_issue,City.name,Block.name,Panchayat.name,Village.name,Ward.name,Issue.status from issues as Issue left join cities as City  on Issue.district=City.id left join blocks as Block  on Issue.block=Block.id left join villages as Village  on Issue.village=Village.id left join panchayats as Panchayat on Issue.panchayat=Panchayat.id left join wards as Ward on Issue.ward=Ward.id  left join issue_category as Issuecategory on Issue.issue_category=Issuecategory.id left join issue_subcategory as Issuesubcat on Issue.issue_level=Issuesubcat.id   where 1 '.$condition2 );
		
		
		//$data = $this->Geographical->find('all', array('conditions'=>$condition2));
		
		//$log = $this->Enquiry->getDataSource()->getLog(false, false);
        //debug($log);
		//exit;
		
            $headers = array('Issue'=>array( 'Id' => 'Id','District' => 'District', 'Block' => 'Block','Panchayat' => 'Panchayat','Village'=>'Village','Ward'=>'Ward','Date of Meeting'=>'Date of Meeting','Issue Details'=>'Issue Details','Issue Category'=>'Issue Category','Issue Level'=>'Issue Level','Decisions Taken'=>'Decisions Taken','Decision Details'=>'Decision Details','Date of Resolved Issued'=>'Date of Resolved Issued','Describe Resolved Issued'=>'Describe Resolved Issued','Status'=>'Status')); 
	    $this->set(compact('data','headers'));
		$this->layout = 'ajax';
		return;
		
		}
  ////  reports section ---/////  
	
	}
	
	
	
	
