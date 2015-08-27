<?php
namespace imagemanipulation\filter;

use imagemanipulation\color\ColorFactory;

use imagemanipulation\Coordinate;
use imagemanipulation\color\ColorUtil;
use imagemanipulation\ImageUtil;
use imagemanipulation\ImageType;
use imagemanipulation\filter\ImageFilterColorize;

class ImageFilterComicTest extends \ImageFilterTestCase
{
	public function testGif50Opacity(){
		$original = $this->getOriginalImage(ImageType::GIF);
		$res = $this->applyFilter(new ImageFilterComic( 50 ), $original, __METHOD__);
		
		$this->assertColorQ1($res, '7f0000');
		$this->assertColorQ2($res, '007f00');
		$this->assertColorQ3($res, '00007f');
		$this->assertColorQ4($res, self::WHITE);
	}
	public function testJpg50Opacity(){
		$original = $this->getOriginalImage(ImageType::JPG);
		$res = $this->applyFilter(new ImageFilterComic( 50 ), $original, __METHOD__);

		$this->assertColorQ1($res, '7f0000'); 
		$this->assertColorQ2($res, '007f00');
		$this->assertColorQ3($res, '00007f');
		$this->assertColorQ4($res, self::WHITE);
	}
	public function testPng50Opacity(){
		$original = $this->getOriginalImage(ImageType::PNG);
		$res = $this->applyFilter(new ImageFilterComic( 50 ), $original, __METHOD__);
		
		$this->assertColorQ1($res, '7f0000');
		$this->assertColorQ2($res, '007f00');
		$this->assertColorQ3($res, '00007f');
		$this->assertColorQ4($res, self::WHITE);
	}
}