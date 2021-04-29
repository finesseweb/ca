<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Session','Mail','Sms');
	var  $uses = array('User','Menuheader','Menu','UserAccess','Ngo','City','Block','Panchayat','Village','VhsncMeeting','VhsncUntiedfund','VhsncFeedback','Vhsnd','Ivrs','Dpmc','Bpmc','AfcHomeVisit','Target','Period','VhsncUntiedfundDetail','VhsncConstitution','AnmMeeting','FacilityDetail','FacilityAssessment','Checklist','FinancialDetail','Finance','Bpccc','Bpc','Dpo','Geographical','Youthleader');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$searchUserId='';$condition='';
	if(isset($this->params->query['confirm'])) {
	if (isset($this->params->query['user_id']) && ($this->params->query['user_id']!="" || $this->params->query['user_id']!=0)  && ($this->checkUser($this->params->query['user_id'])==false))
	{
		throw new NotFoundException(__('Invalid Lead'));
    }
	if(isset($this->params->query['user_id']) and ($this->params->query['user_id']!="" || $this->params->query['user_id']!=0)){
    $searchUserId=trim($this->request->query['user_id']);
	$condition=array('OR'=>array('User.id'=>$searchUserId,'User.parent'=>$searchUserId));
		}
	  }
	  else {
	  if(CakeSession::read('User.type')==='regular' || CakeSession::read('User.type')==='user'){ 
		        $condition=array('OR'=>array('User.id'=>CakeSession::read('User.id'),'User.parent'=>CakeSession::read('User.id')));
				}
		
		
		
		
	  }
          
		
		$this->Paginator->settings = array('User' => array('conditions' => $condition,'order'=>array('User.id'=>'DESC')));
		$this->User->recursive = 0;
		$this->set('users', $this->Paginator->paginate());
		$userss = $this->User->find('list',array('fields'=>array('parent'),'conditions'=>array('status'=>'active')));
		$this->set('userss', $userss);
		//$log = $this->User->getDataSource()->getLog(false, false);
        //debug($log);
		
		
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id) || $this->checkUser($id)==false) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$password="";
		$parent='';
		$group='';
		if ($this->request->is('post')) {
		
		$menuheader='';
		$checkedprop='';
		$display='display:block';
		$menu='';
		if(!empty($this->request->data['User']['menuheader'])){$menuheader=serialize($this->request->data['User']['menuheader']); $this->request->data['User']['menuheader']=$menuheader;}
		if(!empty($this->request->data['User']['menuheader'])){$menu=serialize($this->request->data['User']['menu']); $this->request->data['User']['menu']=$menu;}
			
		$password=md5($this->request->data['User']['password']);
		$this->request->data['User']['password_enc']=$password;
		$this->request->data['User']['created']=date("Y-m-d H:i:s");
		$this->request->data['User']['status']='active';
		
		$parent=$this->User->findById($this->request->data['User']['parent']);
		if(!empty($parent['User']['name'])) { $group=$parent['User']['name'];}else{ $group='';}
		
		if(CakeSession::read('User.type')!='regular')
		 {
		  //$this->request->data['User']['parent']=$this->request->data['User']['parent'];
		  //$this->request->data['User']['children']=0;
		    }
		else
		{
		//$this->request->data['User']['parent']=CakeSession::read('User.id');
		//$this->request->data['User']['children']= 0;
		//$this->request->data['User']['parent']=CakeSession::read('User.id');
		$this->request->data['User']['role']='regular';
			}
		$this->request->data['User']['level']=$this->getUserLevel($this->request->data['User']['parent']);
			
		$this->User->create();
			if ($this->User->save($this->request->data)) {
				
		$this->Mail->sendUserCreationMail($this->request->data['User']['username'],$this->request->data['User']['password'],$this->request->data['User']['name'],$this->request->data['User']['last_name'],$this->request->data['User']['email'],$group);
				
				
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
		else
		{
		if(CakeSession::read('User.type')==="regular") {
		$menuheader=$this->Menuheader->query("select name,action,id,controller,menuheader_id from menus as headers where usertype='regular' and status='active' group by controller");
		$checkedprop="checked";
		$display='display:none';
		}
		else
		{
		    $menuhead=$this->Menuheader->query("select name,action,id,controller,navid from menuheaders as head where navid !='1' and status='active' order by navid asc");
                        	
                    //$menuheader=$this->Menuheader->query("select name,action,id,controller,menuheader_id,usertype from menus as headers where status='active' group by controller order by menuheader_id desc");
                        $checkedprop='';
			$display='display:block';
			}
		//$this->set('menuheaders',$menuheader);
                $this->set('menuheads',$menuhead);
		$this->set('checkedprop',$checkedprop);
		$this->set('display',$display);
                $users = $this->User->find('list',array('fields'=>array('parent'),'conditions'=>array('status'=>'active')));
		$this->set('users',$users);
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$password="";
		if (!$this->User->exists($id) || $this->checkUser($id)==false) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
                    //print_r($this->request->data);
                    //die();
		$menuheader='';
		$checkedprop='';
		$menu='';
		$display='display:block';
		if(!empty($this->request->data['User']['menuheader'])){$menuheader=serialize($this->request->data['User']['menuheader']); $this->request->data['User']['menuheader']=$menuheader;}
		if(!empty($this->request->data['User']['menu'])){$menu=serialize($this->request->data['User']['menu']); $this->request->data['User']['menu']=$menu;}
		
		$password=md5($this->request->data['User']['password']);
		$this->request->data['User']['password_enc']=$password;
		$this->request->data['User']['modified']=date("Y-m-d H:i:s");
		
			
		$this->request->data['User']['level']=$this->getUserLevel($this->request->data['User']['parent']);	
		if ($this->User->save($this->request->data)) {
		$this->Session->setFlash(__('The user has been saved.'));
		return $this->redirect(array('action' => 'index'));
		} else {
		$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
		}
		} else {
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->request->data = $this->User->find('first', $options);
		if(CakeSession::read('User.type')==="regular") {
		$menuheader=$this->Menuheader->query("select name,action,id,controller,menuheader_id from menus as headers where usertype='regular' and status='active' group by controller");
		$checkedprop="checked";
		$display='display:none';
		}
		else
		{
			 $menuhead=$this->Menuheader->query("select name,action,id,controller,navid from menuheaders as head where navid !='1' and status='active' order by navid asc");
                       //$menuheader=$this->Menuheader->query("select name,action,id,controller,menuheader_id from menus as headers where status='active' group by controller order by navid desc");
                        $checkedprop='';
			$display='display:block';
			}
		//$this->set('menuheaders',$menuheader);
                 $this->set('menuheads',$menuhead);
		$this->set('checkedprop',$checkedprop);
		$this->set('display',$display);
        
        $users = $this->User->find('list',array('fields'=>array('parent'),'conditions'=>array('status'=>'active')));
		$this->set('users',$users);

		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists() || $this->checkUser($id)==false) {
			throw new NotFoundException(__('Invalid user'));
		}
		//$this->request->onlyAllow('post', 'delete');
		
	    $this->User->read(null,$this->User->id);
	    $this->User->set(array('status'=>'deactive'));
		$this->User->save();
	   //$this->User->delete()
		
		if ($this->User->save()) {
			$this->Session->setFlash(__('The user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	function welcome() {
            
            $condition50='';$condition51='';$condition52='';$condition53='';$condition54='';$condition55='';$condition56='';$condition57='';
//            if(isset($this->params->query['confirm'])) {
//              // print_r($this->request->query);
//              //die();
//               	if(isset($this->request->query['from_date']) || isset($this->request->query['to_date'])){
//                    
//			
//			if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!=''))
//			{
//			$fromdate=trim($this->request->query['from_date']);
//			$todate=trim($this->request->query['to_date']);
//                        
//			$condition['AND']=array('DATE_FORMAT(Vhsnd.visit_date, "%Y-%m") >='=>$fromdate,'DATE_FORMAT(Vhsnd.visit_date, "%Y-%m") <='=>$todate);
//			$condition1['AND']=array('DATE_FORMAT(VhsncMeeting.meeting_date, "%Y-%m") >='=>$fromdate,'DATE_FORMAT(VhsncMeeting.meeting_date, "%Y-%m") <='=>$todate);
//			$condition2['AND']=array('DATE_FORMAT(VhsncUntiedfund.balance_check_date, "%Y-%m") >='=>$fromdate,'DATE_FORMAT(VhsncUntiedfund.balance_check_date, "%Y-%m") <='=>$todate);
//			$condition3['AND']=array('DATE_FORMAT(VhsncFeedback.meeting_date, "%Y-%m") >='=>$fromdate,'DATE_FORMAT(VhsncFeedback.meeting_date, "%Y-%m") <='=>$todate);
//			$condition4['AND']=array('DATE_FORMAT(Ivrs.date, "%Y-%m") >='=>$fromdate,'DATE_FORMAT(Ivrs.date, "%Y-%m") <='=>$todate);
//			$condition5['AND']=array('DATE_FORMAT(Dpmc.meeting_date, "%Y-%m") >='=>$fromdate,'DATE_FORMAT(Dpmc.meeting_date, "%Y-%m") <='=>$todate);
//			$condition6['AND']=array('DATE_FORMAT(Bpmc.meeting_date, "%Y-%m") >='=>$fromdate,'DATE_FORMAT(Bpmc.meeting_date, "%Y-%m") <='=>$todate);
//			$condition7['AND']=array('DATE_FORMAT(AfcHomeVisit.contraceptives_delivery_date, "%Y-%m") >='=>$fromdate,'DATE_FORMAT(AfcHomeVisit.contraceptives_delivery_date, "%Y-%m") <='=>$todate);
//			$condition11['AND']=array('DATE_FORMAT(AnmMeeting.meeting_date, "%Y-%m") >='=>$fromdate,'DATE_FORMAT(AnmMeeting.meeting_date, "%Y-%m") <='=>$todate);
//			$condition12['AND']=array('DATE_FORMAT(Checklist.meeting_date, "%Y-%m") >='=>$fromdate,'DATE_FORMAT(Checklist.meeting_date, "%Y-%m") <='=>$todate);
//			$condition13['AND']=array('DATE_FORMAT(FacilityAssessment.meeting_date, "%Y-%m") >='=>$fromdate,'DATE_FORMAT(FacilityAssessment.meeting_date, "%Y-%m") <='=>$todate);
//						
//                        } 
//                        else
//                       if(($this->request->query['from_date']!='') and ($this->request->query['to_date']!='')){
//					
//				$fromdate=trim($this->request->query['from_date']);  
//				$condition['DATE_FORMAT(Vhsnd.visit_date, "%Y-%m")']=$fromdate;
//                                $condition1['DATE_FORMAT(VhsncMeeting.meeting_date, "%Y-%m")']=$fromdate;
//                                $condition2['DATE_FORMAT(VhsncUntiedfund.balance_check_date, "%Y-%m")']=$fromdate;
//                                $condition3['DATE_FORMAT(VhsncFeedback.meeting_date, "%Y-%m")']=$fromdate;
//                                $condition4['DATE_FORMAT(Ivrs.date, "%Y-%m")']=$fromdate;
//                                $condition5['DATE_FORMAT(Dpmc.meeting_date, "%Y-%m")']=$fromdate;
//                                $condition6['DATE_FORMAT(Bpmc.meeting_date, "%Y-%m")']=$fromdate;
//                                $condition7['DATE_FORMAT(AfcHomeVisit.contraceptives_delivery_date, "%Y-%m")']=$fromdate;
//				$condition11['DATE_FORMAT(AnmMeeting.meeting_date, "%Y-%m")']=$fromdate;
//				$condition12['DATE_FORMAT(Checklist.meeting_date, "%Y-%m")']=$fromdate;
//				$condition13['DATE_FORMAT(FacilityAssessment.meeting_date, "%Y-%m")']=$fromdate;
//				}
//				else
//				{
//					
//					}
//			}
//                        
//                if(isset($this->request->query['organization']) and ($this->request->query['organization']!=0) and ($this->request->query['organization']!='')){
//                    $searchorganizationId=trim($this->request->query['organization']); 
//		    $condition15['FinancialDetail.organization']=$searchorganizationId;
//                    $condition16['Finance.organization']=$searchorganizationId;
//                    $condition8['Target.organization']=$searchorganizationId;
//                    
//                  $r = $this->Ngo->find('first',array('conditions'=>array('Ngo.id'=>$searchorganizationId)));
//                 if($r){
//                     
//                     $blo=array();
//                     $blo= [$r['Ngo']['allocated_block_one'],$r['Ngo']['allocated_block_two']];
//                     $condition50['City.id']=$r['Ngo']['allocated_district'];
//                     $condition51=['Block.id IN' =>$blo]; 
//                     $condition52=['Panchayat.block_id IN' =>$blo];
//                     $condition53=['Village.block_id IN' =>$blo];
//                     $condition54=['Geographical.block IN' =>$blo];
//                     $condition55=['Bpccc.allocated_block IN' =>$blo];
//                     $condition56=['Youthleader.allocated_block IN' =>$blo];
//                     $condition57=['FacilityDetail.block IN' =>$blo];
//                      
//                 } 
//		}
//		
//
//             if(isset($this->request->query['district']) and ($this->request->query['district']!=0) and ($this->request->query['district']!='')){
//                $searchProjectId=trim($this->request->query['district']); //$condition['Enquiry.project_id']=$searchProjectId;
//		$condition['Vhsnd.district']=$searchProjectId;
//                $condition1['VhsncMeeting.district']=$searchProjectId;
//                $condition2['VhsncUntiedfund.district']=$searchProjectId;
//                $condition3['VhsncFeedback.district']=$searchProjectId;
//                $condition4['Ivrs.district']=$searchProjectId;
//                $condition5['Dpmc.district']=$searchProjectId;
//                $condition6['Bpmc.district']=$searchProjectId;
//                $condition7['AfcHomeVisit.district']=$searchProjectId;
//                $condition8['Target.district']=$searchProjectId;
//                $condition9['VhsncUntiedfundDetail.district']=$searchProjectId;
//                $condition10['VhsncConstitution.district']=$searchProjectId;
//                $condition11['AnmMeeting.district']=$searchProjectId;
//                $condition12['Checklist.district']=$searchProjectId;
//                $condition13['FacilityAssessment.district']=$searchProjectId;
//                $condition14['FacilityDetail.district']=$searchProjectId;
//		}
//               
//             if(isset($this->request->query['block']) and ($this->request->query['block']!=0) and ($this->request->query['block']!='')){
//                $searchBlockId=trim($this->request->query['block']);
//                $condition['Vhsnd.block']=$searchBlockId;//$condition['Enquiry.builder_id']=$searchBuilderId;
//		$condition1['VhsncMeeting.block']=$searchBlockId;
//                $condition2['VhsncUntiedfund.block']=$searchBlockId; 
//                $condition3['VhsncFeedback.block']=$searchBlockId;
//                $condition4['Ivrs.block']=$searchBlockId;
//                $condition6['Bpmc.block']=$searchBlockId;
//                $condition7['AfcHomeVisit.block']=$searchBlockId;
//                $condition8['Target.block']=$searchBlockId;
//                $condition9['VhsncUntiedfundDetail.block']=$searchBlockId;
//                $condition10['VhsncConstitution.block']=$searchBlockId;
//                $condition11['AnmMeeting.block']=$searchBlockId;
//                $condition12['Checklist.block']=$searchBlockId;
//                $condition13['FacilityAssessment.block']=$searchBlockId;
//                $condition14['FacilityDetail.block']=$searchBlockId;
//                
//             }
//                
//            if(isset($this->request->query['panchayat']) and ($this->request->query['panchayat']!=0) and ($this->request->query['panchayat']!='')){
//                $searchBuilderId=$this->request->query['panchayat']; 
//                $searchBuilderId1=$this->request->query['panchayat']; 
//               //print_r($searchBuilderId);
//                //die();
//                array_push($searchBuilderId,'100');
//                $condition=['Vhsnd.panchayat IN' =>$searchBuilderId]; 
//		$condition1=['VhsncMeeting.panchayat IN '=> $searchBuilderId];
//                $condition2=['VhsncUntiedfund.panchayat IN '=>$searchBuilderId];
//                $condition3=['VhsncFeedback.panchayat IN '=>$searchBuilderId];
//                $condition4=['Ivrs.panchayat IN '=>$searchBuilderId];
//                $condition7=['AfcHomeVisit.panchayat IN '=>$searchBuilderId];
//               // $condition8=['Target.panchayat LIKE'=>'%'.implode(',',$searchBuilderId).'%' ];
//                $condition8=['Target.panchayat LIKE'=>'%'.implode(',',$searchBuilderId1).'%' ];
//                $condition9=['VhsncUntiedfundDetail.panchayat IN '=>$searchBuilderId];
//                $condition10=['VhsncConstitution.panchayat IN '=>$searchBuilderId];
//                $condition12=['Checklist.panchayat IN '=>$searchBuilderId];
//                $condition13=['FacilityAssessment.panchayat IN '=>$searchBuilderId];
//                $condition14=['FacilityDetail.panchayat IN '=>$searchBuilderId];
//                
//            }
//               
//             if(isset($this->request->query['village']) and ($this->request->query['village']!=0) and ($this->request->query['village']!='')){
//                 $searchVillageId=trim($this->request->query['village']);
//                 $condition['Vhsnd.village']=$searchVillageId;//$condition['Enquiry.project_id']=$searchProjectId;
//		 $condition1['VhsncMeeting.village']=$searchVillageId;
//                 $condition2['VhsncUntiedfund.village']=$searchVillageId;
//                 $condition3['VhsncFeedback.village']=$searchVillageId;
//                 $condition4['Ivrs.village']=$searchVillageId;
//                 $condition7['AfcHomeVisit.village']=$searchVillageId;
//                 $condition9['VhsncUntiedfundDetail.village']=$searchVillageId;
//                 $condition10['VhsncConstitution.village']=$searchVillageId;
//                 $condition12['Checklist.village']=$searchVillageId;
//                 $condition13['FacilityAssessment.village']=$searchVillageId;
//                 $condition14['FacilityDetail.village']=$searchVillageId;
//             }
//            }
//                $condition['Vhsnd.status']='active';
//                $condition1['VhsncMeeting.status']='active';
//                $condition2['VhsncUntiedfund.status']='active';
//                $condition3['VhsncFeedback.status']='active';
//                $condition4['Ivrs.status']='active';
//                $condition5['Dpmc.status']='active';
//                $condition6['Bpmc.status']='active';
//                $condition7['AfcHomeVisit.status']='active';
//                $condition8['Target.status']='active';
//                $condition9['VhsncUntiedfundDetail.status']='active';
//                $condition10['VhsncConstitution.status']='active';
//                $condition11['AnmMeeting.status']='active';
//                $condition12['Checklist.status']='active';
//                $condition13['FacilityAssessment.status']='active';
//                $condition14['FacilityDetail.status']='active';
//                $condition15['FinancialDetail.status']='active';
//                $condition16['Finance.status']='active';
		
//               if(isset($this->params->query['confirm'])) {
//                  
//               $target = $this->Target->find('first',array('conditions'=>array($condition8)));
//                 //print_r($condition8);
//               //die();
//               if(!empty($target)) {
//               $totalmonth= $target['Target']['total_months'];
//               $totalpanchyat= $target['Target']['panchayat'];
//               $totaltarget= $target['Target']['vhsnc_meeting_target'];
//               $feedback_target= $target['Target']['feedback_target'];
//               $vhsnc_issue_target= $target['Target']['vhsnc_issue_target'];
//               $vhsnc_issueresolved_target= $target['Target']['vhsnc_issueresolved_target'];
//               $vhsnd_monitor_target= $target['Target']['vhsnd_monitor_target'];
//               $vhsnc_monitor_target= $target['Target']['vhsnc_monitor_target'];
//               $ivrs_feedback_target= $target['Target']['ivrs_feedback_target'];
//               $anm_meeting_target= $target['Target']['anm_meeting_target'];
//               $dpmc_meeting_target= $target['Target']['dpmc_meeting_target'];
//               $bpmc_meeting_target= $target['Target']['bpmc_meeting_target'];
//               $rks_meeting_target= $target['Target']['rks_meeting_target'];
//               $vhsnc_checklist_target= $target['Target']['vhsnc_checklist_target'];
//               $vhsnd_checklist_target= $target['Target']['vhsnd_checklist_target'];
//               $facility_assessement_target= $target['Target']['facility_assessement_target'];
//               $iucd_services_target= $target['Target']['iucd_services_target'];
//               $antara_services_target= $target['Target']['antara_services_target'];
//               $vhsnc_expenditure_total_target= $target['Target']['vhsnc_expenditure_total_target'];
//               $vhsnc_expenditure_allocation_target= $target['Target']['vhsnc_expenditure_allocation_target'];
//               $budget_utilized_target= $target['Target']['budget_utilized_target'];
//               $anc_service_target= $target['Target']['anc_service_target'];
//               $issue_pending_target= $target['Target']['issue_pending_target'];
//               
//               
//               
//               $permonthvhsnctarget =  $totaltarget/$totalmonth;
//               $permonthfeedbacktraget =  $feedback_target/$totalmonth;
//               $permonthissuetarget =  $vhsnc_issue_target/$totalmonth;
//               $permonthresolvedissuetarget =  $vhsnc_issueresolved_target/$totalmonth;
//               $permonthvhsndtarget =  $vhsnd_monitor_target/$totalmonth;
//               $permonthvhsncmonitortarget =  $vhsnc_monitor_target/$totalmonth;
//               $permonthivrstarget =  $ivrs_feedback_target/$totalmonth;
//               $permonthanmmeetingtarget =  $anm_meeting_target/$totalmonth;
//               $permonthdpmctarget =  $dpmc_meeting_target/$totalmonth;
//               $permonthbpmctarget =  $bpmc_meeting_target/$totalmonth;
//               $permonthrkstarget =  $rks_meeting_target/$totalmonth;
//               $permonthvhsncchecklisttarget =  $vhsnc_checklist_target/$totalmonth;
//               $permonthvhsndchecklisttarget =  $vhsnd_checklist_target/$totalmonth;
//               $permonthassessementtarget =  $facility_assessement_target/$totalmonth;
//               $permonthicudservicetarget =  $iucd_services_target/$totalmonth;
//               $permonthantaraservicetarget =  $antara_services_target/$totalmonth;
//               $permonthexpendituretarget =  $vhsnc_expenditure_total_target/$totalmonth;
//               $permonthalloexptarget =  $vhsnc_expenditure_allocation_target/$totalmonth;
//               $permonthanbudgetutilizedtarget =  $budget_utilized_target/$totalmonth;
//               $permonthancservicetarget =  $anc_service_target/$totalmonth;
//               $permonthissuependingtarget =  $issue_pending_target/$totalmonth;
//               
//               if(!empty($fromdate)){
//                       $ts1 = strtotime($fromdate);
//                       $ts2 = strtotime($todate);
//                       $year1 = date('Y', $ts1);
//                       $year2 = date('Y', $ts2);
//                       $month1 = date('m', $ts1);
//                       $month2 = date('m', $ts2); 
//                       $data = (($year2 - $year1) * 12) + ($month2);
//               }
//               else {
//                  $data=$totalmonth; 
//               }
//                $aspermonthvhsnctarget = $permonthvhsnctarget*$data;
//                $aspermonthfeedbacktraget = $permonthfeedbacktraget*$data;
//                $aspermonthissuetarget = $permonthissuetarget*$data;
//                $aspermonthresolvedissuetarget = $permonthresolvedissuetarget*$data;
//                $aspermonthvhsndtarget = $permonthvhsndtarget*$data;
//                $aspermonthvhsncmonitortarget = $permonthvhsncmonitortarget*$data;
//                $aspermonthivrstarget = $permonthivrstarget*$data;
//                $aspermonthanmmeetingtarget = $permonthanmmeetingtarget*$data;
//                $aspermonthdpmctarget = $permonthdpmctarget*$data;
//                $aspermonthbpmctarget = $permonthbpmctarget*$data;
//                $aspermonthrkstarget = $permonthrkstarget*$data;
//                $aspermonthvhsncchecklisttarget = $permonthvhsncchecklisttarget*$data;
//                $aspermonthvhsndchecklisttarget = $permonthvhsndchecklisttarget*$data;
//                $aspermonthassessementtarget = $permonthassessementtarget*$data;
//                $aspermonthicudservicetarget = $permonthicudservicetarget*$data;
//                $aspermonthantaraservicetarget = $permonthantaraservicetarget*$data;
//                $aspermonthexpendituretarget = $permonthexpendituretarget*$data;
//                $aspermonthalloexptarget = $permonthalloexptarget*$data;
//                $aspermonthanbudgetutilizedtarget = $permonthanbudgetutilizedtarget*$data;
//                $aspermonthancservicetarget = $permonthancservicetarget*$data;
//                $aspermonthissuependingtarget = $permonthissuependingtarget*$data;
//               }
//                }
//                else {
//                     $target = $this->Target->find('all',array('fields' => array('sum(Target.vhsnc_meeting_target) AS vtotal','sum(Target.feedback_target) AS ftotal','sum(Target.vhsnc_issue_target) AS vissuetotal','sum(Target.vhsnc_issueresolved_target) AS vrestotal','sum(Target.vhsnd_monitor_target) AS vdmontotal','sum(Target.vhsnc_monitor_target) AS vsmontotal','sum(Target.ivrs_feedback_target) AS mtotal','sum(Target.anm_meeting_target) AS anmtotal','sum(Target.dpmc_meeting_target) AS dpmctotal','sum(Target.bpmc_meeting_target) AS bpmctotal','sum(Target.rks_meeting_target) AS rkstotal','sum(Target.vhsnc_checklist_target) AS vschecktotal','sum(Target.vhsnd_checklist_target) AS vdchecktotal','sum(Target.facility_assessement_target) AS facilityassesstotal','sum(Target.iucd_services_target) AS iucdtotal','sum(Target.antara_services_target) AS antaratotal','sum(Target.vhsnc_expenditure_total_target) AS vexptotal','sum(Target.vhsnc_expenditure_allocation_target) AS vsalloexptotal','sum(Target.budget_utilized_target) AS budgettotal','sum(Target.anc_service_target) AS ancservicetotal','sum(Target.issue_pending_target) AS issueptotal'),'conditions'=>array('Target.status'=>'active')));
//                
//                    $aspermonthvhsnctarget = $target['0']['0']['vtotal'];
//                    $aspermonthfeedbacktraget = $target['0']['0']['ftotal'];
//                    $aspermonthissuetarget = $target['0']['0']['vissuetotal'];
//                    $aspermonthresolvedissuetarget = $target['0']['0']['vrestotal'];
//                    $aspermonthvhsndtarget = $target['0']['0']['vdmontotal'];
//                    $aspermonthvhsncmonitortarget = $target['0']['0']['vsmontotal'];
//                    $aspermonthivrstarget = $target['0']['0']['mtotal'];
//                    $aspermonthanmmeetingtarget = $target['0']['0']['anmtotal'];
//                    $aspermonthdpmctarget = $target['0']['0']['dpmctotal'];
//                    $aspermonthbpmctarget = $target['0']['0']['bpmctotal'];
//                    $aspermonthrkstarget = $target['0']['0']['rkstotal'];
//                    $aspermonthvhsncchecklisttarget = $target['0']['0']['vschecktotal'];
//                    $aspermonthvhsndchecklisttarget = $target['0']['0']['vdchecktotal'];
//                    $aspermonthassessementtarget = $target['0']['0']['facilityassesstotal'];
//                    $aspermonthicudservicetarget = $target['0']['0']['iucdtotal'];
//                    $aspermonthantaraservicetarget = $target['0']['0']['antaratotal'];
//                    $aspermonthexpendituretarget = $target['0']['0']['vexptotal'];
//                    $aspermonthalloexptarget = $target['0']['0']['vsalloexptotal'];
//                    $aspermonthanbudgetutilizedtarget = $target['0']['0']['budgettotal'];
//                    $aspermonthancservicetarget = $target['0']['0']['ancservicetotal'];
//                    $aspermonthissuependingtarget = $target['0']['0']['issueptotal'];
//                    }
            
                    
                
//             if(CakeSession::read('User.type')==='regular'){
//             //echo CakeSession::read('User.id');
//             //die();
//             if(CakeSession::read('User.subrole')==='CC'){
//		   $r = $this->Bpccc->find('first',array('conditions'=>array('Bpccc.first_name='.CakeSession::read('User.id'))));
//                      if($r){ 
//                          
//             $citie=$this->City->find('count',array('conditions'=>array('City.id IN'=>explode(',',$r['Bpccc']['allocated_district']))));
//             $block=$this->Block->find('count',array('conditions'=>array('Block.id IN'=>explode(',',$r['Bpccc']['allocated_block']))));
//             $panchayat=$this->Panchayat->find('count',array('conditions'=>array('Panchayat.id IN'=>explode(',',$r['Bpccc']['allocated_panchayat']))));
//             $village=$this->Village->find('count',array('conditions'=>array('Village.panchayat_id IN'=>explode(',',$r['Bpccc']['allocated_panchayat']))));
//             $house = $this->Geographical->find('all',array('fields' => array('sum(Geographical.no_of_house) AS totalhouse'),'conditions'=>array('Geographical.panchayat IN'=>explode(',',$r['Bpccc']['allocated_panchayat']),'Geographical.status'=>'active')));
//             $population = $this->Geographical->find('all',array('fields' => array('sum(Geographical.population) AS totalpop'),'conditions'=>array('Geographical.panchayat IN'=>explode(',',$r['Bpccc']['allocated_panchayat']),'Geographical.status'=>'active')));
//           
//             $awc = $this->Geographical->find('count',array('conditions'=>array('Geographical.panchayat'=>$r['Bpccc']['allocated_panchayat'],'Geographical.awc_code !='=>'No','Geographical.status'=>'active')));
//             $vhsnd = $this->Bpccc->find('all',array('fields' => array('sum(Bpccc.vhsnd_no) AS totalvhsnd'),'conditions'=>array('Bpccc.allocated_panchayat'=>$r['Bpccc']['allocated_panchayat'],'Bpccc.vhsnd_no !='=>'0','Bpccc.status'=>'active')));
//             $hsc = $this->FacilityDetail->find('count',array('conditions'=>array('FacilityDetail.facility_type'=>'HSC','FacilityDetail.panchayat'=>$r['Bpccc']['allocated_panchayat'],'FacilityDetail.status'=>'active')));
//             $aphc = $this->FacilityDetail->find('count',array('conditions'=>array('FacilityDetail.facility_type'=>'APHC','FacilityDetail.panchayat'=>$r['Bpccc']['allocated_panchayat'],'FacilityDetail.status'=>'active')));
//             $asha = $this->Bpccc->find('all',array('fields' => array('sum(Bpccc.asha_no) AS totalasha'),'conditions'=>array('Bpccc.allocated_panchayat'=>$r['Bpccc']['allocated_panchayat'],'Bpccc.asha_no !='=>'0','Bpccc.status'=>'active')));
//             $ashafacilitator = $this->Bpccc->find('all',array('fields' => array('sum(Bpccc.asha_facilitators_no) AS totalashafac'),'conditions'=>array('Bpccc.allocated_panchayat'=>$r['Bpccc']['allocated_panchayat'],'Bpccc.asha_facilitators_no !='=>'0','Bpccc.status'=>'active')));
//             $aww = $this->Bpccc->find('all',array('fields' => array('sum(Bpccc.aww_no) AS totalaww'),'conditions'=>array('Bpccc.allocated_panchayat'=>$r['Bpccc']['allocated_panchayat'],'Bpccc.aww_no !='=>'0','Bpccc.status'=>'active')));
//             $anm = $this->Bpccc->find('all',array('fields' => array('sum(Bpccc.anm_no) AS totalanm'),'conditions'=>array('Bpccc.allocated_panchayat'=>$r['Bpccc']['allocated_panchayat'],'Bpccc.anm_no !='=>'0','Bpccc.status'=>'active')));
//             $youthleader=$this->Youthleader->find('count',array('conditions'=>array('Youthleader.allocated_panchayat IN'=>explode(',',$r['Bpccc']['allocated_panchayat']),'Youthleader.status'=>'active'))); 
//             $facility=$this->FacilityDetail->find('count',array('conditions'=>array('FacilityDetail.facility_type'=>'H&WC','FacilityDetail.panchayat IN'=>explode(',',$r['Bpccc']['allocated_panchayat']),'FacilityDetail.status'=>'active')));
//                         
//                $target = $this->Target->find('all',array('fields' => array('sum(Target.vhsnc_meeting_target) AS vtotal','sum(Target.feedback_target) AS ftotal','sum(Target.vhsnc_issue_target) AS vissuetotal','sum(Target.vhsnc_issueresolved_target) AS vrestotal','sum(Target.vhsnd_monitor_target) AS vdmontotal','sum(Target.vhsnc_monitor_target) AS vsmontotal','sum(Target.ivrs_feedback_target) AS mtotal','sum(Target.anm_meeting_target) AS anmtotal','sum(Target.dpmc_meeting_target) AS dpmctotal','sum(Target.bpmc_meeting_target) AS bpmctotal','sum(Target.rks_meeting_target) AS rkstotal','sum(Target.vhsnc_checklist_target) AS vschecktotal','sum(Target.vhsnd_checklist_target) AS vdchecktotal','sum(Target.facility_assessement_target) AS facilityassesstotal','sum(Target.iucd_services_target) AS iucdtotal','sum(Target.antara_services_target) AS antaratotal','sum(Target.vhsnc_expenditure_total_target) AS vexptotal','sum(Target.vhsnc_expenditure_allocation_target) AS vsalloexptotal','sum(Target.budget_utilized_target) AS budgettotal','sum(Target.anc_service_target) AS ancservicetotal','sum(Target.issue_pending_target) AS issueptotal'),'conditions'=>array('Target.status'=>'active','Target.panchayat LIKE'=>'%'.$r['Bpccc']['allocated_panchayat'].'%')));
//               $aspermonthvhsnctarget = $target['0']['0']['vtotal'];
//                    $aspermonthfeedbacktraget = $target['0']['0']['ftotal'];
//                    $aspermonthissuetarget = $target['0']['0']['vissuetotal'];
//                    $aspermonthresolvedissuetarget = $target['0']['0']['vrestotal'];
//                    $aspermonthvhsndtarget = $target['0']['0']['vdmontotal'];
//                    $aspermonthvhsncmonitortarget = $target['0']['0']['vsmontotal'];
//                    $aspermonthivrstarget = $target['0']['0']['mtotal'];
//                    $aspermonthanmmeetingtarget = $target['0']['0']['anmtotal'];
//                    $aspermonthdpmctarget = $target['0']['0']['dpmctotal'];
//                    $aspermonthbpmctarget = $target['0']['0']['bpmctotal'];
//                    $aspermonthrkstarget = $target['0']['0']['rkstotal'];
//                    $aspermonthvhsncchecklisttarget = $target['0']['0']['vschecktotal'];
//                    $aspermonthvhsndchecklisttarget = $target['0']['0']['vdchecktotal'];
//                    $aspermonthassessementtarget = $target['0']['0']['facilityassesstotal'];
//                    $aspermonthicudservicetarget = $target['0']['0']['iucdtotal'];
//                    $aspermonthantaraservicetarget = $target['0']['0']['antaratotal'];
//                    $aspermonthexpendituretarget = $target['0']['0']['vexptotal'];
//                    $aspermonthalloexptarget = $target['0']['0']['vsalloexptotal'];
//                    $aspermonthanbudgetutilizedtarget = $target['0']['0']['budgettotal'];
//                    $aspermonthancservicetarget = $target['0']['0']['ancservicetotal'];
//                    $aspermonthissuependingtarget = $target['0']['0']['issueptotal'];
//                       
//             
//               $meeting = $this->VhsncMeeting->find('count',array('conditions'=>array($condition1,'VhsncMeeting.panchayat IN'=>explode(',',$r['Bpccc']['allocated_panchayat']))));
//               $VhsncUntiedfund = $this->VhsncUntiedfund->find('all',array('fields' => array('sum(VhsncUntiedfund.expenditure_amount) AS total'),'conditions'=>array($condition2,'VhsncUntiedfund.panchayat IN'=>explode(',',$r['Bpccc']['allocated_panchayat']))));
//               $VhsncUntiedfunddetails = $this->VhsncUntiedfundDetail->find('first',array('conditions'=>array($condition9,'VhsncUntiedfundDetail.panchayat IN'=>explode(',',$r['Bpccc']['allocated_panchayat']))));
//               $VhsncUntiedfunddetail = $VhsncUntiedfunddetails['VhsncUntiedfundDetail']['opening_balance']+$VhsncUntiedfunddetails['VhsncUntiedfundDetail']['vhsnc_funds_recieved']+$VhsncUntiedfunddetails['VhsncUntiedfundDetail']['amount_recieved_from_other_source']+$VhsncUntiedfunddetails['VhsncUntiedfundDetail']['bank_interest_credit']-$VhsncUntiedfunddetails['VhsncUntiedfundDetail']['bank_charge_deduct'];
//               $vhsncfunrecieced = $VhsncUntiedfunddetails['VhsncUntiedfundDetail']['vhsnc_funds_recieved'];                       
//               $VhsncFeedback = $this->VhsncFeedback->find('count',array('group' => array('meeting_date','panchayat'),'conditions'=>array($condition3,'VhsncFeedback.panchayat IN'=>explode(',',$r['Bpccc']['allocated_panchayat']))));  
//               $Vhsncconstition = $this->VhsncConstitution->find('count',array('conditions'=>array($condition10,'VhsncConstitution.panchayat IN'=>explode(',',$r['Bpccc']['allocated_panchayat'])))); 
//               $issuecount = $this->VhsncMeeting->find('count',array('conditions'=>array($condition1,'VhsncMeeting.new_issue !='=>'0','VhsncMeeting.panchayat IN'=>explode(',',$r['Bpccc']['allocated_panchayat']))));
//               
//               $issueresolve = $this->VhsncMeeting->find('count',array('conditions'=>array($condition1,'VhsncMeeting.issue_resolved'=>'yes','VhsncMeeting.panchayat IN'=>explode(',',$r['Bpccc']['allocated_panchayat']))));
//               $issuepending = $this->VhsncMeeting->find('count',array('conditions'=>array($condition1,'VhsncMeeting.issue_resolved'=>'no','VhsncMeeting.panchayat IN'=>explode(',',$r['Bpccc']['allocated_panchayat']))));
//             // print_r($condition1) ;
//              //die();
//               $vhsndmonitored = $this->Vhsnd->find('count',array('group' => array('Vhsnd.visit_date','Vhsnd.awc_code'),'conditions'=>array($condition,'Vhsnd.panchayat IN'=>explode(',',$r['Bpccc']['allocated_panchayat']))));
//               $vhsndservice = $this->Vhsnd->find('count',array('group' => array('Vhsnd.visit_date','Vhsnd.awc_code'),'conditions'=>$condition,'Vhsnd.it_availability'=>'yes','Vhsnd.height_availability'=>'yes','Vhsnd.hb_availability'=>'yes','Vhsnd.abdomen_availability'=>'yes','Vhsnd.calcium_availability'=>'yes','Vhsnd.weight_availability'=>'yes','Vhsnd.bp_availability'=>'yes','Vhsnd.urine_availability'=>'yes','Vhsnd.ifa_availability'=>'yes','Vhsnd.panchayat IN'=>explode(',',$r['Bpccc']['allocated_panchayat'])));
//               $ivrsfeedback = $this->Ivrs->find('count',array('conditions'=>$condition4,'Ivrs.voice_feedback_recorded'=>'yes','Ivrs.panchayat IN'=>explode(',',$r['Bpccc']['allocated_panchayat'])));	 	  	 
//               $ivrsuser = $this->Ivrs->find('count',array('conditions'=>array($condition4,'Ivrs.panchayat IN'=>explode(',',$r['Bpccc']['allocated_panchayat']))));	 	  	 
//               //$dpmcmeeting = $this->Dpmc->find('count',array('conditions'=>array($condition5,'Dpmc.district'=>$r['Bpc']['allocated_district'])));	 	  	 
//              // $bpmcmeeting = $this->Bpmc->find('count',array('conditions'=>array($condition6,'Bpmc.block IN'=>explode(',',$r['Bpccc']['allocated_panchayat']))));
//               $afcmeeting = $this->AfcHomeVisit->find('count',array('conditions'=>$condition7,'AfcHomeVisit.convinced'=>'5','AfcHomeVisit.panchayat IN'=>explode(',',$r['Bpccc']['allocated_panchayat'])));
//               $afcmeeting1 = $this->AfcHomeVisit->find('count',array('conditions'=>$condition7,'AfcHomeVisit.convinced'=>'3','AfcHomeVisit.panchayat IN'=>explode(',',$r['Bpccc']['allocated_panchayat'])));
//               $AnmMeeting = $this->AnmMeeting->find('count',array('conditions'=>array($condition11,'AnmMeeting.block IN'=>explode(',',$r['Bpccc']['allocated_block']))));
//               $checklist = $this->Checklist->find('count',array('conditions'=>array($condition12,'Checklist.level'=>'vhsnc','Checklist.panchayat IN'=>explode(',',$r['Bpccc']['allocated_panchayat']))));
//               $checklistvhsnd = $this->Checklist->find('count',array('conditions'=>array($condition12,'Checklist.level'=>'vhsnd','Checklist.panchayat IN'=>explode(',',$r['Bpccc']['allocated_panchayat']))));
//               $checklistassessement = $this->FacilityAssessment->find('count',array('conditions'=>array($condition13,'FacilityAssessment.panchayat IN'=>explode(',',$r['Bpccc']['allocated_panchayat']))));
//               $facilityDetail = $this->FacilityDetail->find('count',array('conditions'=>array($condition14,'FacilityDetail.panchayat IN'=>explode(',',$r['Bpccc']['allocated_panchayat']))));
//               //$financialDetail = $this->FinancialDetail->find('all',array('fields' => array('sum(FinancialDetail.amount) AS ftotal'),'conditions'=>array($condition15,'FinancialDetail.organization'=>$r['Ngo']['id'])));
//               //$finance = $this->Finance->find('all',array('fields' => array('sum(Finance.amount) AS etotal'),'conditions'=>array($condition16,'Finance.organization'=>$r['Ngo']['id'])));
//                    
//                   $panchayats=$this->Panchayat->find('list',array('order' => array('name' => 'asc'),'conditions'=>['Panchayat.id IN'=>explode(',',$r['Bpccc']['allocated_panchayat'])]));
//                   $condition02['OR']=array('Ngo.allocated_block_one'=>explode(',',$r['Bpccc']['allocated_block']),'Ngo.allocated_block_two'=>explode(',',$r['Bpccc']['allocated_block'])); 
//                   $ngos=$this->Ngo->find('list',array('conditions'=>$condition02));
//                   $cities=$this->City->find('list',array('order' => array('name' => 'asc'),'conditions'=>array('City.id'=>$r['Bpccc']['allocated_district'])));
//                   $blocks=$this->Block->find('list',array('order' => array('name' => 'asc'),'conditions'=>array('Block.id'=>$r['Bpccc']['allocated_block'])));
//                      }
//       		}
//                 elseif(CakeSession::read('User.subrole')==='BPC'){
//		   $r = $this->Bpc->find('first',array('conditions'=>array('Bpc.first_name='.CakeSession::read('User.id'))));
//                      if($r){ 
//                
//             $citie=$this->City->find('count',array('conditions'=>array('City.id IN'=>explode(',',$r['Bpc']['allocated_district']))));
//             $block=$this->Block->find('count',array('conditions'=>array('Block.id IN'=>explode(',',$r['Bpc']['allocated_block']))));
//             $panchayat=$this->Panchayat->find('count',array('conditions'=>array('Panchayat.block_id IN'=>explode(',',$r['Bpc']['allocated_block']))));
//             $village=$this->Village->find('count',array('conditions'=>array('Village.block_id IN'=>explode(',',$r['Bpc']['allocated_block']))));
//             $house = $this->Geographical->find('all',array('fields' => array('sum(Geographical.no_of_house) AS totalhouse'),'conditions'=>array('Geographical.block IN'=>explode(',',$r['Bpc']['allocated_block']),'Geographical.status'=>'active')));
//             $population = $this->Geographical->find('all',array('fields' => array('sum(Geographical.population) AS totalpop'),'conditions'=>array('Geographical.block IN'=>explode(',',$r['Bpc']['allocated_block']),'Geographical.status'=>'active')));
//             $awc = $this->Geographical->find('count',array('conditions'=>array('Geographical.block IN'=>explode(',',$r['Bpc']['allocated_block']),'Geographical.awc_code !='=>'No','Geographical.status'=>'active')));
//             $vhsnd = $this->Bpccc->find('all',array('fields' => array('sum(Bpccc.vhsnd_no) AS totalvhsnd'),'conditions'=>array('Bpccc.allocated_block IN'=>explode(',',$r['Bpc']['allocated_block']),'Bpccc.vhsnd_no !='=>'0','Bpccc.status'=>'active')));
//             $hsc = $this->FacilityDetail->find('count',array('conditions'=>array('FacilityDetail.facility_type'=>'HSC','FacilityDetail.block IN'=>explode(',',$r['Bpc']['allocated_block']),'FacilityDetail.status'=>'active')));
//             $aphc = $this->FacilityDetail->find('count',array('conditions'=>array('FacilityDetail.facility_type'=>'APHC','FacilityDetail.block IN'=>explode(',',$r['Bpc']['allocated_block']),'FacilityDetail.status'=>'active')));
//             $asha = $this->Bpccc->find('all',array('fields' => array('sum(Bpccc.asha_no) AS totalasha'),'conditions'=>array('Bpccc.allocated_block IN'=>explode(',',$r['Bpc']['allocated_block']),'Bpccc.asha_no !='=>'0','Bpccc.status'=>'active')));
//             $ashafacilitator = $this->Bpccc->find('all',array('fields' => array('sum(Bpccc.asha_facilitators_no) AS totalashafac'),'conditions'=>array('Bpccc.allocated_block IN'=>explode(',',$r['Bpc']['allocated_block']),'Bpccc.asha_facilitators_no !='=>'0','Bpccc.status'=>'active')));
//             $aww = $this->Bpccc->find('all',array('fields' => array('sum(Bpccc.aww_no) AS totalaww'),'conditions'=>array('Bpccc.allocated_block IN'=>explode(',',$r['Bpc']['allocated_block']),'Bpccc.aww_no !='=>'0','Bpccc.status'=>'active')));
//             $anm = $this->Bpccc->find('all',array('fields' => array('sum(Bpccc.anm_no) AS totalanm'),'conditions'=>array('Bpccc.allocated_block IN'=>explode(',',$r['Bpc']['allocated_block']),'Bpccc.anm_no !='=>'0','Bpccc.status'=>'active')));
//             $youthleader=$this->Youthleader->find('count',array('conditions'=>array('Youthleader.allocated_block IN'=>explode(',',$r['Bpc']['allocated_block']),'Youthleader.status'=>'active'))); 
//             $facility=$this->FacilityDetail->find('count',array('conditions'=>array('FacilityDetail.facility_type'=>'H&WC','FacilityDetail.block IN'=>explode(',',$r['Bpc']['allocated_block']),'FacilityDetail.status'=>'active')));
//              $target = $this->Target->find('all',array('fields' => array('sum(Target.vhsnc_meeting_target) AS vtotal','sum(Target.feedback_target) AS ftotal','sum(Target.vhsnc_issue_target) AS vissuetotal','sum(Target.vhsnc_issueresolved_target) AS vrestotal','sum(Target.vhsnd_monitor_target) AS vdmontotal','sum(Target.vhsnc_monitor_target) AS vsmontotal','sum(Target.ivrs_feedback_target) AS mtotal','sum(Target.anm_meeting_target) AS anmtotal','sum(Target.dpmc_meeting_target) AS dpmctotal','sum(Target.bpmc_meeting_target) AS bpmctotal','sum(Target.rks_meeting_target) AS rkstotal','sum(Target.vhsnc_checklist_target) AS vschecktotal','sum(Target.vhsnd_checklist_target) AS vdchecktotal','sum(Target.facility_assessement_target) AS facilityassesstotal','sum(Target.iucd_services_target) AS iucdtotal','sum(Target.antara_services_target) AS antaratotal','sum(Target.vhsnc_expenditure_total_target) AS vexptotal','sum(Target.vhsnc_expenditure_allocation_target) AS vsalloexptotal','sum(Target.budget_utilized_target) AS budgettotal','sum(Target.anc_service_target) AS ancservicetotal','sum(Target.issue_pending_target) AS issueptotal'),'conditions'=>array('Target.status'=>'active','Target.block IN'=>explode(',',$r['Bpc']['allocated_block']))));
//               $aspermonthvhsnctarget = $target['0']['0']['vtotal'];
//                    $aspermonthfeedbacktraget = $target['0']['0']['ftotal'];
//                    $aspermonthissuetarget = $target['0']['0']['vissuetotal'];
//                    $aspermonthresolvedissuetarget = $target['0']['0']['vrestotal'];
//                    $aspermonthvhsndtarget = $target['0']['0']['vdmontotal'];
//                    $aspermonthvhsncmonitortarget = $target['0']['0']['vsmontotal'];
//                    $aspermonthivrstarget = $target['0']['0']['mtotal'];
//                    $aspermonthanmmeetingtarget = $target['0']['0']['anmtotal'];
//                    $aspermonthdpmctarget = $target['0']['0']['dpmctotal'];
//                    $aspermonthbpmctarget = $target['0']['0']['bpmctotal'];
//                    $aspermonthrkstarget = $target['0']['0']['rkstotal'];
//                    $aspermonthvhsncchecklisttarget = $target['0']['0']['vschecktotal'];
//                    $aspermonthvhsndchecklisttarget = $target['0']['0']['vdchecktotal'];
//                    $aspermonthassessementtarget = $target['0']['0']['facilityassesstotal'];
//                    $aspermonthicudservicetarget = $target['0']['0']['iucdtotal'];
//                    $aspermonthantaraservicetarget = $target['0']['0']['antaratotal'];
//                    $aspermonthexpendituretarget = $target['0']['0']['vexptotal'];
//                    $aspermonthalloexptarget = $target['0']['0']['vsalloexptotal'];
//                    $aspermonthanbudgetutilizedtarget = $target['0']['0']['budgettotal'];
//                    $aspermonthancservicetarget = $target['0']['0']['ancservicetotal'];
//                    $aspermonthissuependingtarget = $target['0']['0']['issueptotal'];
//                                 
//               $meeting = $this->VhsncMeeting->find('count',array('conditions'=>array($condition1,'VhsncMeeting.block IN'=>explode(',',$r['Bpc']['allocated_block']))));
//               $VhsncUntiedfund = $this->VhsncUntiedfund->find('all',array('fields' => array('sum(VhsncUntiedfund.expenditure_amount) AS total'),'conditions'=>array($condition2,'VhsncUntiedfund.block IN'=>explode(',',$r['Bpc']['allocated_block']))));
//               $VhsncUntiedfunddetails = $this->VhsncUntiedfundDetail->find('first',array('conditions'=>array($condition9,'VhsncUntiedfundDetail.block IN'=>explode(',',$r['Bpc']['allocated_block']))));
//               $VhsncUntiedfunddetail = $VhsncUntiedfunddetails['VhsncUntiedfundDetail']['opening_balance']+$VhsncUntiedfunddetails['VhsncUntiedfundDetail']['vhsnc_funds_recieved']+$VhsncUntiedfunddetails['VhsncUntiedfundDetail']['amount_recieved_from_other_source']+$VhsncUntiedfunddetails['VhsncUntiedfundDetail']['bank_interest_credit']-$VhsncUntiedfunddetails['VhsncUntiedfundDetail']['bank_charge_deduct'];
//               $vhsncfunrecieced = $VhsncUntiedfunddetails['VhsncUntiedfundDetail']['vhsnc_funds_recieved'];                       
//               $VhsncFeedback = $this->VhsncFeedback->find('count',array('group' => array('meeting_date','panchayat'),'conditions'=>array($condition3,'VhsncFeedback.block IN'=>explode(',',$r['Bpc']['allocated_block']))));  
//               $Vhsncconstition = $this->VhsncConstitution->find('count',array('conditions'=>array($condition10,'VhsncConstitution.block IN'=>explode(',',$r['Bpc']['allocated_block'])))); 
//               $issuecount = $this->VhsncMeeting->find('count',array('conditions'=>array($condition1,'VhsncMeeting.new_issue !='=>'0','VhsncMeeting.block IN'=>explode(',',$r['Bpc']['allocated_block']))));
//               $issueresolve = $this->VhsncMeeting->find('count',array('conditions'=>array($condition1,'VhsncMeeting.issue_resolved'=>'yes','VhsncMeeting.block IN'=>explode(',',$r['Bpc']['allocated_block']))));
//               $issuepending = $this->VhsncMeeting->find('count',array('conditions'=>array($condition1,'VhsncMeeting.issue_resolved'=>'no','VhsncMeeting.block IN'=>explode(',',$r['Bpc']['allocated_block']))));
//               $vhsndmonitored = $this->Vhsnd->find('count',array('group' => array('Vhsnd.visit_date','Vhsnd.awc_code'),'conditions'=>array($condition,'Vhsnd.block IN'=>explode(',',$r['Bpc']['allocated_block']))));
//               $vhsndservice = $this->Vhsnd->find('count',array('group' => array('Vhsnd.visit_date','Vhsnd.awc_code'),'conditions'=>$condition,'Vhsnd.it_availability'=>'yes','Vhsnd.height_availability'=>'yes','Vhsnd.hb_availability'=>'yes','Vhsnd.abdomen_availability'=>'yes','Vhsnd.calcium_availability'=>'yes','Vhsnd.weight_availability'=>'yes','Vhsnd.bp_availability'=>'yes','Vhsnd.urine_availability'=>'yes','Vhsnd.ifa_availability'=>'yes','Vhsnd.block IN'=>explode(',',$r['Bpc']['allocated_block'])));
//               $ivrsfeedback = $this->Ivrs->find('count',array('conditions'=>$condition4,'Ivrs.voice_feedback_recorded'=>'yes','Ivrs.block IN'=>explode(',',$r['Bpc']['allocated_block'])));	 	  	 
//               $ivrsuser = $this->Ivrs->find('count',array('conditions'=>array($condition4,'Ivrs.block IN'=>explode(',',$r['Bpc']['allocated_block']))));	 	  	 
//               //$dpmcmeeting = $this->Dpmc->find('count',array('conditions'=>array($condition5,'Dpmc.district'=>$r['Bpc']['allocated_district'])));	 	  	 
//               $bpmcmeeting = $this->Bpmc->find('count',array('conditions'=>array($condition6,'Bpmc.block IN'=>explode(',',$r['Bpc']['allocated_block']))));
//               $afcmeeting = $this->AfcHomeVisit->find('count',array('conditions'=>$condition7,'AfcHomeVisit.convinced'=>'5','AfcHomeVisit.block IN'=>explode(',',$r['Bpc']['allocated_block'])));
//               $afcmeeting1 = $this->AfcHomeVisit->find('count',array('conditions'=>$condition7,'AfcHomeVisit.convinced'=>'3','AfcHomeVisit.block IN'=>explode(',',$r['Bpc']['allocated_block'])));
//               $AnmMeeting = $this->AnmMeeting->find('count',array('conditions'=>array($condition11,'AnmMeeting.block IN'=>explode(',',$r['Bpc']['allocated_block']))));
//               $checklist = $this->Checklist->find('count',array('conditions'=>array($condition12,'Checklist.level'=>'vhsnc','Checklist.block IN'=>explode(',',$r['Bpc']['allocated_block']))));
//               $checklistvhsnd = $this->Checklist->find('count',array('conditions'=>array($condition12,'Checklist.level'=>'vhsnd','Checklist.block IN'=>explode(',',$r['Bpc']['allocated_block']))));
//               $checklistassessement = $this->FacilityAssessment->find('count',array('conditions'=>array($condition13,'FacilityAssessment.block IN'=>explode(',',$r['Bpc']['allocated_block']))));
//               $facilityDetail = $this->FacilityDetail->find('count',array('conditions'=>array($condition14,'FacilityDetail.block IN'=>explode(',',$r['Bpc']['allocated_block']))));
//               //$financialDetail = $this->FinancialDetail->find('all',array('fields' => array('sum(FinancialDetail.amount) AS ftotal'),'conditions'=>array($condition15,'FinancialDetail.organization'=>$r['Ngo']['id'])));
//               //$finance = $this->Finance->find('all',array('fields' => array('sum(Finance.amount) AS etotal'),'conditions'=>array($condition16,'Finance.organization'=>$r['Ngo']['id'])));
//                        
//		    $blocks=$this->Block->find('list',array('order' => array('name' => 'asc'),'conditions'=>array('Block.id IN'=>explode(',',$r['Bpc']['allocated_block']))));
//                    $condition02['OR']=array('Ngo.allocated_block_one'=>explode(',',$r['Bpc']['allocated_block']),'Ngo.allocated_block_two'=>explode(',',$r['Bpc']['allocated_block'])); 
//                    $ngos=$this->Ngo->find('list',array('conditions'=>$condition02));
//                      } 
//		}
//                 else {
//                    
//		   $r = $this->Dpo->find('first',array('conditions'=>array('Dpo.first_name='.CakeSession::read('User.id'))));
//                      if($r){
//                          
//             $citie=$this->City->find('count',array('conditions'=>array('City.id IN'=>explode(',',$r['Dpo']['district']))));
//             $block=$this->Block->find('count',array('conditions'=>array('Block.city_id IN'=>explode(',',$r['Dpo']['district']))));
//             $panchayat=$this->Panchayat->find('count',array('conditions'=>array('Panchayat.city_id IN'=>explode(',',$r['Dpo']['district']))));
//             $village=$this->Village->find('count',array('conditions'=>array('Village.city_id IN'=>explode(',',$r['Dpo']['district']))));
//             $house = $this->Geographical->find('all',array('fields' => array('sum(Geographical.no_of_house) AS totalhouse'),'conditions'=>array('Geographical.district IN'=>explode(',',$r['Dpo']['district']),'Geographical.status'=>'active')));
//             $population = $this->Geographical->find('all',array('fields' => array('sum(Geographical.population) AS totalpop'),'conditions'=>array('Geographical.district IN'=>explode(',',$r['Dpo']['district']),'Geographical.status'=>'active')));
//             $awc = $this->Geographical->find('count',array('conditions'=>array('Geographical.district IN'=>explode(',',$r['Dpo']['district']),'Geographical.awc_code !='=>'No','Geographical.status'=>'active')));
//             $vhsnd = $this->Bpccc->find('all',array('fields' => array('sum(Bpccc.vhsnd_no) AS totalvhsnd'),'conditions'=>array('Bpccc.allocated_district IN'=>explode(',',$r['Dpo']['district']),'Bpccc.vhsnd_no !='=>'0','Bpccc.status'=>'active')));
//             $hsc = $this->FacilityDetail->find('count',array('conditions'=>array('FacilityDetail.facility_type'=>'HSC','FacilityDetail.district IN'=>explode(',',$r['Dpo']['district']),'FacilityDetail.status'=>'active')));
//             $aphc = $this->FacilityDetail->find('count',array('conditions'=>array('FacilityDetail.facility_type'=>'APHC','FacilityDetail.district IN'=>explode(',',$r['Dpo']['district']),'FacilityDetail.status'=>'active')));
//             $asha = $this->Bpccc->find('all',array('fields' => array('sum(Bpccc.asha_no) AS totalasha'),'conditions'=>array('Bpccc.allocated_district IN'=>explode(',',$r['Dpo']['district']),'Bpccc.asha_no !='=>'0','Bpccc.status'=>'active')));
//             $ashafacilitator = $this->Bpccc->find('all',array('fields' => array('sum(Bpccc.asha_facilitators_no) AS totalashafac'),'conditions'=>array('Bpccc.allocated_district IN'=>explode(',',$r['Dpo']['district']),'Bpccc.asha_facilitators_no !='=>'0','Bpccc.status'=>'active')));
//             $aww = $this->Bpccc->find('all',array('fields' => array('sum(Bpccc.aww_no) AS totalaww'),'conditions'=>array('Bpccc.allocated_district IN'=>explode(',',$r['Dpo']['district']),'Bpccc.aww_no !='=>'0','Bpccc.status'=>'active')));
//             $anm = $this->Bpccc->find('all',array('fields' => array('sum(Bpccc.anm_no) AS totalanm'),'conditions'=>array('Bpccc.allocated_district IN'=>explode(',',$r['Dpo']['district']),'Bpccc.anm_no !='=>'0','Bpccc.status'=>'active')));
//             $youthleader=$this->Youthleader->find('count',array('conditions'=>array('Youthleader.allocated_district IN'=>explode(',',$r['Dpo']['district']),'Youthleader.status'=>'active'))); 
//             $facility=$this->FacilityDetail->find('count',array('conditions'=>array('FacilityDetail.facility_type'=>'H&WC','FacilityDetail.district IN'=>explode(',',$r['Dpo']['district']),'FacilityDetail.status'=>'active')));
//             $target = $this->Target->find('all',array('fields' => array('sum(Target.vhsnc_meeting_target) AS vtotal','sum(Target.feedback_target) AS ftotal','sum(Target.vhsnc_issue_target) AS vissuetotal','sum(Target.vhsnc_issueresolved_target) AS vrestotal','sum(Target.vhsnd_monitor_target) AS vdmontotal','sum(Target.vhsnc_monitor_target) AS vsmontotal','sum(Target.ivrs_feedback_target) AS mtotal','sum(Target.anm_meeting_target) AS anmtotal','sum(Target.dpmc_meeting_target) AS dpmctotal','sum(Target.bpmc_meeting_target) AS bpmctotal','sum(Target.rks_meeting_target) AS rkstotal','sum(Target.vhsnc_checklist_target) AS vschecktotal','sum(Target.vhsnd_checklist_target) AS vdchecktotal','sum(Target.facility_assessement_target) AS facilityassesstotal','sum(Target.iucd_services_target) AS iucdtotal','sum(Target.antara_services_target) AS antaratotal','sum(Target.vhsnc_expenditure_total_target) AS vexptotal','sum(Target.vhsnc_expenditure_allocation_target) AS vsalloexptotal','sum(Target.budget_utilized_target) AS budgettotal','sum(Target.anc_service_target) AS ancservicetotal','sum(Target.issue_pending_target) AS issueptotal'),'conditions'=>array('Target.status'=>'active','Target.district IN'=>explode(',',$r['Dpo']['district']))));
//               $aspermonthvhsnctarget = $target['0']['0']['vtotal'];
//                    $aspermonthfeedbacktraget = $target['0']['0']['ftotal'];
//                    $aspermonthissuetarget = $target['0']['0']['vissuetotal'];
//                    $aspermonthresolvedissuetarget = $target['0']['0']['vrestotal'];
//                    $aspermonthvhsndtarget = $target['0']['0']['vdmontotal'];
//                    $aspermonthvhsncmonitortarget = $target['0']['0']['vsmontotal'];
//                    $aspermonthivrstarget = $target['0']['0']['mtotal'];
//                    $aspermonthanmmeetingtarget = $target['0']['0']['anmtotal'];
//                    $aspermonthdpmctarget = $target['0']['0']['dpmctotal'];
//                    $aspermonthbpmctarget = $target['0']['0']['bpmctotal'];
//                    $aspermonthrkstarget = $target['0']['0']['rkstotal'];
//                    $aspermonthvhsncchecklisttarget = $target['0']['0']['vschecktotal'];
//                    $aspermonthvhsndchecklisttarget = $target['0']['0']['vdchecktotal'];
//                    $aspermonthassessementtarget = $target['0']['0']['facilityassesstotal'];
//                    $aspermonthicudservicetarget = $target['0']['0']['iucdtotal'];
//                    $aspermonthantaraservicetarget = $target['0']['0']['antaratotal'];
//                    $aspermonthexpendituretarget = $target['0']['0']['vexptotal'];
//                    $aspermonthalloexptarget = $target['0']['0']['vsalloexptotal'];
//                    $aspermonthanbudgetutilizedtarget = $target['0']['0']['budgettotal'];
//                    $aspermonthancservicetarget = $target['0']['0']['ancservicetotal'];
//                    $aspermonthissuependingtarget = $target['0']['0']['issueptotal'];
//                   
//               $meeting = $this->VhsncMeeting->find('count',array('conditions'=>array($condition1,'VhsncMeeting.district'=>explode(',',$r['Dpo']['district']))));
//               $VhsncUntiedfund = $this->VhsncUntiedfund->find('all',array('fields' => array('sum(VhsncUntiedfund.expenditure_amount) AS total'),'conditions'=>array($condition2,'VhsncUntiedfund.district'=>explode(',',$r['Dpo']['district']))));
//               $VhsncUntiedfunddetails = $this->VhsncUntiedfundDetail->find('first',array('conditions'=>array($condition9,'VhsncUntiedfundDetail.district'=>explode(',',$r['Dpo']['district']))));
//               $VhsncUntiedfunddetail = $VhsncUntiedfunddetails['VhsncUntiedfundDetail']['opening_balance']+$VhsncUntiedfunddetails['VhsncUntiedfundDetail']['vhsnc_funds_recieved']+$VhsncUntiedfunddetails['VhsncUntiedfundDetail']['amount_recieved_from_other_source']+$VhsncUntiedfunddetails['VhsncUntiedfundDetail']['bank_interest_credit']-$VhsncUntiedfunddetails['VhsncUntiedfundDetail']['bank_charge_deduct'];
//               $vhsncfunrecieced = $VhsncUntiedfunddetails['VhsncUntiedfundDetail']['vhsnc_funds_recieved'];                       
//               $VhsncFeedback = $this->VhsncFeedback->find('count',array('group' => array('meeting_date','panchayat'),'conditions'=>array($condition3,'VhsncFeedback.district'=>explode(',',$r['Dpo']['district']))));  
//               $Vhsncconstition = $this->VhsncConstitution->find('count',array('conditions'=>array($condition10,'VhsncConstitution.district'=>explode(',',$r['Dpo']['district'])))); 
//               $issuecount = $this->VhsncMeeting->find('count',array('conditions'=>array($condition1,'VhsncMeeting.new_issue !='=>'0','VhsncMeeting.district'=>explode(',',$r['Dpo']['district']))));
//               $issueresolve = $this->VhsncMeeting->find('count',array('conditions'=>array($condition1,'VhsncMeeting.issue_resolved'=>'yes','VhsncMeeting.district'=>explode(',',$r['Dpo']['district']))));
//               $issuepending = $this->VhsncMeeting->find('count',array('conditions'=>array($condition1,'VhsncMeeting.issue_resolved'=>'no','VhsncMeeting.district'=>explode(',',$r['Dpo']['district']))));
//               $vhsndmonitored = $this->Vhsnd->find('count',array('group' => array('Vhsnd.visit_date','Vhsnd.awc_code'),'conditions'=>array($condition,'Vhsnd.district'=>explode(',',$r['Dpo']['district']))));
//               $vhsndservice = $this->Vhsnd->find('count',array('group' => array('Vhsnd.visit_date','Vhsnd.awc_code'),'conditions'=>$condition,'Vhsnd.it_availability'=>'yes','Vhsnd.height_availability'=>'yes','Vhsnd.hb_availability'=>'yes','Vhsnd.abdomen_availability'=>'yes','Vhsnd.calcium_availability'=>'yes','Vhsnd.weight_availability'=>'yes','Vhsnd.bp_availability'=>'yes','Vhsnd.urine_availability'=>'yes','Vhsnd.ifa_availability'=>'yes','Vhsnd.district'=>explode(',',$r['Dpo']['district'])));
//               $ivrsfeedback = $this->Ivrs->find('count',array('conditions'=>$condition4,'Ivrs.voice_feedback_recorded'=>'yes','Ivrs.district'=>explode(',',$r['Dpo']['district'])));	 	  	 
//               $ivrsuser = $this->Ivrs->find('count',array('conditions'=>array($condition4,'Ivrs.district'=>explode(',',$r['Dpo']['district']))));	 	  	 
//               $dpmcmeeting = $this->Dpmc->find('count',array('conditions'=>array($condition5,'Dpmc.district'=>explode(',',$r['Dpo']['district']))));	 	  	 
//               $bpmcmeeting = $this->Bpmc->find('count',array('conditions'=>array($condition6,'Bpmc.district'=>explode(',',$r['Dpo']['district']))));
//               $afcmeeting = $this->AfcHomeVisit->find('count',array('conditions'=>$condition7,'AfcHomeVisit.convinced'=>'5','AfcHomeVisit.district'=>explode(',',$r['Dpo']['district'])));
//               $afcmeeting1 = $this->AfcHomeVisit->find('count',array('conditions'=>$condition7,'AfcHomeVisit.convinced'=>'3','AfcHomeVisit.district'=>explode(',',$r['Dpo']['district'])));
//               $AnmMeeting = $this->AnmMeeting->find('count',array('conditions'=>array($condition11,'AnmMeeting.district'=>explode(',',$r['Dpo']['district']))));
//               $checklist = $this->Checklist->find('count',array('conditions'=>array($condition12,'Checklist.level'=>'vhsnc','Checklist.district'=>explode(',',$r['Dpo']['district']))));
//               $checklistvhsnd = $this->Checklist->find('count',array('conditions'=>array($condition12,'Checklist.level'=>'vhsnd','Checklist.district'=>explode(',',$r['Dpo']['district']))));
//               $checklistassessement = $this->FacilityAssessment->find('count',array('conditions'=>array($condition13,'FacilityAssessment.district'=>explode(',',$r['Dpo']['district']))));
//               $facilityDetail = $this->FacilityDetail->find('count',array('conditions'=>array($condition14,'FacilityDetail.district'=>explode(',',$r['Dpo']['district']))));
//               //$financialDetail = $this->FinancialDetail->find('all',array('fields' => array('sum(FinancialDetail.amount) AS ftotal'),'conditions'=>array($condition15,'FinancialDetail.organization'=>$r['Ngo']['id'])));
//               //$finance = $this->Finance->find('all',array('fields' => array('sum(Finance.amount) AS etotal'),'conditions'=>array($condition16,'Finance.organization'=>$r['Ngo']['id'])));
//                 
//                      $cities=$this->City->find('list',array('order' => array('name' => 'asc'),'conditions'=>array('City.id IN'=>explode(',',$r['Dpo']['district']))));
//                      $blocks=$this->Block->find('list',array('order' => array('name' => 'asc'),'conditions'=>array('Block.city_id IN'=>explode(',',$r['Dpo']['district']))));
//                      $ngos=$this->Ngo->find('list',array('conditions'=>array('Ngo.allocated_district IN'=>explode(',',$r['Dpo']['district']))));
//                     
//                           }
//		     
//		}
//         }
//         elseif(CakeSession::read('User.type')==='user'){
//            $r = $this->Ngo->find('first',array('conditions'=>array('Ngo.chief_functionary_name='.CakeSession::read('User.id'))));
//                 if($r){
//                     $blo=array();
//                   $blo= [$r['Ngo']['allocated_block_one'],$r['Ngo']['allocated_block_two']];
//                  
//             $citie=$this->City->find('count',array('conditions'=>array('City.id IN'=>explode(',',$r['Ngo']['allocated_district']))));
//             $block=$this->Block->find('count',array('conditions'=>array('Block.id IN'=>$blo)));
//             $panchayat=$this->Panchayat->find('count',array('conditions'=>array('Panchayat.block_id IN'=>$blo)));
//             $village=$this->Village->find('count',array('conditions'=>array('Village.block_id IN'=>$blo)));
//             $house = $this->Geographical->find('all',array('fields' => array('sum(Geographical.no_of_house) AS totalhouse'),'conditions'=>array('Geographical.block IN'=>$blo,'Geographical.status'=>'active')));
//             $population = $this->Geographical->find('all',array('fields' => array('sum(Geographical.population) AS totalpop'),'conditions'=>array('Geographical.block IN'=>$blo,'Geographical.status'=>'active')));
//             $awc = $this->Geographical->find('count',array('conditions'=>array('Geographical.block IN'=>$blo),'Geographical.awc_code !='=>'No','Geographical.status'=>'active'));
//             $vhsnd = $this->Bpccc->find('all',array('fields' => array('sum(Bpccc.vhsnd_no) AS totalvhsnd'),'conditions'=>array('Bpccc.allocated_block IN'=>$blo,'Bpccc.vhsnd_no !='=>'0','Bpccc.status'=>'active')));
//             $hsc = $this->FacilityDetail->find('count',array('conditions'=>array('FacilityDetail.facility_type'=>'HSC','FacilityDetail.block IN'=>$blo,'FacilityDetail.status'=>'active')));
//             $aphc = $this->FacilityDetail->find('count',array('conditions'=>array('FacilityDetail.facility_type'=>'APHC','FacilityDetail.block IN'=>$blo,'FacilityDetail.status'=>'active')));
//             $asha = $this->Bpccc->find('all',array('fields' => array('sum(Bpccc.asha_no) AS totalasha'),'conditions'=>array('Bpccc.allocated_block IN'=>$blo,'Bpccc.asha_no !='=>'0','Bpccc.status'=>'active')));
//             $ashafacilitator = $this->Bpccc->find('all',array('fields' => array('sum(Bpccc.asha_facilitators_no) AS totalashafac'),'conditions'=>array('Bpccc.allocated_block IN'=>$blo,'Bpccc.asha_facilitators_no !='=>'0','Bpccc.status'=>'active')));
//             $aww = $this->Bpccc->find('all',array('fields' => array('sum(Bpccc.aww_no) AS totalaww'),'conditions'=>array('Bpccc.allocated_block IN'=>$blo,'Bpccc.aww_no !='=>'0','Bpccc.status'=>'active')));
//             $anm = $this->Bpccc->find('all',array('fields' => array('sum(Bpccc.anm_no) AS totalanm'),'conditions'=>array('Bpccc.allocated_block IN'=>$blo,'Bpccc.anm_no !='=>'0','Bpccc.status'=>'active')));
//             $youthleader=$this->Youthleader->find('count',array('conditions'=>array('Youthleader.allocated_block IN'=>$blo,'Youthleader.status'=>'active'))); 
//             $facility=$this->FacilityDetail->find('count',array('conditions'=>array('FacilityDetail.facility_type'=>'H&WC','FacilityDetail.block IN'=>$blo),'FacilityDetail.status'=>'active'));
//             $target = $this->Target->find('all',array('fields' => array('sum(Target.vhsnc_meeting_target) AS vtotal','sum(Target.feedback_target) AS ftotal','sum(Target.vhsnc_issue_target) AS vissuetotal','sum(Target.vhsnc_issueresolved_target) AS vrestotal','sum(Target.vhsnd_monitor_target) AS vdmontotal','sum(Target.vhsnc_monitor_target) AS vsmontotal','sum(Target.ivrs_feedback_target) AS mtotal','sum(Target.anm_meeting_target) AS anmtotal','sum(Target.dpmc_meeting_target) AS dpmctotal','sum(Target.bpmc_meeting_target) AS bpmctotal','sum(Target.rks_meeting_target) AS rkstotal','sum(Target.vhsnc_checklist_target) AS vschecktotal','sum(Target.vhsnd_checklist_target) AS vdchecktotal','sum(Target.facility_assessement_target) AS facilityassesstotal','sum(Target.iucd_services_target) AS iucdtotal','sum(Target.antara_services_target) AS antaratotal','sum(Target.vhsnc_expenditure_total_target) AS vexptotal','sum(Target.vhsnc_expenditure_allocation_target) AS vsalloexptotal','sum(Target.budget_utilized_target) AS budgettotal','sum(Target.anc_service_target) AS ancservicetotal','sum(Target.issue_pending_target) AS issueptotal'),'conditions'=>array('Target.status'=>'active','Target.organization IN'=>explode(',',$r['Ngo']['id']))));
//               $aspermonthvhsnctarget = $target['0']['0']['vtotal'];
//                    $aspermonthfeedbacktraget = $target['0']['0']['ftotal'];
//                    $aspermonthissuetarget = $target['0']['0']['vissuetotal'];
//                    $aspermonthresolvedissuetarget = $target['0']['0']['vrestotal'];
//                    $aspermonthvhsndtarget = $target['0']['0']['vdmontotal'];
//                    $aspermonthvhsncmonitortarget = $target['0']['0']['vsmontotal'];
//                    $aspermonthivrstarget = $target['0']['0']['mtotal'];
//                    $aspermonthanmmeetingtarget = $target['0']['0']['anmtotal'];
//                    $aspermonthdpmctarget = $target['0']['0']['dpmctotal'];
//                    $aspermonthbpmctarget = $target['0']['0']['bpmctotal'];
//                    $aspermonthrkstarget = $target['0']['0']['rkstotal'];
//                    $aspermonthvhsncchecklisttarget = $target['0']['0']['vschecktotal'];
//                    $aspermonthvhsndchecklisttarget = $target['0']['0']['vdchecktotal'];
//                    $aspermonthassessementtarget = $target['0']['0']['facilityassesstotal'];
//                    $aspermonthicudservicetarget = $target['0']['0']['iucdtotal'];
//                    $aspermonthantaraservicetarget = $target['0']['0']['antaratotal'];
//                    $aspermonthexpendituretarget = $target['0']['0']['vexptotal'];
//                    $aspermonthalloexptarget = $target['0']['0']['vsalloexptotal'];
//                    $aspermonthanbudgetutilizedtarget = $target['0']['0']['budgettotal'];
//                    $aspermonthancservicetarget = $target['0']['0']['ancservicetotal'];
//                    $aspermonthissuependingtarget = $target['0']['0']['issueptotal'];
//                            
//                
//                    
//                ////
//               $meeting = $this->VhsncMeeting->find('count',array('conditions'=>array($condition1,'VhsncMeeting.block IN'=>$blo)));
//               $VhsncUntiedfund = $this->VhsncUntiedfund->find('all',array('fields' => array('sum(VhsncUntiedfund.expenditure_amount) AS total'),'conditions'=>array($condition2,'VhsncUntiedfund.block IN'=>$blo)));
//               $VhsncUntiedfunddetails = $this->VhsncUntiedfundDetail->find('first',array('conditions'=>array($condition9,'VhsncUntiedfundDetail.block IN'=>$blo)));
//               $VhsncUntiedfunddetail = $VhsncUntiedfunddetails['VhsncUntiedfundDetail']['opening_balance']+$VhsncUntiedfunddetails['VhsncUntiedfundDetail']['vhsnc_funds_recieved']+$VhsncUntiedfunddetails['VhsncUntiedfundDetail']['amount_recieved_from_other_source']+$VhsncUntiedfunddetails['VhsncUntiedfundDetail']['bank_interest_credit']-$VhsncUntiedfunddetails['VhsncUntiedfundDetail']['bank_charge_deduct'];
//               $vhsncfunrecieced = $VhsncUntiedfunddetails['VhsncUntiedfundDetail']['vhsnc_funds_recieved'];                       
//               $VhsncFeedback = $this->VhsncFeedback->find('count',array('group' => array('meeting_date','panchayat'),'conditions'=>array($condition3,'VhsncFeedback.block IN'=>$blo)));  
//               $Vhsncconstition = $this->VhsncConstitution->find('count',array('conditions'=>array($condition10,'VhsncConstitution.block IN'=>$blo))); 
//               $issuecount = $this->VhsncMeeting->find('count',array('conditions'=>array($condition1,'VhsncMeeting.new_issue !='=>'0','VhsncMeeting.block IN'=>$blo)));
//               $issueresolve = $this->VhsncMeeting->find('count',array('conditions'=>array($condition1,'VhsncMeeting.issue_resolved'=>'yes','VhsncMeeting.block IN'=>$blo)));
//               $issuepending = $this->VhsncMeeting->find('count',array('conditions'=>array($condition1,'VhsncMeeting.issue_resolved'=>'no','VhsncMeeting.block IN'=>$blo)));
//               $vhsndmonitored = $this->Vhsnd->find('count',array('group' => array('Vhsnd.visit_date','Vhsnd.awc_code'),'conditions'=>array($condition,'Vhsnd.block IN'=>$blo)));
//               $vhsndservice = $this->Vhsnd->find('count',array('group' => array('Vhsnd.visit_date','Vhsnd.awc_code'),'conditions'=>$condition,'Vhsnd.it_availability'=>'yes','Vhsnd.height_availability'=>'yes','Vhsnd.hb_availability'=>'yes','Vhsnd.abdomen_availability'=>'yes','Vhsnd.calcium_availability'=>'yes','Vhsnd.weight_availability'=>'yes','Vhsnd.bp_availability'=>'yes','Vhsnd.urine_availability'=>'yes','Vhsnd.ifa_availability'=>'yes','Vhsnd.block IN'=>$blo));
//               $ivrsfeedback = $this->Ivrs->find('count',array('conditions'=>$condition4,'Ivrs.voice_feedback_recorded'=>'yes','Ivrs.block IN'=>$blo));	 	  	 
//               $ivrsuser = $this->Ivrs->find('count',array('conditions'=>array($condition4,'Ivrs.block IN'=>$blo)));	 	  	 
//               $dpmcmeeting = $this->Dpmc->find('count',array('conditions'=>array($condition5,'Dpmc.district'=>$r['Ngo']['allocated_district'])));	 	  	 
//               $bpmcmeeting = $this->Bpmc->find('count',array('conditions'=>array($condition6,'Bpmc.block IN'=>$blo)));
//               $afcmeeting = $this->AfcHomeVisit->find('count',array('conditions'=>$condition7,'AfcHomeVisit.convinced'=>'5','AfcHomeVisit.block IN'=>$blo));
//               $afcmeeting1 = $this->AfcHomeVisit->find('count',array('conditions'=>$condition7,'AfcHomeVisit.convinced'=>'3','AfcHomeVisit.block IN'=>$blo));
//               $AnmMeeting = $this->AnmMeeting->find('count',array('conditions'=>array($condition11,'AnmMeeting.block IN'=>$blo)));
//               $checklist = $this->Checklist->find('count',array('conditions'=>array($condition12,'Checklist.level'=>'vhsnc','Checklist.block IN'=>$blo)));
//               $checklistvhsnd = $this->Checklist->find('count',array('conditions'=>array($condition12,'Checklist.level'=>'vhsnd','Checklist.block IN'=>$blo)));
//               $checklistassessement = $this->FacilityAssessment->find('count',array('conditions'=>array($condition13,'FacilityAssessment.block IN'=>$blo)));
//               $facilityDetail = $this->FacilityDetail->find('count',array('conditions'=>array($condition14,'FacilityDetail.block IN'=>$blo)));
//               $financialDetail = $this->FinancialDetail->find('all',array('fields' => array('sum(FinancialDetail.amount) AS ftotal'),'conditions'=>array($condition15,'FinancialDetail.organization'=>$r['Ngo']['id'])));
//               $finance = $this->Finance->find('all',array('fields' => array('sum(Finance.amount) AS etotal'),'conditions'=>array($condition16,'Finance.organization'=>$r['Ngo']['id'])));
//                 
//                    
//                ///    
//                 $ngos=$this->Ngo->find('list',array('conditions'=>array('Ngo.id'=>$r['Ngo']['id'])));
//                         
//                      }
//             
//         }
//         else {
//             $citie=$this->City->find('count',array('conditions'=>$condition50));
//             $block=$this->Block->find('count',array('conditions'=>$condition51));
//             $panchayat=$this->Panchayat->find('count',array('conditions'=>$condition52));
//             $village=$this->Village->find('count',array('conditions'=>$condition53));
//             $house = $this->Geographical->find('all',array('fields' => array('sum(Geographical.no_of_house) AS totalhouse'),'conditions'=>array($condition54,'Geographical.status'=>'active')));
//             $population = $this->Geographical->find('all',array('fields' => array('sum(Geographical.population) AS totalpop'),'conditions'=>array($condition54,'Geographical.status'=>'active')));
//             $awc = $this->Geographical->find('count',array('conditions'=>array($condition54,'Geographical.awc_code !='=>'No','Geographical.status'=>'active')));
//             $vhsnd = $this->Bpccc->find('all',array('fields' => array('sum(Bpccc.vhsnd_no) AS totalvhsnd'),'conditions'=>array($condition55,'Bpccc.vhsnd_no !='=>'0','Bpccc.status'=>'active')));
//             $hsc = $this->FacilityDetail->find('count',array('conditions'=>array($condition57,'FacilityDetail.facility_type'=>'HSC','FacilityDetail.status'=>'active')));
//             $aphc = $this->FacilityDetail->find('count',array('conditions'=>array($condition57,'FacilityDetail.facility_type'=>'APHC','FacilityDetail.status'=>'active')));
//             $asha = $this->Bpccc->find('all',array('fields' => array('sum(Bpccc.asha_no) AS totalasha'),'conditions'=>array($condition55,'Bpccc.asha_no !='=>'0','Bpccc.status'=>'active')));
//             $ashafacilitator = $this->Bpccc->find('all',array('fields' => array('sum(Bpccc.asha_facilitators_no) AS totalashafac'),'conditions'=>array($condition55,'Bpccc.asha_facilitators_no !='=>'0','Bpccc.status'=>'active')));
//             $aww = $this->Bpccc->find('all',array('fields' => array('sum(Bpccc.aww_no) AS totalaww'),'conditions'=>array($condition55,'Bpccc.aww_no !='=>'0','Bpccc.status'=>'active')));
//             $anm = $this->Bpccc->find('all',array('fields' => array('sum(Bpccc.anm_no) AS totalanm'),'conditions'=>array($condition55,'Bpccc.anm_no !='=>'0','Bpccc.status'=>'active')));
//             $youthleader=$this->Youthleader->find('count',array('conditions'=>array($condition56,'Youthleader.status'=>'active'))); 
//             $facility=$this->FacilityDetail->find('count',array('conditions'=>array($condition57,'FacilityDetail.facility_type'=>'H&WC','FacilityDetail.status'=>'active')));
//               
//             $target = $this->Target->find('all',array('fields' => array('sum(Target.vhsnc_meeting_target) AS vtotal','sum(Target.feedback_target) AS ftotal','sum(Target.vhsnc_issue_target) AS vissuetotal','sum(Target.vhsnc_issueresolved_target) AS vrestotal','sum(Target.vhsnd_monitor_target) AS vdmontotal','sum(Target.vhsnc_monitor_target) AS vsmontotal','sum(Target.ivrs_feedback_target) AS mtotal','sum(Target.anm_meeting_target) AS anmtotal','sum(Target.dpmc_meeting_target) AS dpmctotal','sum(Target.bpmc_meeting_target) AS bpmctotal','sum(Target.rks_meeting_target) AS rkstotal','sum(Target.vhsnc_checklist_target) AS vschecktotal','sum(Target.vhsnd_checklist_target) AS vdchecktotal','sum(Target.facility_assessement_target) AS facilityassesstotal','sum(Target.iucd_services_target) AS iucdtotal','sum(Target.antara_services_target) AS antaratotal','sum(Target.vhsnc_expenditure_total_target) AS vexptotal','sum(Target.vhsnc_expenditure_allocation_target) AS vsalloexptotal','sum(Target.budget_utilized_target) AS budgettotal','sum(Target.anc_service_target) AS ancservicetotal','sum(Target.issue_pending_target) AS issueptotal'),'conditions'=>array('Target.status'=>'active')));
//                
//                    $aspermonthvhsnctarget = $target['0']['0']['vtotal'];
//                    $aspermonthfeedbacktraget = $target['0']['0']['ftotal'];
//                    $aspermonthissuetarget = $target['0']['0']['vissuetotal'];
//                    $aspermonthresolvedissuetarget = $target['0']['0']['vrestotal'];
//                    $aspermonthvhsndtarget = $target['0']['0']['vdmontotal'];
//                    $aspermonthvhsncmonitortarget = $target['0']['0']['vsmontotal'];
//                    $aspermonthivrstarget = $target['0']['0']['mtotal'];
//                    $aspermonthanmmeetingtarget = $target['0']['0']['anmtotal'];
//                    $aspermonthdpmctarget = $target['0']['0']['dpmctotal'];
//                    $aspermonthbpmctarget = $target['0']['0']['bpmctotal'];
//                    $aspermonthrkstarget = $target['0']['0']['rkstotal'];
//                    $aspermonthvhsncchecklisttarget = $target['0']['0']['vschecktotal'];
//                    $aspermonthvhsndchecklisttarget = $target['0']['0']['vdchecktotal'];
//                    $aspermonthassessementtarget = $target['0']['0']['facilityassesstotal'];
//                    $aspermonthicudservicetarget = $target['0']['0']['iucdtotal'];
//                    $aspermonthantaraservicetarget = $target['0']['0']['antaratotal'];
//                    $aspermonthexpendituretarget = $target['0']['0']['vexptotal'];
//                    $aspermonthalloexptarget = $target['0']['0']['vsalloexptotal'];
//                    $aspermonthanbudgetutilizedtarget = $target['0']['0']['budgettotal'];
//                    $aspermonthancservicetarget = $target['0']['0']['ancservicetotal'];
//                    $aspermonthissuependingtarget = $target['0']['0']['issueptotal'];
//     
//                    
//                    
//            ///total value///
//                    
//               $meeting = $this->VhsncMeeting->find('count',array('conditions'=>$condition1));
//               $VhsncUntiedfund = $this->VhsncUntiedfund->find('all',array('fields' => array('sum(VhsncUntiedfund.expenditure_amount) AS total'),'conditions'=>$condition2));
//               $VhsncUntiedfunddetails = $this->VhsncUntiedfundDetail->find('first',array('conditions'=>$condition9));
//               $VhsncUntiedfunddetail = $VhsncUntiedfunddetails['VhsncUntiedfundDetail']['opening_balance']+$VhsncUntiedfunddetails['VhsncUntiedfundDetail']['vhsnc_funds_recieved']+$VhsncUntiedfunddetails['VhsncUntiedfundDetail']['amount_recieved_from_other_source']+$VhsncUntiedfunddetails['VhsncUntiedfundDetail']['bank_interest_credit']-$VhsncUntiedfunddetails['VhsncUntiedfundDetail']['bank_charge_deduct'];
//               $vhsncfunrecieced = $VhsncUntiedfunddetails['VhsncUntiedfundDetail']['vhsnc_funds_recieved'];                       
//               $VhsncFeedback = $this->VhsncFeedback->find('count',array('group' => array('meeting_date','panchayat'),'conditions'=>$condition3));  
//               $Vhsncconstition = $this->VhsncConstitution->find('count',array('conditions'=>$condition10)); 
//               $issuecount = $this->VhsncMeeting->find('count',array('conditions'=>array($condition1,'VhsncMeeting.new_issue !='=>'0')));
//               $issueresolve = $this->VhsncMeeting->find('count',array('conditions'=>array($condition1,'VhsncMeeting.issue_resolved'=>'yes')));
//               $issuepending = $this->VhsncMeeting->find('count',array('conditions'=>array($condition1,'VhsncMeeting.issue_resolved'=>'no')));
//               $vhsndmonitored = $this->Vhsnd->find('count',array('group' => array('Vhsnd.visit_date','Vhsnd.awc_code'),'conditions'=>$condition));
//               $vhsndservice = $this->Vhsnd->find('count',array('group' => array('Vhsnd.visit_date','Vhsnd.awc_code'),'conditions'=>$condition,'Vhsnd.it_availability'=>'yes','Vhsnd.height_availability'=>'yes','Vhsnd.hb_availability'=>'yes','Vhsnd.abdomen_availability'=>'yes','Vhsnd.calcium_availability'=>'yes','Vhsnd.weight_availability'=>'yes','Vhsnd.bp_availability'=>'yes','Vhsnd.urine_availability'=>'yes','Vhsnd.ifa_availability'=>'yes'));
//               $ivrsfeedback = $this->Ivrs->find('count',array('conditions'=>$condition4,'Ivrs.voice_feedback_recorded'=>'yes'));	 	  	 
//               $ivrsuser = $this->Ivrs->find('count',array('conditions'=>$condition4));	 	  	 
//               $dpmcmeeting = $this->Dpmc->find('count',array('conditions'=>$condition5));	 	  	 
//               $bpmcmeeting = $this->Bpmc->find('count',array('conditions'=>$condition6));
//               $afcmeeting = $this->AfcHomeVisit->find('count',array('conditions'=>$condition7,'AfcHomeVisit.convinced'=>'5'));
//               $afcmeeting1 = $this->AfcHomeVisit->find('count',array('conditions'=>$condition7,'AfcHomeVisit.convinced'=>'3'));
//               $AnmMeeting = $this->AnmMeeting->find('count',array('conditions'=>$condition11));
//               $checklist = $this->Checklist->find('count',array('conditions'=>array($condition12,'Checklist.level'=>'vhsnc')));
//               $checklistvhsnd = $this->Checklist->find('count',array('conditions'=>array($condition12,'Checklist.level'=>'vhsnd')));
//               $checklistassessement = $this->FacilityAssessment->find('count',array('conditions'=>array($condition13)));
//               $facilityDetail = $this->FacilityDetail->find('count',array('conditions'=>array($condition14)));
//               $financialDetail = $this->FinancialDetail->find('all',array('fields' => array('sum(FinancialDetail.amount) AS ftotal'),'conditions'=>array($condition15)));
//               $finance = $this->Finance->find('all',array('fields' => array('sum(Finance.amount) AS etotal'),'conditions'=>array($condition16)));
//                
//                    ////
//                    
//                    
//             $cities=$this->City->find('list',array('order' => array('name' => 'asc')));
//             $blocks=$this->Block->find('list',array('order' => array('name' => 'asc')));
//             $panchayats=$this->Panchayat->find('list',array('order' => array('name' => 'asc')));
//             $villages=$this->Village->find('list',array('order' => array('name' => 'asc')));
//             $ngos=$this->Ngo->find('list',array('order' => array('name_of_ngo' => 'asc')));
//         }
             
             $this->set(compact('aspermonthissuependingtarget','aspermonthancservicetarget','aspermonthanbudgetutilizedtarget','aspermonthalloexptarget','aspermonthexpendituretarget','totalpanchyat','facility','youthleader','anm','aww','asha','ashafacilitator','aphc','hsc','vhsnd','awc','population','house','citie','block','panchayat','village','ngos','villages','cities','blocks','panchayats','meeting','VhsncUntiedfund','VhsncFeedback','issuecount','issueresolve','issuepending','vhsndmonitored','vhsndservice','ivrsfeedback','dpmcmeeting','bpmcmeeting','afcmeeting','afcmeeting1','permonthvhsnctarget','aspermonthvhsnctarget','VhsncUntiedfunddetails','VhsncUntiedfunddetail','vhsncfunrecieced','Vhsncconstition','aspermonthfeedbacktraget','aspermonthissuetarget','aspermonthresolvedissuetarget','aspermonthvhsndtarget','aspermonthvhsncmonitortarget','aspermonthivrstarget','aspermonthanmmeetingtarget','aspermonthdpmctarget','aspermonthbpmctarget','aspermonthrkstarget','aspermonthvhsncchecklisttarget','aspermonthvhsndchecklisttarget','aspermonthassessementtarget','ivrsuser','AnmMeeting','checklist','checklistvhsnd','checklistassessement','facilityDetail','financialDetail','finance','aspermonthicudservicetarget','aspermonthantaraservicetarget'));
        }
	
	function login() {
	 
	$stringmenu='';
	if ($this->request->is('post')) {
		
	    if(empty($this->request->data['User']['username'])){
		$this->Session->setFlash('user name should not be left blank');
		}
		else if(empty($this->request->data['User']['password'])){
		$this->Session->setFlash('password should not be left blank');	
		}
		//else if(empty($this->request->data['User']['otp']))
		//{
		//$this->Session->setFlash('otp should not be left blank');
		//}
		
	else
	{
	$username=$this->request->data['User']['username'];
    $password=md5($this->request->data['User']['password']);
	//$otp=$this->request->data['User']['otp'];
	$countuser = $this->User->find('count', array('conditions' => array('User.username'=>$username,'User.password_enc'=>$password,'status'=>'active')));
	if($countuser===0)
	{
		$this->Session->setFlash('invalid user');
		$this->redirect(array('controller'=>'users','action'=>'loginnew'));
		}
	// else if($this->checkOtp($username,$password,$otp)==false){ 
	   ////$this->Session->setFlash('invalid otp.Please generate new otp');
		//$this->redirect(array('controller'=>'users','action'=>'login'));	
		//}
	 else if($this->checkIp($username)==false){ 
	   $this->Session->setFlash('invalid ip address');
		$this->redirect(array('controller'=>'users','action'=>'loginnew'));	
	 }
		
		else
		{
			//echo "hello";
			//die();
	$dbuser = $this->User->findByUsername($username);
	$maincontroller='';
	$data='';
	$menusassion='';
	$cont='';$act='';
	$mainaction='';
	$this->Session->setFlash('WELCOME TO ADMIN PANEL');
	
	            if($dbuser['User']['role']!='admin'){
				
				
				$list1=unserialize($dbuser['User']['menuheader']); $list2=unserialize($dbuser['User']['menu']);
				
				
				
				
				foreach($list1 as $key=>$val){list($orig,$controller1)=@explode(":",$val); $orighead[]=$orig;}
				foreach($list2 as $key=>$val2){ $origmenu[]=$val2;}
				foreach($list2 as $key=>$val3){list($ct1,$ac1)=@explode(":",$val3); $origcont[]=$ct1; $origact[]=$ac1;}
				
				
				$origcont=array_unique($origcont);
				$headunique=array_unique($orighead); 
				$origmenu=array_unique($origmenu);
				$origact=array_unique($origact);
				
				
				
				
				
				if(!empty($headunique)) {
					
				$menusassion='<ul class="sidebar-menu">';	
				foreach ($headunique as $key=>$value1) { $headerid=$value1; 
				$name=$this->menusheader($headerid);
				$submenu=$this->menusonaction($headerid); 
				
				if(!empty($submenu)){
				if(@$name[0]['head']['action']==''){$link1='<a href="#">';} else{$link1='<a href="#">'; }
				$menusassion.='<li class="treeview">'.$link1.'<span>'.@$name[0]['head']['name'].'</span><i class="fa fa-angle-left pull-right"></i></a><ul class="treeview-menu">'; 
				foreach ($submenu as $key2=>$value2) { list($controller,$action)=@explode(":",$value2);
				if(in_array($value2['menus']['controller'],$origcont) and in_array($value2['menus']['action'],$origact)){
				$menusassion.='<li><a href="'.SITE_PATH.$value2['menus']['controller'].'/'.trim($value2['menus']['action']).'"><i class="fa fa-angle-double-right"></i>'.$value2['menus']['name'].'</a></li>';
				}
				} 
				$menusassion.='</ul>'; 
				}
				
				else {
				if($name[0]['head']['action']==''){$link='';} else{$link='<a href="'.SITE_PATH.trim($name[0]['head']['action']).'">'.$name[0]['head']['name'].'</a>'; }
				
				 $menusassion.='<li>'.$link.'</li>';}
				} $menusassion.='</li>'; $menusassion.='</ul>';
				
				} 
				
				
				  
				$submenues=unserialize($dbuser['User']['menu']);
				foreach ($submenues as $k=>$v) {  $cont.=','.$v;}
				$maincontroller=@explode(',',$cont);
				
				
	}
	
	            else {
					$menusassion='<ul class="sidebar-menu">';
					
					$adminmenu=$this->menuHeaders(); 
					foreach($adminmenu as $key=>$value) {
					
					$menu=$this->menus($adminmenu[$key]["mh"]["id"]); if(!empty($menu))  { 
					
					
					$menusassion.='<li class="treeview"><a href="#"><i class="fa fa-check-circle-o"></i><span>'.$adminmenu[$key]["mh"]["name"].'</span><i class="fa fa-angle-left pull-right"></i></a><ul class="treeview-menu">';
					
					foreach($menu as $key=>$value) { 
					
					$menusassion.='<li><a href="'.SITE_PATH.$menu[$key]["m"]["controller"].'/'.$menu[$key]["m"]["action"].'"><i class="fa fa-angle-double-right"></i>'.$menu[$key]["m"]["name"].'</a></li>';
					}
					$menusassion.='</ul>'; 
					
					
					}
					else {	
					$menusassion.='<li><a href="'.SITE_PATH.$adminmenu[$key]["mh"]["action"].'/'.'index'.'"><i class="fa fa-check-circle-o"></i><span>'.$adminmenu[$key]["mh"]["name"].'</span></a>';
						}
					$menusassion.='</li>'; 	
					}
					
					$menusassion.='</ul>'; 	
					
					}

                    $logintime=date('Y/m/d h:i:s');
					$dataarray=date_parse($logintime);
					$loginsession=base64_encode($dataarray['year']."|".$dataarray['month']."|".$dataarray['day']."|".$dataarray['hour']."|".$dataarray['minute']."|".$dataarray['second']."|".$dbuser['User']['id']);
					
					
	 $this->Session->write('User',array('id'=>$dbuser['User']['id'],'name'=>$dbuser['User']['full_name'],'parent'=>$dbuser['User']['parent'],'last_name'=>$dbuser['User']['last_name'],'middle_name'=>$dbuser['User']['middle_name'],'username'=>$dbuser['User']['username'],'gender'=>$dbuser['User']['gender'],'type'=>$dbuser['User']['role'],'subtype'=>$dbuser['User']['type'],'subrole'=>$dbuser['User']['subrole'],'status'=>$dbuser['User']['status'],'menuheader'=>$dbuser['User']['menuheader'],'menu'=>$dbuser['User']['menu'],'mainmenu'=>$maincontroller,'menus'=>$menusassion,"loginsession"=>$loginsession));
	
	$this->User->query("update users set login_ip='".$_SERVER['REMOTE_ADDR']."',last_login='".date("Y-m-d H:i:s")."'where id=".$dbuser['User']['id']);
	$this->User->query("insert into login_history set ip_address='".$_SERVER['REMOTE_ADDR']."',in_time='".date("Y-m-d H:i:s")."',user_id=".CakeSession::read('User.id').",session_id='".$loginsession."'");
	
    
	$this->redirect(array('controller'=>'users','action'=>'welcome'));
	
	
		
			
			}
		
		}
	}
	
	$this->layout='login';
}

public function menuHeaders() { 
		$result=$this->Menuheader->query("select mh.name,mh.action,mh.id from menuheaders as mh where mh.status='active' order by mh.navid desc");
		return $result;
	}
	
	public function menus($pid) { 
	
		$result=$this->Menu->query("select m.name,m.action,m.controller from menus as m where m.status='active' and m.menuheader_id='$pid' order by m.navid asc");
		return $result;
	}
public function getalltarget() { 
	
           $this->layout='ajax';
           $this->autoRender = false;
           $c=$this->params->query['c'];
           $target = $this->Target->find('first',array('conditions'=>array('Target.organization'=>$c)));
          if($target) echo json_encode($target['Target']);
	}


        public function getalldata (){
           $this->layout='ajax';
           $this->autoRender = false;
           $c=$this->params->query['c'];
           $r = $this->Ngo->find('first',array('conditions'=>array('Ngo.id'=>$c)));
                 if($r){
                     
                     $blo=array();
                     $blo= [$r['Ngo']['allocated_block_one'],$r['Ngo']['allocated_block_two']];
                     $condition50['City.id']=$r['Ngo']['allocated_district'];
                     $condition51=['Block.id IN' =>$blo]; 
                     $condition52=['Panchayat.block_id IN' =>$blo];
                     $condition53=['Village.block_id IN' =>$blo];
                     $condition54=['Geographical.block IN' =>$blo];
                     $condition55=['Bpccc.allocated_block IN' =>$blo];
                     $condition56=['Youthleader.allocated_block IN' =>$blo];
                     $condition57=['FacilityDetail.block IN' =>$blo];
                      
                 } 
             $citie=$this->City->find('count',array('conditions'=>$condition50));
             $block=$this->Block->find('count',array('conditions'=>$condition51));
             $panchayat=$this->Panchayat->find('count',array('conditions'=>$condition52));
             $village=$this->Village->find('count',array('conditions'=>$condition53));
             $house = $this->Geographical->find('all',array('fields' => array('sum(Geographical.no_of_house) AS totalhouse'),'conditions'=>array($condition54,'Geographical.status'=>'active')));
             $population = $this->Geographical->find('all',array('fields' => array('sum(Geographical.population) AS totalpop'),'conditions'=>array($condition54,'Geographical.status'=>'active')));
             $awc = $this->Bpccc->find('all',array('fields' => array('sum(Bpccc.awc_no) AS totalawc'),'conditions'=>array($condition55,'Bpccc.awc_no !='=>'0','Bpccc.status'=>'active')));
             $vhsnd = $this->Bpccc->find('all',array('fields' => array('sum(Bpccc.vhsnd_no) AS totalvhsnd'),'conditions'=>array($condition55,'Bpccc.vhsnd_no !='=>'0','Bpccc.status'=>'active')));
             $hsc = $this->Bpccc->find('all',array('fields' => array('sum(Bpccc.hsc_no) AS totalhsc'),'conditions'=>array($condition55,'Bpccc.hsc_no !='=>'0','Bpccc.status'=>'active')));
             $aphc = $this->Bpccc->find('all',array('fields' => array('sum(Bpccc.aphc_no) AS totalaphc'),'conditions'=>array($condition55,'Bpccc.aphc_no !='=>'0','Bpccc.status'=>'active')));
             $asha = $this->Bpccc->find('all',array('fields' => array('sum(Bpccc.asha_no) AS totalasha'),'conditions'=>array($condition55,'Bpccc.asha_no !='=>'0','Bpccc.status'=>'active')));
             $ashafacilitator = $this->Bpccc->find('all',array('fields' => array('sum(Bpccc.asha_facilitators_no) AS totalashafac'),'conditions'=>array($condition55,'Bpccc.asha_facilitators_no !='=>'0','Bpccc.status'=>'active')));
             $aww = $this->Bpccc->find('all',array('fields' => array('sum(Bpccc.aww_no) AS totalaww'),'conditions'=>array($condition55,'Bpccc.aww_no !='=>'0','Bpccc.status'=>'active')));
             $anm = $this->Bpccc->find('all',array('fields' => array('sum(Bpccc.anm_no) AS totalanm'),'conditions'=>array($condition55,'Bpccc.anm_no !='=>'0','Bpccc.status'=>'active')));
             $youthleader=$this->Youthleader->find('count',array('conditions'=>array($condition56,'Youthleader.status'=>'active'))); 
             $facility=$this->FacilityDetail->find('count',array('conditions'=>array($condition57,'FacilityDetail.facility_type'=>'H&WC','FacilityDetail.status'=>'active')));
             
             $rows = array('city'=>$citie,'block'=>$block,'panchayat'=>$panchayat,'village'=>$village,'house'=>$house[0][0]['totalhouse'],'population'=>$population[0][0]['totalpop'],'awc'=>$awc[0][0]['totalawc'],'vhsnd'=>$vhsnd[0][0]['totalvhsnd'],'hsc'=>$hsc[0][0]['totalhsc'],'aphc'=>$aphc[0][0]['totalaphc'],'asha'=>$asha[0][0]['totalasha'],'ashafacilitator'=>$ashafacilitator[0][0]['totalashafac'],'aww'=>$aww[0][0]['totalaww'],'anm'=>$anm[0][0]['totalanm'],'youthleader'=>$youthleader,'facility'=>$facility); 
             echo json_encode($rows);
             
        }

private function checkOtp($username,$password,$otp)
{
$data = $this->User->find('first',array('fields'=>array('User.otp','User.otptime','User.id'),'conditions' => array('User.username'=>$username,'User.password_enc'=>$password,'User.otp'=>$otp,'status'=>'active')));
if(!empty($data['User']['id'])){ 
$date1 = $data['User']['otptime'];
$date2 = date("Y-m-d H:i:s");
$timestamp1 = strtotime($date1);
$timestamp2 = strtotime($date2);
$diff = $timestamp2 - $timestamp1;
$hour=round($diff/3600);
if($hour > 3) { return false;}
else{ return true;}
}
else{ return false; }

}

function checkIp($aname)
{
$typeuser=$this->UserAccess->find("first",array("fields"=>"name",'conditions'=>array('UserAccess.type'=>'user','UserAccess.name'=>$aname)));
$array=array();
if(!empty($typeuser['UserAccess']['name'])) {
	return true;
}
else{
$typeuser=$this->UserAccess->find("all",array("fields"=>"name",'conditions'=>array('UserAccess.type'=>'ip')));
if(!empty($typeuser)){
foreach($typeuser as $key=>$value) {$array[]=$value['UserAccess']['name'];}
if(@in_array($_SERVER['REMOTE_ADDR'],$array)) { return true; }
else {return false; }
}
else {return false; }
}
}


function logout($msg=null) {
	// delete the user session
    $this->User->query("update users set last_login='".date("Y-m-d H:i:s")."' where id=".CakeSession::read('User.id'));
	if ($this->Session->check('User')){$this->User->query("update login_history set out_time='".date("Y-m-d H:i:s")."' where session_id='".CakeSession::read('User.loginsession')."'");}
	//$this->User->read(null, CakeSession::read('User.id'));
	//$this->User->set('last_login', date("Y-m-d H:i:s"));
	//$this->User->save();

	$this->Session->delete('User');
	// redirect to posts index page
	if($msg){
		
		$this->Session->setFlash($msg);
		}
		else{
			
			$this->Session->setFlash('You have successfully logged out.');
			}
	
	$this->redirect(array('controller'=>'users','action'=>'loginnew'));
}

function checkSession($msg=null) {
if($msg) {
$this->Session->setFlash(__($msg, true));
$this->redirect(array('controller'=>'users','action'=>'loginnew'));
}
else {
$this->Session->setFlash(__("Invalid user .Please Login first", true));
$this->redirect(array('controller'=>'users','action'=>'loginnew'));
}
}

function validateSession() {   

            $sessionval=$this->Session->read('User');
			$data=$this->User->findAllByIdAndStatus($sessionval['id'],$sessionval['status']);
			if(!empty($data)){
				
				return true;
				}
				else {
					
					return false;
				}
		
	}

function checkRestriction() {
$this->Session->setFlash(__("You are ristricted to use this page", true));
$this->redirect(array('controller'=>'users','action'=>'welcome'));
}

 function menusonheader($id) {
		$result=$this->Menu->query("select name,action,id,controller from menus  where  controller='$id'  order by id");
		return $result;
	}
	
	function menusonaction($action) {
	   
		$result=$this->Menu->query("select name,action,id,controller from menus  where  menuheader_id='$action' and status='active'  and action!='welcome' order by navid asc");
		return $result;
	}
	
	function menusheader($id) {
	
		$result=$this->Menuheader->query("select name,action from menuheaders as head  where id='$id' and status='active' order by navid asc");
		return $result;
	}
	
	function getParent($id=null)
	{
		if($id){
			
			$name=$this->User->find("first",array('fields'=>array('User.name','User.last_name'),'conditions'=>array("User.id"=>$id)));
			if(!empty($name)) {return '( '.trim($name['User']['name'].' '.$name['User']['last_name']).' )';}
			else { return '';}
		}
		return '';
	}
	
	function getAllParent()
	{
		
			
			$name=$this->User->find("list",array('fields'=>array('User.id','User.full_name'),'conditions'=>array('User.level > '=>0,'User.status !='=>'deactive')));  
			return $name;
		
	}
	
	function getAll()
	{
		
			
			$name=$this->User->find("list",array('fields'=>array('User.id','User.username'),'conditions'=>array("User.status !="=>'deactive')));  
			return $name;
		
	}
	
	
	function getUser($id=null)
	{
		if($id){
			
			$name=$this->User->find("first",array('fields'=>array('User.username'),'conditions'=>array("User.id"=>$id)));
			if(!empty($name['User']['username'])){return $name['User']['username'];}
		}
	}



	function getUserdetails($id=null)
	{
		  $this->layout='ajax';
        $this->autoRender = false;
		if($id){
			
			$name=$this->User->find("first",array('fields'=>array('User.gender'),'conditions'=>array("User.id"=>$id)));
			if(!empty($name['User']['gender'])){return $name['User']['gender'];}
		}
	}
	function getUserMobile($id=null)
	{
		  $this->layout='ajax';
        $this->autoRender = false;
		if($id){
			
			$name=$this->User->find("first",array('fields'=>array('User.phone'),'conditions'=>array("User.id"=>$id)));
			if(!empty($name['User']['phone'])){return $name['User']['phone'];}
		}
	}
	function getUserEmail($id=null)
	{
		  $this->layout='ajax';
        $this->autoRender = false;
		if($id){
			
			$name=$this->User->find("first",array('fields'=>array('User.email'),'conditions'=>array("User.id"=>$id)));
			if(!empty($name['User']['email'])){return $name['User']['email'];}
		}
	}
	
	function getUserAll($id=null)
	{
		if($id){

			$name=$this->User->query("select name,last_name,username,parent  from users where id=".$id);
			if(!empty($name)){return $name;}  else { return '';}
		}
		 else { return '';}
	}
	
	function getParent2($id=null)
	{
		if($id){
			
			$name=$this->User->query("select name,last_name,username  from users where id=".$id);
			if(!empty($name)) {
			return '( '.trim($name[0]['users']['name'].' '.$name[0]['users']['last_name']).' )';
			}
			else { return '';}
		}
		 else { return '';}
	}
	
	
	public function buildRegularTree($parentId = null,$selected=null) {
    $sel=$selected;
	$display='';
    $seprator='';
	$level='';
	$select='';
	$allusers= $this->User->query("select id,name,role,level,parent from users where parent=".$parentId." and status='active'  ORDER BY parent DESC");
	foreach ($allusers as $value) {      
		                                if($parentId!=0){
										$seprator='&nbsp;&nbsp;';
		                                $level=$value['users']['level'];
                                        for($i=0;$i<$level;$i++){
                                        $seprator.="--";
                                        }
										}
		
	if($sel==$value['users']['id']){ $select='selected="selected"';} else{$select='';}
	// ( '.$value['users']['role'].' )
	$display.='<option value="'.$value['users']['id'].'" '.$select.'>'.$seprator.' '.$value['users']['name'].'</option>';
		 
if ($this->hasChild($value['users']['id'])) {
				   $display .= $this->buildTree($value['users']['id'],$sel);
			}

			
		}
		
		 
		
	return $display;
	}
	
	public function buildTree($parentId,$selected,$users=0) {
	$sel=$selected;
    $display='';
    $seprator='';
	$level='';
	$select='';
	$role='';
	$alldata=@explode('##',$users);


	$allusers= $this->User->query("select id,name,last_name,username,role,level,parent from users where parent=".$parentId." and status !='deactive'  ORDER BY id DESC,level asc");	

	foreach ($allusers as $value) {      
		                                if($parentId!=0){
										$seprator='&nbsp;&nbsp;';
		                                $level=$value['users']['level'];
                                        for($i=0;$i<$level;$i++){
                                        $seprator.="--";
                                        }
										}
								/*$role=$value['users']['role'];*/
	if($sel==$value['users']['id']){ $select='selected="selected"';} else{$select='';}
	if($role==='regular'){ /*$role= $this->getParent($value['users']['parent']);*/} else{/*$role= ' ( '.$value['users']['role'].')';*/}
	$display.='<option value="'.$value['users']['id'].'" '.$select.'>'.$seprator.' '.$value['users']['name'].' '.$value['users']['last_name'].' '.$role.'</option>';
		 
if ($value['users']['level']>0) { 
if($this->hasChild($alldata,$value['users']['id'])) {
				   $display .= $this->buildTree($value['users']['id'],$sel,$users);
			}
}

			
		}
		
		 
		
	return $display;
	}
	
	
	
	
	public function hasChild($alldata,$param) {
		$response=false;
		if(!empty($alldata)) {
			foreach($alldata as $key=>$data){
			if($data==$param)
			{
				$response=true;
				break;
				}
			}
		}
		
		/*if($param!=0) {
		$countall=$this->User->find('count',array('condition'=>array('User.parent' => $param)));
		
		// $log = $this->User->getDataSource()->getLog(false, false);
        //debug($log); exit;
		
	    if($countall){ return true ;} else { return false;}
		}*/
		return $response;
		
	}
	
	public function getUserLevel($parent=null) {
		
		if($parent) {
		$countall=$this->User->find("first",array('fields'=>array('User.level'),'conditions'=>array("User.id"=>$parent)));
		return $countall['User']['level']+=1;
		}
		return 1;
		
	}
	
	public function checkUser($id) {
		
		if(CakeSession::read('User.type')==="regular") {
		$thisdata=$this->User->find("first",array('fields'=>'parent','conditions'=>array('User.id' => $id)));
		if(CakeSession::read('User.id')==$id)
		{  return true; }
		else if(CakeSession::read('User.id')===$thisdata['User']['parent'])
		{   return true; }	
		else
		{
			return false;
			}
		}
		else
		{
			return true;
			}
		
		
	}
	
	public function getUserOnParent() {
		if ($this->request->is('ajax')) {
		
		$data='';$searchUserId=null;$pages=null;$condition='';$querySrting=''; $condition=array();
		$conc='';
		
		if(isset($this->request->query['search_user']) and isset($this->request->query['search_user'])!='' and isset($this->request->query['search_user'])!=0){$searchUserId=trim($this->request->query['search_user']); if($searchUserId){ $condition['User.parent']=$searchUserId;}}
		else { 
		$condition['Enquiry.user_id']=0;
		}
		$pages=trim($this->request->query['startpage']);
		if($pages)
		{
		$pg = $pages;
		$page = $pages; 
		}
		else
		{
		$pg = 1;
		$page = 1;
		}
		$cur_page = $page;
		$page -= 1;
		$per_page = 20;
		$start = $page * $per_page;
		
		 
		 $this->Paginator->settings = array('User' => array('limit' =>20,'order' => array('id' => 'desc'),'conditions'=>$condition));
		
		$this->User->recursive = 0;
	    $data=$this->Paginator->paginate();
	    //$log = $this->Enquiry->getDataSource()->getLog(false, false);
        //debug($log);
		
		$count=$this->User->find('count',array('conditions'=>$condition)); 
		
		$this->set('users', $this->Paginator->paginate());
		$this->set('currentpage',$cur_page);
	    $this->set('total',$count);
		
		}
		else
		{
			echo "<h3>404<br/>Invalid request.</h3>";
		}
		$this->layout='ajax';
        //$this->autoRender = false;
	}
	
	public function export() {
		   $this->response->download("export.csv");
            // Stop Cake from displaying action's execution time 
            Configure::write('debug',0); 
            // Find fields needed without recursing through associated models 
            $data = $this->User->find('all', array( 'fields' => array('id','username','name','last_name','email'), 'order' => "User.id ASC")); 
            // Define column headers for CSV file, in same array format as the data itself 
            $headers = array( 
                'User'=>array( 
                    'Id' => 'Id', 
                    'User Name' => 'User Name', 
                    'Name' => 'Name', 
                    'Last Name' => 'Last Name', 
                    'Email' => 'Email' 
                ) 
            ); 
            // Add headers to start of data array 
            array_unshift($data,$headers); 
            // Make the data available to the view (and the resulting CSV file) 
            $this->set(compact('data')); 
			$this->layout = 'ajax';
		return;
 		/*$this->response->download("export.csv");
 		$data = $this->User->find('all');
		$this->set(compact('data'));
 		
 		return;*/
		
 	}
	
	public function generateOtp() {
		if ($this->request->is('post')) {
	if (isset($this->request->data['User']['username']) && ($this->request->data['User']['username']!="" || $this->request->data['User']['username']!=0))
	{
	$username=$this->request->data['User']['username'];
	$userall = $this->User->find('first', array('conditions' => array('User.username'=>$username,'status'=>'active')));

	if(!empty($userall) and $userall['User']['id'])
	{ $time=date('Y-m-d H:i:s');
	  $length = 8;
	  $chars = 'tywefgnggnmiiitfgrdefvdrtrfgmn84735346jhhdfhn6n7fknmhr56gdrf344djghd45fgdgf05fretnxcssazxfxxx3450897807nhgrtlllsurtefg455678fd4s5xcdvfgb';
	  $pass= substr( str_shuffle( $chars ), 0, $length );
	  
	  $this->ManageOtp->create();
	  $this->ManageOtp->set(array('name'=>$userall['User']['username'],'ip'=>$_SERVER['REMOTE_ADDR'],'otp'=>$pass,'otptime'=>$time));
      if($this->ManageOtp->save()) {
      $update=$this->User->query('update users set otp="'.$pass.'",otptime="'.$time.'" where id='.$userall['User']['id']);
	  
    if($userall['User']['email']!=''){

    //$phonenum = $userall['User']['phone']; 
    $message = $userall['User']['name']." ".$userall['User']['last_name'] .' your lrggroups Crm OTP is : '.$pass;
    $debug = true;
    //if($phonenum!=''){$this->Sms->smsSend($phonenum,$message,$debug);}

	$mail=mail($userall['User']['email'],'NEW PASSWORD',"YOUR PASSWORD  :  ".$pass);
	
	$this->Session->setFlash('YOUR PASSWORD HAS BEEN SENT TO YOUR EMAIL ID'); 
	$this->redirect(array('controller'=>'users','action'=>'generateOtp'));
	
	}
}
		
		}
		else
		{
		$this->Session->setFlash('invalid user');
		$this->redirect(array('controller'=>'users','action'=>'generateOtp'));
			}
	}
	else
	{
		$this->Session->setFlash('user name should not be left blank');
		$this->redirect(array('controller'=>'users','action'=>'generateOtp'));
		}
			
			}
		$this->layout = 'login';
	}
	
	
	public function getCommaSeprated($parent=null) {
		$this->autoRender = false;
		if($parent) {
			$data='';
		$data=$this->User->find("all",array('fields'=>array('User.id'),'conditions'=>array("User.parent"=>$parent)));
		return $data;
		}
		
	
		
	}



   public function test($selected=0)
		  {   
		  
		  $parentId=0;
		  $condition=array('status !='=>'deactive');
		  if(CakeSession::read('User.type')==='regular'){ $parentId=CakeSession::read('User.id'); $condition['OR']=array('parent'=>CakeSession::read('User.id'),'id'=>CakeSession::read('User.id')); }
		  
		  $users = $this->User->find('all',array('fields'=>array('id','username','parent','children','level'),'conditions'=>$condition,'order'=>array('parent'=>'asc','username'=>'asc')));
		  $tree = $this->buildTree2($users,$parentId,$selected);
		  //print_r($users);
		  return $tree;
		  
		  }
		  
		  
		  function buildTree2(array $elements, $parentId = 0,$selected) {
		  $branch = array();
		  $data='';
		  $seprator='';
		  $children='';
		  
		  foreach ($elements as $element) {
		  
		  if($selected==$element['User']['id']){  $select='selected="selected"';} else{$select='';}
		  
		  if ($element['User']['parent'] == $parentId) { 
		  
		  $children =$this->buildTree2($elements, $element['User']['id'],$selected);
		  
		  if($parentId!=0){
		  $seprator='&nbsp;&nbsp;';
		  $level=$element['User']['level'];
		  for($i=0;$i<$level;$i++){
		  $seprator.="--";
		  }
		  }
		  $data.='<option value="'.$element['User']['id'].'" '.$select.'>'.$seprator.$element['User']['username'].'</option>';
		  
		  if ($children!='') { 
		  
		  $data.=$children;
		  $element['User']['children'] = $children;
		  }
		  
		  $branch[] = $element;	
		  }
		  
		  }
		  
		  return $data;
		  
		  }


        public function getColorCode($id=null) {

		if($id) {
			$data='';
		$data=$this->User->query("select colorcode,username from users where id=".$id);
		return $data;
		}
		
	
		
	}
	
	function loginnew() {
	 
	$stringmenu='';
	if ($this->request->is('post')) {
		
	    if(empty($this->request->data['User']['username'])){
		$this->Session->setFlash('user name should not be left blank');
		}
		else if(empty($this->request->data['User']['password'])){
		$this->Session->setFlash('password should not be left blank');	
		}
		//else if(empty($this->request->data['User']['otp']))
		//{
		//$this->Session->setFlash('otp should not be left blank');
		//}
		
	else
	{
	$username=$this->request->data['User']['username'];
    $password=md5($this->request->data['User']['password']);
	//$otp=$this->request->data['User']['otp'];
	$countuser = $this->User->find('count', array('conditions' => array('User.username'=>$username,'User.password_enc'=>$password,'status'=>'active')));
	if($countuser===0)
	{
		$this->Session->setFlash('invalid user');
		$this->redirect(array('controller'=>'users','action'=>'loginnew'));
		}
	// else if($this->checkOtp($username,$password,$otp)==false){ 
	   ////$this->Session->setFlash('invalid otp.Please generate new otp');
		//$this->redirect(array('controller'=>'users','action'=>'login'));	
		//}
	 else if($this->checkIp($username)==false){ 
	   $this->Session->setFlash('invalid ip address');
		$this->redirect(array('controller'=>'users','action'=>'loginnew'));	
	 }
		
		else
		{
			//echo "hello";
			//die();
	$dbuser = $this->User->findByUsername($username);
	$maincontroller='';
	$data='';
	$menusassion='';
	$cont='';$act='';
	$mainaction='';
	$this->Session->setFlash('WELCOME TO ADMIN PANEL');
	
	            if($dbuser['User']['role']!='admin'){
				
				
				$list1=unserialize($dbuser['User']['menuheader']); $list2=unserialize($dbuser['User']['menu']);
				
				
				
				
				foreach($list1 as $key=>$val){list($orig,$controller1)=@explode(":",$val); $orighead[]=$orig;}
				foreach($list2 as $key=>$val2){ $origmenu[]=$val2;}
				foreach($list2 as $key=>$val3){list($ct1,$ac1)=@explode(":",$val3); $origcont[]=$ct1; $origact[]=$ac1;}
				
				
				$origcont=array_unique($origcont);
				$headunique=array_unique($orighead); 
				$origmenu=array_unique($origmenu);
				$origact=array_unique($origact);
				
				
				
				
				
				if(!empty($headunique)) {
					
				$menusassion='<ul class="sidebar-menu nav">';	
				foreach ($headunique as $key=>$value1) { $headerid=$value1; 
				$name=$this->menusheader($headerid);
				$submenu=$this->menusonaction($headerid); 
				
				if(!empty($submenu)){
				if(@$name[0]['head']['action']==''){$link1='<a href="#">';} else{$link1='<a href="#">'; }
				$menusassion.='<li class="treeview">'.$link1.'<span>'.@$name[0]['head']['name'].'</span><i class="fa fa-angle-left pull-right"></i></a><ul class="treeview-menu">'; 
				foreach ($submenu as $key2=>$value2) { list($controller,$action)=@explode(":",$value2);
				if(in_array($value2['menus']['controller'],$origcont) and in_array($value2['menus']['action'],$origact)){
				$menusassion.='<li class="active"><a href="'.SITE_PATH.$value2['menus']['controller'].'/'.trim($value2['menus']['action']).'"><i class="fa fa-angle-double-right"></i>'.$value2['menus']['name'].'</a></li>';
				}
				} 
				$menusassion.='</ul>'; 
				}
				
				else {
				if($name[0]['head']['action']==''){$link='';} else{$link='<a href="'.SITE_PATH.trim($name[0]['head']['action']).'">'.$name[0]['head']['name'].'</a>'; }
				
				 $menusassion.='<li class="active">'.$link.'</li>';}
				} $menusassion.='</li>'; $menusassion.='</ul>';
				
				} 
				
				
				  
				$submenues=unserialize($dbuser['User']['menu']);
				foreach ($submenues as $k=>$v) {  $cont.=','.$v;}
				$maincontroller=@explode(',',$cont);
				
				
	}
	
	            else {
					$menusassion='<ul class="sidebar-menu">';
					
					$adminmenu=$this->menuHeaders(); 
					foreach($adminmenu as $key=>$value) {
					
					$menu=$this->menus($adminmenu[$key]["mh"]["id"]); if(!empty($menu))  { 
					
					
					$menusassion.='<li class="treeview"><a href="#"><i class="fa fa-check-circle-o"></i><span>'.$adminmenu[$key]["mh"]["name"].'</span><i class="fa fa-angle-left pull-right"></i></a><ul class="treeview-menu">';
					
					foreach($menu as $key=>$value) { 
                                           
                                         // $url = explode('/',$this->params->url);
                                          //if($url[0]=$menu[$key]["m"]["controller"])
                                        
					$menusassion.='<li><a href="'.SITE_PATH.$menu[$key]["m"]["controller"].'/'.$menu[$key]["m"]["action"].'"><i class="fa fa-angle-double-right"></i>'.$menu[$key]["m"]["name"].'</a></li>';
					}
					$menusassion.='</ul>'; 
					
					
					}
					else {	
					$menusassion.='<li><a href="'.SITE_PATH.$adminmenu[$key]["mh"]["action"].'/'.'index'.'"><i class="fa fa-check-circle-o"></i><span>'.$adminmenu[$key]["mh"]["name"].'</span></a>';
						}
					$menusassion.='</li>'; 	
					}
					
					$menusassion.='</ul>'; 	
					
					}

                    $logintime=date('Y/m/d h:i:s');
					$dataarray=date_parse($logintime);
					$loginsession=base64_encode($dataarray['year']."|".$dataarray['month']."|".$dataarray['day']."|".$dataarray['hour']."|".$dataarray['minute']."|".$dataarray['second']."|".$dbuser['User']['id']);
					
					
	 $this->Session->write('User',array('id'=>$dbuser['User']['id'],'name'=>$dbuser['User']['full_name'],'parent'=>$dbuser['User']['parent'],'last_name'=>$dbuser['User']['last_name'],'middle_name'=>$dbuser['User']['middle_name'],'username'=>$dbuser['User']['username'],'gender'=>$dbuser['User']['gender'],'type'=>$dbuser['User']['role'],'subtype'=>$dbuser['User']['type'],'subrole'=>$dbuser['User']['subrole'],'status'=>$dbuser['User']['status'],'menuheader'=>$dbuser['User']['menuheader'],'menu'=>$dbuser['User']['menu'],'mainmenu'=>$maincontroller,'menus'=>$menusassion,"loginsession"=>$loginsession));
	
	$this->User->query("update users set login_ip='".$_SERVER['REMOTE_ADDR']."',last_login='".date("Y-m-d H:i:s")."'where id=".$dbuser['User']['id']);
	$this->User->query("insert into login_history set ip_address='".$_SERVER['REMOTE_ADDR']."',in_time='".date("Y-m-d H:i:s")."',user_id=".CakeSession::read('User.id').",session_id='".$loginsession."'");
	
    
	$this->redirect(array('controller'=>'users','action'=>'welcome'));
	
	
		
			
			}
		
		}
	}
	
	$this->layout='login_new';
}

public function forgetPassword() {
		if ($this->request->is('post')) {
	if (isset($this->request->data['User']['email']) && ($this->request->data['User']['email']!="" || $this->request->data['User']['email']!=0))
	{
	$username=$this->request->data['User']['email'];
	$userall = $this->User->find('first', array('conditions' => array('User.email'=>$username,'status'=>'active')));

	
    if($userall['User']['email']!=''){

    //$phonenum = $userall['User']['phone']; 
    
    $debug = true;
    //if($phonenum!=''){$this->Sms->smsSend($phonenum,$message,$debug);}

	$mail=mail($userall['User']['email'],'PASSWORD',"YOUR PASSWORD  :  ".$userall['User']['password']);
	
	$this->Session->setFlash('YOUR PASSWORD HAS BEEN SENT TO YOUR EMAIL ID'); 
	$this->redirect(array('controller'=>'users','action'=>'forgetPassword'));

		
		}
		else
		{
		$this->Session->setFlash('invalid Email');
		$this->redirect(array('controller'=>'users','action'=>'forgetPassword'));
			}
	}
	else
	{
		$this->Session->setFlash('Email Id should not be left blank');
		$this->redirect(array('controller'=>'users','action'=>'forgetPassword'));
		}
			
			}
		$this->layout = 'login_new';
	}
        
        
        public function changePassword() {
		if ($this->request->is('post')) {
	if (isset($this->request->data['User']['password']) && ($this->request->data['User']['password']!="" || $this->request->data['User']['password']!=0))
	{
	$newpassword=$this->request->data['User']['password'];
        $cnfpassword=$this->request->data['User']['confirm_password'];
        $id=$this->request->data['User']['id'];
	
	
    if($this->request->data['User']['password']!=$cnfpassword=$this->request->data['User']['confirm_password']){
        
	$this->Session->setFlash('Your Password Do Not Match Confirm Password'); 
	$this->redirect(array('controller'=>'users','action'=>'changePassword'));

		
		}
		else
		{
		 $data = array(
                     'password'=>$newpassword,
                     'password_enc'=>md5($newpassword),
                     'id'=>$id
                 );
                 if ($this->User->save($data)) {
                     $this->Session->setFlash('Your Password Change Successfully'); 
	            $this->redirect(array('controller'=>'users','action'=>'changePassword'));
                     
                 }
			}
	}
	else
	{
		$this->Session->setFlash('Email Id should not be left blank');
		$this->redirect(array('controller'=>'users','action'=>'forgetPassword'));
		}
			
			}
		
	}
        
         public function getusers($blockid) {
	    $this->layout='ajax';
        $this->autoRender = false;
	    $data='<option value="">--Select--</option>';
	    //$subcatlist=$this->Project->find('list',array('conditions'=>array('builder_id'=>$builderid),array('order'=>array('name'=>'asc'))));
	      $subcatlist=$this->User->find('all',array('conditions'=>array('User.subrole'=>$blockid),'order' => array('name'=>'asc')));
	 
		foreach($subcatlist as $key=>$value){ $data.='<option value="'.$value['User']['id'].'">'.$value['User']['name'].' '.$value['User']['last_name'].'</option>';}
		return $data;
	}
        
        
         public function getSubmenu($id=null) {

		if($id) {
	        $data='';
                $data=$this->Menuheader->query("select name,action,id,controller,menuheader_id,usertype from menus as headers where status='active' and menuheader_id='$id'  group by controller order by id asc");
                      
		
		return $data;
		}
         }
        
	}
	
	?>
