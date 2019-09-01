<?php
require_once("libraries/inc.config.php");
require_once("inc.generate.php");

use parsers\dto_parser;

foreach ($entities as $business)
{
    $dto_parser = new dto_parser();
    $dto_body = $dto_parser->generate($business);
    echo $dto_body;
}
