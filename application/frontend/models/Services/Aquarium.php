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
class Aquarium extends BaseComponent {

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
	 * @param int   $shop_id
	 */
	public function createAquarium($data, $shop_id) {

		$data['shop_id'] = $shop_id;
		$responseValidator = new ResponseValidator();
		$this->backEndResponse = $this->httpClient->post('aquarium', $data);
		if (!$responseValidator->isSuccessfulResponse($this->backEndResponse)) {
			$this->errors[] = $this->backEndResponse->body;

			return false;
		}

		return true;
	}

	/**
	 * @param array $data
	 * @param int   $aquarium_instance_id
	 * @param int   $shop_id
	 */
	public function updateAquarium($data, $aquarium_instance_id, $shop_id) {

		$data['shop_id'] = $shop_id;
		if (!isset($data['id'])) {
			$data['aquarium_instance_id'] = $aquarium_instance_id;
		}

		$responseValidator = new ResponseValidator();
		$this->backEndResponse = $this->httpClient->put('aquarium_instance/'.$aquarium_instance_id, $data);

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
	public function getAquariumData($id) {

		$aquarium = false;
		$responseValidator = new ResponseValidator();
		/**@var $response \Phalcon\Http\Client\Response */
		$this->backEndResponse = $this->httpClient->get('aquarium_instance/' . $id);
		if ($responseValidator->isSuccessfulResponse($this->backEndResponse)) {
			$aquarium = $this->transformer->jsonToObject($this->backEndResponse->body, new \PetFishCo\Frontend\Models\DTO\Aquarium());
		}

		return $aquarium[0];
	}

	/**
	 * @param int $aquarium_instance_id
	 *
	 * @return array
	 */
	public function getFishes($aquarium_instance_id) {
		$fishes = [];
		$this->backEndResponse = $this->httpClient->get('aquarium_instance/' . $aquarium_instance_id . '/fishes');
		$responseValidator = new ResponseValidator();
		if ($responseValidator->isSuccessfulResponse($this->backEndResponse)) {
			$fishes = $this->transformer->jsonToObject($this->backEndResponse->body, new \PetFishCo\Frontend\Models\DTO\Fish());
		}

		return $fishes;
	}
}