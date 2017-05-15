<?php
namespace business;

use dtos\#__PACKAGE_NAME__\#__DTO_NAME__;
use orm\#__PACKAGE_NAME__\#__ORM_NAME__;
use business\business;

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
	
	/**
	 * @todo
	 * add, edit, delete, details, list, flag -- reusable as standards
	 * do other query things()
	 */

    #__PUBLIC_METHODS__
}
