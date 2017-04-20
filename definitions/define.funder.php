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
        "total donations (project)",
    ));
// donors
// projects
// clause
// fees
// show public

// signup
// login
// donate
// view balance
// view total collected