<?php

namespace PetFishCo\Frontend\Controllers;

use PetFishCo\Frontend\Models\DTO\Aquarium;
use PetFishCo\Frontend\Models\DTO\AquariumInstance;
use PetFishCo\Frontend\Models\DTO\Fish;
use PetFishCo\Frontend\Models\Services\Shop as ShopService;
use PetFishCo\Frontend\Models\DTO\Shop;

class AquariumController extends BaseController {

	public function indexAction($aquarium_instance_id) {

		$this->view->setVar('shop', $this->getShop());
		$this->view->setVar('species', $this->shopService->getSpecies(true));

		//get aquarium fishes
		$response = $this->httpClient->get('aquarium_instance/' . $aquarium_instance_id . '/fishes');
		if($this->responseValidator->isSuccessfulResponse($response)){
			$fishes = $this->transformer->jsonToObject($response->body, new Fish());
			$this->view->setVar('fishes', $fishes);
		}else{
			$this->flashSession->error("Error fetching fishes data");
			return $this->dispatcher->forward(array(
				"controller" => 'aquariuminstance',
				"action" => 'index'
			));
		}

		//get aquarium data
		/**@var $response \Phalcon\Http\Client\Response*/
		$response = $this->httpClient->get('aquarium_instance/'.$aquarium_instance_id);

		$fail = true;
		if ($this->responseValidator->isSuccessfulResponse($response)) {
			$aquarium = $this->transformer->jsonToObject($response->body, new Aquarium());
			if (!empty($aquarium) && !empty($aquarium[0])) {
				$this->view->setVar('aquarium', $aquarium[0]);
				$fail = false;
			}
		}

		if ($fail) {
			$this->flashSession->error("Error fetching aquarium data");

			return $this->dispatcher->forward(array(
				"controller" => 'shop',
				"action" => 'index'
			));
		}

	}




}

