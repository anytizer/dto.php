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
 * Class dtoparser
 *
 * @package generators
 */
//class dbaccess extends finalized implements parser
class dbaccess
{
    /**
     * Identifies good and bad field names to be filtered
     * @tod unused
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
        $produce_comments = false; // for live modes

        $namifier = new namifier();
        $field_definition = "";
        if(!$this->is_flag($field->COLUMN_NAME)) // @todo Column Name is null
        {
            $column_name = $namifier->column_name($field->COLUMN_NAME);
            if($produce_comments) {
                $field_definition = "
    /**
     * @var {$field->DATA_TYPE}
     */
    public \${$column_name};
";
            }
            else
            {
                $field_definition = "public \${$column_name};";
            }
        }

        // define single row
        return $field_definition;
    }

    /**
     * @param string $column_name
     * @return bool
     */
    private function is_flag(string $column_name): bool
    {
        $is_flag = preg_match("/_(on|by)$/is", $column_name);
        //$is_flag = preg_match("/_[on|by]$/is", $column_name) || preg_match("/^(is)_/is", $column_name);
        return $is_flag == 1;
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
     * @param string $TABLE_NAME
     * @return array
     */
    public function _get_columns(string $TABLE_NAME)
    {
        global $connection;
        global $orm_name;

        $columns_sql = "
SELECT
	c.TABLE_NAME,
	c.COLUMN_NAME,
	c.DATA_TYPE,
	c.COLUMN_COMMENT,
	c.COLUMN_DEFAULT
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

        $bodyfier = new bodyfier();

        $methods = array_map(array($bodyfier, "methodify"), $methods);
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