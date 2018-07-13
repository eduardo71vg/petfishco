<?php
namespace PetFishCo\Backend\Controllers;

use PetFishCo\Backend\Models\Entities\AquariumMaterial as MaterialModel;
use PetFishCo\Backend\Models\Repositories\Aquarium;
use PetFishCo\Backend\Models\Entities\Aquarium as AquariumModel;
use PetFishCo\Backend\Models\Repositories\AquariumInstance;
use PetFishCo\Backend\Models\Repositories\AquariumShape;
use PetFishCo\Backend\Models\Entities\AquariumShape as ShapeModel;
use PetFishCo\Backend\Models\Repositories\AquariumMaterial;

class AquariumInstanceController extends AbstractController {

	/**
	 * @inheritdoc
	 */
	protected function initRepository() {
		$this->repository = new AquariumInstance(new \PetFishCo\Backend\Models\Entities\AquariumInstance());
	}

	/**
	 * Retrieve an element by id from a given repository
	 *
	 * @param int $id
	 *
	 * @return \Phalcon\Http\Response|\Phalcon\Http\ResponseInterface
	 */
	public function getAction($id) {

		$aquariumInstance = $this->repository->findOne($id);
		if (!$aquariumInstance) {
			return $this->respond('not_found');
		}

		$aquarium_service = new \PetFishCo\Backend\Models\Services\Aquarium();
		$aquarium = $aquarium_service->getByInstanceId($id, $aquariumInstance);
		if (empty($aquarium)) {
			return $this->respond('not_found');
		}

		return $this->respond('done', $aquarium);
	}

	/**
	 * GET /aquarium/{aquarium_id:([0-9]+)}/fishes
	 *
	 * @param $aquarium_id
	 */
	public function fishesAction($aquarium_id){

		if(empty($this->repository->findOne($aquarium_id))){
			$this->respond('not_found');
		}

		$service = new \PetFishCo\Backend\Models\Services\Aquarium();
		$data = $service->getFishes($aquarium_id);
		return $this->respond('done', $data);
	}


	/**
	 * @param $id
	 *
	 * @return null|\PetFishCo\Backend\Models\Repositories\Model|\Phalcon\Http\Response|\Phalcon\Http\ResponseInterface|void
	 */
	public function putAction($id, $respond = true) {

		$this->db->begin();

		/**@var $entity \PetFishCo\Backend\Models\Entities\AquariumInstance*/
		$entity = parent::putAction($id, false);

		if(!$entity){
			$this->db->rollback();
			return $this->respond('not_valid');
		}

		$this->db->commit();

		return $this->getAction($id);
	}



}