<?php
App::uses('AppModel', 'Model');
/**
 * Enquiry Model
 *
 * @property User $User
 * @property Project $Project
 * @property Builder $Builder
 * @property Country $Country
 * @property State $State
 * @property City $City
 * @property CloseReason $CloseReason
 * @property Remark $Remark
 */
class Enquiry extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'query' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'builder_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'project_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'lead_source_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'country_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		/*'state_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'city_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),*/
		'close_reason_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'reminder_date' => array(
			'datetime' => array(
				'rule' => array('datetime'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'email' => array( 
		'on add'=>array(
        'rule' => 'checkEmail',
		'required' => false,
        'allowEmpty' => true,
		'on' => 'create', // here
        'message' => 'email already exist.Please try another'
		),'on update'=>array(
		'rule' => 'checkEmail2',
		'required' => false,
        'allowEmpty' => true,
		'on' => 'update', // here
        'message' => 'email already exist.Please try another'
		)

    ),
		'contact' => array(
		'on add' => array(
        'rule' => 'checkContact',
		'required' => false,
        'allowEmpty' => true,
		'on' => 'create', // here
        'message' => 'contact already exist.Please try another'
		),'on update'=>array(
		'rule' => 'checkContact2',
		'required' => false,
        'allowEmpty' => true,
		'on' => 'update', // here
        'message' => 'contact already exist.Please try another'
		)
		)
		/*),
		'not valid'=>array(
			'rule'=>'numeric',
			'required' => false,
			'message'=>'Phone number should be numeric'
			),*/
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Project' => array(
			'className' => 'Project',
			'foreignKey' => 'project_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Builder' => array(
			'className' => 'Builder',
			'foreignKey' => 'builder_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Country' => array(
			'className' => 'Country',
			'foreignKey' => 'country_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'State' => array(
			'className' => 'State',
			'foreignKey' => 'state_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'City' => array(
			'className' => 'City',
			'foreignKey' => 'city_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'CloseReason' => array(
			'className' => 'CloseReason',
			'foreignKey' => 'close_reason_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'LeadSource' => array(
			'className' => 'LeadSource',
			'foreignKey' => 'lead_source_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Remark' => array(
			'className' => 'Remark',
			'foreignKey' => 'enquiry_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Meeting' => array(
			'className' => 'Meeting',
			'foreignKey' => 'enquiry_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
	


public function checkEmail() { 
$emails = $this->find("list", array("conditions" => array('Enquiry.email'=>trim($this->data['Enquiry']['email']),'Enquiry.status'=>'open')));

if(!empty($emails)){ return false;}
else { return true ;}
        
    }
	
	public function checkEmail2() { 
$emails = $this->find("all", array('fields'=>array('id','count(*) as total'),"conditions" => array('Enquiry.email'=>trim($this->data['Enquiry']['email']),'Enquiry.status'=>'open','NOT'=>array('Enquiry.email'=>''))));
//print_r($emails[0][0]['total']); exit;
if($emails[0]['Enquiry']['id']!=trim($this->data['Enquiry']['id']) and $emails[0][0]['total']>0){ return false;}
else { return true ;}
        
    }
	
	public function checkContact() {
	$contacts =	$this->query("select id,contact from enquiries where contact like '%".trim(substr(trim($this->data['Enquiry']['contact']),0))."%' and status='open' and contact!=''");

if(count($contacts)>=1) {
   foreach($contacts as $val){
	 if(substr(trim($this->data['Enquiry']['contact']),0)==substr($val['enquiries']['contact'],0)){		
	  return false;
	   break; 
	    }
          }
            }
   else { return true ;}
       
              }
	
	public function checkContact2() { 
	$data=true;
//$contacts = $this->find("all", array('fields'=>array('id','count(*) as total'),"conditions" => array('Enquiry.contact'=>trim($this->data['Enquiry']['contact']),'Enquiry.status'=>'open','NOT'=>array('Enquiry.contact'=>''))));

$contacts =	$this->query("select id,contact from enquiries where contact like '%".trim(substr(trim($this->data['Enquiry']['contact']),-8))."%' and status='open' and contact!=''");


if(count($contacts)>1) {
   foreach($contacts as $val){
/*echo substr(trim($this->data['Enquiry']['contact']),-8)."==".substr($val['enquiries']['contact'],-8)."-id=>".$val['enquiries']['id']."=".$this->data['Enquiry']['id']."<br/>";*/
	 if($val['enquiries']['id']!==$this->data['Enquiry']['id'] and substr(trim($this->data['Enquiry']['contact']),0)==substr($val['enquiries']['contact'],0)){		
	 $data=false;
	   break; 
	    }else{
			$data=true;
			
			}
          }
            }
   else { $data=true ;}
   return $data;
       
              }


}
