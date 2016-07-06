<?php

namespace models;

use \helper\DB;

class Benefits {

	public function getBenefits($idProvider, $month, $year){
		$sql = 'SELECT * FROM benefits WHERE id_provider = '.$idProvider.' AND MONTH(date) = '.$month.' AND YEAR(date) = '.$year;

		return DB::getdb()->query($sql)->fetchAll();
	}

}
