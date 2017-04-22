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
        return "";
    }

    public function angular_service(method_descriptor $method): string
    {
        return "";
    }

    public function angular_controller(method_descriptor $method): string
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
        
        \$scope.data.init();
    }
);
";
        return $method_body;
    }
}