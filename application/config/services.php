<?php

//use Phalcon\Mvc\View\Simple as View;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\DI\FactoryDefault;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Logger\Adapter\File as FileLogger;
use Phalcon\Events\Manager as EventsManager;

$di = new FactoryDefault();

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di['url'] = function () use ($config) {
    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);
    return $url;
};

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di['db'] = function () use ($config) {

	$eventsManager = new EventsManager();

	$logger = new FileLogger(APP_PATH.'/logs/sql.log');

	// Listen all the database events
	$eventsManager->attach(
		'db:beforeQuery',
		function ($event, $connection) use ($logger) {
			$logger->log(
				$connection->getSQLStatement(),
				\Phalcon\Logger::INFO
			);
		}
	);

	$connection = new DbAdapter($config->database->toArray());

	// Assign the eventsManager to the db adapter instance
	$connection->setEventsManager($eventsManager);

	return $connection;
};

$di['router'] = function () {
	return new Phalcon\Mvc\Router(false);
};

/**
 * Sets the view component
 */
$di->set('view', function() {
	return new \Phalcon\Mvc\View();
}, true);

$di->setShared('config', $config);

if($config->get('environment') == 'local'){
	$debug = new \Phalcon\Debug();
	$debug->listen();
}
