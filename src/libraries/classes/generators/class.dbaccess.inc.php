<?php
namespace generators;

/**
 * @todo Uses \generators\FIELDS within PDO
 */
namespace generators;
use parsers\parser;
use setups\business_entity;
use structures\field;
use structures\fields;

/**
 * Class dbaccess
 *
 * @package generators
 */
//class dbaccess extends finalized implements parser
class dbaccess
{
    /**
     * Identifies good and bad field names to be filtered
     * @todo unused
     *
     * @param fields $field
     * @return string
     */
    // function filter_columns(fields $field)
    // {
    //     return "public \${$column_name};"; // // {$field->COLUMN_DEFAULT}";
    // }

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
            $column_name = $namifier->column_name($field->COLUMN_NAME);
            if($produce_comments) {
                $field_definition = "
    /**
     * @datatype {$field->DATA_TYPE}
     */
    public \${$column_name};
";
            }
            //else
            //{
            //    $field_definition = "public \${$column_name};";
            //}
        }

        // define single row
        return $field_definition;
    }

    /**
     * Checks if a column name is for a flag purpose.
     * @param string $column_name
     * @return bool
     */
    private function is_flag(string $column_name): bool
    {
        /**
         * Flag starting as is_...
         */
        $is_flag = preg_match("/^is_/is", $column_name);

        /**
         * Flag ending with on, by, ...
         */
        $others_flag = preg_match("/_(on|by)$/is", $column_name);

        return $is_flag||$others_flag;
    }

    /**
     * Determines if the field is too long text
     * @todo Use field types as well
     *
     * @param fields $column
     * @return bool
     */
    private function is_long(fields $column): bool
    {
        $long_flag = preg_match("/_(description|text|body|html)$/is", $column->COLUMN_NAME);

        return $long_flag;
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
        $result = $statement->fetchAll(\PDO::FETCH_CLASS, "field");
        #print_r($result);
        if(!count($result))
        {
            // n-columns to be listed
            return ("# Invalid table name");
        }
        #$result = array_map(array($this, "filter_columns"), $result);
        //$result = array_map(array($this, "rows"), $result);
        #print_r($result);
        $commands = array();
        foreach($result as $row)
        {
            $row = (array)$row;
            $class_name = $this->class_name($row['TABLE_NAME']);
            $commands[] = "php -f __generate.php {$row['TABLE_NAME']} > dtos\\class.{$class_name}.inc.php";
        }

        return implode("\r\n", $commands);
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
     * Replace method
     *
     * @param string $body
     * @return string
     */
    private function replace(string $body): string
    {
        $replace = array(
        );

        $from = array_keys($replace);
        $to = array_values($replace);
        $replaced = str_replace($from, $to, $body);

        return $replaced;
    }

    /**
     * Get a filtered list of columns
     *
     * @param string $TABLE_NAME
     * @return array
     */
    public function _get_columns(string $TABLE_NAME)
    {
        $result = $this->_get_all_columns($TABLE_NAME);
        $result = array_map(array($this, "column_display"), $result);
        #print_r($result); die();

        return $result;
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

        /**
         * Capitalise special names like ID, etc...
         */
        //$caser = new caser();
        //$COLUMN_NAME = $caser->wordify($column->COLUMN_NAME);
        $column->COLUMN_DISPLAY = implode(" ", $names);

        // @todo Patch properly
        $column->isPrivate = $column->COLUMN_KEY == "MUL" || $column->COLUMN_KEY == "PRI";
        $column->isDate = $this->is_date($column);

        // @todo Patch properly
        $column->isLong = $this->is_long($column);

        return $column;
    }

    /**
     * Get all columns
     * @param string $TABLE_NAME
     * @return array
     */
    private function _get_all_columns(string $TABLE_NAME)
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

        $result = $statement->fetchAll(\PDO::FETCH_CLASS, "\\structures\\fields");
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
}