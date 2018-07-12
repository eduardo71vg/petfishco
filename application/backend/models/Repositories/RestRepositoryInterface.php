<?php
namespace PetFishCo\Core\Mvc;

/**
 * Interface RepositoryInterface
 *
 * @package App\Repositories
 */
interface RestRepositoryInterface {
	/**
	 * Find a resource by id
	 *
	 * @param $id
	 *
	 * @return Model|null
	 */
	public function findOne($id);

	/**
	 * Find a resource by criteria
	 *
	 * @param array $criteria
	 *
	 * @return Model|null
	 */
	public function findOneBy(array $criteria);

	/**
	 * Search All resources by criteria
	 *
	 * @param array $searchCriteria
	 *
	 * @return Collection
	 */
	public function findBy(array $searchCriteria = []);

	/**
	 * Search All resources by any values of a key
	 *
	 * @param string $key
	 * @param array  $values
	 *
	 * @return Collection
	 */
	public function findIn($key, array $values);

	/**
	 * Save a resource
	 *
	 * @param array $data
	 *
	 * @return Model
	 */
	public function save(array $data);

	/**
	 * Update a resource
	 *
	 * @param Model $model
	 * @param array $data
	 *
	 * @return Model
	 */
	public function update(\Phalcon\Mvc\ModelInterface $model, array $data);

	/**
	 * Delete a resource
	 *
	 * @param Model $model
	 *
	 * @return mixed
	 */
	public function delete(\Phalcon\Mvc\ModelInterface $model);
}