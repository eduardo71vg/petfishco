<?php

namespace PetFishCo\Backend\Controllers;

use PetFishCo\Backend\Models\Repositories\Fish;
use PetFishCo\Backend\Models\Entities\Fish as Model;
use PetFishCo\Backend\Models\Repositories\FishSpecie;
use PetFishCo\Backend\Models\Entities\FishSpecie as SpecieModel;

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

}