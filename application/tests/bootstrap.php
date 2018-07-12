<?php
//$config = include __DIR__ . "/config.php";
//include __DIR__ . "/loader.php";
//$di = new \Phalcon\DI\FactoryDefault();
//include __DIR__ . "/services.php";
//
//return new \Phalcon\Mvc\Application($di);


defined('APP_PATH') || define('APP_PATH', realpath('..'));
defined('IS_UNIT_TEST') || define('IS_UNIT_TEST', true);

codecept_debug(APP_PATH);
/**
 * Composer autoload
 */
include __DIR__ . '/../vendor/autoload.php';

/**
 * Environment variables
 */
$dotenv = new Dotenv\Dotenv(__DIR__ . '/../');
$dotenv->load();

/**
 * Read the configuration
 */

/** @var $config \Phalcon\Config */
$config = include __DIR__ . "/../config/config.php";
$config['environment'] = getenv('APP_ENV');


/**
 * Include Autoloader
 */
include __DIR__ . '/../config/loader.php';

/**
 * Include Services
 */
//include __DIR__ . '/../config/services.php';
$di = new \Phalcon\DI\FactoryDefault();
/**
 * Starting the application
 * Assign service locator to the application
 */
$app = new \Phalcon\Mvc\Application($di);

/**
 * Include modules
 */
//include __DIR__ . '/../config/modules.php';

$loader->registerNamespaces(
	[
		'PetFishCo\Backend\Controllers' => __DIR__ . '/../backend/controllers/',
		'PetFishCo\Backend\Models\Entities' => __DIR__ . '/../backend/models/Entities/',
		'PetFishCo\Backend\Models\Services' => __DIR__ . '/../backend/models/Services/',
		'PetFishCo\Backend\Models\Repositories' => __DIR__ . '/../backend/models/Repositories/',
		'PetFishCo\Backend\Helpers' => __DIR__ . '/../backend/helpers/',
		'PetFishCo\Backend\Transformers' => __DIR__ . '/../backend/transformers/',
		'PetFishCo\Backend\Validators' => __DIR__ . '/../backend/validators/'
	]
);
/**
 * Include Application
 */
//include __DIR__ . '/../config/routes.php';

return $app;