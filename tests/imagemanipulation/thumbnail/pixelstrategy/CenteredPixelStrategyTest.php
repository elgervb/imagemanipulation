<?php
namespace imagemanipulation\thumbnail\pixelstrategy;


use imagemanipulation\ImageType;
use imagemanipulation\ImageBuilder;
class CenteredPixelStrategyTest extends \ImagemanipulationTestCase{

    public function testCreatWithNumeric(){
        $s = new CenteredPixelStrategy("250", "250"); // this should work
    }
    
    public function testThumbJpg(){
        $img = $this->getOriginalImage(ImageType::JPG);
    
        $res = ImageBuilder::create($img)->thumbCentered(300, 200)->toResource();
         
        $this->assertEquals(300, $res->getX());
        $this->assertEquals(200, $res->getY());
    }
    
    public function testThumbGif(){
        $img = $this->getOriginalImage(ImageType::GIF);
    
        $res = ImageBuilder::create($img)->thumbCentered(300, 200)->toResource();
         
        $this->assertEquals(300, $res->getX());
        $this->assertEquals(200, $res->getY());
    }
    
    public function testThumbPng(){
        $img = $this->getOriginalImage(ImageType::PNG);
    
        $res = ImageBuilder::create($img)->thumbCentered(300, 200)->toResource();
         
        $this->assertEquals(300, $res->getX());
        $this->assertEquals(200, $res->getY());
    }
}