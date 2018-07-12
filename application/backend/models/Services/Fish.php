<?php

namespace PetFishCo\Backend\Models\Services;


use PetFishCo\Backend\Models\Entities\AquariumHasFish;
use Phalcon\Mvc\Model\Query\Builder;

class Fish extends \Phalcon\Mvc\User\Component{

	/**
	 * @return Builder
	 */
	public function getBaseBuilder(){
		$queryBuilder = new \Phalcon\Mvc\Model\Query\Builder([]);

		$queryBuilder->addFrom(AquariumHasFish::class, "af")
			->join(\PetFishCo\Backend\Models\Entities\Fish::class, "f.id = af.fish_id", 'f')
			->columns('f.id, aquarium_instance_id, af.shop_id, af.stock,  f.color, f.fish_specie_id, f.alias, f.fins, f.created_at')
			->where('f.deleted = 0');

		return $queryBuilder;
	}

	/**
	 * @param int $id
	 *
	 * @return mixed
	 */
	public function getById($id){

		$queryBuilder = (new \PetFishCo\Backend\Models\Services\Fish())->getBaseBuilder();
		$results = $queryBuilder->where('f.id = :id:', ['id' => $id])
			->getQuery()
			->execute();

		return $results;

	}
}