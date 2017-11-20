<?php
header("Content-Type: text/plain");

require_once("libraries/inc.config.php");

use generators\template_reader;
use parsers\angular_parser;
use parsers\business_parser;
use parsers\dto_parser;
use parsers\endpoints_parser;
use parsers\html_parser;
use parsers\orm_parser;
use parsers\phpunit_parser;

define("__MEDIA_URL__", "http://localhost/angular/libraries/dto.php/output/public_html/js/angularjs");
define("__PUBLIC_URL__", "http://localhost/angular/libraries/dto.php/output/public_html");

/**
 * Common names
 * CRUD: Create, Read, Update, Delete
 * MADS: Modify, Add, Delete, Show
 * BREAD: Browse, Read, Edit, Add, Delete
 * DAVE: Delete, z * Add, View, Edit
 * CRAP: Create, Retrieve, Alter, Purge
 */

# for each entities, define business rules (methods)
// business = entity, model
// database = orm
// user
// method
// table name
$entities = array();
$setups = glob(__BUSINESS_DEFINITIONS__."/define.*.php");
#print_r($setups);
// die();
#$setups = array("definitions/define.accounts.php"); // overwrite
foreach ($setups as $setup) {
    require_once($setup);
}
#print_r($entities); die();

echo sprintf("\r\nProcessing standard file copy.");
$template_reader = new template_reader();
$template_reader->write($template_reader->read("public_html/css/w3.css"), "public_html/css/w3.css");
$template_reader->write($template_reader->read("public_html/css/general.css"), "public_html/css/general.css"); // from scss
$template_reader->write($template_reader->read("public_html/js/jquery-3.2.1.min.js"), "public_html/js/jquery-3.2.1.min.js");
$template_reader->write($template_reader->read("public_html/js/general.js"), "public_html/js/general.js");
$template_reader->write($template_reader->read("phpunit/bootstrap.php.ts"), "phpunit/bootstrap.php");
$template_reader->write($template_reader->read("phpunit/phpunit.cmd.ts"), "phpunit/phpunit.cmd");
$template_reader->write($template_reader->read("phpunit/phpunit.xml.ts"), "phpunit/phpunit.xml");
$template_reader->write($template_reader->read("phpunit/readme.txt"), "phpunit/readme.txt");
$template_reader->write($template_reader->read("libraries/backend/class.spl_include.inc.php"), "libraries/backend/class.spl_include.inc.php");
// @todo Package name to be replaced
# .htaccess
# .htpassw

#print_r($entities); #die();
foreach ($entities as $business)
{
    # CLI Options
    # business dto user
    # business business user -- entity
    # business app.js.ts user
    # business routes.js.ts user
    # business controller.js.ts user
    # business services.js.ts user
    # business endpoints user
    # business orm user -- business
    echo sprintf("\r\n\r\nProcessing: Package [%s] at Class [%s].", $business->package_name(), $business->class_name());

    /**
     * Data Transfer Objects
     */
    $dto_parser = new dto_parser();
    $dto_body = $dto_parser->generate($business);
    $dto_body = $dto_parser->dto_file($business);
    #$dto_body = $dto_parser->asis($business);

    /**
     * ORM/Database Layer
     */
    $orm_parser = new orm_parser();
    $orm_body = $orm_parser->generate($business);
    $orm_body = $orm_parser->generate_orm($business);
    $orm_body = $orm_parser->generate_database($business);
    #echo $orm_body; die();

    /**
     * Business Logic Layer
     */
    $business_parser = new business_parser();
    $business_body = $business_parser->copy_files($business);
    $business_body = $business_parser->generate($business);

    /**
     * PHPUnit Templates
     */
    $phpunit_parser = new phpunit_parser();
    $phpunit_parser->generate($business);

    /**
     * API Endpoints
     */
    $endpoints_parser = new endpoints_parser();
    $endpoints_body = $endpoints_parser->generate($business); // actual api
    //$endpoints_body = $endpoints_parser->relay($business);

    /**
     * AngularJS Resources
     */
    $angular_parser = new angular_parser();
    $angular_parser->generate($business);

    /**
     * HTML, CSS and static javascripts Resources
     * Selenium Resources
     */
    $html_parser = new html_parser();
    $html_parser->generate($business);
}
echo "\r\n", sprintf("%sItems generated: #%s.", "\r\n", count($entities));
#print_r($entities);
