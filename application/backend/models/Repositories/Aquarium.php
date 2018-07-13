<?php
namespace PetFishCo\Backend\Models\Repositories;

use Phalcon\Mvc\Model\Query\Builder;
use PetFishCo\Backend\Models\Entities\AquariumMaterial;
use PetFishCo\Backend\Models\Entities\AquariumShape;

class Aquarium extends BaseRepository implements RestRepositoryInterface {

	/**
	 * Build base query to retrieve a acquarium
	 *
	 * @return \Phalcon\Mvc\Model\Query\Builder
	 */
	public function getBaseBuilder(){

		$queryBuilder = new Builder([]);

		return $queryBuilder->addFrom(\PetFishCo\Backend\Models\Entities\Aquarium::class, "a")
			->join(AquariumMaterial::class, "am.id = a.aquarium_material_id", 'am')
			->join(AquariumShape::class, "ash.id = a.aquarium_shape_id", 'ash')
			->columns([
				'a.id',
				'capacity',
				'aquarium_shape' => 'ash.name',
				'aquarium_material' => 'am.name',
				'a.created_at'
			]);
	}


}