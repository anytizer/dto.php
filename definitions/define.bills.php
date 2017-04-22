<?php
namespace business;
use setups\business_entity;
use setups\roles;
$entities[] = (new business_entity())
    ->business("Water bills", "payment", "water_bills")
    ->user((new roles())->ALL())
    ->methods(array(
        "customer",
        "last meter reading",
        "current meter reading",
        "pay now(amount)",
        "pay next on date",
        "overpay",
        "underpay",
        "pending payments",
    ));

$entities[] = (new business_entity())
    ->business("Water Bills", "Customer", "water_customers")
    ->user((new roles())->ALL())
    ->methods(array(
        "create customer",
        "create bill",
        "verify bill",
    ));

$entities[] = (new business_entity())
    ->business("Water bills", "calculator", "water_bills")
    ->user((new roles())->ALL())
    ->methods(array(
        "calculate totals(customer)",
        "calculate discounts(customer)",
        "calculate charges(customer)",
    ));

$entities[] = (new business_entity())
    ->business("Water bills", "notifier", "water_bills")
    ->user((new roles())->ALL())
    ->methods(array(
        "notify payments",
        "notify pending payments",
    ));

$entities[] = (new business_entity())
    ->business("Water bills", "create monthly bills", "water_bills")
    ->user((new roles())->ALL())
    ->methods(array(
        "get last reading",
        "get current reading",
        "create user bills",
    ));