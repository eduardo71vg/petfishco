<?php

namespace PetFishCo\Frontend\Controllers;

use PetFishCo\Frontend\Models\DTO\Shop;


class IndexController extends BaseController {

	public function indexAction() {

		//get shop shops data
		/**@var $response \Phalcon\Http\Client\Response*/
		$response = $this->httpClient->get('shops');

		if($this->responseValidator->isSuccessfulResponse($response)){
			$shops = $this->transformer->jsonToObject($response->body, new Shop());
		}else{
			$this->flash->error("Error fetching shops data");
			$shops = [];
		}

		$this->view->setVar('shops', $shops);
	}

}

