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
        $this->generate_eloquent($business); // not used currently
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

        $template_reader->write($method_body, "api.php/packages/{$replace['#__PACKAGE_NAME__']}/models/class.CustomEloquentModel.inc.php");
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

        $dbaccess = new dbaccess();
        $table_name = $business->table_name();
        $primary_key = $dbaccess->_get_primary_key($table_name);
        $columns = $dbaccess->_get_columns($table_name); // not all columns!
        // @todo WHen in edit mode, display the long columns marked as is_long, as well.
        $inserts_params = [];
        foreach($columns as $column)
        {

            # Do not include primary key
            if($column->COLUMN_NAME == $primary_key)
                continue;

            $default = $column->COLUMN_DEFAULT?"\"{$column->COLUMN_DEFAULT}\"":"null"; // PHP NULL or value wrapped in double quotes
            $inserts_params[] = "\"{$column->COLUMN_NAME}\" => (new sanitize(\$_POST[\"{$column->COLUMN_NAME}\"]??{$default}))->text";
        }

        $replace = [
            "#__PACKAGE_NAME__" => strtolower($business->package_name()),
            "#__CLASS_NAME__" => strtolower($business->class_name()),
            "#__PUBLIC_METHODS__" => implode("\r\n\t", $methods),
            "#__FLAG_FIELDS__" => implode("\r\n\t", $methods), // @todo repeated: flag fields alike public methods
            "#__ENDPOINT_URL__" => __ENDPOINT_URL__,

            "#__INSERTS_SELECTED_PARAMS__" => implode(",\r\n                ", $inserts_params),
        ];
        $from = array_keys($replace);
        $to = array_values($replace);

        // twice replacements
        $method_body = str_replace($from, $to, $method_body);
        $method_body = str_replace($from, $to, $method_body);

        $template_reader->write($method_body, "api.php/packages/{$replace['#__PACKAGE_NAME__']}/controllers/class.controller_{$replace['#__CLASS_NAME__']}.inc.php");
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

        # For edits
        $keyvalues = [];
        $params = [];

        # for inserts
        $inserts_values = [":{$primary_key}"];
        $inserts_columns = ["`{$primary_key}`"]; // array with primary key name
        $inserts_params = [];

        # for list()
        $list_column_heads = ["`{$primary_key}`"];

        $columns = $dbaccess->_get_all_columns($table_name);
        foreach($columns as $column)
        {
            # Do not include primary key
            if($column->COLUMN_NAME == $primary_key)
                continue;

            $keyvalues[] = "`{$column->COLUMN_NAME}`=:{$column->COLUMN_NAME}";
            //$params[] = "\"{$column->COLUMN_NAME}\" => \$data[\"{$column->COLUMN_NAME}\"]"; // raw
            $params[] = "\"{$column->COLUMN_NAME}\" => (new sanitize(\$data[\"{$column->COLUMN_NAME}\"]))->text"; // validated

            $inserts_values[] = ":{$column->COLUMN_NAME}";
            $inserts_columns[] = "`{$column->COLUMN_NAME}`";

            $default = $column->COLUMN_DEFAULT?"\"{$column->COLUMN_DEFAULT}\"":"null"; // PHP NULL or value wrapped in double quotes

            /**
             * @see https://github.com/anytizer/anytizer.php/blob/master/src/anytizer/sanitize.php for rules
             */
            $datatype_rule = "text";
            if(in_array($column->COLUMN_NAME, ["is_active", "is_approved"]))
            {
                $default = "\"Y\""; // in double quotes
                $datatype_rule = "yn";
            }
            if(in_array($column->COLUMN_NAME, ["added_on", "modified_on"]))
            {
                $datatype_rule = "now";
            }
            $inserts_params[] = "\"{$column->COLUMN_NAME}\" => (new sanitize(\$data[\"{$column->COLUMN_NAME}\"]??{$default}))->{$datatype_rule}";

            /**
             * For selected fields only
             */
            if(!$column->isFlag)
            {
                $list_column_heads[] = "`{$column->COLUMN_NAME}`";
            }
        }
        #print_r($list_column_heads); die();
        #print_r($columns); die(implode(", ", $keyvalues));
        #print_r($inserts_columns); print_r($inserts_values); die('');

        $replace = [
            "#__PACKAGE_NAME__" => strtolower($business->package_name()),
            "#__CLASS_NAME__" => strtolower($business->class_name()),
            "#__TABLE_NAME__" => strtolower($table_name),
            "#__PRIMARY_KEY__" => $primary_key,
            "#__PUBLIC_METHODS__" => implode("\r\n\t", $methods),
            "#__FLAG_FIELDS__" => implode("\r\n\t", $methods),
            "#__ENDPOINT_URL__" => __ENDPOINT_URL__,

            // For EDIT mode
            "#__KEYVALUE_PAIR__" => implode(",\r\n            ", $keyvalues),
            "#__PARAMS__" => implode(",\r\n            ", $params),

            // for ADD mode
            "#__INSERTS_COLUMNS__" => implode(",\r\n    ", $inserts_columns),
            "#__INSERTS_VALUES__" => implode(",\r\n    ", $inserts_values),
            "#__INSERTS_PARAMS__" => implode(",\r\n            ", $inserts_params),

            // @todo For list mode, name all the valid columns
            "#__LIST_COLUMN_HEADS__" => implode(", ", $list_column_heads),
        ];
        $from = array_keys($replace);
        $to = array_values($replace);

        // twice replacements because the template may contain replaceable definitions.
        $method_body = str_replace($from, $to, $method_body);
        $method_body = str_replace($from, $to, $method_body);

        $template_reader->write($method_body, "api.php/packages/{$replace['#__PACKAGE_NAME__']}/models/class.model_{$replace['#__CLASS_NAME__']}.inc.php");
        return $method_body;
    }
}
