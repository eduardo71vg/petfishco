<?php

namespace PetFishCo\Core\Mvc;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Behavior\Timestampable;

class BaseModel extends Model {

	/**
	 * Handle Insert Timestamp
	 */
	public function beforeCreate()
	{
		$this->created_at = date("Y-m-d H:i:s");
	}

	/**
	 * Handle Update Timestamp
	 */
	public function beforeUpdate()
	{
		$this->updated_at = date("Y-m-d H:i:s");
	}

	/**
	 * Handle Soft Delete
	 */
	public function initialize() {
		$this->addBehavior(new SoftDelete(
			array(
				'field' => 'deleted',
				'value' => 0
			)
		));
	}
}