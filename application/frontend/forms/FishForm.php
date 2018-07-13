<?php

namespace PetFishCo\Frontend\Forms;

use PetFishCo\Frontend\Models\Services\Shop;
use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Select;
use Phalcon\Mvc\Model\Resultset\Simple;
use Phalcon\Validation\Validator\Numericality;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;

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
		$alias->addValidators([
			new PresenceOf([
				'message' => 'Alias is required'
			]),
			new StringLength([
				"max"            => 45,
				"min"            => 2,
				"messageMaximum" => "We don't like really long names",
				"messageMinimum" => "We want more than just their initials",
			])
		]);
		$this->add($alias);


		$color = new Text("color");
		$color->setLabel("Color");
		$color->setFilters(['striptags', 'string']);
		$color->addValidators([
			new StringLength([
				"max"            => 45,
				"messageMaximum" => "We don't like really long color names",
			])
		]);
		$this->add($color);


		$fins = new Text("fins");
		$fins->setLabel("Fins");
		$fins->setFilters(['striptags', 'int']);
		$fins->addValidators([
			new PresenceOf([
				'message' => 'Fins count is required'
			]),
			new Numericality([
				'message' => 'Fins should be a number'
			])
		]);
		$this->add($fins);

		$shopService = new Shop();
		$species = $shopService->getSpecies();

		$type = new Select('fish_specie_id', null, [
			//'using' => [ $species['id'] => $species['name']],
			'useEmpty' => true,
			'emptyText' => '...',
			'emptyValue' => ''
		]);

		/**@var $specie \PetFishCo\Frontend\Models\DTO\FishSpecie*/
		foreach ($species as $index => $specie) {
			$type->addOption([$specie->getId() => $specie->getName()]);
		}
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
				'message' => 'Stock should be a number'
			])
		]);
		$this->add($stock);

		$entity = null;
	}
}