<?php
namespace business;

use \Exception;

abstract class business
{
    // interface
	
    public function __construct()
    {
    }
	
	public function __set($name, $value)
	{
		throw new Exception("Cannot add new property \$$name to instance of " . __CLASS__);
    }
	
	public function __get($name)
	{
		throw new Exception("Invalid access \$$name to instance of " . __CLASS__);
    }
}