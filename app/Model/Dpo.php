<?php
App::uses('AppModel', 'Model');
/**
 * Dpo Model
 *
 */
class Dpo extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'first_name';
	
	
	public $validate = array(
		
		'first_name' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
            
		'district' => array(
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
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'first_name',
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
		'Designation' => array(
			'className' => 'Designation',
			'foreignKey' => 'designation',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'City' => array(
			'className' => 'City',
			'foreignKey' => 'district',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
//		'Location' => array(
//			'className' => 'Location',
//			'foreignKey' => 'project_location',
//			'conditions' => '',
//			'fields' => '',
//			'order' => ''
//		)
		
		);

}
