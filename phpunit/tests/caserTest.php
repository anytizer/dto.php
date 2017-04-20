<?php
namespace tests;
use generators\caser;
use setups\business_entity;
use PHPUnit\Framework\TestCase;


class caserTest extends TestCase
{
    public function setup()
    {
    }

    public function testSnakeCase()
    {
        $name = "a quick brown fox";
        $caser = new caser();
        $name = $caser->snake_case($name);
        
		$this->assertEquals("a_quick_brown_fox", $name);
    }
	
	public function testPsr4()
    {
        $name = "a quick brown fox";
        $caser = new caser();
        $name = $caser->psr4($name);
        
		$this->assertEquals("AQuickBrownFox", $name);
    }
	
	public function _testPsr0()
    {
		# @todo Incomplete
		$this->markTestIncomplete();
		
        #$name = "a quick brown fox";
        #$caser = new caser();
        #$name = $caser->psr0($name);
		#echo $name;
        
		#$this->assertEquals("A_Quick_Brown_Fox", $name);
    }
	
	public function testWordify()
    {
        $name = "a quick brown fox";
        $caser = new caser();
        $name = $caser->wordify($name);
        
		$this->assertEquals("A Quick Brown Fox", $name);
    }
}