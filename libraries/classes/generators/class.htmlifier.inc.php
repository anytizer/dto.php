<?php
namespace generators;
use setups\method_descriptor;

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
     *
     * @param method_descriptor $method
     * @return string
     */
    public function htmlListify(method_descriptor $method): string
    {
        // #__LISTED_ROWS__
        $method_body = "
<div>
    <div>Field</div>
    <div>Value {{\$entity.{$method->method_name}}}</div>
</div>
        ";
        return $method_body;
    }

    /**
     * HTML Details
     *
     * @param method_descriptor $method
     * @return string
     */
    public function htmlDetails(method_descriptor $method): string
    {
        $method_body = "
<div>
    <div>Field</div>
    <div>Value {{\$entity.{$method->method_name}}}</div>
</div>
        ";
        return $method_body;
    }

    /**
     * HTML Edit
     *
     * @param method_descriptor $method
     * @return string
     */
    public function htmlEdit(method_descriptor $method): string
    {
        $method_body = "
<div>
<div>Field</div>
<div>Value {{\$entity.{$method->method_name}}}</div>
</div>
        ";
        return $method_body;
    }

    /**
     * HTML Flag
     *
     * @param method_descriptor $method
     * @return string
     */
    public function htmlFlag(method_descriptor $method): string
    {
        $method_body = "
Flagged
        ";
        return $method_body;
    }

    /**
     * HTML Delete
     *
     * @param method_descriptor $method
     * @return string
     */
    public function htmlDelete(method_descriptor $method): string
    {
        $method_body = "
Deleted
";
        return $method_body;
    }

    /**
     * HTML Add
     *
     * @param method_descriptor $method
     * @return string
     */
    public function htmlAdd(method_descriptor $method): string
    {
        $method_body = "";
        return $method_body;
    }
}