<?php
require_once("libraries/inc.config.php");

use parsers\dto_parser;

require_once("D:/htdocs/angular/libraries/dto.php/definitions.business/later/accounts/define.user.php");
print_r($entities);
foreach ($entities as $business)
{
    $dto_parser = new dto_parser();
    $dto_body = $dto_parser->generate($business);
    #$dto_body = $dto_parser->cs($business);
    echo $dto_body;
}
