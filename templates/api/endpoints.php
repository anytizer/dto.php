<?php
namespace endpoints;
use dtos\#__CLASS_NAME___dto;
use models\#__CLASS_NAME__;

/**
 * Endponints for #__CLASS_NAME__
 */
class endpoints extends endpoint
{
    private $#__CLASS_NAME__;
    public function __construct()
    {
        $this->#__CLASS_NAME__ = new #__CLASS_NAME__();

        $this->role = new role();
        $this->APIUser = new APIUser();
    }

    #__PUBLIC_METHODS__
}
