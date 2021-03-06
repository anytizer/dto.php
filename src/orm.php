<?php
require_once("inc.config.php");
require_once("inc.settings.php");

use parsers\orm_parser;

foreach ($entities as $business) {
    $orm_parser = new orm_parser();
    $orm_body = $orm_parser->generate($business);
    $orm_body = $orm_parser->generate_orm($business);
    $orm_body = $orm_parser->generate_database($business);
    echo $orm_body;
}
