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
        $field_body = "<th>{$column->COLUMN_DISPLAY}</th>";
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
        $field_body = "<td>{{record.{$column->COLUMN_NAME}}}</td>";
        return $field_body;
    }

    /**
     * HTML Quickies used as search head or quick add
     *
     * @param fields $column
     * @return string
     */
    public function htmQuickies(fields $column): string
    {
        if ($column->isLong || $column->isPrivate) {
            return "";
        }

        return "<td><input class='w3-input w3-light-grey' type='text' ng-model='quickies.{$column->COLUMN_NAME}' placeholder='' /></td>";
    }

    /**
     * HTML Details
     *
     * @param fields $column
     * @return string
     */
    public function htmlDetails(fields $column): string
    {
        // @todo Include long columns in details viewing mode
        if ($column->isFlag) {
            return "";
        }

        // enum, datetime
        if ($column->isFlag) {
            return "";
        }

        if ($column->isLong) {
            return "";
        }

        $field_body = "
    <div class=\"w3-container field\">
        <div class=\"item\">{$column->COLUMN_DISPLAY}</div>
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

        // @todo Fix here
//        if ($column->isFlag) {
//            return "";
//        }

        $class = $this->field_class($column);
        // @see https://www.w3schools.com/html/html_form_input_types.asp
        // if date, date field
        // long: text area
        // enum: radio

        $field_body = "";

        if($column->isDate && $field_body=="")
        {
            $field_body = "
    <div class=\"w3-padding field\">
        <label>{$column->COLUMN_DISPLAY}</label>
        <div>
            <div><input class=\"w3-input w3-border datepicker {$class}\" type=\"date\" format=\"YYYY-MM-DD\" ng-model=\"#__CLASS_NAME__.record.{$column->COLUMN_NAME}\" required=\"\" placeholder=\"\" /></div>
            <div class=\"hints\">{$column->COLUMN_COMMENT}</div>
        </div>
    </div>
        ";
        }

        if($column->isLong && $field_body=="")
        {
            $field_body = "
    <div class=\"w3-padding field\">
        <label>{$column->COLUMN_DISPLAY}</label>
        <div>
            <div><textarea class=\"w3-input w3-border {$class}\" ng-model=\"#__CLASS_NAME__.record.{$column->COLUMN_NAME}\" required=\"\" placeholder=\"\"></textarea></div>
            <div class=\"hints\">{$column->COLUMN_COMMENT}</div>
        </div>
    </div>
        ";
        }

        /**
         * If nobody selected, a default style
         */
        if($field_body == "")
        {
            $field_body = "
    <div class=\"w3-padding field\">
        <label>{$column->COLUMN_DISPLAY}</label>
        <div>
            <div><input class=\"w3-input w3-border {$class}\" type=\"text\" ng-model=\"#__CLASS_NAME__.record.{$column->COLUMN_NAME}\" required=\"\" placeholder=\"\" /></div>
            <div class=\"hints\">{$column->COLUMN_COMMENT}</div>
        </div>
    </div>
        ";
        }

        return $field_body;
    }

    /**
     * Determines which CSS to apply in the selected field
     *
     * @param fields $column
     * @return string
     */
    private function field_class(fields $column)
    {
        $classes = [];
        if ($column->isDate) {
            $classes[] = "datepicker";
        }

        // class="ng-valid ng-touched ng-dirty ng-valid-parse ng-empty"
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
        $field_body = "Deleted";

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

        $field_body = "";

        if($column->isLong)
        {
            // textarea, to be implemented at model layer
            $field_body = "
    <div class=\"w3-padding field\">
        <label>{$column->COLUMN_DISPLAY}</label>
        <div>
            <div><textarea class=\"w3-input w3-pale-red w3-border {$field_class}\" ng-model=\"record.{$column->COLUMN_NAME}\" placeholder=\"\"></textarea></div>
            <div class=\"hints\">{$column->COLUMN_COMMENT}</div>
        </div>
    </div>
        ";
        }

        if($field_body == "")
        {
            $field_body = "
    <div class=\"w3-padding field\">
        <label>{$column->COLUMN_DISPLAY}</label>
        <div>
            <div><input type=\"text\" class=\"w3-input w3-border {$field_class}\" ng-model=\"record.{$column->COLUMN_NAME}\" placeholder=\"\" /></div>
            <div class=\"hints\">{$column->COLUMN_COMMENT}</div>
        </div>
    </div>
        ";
        }

        return $field_body;
    }

}
