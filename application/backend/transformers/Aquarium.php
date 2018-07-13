<?php

namespace PetFishCo\Backend\Transformers;


use PetFishCo\Core\Helpers\Formatter;
use PetFishCo\Backend\Models\Entities\AquariumMaterial;
use PetFishCo\Backend\Models\Entities\AquariumShape;
use Phalcon\Mvc\Model\Resultset\Simple;
use Phalcon\Mvc\User\Component;

class Aquarium extends Component {

	/**
	 * @param Simple $aquarium_with_instance_data
	 * @param Simple           $materials
	 * @param Simple           $shapes
	 *
	 * @return ResultInterface
	 * @throws \PetFishCo\Core\Exceptions\AppException
	 */
	public function getAquarium($aquarium_with_instance_data, $materials, $shapes) {

		/**@var $formatted_materials AquariumMaterial[] */
		$formatted_materials = Formatter::fromResultsetById($materials);
		/**@var $formatted_shapes AquariumShape[] */
		$formatted_shapes = Formatter::fromResultsetById($shapes);

		$results = [];
		foreach ($aquarium_with_instance_data as $index => $aquarium) {
			$new_aquarium = $aquarium->toArray();
			$new_aquarium['aquarium_material'] = $formatted_materials[$aquarium->aquarium_shape_id]->getName();
			$new_aquarium['aquarium_shape'] = $formatted_shapes[$aquarium->aquarium_material_id]->getName();
			$results[] = $new_aquarium;
		}

		return $results;

	}
}