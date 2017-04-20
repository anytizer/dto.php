<?php
namespace business;
use setups\business_entity;
use setups\roles;
$entities[] = (new business_entity())
    ->business("Membership", "User memberships", "user_membership")
    ->user((new roles())->ALL())
    ->methods(array(
        "renew",
        "expire",
        "suspend",
        "free",
        "trial",
    ));