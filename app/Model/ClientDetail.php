<?php
App::uses('AppModel', 'Model');
/**
 * Ngo Model
 *
 */
class ClientDetail extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'company_name';
	
	
	public $validate = array(
		'name_of_client' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
//                'client_email' => array(
//			'notBlank' => array(
//				'rule' => array('notBlank'),
//				//'message' => 'Your custom message here',
//				//'allowEmpty' => false,
//				//'required' => false,
//				//'last' => false, // Stop validation after this rule
//				//'on' => 'create', // Limit validation to 'create' or 'update' operations
//			),
//		),
//		'client_phone' => array(
//			'notBlank' => array(
//				'rule' => array('notBlank'),
//				//'message' => 'Your custom message here',
//				//'allowEmpty' => false,
//				//'required' => false,
//				//'last' => false, // Stop validation after this rule
//				//'on' => 'create', // Limit validation to 'create' or 'update' operations
//			),
//		),
		'company_name' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
//            'country_p' => array(
//			'notBlank' => array(
//				'rule' => array('notBlank'),
//				//'message' => 'Your custom message here',
//				//'allowEmpty' => false,
//				//'required' => false,
//				//'last' => false, // Stop validation after this rule
//				//'on' => 'create', // Limit validation to 'create' or 'update' operations
//			),
//		),
//		'permanent_address' => array(
//			'notBlank' => array(
//				'rule' => array('notBlank'),
//				//'message' => 'Your custom message here',
//				//'allowEmpty' => false,
//				//'required' => false,
//				//'last' => false, // Stop validation after this rule
//				//'on' => 'create', // Limit validation to 'create' or 'update' operations
//			),
//		),
//		'post_office_p' => array(
//			'notBlank' => array(
//				'rule' => array('notBlank'),
//				//'message' => 'Your custom message here',
//				//'allowEmpty' => false,
//				//'required' => false,
//				//'last' => false, // Stop validation after this rule
//				//'on' => 'create', // Limit validation to 'create' or 'update' operations
//			),
//		),
//		'district_p' => array(
//			'notBlank' => array(
//				'rule' => array('notBlank'),
//				//'message' => 'Your custom message here',
//				//'allowEmpty' => false,
//				//'required' => false,
//				//'last' => false, // Stop validation after this rule
//				//'on' => 'create', // Limit validation to 'create' or 'update' operations
//			),
//		),
//		'state_p' => array(
//			'notBlank' => array(
//				'rule' => array('notBlank'),
//				//'message' => 'Your custom message here',
//				//'allowEmpty' => false,
//				//'required' => false,
//				//'last' => false, // Stop validation after this rule
//				//'on' => 'create', // Limit validation to 'create' or 'update' operations
//			),
//		),
//            'permanent_pincode' => array(
//			'notBlank' => array(
//				'rule' => array('notBlank'),
//				//'message' => 'Your custom message here',
//				//'allowEmpty' => false,
//				//'required' => false,
//				//'last' => false, // Stop validation after this rule
//				//'on' => 'create', // Limit validation to 'create' or 'update' operations
//			),
//		),
//            'correspondence_address' => array(
//			'notBlank' => array(
//				'rule' => array('notBlank'),
//				//'message' => 'Your custom message here',
//				//'allowEmpty' => false,
//				//'required' => false,
//				//'last' => false, // Stop validation after this rule
//				//'on' => 'create', // Limit validation to 'create' or 'update' operations
//			),
//		),
//		'post_office_c' => array(
//			'notBlank' => array(
//				'rule' => array('notBlank'),
//				//'message' => 'Your custom message here',
//				//'allowEmpty' => false,
//				//'required' => false,
//				//'last' => false, // Stop validation after this rule
//				//'on' => 'create', // Limit validation to 'create' or 'update' operations
//			),
//		),
//		'district_c' => array(
//			'notBlank' => array(
//				'rule' => array('notBlank'),
//				//'message' => 'Your custom message here',
//				//'allowEmpty' => false,
//				//'required' => false,
//				//'last' => false, // Stop validation after this rule
//				//'on' => 'create', // Limit validation to 'create' or 'update' operations
//			),
//		),
//		'state_c' => array(
//			'notBlank' => array(
//				'rule' => array('notBlank'),
//				//'message' => 'Your custom message here',
//				//'allowEmpty' => false,
//				//'required' => false,
//				//'last' => false, // Stop validation after this rule
//				//'on' => 'create', // Limit validation to 'create' or 'update' operations
//			),
//		),
//            'correspondence_pincode' => array(
//			'notBlank' => array(
//				'rule' => array('notBlank'),
//				//'message' => 'Your custom message here',
//				//'allowEmpty' => false,
//				//'required' => false,
//				//'last' => false, // Stop validation after this rule
//				//'on' => 'create', // Limit validation to 'create' or 'update' operations
//			),
//		),
//	  'country_c' => array(
//			'notBlank' => array(
//				'rule' => array('notBlank'),
//				//'message' => 'Your custom message here',
//				//'allowEmpty' => false,
//				//'required' => false,
//				//'last' => false, // Stop validation after this rule
//				//'on' => 'create', // Limit validation to 'create' or 'update' operations
//			),
//		),
//          
//            'pan_number' => array(
//			'notBlank' => array(
//				'rule' => array('notBlank'),
//				//'message' => 'Your custom message here',
//				//'allowEmpty' => false,
//				//'required' => false,
//				//'last' => false, // Stop validation after this rule
//				//'on' => 'create', // Limit validation to 'create' or 'update' operations
//			),
//		),
           
	);
	
	
	
	
	public $belongsTo = array(
//		'City' => array(
//			'className' => 'City',
//			'foreignKey' => 'allocated_district',
//			'conditions' => '',
//			'fields' => '',
//			'order' => ''
//		),
//		'Block1' => array(
//			'className' => 'Block',
//			'foreignKey' => 'allocated_block_one',
//			'conditions' => '',
//			'fields' => '',
//			'order' => ''
//		),
//            
//		'Block2' => array(
//			'className' => 'Block',
//			'foreignKey' => 'allocated_block_two',
//			'conditions' => '',
//			'fields' => '',
//			'order' => ''
//		),
//		'User' => array(
//			'className' => 'User',
//			'foreignKey' => 'chief_functionary_name',
//			'conditions' => '',
//			'fields' => '',
//			'order' => ''
//		),
//		'Ngoname' => array(
//			'className' => 'Ngoname',
//			'foreignKey' => 'name_of_ngo',
//			'conditions' => '',
//			'fields' => '',
//			'order' => ''
//		)
		
		);

}
