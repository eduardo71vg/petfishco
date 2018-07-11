<?php

namespace PetFishCo\Backend\Controllers;

use PetFishCo\Backend\Models\Entities\Shop as ShopModel;
use PetFishCo\Backend\Models\Repositories\Shop;

class ShopController extends AbstractController {

	/**
	 * @inheritdoc
	 */
	protected function initRepository() {
		$this->repository = new Shop(new ShopModel());
	}

	/**
	 * GET /shop/{shop_id:([0-9]+)}/aquariums
	 *
	 * @param int $shop_id
	 */
	public function aquariumsAction($shop_id){

		if(empty($this->repository->findOne($shop_id))){
			$this->respond('not_found');
		}

		$service = new \PetFishCo\Backend\Models\Services\Shop();
		$data = $service->getAquariums($shop_id);
		return $this->respond('done', $data);
	}


}