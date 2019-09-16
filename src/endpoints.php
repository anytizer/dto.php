<?php
require_once("inc.config.php");
require_once("inc.settings.php");

use parsers\endpoints_parser;

foreach ($entities as $business) {
    /**
     * API Endpoints
     */
    if ($configs->endpoints) {
        $endpoints_parser = new endpoints_parser();
        $endpoints_body = $endpoints_parser->generate($business); // actual api
        //$endpoints_body = $endpoints_parser->relay($business);
        echo $endpoints_body;
    }
}
