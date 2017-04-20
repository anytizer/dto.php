<?php
namespace business;
use setups\business_entity;
use setups\roles;
$entities[] = (new business_entity())
    ->business("Document Management", "Manager", "document_manager")
    ->user((new roles())->ALL())
    ->methods(array(
        "get status",
        "pass to",
        "reject",
        "approve",
        "sign",
    ));