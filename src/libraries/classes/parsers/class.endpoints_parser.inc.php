<?php

namespace parsers;

use generators\dbaccess;
use generators\endpoints;
use generators\template_reader;
use anytizer\business_entity;

/**
 * Class endpoints_parser
 * @package parsers
 *
 * @see https://developer.github.com/v3/
 */
class endpoints_parser implements parser
{
    public function generate(business_entity $business)
    {
        # $template_reader->write($template_reader->read("libraries/dtos/package/class.CustomEloquentModel.inc.ts"), "libraries/dtos/package/class.CustomEloquentModel.inc.php");
        $this->generate_eloquent($business);
        $this->generate_controller($business);
        $this->generate_model($business);
    }

    /**
     * @param $business
     * @return mixed|string
     */
    private function generate_eloquent(business_entity $business): string
    {
        $template_reader = new template_reader();
        $method_body = $template_reader->read("libraries/dtos/package/class.CustomEloquentModel.inc.ts");

        $replace = [
            "#__PACKAGE_NAME__" => strtolower($business->package_name()),
            "#__CLASS_NAME__" => strtolower($business->class_name()),
        ];
        $from = array_keys($replace);
        $to = array_values($replace);

        $method_body = str_replace($from, $to, $method_body);

        $template_reader->write($method_body, "api/{$replace['#__PACKAGE_NAME__']}/models/class.CustomEloquentModel.inc.php");
        return $method_body;
    }

    /**
     * @param $business
     * @return mixed|string
     */
    private function generate_controller(business_entity $business): string
    {
        $template_reader = new template_reader();
        $method_body = $template_reader->read("api/controller.php.ts");

        $endpoints = new endpoints();
        $methods = array_map(array($endpoints, "methodify"), $business->methods_list());

        $replace = [
            "#__PACKAGE_NAME__" => strtolower($business->package_name()),
            "#__CLASS_NAME__" => strtolower($business->class_name()),
            "#__PUBLIC_METHODS__" => implode("\r\n\t", $methods),
            "#__FLAG_FIELDS__" => implode("\r\n\t", $methods),
            "#__ENDPOINT_URL__" => __ENDPOINT_URL__,
        ];
        $from = array_keys($replace);
        $to = array_values($replace);

        // twice replacements
        $method_body = str_replace($from, $to, $method_body);
        $method_body = str_replace($from, $to, $method_body);

        $template_reader->write($method_body, "api/{$replace['#__PACKAGE_NAME__']}/controllers/class.controller_{$replace['#__CLASS_NAME__']}.inc.php");
        return $method_body;
    }

    /**
     * @param $business
     * @return mixed|string
     */
    private function generate_model(business_entity $business): string
    {
        $template_reader = new template_reader();
        $method_body = $template_reader->read("api/model.php.ts");

        $endpoints = new endpoints();
        $methods = array_map(array($endpoints, "methodify_model"), $business->methods_list());

        $dbaccess = new dbaccess();
        $table_name = $business->table_name();
        $primary_key = $dbaccess->_get_primary_key($table_name);

        $keyvalues = [];
        $params = [];
        $columns = $dbaccess->_get_all_columns($table_name);
        foreach($columns as $column)
        {
            # Do not include primary key
            if($column->COLUMN_NAME == $primary_key)
                continue;

            $keyvalues[] = "`{$column->COLUMN_NAME}`=:{$column->COLUMN_NAME}";
            $params[] = "\"{$column->COLUMN_NAME}\" => \$data[\"{$column->COLUMN_NAME}\"]";
        }
        #print_r($columns); die(implode(", ", $keyvalues));

        $replace = [
            "#__PACKAGE_NAME__" => strtolower($business->package_name()),
            "#__CLASS_NAME__" => strtolower($business->class_name()),
            "#__TABLE_NAME__" => strtolower($table_name),
            "#__PRIMARY_KEY__" => $primary_key,
            "#__PUBLIC_METHODS__" => implode("\r\n\t", $methods),
            "#__FLAG_FIELDS__" => implode("\r\n\t", $methods),
            "#__ENDPOINT_URL__" => __ENDPOINT_URL__,

            "#__KEYVALUE_PAIR__" => implode(",\r\n            ", $keyvalues),
            "#__PARAMS__" => implode(",\r\n            ", $params),
        ];
        $from = array_keys($replace);
        $to = array_values($replace);

        // twice replacements
        $method_body = str_replace($from, $to, $method_body);
        $method_body = str_replace($from, $to, $method_body);

        $template_reader->write($method_body, "api/{$replace['#__PACKAGE_NAME__']}/models/class.model_{$replace['#__CLASS_NAME__']}.inc.php");
        return $method_body;
    }
}
