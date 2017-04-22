<?php
namespace business;
use setups\business_entity;
use setups\roles;

$entities[] = (new business_entity())
    ->business("Funder", "Donors", "funder_donors")
    ->user((new roles())->SUPERADMIN())
    ->methods(array(
        "donate (amount)",
        "my donations (project)",
        "donors",
        "projects",
        "clause",
        "signup",
        "login",
        "show",
        "view balance",
        "view total collected",
    ));