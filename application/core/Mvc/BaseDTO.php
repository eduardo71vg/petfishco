<?php

namespace PetFishCo\Core\Mvc;


class BaseDTO implements DTOInterface {

	/**
	 * Populates an Object from an array
	 *
	 * @param array $data
	 */
	public function populate(array $data){

		$insert_array = get_object_vars($this);

		foreach ($insert_array as $index => $value) {

			if (isset($data[$index])){
				$this->{$index} = $data[$index];
			}
		}
	}

//	public function populateWithJson($jsonData){
//
//		$data = json_decode($jsonData, true);
//		if(json_last_error()){
//
//		}
//	}
}