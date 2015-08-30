<?php
namespace imagemanipulation\filter;

use imagemanipulation\Coordinate;
use imagemanipulation\color\ColorUtil;
use imagemanipulation\filter\ImageFilterDarken;
use imagemanipulation\ImageType;
use imagemanipulation\ImageUtil;

class ImageFilterSepiaTest extends \ImageFilterTestCase
{
	public function testGifLight(){
		$original = $this->getOriginalImage(ImageType::GIF);
		$res = $this->applyFilter(new ImageFilterSepia(80), $original, __METHOD__);
		
		$this->assertColorQ1($res, '140800');
		$this->assertColorQ2($res, '745e38');
		$this->assertColorQ3($res, '000000');
		$this->assertColorQ4($res, 'ffe29e');
	}
	public function testJpgLight(){
		$original = $this->getOriginalImage(ImageType::JPG);
		$res = $this->applyFilter(new ImageFilterSepia(80), $original, __METHOD__);

		$this->assertColorQ1($res, '130800');
		$this->assertColorQ2($res, '745f38');
		$this->assertColorQ3($res, '000000');
		$this->assertColorQ4($res, 'ffe29e');
	}
	public function testPngLight(){
		$original = $this->getOriginalImage(ImageType::PNG);
		$res = $this->applyFilter(new ImageFilterSepia(80), $original, __METHOD__);
		
		$this->assertColorQ1($res, '140800');
		$this->assertColorQ2($res, '745e38');
		$this->assertColorQ3($res, '000000');
		$this->assertColorQ4($res, 'ffe29e');
	}
	
	public function testGifDefault(){
		$original = $this->getOriginalImage(ImageType::GIF);
		$res = $this->applyFilter(new ImageFilterSepia(), $original, __METHOD__);
	
		$this->assertColorQ1($res, '554936');
		$this->assertColorQ2($res, 'b59f79');
		$this->assertColorQ3($res, '211b12');
		$this->assertColorQ4($res, 'ffffdf');
	}
	public function testJpgDefault(){
		$original = $this->getOriginalImage(ImageType::JPG);
		$res = $this->applyFilter(new ImageFilterSepia(), $original, __METHOD__);
	
		$this->assertColorQ1($res, '544936');
		$this->assertColorQ2($res, 'b5a079'); 
		$this->assertColorQ3($res, '211b12');
		$this->assertColorQ4($res, 'ffffdf');
	}
	public function testPngDefault(){
		$original = $this->getOriginalImage(ImageType::PNG);
		$res = $this->applyFilter(new ImageFilterSepia(), $original, __METHOD__);
	
		$this->assertColorQ1($res, '554936');
		$this->assertColorQ2($res, 'b59f79');
		$this->assertColorQ3($res, '211b12');
		$this->assertColorQ4($res, 'ffffdf'); // 
	}
	
	public function testGifDark(){
		$original = $this->getOriginalImage(ImageType::GIF);
		$res = $this->applyFilter(new ImageFilterSepia(0), $original, __METHOD__);
		
		$this->assertColorQ1($res, '645845');
		$this->assertColorQ2($res, 'c4ae88');
		$this->assertColorQ3($res, '302a21');
		$this->assertColorQ4($res, 'ffffee');
	}
	public function testJpgDark(){
		$original = $this->getOriginalImage(ImageType::JPG);
		$res = $this->applyFilter(new ImageFilterSepia(0), $original, __METHOD__);
		
		$this->assertColorQ1($res, '635845');
		$this->assertColorQ2($res, 'c4af88');
		$this->assertColorQ3($res, '302a21');
		$this->assertColorQ4($res, 'ffffee');
	}
	public function testPngDark(){
		$original = $this->getOriginalImage(ImageType::PNG);
		$res = $this->applyFilter(new ImageFilterSepia(0), $original, __METHOD__);
		
		$this->assertColorQ1($res, '645845');
		$this->assertColorQ2($res, 'c4ae88');
		$this->assertColorQ3($res, '302a21');
		$this->assertColorQ4($res, 'ffffee');
	}
}
