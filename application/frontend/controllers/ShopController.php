<?php

namespace PetFishCo\Frontend\Controllers;

use PetFishCo\Frontend\Models\DTO\Aquarium;
use PetFishCo\Frontend\Models\DTO\Shop;

class ShopController extends BaseController {

	public function indexAction($shop_id) {

				//get shop aquariums
		$response = $this->httpClient->get('shop/' . $shop_id . '/aquariums');
		if($this->responseValidator->isSuccessfulResponse($response)){
			$aquariums = $this->transformer->jsonToObject($response->body, new Aquarium());
			$this->view->setVar('aquariums', $aquariums);
		}else{
			$this->flash->error("Error fetching aquariums data");
		}

		//get shop data
		/**@var $response \Phalcon\Http\Client\Response*/
		$response = $this->httpClient->get('shop/'.$shop_id);

		if($this->responseValidator->isSuccessfulResponse($response)){
			$shop = $this->transformer->jsonToObject($response->body, new Shop());
			if(!empty($shop)){
				$this->view->setVar('shop', $shop[0]);
			}else{
				$this->flash->error("Error fetching shop data");
			}
		}else{
			$this->flash->error("Error fetching shop data");
		}

	}

	public function changeunitsAction(){
		//TODO put to update store units

		//TODO update shop data in session
	}

}

