<?php
namespace imagemanipulation\color;

use imagemanipulation\color\Color;

/**
 * Color factory test case.
 */
class ColorFactoryTest extends \ImagemanipulationTestCase
{
    
    public function testBlack(){
        $this->assertColor(ColorFactory::black(), "000000");
    }
    
    public function testBlue(){
        $this->assertColor(ColorFactory::blue(), "0000ff");
    }
    
    public function testGreen(){
        $this->assertColor(ColorFactory::green(), "00ff00");
    }
    
    public function testRed(){
        $this->assertColor(ColorFactory::red(), "ff0000");
    }
    
	public function testWhite(){
	    $this->assertColor(ColorFactory::white(), "ffffff");
	}
	
	
	
	/**
	 * asserts that the color and the hex provided are the same
	 * @param Color $color
	 * @param string $hex
	 */
	private function assertColor(Color $color, $hex){
	    $this->assertEquals($color->getHexColor(), $hex, "Colors are not the same... ". $color->getHexColor() . " - " . $hex);
	}
	
}
