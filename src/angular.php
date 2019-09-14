<?php
require_once("libraries/inc.config.php");
require_once("inc.generate.php");

use parsers\angular_parser;

foreach ($entities as $business) {
    /**
     * AngularJS Resources
     */
    if ($configs->angular) {
        $angular_parser = new angular_parser();
        $angular_parser->generate($business);
    }
}