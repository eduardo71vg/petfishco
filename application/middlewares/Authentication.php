<?php

use Core\Exceptions\ApiException;
use Core\Mvc\Plugin;

/**
 * Description of Authentication
 * @author minhaz.ahmed
 * @property Auth $auth Description
 * @property Validator $validator Description
 * 
 */
class Authentication extends Plugin {

    //Before executer route this hook will be executed to handle authontaction 
    public function beforeExecuteRoute()
    {
        //validate server IP address
        $this->auth->validateServerIpAddress();

        //Loging using besic auth
        $this->auth->doServiceUserLogin();

        $http_portal = $this->apiData->getHttpPortal();
        if ($http_portal === 'INTEGRATION_PORTAL') {

            $this->auth->validateServiceIpAddress();
        }
        elseif ($http_portal === 'HOSTED_PORTAL') {
            
        }
        elseif ($http_portal === 'MERCHANT_PORTAL') {
            
        }
        else {
            throw new ApiException('REQUEST_REJECTED', 1001005); // Invalid requestd portal
        }

        //now validate basic request before process data from request
        $this->requestValidator->validate('basic_request', NULL, 2);

        //Now validate the merchant  against service merchant reseller and service provider
        $this->auth->validateMerchant();

        //Validate permited operation type
        $this->auth->validateOperationType();
    }

}
