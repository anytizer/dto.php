<?php

/**
 * Do NOT edit anything below. Configurations defined to make globally available
 */
define("__OUTPUT__", $configurations["write_to"]);
define("__BUSINESS_DEFINITIONS__", realpath($configurations["definitions_located_at"]));
define("__LIBRARIES_DIR__", realpath(dirname(__FILE__))."/libraries");
define("__CDN__", $configurations['cdn']);
define("__MEDIA_URL__", "{$configurations['write_url']}/public_html/js/angular");
define("__PUBLIC_URL__", "{$configurations['write_url']}/public_html");
define("__ENDPOINT_URL__", $configurations["api_url"]); // path to API.php/src

/**
 * Auto include class files
 */
require_once "../vendor/autoload.php";

use anytizer\includer;
spl_autoload_register(array(new includer(__LIBRARIES_DIR__ . "/classes"), "namespaced_inc_dot"));

$dsn = "mysql:host={$hostname};dbname={$orm_name};charset=utf8mb4;";
$options = array(
    PDO::ATTR_PERSISTENT => false,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4;",
    PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => false,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
);

/**
 * PDO Connection
 */
$connection = new PDO($dsn, $username, $password, $options);

/**
 * Where are your business definitions?
 */
$entities = [];
$setup_files = glob(__BUSINESS_DEFINITIONS__ . $configurations["business_glob"]);
if(!count($setup_files))
{
    die("Not enough business definition files loaded from: ".__BUSINESS_DEFINITIONS__." and ".$configurations["business_glob"]);
}
foreach ($setup_files as $setup) {
    require_once $setup;
}
print("Seeking: ".__BUSINESS_DEFINITIONS__ . $configurations["business_glob"]);
#print_r($setup_files);
#print_r($entities);
#$total = count($entities);
#die("Ready to CRUD #{$total} item?");
