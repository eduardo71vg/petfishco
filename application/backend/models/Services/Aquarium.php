<?php
namespace PetFishCo\Backend\Models\Services;

use PetFishCo\Backend\Models\Entities\AquariumHasFish;
use PetFishCo\Backend\Models\Entities\Fish;
use PetFishCo\Core\Mvc\BaseRepository;
use PetFishCo\Backend\Models\Repositories\Aquarium as AquariumRepo;
use PetFishCo\Backend\Models\Entities\Aquarium as AquariumModel;


class Aquarium extends \Phalcon\Mvc\User\Component {

	/**
	 * @param int $aquarium_id
	 *
	 * @return array
	 */
	public function getFishes($aquarium_id){

		$queryBuilder = new \Phalcon\Mvc\Model\Query\Builder([]);

		$queryBuilder->addFrom(AquariumHasFish::class, "af")
			->join(Fish::class, "f.id = af.fish_id", 'f')
			->where('aquarium_id = :aquarium_id:', ['aquarium_id' => $aquarium_id]);

		$repository = new BaseRepository(new AquariumHasFish());
		$page = $repository->paginate($queryBuilder);

		return ($page->items)? $page->items->toArray() : [];
	}

	/**
	 * @param int $aquarium_id
	 *
	 * @return array
	 */
	public function getById($aquarium_id){

		$aquarium_repository = new AquariumRepo(new AquariumModel());
		$queryBuilder = $aquarium_repository->getBaseBuilder();
		$queryBuilder = $queryBuilder->where('a.id = :aquarium_id:', ['aquarium_id' => $aquarium_id]);

		return $queryBuilder->getQuery()->execute();
	}
}