<?php

//if(file_exists(APP_PATH . '/backend/Module.php')) echo 'hola';

/**@var $app \Phalcon\Mvc\Micro*/
$app->registerModules(
	[
		'frontend'  => [
			'className' => \PetFishCo\Frontend\Frontend::class,
			'path'      => APP_PATH . '/frontend/Frontend.php'
		],
		'backend' => [
			'className' => \PetFishCo\Backend\Backend::class,
			'path'      => APP_PATH . '/backend/Backend.php'
		]
	]
);
