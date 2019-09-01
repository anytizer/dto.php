<?php
header("Content-Type: text/plain");

#use \PDO;
use anytizer\includer;

/**
 * PHP (php.ini) pre-configured with this include path (global composer)
 */
# composer global require anytizer/guid.php:dev-master
# composer global require anytizer/includer.php:dev-master
$paths = explode(PATH_SEPARATOR, get_include_path());
$paths[] = "C:/Users/dev_2/AppData/Roaming/Composer";
$paths[] = "C:/Users/dev_2/AppData/Roaming/Composer/vendor/anytizer";
set_include_path(implode(PATH_SEPARATOR, $paths));
require_once "vendor/autoload.php";

/**
 * @todo Read from configurations set from CLI
 */
$configs = [
    "write_to" => "D:/htdocs/angular/libraries/dto.php/output",
    "write_url" => "http://localhost/angular/libraries/dto.php/output",
    "dto" => "libraries/dto",
];

/**
 * *.definition.php
 */
define("__OUTPUT__", $configs["write_to"]);
define("__BUSINESS_DEFINITIONS__", realpath("D:/htdocs/angular/libraries/dto.php/definitions.business/definitions"));
define("__LIBRARIES_DIR__", dirname(__FILE__));
define("__MEDIA_URL__", "{$configs['write_url']}/public_html/js/angular");
#define("__JS_URL__", "{$configs['write_url']}/public_html/js/angular");
#define("__CSS_URL__", "{$configs['write_url']}/public_html/js/angular");
define("__PUBLIC_URL__", "{$configs['write_url']}/public_html");
define("__ENDPOINT_URL__", "http://api.example.com:88"); // {$configs['write_url']}/endpoints"); // http://api.example.com/project
define("__DEFINITIONS__", realpath("D:/htdocs/angular/libraries/dto.php/definitions.business/later"));
// media: css, js, images, videos
// api, api phpunit
// library

$hostname = "192.168.1.76";
$username = "admin";
$password = "nimda";
$orm_name = "passport";
$connection = new PDO("mysql:host={$hostname};dbname={$orm_name};charset=utf8mb4;", $username, $password);

/**
 * Auto include class files
 */
spl_autoload_register(array(new includer(__LIBRARIES_DIR__."/classes"), "namespaced_inc_dot"));
#die(__LIBRARIES_DIR__);
