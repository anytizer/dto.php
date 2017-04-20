<?php
namespace business;
use setups\business_entity;
use setups\roles;

$entities[] = (new business_entity())
    ->business("Reports", "General Reports", "api_access")
    ->user((new roles())->ADMIN())
    ->user((new roles())->ALL())
    ->methods(array(
		"daily report (day)",
		"weekly report (week)",
		"monthly report (month)",
		"yearly report (year)",
		"ranged report (from date, to date)",
    ));
