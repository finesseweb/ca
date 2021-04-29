<?php
App::uses('AppModel', 'Model');
/**
 * ResaleBooking Model
 *
 * @property Builder $Builder
 * @property Project $Project
 * @property Location $Location
 */
class ResaleBooking extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'resale_booking';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Builder' => array(
			'className' => 'Builder',
			'foreignKey' => 'builder_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Project' => array(
			'className' => 'Project',
			'foreignKey' => 'project_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Location' => array(
			'className' => 'Location',
			'foreignKey' => 'location_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'booked_by',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
