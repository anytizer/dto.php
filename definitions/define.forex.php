<?php
namespace business;
use setups\business_entity;
use setups\roles;
$entities[] = (new business_entity())
    ->business("Forex", "Crawler", "projects_forex")
    ->user((new roles())->ALL())
    ->methods(array(
        "crawl today",
        "get missing dates",
        "get last crawled on",
        "crawl on date (date)",
    ));