<?php

namespace PetFishCo\Core\Mvc;
use Phalcon\Http\Client\Provider\Curl;
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
 */
class BaseComponent extends Component {

}