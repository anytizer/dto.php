<?php
require_once("inc.config.php");
require_once("inc.settings.php");

use parsers\dto_parser;

foreach ($entities as $business) {
    $dto_parser = new dto_parser();
    #$dto_body = $dto_parser->generate($business);
    $dto_body = $dto_parser->cs($business);
    echo $dto_body;
}
