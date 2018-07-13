<?php

/**@var $router \Phalcon\Mvc\Router*/
$router = $di->get('router');

//$router->setDefaultModule('backend');
//$router->setDefaultNamespace('PetFishCo\Backend\Controllers');
//$router->setDefaultController('index');
//$router->setDefaultAction('index');
//$router->removeExtraSlashes(true);

$router->notFound(
	[
		"module"     => "frontend",
		'controller' => 'index',
		'action'     => 'notfound',
		"namespace"  => "PetFishCo\Frontend\Controllers"
	]
);

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
($frontend_group->add(
	"/shop/{shop_id:([0-9]+)}/aquarium/{id:([0-9]+)}/edit",
	[
		"action" => "edit",
		"controller" => "Aquarium",
	]
))->setName('aquarium-edit');
($frontend_group->add(
	"/shop/{shop_id:([0-9]+)}/aquarium/{id:([0-9]+)}",
	[
		"action" => "index",
		"controller" => "Aquarium",
	]
))->setName('aquarium-index');
($frontend_group->add(
	"/shop/{shop_id:([0-9]+)}/aquarium/add",
	[
		"action" => "add",
		"controller" => "Aquarium",
		"id" => 1
	]
))->setName('aquarium-add');
/**
 * Fish
 */
($frontend_group->add(
	"/shop/{shop_id:([0-9]+)}/aquarium/{aquarium_id:([0-9]+)}/fish/add",
	[
		"action" => "add",
		"controller" => "Fish",
	]
))->setName('fish-add');
($frontend_group->add(
	"/shop/{shop_id:([0-9]+)}/aquarium/{aquarium_id:([0-9]+)}/fish/{fish_id:([0-9]+)}/update",
	[
		"action" => "update",
		"controller" => "Fish",
	]
))->setName('fish-update');
($frontend_group->add(
	"/shop/{shop_id:([0-9]+)}/aquarium/{aquarium_id:([0-9]+)}/fish/{fish_id:([0-9]+)}/edit",
	[
		"action" => "edit",
		"controller" => "Fish",
	]
))->setName('fish-edit');
($frontend_group->add(
	"/shop/{shop_id:([0-9]+)}/aquarium/{aquarium_id:([0-9]+)}/fish/create",
	[
		"action" => "create",
		"controller" => "Fish",
	]
))->setName('fish-create');

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
	"/aquarium_instance/{id:([0-9]+)}",
	[
		"action" => "get",
		"controller" => "aquariuminstance",
	]
);
// PUT aquarium update
$api_group->addPut(
	"/aquarium_instance/{id:([0-9]+)}",
	[
		"action" => "put",
		"controller" => "aquariuminstance",

	]
);
//POST aquarium add
$api_group->addPost(
	"/aquarium_instance",
	[
		"action" => "put",
		"controller" => "aquariuminstance",

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
	"/aquarium_instance/{aquarium_instance_id:([0-9]+)}/fishes",
	[
		"action" => "fishes",
		"controller" => "aquariuminstance",

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
$api_group->addPost(
	"/fish",
	[
		"action" => "add",
		"controller" => "fish",
	]
);
$api_group->addPut(
	"/fish/{id:([0-9]+)}",
	[
		"action" => "put",
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
	"/shop/{shop_id:([0-9]+)}/aquarium_instances",
	[
		"action" => "aquariums",
		"controller" => "shop",
	]
);


// Add the group to the router
$router->mount($api_group);



