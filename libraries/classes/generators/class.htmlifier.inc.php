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
     * HTML List
     */
    public function htmlColumnify(fields $column): string
    {
		$caser = new caser();
		$name = $caser->wordify($column->COLUMN_NAME);

		#print_r($column); die();
		$field_body = "\t\t<th>{$name}</th>";
		return $field_body;
    }
	
    /**
     * HTML List
     */
    public function htmlListify(fields $column): string
    {
		// <div>{$column->COLUMN_NAME}</div>
		#print_r($column); die();
        // #__LISTED_ROWS__
        $field_body = "\t\t<td>{{record.{$column->COLUMN_NAME}}}</td>";
		return $field_body;
    }

    /**
     * HTML Details
     */
    public function htmlDetails(fields $column): string
    {
		$caser = new caser();
		$COLUMN_NAME = $caser->wordify($column->COLUMN_NAME);
        $field_body = "
<div>
    <div>{$COLUMN_NAME}</div>
    <div>{{record.{$column->COLUMN_NAME}}}</div>
</div>
        ";
        
		return $field_body;
    }

    /**
     * HTML Edit
     */
    public function htmlEdit(fields $column): string
    {
		$field_body = "
        <div>
            <div>{$column->COLUMN_COMMENT}</div>
            <div><input type='text' ng-model='record.{$column->COLUMN_NAME}'></div>
            <div class='hints'>{$column->COLUMN_COMMENT}/div>
        </div>
        ";
        
		return $field_body;
    }

    /**
     * HTML Flag
     */
    public function htmlFlag(fields $column): string
    {
        $field_body = "
Flagged
        ";
        
		return $field_body;
    }

    /**
     * HTML Delete
     *
     * @param method_descriptor $method
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
     * @param method_descriptor $method
     * @return string
     */
    public function htmlAdd(fields $column): string
    {
        $field_body = "
        <div>
            <div>{$column->COLUMN_COMMENT}</div>
            <div><input type='text' ng-model='record.{$column->COLUMN_NAME}'></div>
            <div class='hints'>{$column->COLUMN_COMMENT}/div>
        </div>
        ";
        
		return $field_body;
    }
}