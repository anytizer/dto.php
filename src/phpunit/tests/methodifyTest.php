<?php

namespace tests;

use generators\methodifier;
use PHPUnit\Framework\TestCase;

class methodifyTest extends TestCase
{
    public function setup()
    {
    }

    public function testAccessorIsPrivate1()
    {
        $method_descriptive = ":is valid";
        $methodifier = new methodifier();
        $accessor = $methodifier->accessor($method_descriptive);

        $this->assertEquals("private", $accessor);
    }

    public function testAccessorIsPrivate2()
    {
        $method_descriptive = "_valid";

        $methodifier = new methodifier();
        $accessor = $methodifier->accessor($method_descriptive);

        $this->assertEquals("private", $accessor);
    }

    public function testMethodifyPrivateFunction()
    {
        $name = ":is valid";
        $remove_prefix = false;
        $ucfirst = false;
        $glue = "";

        $methodifier = new methodifier();
        $method_body = $methodifier->methodify($name, $remove_prefix, $ucfirst, $glue);

        $this->assertContains("private function is_valid(): bool", $method_body);
    }
}