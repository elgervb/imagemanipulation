<?php
namespace imagemanipulation;

class ArgsTest extends \PHPUnit_Framework_TestCase
{
    public function testIntMaxBelow(){
        $result = Args::int(20)->max(21);
        
        $this->assertTrue($result instanceof ArgumentChecker);
    }
    public function testIntMaxEquals(){
        $result = Args::int(20)->max(20);
        $this->assertTrue($result instanceof ArgumentChecker);
    }
    public function testIntMaxAbove(){
        try{
            Args::int(20)->max(19);
            $this->fail("Exception expected");
        }catch(\InvalidArgumentException $ex){
            $this->assertNotNull($ex->getMessage());         
        }
    }
    
    public function testIntRequiredOk(){
        $result = Args::int(20)->required();
        $this->assertTrue($result instanceof ArgumentChecker);
    }
    public function Int(){
        $result = Args::int(0)->required();
        $this->assertTrue($result instanceof ArgumentChecker);
    }
    public function testIntRequiredFail(){
        try{
            Args::int(null)->required();
            $this->fail("Exception expected");
        }catch(\InvalidArgumentException $ex){
            $this->assertNotNull($ex->getMessage());
        }
    }
    public function test__ConstructNull(){
        $result = Args::int(null);
        $this->assertTrue($result instanceof ArgumentChecker);
    }
    
    public function testIntMinBelow(){
        try{
            Args::int(20)->min(21);
            $this->fail("Exception expected");
        }catch(\InvalidArgumentException $ex){
            $this->assertNotNull($ex->getMessage());
        }
    }
    public function testIntMinEquals(){
        $result = Args::int(20)->min(20);
        $this->assertTrue($result instanceof ArgumentChecker);
    }
    public function testIntMinAbove(){
        $result = Args::int(20)->min(19);
        $this->assertTrue($result instanceof ArgumentChecker);
    }
}