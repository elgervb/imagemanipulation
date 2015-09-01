<?php
namespace imagemanipulation\filter;

use imagemanipulation\color\ColorFactory;

use imagemanipulation\Coordinate;
use imagemanipulation\color\ColorUtil;
use imagemanipulation\ImageUtil;
use imagemanipulation\ImageType;
use imagemanipulation\filter\ImageFilterColorize;

class ImageFilterHueRotateTest extends \ImageFilterTestCase
{
	public function testGif(){
		$original = $this->getOriginalImage(ImageType::GIF);
		$res = $this->applyFilter(new ImageFilterHueRotate(), $original, __METHOD__);
		
		$this->assertColorQ1($res, 'ffff00');
		$this->assertColorQ2($res, '0000ff');
		$this->assertColorQ3($res, 'ff0000');
		$this->assertColorQ4($res, 'ffffff');
	}
	public function testJpg(){
		$original = $this->getOriginalImage(ImageType::JPG);
		$res = $this->applyFilter(new ImageFilterHueRotate(), $original, __METHOD__);

		$this->assertColorQ1($res, 'ffff00'); 
		$this->assertColorQ2($res, '0000ff');
		$this->assertColorQ3($res, 'ff0000');
		$this->assertColorQ4($res, 'ffffff');
	}
	public function testPng(){
		$original = $this->getOriginalImage(ImageType::PNG);
		$res = $this->applyFilter(new ImageFilterHueRotate(), $original, __METHOD__);
		
		$this->assertColorQ1($res, 'ffff00');
		$this->assertColorQ2($res, '0000ff');
		$this->assertColorQ3($res, 'ff0000');
		$this->assertColorQ4($res, 'ffffff');
	}
}