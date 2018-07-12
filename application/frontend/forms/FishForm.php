<?php

namespace PetFishCo\Frontend\Forms;

use PetFishCo\Frontend\Models\Services\Shop;
use Phalcon\Forms\Form;

class FishForm extends Form {

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

		$alias = new Text("alias");
		$alias->setLabel("Alias");
		$alias->setFilters(['striptags', 'string']);
//		$alias->addValidators([
//			new PresenceOf([
//				'message' => 'Alias is required'
//			])
//		]);
		$this->add($alias);


		$color = new Text("color");
		$color->setLabel("Color");
		$color->setFilters(['striptags', 'string']);
//		$color->addValidators([
//			new PresenceOf([
//				'message' => 'Alias is required'
//			])
//		]);
		$this->add($color);

		$color = new Text("color");
		$color->setLabel("Color");
		$color->setFilters(['striptags', 'string']);
		//		$color->addValidators([
		//			new PresenceOf([
		//				'message' => 'Alias is required'
		//			])
		//		]);
		$this->add($color);


		$fins = new Text("fins");
		$fins->setLabel("Fins");
		$fins->setFilters(['striptags', 'int']);
		$fins->addValidators([
			new Numericality([
				'message' => 'Fins is required'
			])
		]);
		$this->add($fins);

		$shopService = new Shop();
		$species = $shopService->getSpecies();

		$type = new Select('fish_specie_id',$species, [
			'using' => ['id', 'name'],
			'useEmpty' => true,
			'emptyText' => '...',
			'emptyValue' => ''
		]);
		$type->setLabel('Specie');
		$this->add($type);


		$stock = new Text("stock");
		$stock->setLabel("Stock");
		$stock->setFilters(['int']);
		$stock->addValidators([
			new PresenceOf([
				'message' => 'Stock is required'
			]),
			new Numericality([
				'message' => 'Stock is required'
			])
		]);
		$this->add($stock);
	}
}