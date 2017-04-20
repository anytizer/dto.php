<?php
namespace tests;
use generators\caser;
use setups\business_entity;
use PHPUnit\Framework\TestCase;


class someTest extends TestCase
{
    public function setup()
    {
    }

    public function testNamify()
    {
        $clean = true;
        $this->assertTrue($clean);
    }

    public function testModuleName()
    {
        $module_name = "water bills: payment";
        $expect = "payment";

        #$be = (new business_entity())->business($module_name, "");
        #$name = $be->class_name();

        #$this->assertEquals($expect, $name);
    }
}