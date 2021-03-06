<?php
namespace PetFishCo\Backend\Models\Services;

use PetFishCo\Backend\Models\Entities\AquariumHasFish;
use PetFishCo\Backend\Models\Entities\Fish;
use PetFishCo\Backend\Models\Entities\AquariumInstance;
use PetFishCo\Backend\Models\Repositories;
use PetFishCo\Backend\Models\Entities\Aquarium as AquariumModel;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Mvc\Model\Resultset\Simple;
use PetFishCo\Backend\Models\Repositories\AquariumMaterial as AquariumMaterialRepo;
use PetFishCo\Backend\Models\Entities\AquariumMaterial;
use PetFishCo\Backend\Models\Repositories\AquariumShape;


class Aquarium extends \Phalcon\Mvc\User\Component {

	/**
	 * @param int $aquarium_instance_id
	 *
	 * @return array
	 */
	public function getFishes($aquarium_instance_id){

		$queryBuilder = (new \PetFishCo\Backend\Models\Services\Fish())->getBaseBuilder();
		$queryBuilder
			->where('aquarium_instance_id = :aquarium_instance_id:',
				['aquarium_instance_id' => $aquarium_instance_id]
			);

		$repository = new Repositories\BaseRepository(new AquariumHasFish());
		$page = $repository->paginate($queryBuilder);

		return ($page->items)? $page->items->toArray() : [];
	}

	/**
	 * @param int $aquarium_instance_id
	 *
	 * @return array
	 */
	public function getSpecies($aquarium_instance_id){

		$queryBuilder = (new \PetFishCo\Backend\Models\Services\Fish())->getBaseBuilder();
		$species = $queryBuilder
			->columns('DISTINCT(f.fish_specie_id) AS id')
			->where('aquarium_instance_id = :aquarium_instance_id:',
				['aquarium_instance_id' => $aquarium_instance_id]
			)
			->getQuery()
			->execute();

		$ids = [];
		if(!empty($species)) {
			foreach ($species as $index => $specie) {
				$ids[] = $specie->id;
			}
		}

		return $ids;
	}

	/**
	 * @param int $aquarium_instance_id
	 *
	 * @return float|int
	 * @throws AppException
	 */
	public function getAquariumCapacity($aquarium_instance_id){

		$aquarium = $this->getByInstanceId($aquarium_instance_id);

		if(empty($aquarium)){
			throw new AppException('Unable to get aquarium by instance id '.$aquarium_instance_id);
		}

		return $aquarium[0]['capacity'];
	}

	/**
	 * @return mixed
	 */
	public function getBaseBuilder(){
		$builder = new Builder();
		return $builder->addFrom(AquariumInstance::class, 'ai')
			->columns('ai.id ,ai.amount, ai.shop_id, ai.created_at, ai.updated_at , am.capacity, am.aquarium_shape_id , am.aquarium_material_id')
			->join(AquariumModel::class, 'am.id = aquarium_id', 'am')
			->orderBy('ai.created_at');
	}

	/**
	 * @param int $shop_id
	 *
	 * @return array|\PetFishCo\Backend\Transformers\ResultInterface
	 * @throws \PetFishCo\Core\Exceptions\AppException
	 */
	public function getByShopId($shop_id){

		$builder = $this->getBaseBuilder();
		$aquariums = $builder->where('ai.shop_id = :shop_id: and am.deleted = 0', ['shop_id' => $shop_id])
			->getQuery()
			->execute();

		$data = $this->bindOptionTables($aquariums);

		return $data;
	}

	/**
	 * @param int $id
	 *
	 * @return array|\PetFishCo\Backend\Transformers\ResultInterface
	 * @throws \PetFishCo\Core\Exceptions\AppException
	 */
	public function getByInstanceId($id){

		$builder = $this->getBaseBuilder();
		$aquariums = $builder->where('ai.id = :id:', ['id' => $id])
			->getQuery()
			->execute();

		$data = $this->bindOptionTables($aquariums);

		return $data;
	}

	/**
	 * @param Simple $aquariums
	 *
	 * @return \PetFishCo\Backend\Transformers\ResultInterface
	 * @throws \PetFishCo\Core\Exceptions\AppException
	 */
	protected function bindOptionTables($aquariums) {
		$data = [];
		if (!empty($aquariums)) {
			$materials_repo = (new AquariumMaterialRepo(new AquariumMaterial()));
			$materials = $materials_repo->findBy([]);

			$shapes_repo = new AquariumShape(new \PetFishCo\Backend\Models\Entities\AquariumShape());
			$shapes = $shapes_repo->findBy([]);

			$transformer = new \PetFishCo\Backend\Transformers\Aquarium();
			$data = $transformer->getAquarium($aquariums, $materials, $shapes);
		}

		return $data;
	}
}