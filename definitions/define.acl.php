<?php
namespace business;
use setups\business_entity;
use setups\roles;

/**
 * Define permissions for users
 */
$entities[] = (new business_entity())
    ->business("Access Control List", "User Roles", "account_algorithms")
    ->user((new roles())->SUPERADMIN())
    ->methods(array(
        "create role(role)",
        "impersonate group role(role)",
        "impersonate user(user)",
        "add user to group(group, user)",
        "remove user from group(group, user)",
    ));

$entities[] = (new business_entity())
    ->business("Access Control List", "Access Control List", "account_acl")
    ->user((new roles())->SUPERADMIN())
    ->methods(array(
        "can (something)",
    ));
