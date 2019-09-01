<?php
namespace tests\#__PACKAGE_NAME__;

use business\#__PACKAGE_NAME__\#__CLASS_NAME__Business;
use \PHPUnit\Framework\TestCase;
use api\#__PACKAGE_NAME__\#__CLASS_NAME__API;

class #__CLASS_NAME__APITest extends TestCase
{
    /**
     * @var #__CLASS_NAME__API
     */
    private $#__CLASS_NAME__API;
    private $#__CLASS_NAME__Business;

    public function setup()
    {
        $this->#__CLASS_NAME__API = new #__CLASS_NAME__API();
        $this->#__CLASS_NAME__Business = new #__CLASS_NAME__Business();
    }

    /**
     * Featured public methods
     */

    #__PUBLIC_METHODS__
}
