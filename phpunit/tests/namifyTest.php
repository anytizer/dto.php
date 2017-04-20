<?php
namespace tests;
use generators\caser;
use setups\business_entity;
use PHPUnit\Framework\TestCase;


class namifyTest extends TestCase
{
    public function setup()
    {
    }

    public function testNamify1()
    {
        $name = "a quick brown fox";
		$remove_prefix = false;
		$ucfirst = false;
		$glue = "";

        $caser = new caser();
        $name = $caser->namify($name, $remove_prefix, $ucfirst, $glue);
        
		$this->assertEquals("aquickbrownfox", $name);
    }

	public function testNamify2()
    {
        $name = "a quick brown fox";
		$remove_prefix = false;
		$ucfirst = false;
		$glue = "_";

        $caser = new caser();
        $name = $caser->namify($name, $remove_prefix, $ucfirst, $glue);
        
		$this->assertEquals("a_quick_brown_fox", $name);
    }
	
	public function testNamify3()
    {
        $name = "a quick brown fox";
		$remove_prefix = false;
		$ucfirst = true;
		$glue = "_";

        $caser = new caser();
        $name = $caser->namify($name, $remove_prefix, $ucfirst, $glue);
        
		$this->assertEquals("A_Quick_Brown_Fox", $name);
    }
	
	public function testNamify4()
    {
        $name = "a quick brown fox";
		$remove_prefix = false;
		$ucfirst = true;
		$glue = "";

        $caser = new caser();
        $name = $caser->namify($name, $remove_prefix, $ucfirst, $glue);
        
		$this->assertEquals("AQuickBrownFox", $name);
    }
	
	public function testNamify5RemovePrefix()
    {
        $name = "a quick brown fox";
		$remove_prefix = true;
		$ucfirst = true;
		$glue = "";

        $caser = new caser();
        $name = $caser->namify($name, $remove_prefix, $ucfirst, $glue);
        
		$this->assertEquals("QuickBrownFox", $name);
    }
}