<?php
namespace parsers;
use setups\business_entity;
use generators\htmlifier;
use generators\template_reader;
use generators\dbaccess;

class html_parser implements  parser
{
    public function generate(business_entity $business)
    {
    }

    public function generate_list(business_entity $business)
    {
        $template_reader = new template_reader();
        $method_body = $template_reader->read("public_html/entities/templates/list.html.ts");

        # print_r($business);
        $table_name = $business->table_name();
        $dbaccess = new dbaccess();
        $columns = $dbaccess->_get_columns($table_name);
		#print_r($columns);
		
		$htmlifier = new htmlifier();
        $column_heads = array_map(array($htmlifier, "htmlColumnify"), $columns);
        $records = array_map(array($htmlifier, "htmlListify"), $columns);

		# "#__PUBLIC_METHODS__" => implode("\r\n\t", $methods),
        $replace = array(
            "#__CLASS_NAME__" => $business->class_name(),
            "#__COLUMN_NAMES__" => implode("\r\n\t", $column_heads),
            "#__LISTED_ROWS__" => implode("\r\n\t", $records),
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
        $method_body = $template_reader->read("public_html/entities/templates/details.html.ts");

        # print_r($business);
        $table_name = $business->table_name();
        $dbaccess = new dbaccess();
        $columns = $dbaccess->_get_columns($table_name);
		#print_r($columns);
		
		$htmlifier = new htmlifier();
        $methods = array_map(array($htmlifier, "htmlDetails"), $columns);
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
        $method_body = $template_reader->read("public_html/entities/templates/edit.html.ts");
		
		# print_r($business);
        $table_name = $business->table_name();
        $dbaccess = new dbaccess();
        $columns = $dbaccess->_get_columns($table_name);
		#print_r($columns);

        $htmlifier = new htmlifier();
        //$methods = array_map(array($htmlifier, "htmlEdit"), $business->methods_list());
        $methods = array_map(array($htmlifier, "htmlEdit"), $columns);
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
        $method_body = $template_reader->read("public_html/entities/templates/flag.html.ts");

        # print_r($business);
        $table_name = $business->table_name();
        $dbaccess = new dbaccess();
        $columns = $dbaccess->_get_columns($table_name);
		#print_r($columns);
		
		$htmlifier = new htmlifier();
        $methods = array_map(array($htmlifier, "htmlFlag"), $columns);
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
        $method_body = $template_reader->read("public_html/entities/templates/delete.html.ts");

        # print_r($business);
        $table_name = $business->table_name();
        $dbaccess = new dbaccess();
        $columns = $dbaccess->_get_columns($table_name);
		#print_r($columns);
		
		$htmlifier = new htmlifier();
        $methods = array_map(array($htmlifier, "htmlDelete"), $columns);
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
        $method_body = $template_reader->read("public_html/entities/templates/add.html.ts");
		
		# print_r($business);
        $table_name = $business->table_name();
        $dbaccess = new dbaccess();
        $columns = $dbaccess->_get_columns($table_name);
		#print_r($columns);

        $htmlifier = new htmlifier();
        #$methods = array_map(array($htmlifier, "htmlAdd"), $business->methods_list());
        $methods = array_map(array($htmlifier, "htmlAdd"), $columns);
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

    /**
     * Embed HTML pieces
     *
     * @param business_entity $business
     * @return string
     */
    public function generate_html(business_entity $business)
    {
        $class = $business->class_name();
        $method_body = '
<script type="text/javascript" src="/entities/#__CLASS_NAME__/js/#__CLASS_NAME__-app.js"></script>
<script type="text/javascript" src="/entities/#__CLASS_NAME__/js/#__CLASS_NAME__-routes.js"></script>
<script type="text/javascript" src="/entities/#__CLASS_NAME__/js/#__CLASS_NAME__-services.js"></script>
<script type="text/javascript" src="/entities/#__CLASS_NAME__/js/#__CLASS_NAME__-controllers.js"></script>
';
        $replace = array(
            "#__CLASS_NAME__" => $business->class_name(),
        );
        $from = array_keys($replace);
        $to = array_values($replace);
        $method_body = str_replace($from, $to, $method_body);

        return $method_body;
    }

    public function generate_selenium(business_entity $business)
    {
        return "";
    }
}