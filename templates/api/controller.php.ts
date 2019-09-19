<?php
namespace #__PACKAGE_NAME__\controllers;

use anytizer\guid;
use anytizer\sanitize;
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

    /**
     * Add
     *
     * @see ../api.php/src
     * @url {{url}}/#__PACKAGE_NAME__/#__CLASS_NAME__/add
     * @param $data=array()
     * @return array
     */
    public function post_add($data=array()): array
    {
        $response = null;

        //if($this->APIUser->can($this->role->method("add")))
        {
            $data=[
                #__INSERTS_SELECTED_PARAMS__
            ];

            $m = new model_#__CLASS_NAME__();
            $response = $m->add($data);
        }

        return $response;
    }

    #__PUBLIC_METHODS__
}
