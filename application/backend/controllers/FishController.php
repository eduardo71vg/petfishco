<?php

namespace PetFishCo\Backend\Controllers;

use PetFishCo\Backend\Models\Entities\AquariumHasFish;
use PetFishCo\Backend\Models\Repositories\Aquarium;
use PetFishCo\Backend\Models\Repositories\Fish;
use PetFishCo\Backend\Models\Entities\Fish as Model;
use PetFishCo\Backend\Models\Repositories\FishSpecie;
use PetFishCo\Backend\Models\Entities\FishSpecie as SpecieModel;
use Phalcon\Http\Request;

class FishController extends AbstractController {

	/**
	 * @inheritdoc
	 */
	protected function initRepository() {
		$this->repository = new Fish(new Model());
	}

	/**
	 * GET /fish/species
	 */
	public function speciesAction(){

		$repository = new FishSpecie(new SpecieModel());

		return $this->allAction($repository);
	}

	/**
	 * POST /fish
	 *
	 * @return \Phalcon\Http\Response|\Phalcon\Http\ResponseInterface
	 */
	public function addAction($respond = true) {

		$this->db->begin();

		/**@var $entity \PetFishCo\Backend\Models\Entities\Fish*/
		$entity = parent::addAction(false);

		$data = $this->request->getPost();
		$data['fish_id'] = $entity->id;

		// store the relationship
		$aquariumHasFish = new AquariumHasFish();
		$result = $aquariumHasFish->create($data);

		if ($result === false) {
			$this->db->rollback();

			return $this->respond('not_valid');
		}

		$this->db->commit();

		return $this->respond('created' , $entity->toArray() );
	}

	/**
	 * @param int $id
	 *
	 * @return \Phalcon\Http\Response|\Phalcon\Http\ResponseInterface
	 */
	public function getAction($id) {
		$fish = (new \PetFishCo\Backend\Models\Services\Fish())->getById($id);

		if ($fish === false) {
			return $this->respond('not_valid');
		}

		return $this->respond('done', $fish[0]->toArray());
	}


	/**
	 * @param $id
	 *
	 * @return null|\PetFishCo\Backend\Models\Repositories\Model|\Phalcon\Http\Response|\Phalcon\Http\ResponseInterface|void
	 */
	public function putAction($id, $respond = true) {

		$this->db->begin();

		$entity = parent::putAction($id, false);

		$data = $this->request->getPut();
		$data['fish_id'] = $entity->id;

		// update the relationship
		/**@var $aquariumHasFish \PetFishCo\Backend\Models\Entities\Aquarium*/
		$aquariumHasFish = (new \PetFishCo\Backend\Models\Services\AquariumHasFish())
			->getByShopFishAndAqInstance($entity->id, $data['shop_id'], $data['aquarium_instance_id']);

		if (!$aquariumHasFish) {
			$this->db->rollback();

			return $this->respond('not_valid');
		}

		$result = $aquariumHasFish->update($data);

		if ($result === false) {
			$this->db->rollback();

			return $this->respond('not_valid');
		}

		$this->db->commit();

		return $this->getAction($id);
	}


}