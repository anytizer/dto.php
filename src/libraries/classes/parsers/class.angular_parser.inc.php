<?php

namespace parsers;

use generators\angularifier;
use generators\dbaccess;
use generators\template_reader;
use setups\business_entity;

class angular_parser implements parser
{
    public function generate(business_entity $business)
    {
        $app_js = $this->angular_app_js($business);
        #echo $app_js; die();

        $routes_js = $this->angular_routes_js($business);
        #echo $routes_js; die();

        $directives_js = $this->angular_directives($business);
        #echo $directives_js; die();

        $service_js = $this->angular_service_js($business);
        #echo $service_js; die();

        $controller_js = $this->angular_controller_js($business);
        #echo $controller_js; die();

        # echo $app_js;
        # echo $routes_js;
        # echo $controller;
        # echo $service_js;
    }

    /**
     * Append to app.js.ts
     *
     * @param business_entity $business
     * @return string
     */
    private function angular_app_js(business_entity $business): string
    {
        $template_reader = new template_reader();
        $method_body = $template_reader->read("public_html/entities/js/angularjs/app.js.ts");

        $angularifier = new angularifier();
        $methods = array_map(array($angularifier, "angular_controller"), $business->methods_list());
        $replace = array(
            "#__PACKAGE_NAME__" => $business->package_name(),
            "#__CLASS_NAME__" => $business->class_name(),
            "#__PUBLIC_METHODS__" => implode("\r\n\t", $methods),
            "#__MEDIA_URL__" => __MEDIA_URL__,
            "#__URL__" => "entities/{$business->package_name()}/{$business->class_name()}/js/{$business->class_name()}",
        );

        $from = array_keys($replace);
        $to = array_values($replace);
        $method_body = str_replace($from, $to, $method_body);
        $method_body = str_replace($from, $to, $method_body);

        $template_reader->write($method_body, "public_html/entities/{$business->package_name()}/{$business->class_name()}/js/{$business->class_name()}-app.js");
        return $method_body;
    }

    /**
     * Append to routes.js.ts
     *
     * @param business_entity $business
     * @return string
     */
    private function angular_routes_js(business_entity $business): string
    {
        $template_reader = new template_reader();
        $method_body = $template_reader->read("public_html/entities/js/angularjs/routes.js.ts");

        $angularifier = new angularifier();
        $methods = array_map(array($angularifier, "angular_router"), $business->methods_list());

        $dbaccess = new dbaccess();
        $table_name = $business->table_name();
        $result = $dbaccess->_get_columns($table_name);
        $primary_key = "_id";
        foreach ($result as $c => $COLUMN) {
            if ($COLUMN->COLUMN_KEY == "PRI") {
                $primary_key = $COLUMN->COLUMN_NAME;
            }
        }

        $replace = array(
            "#__PACKAGE_NAME__" => $business->package_name(),
            "#__CLASS_NAME__" => $business->class_name(),
            "#__ANGULAR_ROUTES__" => implode("\r\n\t", $methods),
            "#__MEDIA_URL__" => __MEDIA_URL__,
            "#__URL__" => "entities/{$business->package_name()}/{$business->class_name()}/js/{$business->class_name()}",
            "#__PUBLIC_URL__" => __PUBLIC_URL__,

            "#__PRIMARY_KEY__" => $primary_key,
        );

        $from = array_keys($replace);
        $to = array_values($replace);
        $method_body = str_replace($from, $to, $method_body);
        $method_body = str_replace($from, $to, $method_body);

        $template_reader->write($method_body, "public_html/entities/{$business->package_name()}/{$business->class_name()}/js/{$business->class_name()}-routes.js");
        return $method_body;
    }

    /**
     * Append to directives.js.ts
     *
     * @param business_entity $business
     * @return string
     */
    private function angular_directives(business_entity $business): string
    {
        $template_reader = new template_reader();
        $method_body = $template_reader->read("public_html/entities/js/angularjs/directives.js.ts");

        $angularifier = new angularifier();
        $methods = array_map(array($angularifier, "angular_router"), $business->methods_list());

        $replace = array(
            "#__PACKAGE_NAME__" => $business->package_name(),
            "#__CLASS_NAME__" => $business->class_name(),
            "#__ANGULAR_ROUTES__" => implode("\r\n\t", $methods),
            "#__MEDIA_URL__" => __MEDIA_URL__,
            "#__URL__" => "entities/{$business->package_name()}/{$business->class_name()}/js/{$business->class_name()}",
        );

        $from = array_keys($replace);
        $to = array_values($replace);
        $method_body = str_replace($from, $to, $method_body);
        $method_body = str_replace($from, $to, $method_body);

        $template_reader->write($method_body, "public_html/entities/{$business->package_name()}/{$business->class_name()}/js/{$business->class_name()}-directives.js");
        return $method_body;
    }

    /**
     * Append to routes.js.ts
     *
     * @param business_entity $business
     * @return string
     */
    private function angular_service_js(business_entity $business): string
    {
        $template_reader = new template_reader();
        $method_body = $template_reader->read("public_html/entities/js/angularjs/services.js.ts");

        $angularifier = new angularifier();
        $methods = array_map(array($angularifier, "angular_service"), $business->methods_list());
        $method_body = str_replace("#__CLASS_NAME__", $business->class_name(), $method_body);
        $method_body = str_replace("#__PUBLIC_METHODS__", implode("\r\n\t", $methods), $method_body);

        $replace = array(
            "#__PACKAGE_NAME__" => $business->package_name(),
            "#__CLASS_NAME__" => $business->class_name(),
            "#__ANGULAR_SERVICES__" => implode("\r\n\t", $methods),
            "#__MEDIA_URL__" => __MEDIA_URL__,
            "#__URL__" => "entities/{$business->package_name()}/{$business->class_name()}/js/{$business->class_name()}",
            "#__ENDPOINT_URL__" => __ENDPOINT_URL__,
        );

        $from = array_keys($replace);
        $to = array_values($replace);
        $method_body = str_replace($from, $to, $method_body);
        $method_body = str_replace($from, $to, $method_body);

        $template_reader->write($method_body, "public_html/entities/{$business->package_name()}/{$business->class_name()}/js/{$business->class_name()}-services.js");
        return $method_body;
    }

    /**
     * AngularJS Controllers
     *
     * @param business_entity $business
     * @return string
     */
    private function angular_controller_js(business_entity $business): string
    {
        $template_reader = new template_reader();
        $method_body = $template_reader->read("public_html/entities/js/angularjs/controllers.js.ts");

        $angularifier = new angularifier();
        $methods = array_map(array($angularifier, "angular_controller"), $business->methods_list());

        // @todo Code repeated to calculate primary key
        $dbaccess = new dbaccess();
        $table_name = $business->table_name();
        $result = $dbaccess->_get_columns($table_name);
        $primary_key = "_id";
        foreach ($result as $c => $COLUMN) {
            if ($COLUMN->COLUMN_KEY == "PRI") {
                $primary_key = $COLUMN->COLUMN_NAME;
            }
        }
        #die("Table name: ".$table_name.", Primary key: ".$primary_key);

        $replace = array(
            "#__PACKAGE_NAME__" => $business->package_name(),
            "#__CLASS_NAME__" => $business->class_name(),
            "#__ANGULAR_CONTROLLERS__" => implode("\r\n\t", $methods),
            "#__MEDIA_URL__" => __MEDIA_URL__,
            "#__URL__" => "entities/{$business->package_name()}/{$business->class_name()}/js/{$business->class_name()}",

            // @todo Find and replace correctly
            "#__PRIMARY_KEY__" => $primary_key,
        );

        $from = array_keys($replace);
        $to = array_values($replace);
        $method_body = str_replace($from, $to, $method_body);
        $method_body = str_replace($from, $to, $method_body);

        $template_reader->write($method_body, "public_html/entities/{$business->package_name()}/{$business->class_name()}/js/{$business->class_name()}-controllers.js");
        return $method_body;
    }
}
