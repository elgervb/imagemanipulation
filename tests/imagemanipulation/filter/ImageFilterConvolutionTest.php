<?php
namespace imagemanipulation\filter;

use imagemanipulation\Coordinate;
use imagemanipulation\color\ColorUtil;
use imagemanipulation\filter\ImageFilterConvolution;
use imagemanipulation\ImageType;
use imagemanipulation\ImageUtil;

class ImageFilterConvolutionTest extends \ImageFilterTestCase
{
	public function testGifNoChange(){
		$original = $this->getOriginalImage(ImageType::GIF);
		$res = $this->applyFilter(new ImageFilterConvolution(0,0,0,0,1,0,0,0,0), $original, __METHOD__);
		
		$this->assertColorQ1($res, 'ff0000');
		$this->assertColorQ2($res, '00ff00');
		$this->assertColorQ3($res, '0000ff');
		$this->assertColorQ4($res, self::WHITE);
	}
	public function testJpgNoChange(){
		$original = $this->getOriginalImage(ImageType::JPG);
		$res = $this->applyFilter(new ImageFilterConvolution(0,0,0,0,1,0,0,0,0), $original, __METHOD__);

		$this->assertColorQ1($res, 'fe0000');
		$this->assertColorQ2($res, '00ff01');
		$this->assertColorQ3($res, '0000fe');
		$this->assertColorQ4($res, self::WHITE);
	}
	public function testPngNoChange(){
		$original = $this->getOriginalImage(ImageType::PNG);
		$res = $this->applyFilter(new ImageFilterConvolution(0,0,0,0,1,0,0,0,0), $original, __METHOD__);
		
		$this->assertColorQ1($res, 'ff0000');
		$this->assertColorQ2($res, '00ff00');
		$this->assertColorQ3($res, '0000ff');
		$this->assertColorQ4($res, self::WHITE);
	}
}
