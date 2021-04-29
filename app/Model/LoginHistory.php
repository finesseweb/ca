<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 */
class LoginHistory extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	 public $useTable  = 'login_history';
	public $displayField = 'name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array();
	
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
		);
}
