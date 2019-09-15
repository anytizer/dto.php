<?php
/**
 * Step 1:
 *  composer update
 *
 * Then, edit the following sections:
 *
 *  $configs
 *  MySQL connections
 */

/**
 * @todo Match with business definition project
 */
$hostname = "localhost";
$username = "root";
$password = "";
$orm_name = "inventory";

/**
 * @todo Read from configurations set from CLI
 */
$configs = [
    // path to definitions.business/definitions
    "definitions_located_at" => "D:/htdocs/angular/libraries/dto.php/definitions.business/definitions",
    "write_to" => "D:/htdocs.tutorials/output.inventory",
    "write_url" => "http://localhost:99/output.inventory",
    "dto" => "libraries/dto",

    /**
     * Pick your business definition files
     *
     * eg.:
     * "/inventory/define.*.php"
     * "/inventory/define.ni_items.php"
     */
    "business_glob" => "/inventory/define.ni_categories.php",
];

/**
 * Do NOT edit anything below
 */
define("__OUTPUT__", $configs["write_to"]);
define("__BUSINESS_DEFINITIONS__", realpath($configs["definitions_located_at"]));
define("__LIBRARIES_DIR__", "./libraries"); // realpath(dirname(__FILE__))."/libraries");
define("__MEDIA_URL__", "{$configs['write_url']}/public_html/js/angular");
define("__PUBLIC_URL__", "{$configs['write_url']}/public_html");
define("__ENDPOINT_URL__", "../api.php/src"); // path to API.php/src, @todo Use write_url

/**
 * Auto include class files
 */
require_once "../vendor/autoload.php";

use anytizer\includer;
spl_autoload_register(array(new includer(__LIBRARIES_DIR__ . "/classes"), "namespaced_inc_dot"));

/**
 * PDO Connection
 */
$connection = new PDO("mysql:host={$hostname};dbname={$orm_name};charset=utf8mb4;", $username, $password);

/**
 * Where are your business definitions?
 */
$entities = [];
$setup_files = glob(__BUSINESS_DEFINITIONS__ . $configs["business_glob"]);
foreach ($setup_files as $setup) {
    require_once $setup;
}
