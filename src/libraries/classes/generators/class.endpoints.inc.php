<?php
namespace generators;
use setups\method_descriptor;

class endpoints extends generator implements bodyfier
{
    public function generate(): string
    {
        $body = $this->endpointify();
        return $body;
    }

    public function methodify(method_descriptor $method): string
    {
        // only for public methods
        // URLs fix
        $url_snippet = preg_replace("/\\_/is", "-", $method->method_name);

        $accessor = $method->accessor;
        $parameters = $method->parameters;
        $return_type = $method->return_type;

        // @todo Handle even if there are no parameters
		// @todo Support using class names as parameter descriptors
        //print_r($method); die();

        $method_body = "
    /**
     * {$method->description}
     *
     * @url http://api.example.com:9090/api-v0.0.1/#__PACKAGE_NAME__/#__CLASS_NAME__/{$url_snippet}
     */
    {$accessor} function {$method->method_name}({$parameters}): {$return_type}
    {
        if(\$this->APIUser->can(\$this->role->method(\"{$method->method_name}\")))
        {
            \$this->#__CLASS_NAME__->{$method->method_name}($method->parameters);
        }
        
        return true;
    }
";
        return $method_body;
    }
}