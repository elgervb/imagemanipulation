<?php
namespace imagemanipulation\filter;

use imagemanipulation\ImageType;
use test\ImageFilterTestCase;

/**
 * @author elger
 */
class ImageFilterSobelVerticalTest extends ImageFilterTestCase
{
	public function testGif(){
		$original = $this->getOriginalImage(ImageType::GIF);
		$res = $this->applyFilter(new ImageFilterSobelVertical(), $original, __METHOD__);
		
		$this->assertColorQ1($res, 'ffffff');
		$this->assertColorQ2($res, 'ffffff');
		$this->assertColorQ3($res, 'ffffff');
		$this->assertColorQ4($res, 'ffffff');
	}
	public function testJpg(){
		$original = $this->getOriginalImage(ImageType::JPG);
		$res = $this->applyFilter(new ImageFilterSobelVertical(), $original, __METHOD__);

		$this->assertColorQ1($res, 'ffffff');
		$this->assertColorQ2($res, 'ffffff');
		$this->assertColorQ3($res, 'ffffff');
		$this->assertColorQ4($res, 'ffffff');
	}
	public function testPng(){
		$original = $this->getOriginalImage(ImageType::PNG);
		$res = $this->applyFilter(new ImageFilterSobelVertical(), $original, __METHOD__);
		
		$this->assertColorQ1($res, 'ffffff');
		$this->assertColorQ2($res, 'ffffff');
		$this->assertColorQ3($res, 'ffffff');
		$this->assertColorQ4($res, 'ffffff');
	}
}
