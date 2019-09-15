<?php
require_once("inc.config.php");

use parsers\phpunit_parser;

foreach ($entities as $business) {
    /**
     * PHPUnit Templates
     */
    if ($configs->phpunit) {
        $phpunit_parser = new phpunit_parser();
        $phpunit_parser->generate($business);
    }
}
