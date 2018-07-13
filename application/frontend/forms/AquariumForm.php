<?php

namespace PetFishCo\Frontend\Forms;

use PetFishCo\Frontend\Models\Services\Shop;
use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\Numericality;
use Phalcon\Validation\Validator\PresenceOf;

class AquariumForm extends Form {

	/**
	 * Initialize  form
	 *
	 * @param null  $entity
	 * @param array $options
	 */
	public function initialize($entity = null, $options = array()) {

		$is_edit_mode = (isset($options['edit']) && $options['edit'] == true);
		if (!isset($options['edit'])) {
			$element = new Text("id");
			$this->add($element->setLabel("Id"));
		} else {
			$this->add(new Hidden("id"));
		}

		$shop_id = $options['shop_id'];
		$shop = new Hidden("shop_id");
		$shop->setAttribute('value', $shop_id);
		$this->add($shop);

		$capacity = new Text("capacity");
		$capacity->setLabel("Capacity (Liters) ");
		$capacity->setFilters(['striptags', 'int']);
		$capacity->addValidators([
			new PresenceOf([
				'message' => 'Capacity is required'
			]),
			new Numericality([
				'message' => 'Capacity should be a number'
			])
		]);
		if($is_edit_mode){
			$capacity->setAttribute('readonly', 'readonly');
		}
		$this->add($capacity);

		$shopService = new Shop();
		$materials = $shopService->getMaterials();
		$shapes = $shopService->getShapes();

		$material = new Select('aquarium_material_id', null, [
			'useEmpty' => true,
			'emptyText' => '...',
			'emptyValue' => ''
		]);
		/**@var $m \PetFishCo\Frontend\Models\DTO\AquariumMaterial*/
		foreach ($materials as $index => $m) {
			$material->addOption([$m->getId() => $m->getName()]);
		}
		$material->setLabel('Material');
		if($is_edit_mode){
			$material->setAttribute('disabled', 'disabled');
		}
		$this->add($material);

		$shape = new Select('aquarium_shape_id', null, [
			'useEmpty' => true,
			'emptyText' => '...',
			'emptyValue' => ''
		]);
		/**@var $s \PetFishCo\Frontend\Models\DTO\AquariumShape*/
		foreach ($shapes as $index => $s) {
			$shape->addOption([$s->getId() => $s->getName()]);
		}
		$shape->setLabel('Shape');
		if($is_edit_mode){
			$shape->setAttribute('disabled', 'disabled');
		}
		$this->add($shape);

		$amount = new Text("amount");
		$amount->setLabel("Amount");
		$amount->setFilters(['int']);
		$amount->addValidators([
			new PresenceOf([
				'message' => 'amount is required'
			]),
			new Numericality([
				'message' => 'amount should be a number'
			])
		]);
		$this->add($amount);

		$entity = null;
	}
}