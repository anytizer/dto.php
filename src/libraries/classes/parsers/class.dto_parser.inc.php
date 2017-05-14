<?php
namespace parsers;

use setups\business_entity;
use generators\dbaccess;
use generators\template_reader;

class dto_parser implements parser
{
    /**
     * PHP Class (DTO) Body
     *
     * @param business_entity $business
     * @return string
     */
    public function generate(business_entity $business): string
    {
        $template_reader = new template_reader();
        $class_body = $template_reader->read("libraries/dtos/class.template.inc.php.ts");

        # print_r($business);
        $table_name = $business->table_name();
        echo sprintf("\r\nDTO from table [%s]", $table_name);

        $dbaccess = new dbaccess();
        $result = $dbaccess->_get_columns($table_name);
        #print_r($dbaccess);
        # print_r($result); die("Count: ".count($result));
        if(!count($result))
        {
            echo sprintf("\r\nERROR: DTO table NOT found [%s]", $table_name);
            return "# Table missing: {$table_name}";
        }

        //$result = array_map(array($dbaccess, "filter_columns"), $result);
        $result = array_map(array($dbaccess, "dto_rows"), $result);
        $result = array_filter($result);
        $fields = implode("\r\n\t", $result);
        #print_r($result);
        #print_r($fields); die();

        $class_name = $business->class_name();
        $dto_name = $business->dto_name($class_name);

        $class_body = str_replace("#__PACKAGE_NAME__", $business->package_name(), $class_body);
        $class_body = str_replace("#__DTO_NAME__", $business->dto_name(), $class_body);
        $class_body = str_replace("#__CLASS_NAME__", $class_name, $class_body);
        $class_body = str_replace("#__TABLE_NAME__", $table_name, $class_body);
        $class_body = str_replace("#__FIELDS__",    $fields, $class_body);

        // @todo rename to class.DTONAMEDDTO.inc.php
        $template_reader->write($class_body, "libraries/dtos/{$business->package_name()}/class.{$business->dto_name()}.inc.php");
        return $class_body;
    }

    public function asis(business_entity $business): string
    {
        $template_reader = new template_reader();
        $class_body = $template_reader->read("libraries/dtos/class.template.inc.php.ts");

        # print_r($business);
        $table_name = $business->table_name();

        $dbaccess = new dbaccess();
        $result = $dbaccess->_get_columns($table_name);
        #print_r($dbaccess);
        # print_r($result); die("Count: ".count($result));
        if(!count($result))
        {
            // n-columns to be listed
            return "# Invalid table name: [{$table_name}]";
        }

        //$result = array_map(array($dbaccess, "filter_columns"), $result);
        $result = array_map(array($dbaccess, "dto_rows"), $result);
        $result = array_filter($result);
        $fields = implode("\r\n\t", $result);
        #print_r($result);
        #print_r($fields); die();

        $class_name = $business->class_name();
        $dto_name = $business->dto_name($class_name);

        $class_body = str_replace("#__PACKAGE_NAME__", $business->package_name(), $class_body);
        $class_body = str_replace("#__CLASS_NAME__", $class_name, $class_body);
        $class_body = str_replace("#__TABLE_NAME__", $table_name, $class_body);
        $class_body = str_replace("#__FIELDS__",    $fields, $class_body);

        // @todo rename to class.DTONAMEDTO.inc.php
        $template_reader->write($class_body, "libraries/asis/{$business->package_name()}/class.{$business->dto_name()}.inc.php");
        return $class_body;
    }
}