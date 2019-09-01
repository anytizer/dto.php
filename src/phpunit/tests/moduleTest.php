<?php
namespace tests;
use generators\caser;
use generators\namifier;
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

    public function testPackageName()
    {
        $expect = "WaterBills";

        $be = (new business_entity())->business("water bills", "payment", "");
        $name = $be->package_name();

        $this->assertEquals($expect, $name);
    }

    public function testDtoName()
    {
        $expect = "PaymentDTO";

        $be = (new business_entity())->business("water bills", "payment", "");
        $name = $be->dto_name();

        $this->assertEquals($expect, $name);
    }

    public function testOrmName()
    {
        $expect = "PaymentORM";

        $be = (new business_entity())->business("water bills", "payment", "");
        $name = $be->orm_name();

        $this->assertEquals($expect, $name);
    }

    public function testModuleName()
    {
        $expect = "Payment";

        $be = (new business_entity())->business("water bills", "payment", "");
        $name = $be->class_name();

        $this->assertEquals($expect, $name);
    }
    
    public function testColumnName()
    {
        $expect = "ID";

        $name = "contact_id";

        $namifier = new namifier();
        $name = $namifier->column_name($name);
        
        $this->assertEquals($expect, $name);
    }
}