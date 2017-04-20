<?php
namespace business;
use setups\business_entity;
use setups\roles;

/**
 * API Management
 * User logs in and creates API Credentials
 */
$entities[] = (new business_entity())
    ->business("APIs", "payment", "water_bills")
    ->user((new roles())->ALL())
    ->methods(array(
        "signup",
        "login",
		":Create ID",
		":Create secret",
        "Create API Credentials",
        "List API Credentials",
        "Request Access Token",
        "generate request token",
        "authenticate (username, password)",
        "authorized token",
        "authorize by token",
    ));
