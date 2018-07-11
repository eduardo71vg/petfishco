<?php

namespace PetFishCo\Frontend\Controllers;

use PetFishCo\Frontend\Models\DTO\Aquarium;
use PetFishCo\Frontend\Models\Services\Shop as ShopService;
use PetFishCo\Frontend\Models\DTO\Shop;

class AquariumController extends BaseController {

	public function indexAction($aquarium_id) {

		//get shop aquariums
		$response = $this->httpClient->get('aquarium/' . $aquarium_id . '/fishes');
		if($this->responseValidator->isSuccessfulResponse($response)){
			$fishes = $this->transformer->jsonToObject($response->body, new Aquarium());
			$this->view->setVar('aquariums', $fishes);
		}else{
			$this->flashSession->error("Error fetching fishes data");
			echo ''
			return $this->dispatcher->forward(array(
				"controller" => $this->dispatcher->getLastController(),
				"action" => $this->dispatcher->getPreviousActionName()
			));
		}

		//get shop data
		/**@var $response \Phalcon\Http\Client\Response*/
		$response = $this->httpClient->get('aquarium/'.$aquarium_id);

		if($this->responseValidator->isSuccessfulResponse($response)){
			$aquarium = $this->transformer->jsonToObject($response->body, new Aquarium());
			if(!empty($aquarium)){
				$this->view->setVar('aquarium', $aquarium[0]);
			}else{
				$this->flashSession->error("Error fetching aquarium data");
				$this->response->redirect();
			}
		}else{
			$this->flashSession->error("Error fetching aquarium data");
			$this->response->redirect();
		}

	}

	public function addAction(){

	}

}

