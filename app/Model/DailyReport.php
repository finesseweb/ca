<?php
App::uses('AppModel', 'Model');
/**
 * DailyReport Model
 *
 * @property Enquiry $Enquiry
 * @property User $User
 * @property LeadSource $LeadSource
 */
class DailyReport extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Enquiry' => array(
			'className' => 'Enquiry',
			'foreignKey' => 'enquiry_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
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
}
