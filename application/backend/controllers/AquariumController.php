<?php
namespace PetFishCo\Backend\Controllers;

use PetFishCo\Backend\Models\Entities\AquariumMaterial as MaterialModel;
use PetFishCo\Backend\Models\Repositories\Aquarium;
use PetFishCo\Backend\Models\Entities\Aquarium as AquariumModel;
use PetFishCo\Backend\Models\Repositories\AquariumInstance;
use PetFishCo\Backend\Models\Repositories\AquariumShape;
use PetFishCo\Backend\Models\Entities\AquariumShape as ShapeModel;
use PetFishCo\Backend\Models\Repositories\AquariumMaterial;

class AquariumController extends AbstractController {

	/**
	 * @inheritdoc
	 */
	protected function initRepository() {
		$this->repository = new Aquarium(new AquariumModel());
	}

//	/**
//	 * Retrieve an element by id from a given repository
//	 *
//	 * @param int $id
//	 *
//	 * @return \Phalcon\Http\Response|\Phalcon\Http\ResponseInterface
//	 */
//	public function getAction($id) {
//
//		$aquariumInstance = $this->repository->findOne($id);
//		if(!$aquariumInstance){
//			return $this->respond('not_found');
//		}
//
//		$aquarium_service = new \PetFishCo\Backend\Models\Services\Aquarium();
//		$aquarium = $aquarium_service->getByInstanceId($id, $aquariumInstance);
//		if(empty($aquarium)){
//			return $this->respond('not_found');
//		}
//
//		return $this->respond('done', $aquarium);
//	}

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


}