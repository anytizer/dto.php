<?php
namespace parsers;
use setups\business_entity;
use generators\bodyfier;
use generators\template_reader;

class business_parser implements parser
{
    public function generate(business_entity $business)
    {
        $template_reader = new template_reader();
        $method_body = $template_reader->read("libraries/business/class.template_business.inc.php"); // @todo replace with orm

        $methods = $business->methods_list();

        $bodyfier = new bodyfier();
        $methods = array_map(array($bodyfier, "businessify"), $methods);
        $replaces = array(
            "#__CLASSNAME__" => $business->class_name(),
            "#__MODEL_NAME__" => $business->table_name(),
            "#__PUBLIC_METHODS__" => implode("\r\n\t", $methods)
        );
        $method_body = str_replace(array_keys($replaces), array_values($replaces), $method_body);
        $method_body = str_replace(array_keys($replaces), array_values($replaces), $method_body);

        // @todo rename patches with entity controller and business
        $template_reader->write($method_body, "libraries/business/class.{$business->class_name()}_business.inc.php");
        $template_reader->write(file_get_contents("templates/libraries/business/class.business.inc.php"), "libraries/business/class.business.inc.php");
        return $method_body;
    }
}
