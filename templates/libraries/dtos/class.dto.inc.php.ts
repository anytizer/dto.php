<?php
namespace dtos\dto;
use \Exception;

/**
 * Unless otherwise defined, do not allow to read or write non-existing members
 */
abstract class dto
{
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
