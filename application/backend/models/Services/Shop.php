<?php
namespace PetFishCo\Backend\Models\Services;

use PetFishCo\Backend\Models\Entities\AquariumHasFish;
use PetFishCo\Backend\Models\Entities\AquariumMaterial;
use PetFishCo\Backend\Models\Entities\AquariumShape;
use PetFishCo\Backend\Models\Entities\Fish;
use PetFishCo\Core\Mvc\BaseRepository;
use PetFishCo\Backend\Models\Repositories\Aquarium as AquariumRepo;
use PetFishCo\Backend\Models\Entities\Aquarium as AquariumModel;

class Shop extends \Phalcon\Mvc\User\Component {

	/**
	 * @param int $shop_id
	 *
	 * @return array
	 */
	public function getAquariums($shop_id){

		$repository = new AquariumRepo(new AquariumModel());
		$queryBuilder = $repository->getBaseBuilder();
		$queryBuilder->where('shop_id = :shop_id:', ['shop_id' => $shop_id]);

		$page = $repository->paginate($queryBuilder);

		return ($page->items)? $page->items->toArray() : [];
	}
}