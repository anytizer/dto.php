<?php
namespace business;
use setups\business_entity;
use setups\roles;

$entities[] = (new business_entity())
    ->business("Tenancy", "Tenants", "tenancy_tenants")
    ->user((new roles())->ALL())
    ->methods(array(
        "reside",
        "pay rents",
        "renew contract",
        "valid upto",
        "number of people allowed",
        "dispute",
    ));
