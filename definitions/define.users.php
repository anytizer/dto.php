<?php
namespace business;
use setups\business_entity;
use setups\roles;
$entities[] = (new business_entity())
    ->business("Users", "Token Manager", "tokens")
    ->user((new roles())->ALL())
    ->methods(array(
        "generate token",
        "verify token",
        "expire token",
    ));

$entities[] = (new business_entity())
    ->business("Users", "Handle Signups", "account_users_signups")
    ->user((new roles())->ALL())
    ->user((new roles())->ADMIN())
    ->methods(array(
        "is unique email address",
        "accept signup (email)",
        "generate verification token",
        "email verification link",
        "verify signup(token)",
        "mark as verified(user, token)",
        "log access",
        "migrate(user)"
    ));

$entities[] = (new business_entity())
    ->business("Users", "Signups Migrator", "account_users_signups")
    ->user((new roles())->ADMIN())
    ->methods(array(
        "migrate to live account",
        "delete signup",
        "set password",
        "notify password",
    ));

$entities[] = (new business_entity())
    ->business("Users", "Credentials", "account_credentials")
    ->user((new roles())->ALL())
    ->methods(array(
        "change password(old password, new password, confirm password)",
        "reset password(new password)",
        "log access",
        "login",
    ));