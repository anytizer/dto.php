<?php

namespace generators;

use anytizer\method_descriptor;

class endpoints extends generator implements bodyfier
{
    public function generate(): string
    {
        $body = $this->endpointify();
        return $body;
    }

    /**
     * Generate controller
     *
     * @param method_descriptor $method
     * @return string
     */
    public function methodify(method_descriptor $method): string
    {
        // only for public methods
        // URLs fix
        $url_snippet = preg_replace("/\\_/is", "-", $method->method_name);

        $accessor = $method->accessor;
        $parameters = "\$data=array()"; // $method->parameters;
        $return_type = "array"; // $method->return_type;

        // @todo Handle even if there are no parameters
        // @todo Support using class names as parameter descriptors
        //print_r($method); die();

        /**
         * @todo add phpDocComments in produced output
         */
        $method_body = "
    /**
     * {$method->description}
     *
     * @see #__ENDPOINT_URL__
     * @url {{url}}/#__PACKAGE_NAME__/#__CLASS_NAME__/{$url_snippet}
     * @param {$parameters}
     * @return {$return_type}
     */
    {$accessor} function post_{$method->method_name}({$parameters}): {$return_type}
    {
        \$response = null;
        //if(\$this->APIUser->can(\$this->role->method(\"{$method->method_name}\")))
        {
            \$m = new model_#__CLASS_NAME__();
            \$response = \$m->{$method->method_name}(\$_POST); // @todo fix super global
        }
        
        return \$response;
    }
";
        return $method_body;
    }

    /**
     * Generate model
     *
     * @param method_descriptor $method
     * @return string
     */
    public function methodify_model(method_descriptor $method): string
    {
        if(in_array($method->method_name, ["list", "details", "delete", "flag", "edit"]))
        {
            return "";
        }

        $accessor = $method->accessor;
        $parameters = "\$data=array()"; // $method->parameters;
        $return_type = "array"; // $method->return_type;

        $method_body = "
    /**
     * {$method->description}
     */
    {$accessor} function {$method->method_name}({$parameters}): {$return_type}
    {
        \$sql = \"SELECT * FROM `#__TABLE_NAME__` LIMIT 10;\";
        \$statement = \$this->pdo->prepare(\$sql);
        \$params = [];
        \$statement->execute(\$params);
        \$result = \$statement->fetchAll(PDO::FETCH_ASSOC);
        return \$result;
    }
";
        return $method_body;
    }
}
