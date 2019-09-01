<?php
namespace orm\#__PACKAGE_NAME__;

use orm\orm as orm;
use orm\database as database;
//use dtos\#__DTO_NAME__;

/**
 * Model: #__ORM_NAME__
 */
class #__ORM_NAME__ extends orm
{
    private $database;

    public function __construct()
    {
        parent::__construct();
        $this->database = new database();
    }

	// add, edit, delete, details, list, flag
	// do other query things()
    
    #__PUBLIC_METHODS__
}