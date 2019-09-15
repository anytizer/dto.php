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
$configurations = [
    // path to definitions.business/definitions
    "definitions_located_at" => "../../business.definitions",
    "write_to" => "../../public_html",
    "write_url" => "/project/public_html",

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
define("__OUTPUT__", $configurations["write_to"]);
define("__BUSINESS_DEFINITIONS__", realpath($configurations["definitions_located_at"]));
define("__LIBRARIES_DIR__", realpath(dirname(__FILE__))."/libraries");
define("__MEDIA_URL__", "{$configurations['write_url']}/public_html/js/angular");
define("__PUBLIC_URL__", "{$configurations['write_url']}/public_html");
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
$setup_files = glob(__BUSINESS_DEFINITIONS__ . $configurations["business_glob"]);
foreach ($setup_files as $setup) {
    require_once $setup;
}
