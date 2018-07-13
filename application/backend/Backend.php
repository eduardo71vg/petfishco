<?php

namespace PetFishCo\Backend;

use Phalcon\Logger\Adapter\File;
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
				'PetFishCo\Backend\Models\Repositories' => APP_PATH . '/backend/models/Repositories/',
				'PetFishCo\Backend\Helpers' => APP_PATH . '/backend/helpers/',
				'PetFishCo\Backend\Transformers' => APP_PATH . '/backend/transformers/',
				'PetFishCo\Backend\Validators' => APP_PATH . '/backend/validators/'
			]
		);
		$loader->registerClasses([

		]);
		$loader->register();
	}

	/**
	 * Registers the module-only services
	 *
	 * @param DiInterface $di
	 */
	public function registerServices(DiInterface $di) {

		$di->set('logger', function(){
			return new File(APP_PATH.'/logs/backend.log');
		});
	}
}