<?php
namespace PetFishCo\Backend\Models\Services;

use PetFishCo\Backend\Models\Repositories;

class AquariumHasFish extends \Phalcon\Mvc\User\Component {

	/**
	 * @param string $fish_id
	 * @param string $shop_id
	 * @param string $aquarium_instance_id
	 */
	public function getByShopFishAndAqInstance($fish_id, $shop_id, $aquarium_instance_id){

		$aquariumHasFish = (new Repositories\AquariumHasFish(new \PetFishCo\Backend\Models\Entities\AquariumHasFish()))
			->findOneBy([
				"conditions" => "fish_id = :fish_id: AND shop_id = :shop_id: AND aquarium_instance_id = :aquarium_instance_id:",
				"bind" => [
					"fish_id" => $fish_id,
					"shop_id" => $shop_id,
					"aquarium_instance_id" => $aquarium_instance_id,
				]
			]);

		return $aquariumHasFish;
	}
}