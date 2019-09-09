<?php

namespace generators;

use setups\business_entity;
use setups\method_descriptor;

/**
 * Class bodyfier
 * PHP Class body template maker
 *
 * @package generators
 */
interface bodyfier
{
    //public function get_name();
    public function generate(): string;
}