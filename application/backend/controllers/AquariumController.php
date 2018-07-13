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

	/**
	 * @param bool $respond
	 *
	 * @return bool|\PetFishCo\Backend\Models\Repositories\Model|\Phalcon\Http\Response|\Phalcon\Http\ResponseInterface
	 */
	public function addAction($respond = true) {

		$this->db->begin();

		/**@var $entity \PetFishCo\Backend\Models\Entities\Aquarium*/
		$entity = parent::addAction(false);
		if(empty($entity)){
			$errors = $this->repository->getValidationErrors();
			return $this->respond('not_valid', [$errors]);
		}

		$data = $this->request->getPost();
		$data['aquarium_id'] = $entity->id;

		// store instance
		$aquariumHasInstance = new \PetFishCo\Backend\Models\Entities\AquariumInstance();
		$result = $aquariumHasInstance->create($data);

		if ($result === false) {
			$this->db->rollback();

			return $this->respond('not_valid');
		}

		$this->db->commit();

		return $this->respond('created' , $entity->toArray() );
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


}