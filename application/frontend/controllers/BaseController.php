<?php

namespace PetFishCo\Frontend\Controllers;

use PetFishCo\Frontend\Components\Validators\ResponseValidator;
use PetFishCo\Frontend\Components\Transformer;
use Phalcon\Config;
use Phalcon\Flash;
use Phalcon\Mvc\Controller;
use PetFishCo\Frontend\Models\Services\Shop as ShopService;

/**
 * Class BaseController
 * @package PetFishCo\Frontend\Controllers
 *
 * @property Phalcon\Http\Client\Provider\Curl $httpClient
 * @property Config $config
 * @property Transformer $transformer
 * @property Flash\Direct $flash
 * @property Flash\Session $flashSession
 */
class BaseController extends Controller{

	/**
	 * @var ResponseValidator
	 */
	protected $responseValidator;

	public function initialize(){
		$this->responseValidator = new ResponseValidator();


		//TODO check if session has catalogs
		//load options material, shapes , species
		$shopService = new ShopService();
		$shopService->retrieveCatalogs();

		//store in sessions to avoid retrieve them every single time
		//$shopService->storeInSession();
	}
}
