<?php

namespace PetFishCo\Backend\Controllers;

use PetFishCo\Backend\Models\Repositories\RestRepositoryInterface;
use Phalcon\Http\Request;
use Phalcon\Logger\Adapter\File;
use Phalcon\Mvc\Controller;
use Phalcon\Mvc\ModelInterface;

/**
 * Class AbstractController
 * @package PetFishCo\Backend\Controllers
 *
 * @property File $logger
 */
abstract class AbstractController extends Controller {

	protected $statusCodes = [
		'done' => 200,
		'created' => 201,
		'removed' => 204,
		'not_valid' => 400,
		'not_found' => 404,
		'conflict' => 409,
		'permissions' => 401
	];


	/**
	 * @var RestRepositoryInterface
	 */
	protected $repository;

	/**
	 * Initialize de repository
	 *
	 * @return mixed
	 */
	protected abstract function initRepository();

	public function beforeExecuteRoute($dispatcher){

		$data = [];
		if($this->request->isPost()){
			$data = $this->request->getPost();
		}
		if($this->request->isPut()){
			$data = $this->request->getPut();
		}
		$this->logger->debug(\json_encode($data));
		$this->logger->debug($this->request->getURI());
	}


	public function initialize()
	{
		$this->initRepository();
	}

	/**
	 * Retrieve paginated results for a given repository
	 *
	 * @param RestRepositoryInterface|null $repository
	 *
	 * @return \Phalcon\Http\Response|\Phalcon\Http\ResponseInterface
	 */
	public function allAction(RestRepositoryInterface $repository = null) {

		if($repository){
			$data = $repository->findBy();
		}else{
			$data = $this->repository->findBy();
		}

		return $this->respond('done', $data->toArray());
	}

	/**
	 * Retrieve an element by id from a given repository
	 *
	 * @param int $id
	 *
	 * @return \Phalcon\Http\Response|\Phalcon\Http\ResponseInterface
	 */
	public function getAction($id) {

		$model = $this->repository->findOne($id);
		if (empty($model)) {
			return $this->respond('not_found');
		}

		return $this->respond('done', $model);
	}

	/**
	 * @param bool $respond
	 *
	 * @return bool|\PetFishCo\Backend\Models\Repositories\Model|\Phalcon\Http\Response|\Phalcon\Http\ResponseInterface
	 */
	public function addAction($respond = true) {

		$data = $this->request->getPost();

		//validate
		if(!$this->repository->isValid($data)){
			$valid = false;
			if($respond) {
				return $this->respond('not_valid', $this->repository->getValidationErrors());
			}
			return false;
		}

		//save
		$errors = [];
		$entity = $this->repository->save($data);

		if($respond) {
			if ($entity) {
				$response = $this->respond('created', $entity->toArray());
			} else {
				$response = $this->respond('not_valid', $errors);
			}
		}else{
			$response = $entity;
		}

		return $response;
	}

	/**
	 * @param int    $id
	 * @param bool $respond whether or not the method will reply
	 *
	 * @return bool|\Phalcon\Http\Response|\Phalcon\Http\ResponseInterface|ModelInterface
	 */
	public function putAction($id, $respond = true) {

		$data = $this->request->getPut();

		//validate
		if(!$this->repository->isValid($data)){
			$valid = false;
			if($respond) {
				return $this->respond('not_valid', $this->repository->getValidationErrors());
			}
			return false;
		}

		//fetch model to update
		/**@var $model ModelInterface*/
		$model = $this->repository->findOne($id);

		if (empty($model) && $respond) {
			return $this->respond('not_found');
		}

		if($model) {
			//update
			if(!$model->update($data)) {
				if ($respond) {
					return $this->respond('not_valid');
				}
				$model = false;
			}
		}

		if($respond) {
			return $this->respond('done', $model);
		}
		return $model;
	}

	/**
	 * Handle delete request for a model by id
	 *
	 * @param int $id
	 *
	 * @return \Phalcon\Http\Response|\Phalcon\Http\ResponseInterface
	 */
	public function removeAction($id) {
		$model = $this->repository->findOne($id);
		if (empty($model)) {
			return $this->respond('not_found');
		}
		$this->repository->delete($model);

		return $this->respond('removed');
	}

	/**
	 * Create json response
	 *
	 * @param string $status
	 * @param array $data
	 *
	 * @return \Phalcon\Http\Response|\Phalcon\Http\ResponseInterface
	 */
	protected function respond($status, $data = []) {

		if($this->view){
			$this->view->disable();
		}

		return $this->response
			->setStatusCode($this->statusCodes[$status])
			->setJsonContent($data, JSON_UNESCAPED_UNICODE);

	}
}