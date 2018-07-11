<?php

/**@var $router \Phalcon\Mvc\Router*/
$router = $di->get('router');

//$router->setDefaultModule('backend');
//$router->setDefaultNamespace('PetFishCo\Backend\Controllers');
//$router->setDefaultController('index');
//$router->setDefaultAction('index');
//$router->removeExtraSlashes(true);

//$router->notFound(
//	[
//		'controller' => 'index',
//		'action'     => 'notFoundAction',
//	]
//);

/**
 * Front end
 */
$frontend_group = new \Phalcon\Mvc\Router\Group(
	[
		"module"     => "frontend",
		"namespace"  => "PetFishCo\Frontend\Controllers"
	]
);
//home
$frontend_group->add(
	"/",
	[
		"action" => "index",
		"controller" => "Index",
	]
);
$frontend_group->add(
	"/shop/{id:([0-9]+)}",
	[
		"action" => "index",
		"controller" => "Shop",
		"id" => 1
	]
);
/**
 * Aquarium
 */
$frontend_group->add(
	"/aquarium/{id:([0-9]+)}/edit",
	[
		"action" => "edit",
		"controller" => "Aquarium",
		"id" => 1
	]
);
$frontend_group->add(
	"/aquarium/{id:([0-9]+)}",
	[
		"action" => "index",
		"controller" => "Aquarium",
		"id" => 1
	]
);
$frontend_group->add(
	"/aquarium/add",
	[
		"action" => "add",
		"controller" => "Aquarium",
		"id" => 1
	]
);
$router->mount($frontend_group);


/**
 * Back end
 */
$api_group = new \Phalcon\Mvc\Router\Group(
	[
		"module"     => "backend",
		"namespace"  => "PetFishCo\Backend\Controllers"
	]
);

$api_group->setPrefix("/api");

/**
 * Acquarium
 */
// GET aquarium list
$api_group->addGet(
	"/aquariums",
	[
		"action" => "all",
		"controller" => "aquarium",

	]
);
// GET aquarium single
$api_group->addGet(
	"/aquarium/{id:([0-9]+)}",
	[
		"action" => "get",
		"controller" => "aquarium",
	]
);
// PUT aquarium update
$api_group->addPut(
	"/aquarium/{id:([0-9]+)}",
	[
		"action" => "put",
		"controller" => "aquarium",

	]
);
//POST aquarium add
$api_group->addPost(
	"/aquarium",
	[
		"action" => "put",
		"controller" => "aquarium",

	]
);
$api_group->addGet(
	"/aquarium/shapes",
	[
		"action" => "shapes",
		"controller" => "aquarium",

	]
);
$api_group->addGet(
	"/aquarium/materials",
	[
		"action" => "materials",
		"controller" => "aquarium",

	]
);
$api_group->addGet(
	"/aquarium/{aquarium_id:([0-9]+)}/fishes",
	[
		"action" => "fishes",
		"controller" => "aquarium",

	]
);
/**
 * Fish
 */
//GET species
$api_group->addGet(
	"/fish/species",
	[
		"action" => "species",
		"controller" => "fish",
	]
);

// GET fish single
$api_group->addGet(
	"/fish/{id:([0-9]+)}",
	[
		"action" => "get",
		"controller" => "fish",
	]
);
/**
 * SHOP
 */
$api_group->addGet(
	"/shops",
	[
		"action" => "all",
		"controller" => "shop",
	]
);
$api_group->addGet(
	"/shop/{id:([0-9]+)}",
	[
		"action" => "get",
		"controller" => "shop",
	]
);
$api_group->addGet(
	"/shop/{shop_id:([0-9]+)}/aquariums",
	[
		"action" => "aquariums",
		"controller" => "shop",
	]
);


// Add the group to the router
$router->mount($api_group);



