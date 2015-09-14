<?php
namespace imagemanipulation\thumbnail\pixelstrategy;


use imagemanipulation\ImageType;
use imagemanipulation\ImageBuilder;
class MaxPixelStrategyTest extends \ImagemanipulationTestCase{

    public function testCreatWithNumeric(){
        $s = new MaxPixelStrategy("300", "500"); // this should work
    }
    
    public function testThumbJpg(){
        $img = $this->getOriginalImage(ImageType::JPG);
        
	    $res = ImageBuilder::create($img)->thumbMax(300, 200)->toResource();
	    
	    $this->assertEquals(200, $res->getX());
	    $this->assertEquals(200, $res->getY());
    }
    
    public function testThumbGif(){
        $img = $this->getOriginalImage(ImageType::GIF);
    
        $res = ImageBuilder::create($img)->thumbMax(300, 200)->toResource();
         
        $this->assertEquals(200, $res->getX());
        $this->assertEquals(200, $res->getY());
    }
    
    public function testThumbPng(){
        $img = $this->getOriginalImage(ImageType::PNG);
    
        $res = ImageBuilder::create($img)->thumbMax(300, 200)->toResource();
         
        $this->assertEquals(200, $res->getX());
        $this->assertEquals(200, $res->getY());
    }
}