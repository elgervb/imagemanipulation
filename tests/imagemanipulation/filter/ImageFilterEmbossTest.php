<?php
namespace imagemanipulation\filter;

use imagemanipulation\filter\ImageFilterEmboss;
use imagemanipulation\ImageType;
use test\ImageFilterTestCase;

/**
 * @author elger
 * TODO create testcase for color in the edges
 */
class ImageFilterEmbossTest extends ImageFilterTestCase
{
	public function testGif(){
		$original = $this->getOriginalImage(ImageType::GIF);
		$res = $this->applyFilter(new ImageFilterEmboss(), $original, __METHOD__);
		
		$this->assertColorQ1($res, '7f7f7f');
		$this->assertColorQ2($res, '7f7f7f');
		$this->assertColorQ3($res, '7f7f7f');
		$this->assertColorQ4($res, '7f7f7f');
	}
	public function testJpg(){
		$original = $this->getOriginalImage(ImageType::JPG);
		$res = $this->applyFilter(new ImageFilterEmboss(), $original, __METHOD__);

		$this->assertColorQ1($res, '7f7f7f');
		$this->assertColorQ2($res, '7f7f7f');
		$this->assertColorQ3($res, '7f7f7f');
		$this->assertColorQ4($res, '7f7f7f');
	}
	public function testPng(){
		$original = $this->getOriginalImage(ImageType::PNG);
		$res = $this->applyFilter(new ImageFilterEmboss(), $original, __METHOD__);
		
		$this->assertColorQ1($res, '7f7f7f');
		$this->assertColorQ2($res, '7f7f7f');
		$this->assertColorQ3($res, '7f7f7f');
		$this->assertColorQ4($res, '7f7f7f');
	}
}
