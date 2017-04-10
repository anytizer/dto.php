<?php
namespace endpoints;
use dtos\#__CLASSNAME___dto;
use models\#__CLASSNAME__;

/**
 * Endponints for #__CLASSNAME__
 */
class endpoints extends endpoint
{
    private $#__CLASSNAME__;
    public function __construct()
    {
        $this->#__CLASSNAME__ = new #__CLASSNAME__();
    }

    #__PUBLIC_METHODS__
}
