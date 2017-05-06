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

        $method_body = "
    /**
     * {$method->description}
     *
     * @url http://api.example.com:9090/v0.0.1/api/#__CLASS_NAME__/{$url_snippet}
     */
    private function {$method->method_name}(): bool
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