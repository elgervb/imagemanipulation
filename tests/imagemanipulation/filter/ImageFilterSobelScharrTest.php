<?php
namespace imagemanipulation\filter;

use imagemanipulation\ImageType;
use test\ImageFilterTestCase;

/**
 * @author elger
 */
class ImageFilterSobelScharrTest extends ImageFilterTestCase
{
	public function testGif(){
		$original = $this->getOriginalImage(ImageType::GIF);
		$res = $this->applyFilter(new ImageFilterSobelScharr(), $original, __METHOD__);
		
		$this->assertColorQ1($res, '000000');
		$this->assertColorQ2($res, '000000');
		$this->assertColorQ3($res, 'ffffff');
		$this->assertColorQ4($res, '000000');
	}
	public function testJpg(){
		$original = $this->getOriginalImage(ImageType::JPG);
		$res = $this->applyFilter(new ImageFilterSobelScharr(), $original, __METHOD__);

		$this->assertColorQ1($res, '000000');
		$this->assertColorQ2($res, '000000');
		$this->assertColorQ3($res, 'ffffff');
		$this->assertColorQ4($res, '000000');
	}
	public function testPng(){
		$original = $this->getOriginalImage(ImageType::PNG);
		$res = $this->applyFilter(new ImageFilterSobelScharr(), $original, __METHOD__);
		
		$this->assertColorQ1($res, '000000');
		$this->assertColorQ2($res, '000000');
		$this->assertColorQ3($res, 'ffffff');
		$this->assertColorQ4($res, '000000');
	}
}
