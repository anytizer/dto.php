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
		$this->markTestIncomplete();

        $class_name = "water bills: payment";
        $expect = "payment";

        $be = (new business_entity())->business($class_name, "");
        $name = $be->class_name();

        #$this->assertEquals($expect, $name);
    }
}