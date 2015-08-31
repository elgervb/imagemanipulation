<?php
namespace imagemanipulation\filter;

use imagemanipulation\Coordinate;
use imagemanipulation\color\ColorUtil;
use imagemanipulation\filter\ImageFilterSobelEdgeEnhance;
use imagemanipulation\ImageType;
use imagemanipulation\ImageUtil;

/**
 * @author elger
 */
class ImageFilterSobelEdgeEnhanceTest extends \ImageFilterTestCase
{
	public function testGif(){
		$original = $this->getOriginalImage(ImageType::GIF);
		$res = $this->applyFilter(new ImageFilterSobelEdgeEnhance(), $original, __METHOD__);
		
		$this->assertColorQ1($res, self::BLACK);
		$this->assertColorQ2($res, self::BLACK);
		$this->assertColorQ3($res, self::BLACK);
		$this->assertColorQ4($res, self::BLACK);
	}
	public function testJpg(){
		$original = $this->getOriginalImage(ImageType::JPG);
		$res = $this->applyFilter(new ImageFilterSobelEdgeEnhance(), $original, __METHOD__);

		$this->assertColorQ1($res, self::BLACK);
		$this->assertColorQ2($res, self::BLACK);
		$this->assertColorQ3($res, self::BLACK);
		$this->assertColorQ4($res, self::BLACK);
	}
	public function testPng(){
		$original = $this->getOriginalImage(ImageType::PNG);
		$res = $this->applyFilter(new ImageFilterSobelEdgeEnhance(), $original, __METHOD__);
		
		$this->assertColorQ1($res, self::BLACK);
		$this->assertColorQ2($res, self::BLACK);
		$this->assertColorQ3($res, self::BLACK);
		$this->assertColorQ4($res, self::BLACK);
	}
}
