<?php
namespace parsers;
use setups\business_entity;
use generators\bodyfier;
use generators\template_reader;

class orm_parser implements parser
{
    public function generate(business_entity $business)
    {
        $template_reader = new template_reader();
        $method_body = $template_reader->read("libraries/orm/class.template_orm.inc.php");

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

        $bodyfier = new bodyfier();
        $methods = array_map(array($bodyfier, "databasify"), $methods);
        $replaces = array(
            "#__CLASSNAME__" => $business->class_name(),
            "#__PUBLIC_METHODS__" => implode("\r\n\t", $methods)
        );
        $method_body = str_replace(array_keys($replaces), array_values($replaces), $method_body);

        $template_reader->write($method_body, "libraries/orm/class.{$business->class_name()}_orm.inc.php");
        $template_reader->write(file_get_contents("templates/orm/class.orm.inc.php"), "libraries/orm/class.orm.inc.php");
        return $method_body;
    }
}
