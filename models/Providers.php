<?php

namespace models;

use \helper\DB;

class Providers {

	public function getProviders() {
		$sql = "SELECT * FROM providers";
		return DB::getdb()->query($sql);
	}

	public function getProviderById($idProvider){
		$sql = 'select providers.name, providers.address, providers.basic_benefit, providers.amount_per_km,
				specialties.name as specialties_name, specialties.basic_amount
				from providers
				inner join specialties on providers.id_specialty = specialties.id
				where providers.id = '.$idProvider;

		return DB::getdb()->query($sql)->fetchAll();
	}
}
