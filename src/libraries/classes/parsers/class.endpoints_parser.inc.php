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
       $this->generate_endpoints($business);
    }

    /**
     * @param $business
     * @return mixed|string
     */
    private function generate_endpoints(business_entity $business)
    {
        $template_reader = new template_reader();
        $method_body = $template_reader->read("api/endpoints.php.ts");

        $endpoints = new endpoints();
        $methods = array_map(array($endpoints, "methodify"), $business->methods_list());

        $replace = array(
            "#__PACKAGE_NAME__" => $business->package_name(),
            "#__CLASS_NAME__" => $business->class_name(),
            "#__PUBLIC_METHODS__" => implode("\r\n\t", $methods),
            "#__FLAG_FIELDS__" => implode("\r\n\t", $methods),
        );
        $from = array_keys($replace);
        $to = array_values($replace);

        $method_body = str_replace($from, $to, $method_body);
        $method_body = str_replace($from, $to, $method_body);

        $template_reader->write($method_body, "api/endpoints/{$business->package_name()}/class.{$business->class_name()}.inc.php");
        return $method_body;
    }
}