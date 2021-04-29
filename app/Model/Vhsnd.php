<?php
App::uses('AppModel', 'Model');
/**
 * FacilityDetail Model
 *
 */
class Vhsnd extends AppModel {

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
//             'ward' => array(
// 			'notBlank' => array(
// 				'rule' => array('notBlank'),
// 				//'message' => 'Your custom message here',
// 				//'allowEmpty' => false,
// 				//'required' => false,
// 				//'last' => false, // Stop validation after this rule
// 				//'on' => 'create', // Limit validation to 'create' or 'update' operations
// 			),
// 		),
		'pw_due_list' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'child_due_list' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'ec_due_list' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
            'remarks' => array(
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
            'Geographical' => array(
			'className' => 'Geographical',
			'foreignKey' => 'awc_code',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
            'Geographical' => array(
			'className' => 'Geographical',
			'foreignKey' => 'aww_name',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
            'FacilityDetail' => array(
			'className' => 'FacilityDetail',
			'foreignKey' => 'anm_name',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
            'Geographical' => array(
			'className' => 'Geographical',
			'foreignKey' => 'asha_name',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
            'Reason' => array(
			'className' => 'Reason',
			'foreignKey' => 'it_reason',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
            'Reason' => array(
			'className' => 'Reason',
			'foreignKey' => 'height_reason',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
            'Reason' => array(
			'className' => 'Reason',
			'foreignKey' => 'weight_reason',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
            'Reason' => array(
			'className' => 'Reason',
			'foreignKey' => 'ifa_reason',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
            'Reason' => array(
			'className' => 'Reason',
			'foreignKey' => 'calcium_reason',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
            'Reason' => array(
			'className' => 'Reason',
			'foreignKey' => 'bp_reason',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
            'Reason' => array(
			'className' => 'Reason',
			'foreignKey' => 'hb_reason',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
            'Reason' => array(
			'className' => 'Reason',
			'foreignKey' => 'urine_reason',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
            'Reason' => array(
			'className' => 'Reason',
			'foreignKey' => 'abdomen_reason',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
		
		);

}
