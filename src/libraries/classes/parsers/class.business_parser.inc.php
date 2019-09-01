<?php
namespace parsers;
use generators\businessifier;
use setups\business_entity;
use generators\template_reader;

class business_parser implements parser
{
    public function generate(business_entity $business): string
    {
        return $this->businessify($business);
    }

    private function businessify(business_entity $business)
    {
        $template_reader = new template_reader();
        $method_body = $template_reader->read("libraries/business/class.template.inc.php.ts"); // @todo replace with orm

        $methods = $business->methods_list();
        //print_r($methods); die();

        $businessifier = new businessifier();
        $methods = array_map(array($businessifier, "businessify"), $methods);
        $replaces = array(
            "#__PACKAGE_NAME__" => $business->package_name(),
            "#__CLASS_NAME__" => $business->class_name(),
            "#__DTO_NAME__" => $business->dto_name(),
            "#__BUSINESS_NAME__" => $business->business_name(),
            "#__ORM_NAME__" => $business->orm_name(),
            "#__MODEL_NAME__" => $business->table_name(),
            "#__PUBLIC_METHODS__" => implode("\r\n\t", $methods)
        );
        $method_body = str_replace(array_keys($replaces), array_values($replaces), $method_body);
        $method_body = str_replace(array_keys($replaces), array_values($replaces), $method_body);

        // @todo rename patches with entity controller and business
        $template_reader->write($method_body, "libraries/business/{$business->package_name()}/class.{$business->business_name()}.inc.php");
        return $method_body;
    }

    public function copy_files(business_entity $business)
    {
        $template_reader = new template_reader();
        $method_body = $template_reader->read("libraries/business/class.business.inc.php.ts");

        $methods = $business->methods_list();

        $businessifier = new businessifier();
        $methods = array_map(array($businessifier, "businessify"), $methods);
        #print_r($methods); die();
        $replaces = array(
            "#__PACKAGE_NAME__" => $business->package_name(),
            "#__CLASS_NAME__" => $business->class_name(),
            "#__ORM_NAME__" => $business->orm_name(),
            "#__PUBLIC_METHODS__" => implode("\r\n\t", $methods)
        );
        $method_body = str_replace(array_keys($replaces), array_values($replaces), $method_body);
        $method_body = str_replace(array_keys($replaces), array_values($replaces), $method_body);

        $template_reader->write($method_body, "libraries/business/class.business.inc.php");
        return $method_body;
    }
}
