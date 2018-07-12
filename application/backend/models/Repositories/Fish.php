<?php
namespace PetFishCo\Backend\Models\Repositories;


use PetFishCo\Backend\Validators\FishValidator;

class Fish extends BaseRepository implements RestRepositoryInterface {


	/**
	 * @inheritdoc
	 */
	public function isValid(array $data) {

		if(!isset($data['aquarium_instance_id'])){
			return false;
		}

		if(!isset($data['fish_specie_id'])){
			return false;
		}

		if(!isset($data['fins'])){
			return false;
		}

		$fins = $data['fins'];
		$fish_specie_id = $data['fish_specie_id'];
		$aquarium_instance_id = $data['aquarium_instance_id'];

		$validator = new FishValidator();
		if(!$validator->isCompatibleSpecieWithAquarium($fish_specie_id, $aquarium_instance_id)){
			$this->validationErrors[] = ' Conflict With Fish Specie: Guppies and GoldFish are not allowed in the same aquarium';
		}

		if(!$validator->isFinCountAllowedInAquarium($fins, $aquarium_instance_id)){
			$this->validationErrors[] = 'Conflict With Fish Fins Count: Fishes with 3 or less fins are not allowed in aquariums with 75 or less liters';
		}

		return empty($this->validationErrors);

	}


}