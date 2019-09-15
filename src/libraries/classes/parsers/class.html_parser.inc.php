<?php

namespace parsers;

use generators\dbaccess;
use generators\htmlifier;
use generators\template_reader;
use anytizer\business_entity;

class html_parser implements parser
{
    public function generate(business_entity $business)
    {
        $html_list = $this->generate_list($business);
        #echo $html_list; die();

        $html_details = $this->generate_details($business);
        #echo $html_details; die();

        $html_edit = $this->generate_edit($business);
        #echo $html_edit; die();

        $html_flag = $this->generate_flag($business);
        #echo $html_flag; die();

        $html_delete = $this->generate_delete($business);
        #echo $html_delete; die();

        $html_add = $this->generate_add($business);
        #echo $html_add; die();
        #echo $html_list;
        #echo $html_details;
        #echo $html_edit;
        #echo $html_flag;
        #echo $html_delete;
        #echo $html_add;
        #die(); continue;
        # dto, business
        # phpunit
        # angular: app, route, controller, service
        # html: list, details, edit, add, flag, delete
        # orm: wrapper, orm
        # endpoint, business
        # @todo Featured tests?

        $this->generate_html($business);
        $this->welcome_html($business); // wrapper

        $this->import_css($business);

        $this->generate_selenium($business);
    }

    private function generate_list(business_entity $business)
    {
        $template_reader = new template_reader();
        $method_body = $template_reader->read("public_html/entities/html/list.html.ts");

        # print_r($business);
        $table_name = $business->table_name();
        $dbaccess = new dbaccess();
        $columns = $dbaccess->_get_columns($table_name);

        /**
         * @todo Filter long fields and flags
         */
        $primary_key = $dbaccess->_get_primary_key($table_name);
        #print_r($columns);

        $htmlifier = new htmlifier();
        $column_heads = array_filter(array_map(array($htmlifier, "htmlColumnify"), $columns));
        $records = array_filter(array_map(array($htmlifier, "htmlListify"), $columns));

        # "#__PUBLIC_METHODS__" => implode("\r\n\t", $methods),
        $replace = array(
            "#__PACKAGE_NAME__" => $business->package_name(),
            "#__CLASS_NAME__" => $business->class_name(),
            "#__COLUMN_NAMES__" => implode("\r\n\t", $column_heads),
            "#__LISTED_ROWS__" => implode("\r\n\t", $records),
            "#__PRIMARY_KEY__" => $primary_key,
        );

        $from = array_keys($replace);
        $to = array_values($replace);

        $method_body = str_replace($from, $to, $method_body);
        $method_body = str_replace($from, $to, $method_body);
        #print_r($replace); die();
        #die($method_body);

        $template_reader->write($method_body, "public_html/entities/{$business->package_name()}/{$business->class_name()}/html/list.html");
        return $method_body;
    }

    private function generate_details(business_entity $business)
    {
        $template_reader = new template_reader();
        $method_body = $template_reader->read("public_html/entities/html/details.html.ts");

        # print_r($business);
        $table_name = $business->table_name();
        $dbaccess = new dbaccess();
        $columns = $dbaccess->_get_columns($table_name);
        $primary_key = $dbaccess->_get_primary_key($table_name);

        $htmlifier = new htmlifier();
        $methods = array_map(array($htmlifier, "htmlDetails"), $columns);
        $replace = array(
            "#__PACKAGE_NAME__" => $business->package_name(),
            "#__CLASS_NAME__" => $business->class_name(),
            "#__PUBLIC_METHODS__" => implode("\r\n\t", $methods),
            "#__DETAILS_FIELDS__" => implode("\r\n\t", $methods),
            "#__PRIMARY_KEY__" => $primary_key,
        );

        $from = array_keys($replace);
        $to = array_values($replace);
        $method_body = str_replace($from, $to, $method_body);
        $method_body = str_replace($from, $to, $method_body);

        $template_reader->write($method_body, "public_html/entities/{$business->package_name()}/{$business->class_name()}/html/details.html");
        return $method_body;
    }

    private function generate_edit(business_entity $business)
    {
        $template_reader = new template_reader();
        $method_body = $template_reader->read("public_html/entities/html/edit.html.ts");

        # print_r($business);
        $table_name = $business->table_name();
        $dbaccess = new dbaccess();
        $columns = $dbaccess->_get_columns($table_name);
        #print_r($columns);

        $htmlifier = new htmlifier();
        //$methods = array_map(array($htmlifier, "htmlEdit"), $business->methods_list());
        $methods = array_map(array($htmlifier, "htmlEdit"), $columns);
        $replace = array(
            "#__PACKAGE_NAME__" => $business->package_name(),
            "#__CLASS_NAME__" => $business->class_name(),
            "#__PUBLIC_METHODS__" => implode("\r\n\t", $methods),
            "#__EDIT_FIELDS__" => implode("\r\n\t", $methods),
        );

        $from = array_keys($replace);
        $to = array_values($replace);
        $method_body = str_replace($from, $to, $method_body);

        $template_reader->write($method_body, "public_html/entities/{$business->package_name()}/{$business->class_name()}/html/edit.html");
        return $method_body;
    }

    private function generate_flag(business_entity $business)
    {
        $template_reader = new template_reader();
        $method_body = $template_reader->read("public_html/entities/html/flag.html.ts");

        # print_r($business);
        $table_name = $business->table_name();
        $dbaccess = new dbaccess();
        $columns = $dbaccess->_get_columns($table_name);
        $primary_key = $dbaccess->_get_primary_key($table_name);
        #print_r($columns);

        $htmlifier = new htmlifier();
        $methods = array_map(array($htmlifier, "htmlFlag"), $columns);
        $replace = array(
            "#__PACKAGE_NAME__" => $business->package_name(),
            "#__CLASS_NAME__" => $business->class_name(),
            "#__PUBLIC_METHODS__" => implode("\r\n\t", $methods),
            "#__FLAG_FIELDS__" => implode("\r\n\t", $methods),
            "#__PRIMARY_KEY__" => $primary_key,
        );

        $from = array_keys($replace);
        $to = array_values($replace);
        $method_body = str_replace($from, $to, $method_body);

        $template_reader->write($method_body, "public_html/entities/{$business->package_name()}/{$business->class_name()}/html/flag.html");
        return $method_body;
    }

    private function generate_delete(business_entity $business)
    {
        $template_reader = new template_reader();
        $method_body = $template_reader->read("public_html/entities/html/delete.html.ts");

        # print_r($business);
        $table_name = $business->table_name();
        $dbaccess = new dbaccess();
        $columns = $dbaccess->_get_columns($table_name);
        #print_r($columns);

        $htmlifier = new htmlifier();
        $methods = array_map(array($htmlifier, "htmlDelete"), $columns);
        $replace = array(
            "#__PACKAGE_NAME__" => $business->package_name(),
            "#__CLASS_NAME__" => $business->class_name(),
            "#__PUBLIC_METHODS__" => implode("\r\n\t", $methods),
            "#__DELETE_FIELDS__" => implode("\r\n\t", $methods),
        );

        $from = array_keys($replace);
        $to = array_values($replace);
        $method_body = str_replace($from, $to, $method_body);

        $template_reader->write($method_body, "public_html/entities/{$business->package_name()}/{$business->class_name()}/html/delete.html");
        return $method_body;
    }

    private function generate_add(business_entity $business)
    {
        $template_reader = new template_reader();
        $method_body = $template_reader->read("public_html/entities/html/add.html.ts");

        # print_r($business);
        $table_name = $business->table_name();
        $dbaccess = new dbaccess();
        $columns = $dbaccess->_get_columns($table_name);
        #print_r($columns);

        $htmlifier = new htmlifier();
        #$methods = array_map(array($htmlifier, "htmlAdd"), $business->methods_list());
        $methods = array_map(array($htmlifier, "htmlAdd"), $columns);
        $replace = array(
            "#__PACKAGE_NAME__" => $business->package_name(),
            "#__CLASS_NAME__" => $business->class_name(),
            "#__ADD_FIELDS__" => implode("\r\n\t", $methods),
        );

        $from = array_keys($replace);
        $to = array_values($replace);
        $method_body = str_replace($from, $to, $method_body);

        $template_reader->write($method_body, "public_html/entities/{$business->package_name()}/{$business->class_name()}/html/add.html");
        return $method_body;
    }

    /**
     * Embed HTML pieces
     *
     * @param business_entity $business
     * @return string
     */
    private function generate_html(business_entity $business)
    {
        $template_reader = new template_reader();
        $method_body = $template_reader->read("public_html/entities/html/index.html.ts");

        $replace = $this->get_replaces($business);
        $from = array_keys($replace);
        $to = array_values($replace);
        $method_body = str_replace($from, $to, $method_body);

        $template_reader->write($method_body, "public_html/entities/{$business->package_name()}/{$business->class_name()}/html/index.html");

        return $method_body;
    }

    private function get_replaces(business_entity $business)
    {
        $replace = array(
            "#__PACKAGE_NAME__" => $business->package_name(),
            "#__CLASS_NAME__" => $business->class_name(),
            "#__ANGULAR_APP_NAME__" => $business->class_name(),

            "#__MEDIA_URL__" => __MEDIA_URL__,
            "#__JS_URL__" => "entities/{$business->package_name()}/{$business->class_name()}/js",
            "#__CSS_URL__" => "entities/{$business->package_name()}/{$business->class_name()}/css",
            "#__PUBLIC_URL__" => __PUBLIC_URL__,
        );

        return $replace;
    }

    /**
     * Embed HTML pieces
     *
     * @param business_entity $business
     * @return string
     */
    private function welcome_html(business_entity $business)
    {
        $template_reader = new template_reader();
        $method_body = $template_reader->read("public_html/entities/html/welcome.html.ts");

        $replace = $this->get_replaces($business);
        $from = array_keys($replace);
        $to = array_values($replace);
        $method_body = str_replace($from, $to, $method_body);

        $template_reader->write($method_body, "public_html/entities/{$business->package_name()}/{$business->class_name()}/html/welcome.html");

        return $method_body;
    }

    /**
     * CSS/SCSS
     *
     * @param business_entity $business
     * @return string
     */
    private function import_css(business_entity $business)
    {
        $template_reader = new template_reader();
        $method_body = $template_reader->read("public_html/entities/css/style.css.ts");

        $replace = $this->get_replaces($business);
        $from = array_keys($replace);
        $to = array_values($replace);
        $method_body = str_replace($from, $to, $method_body);

        $template_reader->write($method_body, "public_html/entities/{$business->package_name()}/{$business->class_name()}/css/style.css");

        return $method_body;
    }

    private function generate_selenium(business_entity $business)
    {
        return "";
    }
}
