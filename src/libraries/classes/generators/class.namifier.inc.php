<?php
namespace generators;
use setups\method_descriptor;

/**
 * Converts words into proper names
 * Class namifier
 * @package generators
 */
class namifier
{
    private $caser;
    public function __construct()
    {
        $this->caser = new caser();
    }

    /**
     * Single word package name
     *
     * @param string $name
     * @return string
     */
    public function package_name(string $name): string
    {
        # eg. Tailing: measurements ==> Tailoring
        $name = preg_replace("/\\:.*?$/", "", $name);
        return $this->caser->wordify($name);
    }

    /**
     * Gets a class name
     *
     * @param $class_name
     * @return string
     */
    public function class_name(string $class_name): string
    {
        /**
         * Trim if separated by : as "Module: Class"
         */
        // eg. "water bills: payment" becomes "payment"
        $class_name = preg_replace("/^(.*?\\:)/is", "", $class_name);

        #$class_name = $this->caser->snake_case($class_name);
        $class_name = $this->caser->psr4($class_name);

        return $class_name;
    }

    /**
     * Gets a column name
     *
     * @param string $dto_name
     * @return string
     */
    public function dto_name(string $dto_name): string
    {
        $caser = new caser();
        $dto_name = $caser->wordify($dto_name);

        return $dto_name;
    }

    /**
     * PHP Method names
     *
     * @see $this->method()
     * @param string $name
     * @return string
     */
    private function php_method_name(string $name): string
    {
        // remove parameters
        $name = preg_replace("/\\(.*?$/", "", $name);
        $name = trim($name);

        $class_name = $this->caser->snake_case($name);

        return $class_name;
    }

    /**
     * Method title
     *
     * @see $this->method()
     * @param string $name
     * @return string
     */
    private function title(string $name): string
    {
        // remove parameters
        $name = preg_replace("/\\(.*?$/", "", $name);
        $name = trim($name);

        $class_name = $this->caser->wordify($name);

        return $class_name;
    }

    /**
     * Parameters
     *
     * @see $this->method()
     * @param $name
     * @return array
     */
    private function parameters($name): array
    {
        // get parameters
        // split with comma
        // prepend dollar sign
        // namify variables
        // implode with ,
        $parameters = array();

        $matches = array();
        if(preg_match("/\\((.*?)\\)/", $name, $matches))
        {
            $parameters = preg_split("/,/", $matches[1]);
            $parameters = array_map("trim", $parameters);
            $parameters = array_map(array($this, "variable"), $parameters);
        }

        return $parameters;
    }

    /**
     * @param string $name
     * @return method_descriptor
     */
    public function method(string $name): method_descriptor
    {
        $descriptor = new method_descriptor();
        $descriptor->method_name =  $this->php_method_name($name);
        $descriptor->description = $this->title($name);
        $descriptor->parameters = implode(", ", $this->parameters($name));

        return $descriptor;
    }

    /**
     * Convert a parameter name into PHP Variable name
     *
     * @param string $name
     * @return string
     */
    public function variable(string $name): string
    {
        $name = $this->caser->snake_case($name);

        $variable = "\${$name}";

        return $variable;
    }

    /**
     * Gets a column name
     *
     * @param $column_name
     * @return string
     */
    public function column_name(string $column_name): string
    {
        // hide id,
        // hide flags
        // date long table
        // define single row
        // return null;
        $caser = new caser();
        $column_name = $caser->snake_case($column_name);

        return $column_name;
    }
}