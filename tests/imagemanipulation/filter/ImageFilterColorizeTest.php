<?php
namespace imagemanipulation\filter;

use imagemanipulation\color\ColorFactory;

use imagemanipulation\Coordinate;
use imagemanipulation\color\ColorUtil;
use imagemanipulation\ImageUtil;
use imagemanipulation\ImageType;
use imagemanipulation\filter\ImageFilterColorize;

class ImageFilterColorizeTest extends \ImageFilterTestCase
{
	public function testGifRed(){
		$original = $this->getOriginalImage(ImageType::GIF);
		$res = $this->applyFilter(new ImageFilterColorize( ColorFactory::red() ), $original, __METHOD__);
		
		$this->assertColorQ1($res, self::RED); // unchanged
		$this->assertColorQ2($res, 'ffff00');
		$this->assertColorQ3($res, 'ff00ff');
		$this->assertColorQ4($res, self::WHITE);
	}
	public function testJpgRed(){
		$original = $this->getOriginalImage(ImageType::JPG);
		$res = $this->applyFilter(new ImageFilterColorize(ColorFactory::red()), $original, __METHOD__);

		$this->assertColorQ1($res, self::RED); // unchanged
		$this->assertColorQ2($res, 'ffff01');
		$this->assertColorQ3($res, 'ff00fe');
		$this->assertColorQ4($res, self::WHITE);
	}
	public function testPngRed(){
		$original = $this->getOriginalImage(ImageType::PNG);
		$res = $this->applyFilter(new ImageFilterColorize(ColorFactory::red()), $original, __METHOD__);
		
		$this->assertColorQ1($res, self::RED); // unchanged
		$this->assertColorQ2($res, 'ffff00');
		$this->assertColorQ3($res, 'ff00ff');
		$this->assertColorQ4($res, self::WHITE);
	}
	
	public function testGifBlue(){
		$original = $this->getOriginalImage(ImageType::GIF);
		$res = $this->applyFilter(new ImageFilterColorize( ColorFactory::blue() ), $original, __METHOD__);
	
		$this->assertColorQ1($res, 'ff00ff');
		$this->assertColorQ2($res, '00ffff');
		$this->assertColorQ3($res, self::BLUE); // unchanged
		$this->assertColorQ4($res, self::WHITE);
	}
	public function testJpgBlue(){
		$original = $this->getOriginalImage(ImageType::JPG);
		$res = $this->applyFilter(new ImageFilterColorize(ColorFactory::blue()), $original, __METHOD__);
	
		$this->assertColorQ1($res, 'fe00ff'); 
		$this->assertColorQ2($res, '00ffff');
		$this->assertColorQ3($res, self::BLUE);// unchanged
		$this->assertColorQ4($res, self::WHITE);
	}
	public function testPngBlue(){
		$original = $this->getOriginalImage(ImageType::PNG);
		$res = $this->applyFilter(new ImageFilterColorize(ColorFactory::blue()), $original, __METHOD__);
	
		$this->assertColorQ1($res, 'ff00ff');
		$this->assertColorQ2($res, '00ffff');
		$this->assertColorQ3($res, self::BLUE); // unchanged
		$this->assertColorQ4($res, self::WHITE);
	}
}
