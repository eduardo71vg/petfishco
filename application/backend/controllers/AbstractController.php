<?php

namespace PetFishCo\Backend\Controllers;

use PetFishCo\Core\Mvc\RestRepositoryInterface;
use Phalcon\Mvc\Controller;

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

		return $this->respond('done', $data);
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
		if (is_null($model)) {
			return $this->respond('not_found');
		}

		return $this->respond('done', $model);
	}

	/**
	 * @param Request $request
	 *
	 * @return \Phalcon\Http\Response|\Phalcon\Http\ResponseInterface
	 * @todo
	 */
	public function addAction(Request $request) {
		$m = self::MODEL;
		$this->validate($request, $m::$rules);

		return $this->respond('created', $m::create($request->all()));
	}

	public function putAction(Request $request, $id) {

		//TODO validate
		//$this->validate($request, $m::$rules);
		$model = $this->repository->findOne($id);
		if (is_null($model)) {
			return $this->respond('not_found');
		}
		$model->update($request->all());

		return $this->respond('done', $model);
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
		if (is_null($model)) {
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