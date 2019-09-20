<?php

namespace tests;

use generators\namifier;
use PHPUnit\Framework\TestCase;

class prefixesTest extends TestCase
{
    public function setup(): void
    {
    }

    /**
     * Remove Prefix from the database
     */
    public function testRemovePrefixFromDatabase1()
    {
        $name = "contact_guid";
        $namifier = new namifier();
        $name = $namifier->column_name($name);

        $this->assertEquals("GUID", $name);
    }

    public function testRemovePrefixFromDatabase2()
    {
        $name = "contact_id";
        $namifier = new namifier();
        $name = $namifier->column_name($name);

        $this->assertEquals("ID", $name);
    }

    public function testRemovePrefixFromDatabase3()
    {
        $name = "contact_address";
        $namifier = new namifier();
        $name = $namifier->column_name($name);

        $this->assertEquals("Address", $name);
    }

    public function testRemovePrefixFromDatabase4()
    {
        $name = "contact_url";
        $namifier = new namifier();
        $name = $namifier->column_name($name);

        $this->assertEquals("URL", $name);
    }
}
