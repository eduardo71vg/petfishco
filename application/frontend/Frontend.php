<?php

namespace PetFishCo\Frontend;

use PetFishCo\Frontend\Components\Transformer;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\DiInterface;
use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Session\Adapter\Database;
use Phalcon\Db\Adapter\Pdo\Mysql;
use Phalcon\Http\Client\Request;
use Phalcon\Flash\Direct as FlashDirect;
use Phalcon\Flash\Session as FlashSession;



class Frontend implements ModuleDefinitionInterface {

	/**
	 * Registers the module auto-loader
	 *
	 * @param DiInterface $di
	 */
	public function registerAutoloaders(DiInterface $di = null) {

		$loader = new Loader();
		$loader->registerNamespaces(
			[
				'PetFishCo\Frontend\Controllers' => APP_PATH . '/frontend/controllers/',
				'PetFishCo\Frontend\Models\DTO' => APP_PATH . '/frontend/models/DTO/',
				'PetFishCo\Frontend\Models\Services' => APP_PATH . '/frontend/models/services/',
				'PetFishCo\Frontend\Components' => APP_PATH . '/frontend/components/',
				'PetFishCo\Frontend\Helpers' => APP_PATH . '/frontend/helpers/',
				'PetFishCo\Frontend\Forms' => APP_PATH . '/frontend/forms/',
			]
		);
		$loader->registerClasses([
			'Phalcon\Session\Adapter\Database' => APP_PATH . '/Phalcon/Session/Adapter/Database.php'
		]);
		$loader->register();
	}

	/**
	 * Registers the module-only services
	 *
	 * @param DiInterface $di
	 */
	public function registerServices(DiInterface $di) {

		//		/**
//		 * Read configuration
//		 */
//		$config = include __DIR__ . "/../../config/config.php";
//
		$config = $di->getShared('config');

		/**
		 * Setting up the view component
		 */
		$di['view'] = function () {
			$view = new View();
			$view->setViewsDir(__DIR__ . '/views/');
			$view->setPartialsDir(__DIR__ . "/views/partials/");
			return $view;
		};

		$di['session'] = function () use($di, $config) {

			// Create a connection
			$connection = new Mysql([
				'host'     => $config->database->host,
				'username' => $config->database->username,
				'password' => $config->database->password,
				'dbname'   => $config->database->dbname
			]);


			$session = new Database([
				'db'    => $connection,
				'table' => 'session_data'
			]);

			$session->start();

			return $session;
		};

		$di['httpClient'] = function() use($config){
			$httpClient = Request::getProvider();
			$httpClient->setBaseUri($config->api->base_url);
			$httpClient->header->set('Accept', 'application/json');
			return $httpClient;
		};

		$di['transformer'] = function() {
			return new Transformer();
		};

		// Set up the flash service
		$di->set(
			"flash",
			function () {
				return new FlashDirect(
					[
						"error"   => "alert alert-danger",
						"success" => "alert alert-success",
						"notice"  => "alert alert-info",
						"warning" => "alert alert-warning",
					]
				);
			}
		);

		// Set up the flash session service
		$di->set(
			"flashSession",
			function () {
				return new FlashSession(
					[
						"error"   => "alert alert-danger",
						"success" => "alert alert-success",
						"notice"  => "alert alert-info",
						"warning" => "alert alert-warning",
					]
				);
			}
		);
//
//		/**
//		 * Database connection is created based in the parameters defined in the configuration file
//		 */
//		$di['db'] = function () use ($config) {
//			return new DbAdapter(
//				[
//					"host" => $config->database->host,
//					"username" => $config->database->username,
//					"password" => $config->database->password,
//					"dbname" => $config->database->dbname
//				]
//			);
//		};
	}
}