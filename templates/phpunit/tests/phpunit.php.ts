<?php
namespace tests\#__PACKAGE_NAME__\#__CLASS_NAME__;

use business\#__PACKAGE_NAME__\#__CLASS_NAME__Business;
use \PHPUnit\Framework\TestCase;

class #__CLASS_NAME__Test extends TestCase
{
    /**
     * @var #__CLASS_NAME__Business
     */
    private $#__CLASS_NAME__Business;

    public function setup(): void
    {
        $this->#__CLASS_NAME__Business = new #__CLASS_NAME__Business();
    }

    /**
     * Featured public methods
     */

    #__PUBLIC_METHODS__
}
