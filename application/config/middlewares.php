<?php


$eventsManager = $di->get('eventsManager');
/**
 * NotFound handler
 */
$eventsManager->attach('micro', new \PetFishCo\Middlewares\NotFound());