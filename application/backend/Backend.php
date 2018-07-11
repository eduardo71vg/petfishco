<?php

namespace PetFishCo\Backend;

use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\DiInterface;
use Phalcon\Loader;


class Backend implements ModuleDefinitionInterface {

	/**
	 * Registers the module auto-loader
	 *
	 * @param DiInterface $di
	 */
	public function registerAutoloaders(DiInterface $di = null) {

		$loader = new Loader();
		$loader->registerNamespaces(
			[
				'PetFishCo\Backend\Controllers' => APP_PATH . '/backend/controllers/',
				'PetFishCo\Backend\Models\Entities' => APP_PATH . '/backend/models/Entities/',
				'PetFishCo\Backend\Models\Services' => APP_PATH . '/backend/models/Services/',
				'PetFishCo\Backend\Models\Repositories' => APP_PATH . '/backend/models/Repositories/'
			]
		);
		$loader->register();
	}

	/**
	 * Registers the module-only services
	 *
	 * @param DiInterface $di
	 */
	public function registerServices(DiInterface $di) {


//		$eventsManager = $di->get(ServicesConst::EVENTS_MANAGER);
//
//		/**
//		 * NotFound handler
//		 */
//		$eventsManager->attach('micro', new NotFound);
//		//$eventsManager->attach('micro', new \Core\Middleware\BeforeHandleRoute);
//		//AUTH REMOVE for test
//
//		/**
//		 * Authenticate user
//		 */
//		$eventsManager->attach('micro', new Authentication);
//
//		/**
//		 * Listen all the database events
//		 */
//		$eventsManager->attach('db', new DbQuery);

//		/**
//		 * Read configuration
//		 */
//		$config = include __DIR__ . "/../../config/config.php";
//
//		/**
//		 * Setting up the view component
//		 */
//		$di['view'] = function () {
//			$view = new View();
//			$view->setViewsDir(__DIR__ . '/views/');
//
//			return $view;
//		};
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