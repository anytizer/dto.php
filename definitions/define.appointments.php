<?php
namespace business;
use setups\business_entity;
use setups\roles;

$entities[] = (new business_entity())
    ->business("Appointments", "Slots", "appointment_slots")
    ->user((new roles())->ALL())
    ->methods(array(
        "get slots",
        "block slot",
        "alert visitor",
        "mark visited",
    ));
$entities[] = (new business_entity())
    ->business("Appointments", "Slots Booker", "appointment_slots")
    ->user((new roles())->ALL())
    ->methods(array(
        "reserve slot booking",
        "commit slot booking",
    ));