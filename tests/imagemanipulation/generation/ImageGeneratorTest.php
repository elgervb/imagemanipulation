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
        
        $this->assertEquals($width, $res->getX());
        $this->assertEquals($height, $res->getY());
        
        $this->assertEquals($color, ColorUtil::getColorAt($res, Coordinate::create(0,0))->getHexColor());
        $this->assertEquals($color, ColorUtil::getColorAt($res, Coordinate::create($width/2,$height/2))->getHexColor());
        $this->assertEquals($color, ColorUtil::getColorAt($res, Coordinate::create($width-1,$height-1))->getHexColor());
    }
}
