<?php
$entities = [];
#$setup_files = glob(__BUSINESS_DEFINITIONS__ . "/passport/define.*.php");
#$setup_files = glob(__BUSINESS_DEFINITIONS__ . "/ubuild/define.*.php");
#$setup_files = glob(__BUSINESS_DEFINITIONS__ . "/inventory/define.*.php");
$setup_files = glob(__BUSINESS_DEFINITIONS__ . "/inventory/define.ni_units.php");
#$setup_files = glob(__BUSINESS_DEFINITIONS__."/passport/define.plans.php");

#print_r($setups); die();
foreach ($setup_files as $setup) {
    require_once $setup;
}
#print_r($entities); die();

/*
require_once("D:/htdocs/angular/libraries/dto.php/definitions.business/later/accounts/define.user.php");
print_r($entities);
die("List of Entities...");

require_once(__BUSINESS_DEFINITIONS__."/define.passport.php");
print_r($entities);

$definitions = scandir(__BUSINESS_DEFINITIONS__."/passport");
foreach($definitions as $definition)
{
    if(is_file(__BUSINESS_DEFINITIONS__."/passport/".$definition))
    {
        require_once __BUSINESS_DEFINITIONS__."/passport/".$definition;
    }
}
#print_r($definitions);
#print_r($entities);

#die("__BUSINESS_DEFINITIONS__: ".__BUSINESS_DEFINITIONS__);

#require_once(__BUSINESS_DEFINITIONS__."/define.passport.php");

#print_r($entities);
*/
