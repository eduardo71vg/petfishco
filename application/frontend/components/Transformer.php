<?php

namespace PetFishCo\Frontend\Components;

use PetFishCo\Core\Exceptions\AppException;
use PetFishCo\Core\Mvc\DTOInterface;
use Phalcon\Mvc\User\Component;

/**
 * Class Transformer
 *
 * @package PetFishCo\Frontend\Services
 */
class Transformer extends Component {

	/**
	 * Converts Json to an array of DTO
	 *
	 * @param string       $jsonData
	 * @param DTOInterface $dto
	 *
	 * @return DTOInterface[]
	 * @throws AppException
	 */
	public function jsonToObject($jsonData, DTOInterface $dto){

		$results = [];

		$class_name = get_class($dto);
		$data = json_decode($jsonData, true);
		if(json_last_error()){
			throw new AppException('Failed Transforming Data '. $class_name . ' '. json_last_error_msg());
		}

		if(empty($data)){
			return $results;
		}

		if (isset($data[0]) && is_array($data[0])) {
			foreach ($data as $index => $datum) {
				$object = new $class_name;
				$object->populate($datum);
				$results[] = $object;
			}
		} else {
			$object = new $class_name;
			$object->populate($data);
			$results[] = $object;
		}

		return $results;
	}
}