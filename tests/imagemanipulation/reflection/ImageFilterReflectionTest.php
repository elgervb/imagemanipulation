<?php
namespace imagemanipulation\reflection;

use imagemanipulation\ImageType;
use test\ImageFilterTestCase;

class ImageFilterReflectionTest extends ImageFilterTestCase
{
	public function testGif(){
		$original = $this->getOriginalImage(ImageType::GIF);
		$res = $this->applyFilter(new ImageFilterReflection(200), $original, __METHOD__);
		
		$this->assertEquals(800, $res->getHeight(), 'Checking height');
		$this->assertEquals(600, $res->getWidth(), 'Checking widht');
		
		$this->assertColorQ1($res, self::RED);
		$this->assertColorQ2($res, self::GREEN);
		$this->assertColorQ3($res, self::WHITE);
		$this->assertColorQ4($res, self::WHITE);
	}
	
	public function testJpg(){
		$original = $this->getOriginalImage(ImageType::JPG);
		$res = $this->applyFilter(new ImageFilterReflection(200), $original, __METHOD__);
	   
		$this->assertEquals(800, $res->getHeight(), 'Checking height');
		$this->assertEquals(600, $res->getWidth(), 'Checking widht');
		
		$this->assertColorQ1($res, 'fe0000');
		$this->assertColorQ2($res, '00ff01');
		$this->assertColorQ3($res, self::WHITE);
		$this->assertColorQ4($res, self::WHITE);
	}
	public function testPng(){
		$original = $this->getOriginalImage(ImageType::PNG);
		$res = $this->applyFilter(new ImageFilterReflection(200), $original, __METHOD__);
	
		$this->assertEquals(800, $res->getHeight(), 'Checking height');
		$this->assertEquals(600, $res->getWidth(), 'Checking widht');
		
		$this->assertColorQ1($res, self::RED);
		$this->assertColorQ2($res, self::GREEN);
		$this->assertColorQ3($res, self::WHITE);
		$this->assertColorQ4($res, self::WHITE);
	}
}
