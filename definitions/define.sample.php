<?php
namespace business;
use setups\business_entity;
use setups\roles;

$entities[] = (new business_entity())
    ->business("Sample Module", "samples", "sample_samples")
    ->user((new roles())->ALL())
    ->methods(array(
        "get samples",
    ));
