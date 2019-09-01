<?php
namespace business\#__PACKAGE_NAME__;

use dtos\#__PACKAGE_NAME__\#__DTO_NAME__;
use orm\#__PACKAGE_NAME__\#__ORM_NAME__;
use business\business;

use \Exception;

/**
 * Business Entity [#__BUSINESS_NAME__]
 */
class #__BUSINESS_NAME__ extends business
{
    private $#__ORM_NAME__;

    public function __construct()
    {
        parent::__construct();
        $this->#__ORM_NAME__ = new #__ORM_NAME__();
    }
	
	public function __set($name, $value)
	{
                throw new Exception("Cannot add new property \${$name} to instance of " . __CLASS__);
    }
	
	public function __get($name)
	{
		throw new Exception("Invalid access \${$name} to instance of " . __CLASS__);
    }
	
	/**
	 * @todo
	 * add, edit, delete, details, list, flag -- reusable as standards
	 * do other query things()
	 */

    #__PUBLIC_METHODS__
}
