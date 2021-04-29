<?php
App::uses('AppModel', 'Model');
/**
 * Financial Model
 *
 * @property State $State
 * @property Enquiry $Enquiry
 * @property Project $Project
 */
class Financestatus extends AppModel {
    
    
/**
 * Use table
 *
 * @var mixed False or table name
 */
	//public $useTable = 'financial_category';

/**
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
		'organization' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
                    ),
                    
                   'period_id' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			
		),
                   'reporting_period' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			
		),
                   'previous_expenditure' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			
		),
            
                  'opening_balance' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			
		),
             
                  'grant_received_from_pfi' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			
		),
             'closing_fund_balance' => array(
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
public $belongsTo = array(
		'Ngo' => array(
			'className' => 'Ngo',
			'foreignKey' => 'organization',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
//            'Financial' => array(
//			'className' => 'Financial',
//			'foreignKey' => 'cat_id',
//			'conditions' => '',
//			'fields' => '',
//			'order' => ''
//		),
//            'Subcategory' => array(
//			'className' => 'Subcategory',
//			'foreignKey' => 'subcat_id',
//			'conditions' => '',
//			'fields' => '',
//			'order' => ''
//		),
            'Period' => array(
			'className' => 'Period',
			'foreignKey' => 'period_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
            'ReportingPeriod' => array(
			'className' => 'ReportingPeriod',
			'foreignKey' => 'reporting_period',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
            
	);


/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
//		'Enquiry' => array(
//			'className' => 'Enquiry',
//			'foreignKey' => 'city_id',
//			'dependent' => false,
//			'conditions' => '',
//			'fields' => '',
//			'order' => '',
//			'limit' => '',
//			'offset' => '',
//			'exclusive' => '',
//			'finderQuery' => '',
//			'counterQuery' => ''
//		),
//		'Project' => array(
//			'className' => 'Project',
//			'foreignKey' => 'city_id',
//			'dependent' => false,
//			'conditions' => '',
//			'fields' => '',
//			'order' => '',
//			'limit' => '',
//			'offset' => '',
//			'exclusive' => '',
//			'finderQuery' => '',
//			'counterQuery' => ''
//		)
	);

}
