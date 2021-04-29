<?php
App::uses('AppController', 'Controller');
/**
 * subcategorys Controller
 *
 * @property City $City
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class SubfeedbacksController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
	var  $uses = array('Subfeedback','Feedback');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Paginator->settings = array('Subfeedback' => array('limit' =>10,'order' => array('name' => 'asc')));
		$this->Subfeedback->recursive = 0;
		$this->set('subfeedbacks', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Subfeedback->exists($id)) {
			throw new NotFoundException(__('Invalid Subfeedback'));
		}
		$options = array('conditions' => array('Subfeedback.' . $this->Subfeedback->primaryKey => $id));
		$this->set('subcategory', $this->Subfeedback->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Subfeedback->create();
                        //print_r($this->request->data);
                           // die();
			if ($this->Subfeedback->save($this->request->data)) {
                            
                            
				$this->Session->setFlash(__('The Sub Feedback has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Sub Feedback could not be saved. Please, try again.'));
			}
		}
		$financials = $this->Subfeedback->Feedback->find('list');
                $level = $this->Subfeedback->Level->find('list');
		$this->set(compact('financials','level'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Subfeedback->exists($id)) {
			throw new NotFoundException(__('Invalid city'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Subfeedback->save($this->request->data)) {
				$this->Session->setFlash(__('The Issue Subcategory has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Issue Subcategorycould not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Subfeedback.' . $this->Subfeedback->primaryKey => $id));
			$this->request->data = $this->Subfeedback->find('first', $options);
		}
		$financials = $this->Subfeedback->Feedback->find('list');
                 $level = $this->Subfeedback->Level->find('list');
		$this->set(compact('financials','level'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Subfeedback->id = $id;
		if (!$this->Subfeedback->exists()) {
			throw new NotFoundException(__('Invalid Issue Subcategory'));
		}
		//$this->request->allowMethod('post', 'delete');
		if ($this->Subfeedback->delete()) {
			$this->Session->setFlash(__('The Issue Subfeedback has been deleted.'));
		} else {
			$this->Session->setFlash(__('The Issue Subfeedback could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
        
        public function getsubcat($stateid) {
	    $this->layout='ajax';
        $this->autoRender = false;
	    $data='<option value="">Select Questions</option>';
		$subcatlist=$this->Subfeedback->find('list',array("conditions"=>array('cat_id'=>$stateid)));
		foreach($subcatlist as $key=>$value){ $data.='<option value="'.$key.'">'.$value.'</option>';}
		return $data;
	}
        public function fetchcat($stateid) {
	    $this->layout='ajax';
        $this->autoRender = false;
	      $row='<tr><td>Question</td><td>Response</td><td>Remarks</td></tr>';
		$subcatlist=$this->Subfeedback->find('all',array("conditions"=>array('cat_id'=>$stateid)));
              // print_r($subcatlist);
                 //   die();
		foreach($subcatlist as $value){ 
                    //print_r($value);
                    $row.='<tr><td><input type="text" name="data[VhsncFeedback][question][]" readonly="readonly" value="'.$value['Subfeedback']['name'].'"></td>'
                            . '<td><select name="data[VhsncFeedback][response][]"><option value="good"> Good </option> <option value="average"> Average </option><option value="bad"> Bad </option></td>'
                            . '<td><input type="text" name="data[VhsncFeedback][feedback_remarks][]"></tr>';
                 
                }
                echo $row;
               //echo $row;
               //die();
		//return $data;   
	}
                
                        
       
        public function getquestion($fid,$level='') {
            
	        if($level){
		$subcatlist=$this->Subfeedback->find('all',array("conditions"=>array('cat_id'=>$fid,'level'=>$level)));
                }
                else {
                $subcatlist=$this->Subfeedback->find('all',array("conditions"=>array('cat_id'=>$fid)));
                  
                }
		return $subcatlist;   
	}
        public function getclass($fid,$level='') {
            
	        if($level){
		$subcatlist=$this->Subfeedback->find('first',array("conditions"=>array('cat_id'=>$fid,'level'=>$level)));
                }
                else {
                $subcatlist=$this->Subfeedback->find('first',array("conditions"=>array('cat_id'=>$fid)));
                  
                }
		return $subcatlist;   
	}
        
        public function getquestions() {
             $this->layout='ajax';
        $this->autoRender = false;
         $c=$this->params->query['c'];
	 //$v=$this->params->query['v'];
	       
		$feedbacks=$this->Subfeedback->find('all',array('group'=>array('cat_id'),"conditions"=>array('level'=>$c)));
                
                foreach($feedbacks as $feedback) {
                    
                    $feed=$this->Feedback->find('first',array("conditions"=>array('Feedback.id'=>$feedback['Subfeedback']['cat_id'],'Feedback.category'=>'checklist')));
                   //print_r($feedback);
                   //die();
                    if($feed){
                    ?>
               
<tr>
              <td colspan="3"style="background-color: #C0BFBA;"><?=ucwords($feed['Feedback']['name'])?>
                  <input type="hidden" class="feed" name="data[Checklist][hidden][]" id="ChecklistHidden" value="<?=$feed['Feedback']['id']?>">
              </td>
</tr>
              <?php   
              $subcatlist=$this->Subfeedback->find('all',array("conditions"=>array('Subfeedback.level'=>$c,'Subfeedback.cat_id'=>$feed['Feedback']['id'])));
                
              foreach($subcatlist as $key=>$value) {
               
                                                    ?>
          
       <tr class="<?=$value['Subfeedback']['level']?>"> <td style="background-color: aliceblue" class="question" id="feedId<?=ucfirst($value['Subfeedback']['id'])?>">
                  <?=$value['Subfeedback']['name']?>
              <input type="hidden" name="data[Checklist][question_id][]" readonly="readonly" value="<?=ucfirst($value['Subfeedback']['id'])?>">
              
              </td>
              <td style="width: 14%"> <select class="form-control question" name="data[Checklist][response][]" id="responce<?=ucfirst($value['Subfeedback']['id'])?>">
                   <option value="">p;u djs</option> 
                  <option value="<?=$value['Subfeedback']['responce_one'];?>"> <?=$value['Subfeedback']['responce_one'];?></option> 
                  <option value="<?=$value['Subfeedback']['responce_two'];?>"> <?=$value['Subfeedback']['responce_two'];?> </option>
                  <?php if($value['Subfeedback']['responce_three']!=''){?>
                  <option value="<?=$value['Subfeedback']['responce_three'];?>"> <?=$value['Subfeedback']['responce_three'];?> </option>
                  <?php } ?>
              </select>
          </td>
          <td style="width: 20%"><input class="form-control question" type="text" name="data[Checklist][feedback_remarks][]"></td>
       </tr>
       
       <script>
            
            $(document).ready(function(){
               $("#responce<?=ucfirst($value['Subfeedback']['id'])?>").change(function(){
                   var c=$(this).val();
                   if(c=='gkWa'){
                      $("#feedId<?=ucfirst($value['Subfeedback']['id'])?>").css("background-color","lightgreen");
                        }
                        
                       else if(c=='ugha'){
                      $("#feedId<?=ucfirst($value['Subfeedback']['id'])?>").css("background-color","#ff7575");
                        }
                        
                        else if(c==''){
                      $("#feedId<?=ucfirst($value['Subfeedback']['id'])?>").css("background-color","aliceblue");
                        }
                        
                        
                       else {
                      $("#feedId<?=ucfirst($value['Subfeedback']['id'])?>").css("background-color","orange");
                        }
                   
               }); 
              
            });
            </script>
       
	<?php //	return $subcatlist;   
        } } } }
        
         public function getreportquestion() {
             $this->layout='ajax';
        $this->autoRender = false;
         $c=$this->params->query['c'];
	 //$v=$this->params->query['v'];
	       
		$feedbacks=$this->Subfeedback->find('all',array('group'=>array('cat_id'),"conditions"=>array('level'=>$c)));
                
                foreach($feedbacks as $feedback) {
                    
                    $feed=$this->Feedback->find('first',array("conditions"=>array('Feedback.id'=>$feedback['Subfeedback']['cat_id'],'Feedback.category'=>'monthly-report')));
                   //print_r($feedback);
                   //die();
                    if($feed){
                    ?>
               
<tr>
              <td colspan="3"style="background-color: #C0BFBA;"><?=ucwords($feed['Feedback']['name'])?>
                  <input type="hidden" class="feed" name="data[Monthlyreport][hidden][]" id="ChecklistHidden" value="<?=$feed['Feedback']['id']?>">
              </td>
</tr>
              <?php   
              $subcatlist=$this->Subfeedback->find('all',array("conditions"=>array('Subfeedback.level'=>$c,'Subfeedback.cat_id'=>$feed['Feedback']['id'])));
                
              foreach($subcatlist as $key=>$value) {
               
                                                    ?>
          
       <tr class="<?=$value['Subfeedback']['level']?>"> <td style="background-color: aliceblue" class="question" id="feedId<?=ucfirst($value['Subfeedback']['id'])?>">
                  <?=$value['Subfeedback']['name']?>
              <input type="hidden" name="data[Monthlyreport][question_id][]" readonly="readonly" value="<?=ucfirst($value['Subfeedback']['id'])?>">
              
              </td>
              <td> <input class="form-control question" name="data[Monthlyreport][response][]" id="responce<?=ucfirst($value['Subfeedback']['id'])?>">
                  
          </td>
          <!--<td><input class="form-control question" type="text" name="data[Monthlyreport][feedback_remarks][]"></td>-->
       </tr>
       
     
       
	<?php //	return $subcatlist;   
        } } } }
        
        public function gettitle($id) {
	        $options = array('conditions' => array('Subfeedback.' . $this->Subfeedback->primaryKey => $id));
		$subcatlist=$this->Subfeedback->find('first',$options);
             //return $subcatlist;
             //die();
		return $subcatlist;   
	}
                
}
