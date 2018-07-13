<?php

namespace PetFishCo\Frontend\Controllers;

use PetFishCo\Frontend\Forms\FishForm;
use PetFishCo\Frontend\Models\DTO\Aquarium;
use PetFishCo\Frontend\Models\DTO\AquariumInstance;
use PetFishCo\Frontend\Models\DTO\Fish;
use PetFishCo\Frontend\Models\DTO\Shop;

/**
 * Class FishController
 * @package PetFishCo\Frontend\Controllers
 *
 * @property \PetFishCo\Frontend\Models\Services\Fish $service
 */
class FishController extends BaseController {

	public function initialize() {
		parent::initialize();
		$this->service = new \PetFishCo\Frontend\Models\Services\Fish();
	}

	/**
	 * Show fish details
	 *
	 * @param int $id
	 *
	 * @throws \PetFishCo\Core\Exceptions\AppException
	 */
	public function indexAction($id) {

		$fail = true;

		//get fish data
		$fish = $this->service->getFishData($id);
		if (!empty($fish)) {
			$this->view->setVar('fish', $fish[0]);
			$fail = false;
		}

		if ($fail) {
			return $this->dispatcher->forward(array(
				"controller" => 'index',
				"action" => 'notFound'
			));
		}
	}

	/**
	 * Prepares form for add a fish
	 *
	 * @param int $shop_id
	 * @param int $aquarium_id
	 */
	public function addAction($shop_id, $aquarium_id) {

		$this->view->aquarium_id = $aquarium_id;
		$this->view->form = new FishForm(null, array('edit' => true));

	}

	/**
	 * Edits a fish based on its id
	 */
	public function editAction($shop_id, $aquarium_id, $fish_id) {
		if (!$this->request->isPost()) {
			$fish = $this->service->getFishData($fish_id);
			if (!$fish) {
				$this->flashSession->error("Fish was not found");
				return $this->response->redirect(
					[
						"for" => "aquarium-index",
						"controller" => "aquarium",
						"shop_id" => $shop_id,
						"aquarium_id" => $aquarium_id,
					]
				);
			}

			$this->view->fish = $fish;
			$this->view->form = new FishForm($fish, array('edit' => true));
			$this->view->aquarium_id = $aquarium_id;
		}
	}

	/**
	 * Creates a new fish
	 */
	public function createAction() {
		if (!$this->request->isPost()) {
			return $this->dispatcher->forward(
				[
					"controller" => "aquarium",
					"action" => "index",
				]
			);
		}
		$form = new FishForm();
		$fish = new Fish();
		$data = $this->request->getPost();
		if (!$form->isValid($data, $fish)) {
			foreach ($form->getMessages() as $message) {
				$this->flashSession->error($message);
			}

			return $this->dispatcher->forward(
				[
					"controller" => "fish",
					"action" => "add",
				]
			);
		}
		$aquarium_instance_id = $this->dispatcher->getParam('aquarium_id');
		$shop_id = $this->dispatcher->getParam('shop_id');
		$created = $this->service->createFish($data, $aquarium_instance_id, $shop_id);

		if (!$created) {
			foreach ($this->service->getErrors() as $message) {
				$this->flashSession->error($message);
			}

			return $this->dispatcher->forward(
				[
					"controller" => "fish",
					"action" => "add",
				]
			);
		}
		$form->clear();
		$this->flashSession->success("Fish was created successfully");

		return $this->dispatcher->forward(
			[
				"controller" => "aquarium",
				"action" => "index",
			]
		);
	}

	/**
	 * Saves current fish in screen
	 *
	 * @param string $id
	 */
	public function updateAction($shop_id, $aquarium_id, $fish_id) {
		if (!$this->request->isPost()) {
			return $this->dispatcher->forward(
				[
					"controller" => "aquarium",
					"action" => "index",
				]
			);
		}
		$fish = $this->service->getFishData($fish_id);

		if (!$fish) {
			$this->flashSession->error("Fish does not exist");

			return $this->response->redirect(
				[
					"for" => "aquarium-index",
					"shop_id" => $shop_id,
					"aquarium_instance_id" => $aquarium_id,
				]
			);
		}
		$form = new FishForm();
		$this->view->form = $form;
		$data = $this->request->getPost();

		if (!$form->isValid($data, $form)) {
			foreach ($form->getMessages() as $message) {
				$this->flashSession->error($message);
			}

			return $this->response->redirect(
				[
					"for" => "fish-edit",
					"fish_id" => $fish_id,
					"shop_id" => $shop_id,
					"aquarium_id" => $aquarium_id,
				]
			);
		}

		$updated = $this->service->updateFish($data, $fish_id, $aquarium_id, $shop_id);
		if (!$updated) {
			foreach ($this->service->getErrors() as $message) {
				$this->flashSession->error($message);
			}

			return $this->response->redirect(
				[
					"for" => "fish-edit",
					"fish_id" => $fish_id,
					"shop_id" => $shop_id,
					"aquarium_id" => $aquarium_id,
				]
			);
		}
		$form->clear();
		$this->flashSession->success("Fish was updated successfully");

		return $this->response->redirect(
			[
				"for" => "aquarium-index",
				"shop_id" => $shop_id,
				"aquarium_instance_id" => $aquarium_id,
			]
		);
	}

}

