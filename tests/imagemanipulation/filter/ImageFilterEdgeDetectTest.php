<?php
namespace imagemanipulation\filter;

use imagemanipulation\Coordinate;
use imagemanipulation\color\ColorUtil;
use imagemanipulation\filter\ImageFilterEdgeDetect;
use imagemanipulation\ImageType;
use imagemanipulation\ImageUtil;

/**
 * 
 * @author elger
 * TODO create testcase for color in the edges
 */
class ImageFilterEdgeDetectTest extends \ImageFilterTestCase
{
	public function testGif(){
		$original = $this->getOriginalImage(ImageType::GIF);
		$res = $this->applyFilter(new ImageFilterEdgeDetect(), $original, __METHOD__);
		
		$this->assertColorQ1($res, '7f7f7f');
		$this->assertColorQ2($res, '7f7f7f');
		$this->assertColorQ3($res, '7f7f7f');
		$this->assertColorQ4($res, '7f7f7f');
	}
	public function testJpg(){
		$original = $this->getOriginalImage(ImageType::JPG);
		$res = $this->applyFilter(new ImageFilterEdgeDetect(), $original, __METHOD__);

		$this->assertColorQ1($res, '7f7f7f');
		$this->assertColorQ2($res, '7f7f7f');
		$this->assertColorQ3($res, '7f7f7f');
		$this->assertColorQ4($res, '7f7f7f');
	}
	public function testPng(){
		$original = $this->getOriginalImage(ImageType::PNG);
		$res = $this->applyFilter(new ImageFilterEdgeDetect(), $original, __METHOD__);
		
		$this->assertColorQ1($res, '7f7f7f');
		$this->assertColorQ2($res, '7f7f7f');
		$this->assertColorQ3($res, '7f7f7f');
		$this->assertColorQ4($res, '7f7f7f');
	}
}
