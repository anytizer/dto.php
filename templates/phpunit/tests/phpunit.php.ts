<?php
namespace tests\#__PACKAGE_NAME__;

use business\#__PACKAGE_NAME__\#__CLASS_NAME__Business;
use \PHPUnit\Framework\TestCase;

class #__CLASS_NAME__Test extends TestCase
{
    /**
     * @var #__CLASS_NAME__Business
     */
	private $#__CLASS_NAME__Business;

	public function setup()
	{
		$this->#__CLASS_NAME__Business = new #__CLASS_NAME__Business();
	}

	#__PUBLIC_METHODS__
}
