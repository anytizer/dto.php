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
        "book slot",
        "alert visitor",
        "mark visited",
    ));