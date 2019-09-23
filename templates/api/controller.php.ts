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
     * @param $data=[]
     * @return array
     */
    public function post_add($data=[]): array
    {
        $response = [
            "success" => false,
            "message" => "",
        ];

        // $this->role->method("add")
        if($this->APIUser()->can("#__PACKAGE_NAME__", "#__CLASS_NAME__", "add"))
        {
            /**
            $business = new business();
            if($business->save("#__PACKAGE_NAME__", "#__CLASS_NAME__", "add"))
             {
                $business->notify();
             }
             // send email
             // format message
             // generate database error log message with error code
             // call to apis, and notification urls
            */
            $data=[
                #__INSERTS_SELECTED_PARAMS__
            ];

            $m = new model_#__CLASS_NAME__();
            $response["success"] = $m->add($data);
        }

        return $response;
    }

    #__PUBLIC_METHODS__
}
