<?php
App::uses('AppModel', 'Model');
/**
 * Bpccc Model
 *
 */
class Commonreport extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'member_name';
	
	
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
//		'village' => array(
//			'notBlank' => array(
//				'rule' => array('notBlank'),
//				//'message' => 'Your custom message here',
//				//'allowEmpty' => false,
//				//'required' => false,
//				//'last' => false, // Stop validation after this rule
//				//'on' => 'create', // Limit validation to 'create' or 'update' operations
//			),
//		),
		'activity' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		
		
	);
	
	
	
	
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
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
//            'Village' => array(
//			'className' => 'Village',
//			'foreignKey' => 'village',
//			'conditions' => '',
//			'fields' => '',
//			'order' => ''
//		),
//            'Ward' => array(
//			'className' => 'Ward',
//			'foreignKey' => 'ward',
//			'conditions' => '',
//			'fields' => '',
//			'order' => ''
//		),
            
//            'Geographical' => array(
//			'className' => 'Geographical',
//			'foreignKey' => 'awc_code',
//			'conditions' => '',
//			'fields' => '',
//			'order' => ''
//		),
            
		);

}
