<?php

/**
 * Registering an autoloader
 */
$loader = new \Phalcon\Loader();

$loader->registerNamespaces(
	[
		"PetFishCo\Core" => APP_PATH . "/core",
		'Phalcon\Http' => APP_PATH . '/Phalcon/Http',
		'PetFishCo\Middlewares' => APP_PATH . '/middlewares',

		//"PetFishCo\Core\Backend" => APP_PATH."/backend"

	]
);
$loader->registerClasses(
	[
		'NotFound' => APP_PATH.'/middlewares/NotFound.php',
		//'Phalcon\Http' => APP_PATH.'/Phalcon/Http/',
		//'IndexController'         => APP_PATH.'/backend/controllers/IndexController.php',
		//'AquariumController'         => APP_PATH.'/backend/controllers/AquariumController.php',
		//'Example\Base' => 'vendor/example/adapters/Example/BaseClass.php',
	]
);

$loader->register();
//$loader->registerDirs(
//    array(
//        $config->application->modelsDir
//    )
//)->register();
