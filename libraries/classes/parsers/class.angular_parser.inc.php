<?php
namespace parsers;
use setups\business_entity;
use generators\template_reader;
use generators\angularifier;

class angular_parser implements parser
{
    public function generate(business_entity $business)
    {
        // controller
        // app.js.ts
        // routes
        // service
        // api end point
    }

    /**
     * Append to app.js.ts
     *
     * @param business_entity $business
     * @return string
     */
    public function angular_app_js(business_entity $business): string
    {
        $template_reader = new template_reader();
        $method_body = $template_reader->read("public_html/entities/js/app.js.ts");

        $angularifier = new angularifier();
        $methods = array_map(array($angularifier, "angular_controller"), $business->methods_list());
        $method_body = str_replace("#__CLASSNAME__", $business->class_name(), $method_body);
        $method_body = str_replace("#__PUBLIC_METHODS__", implode("\r\n\t", $methods), $method_body);

        $template_reader->write($method_body, "public_html/entities/{$business->class_name()}/js/app.js.ts");
        return $method_body;
    }

    /**
     * Append to routes.js.ts
     *
     * @param business_entity $business
     * @return string
     */
    public function angular_routes_js(business_entity $business): string
    {
        $template_reader = new template_reader();
        $method_body = $template_reader->read("public_html/entities/js/routes.js.ts");

        $angularifier = new angularifier();
        $methods = array_map(array($angularifier, "angular_router"), $business->methods_list());
        $method_body = str_replace("#__CLASSNAME__", $business->class_name(), $method_body);
        #$method_body = str_replace("#__PUBLIC_METHODS__", implode("\r\n\t", $methods), $method_body);

        $template_reader->write($method_body, "public_html/entities/{$business->class_name()}/js/routes.js.ts");
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
        $method_body = $template_reader->read("public_html/entities/js/controller.js.ts");

        $angularifier = new angularifier();
        $methods = array_map(array($angularifier, "angular_controller"), $business->methods_list());

        $method_body = str_replace("#__CLASSNAME__", $business->class_name(), $method_body);
        $method_body = str_replace("#__PUBLIC_METHODS__", implode("\r\n\t", $methods), $method_body);

        $template_reader->write($method_body, "public_html/entities/{$business->class_name()}/js/controller.js.ts");
        return $method_body;
    }
    /**
     * Append to routes.js.ts
     *
     * @param business_entity $business
     * @return string
     */
    public function angular_service_js(business_entity $business): string
    {
        $template_reader = new template_reader();
        $method_body = $template_reader->read("public_html/entities/js/services.js.ts");

        $angularifier = new angularifier();
        $methods = array_map(array($angularifier, "angular_service"), $business->methods_list());
        $method_body = str_replace("#__CLASSNAME__", $business->class_name(), $method_body);
        #$method_body = str_replace("#__PUBLIC_METHODS__", implode("\r\n\t", $methods), $method_body);

        $template_reader->write($method_body, "public_html/entities/{$business->class_name()}/js/services.js.ts");
        return $method_body;
    }
}