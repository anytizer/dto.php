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
 * @todo minimize configurations
 */
$configurations = [
    /**
     * path to definitions.business/definitions
     */
    "definitions_located_at" => "../../business.definitions",

    /**
     * Pick your business definition files
     *
     * eg.:
     * "/inventory/define.*.php"
     * "/inventory/define.ni_items.php"
     */
    "business_glob" => "/inventory/define.*.php",

    /**
     * produce files at this physical path
     */
    "write_to" => "../../public_html",

    /**
     * "write to" above as relative url path at:
     */
    "write_url" => "/project/public_html",

    /**
     * Where is API.php located at? full URL.
     */
    "api_url" => "../api.php/src",

    /**
     * public_html of media.cdn project path
     * example: "http://media.example.com:9090",
     */
    "cdn" => "http://localhost/media.cdn/public_html",
];
