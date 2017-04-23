<?php
namespace parsers;
use setups\business_entity;
use generators\htmlifier;
use generators\template_reader;

class html_parser implements  parser
{
    public function generate(business_entity $business)
    {
    }

    public function generate_list(business_entity $business)
    {
        $template_reader = new template_reader();
        $method_body = $template_reader->read("public_html/entities/templates/list.html");

        $htmlifier = new htmlifier();
        $methods = array_map(array($htmlifier, "htmlListify"), $business->methods_list());

        $replace = array(
            "#__CLASS_NAME__" => $business->class_name(),
            "#__PUBLIC_METHODS__" => implode("\r\n\t", $methods),
            "#__COLUMN_NAMES__" => implode("\r\n\t", $methods),
            "#__LISTED_ROWS__" => implode("\r\n\t", $methods),
        );
        $from = array_keys($replace);
        $to = array_values($replace);

        $method_body = str_replace($from, $to, $method_body);
        $method_body = str_replace($from, $to, $method_body);
        #print_r($replace); die();
        #die($method_body);

        $template_reader->write($method_body, "public_html/entities/{$business->class_name()}/templates/list.html");
        return $method_body;
    }

    public function generate_details(business_entity $business)
    {
        $template_reader = new template_reader();
        $method_body = $template_reader->read("public_html/entities/templates/details.html");

        $htmlifier = new htmlifier();
        $methods = array_map(array($htmlifier, "htmlDetails"), $business->methods_list());
        $replace = array(
            "#__CLASS_NAME__" => $business->class_name(),
            "#__PUBLIC_METHODS__" => implode("\r\n\t", $methods),
            "#__DETAILS_FIELDS__" => implode("\r\n\t", $methods),
        );
        $from = array_keys($replace);
        $to = array_values($replace);
        $method_body = str_replace($from, $to, $method_body);

        $template_reader->write($method_body, "public_html/entities/{$business->class_name()}/templates/details.html");
        return $method_body;
    }

    public function generate_edit(business_entity $business)
    {
        $template_reader = new template_reader();
        $method_body = $template_reader->read("public_html/entities/templates/edit.html");

        $htmlifier = new htmlifier();
        $methods = array_map(array($htmlifier, "htmlEdit"), $business->methods_list());
        $replace = array(
            "#__CLASS_NAME__" => $business->class_name(),
            "#__PUBLIC_METHODS__" => implode("\r\n\t", $methods),
            "#__EDIT_FIELDS__" => implode("\r\n\t", $methods),
        );
        $from = array_keys($replace);
        $to = array_values($replace);
        $method_body = str_replace($from, $to, $method_body);

        $template_reader->write($method_body, "public_html/entities/{$business->class_name()}/templates/edit.html");
        return $method_body;
    }

    public function generate_flag(business_entity $business)
    {
        $template_reader = new template_reader();
        $method_body = $template_reader->read("public_html/entities/templates/flag.html");

        $htmlifier = new htmlifier();
        $methods = array_map(array($htmlifier, "htmlFlag"), $business->methods_list());
        $replace = array(
            "#__CLASS_NAME__" => $business->class_name(),
            "#__PUBLIC_METHODS__" => implode("\r\n\t", $methods),
            "#__FLAG_FIELDS__" => implode("\r\n\t", $methods),
        );
        $from = array_keys($replace);
        $to = array_values($replace);
        $method_body = str_replace($from, $to, $method_body);

        $template_reader->write($method_body, "public_html/entities/{$business->class_name()}/templates/flag.html");
        return $method_body;
    }

    public function generate_delete(business_entity $business)
    {
        $template_reader = new template_reader();
        $method_body = $template_reader->read("public_html/entities/templates/delete.html");

        $htmlifier = new htmlifier();
        $methods = array_map(array($htmlifier, "htmlDelete"), $business->methods_list());
        $replace = array(
            "#__CLASS_NAME__" => $business->class_name(),
            "#__PUBLIC_METHODS__" => implode("\r\n\t", $methods),
            "#__DELETE_FIELDS__" => implode("\r\n\t", $methods),
        );
        $from = array_keys($replace);
        $to = array_values($replace);
        $method_body = str_replace($from, $to, $method_body);

        $template_reader->write($method_body, "public_html/entities/{$business->class_name()}/templates/delete.html");
        return $method_body;
    }

    public function generate_add(business_entity $business)
    {
        $template_reader = new template_reader();
        $method_body = $template_reader->read("public_html/entities/templates/add.html");

        $htmlifier = new htmlifier();
        $methods = array_map(array($htmlifier, "htmlAdd"), $business->methods_list());
        $replace = array(
            "#__CLASS_NAME__" => $business->class_name(),
            "#__ADD_FIELDS__" => implode("\r\n\t", $methods),
        );
        $from = array_keys($replace);
        $to = array_values($replace);
        $method_body = str_replace($from, $to, $method_body);

        $template_reader->write($method_body, "public_html/entities/{$business->class_name()}/templates/add.html");
        return $method_body;
    }
}