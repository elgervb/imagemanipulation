<?php
namespace imagemanipulation\color;

use imagemanipulation\color\Color;

/**
 * Color test case.
 */
class ColorTest extends \ImagemanipulationTestCase
{
	/**
	 * Prepares the environment before running a test.
	 */
	protected function setUp()
	{
		parent::setUp();
	}
	
	/**
	 * Cleans up the environment after running a test.
	 */
	protected function tearDown()
	{
		parent::tearDown();
	}
	
	/**
	 * Tests Color->__construct()
	 */
	public function test__constructHexShort()
	{
		$this->checkColorDDD( new Color('ddd', 127) );
	}
	
	/**
	 * Tests Color->__construct()
	 */
	public function test__constructHexShortHash()
	{
		$this->checkColorDDD( new Color('#ddd', 127) );
	}
	
	/**
	 * Tests Color->__construct()
	 */
	public function test__constructHexLongHash()
	{
		$this->checkColorDDD( new Color('#dddddd', 127) );
	}
	/**
	 * Tests Color->__construct()
	 */
	public function test__constructHexLong()
	{
		$this->checkColorDDD( new Color('dddddd', 127) );
	}
	/**
	 * Tests Color->__construct()
	 */
	public function test__constructRGB()
	{
		$this->checkColorDDD( new Color('rgb(221,221,221)', 127) );
	}
	
	/**
	 * Tests Color->__construct()
	 */
	public function test__constructRGBA()
	{
		$this->checkColorDDD( new Color('rgb(221,221,221,127)', 128) );
	}
	
	/**
	 * Tests Color->__construct()
	 */
	public function test__constructIndex()
	{
		$this->checkColorDDD( new Color(2145246685) );
	}
	
	/**
	 * Check 
	 */
	public function testCreateColorIndexNoAlpah(){
	     
	    $this->assertEquals("16777215", Color::createColorIndex(255, 255, 255));
	}
	
	private function checkColorDDD(Color $aColor){
		$this->assertEquals(221, $aColor->getRed(), 'Checking red');
		$this->assertEquals(221, $aColor->getGreen(), 'Checking green');
		$this->assertEquals(221, $aColor->getBlue(), 'Checking blue');
		$this->assertEquals(127, $aColor->getAlpha(), 'Checking alpha');
		$this->assertEquals('dddddd', $aColor->getHexColor(), 'Checking hex color code');
		$this->assertEquals(2145246685, $aColor->getColorIndex(), 'Checking color index');
	}
}
