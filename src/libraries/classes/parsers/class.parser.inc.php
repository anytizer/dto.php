<?php

namespace parsers;

use anytizer\business_entity;

interface parser
{
    /**
     * Knows how to generate the scripts
     *
     * @param business_entity $business
     * @return mixed
     */
    public function generate(business_entity $business);
}
