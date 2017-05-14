<?php
$configs = [
	#"write_to" => "/htdocs/angular/libraries/dto.php/dev/output",
	"write_to" => "/htdocs/angular/application/test",
	"dto" => "libraries/dto",
];

$host = "localhost";
$user = "awesome";
$password = "awesome";
$orm_name="awesome_accounts";
$connection = new \PDO("mysql:host={$host};dbname={$orm_name}", $user, $password);

// define.*.php
define("__BUSINESS_DEFINITIONS__", "D:/htdocs/angular/libraries/dto.php/definitions.business/definitions");
define("__OUTPUT__", "D:/htdocs/angular/libraries/dto.php/output");

define("__LIBRARIES_DIR__", "D:/htdocs/angular/libraries/dto.php/dto.php/src/libraries");
//define("__LIBRARIES_DIR__", realpath(dirname(__FILE__)));

require_once(__LIBRARIES_DIR__."/classes/backend/class.spl_include.inc.php");
spl_autoload_register(array(new \backend\spl_include(__LIBRARIES_DIR__."/classes"), "namespaced_inc_dot"));
