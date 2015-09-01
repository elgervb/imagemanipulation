<?php
namespace imagemanipulation\color;

use imagemanipulation\color\Color;
use imagemanipulation\ImageType;
use imagemanipulation\Coordinate;

/**
 * Color factory test case.
 */
class ColorUtilTest extends \ImagemanipulationTestCase
{
   public function testAverage(){
        
        $res = $this->getImageRes($this->getOriginalImage(ImageType::JPG), __METHOD__);
        $color = ColorUtil::average($res);
        
        $this->assertEquals("070707", $color->getHexColor(), "Colors are not the same. Average color is " . $color->getHexColor());
    }
    
    public function testGetColorAt(){
        $res = $this->getImageRes($this->getOriginalImage(ImageType::JPG), __METHOD__);
        
        $color = ColorUtil::getColorAt($res, Coordinate::create(20,20));
        $this->assertColor($color, 'fe0000');
    }
    
    public function testRgb2hsl(){
        $this->assertEquals( array(0, 0, 1), ColorUtil::rgb2hsl(255, 255,255), "Error converting rgb white into hsl");
        $this->assertEquals( array(0, 0, 0), ColorUtil::rgb2hsl(0, 0, 0), "Error converting rgb black into hsl" );
        $this->assertEquals( array(0.33, 1.0, 0.5), ColorUtil::rgb2hsl(0, 255, 0), "Error converting rgb green into hsl" );
        $this->assertEquals( array(0.67, 1.0, 0.5), ColorUtil::rgb2hsl(0, 0, 255), "Error converting rgb blue into hsl" );
    }
    
    public function testhsl2Rgb(){
        $this->assertEquals( array(255, 255,255), ColorUtil::hsl2rgb(0, 0, 1), "Error converting hsl into rgb white ");
        $this->assertEquals( array(0, 0, 0), ColorUtil::hsl2rgb(0, 0, 0), "Error converting hsl into  rgb black into hsl" );
        $this->assertEquals( array(0, 255, 0), ColorUtil::hsl2rgb(0.33, 1.0, 0.5), "Error converting hsl into rgb green" );
        $this->assertEquals( array(0, 0, 255), ColorUtil::hsl2rgb(0.67, 1.0, 0.5), "Error converting hsl into rgb blue" );
    }
    
    public function testHex2hsl(){
        $this->assertEquals( array(0, 0, 1), ColorUtil::hex2hsl('ffffff'), "Error converting hex white into hsl");
        $this->assertEquals( array(0, 0, 1), ColorUtil::hex2hsl('#ffffff'), "Error converting hex #white into hsl");
        $this->assertEquals( array(0, 0, 0), ColorUtil::hex2hsl('000000'), "Error converting hex black into hsl" );
        $this->assertEquals( array(0.33, 1.0, 0.5), ColorUtil::hex2hsl('00ff00'), "Error converting hex green into hsl" );
        $this->assertEquals( array(0.67, 1.0, 0.5), ColorUtil::hex2hsl('0000ff'), "Error converting hex blue into hsl" );
    }
}
