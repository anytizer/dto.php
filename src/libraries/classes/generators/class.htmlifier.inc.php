<?php

namespace generators;

use backend\capitalizer;
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
     * Column Heads
     *
     * @param fields $column
     * @return string
     */
    public function htmlColumnify(fields $column): string
    {
        if ($column->isLong || $column->isPrivate) {
            return "";
        }

        #print_r($column); die();
        $field_body = "\t\t<th>{$column->COLUMN_DISPLAY}</th>";
        return $field_body;
    }

    /**
     * Column Body
     *
     * @param fields $column
     * @return string
     */
    public function htmlListify(fields $column): string
    {
        if ($column->isLong || $column->isPrivate) {
            return "";
        }

        /**
         * @todo Hide flag dates but show other dates
         */
        // <div>{$column->COLUMN_NAME}</div>
        #print_r($column); die();
        // #__LISTED_ROWS__
        $field_body = "\t\t<td>{{record.{$column->COLUMN_NAME}}}</td>";
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
        if ($column->isLong) {
            return "";
        }

        $field_body = "
    <div class=\"w3-container field\">
        <div class=\"w3-text-blue item\">{$column->COLUMN_DISPLAY}</div>
        <div class=\"value\">{{#__CLASS_NAME__.record.{$column->COLUMN_NAME}}}</div>
    </div>
        ";

        return $field_body;
    }

    /**
     * HTML Edit field
     * @param fields $column
     * @return string
     * @todo If long field, show text area rather
     *
     */
    public function htmlEdit(fields $column): string
    {
        if ($column->isPrivate) {
            return "";
        }

        $class = $this->field_class($column);

        $field_body = "
    <div class=\"w3-padding field\">
        <label>{$column->COLUMN_DISPLAY}</label>
        <div>
            <div><input class=\"w3-input {$class}\"  type=\"text\" ng-model=\"record.{$column->COLUMN_NAME}\" placeholder=\"\" /></div>
            <div class=\"hints\">{$column->COLUMN_COMMENT}</div>
        </div>
    </div>
        ";

        return $field_body;
    }

    /**
     * Determines which CSS to apply in the selected field
     *
     * @param fields $fields
     * @return string
     */
    private function field_class(fields $fields)
    {
        $classes = [];
        if ($fields->isDate) {
            $classes[] = "datepicker";
        }

        return implode(" ", $classes);
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
        if ($column->isPrivate) {
            return "";
        }

        $field_class = $this->field_class($column);

        $field_body = "
    <div class=\"w3-padding field\">
        <label>{$column->COLUMN_DISPLAY}</label>
        <div>
            <div><input type=\"text\" class=\"w3-input {$field_class}\" ng-model=\"record.{$column->COLUMN_NAME}\" placeholder=\"\" /></div>
            <div class=\"hints\">{$column->COLUMN_COMMENT}</div>
        </div>
    </div>
        ";

        return $field_body;
    }

}
