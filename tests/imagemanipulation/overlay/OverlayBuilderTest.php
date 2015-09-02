<?php
namespace imagemanipulation\overlay;

use imagemanipulation\ImageBuilder;
use imagemanipulation\ImageType;
class OverlayBuilderTest extends \ImageFilterTestCase
{
    public function testJpgOverlayJpg(){
        $builder = new ImageBuilder($this->getOriginalImage(ImageType::JPG));
        $builder->overlay(__DIR__ . '/img/vignette.jpg', 10);
        
        $res = $builder->toResource();
        
        $this->assertColorQ1($res, 'e90504');
        $this->assertColorQ2($res, '05ea05');
        $this->assertColorQ3($res, '0505e8');
        $this->assertColorQ4($res, 'eaeae9');
    }
    
    public function testJpgOverlayPng32bit(){
        $builder = new ImageBuilder($this->getOriginalImage(ImageType::JPG));
        $builder->overlay(__DIR__ . '/img/vignette-32.png', 10);
    
        $res = $builder->toResource();
    
        $this->assertColorQ1($res, '341a11');
        $this->assertColorQ2($res, '1d3011');
        $this->assertColorQ3($res, '1d1a27');
        $this->assertColorQ4($res, '333027');
    }
    
    public function testJpgOverlayPng24bit(){
        $builder = new ImageBuilder($this->getOriginalImage(ImageType::JPG));
        $builder->overlay(__DIR__ . '/img/vignette-24.png', 10);
    
        $res = $builder->toResource();
    
        $this->assertColorQ1($res, 'e90504');
        $this->assertColorQ2($res, '05ea04');
        $this->assertColorQ3($res, '0504e8');
        $this->assertColorQ4($res, 'eaeae9');
    }
    
    public function testJpgOverlayPng8bit(){
        $builder = new ImageBuilder($this->getOriginalImage(ImageType::JPG));
        $builder->overlay(__DIR__ . '/img/vignette-8.png', 10);
    
        $res = $builder->toResource();
    
        $this->assertColorQ1($res, 'e90504');
        $this->assertColorQ2($res, '05ea04');
        $this->assertColorQ3($res, '0504e8');
        $this->assertColorQ4($res, 'eaeae9');
    }
    
    public function testJpgOverlayGif(){
        $builder = new ImageBuilder($this->getOriginalImage(ImageType::JPG));
        $builder->overlay(__DIR__ . '/img/vignette.gif', 10);
    
        $res = $builder->toResource();
    
        $this->assertColorQ1($res, 'e90504');
        $this->assertColorQ2($res, '05ea04');
        $this->assertColorQ3($res, '0504e8');
        $this->assertColorQ4($res, 'eaeae9');
    }
    
    
    
    public function testGifOverlayJpg(){
        $builder = new ImageBuilder($this->getOriginalImage(ImageType::GIF));
        $builder->overlay(__DIR__ . '/img/vignette.jpg', 10);
    
        $res = $builder->toResource();
    
        $this->assertColorQ1($res, 'ea0504');
        $this->assertColorQ2($res, '05ea04');
        $this->assertColorQ3($res, '0505e9');
        $this->assertColorQ4($res, 'eaeae9');
    }
    
    public function testGifOverlayPng32bit(){
        $builder = new ImageBuilder($this->getOriginalImage(ImageType::GIF));
        $builder->overlay(__DIR__ . '/img/vignette-32.png', 10);
    
        $res = $builder->toResource();
    
        $this->assertColorQ1($res, '351a11');
        $this->assertColorQ2($res, '1d3011');
        $this->assertColorQ3($res, '1d1a27');
        $this->assertColorQ4($res, '333027');
    }
    
    public function testGifOverlayPng24bit(){
        $builder = new ImageBuilder($this->getOriginalImage(ImageType::GIF));
        $builder->overlay(__DIR__ . '/img/vignette-24.png', 10);
    
        $res = $builder->toResource();
    
        $this->assertColorQ1($res, 'ea0504');
        $this->assertColorQ2($res, '05ea03');
        $this->assertColorQ3($res, '0504e9');
        $this->assertColorQ4($res, 'eaeae9');
    }
    
    public function testGifOverlayPng8bit(){
        $builder = new ImageBuilder($this->getOriginalImage(ImageType::GIF));
        $builder->overlay(__DIR__ . '/img/vignette-8.png', 10);
    
        $res = $builder->toResource();
    
        $this->assertColorQ1($res, 'ea0504');
        $this->assertColorQ2($res, '05ea03');
        $this->assertColorQ3($res, '0504e9');
        $this->assertColorQ4($res, 'eaeae9');
    }
    
    public function testGifOverlayGif(){
        $builder = new ImageBuilder($this->getOriginalImage(ImageType::GIF));
        $builder->overlay(__DIR__ . '/img/vignette.gif', 10);
    
        $res = $builder->toResource();
    
        $this->assertColorQ1($res, 'ea0504');
        $this->assertColorQ2($res, '05ea03');
        $this->assertColorQ3($res, '0504e9');
        $this->assertColorQ4($res, 'eaeae9');
    }
    
    
    
    public function testPngOverlayJpg(){
        $builder = new ImageBuilder($this->getOriginalImage(ImageType::PNG));
        $builder->overlay(__DIR__ . '/img/vignette.jpg', 10);
    
        $res = $builder->toResource();
    
        $this->assertColorQ1($res, 'ea0504');
        $this->assertColorQ2($res, '05ea04');
        $this->assertColorQ3($res, '0505e9');
        $this->assertColorQ4($res, 'eaeae9');
    }
    
    public function testPngOverlayPng32bit(){
        $builder = new ImageBuilder($this->getOriginalImage(ImageType::PNG));
        $builder->overlay(__DIR__ . '/img/vignette-32.png', 10);
    
        $res = $builder->toResource();
    
        $this->assertColorQ1($res, '351a11');
        $this->assertColorQ2($res, '1d3011');
        $this->assertColorQ3($res, '1d1a27');
        $this->assertColorQ4($res, '333027');
    }
    
    public function testPngOverlayPng24bit(){
        $builder = new ImageBuilder($this->getOriginalImage(ImageType::PNG));
        $builder->overlay(__DIR__ . '/img/vignette-24.png', 10);
    
        $res = $builder->toResource();
    
        $this->assertColorQ1($res, 'ea0504');
        $this->assertColorQ2($res, '05ea03');
        $this->assertColorQ3($res, '0504e9');
        $this->assertColorQ4($res, 'eaeae9');
    }
    
    public function testPngOverlayPng8bit(){
        $builder = new ImageBuilder($this->getOriginalImage(ImageType::PNG));
        $builder->overlay(__DIR__ . '/img/vignette-8.png', 10);
    
        $res = $builder->toResource();
    
        $this->assertColorQ1($res, 'ea0504');
        $this->assertColorQ2($res, '05ea03');
        $this->assertColorQ3($res, '0504e9');
        $this->assertColorQ4($res, 'eaeae9');
    }
    
    public function testPngOverlayGif(){
        $builder = new ImageBuilder($this->getOriginalImage(ImageType::PNG));
        $builder->overlay(__DIR__ . '/img/vignette.gif', 10);
    
        $res = $builder->toResource();
    
        $this->assertColorQ1($res, 'ea0504');
        $this->assertColorQ2($res, '05ea03');
        $this->assertColorQ3($res, '0504e9');
        $this->assertColorQ4($res, 'eaeae9');
    }
}
