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
        $class_body = $template_reader->read("libraries/dtos/package/class.template.inc.php.ts");

        # print_r($business);
        $table_name = $business->table_name();
        #echo sprintf("\r\nDTO from table [%s]", $table_name);

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

    public function dto_file(business_entity $business): string
    {
        $template_reader = new template_reader();
        $class_body = $template_reader->read("libraries/dtos/class.dto.inc.php.ts");

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

        $template_reader->write($class_body, "libraries/dtos/class.dto.inc.php");
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

    /**
     * Alike generate(), but for CS only
     * @param business_entity $business
     * @return string
     */
    public function cs(business_entity $business): string
    {
        $template_reader = new template_reader();
        $class_body = $template_reader->read("libraries/dtos/package/class.template.inc.cs.ts");

        $table_name = $business->table_name();

        $dbaccess = new dbaccess();
        $result = $dbaccess->_get_columns($table_name);
        if(count($result))
        {
            $result = array_map(array($dbaccess, "dto_rows_cs"), $result);
            $result = array_filter($result);
            $fields = implode("\r\n        ", $result);

            $class_name = $business->class_name();
            $dto_name = $business->dto_name_cs($class_name);

            $class_body = str_replace("#__PACKAGE_NAME__", $business->package_name(), $class_body);
            $class_body = str_replace("#__DTO_NAME__", $business->dto_name(), $class_body);
            $class_body = str_replace("#__CLASS_NAME__", $class_name, $class_body);
            $class_body = str_replace("#__TABLE_NAME__", $table_name, $class_body);
            $class_body = str_replace("#__FIELDS__",    $fields, $class_body);
        }
        else
        {
            die("Not enough tables listed.");
        }

        // @todo rename to class.DTONAMEDDTO.inc.php
        $template_reader->write($class_body, "libraries/dtos.cs/{$business->package_name()}/{$business->dto_name()}.cs");
        return $class_body;
    }
    
    /**
     * Alike generate(), but for laravel only
     * @param business_entity $business
     * @return string
     */
    public function laravel(business_entity $business): string
    {
        $template_reader = new template_reader();
        $class_body = $template_reader->read("libraries/dtos/package/class.template.inc.laravel.ts");

        $table_name = $business->table_name();

        $dbaccess = new dbaccess();
        $result = $dbaccess->_get_columns($table_name);
        #print_r($result); die();
        if(count($result))
        {
            $fields = array_map(array($dbaccess, "dto_rows"), $result);
            $fields = array_filter($fields);
            $fields = implode("\r\n\t", $fields);
            
            $fields_fillable = array_map(array($dbaccess, "dto_fillable_rows_laravel"), $result);
            $fields_fillable = array_filter($fields_fillable);
            $fields_fillable = implode(",\r\n		", $fields_fillable);
            
            $fields_guarded = array_map(array($dbaccess, "dto_guarded_rows_laravel"), $result);
            $fields_guarded = array_filter($fields_guarded);
            $fields_guarded = implode(",\r\n		", $fields_guarded);
            
            #print_r($result); die();
            $primary_key = "_id";
            foreach($result as $c => $COLUMN)
            {
                if($COLUMN->COLUMN_KEY=="PRI")
                {
                    $primary_key = $COLUMN->COLUMN_NAME;
                }
            }

            $class_name = $business->class_name();
            $dto_name = $business->dto_name($class_name);

            $class_body = str_replace("#__PACKAGE_NAME__", strtolower($business->package_name()), $class_body);
            $class_body = str_replace("#__MODEL_NAME__", $business->model_name(), $class_body);
            $class_body = str_replace("#__CLASS_NAME__", $class_name, $class_body);
            $class_body = str_replace("#__TABLE_NAME__", $table_name, $class_body);
            $class_body = str_replace("#__FIELDS__", $fields, $class_body);
            $class_body = str_replace("#__FILLABLE_COLUMNS__", $fields_fillable, $class_body);
            $class_body = str_replace("#__GUARDED_COLUMNS__", $fields_guarded, $class_body);
            $class_body = str_replace("#__PRIMARY_KEY__", $primary_key, $class_body);
        }
        else
        {
            die("Not enough tables listed.");
        }

        // @todo rename to class.DTONAMEDDTO.inc.php
        $template_reader->write($class_body, "libraries/models.laravel/{$business->package_name()}/class.{$business->model_name()}.inc.php");
        return $class_body;
    }
}