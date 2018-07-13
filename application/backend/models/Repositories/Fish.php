<?php
namespace PetFishCo\Backend\Models\Repositories;

use PetFishCo\Backend\Validators\Fish as FishValidator;

class Fish extends BaseRepository implements RestRepositoryInterface {


	/**
	 * @inheritdoc
	 */
	public function isValid(array $data) {

		if(!isset($data['aquarium_instance_id'])){
			$this->validationErrors[] = 'aquarium instance id required';
			return false;
		}

		if(!isset($data['fish_specie_id'])){
			$this->validationErrors[] = 'Fish specie required';
			return false;
		}

		if(!isset($data['fins'])){
			$this->validationErrors[] = 'Fins required.';
			return false;
		}


		$fins = $data['fins'];
		$fish_specie_id = $data['fish_specie_id'];
		$aquarium_instance_id = $data['aquarium_instance_id'];

		$validator = new FishValidator();
		if(!$validator->isCompatibleSpecieWithAquarium($fish_specie_id, $aquarium_instance_id)){
			$this->validationErrors[] = ' Conflict With Fish Specie: Goldfish don’t go with guppies.';
		}

		if(!$validator->isFinCountAllowedInAquarium($fins, $aquarium_instance_id)){
			$this->validationErrors[] = 'Conflict With Fish Fins Count: Fish with three fins or more don’t go in aquariums of 75 litres or less.';
		}

		return empty($this->validationErrors);

	}


}