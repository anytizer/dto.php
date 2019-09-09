<?php
require_once("libraries/inc.config.php");
require_once("inc.generate.php");

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
