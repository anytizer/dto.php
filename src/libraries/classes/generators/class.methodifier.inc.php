<?php
namespace generators;

class methodifier implements  bodyfier {

    public function generate(): string
    {
        $this->methodify();
    }

    public function accessor(string $method_descriptive): string
    {
        $accessor = "public";
        if(preg_match("/^_/is", $method_descriptive))
        {
            $accessor = "private";
        }
        if(preg_match("/^\\:/is", $method_descriptive))
        {
            $accessor = "private";
        }

        return $accessor;
    }

    public function return_type(string $method_descriptive): string
    {
        /**
         * If return type is defined, grab it
         */
        if(preg_match("/\:\s?\w/is", $method_descriptive))
        {
            $return_type = preg_replace("/^.*?\:\s?+/", "", $method_descriptive);
            $return_type = trim($return_type);
        }
        else
        {
            $return_type = "bool";
        }

        return $return_type;
    }

    /**
     * Converts a word into PHP Class method
     *
     * @param string $method_descriptive
     * @return string
     */
    public function methodify(string $method_descriptive): string
    {
        $accessor = $this->accessor($method_descriptive);

        // "_is private"
        // "__is private"
        if(preg_match("/^_/is", $method_descriptive))
        {
            // do not keep _function() underscore in private functions
            $method_descriptive = preg_replace("/^__/is", "", $method_descriptive);
        }

        // or, ":is_private()"
        if(preg_match("/^\\:/is", $method_descriptive))
        {
            // do not keep _function() underscore in private functions
            $method_descriptive = preg_replace("/^\\:/is", "", $method_descriptive);
        }

        $caser = new caser();
        $method = $caser->snake_case($method_descriptive);
        //$method = $caser->psr4($method_descriptive);
        //$method = $caser->psr0($method_descriptive);

        $method_comments = ucfirst($method_descriptive);
        $parameters = "";
        $return_type = $this->return_type($method_descriptive);

        $method_body = "
    /**
     * {$method_comments}
     * @return {$return_type}
     */
    {$accessor} function {$method}({$parameters}): {$return_type}
    {
        // \$this->#__CLASS_NAME__->{$method}();
        
        return true;
    }
";
        return $method_body;
    }
}