<?php

namespace PetFishCo\Frontend\Components\Validators;


use Phalcon\Http\Client\Response;

class ResponseValidator {

	/**
	 * @param Response $response
	 *
	 * @return bool
	 */
	public function isSuccessfulResponse(Response $response){

		$success = false;
		if($response &&
			isset($response->header) &&
			isset($response->header->statusCode) &&
			$response->header->statusCode == 200 &&
			!empty($response->body))
		{
			$success = true;
		}
		return $success;
	}
}