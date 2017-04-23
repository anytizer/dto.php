<?php
namespace parsers;
use setups\business_entity;
use generators\template_reader;
use generators\phpunitifier;

class phpunit_parser implements  parser
{
    public function generate(business_entity $business)
    {
        $template_reader = new template_reader();
        $method_body = $template_reader->read("phpunit/tests/phpunit.php");
        /**
         * For each methods
         *   get method name
         *   build body and comments
         *   define return types
         */
        $phpunitifier = new phpunitifier();
        $methods = array_map(array($phpunitifier, "methodify"), $business->methods_list());
        $features = array_map(array($phpunitifier, "feature_test"), $business->features_list());
        $methods = array_merge($methods, $features);

        $replace = array(
            "#__CLASS_NAME__" => $business->class_name(),
            "#__CLASS_NAME__" => $business->class_name(),
            "#__PUBLIC_METHODS__" => implode("\r\n\t", $methods),
        );
        $from = array_keys($replace);
        $to = array_values($replace);

        $method_body = str_replace($from, $to, $method_body);
        $method_body = str_replace($from, $to, $method_body);
        #print_r($replace); die();
        #die($method_body);

        /**
         * @todo Create API Tests
         * @todo Cover additional tests also, as requested as feature
         */
        // {$business->class_name()}/
        $template_reader->write($method_body, "phpunit/tests/{$business->package_name()}/{$business->class_name()}/{$business->class_name()}Test.php");
        # $template_reader->write($method_body, "phpunit/tests/{$business->class_name()/{$business->class_name()}/{$business->class_name()}APITest.php");
        // write: business test
        // write: api unit tests
        // write endpoint tests

        foreach($methods as $method)
        {
            // Individual function call on a different file
            #$template_reader->write($method_body, "phpunit/tests/{$business->package_name()}/{$business->class_name()}/{$business->class_name()}/{$function}Test.php");
        }

        # Copy other flat files
        # @todo Repeated in each loops
        $template_reader->write($template_reader->read("templates/phpunit/bootstrap.php"), "phpunit/bootstrap.php");
        $template_reader->write($template_reader->read("templates/phpunit/phpunit.cmd"), "phpunit/phpunit.cmd");
        $template_reader->write($template_reader->read("templates/phpunit/phpunit.xml"), "phpunit/phpunit.xml");
        $template_reader->write($template_reader->read("templates/phpunit/readme.txt"), "phpunit/readme.txt");

        /**
         * Create target path
         */
        !is_dir("output/libraries/backend/") && mkdir("libraries/backend/", true, 0777);

        /**
         * Copy template file
         */
        $template_reader->write(file_get_contents("templates/libraries/backend/class.spl_include.inc.php"), "libraries/backend/class.spl_include.inc.php");

        return $method_body;
    }
}