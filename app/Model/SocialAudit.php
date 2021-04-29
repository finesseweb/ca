<?php
App::uses('AppModel', 'Model');
/**
 * Bpccc Model
 *
 */
class SocialAudit extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'member_name';
	
	
	public $validate = array(
		
		
		
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
            'participants' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),'panellist' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),'case_study_shared' => array(
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
		
              
            'Block' => array(
			'className' => 'Block',
			'foreignKey' => 'block',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
            
            'IssueCategory' => array(
			'className' => 'IssueCategory',
			'foreignKey' => 'issue_cat',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
            
            'IssueSubcategory' => array(
			'className' => 'IssueSubcategory',
			'foreignKey' => 'issue_level',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		);

}
