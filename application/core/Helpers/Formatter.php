<?php
namespace PetFishCo\Backend\Helpers;

use PetFishCo\Core\Exceptions\AppException;
use Phalcon\Mvc\Model\ResultInterface;
use Phalcon\Mvc\Model\Resultset\Simple;

class Formatter {

	/**
	 * @param array $elements
	 * @param string $field_name
	 *
	 * @return array
	 * @throws \PetFishCo\Core\Exceptions\AppException
	 */
	public static function fromArrayByFieldName($elements, $field_name) {

		if (!isset($elements[0][$field_name])) {
			throw new AppException('Field name not found in array elements');
		}

		$results = [];
		foreach ($elements as $index => $item) {
			$results[$item[$field_name]] = $item;
		}

		return $results;

	}

	/**
	 * @param Simple $elements
	 *
	 * @return array
	 * @throws \PetFishCo\Core\Exceptions\AppException
	 */
	public static function fromResultsetById($elements) {

		if (!($elements[0]->toArray())['id']) {
			throw new AppException('Field name not found in array elements');
		}

		$results = [];
		foreach ($elements as $index => $item) {
			$results[$item->getId()] = $item;
		}

		return $results;

	}
}