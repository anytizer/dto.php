<?php
namespace parsers;
use setups\business_entity;
use generators\template_reader;
use generators\endpoints;

/**
 * Class endpoints_parser
 * @package parsers
 *
 * @see https://developer.github.com/v3/
 */
class endpoints_parser implements  parser
{
    public function generate(business_entity $business)
    {
        $this->generate_controller($business);
        $this->generate_model($business);
    }

    /**
     * @param $business
     * @return mixed|string
     */
    private function generate_controller(business_entity $business): string
    {
        $template_reader = new template_reader();
        $method_body = $template_reader->read("api/controller.php.ts");

        $endpoints = new endpoints();
        $methods = array_map(array($endpoints, "methodify"), $business->methods_list());

        $replace = [
            "#__PACKAGE_NAME__" => strtolower($business->package_name()),
            "#__CLASS_NAME__" => strtolower($business->class_name()),
            "#__PUBLIC_METHODS__" => implode("\r\n\t", $methods),
            "#__FLAG_FIELDS__" => implode("\r\n\t", $methods),
            "#__ENDPOINT_URL__" => __ENDPOINT_URL__,
        ];
        $from = array_keys($replace);
        $to = array_values($replace);

        // twice replacements
        $method_body = str_replace($from, $to, $method_body);
        $method_body = str_replace($from, $to, $method_body);

        $template_reader->write($method_body, "api/{$replace['#__PACKAGE_NAME__']}/controllers/class.controller_{$replace['#__CLASS_NAME__']}.inc.php");
        return $method_body;
    }
    
    /**
     * @param $business
     * @return mixed|string
     */
    private function generate_model(business_entity $business): string
    {
        $template_reader = new template_reader();
        $method_body = $template_reader->read("api/model.php.ts");

        $endpoints = new endpoints();
        $methods = array_map(array($endpoints, "methodify_model"), $business->methods_list());

        $replace = [
            "#__PACKAGE_NAME__" => strtolower($business->package_name()),
            "#__CLASS_NAME__" => strtolower($business->class_name()),
            "#__PUBLIC_METHODS__" => implode("\r\n\t", $methods),
            "#__FLAG_FIELDS__" => implode("\r\n\t", $methods),
            "#__ENDPOINT_URL__" => __ENDPOINT_URL__,
        ];
        $from = array_keys($replace);
        $to = array_values($replace);

        // twice replacements
        $method_body = str_replace($from, $to, $method_body);
        $method_body = str_replace($from, $to, $method_body);

        
        $template_reader->write($method_body, "api/{$replace['#__PACKAGE_NAME__']}/models/class.model_{$replace['#__CLASS_NAME__']}.inc.php");
        return $method_body;
    }
}