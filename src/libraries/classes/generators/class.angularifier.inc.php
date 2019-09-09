<?php

namespace generators;

use setups\method_descriptor;
use anytizer\caser;

/**
 * Class angularifier
 * AngularJS Templates
 * @todo Update for Angular 4.0
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
        return "
                \"{$method}\": function (data) {
                    return fetch(\"{$method}\", data);
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
