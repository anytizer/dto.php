<?php
namespace orm;

abstract class orm
{
    public function __construct()
    {
    }
	
	public function save(): bool
    {
		return true;
    }
}