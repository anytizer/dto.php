<?php
namespace business;
use setups\business_entity;
use setups\roles;

$entities[] = (new business_entity())
    ->business("Promotions Market", "Offers", "project_promotions")
    ->user((new roles())->ALL())
    ->methods(array(
        "browse projects",
        "search projects(parameters)",
        "reserve offer(user, offer)",
        "delete reserved(offer)",
        "modify reserved(offer)",
        "#buy offer",
        "commit offer",
        "modify committed offer",
        "cancel committed offer",
    ));
