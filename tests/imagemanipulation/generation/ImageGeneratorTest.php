<?php
namespace imagemanipulation\generation;

use imagemanipulation\color\ColorUtil;
use imagemanipulation\Coordinate;
use imagemanipulation\color\Color;
use test\ImagemanipulationTestCase;

class ImageGeneratorTest extends ImagemanipulationTestCase
{
    public function testCreate(){
        $width = 250;
        $height = 750;
        $color = 'ff00ff';
        
        $res = ImageGenerator::create($width, $height, new Color($color));
        
        $this->assertEquals($width, $res->getWidth());
        $this->assertEquals($height, $res->getHeight());
        
        $this->assertEquals($color, ColorUtil::getColorAt($res, Coordinate::create(0,0))->getHexColor());
        $this->assertEquals($color, ColorUtil::getColorAt($res, Coordinate::create($width/2,$height/2))->getHexColor());
        $this->assertEquals($color, ColorUtil::getColorAt($res, Coordinate::create($width-1,$height-1))->getHexColor());
    }
    
    public function testGradient() {
        $width = 250;
        $height = 750;
        $startColor = 'ffffff';
        $endColor = '000000';
        
        $res = ImageGenerator::gradient($width, $height, 1, new Color($startColor), new Color($endColor));
        
        $this->assertEquals($width, $res->getWidth());
        $this->assertEquals($height, $res->getHeight());
        
        $this->assertEquals($startColor, ColorUtil::getColorAt($res, Coordinate::create(0,0))->getHexColor());
        $this->assertEquals('7e7e7e', ColorUtil::getColorAt($res, Coordinate::create($width/2,$height/2))->getHexColor());
        $this->assertEquals($endColor, ColorUtil::getColorAt($res, Coordinate::create($width - 1, $height - 1))->getHexColor());
    }
}
