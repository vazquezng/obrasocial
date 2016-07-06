<?php
namespace controller;

use \core\Request;
use \models\Providers;

class PrestadoresController {
	private $months = array(
					'Junary',
					'February',
					'March',
					'April',
					'May',
					'June',
					'July',
					'August',
					'September',
					'October',
					'November',
					'December'
				);

	public function liquidacionesAction($params) {
		$view = new \helper\Views();
		$view->setTemplate('liquidaciones');

		$view->addVar('currentMonth', date('F'));
		$view->addVar('months', $this->months);
		$view->addVar('idProvider', $params[0]);

		$view->compile();
	}

	public function liquidacion($idProvider, $month){
		$monthIndex = array_search($month, $this->months);
		++$monthIndex;

		$modelBenefits = new \models\Benefits();
		$modelProviders = new \models\Providers();

		$provider = $modelProviders->getProviderById($idProvider)[0];
		$benefits = $modelBenefits->getBenefits($idProvider, $monthIndex, 2016);

		$calcBenefts = [];
		$basicAmount = (int) $provider['basic_amount'];
		$total = $basicAmount;
		foreach ($benefits as $key => $value) {
			$calcBenefts[$key] = array(
				'patient' => $value['name_of_patient'],
				'date' => $value['date'],
				'type' => $value['type']
			);

			$price = (int) $provider['basic_benefit'];
			if($value['type'] == 'consultorio'){
				$datestrtime = strtotime($value['date']);
				$day = date('D', $datestrtime);
				$hour = date('H', $datestrtime);

				if($day == 'Sun' || $day == 'Sat'){
					$price += ($price * 50)/100;
				}elseif($hour < 8 || $hour > 20){
					$price += ($price * 35)/100;
				}
			}else{
				$price += ($price * 25)/100;
				$priceKm = (int)$provider['amount_per_km'] * (int) $value['kilometers'];
				$price += $priceKm;
			}

			$calcBenefts[$key]['price'] = $price;
			$total += $price;
		}

		return array('provider' => $provider,'basic' => $basicAmount, 'list' => $calcBenefts, 'total' => $total);
	}
}
?>
