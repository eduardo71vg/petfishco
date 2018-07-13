<?php

namespace PetFishCo\Core\Mvc;


interface DTOInterface {

	/**
	 * Populates an Object from an array
	 *
	 * @param array $data
	 */
	public function populate(array $data);
}