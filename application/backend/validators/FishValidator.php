<?php
namespace PetFishCo\Backend\Validators;

use \PetFishCo\Backend\Models\Services\Aquarium as AquariumService;

class FishValidator {

	const SPECIE_GUPPIE = 1;

	const SPECIE_GOLDFISH = 2;

	/**
	 * @var AquariumService
	 */
	protected $aquariumService;

	/**
	 * FishValidator constructor.
	 *
	 * @param \PetFishCo\Backend\Models\Services\Aquarium $aquariumService
	 */
	public function __construct($aquariumService = null) {
		if(is_null($aquariumService)){
			$this->aquariumService = new AquariumService();
		}else{
			$this->aquariumService = $aquariumService;
		}
	}

	/**
	 * @param int $specie_id
	 * @param int $aquarium_instance_id
	 *
	 * @return bool
	 */
	public function isCompatibleSpecieWithAquarium($specie_id, $aquarium_instance_id){

		//if the specie does not have conflicts
		if($specie_id != self::SPECIE_GOLDFISH && $specie_id != self::SPECIE_GUPPIE){
			return true;
		}

		//get aquarium species
		$species = $this->aquariumService->getSpecies($aquarium_instance_id);
		if(empty($species)){
			return true;
		}

		//Goldfish don’t go with guppies.
		if($specie_id == self::SPECIE_GOLDFISH && in_array(self::SPECIE_GUPPIE, $species) ||
			$specie_id == self::SPECIE_GUPPIE && in_array(self::SPECIE_GOLDFISH, $species)){
			return false;
		}

		return true;
	}

	/**
	 * @param int $fins
	 * @param int $aquarium_instance_id
	 *
	 * @return bool
	 */
	public function isFinCountAllowedInAquarium($fins , $aquarium_instance_id){

		//Fish with three fins or more don’t go in aquariums of 75 litres or less.
		if($fins < 3){
			return true;
		}

		$allowed = true;

		// get aquarium capacity
		$capacity = $this->aquariumService->getAquariumCapacity($aquarium_instance_id);
		if ($capacity <= 75 && $fins >= 3) {
			$allowed = false;
		}

		return $allowed;
	}
}