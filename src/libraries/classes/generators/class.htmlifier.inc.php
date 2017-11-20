<?php
namespace generators;
use setups\method_descriptor;
use structures\fields;

class htmlifier implements bodyfier
{
    public function generate(): string
    {
        //$method = new method_descriptor();
        //$this->htmlListify($method);
        //$this->htmlDetails($method);
        //$this->htmlEdit($method);
        //$this->htmlFlag($method);
        //$this->htmlDelete($method);
        //$this->htmlAdd($method);

        return "";
    }

    /**
     * Determines which CSS to apply in the selected field
     *
     * @param fields $fields
     * @return string
     */
    private function field_class(fields $fields)
    {
        $classes = array();
        if($fields->isDate)
        {
            $classes[] = "datepicker";
        }

        return implode(" ", $classes);
    }
    
	/**
     * HTML List
     *
     * @param fields $column
     * @return string
     */
    public function htmlColumnify(fields $column): string
    {
        if($column->isLong || $column->isPrivate)
        {
            return "";
        }

        $caser = new caser();
		$name = $caser->wordify($column->COLUMN_NAME);

		#print_r($column); die();
		$field_body = "\t\t<th>{$name}</th>";
		return $field_body;
    }
	
    /**
     * HTML List
     *
     * @param fields $column
     * @return string
     */
    public function htmlListify(fields $column): string
    {
        if($column->isLong || $column->isPrivate)
        {
            return "";
        }

        /**
         * @todo Hide flag dates but show other dates
         */

		// <div>{$column->COLUMN_NAME}</div>
		#print_r($column); die();
        // #__LISTED_ROWS__
        $field_body = "\t\t<td>{{record.{$column->COLUMN_DISPLAY}}}</td>";
		return $field_body;
    }

    /**
     * HTML Details
     *
     * @param fields $column
     * @return string
     */
    public function htmlDetails(fields $column): string
    {
        if($column->isLong)
        {
            return "";
        }

        $field_body = "
    <div>
        <div>{$column->COLUMN_DISPLAY}</div>
        <div>{{record.{$column->COLUMN_NAME}}}</div>
    </div>
        ";
        
		return $field_body;
    }

    /**
     * HTML Edit
     *
     * @param fields $column
     * @return string
     */
    public function htmlEdit(fields $column): string
    {
        if($column->isPrivate)
        {
            return "";
        }

        $class = $this->field_class($column);

		$field_body = "
    <div class='field'>
        <label>{$column->COLUMN_DISPLAY}</label>
        <div><input class=\"w3-input {$class}\"  type=\"text\" ng-model=\"record.{$column->COLUMN_NAME}\" placeholder='' /></div>
        <div class=\"hints\">{$column->COLUMN_COMMENT}</div>
    </div>
        ";
        
		return $field_body;
    }

    /**
     * HTML Flag
     *
     * @param fields $column
     * @return string
     */
    public function htmlFlag(fields $column): string
    {
        $field_body = "
<!-- Flagged -->
        ";
        
		return $field_body;
    }

    /**
     * HTML Delete
     *
     * @param fields $column
     * @return string
     */
    public function htmlDelete(fields $column): string
    {
        $field_body = "
Deleted
";
		
		return $field_body;
    }

    /**
     * HTML Add
     *
     * @param fields $column
     * @return string
     */
    public function htmlAdd(fields $column): string
    {
        if($column->isPrivate)
        {
            return "";
        }

        $class = $this->field_class($column);

        $field_body = "
    <div class='field'>
        <label>{$column->COLUMN_DISPLAY}</label>
        <div><input type=\"text\" class=\"w3-input {$class}\" ng-model=\"record.{$column->COLUMN_NAME}\" placeholder='' /></div>
        <div class=\"hints\">{$column->COLUMN_COMMENT}</div>
    </div>
        ";
        
		return $field_body;
    }
}