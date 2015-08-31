<?php
namespace imagemanipulation\filter;

use imagemanipulation\Coordinate;
use imagemanipulation\color\ColorUtil;
use imagemanipulation\ImageUtil;
use imagemanipulation\ImageType;
use imagemanipulation\filter\ImageFilterNegative;

class ImageFilterTruecolorTest extends \ImageFilterTestCase
{ 
	public function testGif(){
		$original = $this->getOriginalImage(ImageType::GIF);
		$res = $this->applyFilter(new ImageFilterTrueColor('dddddd', '999999'), $original, __METHOD__);
		
		$this->assertColorQ1($res, '999999');
		$this->assertColorQ2($res, '999999');
		$this->assertColorQ3($res, '999999');
		$this->assertColorQ4($res, 'dddddd');
	}
	public function testJpg(){
		$original = $this->getOriginalImage(ImageType::JPG);
		$res = $this->applyFilter(new ImageFilterTrueColor('dddddd', '999999'), $original, __METHOD__);

		$this->assertColorQ1($res, '999999');
		$this->assertColorQ2($res, '999999');
		$this->assertColorQ3($res, '999999');
		$this->assertColorQ4($res, 'dddddd');
	}
	public function testPng(){
		$original = $this->getOriginalImage(ImageType::PNG);
		$res = $this->applyFilter(new ImageFilterTrueColor('dddddd', '999999'), $original, __METHOD__);
		
		$this->assertColorQ1($res, '999999');
		$this->assertColorQ2($res, '999999');
		$this->assertColorQ3($res, '999999');
		$this->assertColorQ4($res, 'dddddd');
	}
}

