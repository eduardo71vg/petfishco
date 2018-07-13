<?php

namespace PetFishCo\Core\Mvc;
use Phalcon\Http\Client\Provider\Curl;
use Phalcon\Logger\Adapter\File;
use Phalcon\Mvc\User\Component;
use Phalcon\Session\Adapter\Database;

/**
 * Class BaseComponent
 * @package PetFishCo\Core\Mvc
 *
 * @property Curl $httpClient
 * @property Config $config
 * @property Transformer $transformer
 * @property Database $session
 * @property File $logger
 */
class BaseComponent extends Component {

}