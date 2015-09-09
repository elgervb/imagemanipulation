<?php
namespace imagemanipulation;

class ArgsTest extends \PHPUnit_Framework_TestCase
{
    public function testIntMaxBelow(){
        Args::int(20)->max(21);
    }
    public function testIntMaxEquals(){
        Args::int(20)->max(20);
    }
    public function testIntMaxAbove(){
        try{
            Args::int(20)->max(19);
            $this->fail("Exception expected");
        }catch(\InvalidArgumentException $ex){
            // ok            
        }
    }
    
    public function testIntRequiredOk(){
        Args::int(20)->required();
    }
    public function Int(){
        Args::int(0)->required();
    }
    public function testIntRequiredFail(){
        try{
            Args::int(null)->required();
            $this->fail("Exception expected");
        }catch(\InvalidArgumentException $ex){
            // ok
        }
    }
    public function test__ConstructNull(){
        Args::int(null);
    }
    
    public function testIntMinBelow(){
        try{
            Args::int(20)->min(21);
            $this->fail("Exception expected");
        }catch(\InvalidArgumentException $ex){
            // ok
        }
    }
    public function testIntMinEquals(){
        Args::int(20)->min(20);
    }
    public function testIntMinAbove(){
        Args::int(20)->min(19);
    }
}