<?php
namespace imagemanipulation\filter;

use imagemanipulation\ImageType;
use test\ImageFilterTestCase;

class ImageFilterNoiseTest extends ImageFilterTestCase
{
	public function testGif(){
		$original = $this->getOriginalImage(ImageType::GIF);
		$res = $this->applyFilter(new ImageFilterNoise(), $original, __METHOD__);
		
		// due to the random nature we cannot check coloring
		$this->assertEquals(600, $res->getX());
		$this->assertEquals(600, $res->getY());
	}
	public function testJpg(){
		$original = $this->getOriginalImage(ImageType::JPG);
		$res = $this->applyFilter(new ImageFilterNoise(), $original, __METHOD__);

		// due to the random nature we cannot check coloring
		$this->assertEquals(600, $res->getX());
		$this->assertEquals(600, $res->getY());
	}
	public function testPng(){
		$original = $this->getOriginalImage(ImageType::PNG);
		$res = $this->applyFilter(new ImageFilterNoise(), $original, __METHOD__);
		
		// due to the random nature we cannot check coloring
		$this->assertEquals(600, $res->getX());
		$this->assertEquals(600, $res->getY());
	}
}

