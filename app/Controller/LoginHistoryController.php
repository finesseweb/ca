<?php
App::uses('AppController', 'Controller');
/**
 * UnitTypes Controller
 *
 * @property UnitType $UnitType
 * @property PaginatorComponent $Paginator
 */
class LoginHistoryController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * admin_index method
 *
 * @return void
 */
	public function index() {
		$this->LoginHistory->recursive = 0;
		$this->Paginator->settings = array('LoginHistory' => array('order'=>array('LoginHistory.in_time'=>'DESC')));
		$this->set('loginHistory', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->UnitType->exists($id)) {
			throw new NotFoundException(__('Invalid unit type'));
		}
		$options = array('conditions' => array('UnitType.' . $this->UnitType->primaryKey => $id));
		$this->set('unitType', $this->UnitType->find('first', $options));
	}
	
	public function getLocationInfoByIp($ip){

    
    $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));    
    if($ip_data && $ip_data->geoplugin_countryName != null){
    $result['country'] = $ip_data->geoplugin_countryCode;
    $result['city'] = $ip_data->geoplugin_city;
    }
    return $result;

}
	
	}
	
	?>
