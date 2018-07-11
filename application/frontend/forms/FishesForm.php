<?php

namespace PetFishCo\Frontend\Forms;

use Phalcon\Forms\Form;

class FishesForm extends Form {

	/**
	 * Initialize  form
	 *
	 * @param null  $entity
	 * @param array $options
	 */
	public function initialize($entity = null, $options = array()) {

		if (!isset($options['edit'])) {
			$element = new Text("id");
			$this->add($element->setLabel("Id"));
		} else {
			$this->add(new Hidden("id"));
		}

		$name = new Text("name");
		$name->setLabel("Name");
		$name->setFilters(['striptags', 'string']);
		$name->addValidators([
			new PresenceOf([
				'message' => 'Name is required'
			])
		]);
		$this->add($name);
		$type = new Select('product_types_id', ProductTypes::find(), [
			'using' => ['id', 'name'],
			'useEmpty' => true,
			'emptyText' => '...',
			'emptyValue' => ''
		]);
		$type->setLabel('Type');
		$this->add($type);
		$price = new Text("price");
		$price->setLabel("Price");
		$price->setFilters(['float']);
		$price->addValidators([
			new PresenceOf([
				'message' => 'Price is required'
			]),
			new Numericality([
				'message' => 'Price is required'
			])
		]);
		$this->add($price);
	}
}