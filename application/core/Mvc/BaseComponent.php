<?php
/**
 * Created by PhpStorm.
 * User: eduardohernandez
 * Date: 11/07/2018
 * Time: 08:38
 */

namespace PetFishCo\Core\Mvc;
use Phalcon\Mvc\User\Component;
use Phalcon\Session\Adapter\Database;

/**
 * Class BaseComponent
 * @package PetFishCo\Core\Mvc
 *
 * @property Phalcon\Http\Client\Provider\Curl $httpClient
 * @property Config $config
 * @property Transformer $transformer
 * @property Database $session
 */
class BaseComponent extends Component {

}