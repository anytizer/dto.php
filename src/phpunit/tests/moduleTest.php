<?php
namespace tests;
use generators\caser;
use setups\business_entity;
use PHPUnit\Framework\TestCase;


class moduleTest extends TestCase
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
        $expect = "Payment";

        $be = (new business_entity())->business("water bills", "payment", "");
        $name = $be->class_name();

        $this->assertEquals($expect, $name);
    }

    public function testPackageName()
    {
        $expect = "WaterBills";

        $be = (new business_entity())->business("water bills", "payment", "");
        $name = $be->package_name();

        $this->assertEquals($expect, $name);
    }
}