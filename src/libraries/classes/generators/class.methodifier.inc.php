<?php
namespace generators;

class methodifier implements  bodyfier {

    public function generate(): string
    {
        $this->methodify();
    }

    /**
     * Converts a word into PHP Class method
     *
     * @param string $method_descriptive
     * @return string
     */
    public function methodify(string $method_descriptive): string
    {
        $accessor = "public";

        // "__is private"
        if(preg_match("/^__/is", $method_descriptive))
        {
            $accessor = "private";

            // do not keep _function() underscore in private functions
            $method_descriptive = preg_replace("/^__/is", "", $method_descriptive);
        }

        // or, ":is_private()"
        if(preg_match("/^\\:/is", $method_descriptive))
        {
            $accessor = "private";

            // do not keep _function() underscore in private functions
            $method_descriptive = preg_replace("/^\\:/is", "", $method_descriptive);
        }

        $method = $this->caser->snake_case($method_descriptive);
        //$method = $this->caser->psr4($method_descriptive);
        //$method = $this->caser->psr0($method_descriptive);

        $method_comments = ucfirst($method_descriptive);

        $method_body = "
    /**
     * {$method_comments}
     */
    {$accessor} function {$method}(): bool
    {
        // \$this->#__CLASS_NAME__->{$method}();
        
        return true;
    }
";
        return $method_body;
    }
}