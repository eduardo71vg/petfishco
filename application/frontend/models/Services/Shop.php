<?php
namespace PetFishCo\Frontend\Models\Services;

use PetFishCo\Core\Mvc\BaseComponent;
use PetFishCo\Frontend\Components\Validators\ResponseValidator;
use PetFishCo\Frontend\Models\DTO\AquariumMaterial;
use PetFishCo\Frontend\Models\DTO\AquariumShape;
use PetFishCo\Frontend\Models\DTO\FishSpecie;

/**
 * Class Shop
 * @package PetFishCo\Frontend\Models\Services
 *
 */
class Shop extends BaseComponent {

	/**
	 * @var AquariumShape[]|[]
	 */
	protected $shapes;

	/**
	 * @var AquariumMaterial[]|[]
	 */
	protected $materials;

	/**
	 * @var FishSpecie[]|[]
	 */
	protected $species;

	/**
	 * @return AquariumShape[]
	 */
	public function getShapes() {
		if(empty($this->shapes)){
			if(!$this->retrieveCatalogsFromSession()){
				$this->retrieveCatalogs();
				$this->storeInSession();
			}
		}
		return $this->shapes;
	}

	/**
	 * @return AquariumMaterial[]
	 */
	public function getMaterials() {
		if(empty($this->materials)){
			if(!$this->retrieveCatalogsFromSession()){
				$this->retrieveCatalogs();
				$this->storeInSession();
			}
		}
		return $this->materials;
	}

	/**
	 * @return FishSpecie[]
	 */
	public function getSpecies() {

		if(empty($this->species)){
			if(!$this->retrieveCatalogsFromSession()){
				$this->retrieveCatalogs();
				$this->storeInSession();
			}
		}

		return $this->species;
	}


	/**
	 * Set up catalogs data
	 */
	public function retrieveCatalogs(){

		$responseValidator =  new ResponseValidator();
		$response = $this->httpClient->get('aquarium/shapes');
		if($responseValidator->isSuccessfulResponse($response)){
			$this->shapes = $this->transformer->jsonToObject($response->body, new AquariumShape());
		}else{
			throw new AppException('Unable to get Aquarium Shapes Data');
		}

		$response = $this->httpClient->get('aquarium/materials');
		if($responseValidator->isSuccessfulResponse($response)){
			$this->materials = $this->transformer->jsonToObject($response->body, new AquariumMaterial());
		}else{
			throw new AppException('Unable to get Aquarium Materials Data');
		}

		$response = $this->httpClient->get('fish/species');
		if($responseValidator->isSuccessfulResponse($response)){
			$this->species = $this->transformer->jsonToObject($response->body, new FishSpecie());
		}else{
			throw new AppException('Unable to get Fishes Species Data');
		}
	}

	/**
	 * @return bool
	 */
	protected function retrieveCatalogsFromSession(){

		if($this->sessionHasCatalogs()){

			$catalogs = $this->session->get('catalogs');
			$this->species = $catalogs['species'];
			$this->shapes = $catalogs['shapes'];
			$this->materials = $catalogs['materials'];
			return true;
		}
		return false;
	}

	/**
	 * Stores Catalogs data in session
	 */
	public function storeInSession(){
		$value = [
			'materials' => $this->materials,
			'shapes' => $this->shapes,
			'species' => $this->species,
		];
		$this->session->set('catalogs', $value);
	}

	/**
	 * @return bool
	 */
	public function sessionHasCatalogs(){
		return $this->session->has('catalogs');
	}
}