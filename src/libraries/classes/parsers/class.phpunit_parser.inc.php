<?php

namespace parsers;

use generators\caser;
use setups\business_entity;
use generators\template_reader;
use generators\phpunitifier;

class phpunit_parser implements parser
{
    public function generate(business_entity $business)
    {
        $this->generate_phpunits($business);
        $this->apiunit($business); // GET/POST
        $this->api_business($business); // GET/POST
        #echo $phpunit_body; die();
    }

    private function generate_phpunits(business_entity $business)
    {
        $template_reader = new template_reader();
        $method_body = $template_reader->read("phpunit/tests/phpunit.php.ts");
        /**
         * For each methods
         *   get method name
         *   build body and comments
         *   define return types
         */
        $phpunitifier = new phpunitifier();
        $methods = array_map(array($phpunitifier, "methodify"), $business->methods_list());

        $methods = preg_replace_callback_array(array(
            "/\@ISSUE_ID\@/is" => $GLOBALS["F_ISSUE_ID"]
        ), $methods);
        $features = array_map(array($phpunitifier, "feature_test"), $business->features_list());
        $features = preg_replace_callback_array(array(
            "/\@ISSUE_ID\@/is" => $GLOBALS["F_ISSUE_ID"]
        ), $features);
        #$methods = array_merge($methods, $features);

        $replace = array(
            "#__PACKAGE_NAME__" => $business->package_name(),
            "#__CLASS_NAME__" => $business->class_name(),
            "#__BUSINESS_NAME__" => $business->business_name(),
            "#__PUBLIC_METHODS__" => implode("\r\n\t", array_merge($methods, $features)),
        );
        $from = array_keys($replace);
        $to = array_values($replace);

        // twice replacements
        $method_body = str_replace($from, $to, $method_body);
        $method_body = str_replace($from, $to, $method_body);
        $method_body = preg_replace_callback_array(array(
            "/\@ISSUE_ID\@/is" => $GLOBALS["F_ISSUE_ID"]
        ), $method_body);
        #print_r($replace); die();
        #die($method_body);

        /**
         * @todo Create API Tests
         * @todo Cover additional tests also, as requested as feature
         */
        // {$business->class_name()}/
        $template_reader->write($method_body, "phpunit/tests/{$business->package_name()}/{$business->class_name()}/{$business->class_name()}Test.php");
        # write: business test
        # write: api unit tests
        # write endpoint tests
        return $method_body;
    }

    private function apiunit(business_entity $business)
    {
        $template_reader = new template_reader();
        $method_body = $template_reader->read("phpunit/tests/apiunit.php.ts");
        /**
         * For each methods
         *   get method name
         *   build body and comments
         *   define return types
         */
        $phpunitifier = new phpunitifier();
        $methods = array_map(array($phpunitifier, "methodify"), $business->methods_list());

        // @todo API Features may not be required
        $features = array_map(array($phpunitifier, "feature_test"), $business->features_list());
        #$methods = array_merge($methods, $features);

        $replace = array(
            "#__PACKAGE_NAME__" => $business->package_name(),
            "#__CLASS_NAME__" => $business->class_name(),
            "#__BUSINESS_NAME__" => $business->business_name(),
            "#__PUBLIC_METHODS__" => implode("\r\n\t", array_merge($methods, $features)),
        );
        $from = array_keys($replace);
        $to = array_values($replace);

        $method_body = str_replace($from, $to, $method_body);
        $method_body = str_replace($from, $to, $method_body);
        $method_body = preg_replace_callback_array(array(
            "/\@ISSUE_ID\@/is" => $GLOBALS["F_ISSUE_ID"]
        ), $method_body);
        #print_r($replace); die();
        #die($method_body);

        $template_reader->write($method_body, "phpunit/tests/{$business->package_name()}/{$business->class_name()}/{$business->class_name()}APITest.php");
        return $method_body;
    }

    private function api_business(business_entity $business)
    {
        $template_reader = new template_reader();
        $method_body = $template_reader->read("libraries/api/package/class.BusinessAPI.php.ts");
        /**
         * For each methods
         *   get method name
         *   build body and comments
         *   define return types
         */
        $phpunitifier = new phpunitifier();
        $methods = array_map(array($phpunitifier, "methodify"), $business->methods_list());
        $features = array_map(array($phpunitifier, "feature_test"), $business->features_list());
        #$methods = array_merge($methods, $features);

        $replace = array(
            "#__PACKAGE_NAME__" => $business->package_name(),
            "#__CLASS_NAME__" => $business->class_name(),
            "#__BUSINESS_NAME__" => $business->business_name(),
            "#__PUBLIC_METHODS__" => implode("\r\n\t", array_merge($methods, $features)),
        );
        $from = array_keys($replace);
        $to = array_values($replace);

        $method_body = str_replace($from, $to, $method_body);
        $method_body = str_replace($from, $to, $method_body);
        #print_r($replace); die();
        #die($method_body);

        $template_reader->write($method_body, "libraries/api/{$business->package_name()}/class.{$business->class_name()}API.inc.php");
        return $method_body;
    }
}