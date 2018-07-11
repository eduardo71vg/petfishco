<?php


error_reporting(E_ALL);

define('APP_PATH', realpath('..'));

try {

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
     * Include Services
     */
    include APP_PATH . '/config/services.php';

    /**
     * Include Autoloader
     */
    include APP_PATH . '/config/loader.php';

    /**
     * Starting the application
     * Assign service locator to the application
     */
    $app = new \Phalcon\Mvc\Application($di);

	/**
	 * Include modules
	 */
	include APP_PATH . '/config/modules.php';

    /**
     * Include Application
     */
    include APP_PATH . '/config/routes.php';


//$dispatcher = $di["dispatcher"];
//try {
//	// Dispatch the request
//	$dispatcher->dispatch();
//} catch (Exception $e) {
//	// An exception has occurred, dispatch some controller/action aimed for that
//	echo '<pre>';
//	print_r($e);exit;
//	// Pass the processed router parameters to the dispatcher
//	$dispatcher->setControllerName("errors");
//	$dispatcher->setActionName("action503");
//
//	// Dispatch the request
//	$dispatcher->dispatch();
//}

	 /**
     * Handle the request
     */
	$response = $app->handle();

	$response->send();

} catch (\Exception $e) {
    echo $e->getMessage();
    throw $e;
}
