<?php

namespace generators;

use anytizer\caser;
use anytizer\method_descriptor;

/**
 * Class angularifier
 * AngularJS Templates
 * @todo Update for Angular 8.0
 */
class angularifier implements bodyfier
{
    /**
     * @return string
     */
    public function generate(): string
    {
        //$this->angular_controller();
    }

    /**
     * @param method_descriptor $method
     * @return string
     */
    public function angular_router(method_descriptor $method): string
    {
        $caser = new caser();
        $method = $caser->psr4($method->method_name);

        return "
        .state(\"#__CLASS_NAME__.{$method}\", {
			url: \"/{$method}\",
			templateUrl: template(\"{$method}\"),
			controller: \"#__CLASS_NAME__{$method}Controller\",
		})
";
    }

    /**
     * @param method_descriptor $method
     * @return string
     */
    public function angular_service(method_descriptor $method): string
    {
        $caser = new caser();
        $method = $caser->psr4($method->method_name);
        $template = strtolower($method.".html");
        return "
                \"{$method}\": function (data) {
                    return fetch(\"{$template}\", data);
                },
";
    }

    /**
     * @param method_descriptor $method
     * @return string
     */
    public function angular_controller(method_descriptor $method): string
    {
        $caser = new caser();
        $method = $caser->psr4($method->method_name);

        /**
         * Pre-implemented featured do not need a template
         * If any other was requested, proceed.
         */
        if(in_array($method, ["List", "Details", "Add", "Edit", "Delete", "Search", "Flag"]))
        {
            return "";
        }

        $method_body = "
#__CLASS_NAME__App.controller(\"{$method}Controller\", [\"\$scope\", function(\$scope)
{
    \$scope.data = {
        \"init\": function(){
        },
    };

    \$scope.data.init();
}]);
";
        return $method_body;
    }
}
