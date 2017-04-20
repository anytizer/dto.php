<?php
namespace business;
use setups\business_entity;
use setups\roles;

$entities[] = (new business_entity())
    ->business("Tailoring", "Uniforms Measurement", "tailoring_measurements")
    ->user((new roles())->SUPERADMIN())
    ->methods(array(
        "take measurements (student)",
        "deliver (cloth)",
        "notify (student)",
    ));