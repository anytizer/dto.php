<?php
namespace business;
use setups\business_entity;
use setups\roles;

$entities[] = (new business_entity())
    ->business("Projects", "Todos", "project_todos")
    ->user((new roles())->SUPERADMIN())
    ->methods(array(
        "add todo (note)",
        "mark as (flag)",
        "get flags",
        "get todos (flag)",
        "get all",
        "delete(todo)",
    ));