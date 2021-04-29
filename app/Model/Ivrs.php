<?php
App::uses('AppModel', 'Model');
/**
 * Bpccc Model
 *
 */
class Ivrs extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';
	
	
	public $validate = array(
		
		'district' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'block' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
            'panchayat' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
//            'village' => array(
//			'notBlank' => array(
//				'rule' => array('notBlank'),
//				//'message' => 'Your custom message here',
//				//'allowEmpty' => false,
//				//'required' => false,
//				//'last' => false, // Stop validation after this rule
//				//'on' => 'create', // Limit validation to 'create' or 'update' operations
//			),
//		),
            'ivrs_user_name' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
            'age' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
            'ivrs_user_mobile' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		)
	);
	
	
	
	
	public $belongsTo = array(
//		'User' => array(
//			'className' => 'User',
//			'foreignKey' => 'booked_by',
//			'conditions' => '',
//			'fields' => '',
//			'order' => ''
//		),
//		'Ngo' => array(
//			'className' => 'Ngo',
//			'foreignKey' => 'organization',
//			'conditions' => '',
//			'fields' => '',
//			'order' => ''
//		),
		'City' => array(
			'className' => 'City',
			'foreignKey' => 'district',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Block' => array(
			'className' => 'Block',
			'foreignKey' => 'block',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Panchayat' => array(
			'className' => 'Panchayat',
			'foreignKey' => 'panchayat',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
              'Village' => array(
			'className' => 'Village',
			'foreignKey' => 'village',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
            'Ward' => array(
			'className' => 'Ward',
			'foreignKey' => 'ward',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
//            'Discussion' => array(
//			'className' => 'Discussion',
//			'foreignKey' => 'topic_discussed',
//			'conditions' => '',
//			'fields' => '',
//			'order' => ''
//		),
//            
//          'MeetingFacilitated' => array(
//			'className' => 'MeetingFacilitated',
//			'foreignKey' => 'meeting_facilitated_by',
//			'conditions' => '',
//			'fields' => '',
//			'order' => ''
//		),
//          'Designation' => array(
//			'className' => 'Designation',
//			'foreignKey' => 'vhsnc_desig',
//			'conditions' => '',
//			'fields' => '',
//			'order' => ''
//		),
            
            
		);

}
