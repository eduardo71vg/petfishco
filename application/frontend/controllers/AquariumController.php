<?php

namespace PetFishCo\Frontend\Controllers;

use PetFishCo\Frontend\Forms\AquariumForm;
use PetFishCo\Frontend\Helpers\UnitsConverter;
use PetFishCo\Frontend\Models\DTO\Aquarium;
use PetFishCo\Frontend\Models\DTO\AquariumInstance;
use PetFishCo\Frontend\Models\DTO\Fish;

/**
 * Class AquariumController
 * @package PetFishCo\Frontend\Controllers
 * @property \PetFishCo\Frontend\Models\Services\Aquarium $service
 */
class AquariumController extends BaseController {

	public function initialize() {
		parent::initialize();
		$this->service = new \PetFishCo\Frontend\Models\Services\Aquarium();
	}

	/**
	 * @param int $aquarium_instance_id
	 *
	 * @throws \PetFishCo\Core\Exceptions\AppException
	 */
	public function indexAction($shop_id, $aquarium_instance_id) {

		//get aquarium data
		$aquarium = $this->service->getAquariumData($aquarium_instance_id);
		if (empty($aquarium)) {
			$this->flashSession->error("Error fetching aquarium data");

			return $this->dispatcher->forward(array(
				"controller" => 'shop',
				"action" => 'index'
			));
		}
		$this->view->setVar('aquarium', $aquarium);

		//get aquarium fishes
		$fishes = $this->service->getFishes($aquarium_instance_id);
		$this->view->setVar('fishes', $fishes);
		$this->view->setVar('species', $this->shopService->getSpecies(true));
	}

	/**
	 * Prepares form for add an aquarium
	 *
	 * @param int $shop_id
	 * @param int $aquarium_id
	 */
	public function addAction($shop_id) {

		$this->view->form = new AquariumForm(null, array('edit' => false , 'shop' => $shop_id));
	}

	/**
	 * Edits an aquarium based on its id
	 */
	public function editAction($shop_id, $aquarium_id) {
		if (!$this->request->isPost()) {
			$aquarium_instance = $this->service->getAquariumData($aquarium_id);
			if (!$aquarium_instance) {
				$this->flashSession->error("Aquarium Instance was not found");
				return $this->response->redirect(
					[
						"for" => "shop-index",
						"id" => $shop_id,
					]
				);
			}

			$this->view->aquarium_instance = $aquarium_instance;
			$this->view->form = new AquariumForm($aquarium_instance, array('edit' => true , 'shop_id' => $shop_id));
			$this->view->shop = $this->getShop();
		}
	}

	/**
	 * Creates a new aquarium
	 */
	public function createAction() {
		if (!$this->request->isPost()) {
			return $this->dispatcher->forward(
				[
					"controller" => "shop",
					"action" => "index",
				]
			);
		}
		$form = new AquariumForm();
		$aquarium = new AquariumInstance();
		$data = $this->request->getPost();
		if (!$form->isValid($data, $aquarium)) {
			foreach ($form->getMessages() as $message) {
				$this->flashSession->error($message);
			}

			return $this->dispatcher->forward(
				[
					"controller" => "aquarium",
					"action" => "add",
				]
			);
		}
		$shop_id = $this->dispatcher->getParam('shop_id');
		$created = $this->service->createAquarium($data, $shop_id);

		if (!$created) {
			foreach ($this->service->getErrors() as $message) {
				$this->flashSession->error($message);
			}

			return $this->dispatcher->forward(
				[
					"controller" => "aquarium",
					"action" => "add",
				]
			);
		}
		$form->clear();
		$this->flashSession->success("Aquarium was created successfully");

		return $this->dispatcher->forward(
			[
				"controller" => "shop",
				"action" => "index",
			]
		);
	}

	/**
	 * Saves current aquarium in screen
	 *
	 * @param string $id
	 */
	public function updateAction($shop_id, $aquarium_id) {
		if (!$this->request->isPost()) {
			return $this->dispatcher->forward(
				[
					"controller" => "shop",
					"action" => "index",
				]
			);
		}
		$aquarium = $this->service->getAquariumData($aquarium_id);

		if (!$aquarium) {
			$this->flashSession->error("Aquarium does not exist");

			return $this->response->redirect(
				[
					"for" => "shop-index",
					"id" => $shop_id,
				]
			);
		}
		$form = new AquariumForm();
		$this->view->form = $form;
		$data = $this->request->getPost();


		if (!$form->isValid($data, $form)) {
			foreach ($form->getMessages() as $message) {
				$this->flashSession->error($message);
			}

			return $this->response->redirect(
				[
					"for" => "aquarium-edit",
					"shop_id" => $shop_id,
					"aquarium_id" => $aquarium_id,
				]
			);
		}

		$updated = $this->service->updateAquarium($data, $aquarium_id, $shop_id);
		if (!$updated) {
			foreach ($this->service->getErrors() as $message) {
				$this->flashSession->error($message);
			}

			return $this->response->redirect(
				[
					"for" => "aquarium-edit",
					"shop_id" => $shop_id,
					"aquarium_id" => $aquarium_id,
				]
			);
		}
		$form->clear();
		$this->flashSession->success("Aquarium was updated successfully");

		return $this->response->redirect(
			[
				"for" => "shop-index",
				"id" => $shop_id,
			]
		);
	}


}

