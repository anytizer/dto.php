<?php

namespace generators;

/**
 * @todo Uses \generators\FIELDS within PDO
 */

namespace generators;

use anytizer\capitalizer;
use anytizer\namifier;
use PDO;
use structures\fields;

/**
 * Class dbaccess
 * @todo Split DBAccess into core db access and property accessors
 *
 * @package generators
 */
class dbaccess
{
    /**
     * Converts Database table into PHP Class properties - DTO
     *
     * @param fields $field
     * @return string
     */
    public function dto_rows(fields $field): string
    {
        $produce_comments = true; // false: for live modes

        $namifier = new namifier();
        $field_definition = "";
        //if(!$this->is_flag($field->COLUMN_NAME)) // @todo Column Name is null
        {
            //$column_name = $namifier->column_name($field->COLUMN_NAME);
            $variable_name = $namifier->variable($field->COLUMN_NAME);
            if ($produce_comments) {
                $field_definition = "
    /**
     * @datatype {$field->DATA_TYPE}
     */
    public {$variable_name};
";
            }
        }

        // define single row
        return $field_definition;
    }

    public function dto_rows_cs(fields $field): string
    {
        $produce_comments = true; // false: for live modes

        $namifier = new namifier();
        $field_definition = "";
        //if(!$this->is_flag($field->COLUMN_NAME)) // @todo Column Name is null
        {
            $datatype = "string";
            switch (strtolower($field->DATA_TYPE)) {
                case "bit":
                case "bool":
                case "boolean":
                    $datatype = "bool";
                    break;
                case "tinyint":
                    $datatype = "int32";
                    break;
                case "binary":
                case "bigint":
                case "date":
                case "datetime":
                case "timestamp":
                case "time":
                case "year":
                    $datatype = "DateTime";
                    break;
                case "decimal":
                case "double":
                case "float":
                case "int":
                case "real":
                case "numeric":
                case "smallint":
                    $datatype = "int";
                    break;
                case "enum":
                case "blob":
                case "char":
                case "longblob":
                case "longtext":
                case "mediumblob":
                case "mediumtext":
                case "text":
                case "tinyblob":
                case "tinytext":
                case "varbinary":
                case "varchar":
                case "set":
                    $datatype = "string";
                    break;
                default:
                    break;
            }

            /**
             * CS compatible column names, eg. AddressID for address_id
             * @todo Prefix IDs are removed. replace. eg. ID for ..._id.
             */
            $column_name = $namifier->column_name($field->COLUMN_NAME);
            $column_name = str_replace(" ", "", $column_name);

            if ($produce_comments) {
                $field_definition = "
        /**
         * @datatype {$field->DATA_TYPE}
         */
        public {$datatype} {$column_name} { get; set; }
";
            }
        }

        // define single row
        return $field_definition;
    }

    public function dto_fillable_rows_laravel(fields $field): string
    {
        $field_definition = "";
        if (!$this->is_flag($field) && !$this->is_autoid($field)) {
            $field_definition = "\"{$field->COLUMN_NAME}\"";
        }
        return $field_definition;
    }

    /**
     * Checks if a column name is for a flag purpose.
     * @param fields $column
     * @return bool
     */
    private function is_flag(fields $column): bool
    {
        $column_name = $column->COLUMN_NAME;
        /**
         * Flag starting as is_...
         */
        $is_prefix_flag = preg_match("/^(is|in)_/is", $column_name);

        /**
         * Flag ending with on, by, ...
         */
        $is_suffix_flag = preg_match("/_(on|by)$/is", $column_name);

        return $is_prefix_flag || $is_suffix_flag;
    }

    /**
     * Auto fillable IDs
     *
     * @param fields $column
     * @return bool
     */
    private function is_autoid(fields $column): bool
    {
        $auto_id = preg_match("/_(id)$/is", $column->COLUMN_NAME);

        return $auto_id;
    }

    public function dto_guarded_rows_laravel(fields $field): string
    {
        $field_definition = "";
        if ($this->is_flag($field) || $this->is_autoid($field)) {
            $field_definition = "\"{$field->COLUMN_NAME}\"";
        }
        return $field_definition;
    }

    /**
     * Generate list of all tables
     *
     * @return string
     */
    public function tables(): string
    {
        global $connection;
        global $orm_name;

        $columns_sql = "
SELECT
	`TABLE_NAME`,
	`ENGINE`,
	`TABLE_COLLATION`
FROM INFORMATION_SCHEMA.TABLES
WHERE
	`TABLE_SCHEMA`=:DATABASE_NAME
	AND `TABLE_TYPE`='BASE TABLE'
ORDER BY
	`TABLE_NAME`
;";
        #echo $columns_sql;
        $statement = $connection->prepare($columns_sql);
        $statement->bindParam(":DATABASE_NAME", $orm_name);
        $statement->execute();
        //$result = $statement->fetchAll();
        $result = $statement->fetchAll(PDO::FETCH_CLASS, "field");
        #print_r($result);
        if (!count($result)) {
            // n-columns to be listed
            return ("# Invalid table name");
        }
        #$result = array_map(array($this, "filter_columns"), $result);
        //$result = array_map(array($this, "rows"), $result);
        #print_r($result);
        $commands = [];
        foreach ($result as $row) {
            $row = (array)$row;
            /**
             * @todo Classname not found as method below: Important
             */
            $class_name = $this->class_name($row['TABLE_NAME']);
            $commands[] = "php -f __generate.php {$row['TABLE_NAME']} > dtos\\class.{$class_name}.inc.php";
        }

        return implode("\r\n", $commands);
    }

    public function _get_primary_key($table_name="")
    {
        $result = $this->_get_all_columns($table_name);
        $primary_key = "_id";
        foreach ($result as $c => $COLUMN) {
            if ($COLUMN->COLUMN_KEY == "PRI") {
                $primary_key = $COLUMN->COLUMN_NAME;
            }
        }

        return $primary_key;
    }

    /**
     * Get a filtered list of columns
     *
     * @param string $TABLE_NAME
     * @return array
     */
    public function _get_columns(string $TABLE_NAME)
    {
        $columns = $this->_get_all_columns($TABLE_NAME);
        // $primary_key = $this->_get_primary_key($TABLE_NAME); // get table prefix here to remove other prefixes
        foreach($columns as $c => $column)
        {
            if($this->is_flag($column)) unset($columns[$c]);
            if($this->is_date($column)) unset($columns[$c]);
            if($this->is_long($column)) unset($columns[$c]);
            if($this->is_autoid($column)) unset($columns[$c]);
        }
        $columns = array_map(array($this, "column_display"), $columns);

        return $columns;
    }

    /**
     * Get all columns
     * @param string $TABLE_NAME
     * @return array
     */
    public function _get_all_columns(string $TABLE_NAME)
    {
        global $connection;
        global $orm_name;

        $columns_sql = "
SELECT
	c.TABLE_NAME,
	c.COLUMN_NAME,
	c.DATA_TYPE,
	c.COLUMN_COMMENT,
	c.COLUMN_DEFAULT,
	c.COLUMN_KEY
FROM INFORMATION_SCHEMA.COLUMNS c
WHERE
	c.TABLE_SCHEMA=:orm_name
	AND c.TABLE_NAME=:TABLE_NAME
ORDER BY
	c.ORDINAL_POSITION
;";
        #echo $columns_sql;
        $statement = $connection->prepare($columns_sql);
        $statement->bindParam(":orm_name", $orm_name);
        $statement->bindParam(":TABLE_NAME", $TABLE_NAME);
        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_CLASS, "\\structures\\fields");
        return $result;
    }

    public function class_businessentity(string $entity, array $methods): string
    {
        /**
         * For each methods
         *   get method name
         *   build body and comments
         *   define return types
         */
        $template_reader = new template_reader();
        $method_body = $template_reader->read("libraries/business/others.php");

        $methodifier = new methodifier();

        $methods = array_map(array($methodifier, "methodify"), $methods);
        $replaces = array(
            "#__CLASS_NAME__" => $entity,
            "#__PUBLIC_METHODS__" => implode("\r\n\t", $methods)
        );
        $method_body = str_replace(array_keys($replaces), array_values($replaces), $method_body);

        // replace again
        $method_body = str_replace(array_keys($replaces), array_values($replaces), $method_body);

        return $method_body;
    }

    /**
     * Replace method
     *
     * @param string $body
     * @return string
     */
    private function replace(string $body): string
    {
        $replace = array();

        $from = array_keys($replace);
        $to = array_values($replace);
        $replaced = str_replace($from, $to, $body);

        return $replaced;
    }

    /**
     * Convert a column name into display text
     * @param fields $column
     * @return fields
     */
    private function column_display(fields $column)
    {
        $names = preg_split("/\_/is", $column->COLUMN_NAME);
        $names = array_map("strtolower", $names);
        $names = array_map("ucfirst", $names);
        #print_r($names); die();

        /**
         * Remove prefixed word
         * @todo if it matches with primary id's prefix only
         */
        if (count($names) >= 2) {
            // if singular of table prefix matches
            // Group Of, Pack Of
            unset($names[0]);
        }

        /**
         * Capitalize special names like ID, etc...
         */
        $capitalizer = new capitalizer();
        $column->COLUMN_DISPLAY = $capitalizer->capitalize(implode(" ", $names));

        // @todo Patch properly
        $column->isPrivate = $column->COLUMN_KEY == "MUL" || $column->COLUMN_KEY == "PRI";
        $column->isDate = $this->is_date($column);

        // @todo Patch properly
        $column->isLong = $this->is_long($column);

        return $column;
    }

    /**
     * If a field is of date/time, may need to install a date picker
     * @param fields $field
     * @return bool
     */
    private function is_date(fields $field): bool
    {
        $is_date = (boolean)preg_match("/\_(on|date)$/is", $field->COLUMN_NAME);
        $this->isDate = $is_date;
        return $is_date;
    }

    /**
     * Determines if the field is too long text
     * @param fields $column
     * @return bool
     * @todo Use field types as well
     *
     */
    private function is_long(fields $column): bool
    {
        $long_flag = preg_match("/_(description|text|body|html)$/is", $column->COLUMN_NAME);

        return $long_flag;
    }
}
