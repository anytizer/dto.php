<?php
namespace business;
use setups\business_entity;
use setups\roles;

/**
 * Why came in?
 * Register and forward the purpose of a visit
 */
$entities[] = (new business_entity())
    ->business("Why Came In", "student", "register")
    ->user((new roles())->STAFF())
    ->methods(array(
        "register(guest)",
        "take notes (guest, notes)",
        "forward notes (notes, staff)",
    ));
