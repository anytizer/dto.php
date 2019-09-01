<?php
namespace parsers;
use setups\business_entity;
use generators\ormifier;
use generators\template_reader;

class orm_parser implements parser
{
    public function generate(business_entity $business)
    {
        $template_reader = new template_reader();
        $method_body = $template_reader->read("libraries/orm/class.template.inc.php.ts");

        // reset
        $methods = $business->methods_list();
        /*
        // overwrite
        $methods = array(
            "list",
            "details",
            "add",
            "edit",
            "delete",
            "flag",
        );*/

        $ormifier = new ormifier();
        $methods = array_map(array($ormifier, "methodify"), $methods);
        #print_r($methods); die();
        $replaces = array(
            "#__PACKAGE_NAME__" => $business->package_name(),
            "#__CLASS_NAME__" => $business->class_name(),
            "#__ORM_NAME__" => $business->orm_name(),
            "#__PUBLIC_METHODS__" => implode("\r\n\t", $methods)
        );
        $method_body = str_replace(array_keys($replaces), array_values($replaces), $method_body);
        $method_body = str_replace(array_keys($replaces), array_values($replaces), $method_body);

        $template_reader->write($method_body, "libraries/orm/{$business->package_name()}/class.{$business->orm_name()}.inc.php");
        return $method_body;
    }

    public function generate_orm(business_entity $business)
    {
        $template_reader = new template_reader();
        $method_body = $template_reader->read("libraries/orm/class.orm.inc.php.ts");

        $methods = $business->methods_list();

        $ormifier = new ormifier();
        $methods = array_map(array($ormifier, "methodify"), $methods);
        #print_r($methods); die();
        $replaces = array(
            "#__PACKAGE_NAME__" => $business->package_name(),
            "#__CLASS_NAME__" => $business->class_name(),
            "#__ORM_NAME__" => $business->orm_name(),
            "#__PUBLIC_METHODS__" => implode("\r\n\t", $methods)
        );
        $method_body = str_replace(array_keys($replaces), array_values($replaces), $method_body);
        $method_body = str_replace(array_keys($replaces), array_values($replaces), $method_body);

        $template_reader->write($method_body, "libraries/orm/class.orm.inc.php");
        return $method_body;
    }

    public function generate_database(business_entity $business)
    {
        $template_reader = new template_reader();
        $method_body = $template_reader->read("libraries/orm/class.database.inc.php.ts");

        $methods = $business->methods_list();

        $ormifier = new ormifier();
        $methods = array_map(array($ormifier, "methodify"), $methods);
        #print_r($methods); die();
        $replaces = array(
            "#__PACKAGE_NAME__" => $business->package_name(),
            "#__CLASS_NAME__" => $business->class_name(),
            "#__ORM_NAME__" => $business->orm_name(),
            "#__PUBLIC_METHODS__" => implode("\r\n\t", $methods)
        );
        $method_body = str_replace(array_keys($replaces), array_values($replaces), $method_body);
        $method_body = str_replace(array_keys($replaces), array_values($replaces), $method_body);

        $template_reader->write($method_body, "libraries/orm/class.database.inc.php");
        return $method_body;
    }
}
