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
        if(in_array(strtolower($method->method_name), ["add"]))
        {
            return "";
        }
        // only for public methods
        // URLs fix
        $url_snippet = preg_replace("/\\_/is", "-", $method->method_name);

        $accessor = $method->accessor;
        $parameters = "\$data=[]"; // $method->parameters;
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
        /**
         * The following methods have been coded manually
         */
        if(in_array(strtolower($method->method_name), ["list", "details", "delete", "flag", "edit", "add"]))
        {
            return "";
        }

        $accessor = $method->accessor;
        $parameters = "\$data=[]"; // $method->parameters;
        $return_type = "array"; // $method->return_type??"void";

        /**
         * @todo Introduce business model for common ORM, so that there is no need to write queries manually.
         * e.g. $list = $business_orm->get_list();
         * e.g. $details = $business_orm->details('id');
         * e.g. $success = $business_orm->flag('id');
         * e.g. $success = $business_orm->delete('id');
         */
        $method_body = "
    /**
     * {$method->description}
     * @param {$parameters}
     * @return array
     */
    {$accessor} function {$method->method_name}({$parameters}): {$return_type}
    {
        \$sql = \"SELECT * FROM `#__TABLE_NAME__` WHERE is_active='Y' LIMIT 10;\";
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
