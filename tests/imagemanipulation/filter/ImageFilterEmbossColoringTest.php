<?php
namespace imagemanipulation\filter;

use imagemanipulation\filter\ImageFilterEmbossColoring;
use imagemanipulation\ImageType;
use test\ImageFilterTestCase;

/**
 * Testcases for ImageFilterEmbossColoring
 */
class ImageFilterEmbossColoringTest extends ImageFilterTestCase
{
	public function testGif(){
		$original = $this->getOriginalImage(ImageType::GIF);
		$res = $this->applyFilter(new ImageFilterEmbossColoring(), $original, __METHOD__);
		
		$this->assertColorQ1($res, self::RED);
		$this->assertColorQ2($res, self::GREEN);
		$this->assertColorQ3($res, self::BLUE);
		$this->assertColorQ4($res, self::WHITE);
	}
	public function testJpg(){
		$original = $this->getOriginalImage(ImageType::JPG);
		$res = $this->applyFilter(new ImageFilterEmbossColoring(), $original, __METHOD__);

		$this->assertColorQ1($res, 'fe0000');
		$this->assertColorQ2($res, '00ff01');
		$this->assertColorQ3($res, '0000fe');
		$this->assertColorQ4($res, self::WHITE);
	}
	public function testPng(){
		$original = $this->getOriginalImage(ImageType::PNG);
		$res = $this->applyFilter(new ImageFilterEmbossColoring(), $original, __METHOD__);
		
		$this->assertColorQ1($res, self::RED);
		$this->assertColorQ2($res, self::GREEN);
		$this->assertColorQ3($res, self::BLUE);
		$this->assertColorQ4($res, self::WHITE);
	}
}
