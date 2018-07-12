<?php

namespace PetFishCo\Core\Mvc;
use Phalcon\Mvc\Model;
use Phalcon\Paginator\Adapter\QueryBuilder;


/**
 * Class AbstractRepository
 *
 * @package App\Repositories
 */
class BaseRepository implements RestRepositoryInterface {


	/**
	 * @var array
	 */
	protected $defaultSearchCriteria;

	/**
	 * Name of the Model with absolute namespace
	 *
	 * @var string
	 */
	protected $modelName;

	/**
	 * Instance that extends Model
	 *
	 * @var Model
	 */
	protected $model;

	/**
	 * AbstractRepository constructor.
	 *
	 * @param Model $model
	 */
	public function __construct(\Phalcon\Mvc\ModelInterface $model) {
		$this->model = $model;
		$this->defaultSearchCriteria = [
			'per_page' => 20,
			'page' => 1
		];
	}

	/**
	 * Get Model instance
	 *
	 * @return Model
	 */
	public function getModel() {
		return $this->model;
	}

	/**
	 * @inheritdoc
	 */
	public function findOne($id) {
		return $this->findOneBy(['id = :id:', 'bind' => ['id' => $id]]);
	}

	/**
	 * @inheritdoc
	 */
	public function findOneBy(array $criteria) {
		return ($this->model)::findFirst($criteria);
	}

	/**
	 * @inheritdoc
	 */
	public function findBy(array $searchCriteria = []) {

		$searchCriteria = array_merge($this->defaultSearchCriteria, $searchCriteria);
		$limit = $searchCriteria['per_page'];
		$currentPage = $searchCriteria['page'];

		$query = ($this->model)::query()->createBuilder()->where('deleted = 0');

		if(isset($searchCriteria['columns'])){
			$query->columns($searchCriteria['columns']);
		}

		$queryBuilder = $this->applySearchCriteriaInQueryBuilder($query, $searchCriteria);

		// Get the paginated results
		$page = $this->paginate($queryBuilder, $limit, $currentPage);
		$rows = $page->items; //->toArray();
		return $rows;
	}

	/**
	 * Paginate Results
	 *
	 * @param Model\Query\Builder $queryBuilder
	 * @param int $limit
	 * @param int $currentPage
	 *
	 * @return \stdClass
	 */
	public function paginate($queryBuilder, $limit = 20, $currentPage = 0){
		$paginator = new QueryBuilder(
			[
				"builder"  => $queryBuilder,
				"limit" => $limit,
				"page"  => $currentPage,
			]
		);

		// Get the paginated results
		return $paginator->getPaginate();
	}

	/**
	 * Apply condition on query builder based on search criteria
	 *
	 * @param Model\Criteria $queryBuilder
	 * @param array  $searchCriteria
	 *
	 * @return Model\Query\BuilderInterface
	 */
	protected function applySearchCriteriaInQueryBuilder($queryBuilder, array $searchCriteria = []) {
		$conditions_count = 0;

		foreach ($searchCriteria as $key => $value) {
			//skip pagination related query params
			if (in_array($key, ['page', 'per_page'])) {
				continue;
			}
			//we can pass multiple params for a filter with commas
			$allValues = explode(',', $value);
			if (count($allValues) > 1) {
				$queryBuilder->inWhere($key, $allValues);
			} else {

				$operator = '=';
				$condition = "$key $operator :$key:";
				$bindParameters = [
					$key => $value
				];

				if($conditions_count){
					$queryBuilder->andWhere($condition, $bindParameters);
				}else{
					$queryBuilder->where($condition, $bindParameters);
				}
			}
		}

		return $queryBuilder;
	}

	/**
	 * @inheritdoc
	 */
	public function save(array $data) {
		// generate uid
		$data['uid'] = Uuid::uuid4();

		return $this->model->create($data);
	}

	/**
	 * @inheritdoc
	 */
	public function update(\Phalcon\Mvc\ModelInterface $model, array $data) {
		$fillAbleProperties = $this->model->getFillable();
		foreach ($data as $key => $value) {
			// update only fillAble properties
			if (in_array($key, $fillAbleProperties)) {
				$model->$key = $value;
			}
		}
		// update the model
		$model->save();
		// get updated model from database
		$model = $this->findOne($model->uid);

		return $model;
	}

	/**
	 * @inheritdoc
	 */
	public function findIn($key, array $values) {
		return $this->model->whereIn($key, $values)->get();
	}

	/**
	 * @inheritdoc
	 */
	public function delete(\Phalcon\Mvc\ModelInterface $model) {
		return $model->delete();
	}

	/**
	 * get loggedIn user
	 *
	 * @return User
	 */
	protected function getLoggedInUser() {
		$user = \Auth::user();
		if ($user instanceof User) {
			return $user;
		} else {
			return new User();
		}
	}
}