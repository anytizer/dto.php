<?php
namespace parsers;
use generators\bodyfier;
use setups\business_entity;
use generators\template_reader;
use generators\angularifier;

class angular_parser implements parser
{
    public function generate(business_entity $business)
    {
        // controller
        // app.js
        // routes
        // service
        // api end point
    }

    /**
     * Append to app.js
     *
     * @param business_entity $business
     * @return string
     */
    public function angular_app_js(business_entity $business): string
    {
        $template_reader = new template_reader();
        $method_body = $template_reader->read("public_html/entities/js/app.js");

        $angularifier = new angularifier();
        $methods = array_map(array($angularifier, "angular_controller"), $business->methods_list());
        $method_body = str_replace("#__CLASSNAME__", $business->class_name(), $method_body);
        $method_body = str_replace("#__PUBLIC_METHODS__", implode("\r\n\t", $methods), $method_body);

        $template_reader->write($method_body, "public_html/entities/{$business->class_name()}/js/app.js");
        return $method_body;
    }

    /**
     * Append to routes.js
     *
     * @param business_entity $business
     * @return string
     */
    public function angular_routes_js(business_entity $business): string
    {
        $template_reader = new template_reader();
        $method_body = $template_reader->read("public_html/entities/js/routes.js");

        $angularifier = new angularifier();
        #$methods = array_map(array($angularifier, "angular_router"), $methods);
        $method_body = str_replace("#__CLASSNAME__", $business->class_name(), $method_body);
        #$method_body = str_replace("#__PUBLIC_METHODS__", implode("\r\n\t", $methods), $method_body);

        $template_reader->write($method_body, "public_html/entities/{$business->class_name()}/js/routes.js");
        return $method_body;
    }

    /**
     * AngularJS Controllers
     *
     * @param business_entity $business
     * @return string
     */
    public function angular_controller_js(business_entity $business): string
    {
        $template_reader = new template_reader();
        $method_body = $template_reader->read("public_html/entities/js/controller.js");

        $angularifier = new angularifier();
        $methods = array_map(array($angularifier, "angular_controller"), $methods);

        $method_body = str_replace("#__CLASSNAME__", $business->class_name(), $method_body);
        //$method_body = str_replace("#__PUBLIC_METHODS__", implode("\r\n\t", $methods), $method_body);

        $template_reader->write($method_body, "public_html/entities/{$business->class_name()}/js/controller.js");
        return $method_body;
    }
    /**
     * Append to routes.js
     *
     * @param business_entity $business
     * @return string
     */
    public function angular_service_js(business_entity $business): string
    {
        $template_reader = new template_reader();
        $method_body = $template_reader->read("public_html/entities/js/services.js");

        $angularifier = new angularifier();
        $methods = array_map(array($bodyfier, "angular_service"), $methods);
        $method_body = str_replace("#__CLASSNAME__", $business->class_name(), $method_body);
        #$method_body = str_replace("#__PUBLIC_METHODS__", implode("\r\n\t", $methods), $method_body);

        $template_reader->write($method_body, "public_html/entities/{$business->class_name()}/js/services.js");
        return $method_body;
    }
}