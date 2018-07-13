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
			$this->flashSession->error("Error fetching shops data");
			$shops = [];
		}

		$this->view->setVar('shops', $shops);
	}

	public function notfoundAction(){

		$uri = $this->request->getURI();
		if(strpos($uri, 'api')){
			$this->response->setStatusCode('404');
			$this->response->setContent('Not Found');
			$this->response->send();
		}

		$this->view->pick('index/404');
	}

}

