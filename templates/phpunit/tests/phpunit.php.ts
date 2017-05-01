<?php

namespace tests\#__PACKAGE_NAME__;

use business\#__PACKAGE_NAME__\#__CLASS_NAME___business;
use \PHPUnit\Framework\TestCase;

class #__CLASS_NAME__Test extends TestCase
{
    /**
     * @var #__CLASS_NAME___business
     */
	private $#__CLASS_NAME___business;

        public function setup()
        {
            $this->#__CLASS_NAME___business = new #__CLASS_NAME___business();
        }

	#__PUBLIC_METHODS__
}
