<?php
namespace generators;
use setups\business_entity;
use setups\method_descriptor;

/**
 * Class bodyfier
 * PHP Class body template maker
 *
 * @package generators
 */
class bodyfier
{
    private $caser;
    public function __construct()
    {
        $this->caser = new caser();
    }

    /**
     * Converts a word into a property name for PHP Class
     *
     * @param string $name
     * @param bool $remove_prefix
     * @param bool $ucfirst
     * @param string $glue
     * @return string
     */
    public function namify(string $name, bool $remove_prefix, bool $ucfirst, string $glue): string
    {
        $words = explode("_", strtolower($name));
        if(count($words) >= 2)
        {
            if($remove_prefix==true)
            {
                unset($words[0]);
            }

            if($ucfirst==true)
            {
                $words = array_map("ucfirst", $words); // UpperCasedName
            }
        }

        $name = implode($glue, $words);
        return $name;
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
        // \$this->#__CLASSNAME__->{$method}();
        
        return true;
    }
";
        return $method_body;
    }

    /**
     * Business entities
     *
     * @param method_descriptor $method
     * @return string
     */
    public function businessify(method_descriptor $method): string
    {
        $description = $method->description;
        $method_name = $method->method_name;
        $parameters = $method->parameters;

        # Get all fields
        # write all fields with write
        # save

        $method_body = "
    /**
     * {$description}
     */
    public function {$method_name}({$parameters}): bool
    {
        // add, edit, delete, details, list, flag
        // do other query things()
        
        #\$#__CLASSNAME___orm = new #__CLASSNAME___orm();
        #\$#__CLASSNAME___orm->name = \$parameters->name;
        #\$#__CLASSNAME___orm->value = \$parameters->value;
        #\$#__CLASSNAME___orm->save();
        
        return true;
    }
";
        return $method_body;
    }

    /**
     * Database wrapper
     *
     * @param method_descriptor $method
     * @return string
     */
    public function databasify(method_descriptor $method): string
    {
        $description = $method->description;
        $method_name = $method->method_name;
        $parameters = $method->parameters;

        $method_body = "
    /**
     * {$description}
     */
    public function {$method_name}({$parameters}): bool
    {
        // INSERT, SELECT, UPDATE, DELETE, FLAG?

        #\$#__MODEL_NAME__ = new #__MODEL_NAME__();
        #\$#__MODEL_NAME__->id = \"\";
        #\$#__MODEL_NAME__->save();
        
        return true;
    }
";
        return $method_body;
    }

    /**
     * Converts a word into PHPUnit Test Case
     *
     * @param method_descriptor $method
     * @return string
     */
    public function phpunitTestify(method_descriptor $method): string
    {
        $method_name = $method->method_name;

        # optional
        $testMethodName = $this->caser->psr4($method_name);

        $timestamp = date("Y-m-d");

        // skip creating unit tests for private methods
        $method_comments = "";
        if($this->is_private($method_name))
        {
            # return $method_comments = "(private method)";
        }

        $method_description = $method->description;
        $parameters = $method->parameters;

        /**
         * Create parameters if any
         */
        $parameters_initialization = "";
        $pi = explode(", ", $parameters);
        $pi = array_map("trim", $pi);
        $pi = array_filter($pi);
        if(count($pi)>0)
        {
            #print_r($pi);
            foreach($pi as $p => $initialization)
            {
                $pi[$p] = "{$initialization} = null;";
            }

            #print_r($pi); die();
            $parameters_initialization = "\r\n        ".implode("\r\n        ", $pi)."\r\n";
        }
        #print_r($pi);

        $method_body = "
    /**
     * {$method_description}
     * {$method_comments}
     * @issue #000000
     * {$timestamp}
     */
    public function test{$testMethodName}()
    {   {$parameters_initialization}
        \$output = \$this->#__CLASSNAME___business->{$method_name}($parameters);
        
        \$this->assertEquals(true, \$output);
        # \$this->markTestIncomplete();
    }
";
        return $method_body;
    }

    /**
     * Angular JS Controller
     *
     * @param string $method
     * @return string
     */
    public function angular_controller(string $method): string
    {
        #$method = $this->caser->snake_case($method);
        #$method = $this->caser->psr4($method); // MUST

        $method_body = "
{#__CLASSNAME__}App.controller(
    function()
    {
        //
        \$scope.data = {
            'init': function(){
            },
        }
    }
);
";
        return $method_body;
    }

    public function endpoints(method_descriptor $method)
    {
        // only for public methods
        // URLs fix
        $url_snippet = preg_replace("/\\_/is", "-", $method->method_name);

        $method_body="
    /**
     * {$method->description}
     *
     * @url http://api.example.com:9090/v0.0.1/api/#__CLASSNAME__/{$url_snippet}
     */
    private function {$method->method_name}(): bool
    {
        \$role = new role();
        \$APIUser = new APIUser();
        
        if(\$user->can(\$role->method(\"{$method->method_name}\")))
        {
            \$this->#__CLASSNAME__->{$method->method_name}($method->parameters);
        }
        
        return true;
    }
";
        return $method_body;
    }

    /**
     * HTML List
     *
     * @param method_descriptor $method
     * @return string
     */
    public function htmlListify(method_descriptor $method): string
    {
        // #__LISTED_ROWS__
        $method_body = "
<div>
    <div>Field</div>
    <div>Value {{\$entity.{$method->method_name}}}</div>
</div>
        ";
        return $method_body;
    }

    /**
     * HTML Details
     *
     * @param method_descriptor $method
     * @return string
     */
    public function htmlDetails(method_descriptor $method): string
    {
        $method_body = "
<div>
    <div>Field</div>
    <div>Value {{\$entity.{$method->method_name}}}</div>
</div>
        ";
        return $method_body;
    }

    /**
     * HTML Edit
     *
     * @param method_descriptor $method
     * @return string
     */
    public function htmlEdit(method_descriptor $method): string
    {
        $method_body = "
<div>
<div>Field</div>
<div>Value {{\$entity.{$method->method_name}}}</div>
</div>
        ";
        return $method_body;
    }

    /**
     * HTML Flag
     *
     * @param method_descriptor $method
     * @return string
     */
    public function htmlFlag(method_descriptor $method): string
    {
        $method_body = "
Flagged
        ";
        return $method_body;
    }

    /**
     * HTML Delete
     *
     * @param method_descriptor $method
     * @return string
     */
    public function htmlDelete(method_descriptor $method): string
    {
        $method_body = "
Deleted
";
        return $method_body;
    }

    /**
     * HTML Add
     *
     * @param method_descriptor $method
     * @return string
     */
    public function htmlAdd(method_descriptor $method): string
    {
        $method_body = "";
        return $method_body;
    }

    /**
     * Identifies if a method name is private
     *   - has __ prefix (double underscores)
     *   - has : prefix (colon)
     * @param $method
     * @return bool
     */
    private function is_private($method)
    {
        return preg_match("/^[_]{2}/is", $method) || preg_match("/^\\:/is", $method);
    }
}