<?php
namespace PetFishCo\Middlewares;

use Core\Exceptions\ApiException;
use Phalcon\Events\Event;
use Phalcon\Mvc\Micro;
use Core\Http\Response\StatusCode;

/**
 * PhalconCore\Mvc\Plugin
 * This class allows to access services in the services container by just only accessing a public property
 * with the same name of a registered service
 *
 * @property \Core\Http\Request $request;
 * @property \Core\Http\Response $response;
 * @property \Core\Auth\Manager $authManager
 * @property \Core\Auth\TokenParser $tokenParser
 */
class NotFound extends \Phalcon\Mvc\User\Plugin {

    public function beforeNotFound(Event $event, Micro $app)
    {
    	/**@var $response \Phalcon\Http\Response*/
        $response = \Phalcon\Di::getDefault()->get('response');
	    $response->setStatusCode('404');
	    $response->setContent('Not Found');
	    $response->send();
        //throw new \PetFishCo\Core\Exceptions\AppException('Not Found');

    }

    public function __beforeExecuteRoute()
    {
        //echo 'This is before execute found';
    }

}
