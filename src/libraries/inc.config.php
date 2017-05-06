<?php
$configs = [
	#"write_to" => "/htdocs/angular/libraries/dto.php/dev/output",
	"write_to" => "/htdocs/angular/application/test",
	"dto" => "libraries/dto",
];

$host = "localhost";
$user = "root";
$password = "";
$orm_name="users";
$connection = new \PDO("mysql:host={$host};dbname={$orm_name}", $user, $password);

define("__LIBRARIES_DIR__", realpath(dirname(__FILE__)));
require_once(__LIBRARIES_DIR__."/classes/backend/class.spl_include.inc.php");
spl_autoload_register(array(new \backend\spl_include(__LIBRARIES_DIR__."/classes"), "namespaced_inc_dot"));
