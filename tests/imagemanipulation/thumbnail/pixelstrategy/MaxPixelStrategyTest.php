<?php
namespace imagemanipulation\thumbnail\pixelstrategy;

use imagemanipulation\ImageType;
use imagemanipulation\ImageBuilder;
use imagemanipulation\generation\ImageGenerator;
use imagemanipulation\color\Color;
use imagemanipulation\thumbnail\Thumbalizer;
use test\ImagemanipulationTestCase;

class MaxPixelStrategyTest extends ImagemanipulationTestCase{

    public function testCreatFromString(){
        $s = new MaxPixelStrategy("300", "500"); // this should work
        
        $this->assertNotNull($s);
    }
    
    public function testThumbJpg(){
        $img = $this->getOriginalImage(ImageType::JPG);
        
	    $res = ImageBuilder::create($img)->thumbMax(300, 200)->toResource();
	    
	    $this->assertEquals(200, $res->getX());
	    $this->assertEquals(200, $res->getY());
    }
    
    public function testThumbJpgRect(){
        $img = new \SplFileInfo( __DIR__ . '/../../../test/sample-rect.jpg' );
    
        $res = ImageBuilder::create($img)->thumbMax(300, 200)->toResource();
         
        $this->assertEquals(100, $res->getX(), 'Checking image width');
        $this->assertEquals(200, $res->getY(), 'Checking image height');
    }
    
    public function testThumbGif(){
        $img = $this->getOriginalImage(ImageType::GIF);
    
        $res = ImageBuilder::create($img)->thumbMax(300, 200)->toResource();
         
        $this->assertEquals(200, $res->getX());
        $this->assertEquals(200, $res->getY());
    }
    
    /**
     * https://github.com/elgervb/imagemanipulation/issues/26
     */
    public function testTooLargeX(){
        $res = ImageGenerator::create(1251, 826, new Color('#999'));
        
        $thumbilizer = new Thumbalizer(new MaxPixelStrategy(250, 250));
        $thumb = $thumbilizer->create($res);
        
        $this->assertEquals(250, $thumb->getX(), 'Checking image width');
        $this->assertEquals(165, $thumb->getY(), 'Checking image height');
    }
    
    /**
     * https://github.com/elgervb/imagemanipulation/issues/26
     */
    public function testTooLargeY(){
        $res = ImageGenerator::create(826, 1251, new Color('#999'));
    
        $thumbilizer = new Thumbalizer(new MaxPixelStrategy(250, 250));
        $thumb = $thumbilizer->create($res);
    
        $this->assertEquals(165, $thumb->getX(), 'Checking image width');
        $this->assertEquals(250, $thumb->getY(), 'Checking image height');
    }
    
    public function testThumbPng(){
        $img = $this->getOriginalImage(ImageType::PNG);
    
        $res = ImageBuilder::create($img)->thumbMax(300, 200)->toResource();
         
        $this->assertEquals(200, $res->getX());
        $this->assertEquals(200, $res->getY());
    }
}