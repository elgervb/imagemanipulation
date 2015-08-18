<?php
namespace imagemanipulation\filter;

use imagemanipulation\Coordinate;
use imagemanipulation\color\ColorUtil;
use imagemanipulation\ImageUtil;
use imagemanipulation\ImageType;
use imagemanipulation\filter\ImageFilterNegative;

class ImageFilterNegativeTest extends \ImageFilterTestCase
{
	public function testGif(){
		$original = $this->getOriginalImage(ImageType::GIF);
		$res = $this->applyFilter(new ImageFilterNegative(), $original, __METHOD__);
		
		$this->assertColorQ1($res, '00ffff');
		$this->assertColorQ2($res, 'ff00ff');
		$this->assertColorQ3($res, 'ffff00');
		$this->assertColorQ4($res, self::BLACK);
	}
	public function testJpg(){
		$original = $this->getOriginalImage(ImageType::JPG);
		$res = $this->applyFilter(new ImageFilterNegative(), $original, __METHOD__);

		$this->assertColorQ1($res, '01ffff');
		$this->assertColorQ2($res, 'ff00fe');
		$this->assertColorQ3($res, 'ffff01');
		$this->assertColorQ4($res, self::BLACK);
	}
	public function testPng(){
		$original = $this->getOriginalImage(ImageType::PNG);
		$res = $this->applyFilter(new ImageFilterNegative(), $original, __METHOD__);
		
		$this->assertColorQ1($res, '00ffff');
		$this->assertColorQ2($res, 'ff00ff');
		$this->assertColorQ3($res, 'ffff00');
		$this->assertColorQ4($res, self::BLACK);
	}
}
