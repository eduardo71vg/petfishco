<?php
namespace PetFishCo\Backend\Controllers;

use PetFishCo\Backend\Models\Entities\AquariumMaterial as MaterialModel;
use PetFishCo\Backend\Models\Repositories\Aquarium;
use PetFishCo\Backend\Models\Entities\Aquarium as Model;
use PetFishCo\Backend\Models\Repositories\AquariumShape;
use PetFishCo\Backend\Models\Entities\AquariumShape as ShapeModel;
use PetFishCo\Backend\Models\Repositories\AquariumMaterial;

class AquariumController extends AbstractController {

	/**
	 * @inheritdoc
	 */
	protected function initRepository() {
		$this->repository = new Aquarium(new Model());
	}

	/**
	 * Retrieve an element by id from a given repository
	 *
	 * @param int $id
	 *
	 * @return \Phalcon\Http\Response|\Phalcon\Http\ResponseInterface
	 */
	public function getAction($id) {

		$aquarium_service = new \PetFishCo\Backend\Models\Services\Aquarium();
		$aquarium = $aquarium_service->getById($id);
		if(!$aquarium){
			return $this->respond('not_found');
		}

		return $this->respond('done', $aquarium->toArray());
	}

	/**
	 * GET /aquarium/materials
	 */
	public function materialsAction(){

		$repository = new AquariumMaterial(new MaterialModel());

		return $this->allAction($repository);
	}

	/**
	 * GET /aquarium/shapes
	 */
	public function shapesAction(){

		$repository = new AquariumShape(new ShapeModel());

		return $this->allAction($repository);
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
		$this->respond('done', $data);
	}


}