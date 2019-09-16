<?php
require_once("inc.config.php");
require_once("inc.settings.php");

use generators\template_reader;
use parsers\angular_parser;
use parsers\business_parser;
use parsers\dto_parser;
use parsers\endpoints_parser;
use parsers\html_parser;
use parsers\orm_parser;
use parsers\phpunit_parser;
use anytizer\configs;

/**
 * Used in tracing Issue ID for test cases for PHPUnit
 * @return string
 * @see libraries/classes/parsers/class.phpunit_parser.inc.php
 */
$F_ISSUE_ID = function () {
    static $issue_id = 0;

    if (!$issue_id) {
        $issue_id = 0;
    }

    return sprintf("%06s", ++$issue_id);
};

# for each entities, define business rules (methods)
// business = entity, model
// database = orm
// user
// method
// table name

$configs = new configs();

$template_reader = new template_reader();
if ($configs->templates) {
    echo sprintf("\r\nProcessing static file copy...");

    // @todo Rather, use media.cdn or parallel subdomain
    $template_reader->write($template_reader->read("public_html/css/w3.css"), "public_html/css/w3.css");
    $template_reader->write($template_reader->read("public_html/css/styles.css"), "public_html/css/styles.css"); // from scss
    $template_reader->write($template_reader->read("public_html/js/jquery/jquery-3.4.1.min.js"), "public_html/js/jquery/jquery-3.4.1.min.js");
    $template_reader->write($template_reader->read("public_html/js/general.js"), "public_html/js/general.js");
    $template_reader->write($template_reader->read("phpunit/bootstrap.php.ts"), "phpunit/bootstrap.php");
    $template_reader->write($template_reader->read("phpunit/phpunit.cmd.ts"), "phpunit/phpunit.cmd");
    $template_reader->write($template_reader->read("phpunit/phpunit.xml.ts"), "phpunit/phpunit.xml");
    $template_reader->write($template_reader->read("phpunit/readme.txt"), "phpunit/readme.txt");
    #$template_reader->write($template_reader->read("libraries/backend/class.spl_include.inc.php.ts"), "libraries/backend/class.spl_include.inc.php.ts");
}
#die("Static templates done!");
// @todo Package name to be replaced
# .htaccess
# .htpass

foreach ($entities as $business) {
    if (!$business->enabled()) {
        continue;
    }
    #print_r($entities); die();
    #print_r($business); die();

    # CLI Options
    # business dto user
    # business business user -- entity
    # business app.js.ts user
    # business routes.js.ts user
    # business controllers.js.ts user
    # business services.js.ts user
    # business endpoints user
    # business orm user -- business
    echo sprintf("\r\n\r\nProcessing: Package [%s] at Class [%s].", $business->package_name(), $business->class_name());

    /**
     * Data Transfer Objects
     */
    if ($configs->dto) {
        $dto_parser = new dto_parser();
        $dto_body = $dto_parser->generate($business);

        // @todo Must have columns available
        $dto_body = $dto_parser->laravel($business);
        $dto_body = $dto_parser->cs($business);

        #$dto_body = $dto_parser->dto_file($business);
        #$dto_body = $dto_parser->asis($business);
        #echo "DTO Class body: ", $dto_body;
    }

    /**
     * ORM/Database Layer
     */
    if ($configs->orm) {
        $orm_parser = new orm_parser();
        $orm_body = $orm_parser->generate($business);
        $orm_body = $orm_parser->generate_orm($business);
        $orm_body = $orm_parser->generate_database($business);
        #echo $orm_body; die();
    }

    /**
     * Business Logic Layer
     */
    if ($configs->business) {
        $business_parser = new business_parser();
        $business_body = $business_parser->copy_files($business);
        $business_body = $business_parser->generate($business);
    }

    /**
     * PHPUnit Templates
     */
    if ($configs->phpunit) {
        $phpunit_parser = new phpunit_parser();
        $phpunit_parser->generate($business);
    }

    /**
     * API Endpoints
     */
    if ($configs->endpoints) {
        $endpoints_parser = new endpoints_parser();
        // actual api with direct database access
        $endpoints_body = $endpoints_parser->generate($business);
        //$endpoints_body = $endpoints_parser->relay($business);
    }

    /**
     * AngularJS Resources
     */
    if ($configs->angular) {
        $angular_parser = new angular_parser();
        $angular_parser->generate($business);
    }

    /**
     * HTML, CSS and static JavaScripts Resources
     * Selenium Resources
     */
    if ($configs->html) {
        $html_parser = new html_parser();
        $html_parser->generate($business);
    }

    #die(sprintf("\r\n\r\nLoop stopped for now. Re-Enable me at line #%d.\r\n", __LINE__));
}

echo "\r\n", sprintf("%sItems generated: #%s.", "\r\n", count($entities));
#print_r($entities);
