<?php
namespace imagemanipulation\overlay;

use imagemanipulation\ImageBuilder;
use imagemanipulation\ImageType;
use test\ImageFilterTestCase;

class OverlayBuilderTest extends ImageFilterTestCase
{
    public function testJpgOverlayJpg(){
        $builder = new ImageBuilder($this->getOriginalImage(ImageType::JPG));
        $builder->overlay(__DIR__ . '/img/vignette.jpg', 10);
        
        $res = $builder->toResource();
        
        $this->assertColorQ1($res, 'eb0605');
        $this->assertColorQ2($res, '06eb06');
        $this->assertColorQ3($res, '0606e9');
        $this->assertColorQ4($res, 'ebebea');
    }
    
    public function testJpgOverlayPng32bit(){
        $builder = new ImageBuilder($this->getOriginalImage(ImageType::JPG));
        $builder->overlay(__DIR__ . '/img/vignette-32.png', 10);
    
        $res = $builder->toResource();
    
        $this->assertColorQ1($res, '3f1810');
        $this->assertColorQ2($res, '1b3b10');
        $this->assertColorQ3($res, '1b1834');
        $this->assertColorQ4($res, '3d3b32');
    }
    
    public function testJpgOverlayPng24bit(){
        $builder = new ImageBuilder($this->getOriginalImage(ImageType::JPG));
        $builder->overlay(__DIR__ . '/img/vignette-24.png', 10);
    
        $res = $builder->toResource();
    
        $this->assertColorQ1($res, 'eb0605');
        $this->assertColorQ2($res, '06eb06');
        $this->assertColorQ3($res, '0606e9');
        $this->assertColorQ4($res, 'ebebea');
    }
    
    public function testJpgOverlayPng8bit(){
        $builder = new ImageBuilder($this->getOriginalImage(ImageType::JPG));
        $builder->overlay(__DIR__ . '/img/vignette-8.png', 10);
    
        $res = $builder->toResource();
    
        $this->assertColorQ1($res, 'eb0605');
        $this->assertColorQ2($res, '06eb06');
        $this->assertColorQ3($res, '0606e9');
        $this->assertColorQ4($res, 'ebebea');
    }
    
    public function testJpgOverlayGif(){
        $builder = new ImageBuilder($this->getOriginalImage(ImageType::JPG));
        $builder->overlay(__DIR__ . '/img/vignette.gif', 10);
    
        $res = $builder->toResource();
    
        $this->assertColorQ1($res, 'eb0605');
        $this->assertColorQ2($res, '06eb06');
        $this->assertColorQ3($res, '0606e9');
        $this->assertColorQ4($res, 'ebebea');
    }
    
    
    
    public function testGifOverlayJpg(){
        $builder = new ImageBuilder($this->getOriginalImage(ImageType::GIF));
        $builder->overlay(__DIR__ . '/img/vignette.jpg', 10);
    
        $res = $builder->toResource();
    
        $this->assertColorQ1($res, 'ec0605');
        $this->assertColorQ2($res, '06eb05');
        $this->assertColorQ3($res, '0606ea');
        $this->assertColorQ4($res, 'ebebea');
    }
    
    public function testGifOverlayPng32bit(){
        $builder = new ImageBuilder($this->getOriginalImage(ImageType::GIF));
        $builder->overlay(__DIR__ . '/img/vignette-32.png', 10);
    
        $res = $builder->toResource();
    
        $this->assertColorQ1($res, '3f1810');
        $this->assertColorQ2($res, '1b3b10');
        $this->assertColorQ3($res, '1b1834');
        $this->assertColorQ4($res, '3d3b32');
    }
    
    public function testGifOverlayPng24bit(){
        $builder = new ImageBuilder($this->getOriginalImage(ImageType::GIF));
        $builder->overlay(__DIR__ . '/img/vignette-24.png', 10);
    
        $res = $builder->toResource();
    
        $this->assertColorQ1($res, 'eb0605');
        $this->assertColorQ2($res, '06eb05');
        $this->assertColorQ3($res, '0606ea');
        $this->assertColorQ4($res, 'ebebea');
    }
    
    public function testGifOverlayPng8bit(){
        $builder = new ImageBuilder($this->getOriginalImage(ImageType::GIF));
        $builder->overlay(__DIR__ . '/img/vignette-8.png', 10);
    
        $res = $builder->toResource();
    
        $this->assertColorQ1($res, 'eb0605');
        $this->assertColorQ2($res, '06eb05');
        $this->assertColorQ3($res, '0606ea');
        $this->assertColorQ4($res, 'ebebea');
    }
    
    public function testGifOverlayGif(){
        $builder = new ImageBuilder($this->getOriginalImage(ImageType::GIF));
        $builder->overlay(__DIR__ . '/img/vignette.gif', 10);
    
        $res = $builder->toResource();
    
        $this->assertColorQ1($res, 'eb0605');
        $this->assertColorQ2($res, '06eb05');
        $this->assertColorQ3($res, '0606ea');
        $this->assertColorQ4($res, 'ebebea');
    }
    
    public function testPngOverlayJpg(){
        $builder = new ImageBuilder($this->getOriginalImage(ImageType::PNG));
        $builder->overlay(__DIR__ . '/img/vignette.jpg', 10);
    
        $res = $builder->toResource();
    
        $this->assertColorQ1($res, 'ec0605');
        $this->assertColorQ2($res, '06eb05');
        $this->assertColorQ3($res, '0606ea');
        $this->assertColorQ4($res, 'ebebea');
    }
    
    public function testPngOverlayPng32bit(){
        $builder = new ImageBuilder($this->getOriginalImage(ImageType::PNG));
        $builder->overlay(__DIR__ . '/img/vignette-32.png', 10);
    
        $res = $builder->toResource();
    
        $this->assertColorQ1($res, '3f1810');
        $this->assertColorQ2($res, '1b3b10');
        $this->assertColorQ3($res, '1b1834');
        $this->assertColorQ4($res, '3d3b32');
    }
    
    public function testPngOverlayPng24bit(){
        $builder = new ImageBuilder($this->getOriginalImage(ImageType::PNG));
        $builder->overlay(__DIR__ . '/img/vignette-24.png', 10);
    
        $res = $builder->toResource();
    
        $this->assertColorQ1($res, 'eb0605');
        $this->assertColorQ2($res, '06eb05');
        $this->assertColorQ3($res, '0606ea');
        $this->assertColorQ4($res, 'ebebea');
    }
    
    public function testPngOverlayPng8bit(){
        $builder = new ImageBuilder($this->getOriginalImage(ImageType::PNG));
        $builder->overlay(__DIR__ . '/img/vignette-8.png', 10);
    
        $res = $builder->toResource();
    
        $this->assertColorQ1($res, 'eb0605');
        $this->assertColorQ2($res, '06eb05');
        $this->assertColorQ3($res, '0606ea');
        $this->assertColorQ4($res, 'ebebea');
    }
    
    public function testPngOverlayGif(){
        $builder = new ImageBuilder($this->getOriginalImage(ImageType::PNG));
        $builder->overlay(__DIR__ . '/img/vignette.gif', 10);
    
        $res = $builder->toResource();
    
        $this->assertColorQ1($res, 'eb0605');
        $this->assertColorQ2($res, '06eb05');
        $this->assertColorQ3($res, '0606ea');
        $this->assertColorQ4($res, 'ebebea');
    }
}
