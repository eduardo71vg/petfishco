<?php
namespace PetFishCo\Middlewares;
use Phalcon\Logger\Adapter\File;

/**
 * Description of DbQuery
 *
 * @property \Core\Logger\Logger    $logger Description
 * @property \Core\Services\ApiData $apiData Description
 * @property \Phalcon\Db\Profiler   $dbProfiler
 */
class DbQuery extends \Phalcon\Mvc\User\Plugin {

	/**
	 *
	 * @param type                $event
	 * @param \Phalcon\Db\Adapter $connection
	 */
	public function afterQuery($event, $connection) {
		if ($this->config->dbProfiler === 1) {
			$this->dbProfiler->stopProfile();

			//Get the last profile in the profiler
			$profile = $this->dbProfiler->getLastProfile();

			$query = $profile->getSQLStatement();

			$variables = $connection->getSQLVariables();


			if (is_array($variables)) {
				foreach ($variables as $key => $val) {
					$query = str_replace(':' . $key, "'$val'", $query);
				}

				$query = vsprintf($query, $variables);
			}

			$_profile = "SQL Statement: " . $query . chr(13);
			if (is_array($variables)) {
				$_profile .= "SQL Variables: " . implode(", ", $variables) . chr(13);
			}
			//$_profile .= "Start Time: " . $profile->getInitialTime() . chr(13);
			//$_profile .= "Final Time: " . $profile->getFinalTime() . chr(13);
			$_profile .= "Total Query Time: " . $profile->getTotalElapsedSeconds() . chr(13);

			$logger = new File(APP_PATH.'/logs/sql.log');
			$logger->debug($_profile);
		}
	}

	public function beforeQuery($event, $connection) {
		if ($this->config->dbProfiler === 1) {
			$sql_query = $connection->getRealSQLStatement();
			$this->dbProfiler->startProfile($sql_query);
		}
	}

}
