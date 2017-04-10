<?php
namespace tests;
use PHPUnit\Framework\TestCase;


class rulesBooleanTest extends TestCase
{
    public function setup()
    {
    }

    public function testNamify()
    {
        $clean = true;
        $this->assertTrue($clean);
    }
}