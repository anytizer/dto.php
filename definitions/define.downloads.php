<?php
namespace business;
use setups\business_entity;
use setups\roles;
$entities[] = (new business_entity())
    ->business("Downloads", "File downloads reports", "files_downloads")
    ->user((new roles())->ALL())
    ->methods(array(
        "download a file",
        "get downloads reports",
    ));