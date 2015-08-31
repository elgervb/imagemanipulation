<?php
namespace imagemanipulation\color;

use imagemanipulation\color\Color;
use imagemanipulation\ImageType;
use imagemanipulation\ImageBuilder;

/**
 * Color test case.
 */
class ThumbalizerTest extends \ImagemanipulationTestCase
{
    public function testSquareJpg(){
        $img = $this->getOriginalImage(ImageType::JPG);
        
        $res = ImageBuilder::create($img)->toResource();
        $this->assertEquals($res->getX(), 600);
        $this->assertEquals($res->getY(), 600);
        
        $res = ImageBuilder::create($img)->thumbSquare(100)->toResource();
        $this->assertEquals($res->getX(), 100);
        $this->assertEquals($res->getY(), 100);
    }
    public function testSquarePng(){
        $img = $this->getOriginalImage(ImageType::PNG);
    
        $res = ImageBuilder::create($img)->toResource();
        $this->assertEquals($res->getX(), 600);
        $this->assertEquals($res->getY(), 600);
    
        $res = ImageBuilder::create($img)->thumbSquare(100)->toResource();
        $this->assertEquals($res->getX(), 100);
        $this->assertEquals($res->getY(), 100);
    }
    public function testSquareGif(){
        $img = $this->getOriginalImage(ImageType::GIF);
    
        $res = ImageBuilder::create($img)->toResource();
        $this->assertEquals($res->getX(), 600);
        $this->assertEquals($res->getY(), 600);
    
        $res = ImageBuilder::create($img)->thumbSquare(100)->toResource();
        $this->assertEquals($res->getX(), 100);
        $this->assertEquals($res->getY(), 100);
    }
 

    public function testCenteredJpg(){
        $img = $this->getOriginalImage(ImageType::JPG);
    
        $res = ImageBuilder::create($img)->toResource();
        $this->assertEquals($res->getX(), 600);
        $this->assertEquals($res->getY(), 600);
    
        $res = ImageBuilder::create($img)->thumbCentered(150, 250)->toResource();
        $this->assertEquals($res->getX(), 150);
        $this->assertEquals($res->getY(), 250);
        
        return $res;
    }
    public function testCenteredPng(){
        $img = $this->getOriginalImage(ImageType::PNG);
    
        $res = ImageBuilder::create($img)->toResource();
        $this->assertEquals($res->getX(), 600);
        $this->assertEquals($res->getY(), 600);
    
        $res = ImageBuilder::create($img)->thumbCentered(150, 250)->toResource();
        $this->assertEquals($res->getX(), 150);
        $this->assertEquals($res->getY(), 250);

        return $res;
    }
    public function testCenteredGif(){
        $img = $this->getOriginalImage(ImageType::GIF);
    
        $res = ImageBuilder::create($img)->toResource();
        $this->assertEquals($res->getX(), 600);
        $this->assertEquals($res->getY(), 600);
    
        $res = ImageBuilder::create($img)->thumbCentered(150, 250)->toResource();
        $this->assertEquals($res->getX(), 150);
        $this->assertEquals($res->getY(), 250);

        return $res;
    }
    
    
    public function testPercentageJpg(){
        $img = $this->getOriginalImage(ImageType::JPG);
    
        $res = ImageBuilder::create($img)->toResource();
        $this->assertEquals($res->getX(), 600);
        $this->assertEquals($res->getY(), 600);
    
        $res = ImageBuilder::create($img)->thumbPercentage(50)->toResource();
        $this->assertEquals($res->getX(), 300);
        $this->assertEquals($res->getY(), 300);
    }
    public function testPercentagePng(){
        $img = $this->getOriginalImage(ImageType::PNG);
    
        $res = ImageBuilder::create($img)->toResource();
        $this->assertEquals($res->getX(), 600);
        $this->assertEquals($res->getY(), 600);
    
        $res = ImageBuilder::create($img)->thumbPercentage(50)->toResource();
        $this->assertEquals($res->getX(), 300);
        $this->assertEquals($res->getY(), 300);
    }
    public function testPercentageGif(){
        $img = $this->getOriginalImage(ImageType::GIF);
    
        $res = ImageBuilder::create($img)->toResource();
        $this->assertEquals($res->getX(), 600);
        $this->assertEquals($res->getY(), 600);
    
        $res = ImageBuilder::create($img)->thumbPercentage(50)->toResource();
        $this->assertEquals($res->getX(), 300);
        $this->assertEquals($res->getY(), 300);
    }
    
    public function testMaxJpg(){
        $img = $this->getOriginalImage(ImageType::JPG);
        $builder = ImageBuilder::create($img)->thumbCentered(200, 100);
        
        $res = $builder->thumbMax(100, 100)->toResource();
        $this->assertEquals($res->getX(), 100);
        $this->assertEquals($res->getY(), 50);
    }
    public function testMaxPng(){
        $img = $this->getOriginalImage(ImageType::PNG);
        $builder = ImageBuilder::create($img)->thumbCentered(200, 100);
    
        $res = $builder->thumbMax(100, 100)->toResource();
        $this->assertEquals($res->getX(), 100);
        $this->assertEquals($res->getY(), 50);
    }
    public function testMaxGif(){
        $img = $this->getOriginalImage(ImageType::GIF);
        $builder = ImageBuilder::create($img)->thumbCentered(200, 100);
    
        $res = $builder->thumbMax(100, 100)->toResource();
        $this->assertEquals($res->getX(), 100);
        $this->assertEquals($res->getY(), 50);
    }
}
