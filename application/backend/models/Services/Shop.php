<?php
namespace PetFishCo\Backend\Models\Services;

use PetFishCo\Backend\Models\Repositories\AquariumInstance;
use PetFishCo\Backend\Models\Repositories\Aquarium as AquariumRepo;
use PetFishCo\Backend\Models\Entities\Aquarium as AquariumModel;

class Shop extends \Phalcon\Mvc\User\Component {

	/**
	 * @param int $shop_id
	 *
	 * @return array
	 */
	public function getAquariums($shop_id){

		$data = (new Aquarium())->getByShopId($shop_id);

		return $data;
	}

	/**
	 * @param array $aquariums
	 * @param array $instances
	 *
	 * @return array
	 */
	protected function mergeData($aquariums, $instances){
		if (empty($instances)) {
			return [];
		}
		if (empty($aquariums)) {
			return [];
		}

		$formatted_aquariums = [];
		$formatted_results = [];
		foreach ($aquariums as $aquarium) {
			$formatted_aquariums[$aquarium->aquarium_id] = $aquarium;
		}

		foreach ($instances as $index => $instance) {
			$formatted_results[] = $this->mergeAquariumAndInstanceData(
				$instance,
				$formatted_aquariums[$instance->aquarium_id]
			);
		}

		return $formatted_results;
	}

	/**
	 * @param $instance
	 * @param $aquarium
	 *
	 * @return array
	 */
	public function mergeAquariumAndInstanceData($instance, $aquarium){
		return array_merge($instance,$aquarium);
	}
}