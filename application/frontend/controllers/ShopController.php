<?php

namespace PetFishCo\Frontend\Controllers;

use PetFishCo\Frontend\Models\DTO\Aquarium;
use PetFishCo\Frontend\Models\DTO\AquariumInstance;
use PetFishCo\Frontend\Models\DTO\Shop;

class ShopController extends BaseController {

	public function indexAction($shop_id) {

		$fail = true;

		//get shop data
		/**@var $response \Phalcon\Http\Client\Response*/
		$response = $this->httpClient->get('shop/'.$shop_id);
		if($this->responseValidator->isSuccessfulResponse($response)){
			$shop = $this->transformer->jsonToObject($response->body, new Shop());
			if(!empty($shop)){
				$this->view->setVar('shop', $shop[0]);
				$this->session->set('shop', $shop[0]);
				$fail = false;
			}
		}

		if ($fail) {
			return $this->dispatcher->forward(array(
				"controller" => 'index',
				"action" => 'notFound'
			));
		}

		//get shop aquariums
		$response = $this->httpClient->get('shop/' . $shop_id . '/aquarium_instances');
		if($this->responseValidator->isSuccessfulResponse($response)){
			$aquariums = $this->transformer->jsonToObject($response->body, new AquariumInstance());
			$this->view->setVar('aquariums', $aquariums);
			$fail= false;
		}

		if ($fail) {
			$this->flashSession->error("Error fetching aquariums data");
//			return $this->dispatcher->forward(array(
//				"controller" => 'shop',
//				"action" => 'index'
//			));
		}

	}

	public function changeunitsAction(){
		//TODO put to update store units

		//TODO update shop data in session
	}

}

