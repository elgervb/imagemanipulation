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
}
