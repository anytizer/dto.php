<?php
namespace tests;
use generators\methodifier;
use PHPUnit\Framework\TestCase;

class returnTypeTest extends TestCase
{
    public function setup()
    {
    }

    public function testReturnType1()
    {
        $method_descriptive = "_valid: bool";

        $methodifier = new methodifier();
        $return_type = $methodifier->return_type($method_descriptive);

        $this->assertEquals("bool", $return_type);
    }

    public function testReturnType2()
    {
        $method_descriptive = "_valid: int";

        $methodifier = new methodifier();
        $return_type = $methodifier->return_type($method_descriptive);

        $this->assertEquals("int", $return_type);
    }

    public function testReturnType3()
    {
        $method_descriptive = "_valid: string ";

        $methodifier = new methodifier();
        $return_type = $methodifier->return_type($method_descriptive);

        $this->assertEquals("string", $return_type);
    }

    public function testReturnType4()
    {
        $method_descriptive = "valid():user";

        $methodifier = new methodifier();
        $return_type = $methodifier->return_type($method_descriptive);

        $this->assertEquals("user", $return_type);
    }

    public function testReturnType5()
    {
        $method_descriptive = "_add(a, b): int ";

        $methodifier = new methodifier();
        $return_type = $methodifier->return_type($method_descriptive);

        $this->assertEquals("int", $return_type);
    }
}