<?php
$host = "localhost";
$user = "root";
$password = "";
$orm_name="users";
$connection = new \PDO("mysql:host={$host};dbname={$orm_name}", $user, $password);

define("__LIBRARIES__", realpath(dirname(__FILE__)));
require_once(__LIBRARIES__."/classes/class.spl_include.inc.php");
spl_autoload_register(array(new spl_include("/htdocs/angular/libraries/dto.php/dev/libraries/classes"), "namespaced_inc_dot"));

// https://youtu.be/L0g9ka5qaCc
// composer show illuminate/orm
// composer require illuminate orm
// spl_autoload_register(array(new spl_include("/htdocs/Illuminate"), "psr0"));

# https://getcomposer.org/installer
