<?php
namespace generators;
use setups\method_descriptor;

/**
 * Class angularifier
 * AngularJS Templates
 * @todo Update for Angular 4.0
 */
class angularifier implements  bodyfier {
    public function generate(): string
    {
        //$this->angular_controller();
    }

    public function angular_router(method_descriptor $method): string
    {
        $caser = new caser();
        $method = $caser->psr4($method->method_name);

        return "
        .state(\"#__MODULE_NAME__.{$method}\", {
			url: \"/edit\",
			templateUrl: template(\"queue/templates/{$method}\"),
			controller: \"#__MODULE_NAME__{$method}Controller\",
		})
";
    }

    public function angular_service(method_descriptor $method): string
    {
        $caser = new caser();
        $method = $caser->psr4($method->method_name);
        return "
                \"{$method}\": function (record) {
                    return fetch(\"#__MODULE_NAME__/{$method}\", record);
                },
";
    }

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
    }

    \$scope.data.init();
}]);
";
        return $method_body;
    }
}
