<?php
namespace #__PACKAGE_NAME__\controllers;

use system\abstracts\api_abstracts;
use system\abstracts\api_interface;

use #__PACKAGE_NAME__\models\model_#__CLASS_NAME__;

/**
 * Endpoints for landing #__CLASS_NAME__
 */
class controller_#__CLASS_NAME__ extends api_abstracts implements api_interface
{
    public function __construct()
    {
        //$this->role = new role();
        //$this->APIUser = new APIUser();
        
        //parent::__construct();
    }

    #__PUBLIC_METHODS__
}
