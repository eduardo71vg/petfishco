<?php

namespace PetFishCo\Frontend\Models\Services;

use PetFishCo\Core\Mvc\BaseComponent;
use PetFishCo\Frontend\Components\Validators\ResponseValidator;
use PetFishCo\Frontend\Models\DTO\AquariumMaterial;
use PetFishCo\Frontend\Models\DTO\AquariumShape;
use PetFishCo\Frontend\Models\DTO\FishSpecie;
use Phalcon\Http\Client\Response;

/**
 * Class Shop
 * @package PetFishCo\Frontend\Models\Services
 *
 */
class Fish extends BaseComponent {

	/**
	 * @var array
	 */
	protected $errors;

	/**
	 * @var Response
	 */
	protected $backEndResponse;

	/**
	 * @return array
	 */
	public function getErrors() {
		return $this->errors;
	}

	/**
	 * @return Response
	 */
	public function getBackEndResponse() {
		return $this->backEndResponse;
	}


	/**
	 * @param array $data
	 * @param int   $aquarium_instance_id
	 * @param int   $shop_id
	 */
	public function createFish($data, $aquarium_instance_id, $shop_id) {

		$data['aquarium_instance_id'] = $aquarium_instance_id;
		$data['shop_id'] = $shop_id;
		$responseValidator = new ResponseValidator();
		$this->backEndResponse = $this->httpClient->post('fish', $data);
		if (!$responseValidator->isSuccessfulResponse($this->backEndResponse)) {
			$this->errors[] = $this->backEndResponse->body;

			return false;
		}

		return true;
	}

	/**
	 * @param array $data
	 * @param int   $fish_id
	 * @param int   $aquarium_instance_id
	 * @param int   $shop_id
	 */
	public function updateFish($data, $fish_id, $aquarium_instance_id, $shop_id) {

		$data['aquarium_instance_id'] = $aquarium_instance_id;
		$data['shop_id'] = $shop_id;
		if (!isset($data['id'])) {
			$data['id'] = $fish_id;
		}

		$responseValidator = new ResponseValidator();
		$this->backEndResponse = $this->httpClient->put('fish/'.$fish_id, $data);
		if (!$responseValidator->isSuccessfulResponse($this->backEndResponse)) {
			$this->errors[] = $this->backEndResponse->body;

			return false;
		}

		return true;
	}


	/**
	 * @param int $id
	 *
	 * @return Fish|false
	 * @throws \PetFishCo\Core\Exceptions\AppException
	 */
	public function getFishData($id) {

		$fish = false;
		$responseValidator = new ResponseValidator();
		/**@var $response \Phalcon\Http\Client\Response */
		$this->backEndResponse = $this->httpClient->get('fish/' . $id);
		if ($responseValidator->isSuccessfulResponse($this->backEndResponse)) {
			$fish = $this->transformer->jsonToObject($this->backEndResponse->body, new \PetFishCo\Frontend\Models\DTO\Fish());
		}

		return $fish[0];
	}
}