<?php
App::uses('AppModel', 'Model');
/**
 * Period Model
 *
 * @property State $State
 * @property Enquiry $Enquiry
 * @property Project $Project
 */
class ReportingPeriod extends AppModel {
    
    
/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'reporting_periods';

/**
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'from_date';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'from_date' => array(
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

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
//	public $belongsTo = array(
//		'City' => array(
//			'className' => 'City',
//			'foreignKey' => 'city_id',
//			'conditions' => '',
//			'fields' => '',
//			'order' => ''
//		)
//	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Enquiry' => array(
			'className' => 'Enquiry',
			'foreignKey' => 'city_id',
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
		'Project' => array(
			'className' => 'Project',
			'foreignKey' => 'city_id',
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

}
