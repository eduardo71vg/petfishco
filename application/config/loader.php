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
		'PetFishCo\Core\Helpers' => APP_PATH . '/core/Helpers',
	]
);
$loader->registerClasses(
	[
		'NotFound' => APP_PATH.'/middlewares/NotFound.php',
	]
);

$loader->register();
