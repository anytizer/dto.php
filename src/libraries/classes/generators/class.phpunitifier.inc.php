<?php

namespace generators;

use setups\method_descriptor;

class phpunitifier extends generator implements bodyfier
{
    public function generate(): string
    {

    }

    /**
     * Converts a word into PHPUnit Test Case
     *
     * @param method_descriptor $method
     * @return string
     */
    public function methodify(method_descriptor $method): string
    {
        $method_name = $method->method_name;

        # optional
        $testMethodName = $this->caser->psr4($method_name);

        $timestamp = date("Y-m-d");

        // skip creating unit tests for private methods
        $method_comments = "";
        if ($this->is_private($method_name)) {
            # return $method_comments = "(private method)";
        }

        $method_description = $method->description;
        $parameters = $method->parameters;

        /**
         * Create parameters if any
         */
        $parameters_initialization = "";
        $pi = explode(", ", $parameters);
        $pi = array_map("trim", $pi);
        $pi = array_filter($pi);
        if (count($pi) > 0) {
            #print_r($pi);
            foreach ($pi as $p => $initialization) {
                $pi[$p] = "{$initialization} = null;";
            }

            #print_r($pi); die();
            $parameters_initialization = "\r\n        " . implode("\r\n        ", $pi) . "\r\n";
        }
        #print_r($pi);

        $method_body = "
    /**
     * {$method_description}
     * {$method_comments}
     * @issue #@ISSUE_ID@
     * {$timestamp}
     */
    public function test{$testMethodName}()
    {   {$parameters_initialization}
        \$output = \$this->#__CLASS_NAME__Business->{$method_name}($parameters);

        \$this->assertEquals(false, \$output);
        //\$this->markTestIncomplete();
    }
";
        return $method_body;
    }

    /**
     * @param string $feature
     * @return string
     */
    public function feature_test(string $feature): string
    {
        $method_name = "do_something";
        $parameters = "";

        $caser = new caser();
        $feature_name = $caser->psr4($feature);
        $method_body = "
    /**
     * Feature: {$feature}
     */
    public function test{$feature_name}()
    {
        /**
         * @todo Implement - {$feature}
         */
        #\$output = \$this->#__BUSINESS_NAME__->{$method_name}($parameters);

        \$this->markTestIncomplete();
    }
";
        return $method_body;
    }
}