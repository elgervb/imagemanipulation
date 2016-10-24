<?php
namespace imagemanipulation\thumbnail\pixelstrategy;


use imagemanipulation\ImageBuilder;
use imagemanipulation\ImageType;

class PercentagePixelStrategyTest extends \ImagemanipulationTestCase{

    public function testCreatWithNumeric(){
        $s = new PercentagePixelStrategy("50"); // this should work
        
        $this->assertNotNull($s);
    }
    
    public function testThumbJpg(){
        $img = $this->getOriginalImage(ImageType::JPG);
    
        $res = ImageBuilder::create($img)->thumbPercentage(50)->toResource();
         
        $this->assertEquals(300, $res->getX());
        $this->assertEquals(300, $res->getY());
    }
    
    public function testThumbGif(){
        $img = $this->getOriginalImage(ImageType::GIF);
    
        $res = ImageBuilder::create($img)->thumbPercentage(50)->toResource();
         
        $this->assertEquals(300, $res->getX());
        $this->assertEquals(300, $res->getY());
    }
    
    public function testThumbPng(){
        $img = $this->getOriginalImage(ImageType::PNG);
    
        $res = ImageBuilder::create($img)->thumbPercentage(50)->toResource();
         
        $this->assertEquals(300, $res->getX());
        $this->assertEquals(300, $res->getY());
    }
}