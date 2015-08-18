<?php
namespace imagemanipulation\filter;

use imagemanipulation\Coordinate;
use imagemanipulation\color\ColorUtil;
use imagemanipulation\filter\ImageFilterDarken;
use imagemanipulation\ImageType;
use imagemanipulation\ImageUtil;

class ImageFilterDarkenTest extends \ImageFilterTestCase
{
	public function testGifLight(){
		$original = $this->getOriginalImage(ImageType::GIF);
		$res = $this->applyFilter(new ImageFilterDarken(255), $original, __METHOD__);
		
		$this->assertColorQ1($res, self::BLACK);
		$this->assertColorQ2($res, self::BLACK);
		$this->assertColorQ3($res, self::BLACK);
		$this->assertColorQ4($res, self::BLACK);
	}
	public function testJpgLight(){
		$original = $this->getOriginalImage(ImageType::JPG);
		$res = $this->applyFilter(new ImageFilterDarken(255), $original, __METHOD__);

		$this->assertColorQ1($res, self::BLACK);
		$this->assertColorQ2($res, self::BLACK);
		$this->assertColorQ3($res, self::BLACK);
		$this->assertColorQ4($res, self::BLACK);
	}
	public function testPngLight(){
		$original = $this->getOriginalImage(ImageType::PNG);
		$res = $this->applyFilter(new ImageFilterDarken(255), $original, __METHOD__);
		
		$this->assertColorQ1($res, self::BLACK);
		$this->assertColorQ2($res, self::BLACK);
		$this->assertColorQ3($res, self::BLACK);
		$this->assertColorQ4($res, self::BLACK);
	}
	
	public function testGifMedium(){
		$original = $this->getOriginalImage(ImageType::GIF);
		$res = $this->applyFilter(new ImageFilterDarken(127), $original, __METHOD__);
	
		$this->assertColorQ1($res, '800000');
		$this->assertColorQ2($res, '008000');
		$this->assertColorQ3($res, '000080');
		$this->assertColorQ4($res, '808080');
	}
	public function testJpgMedium(){
		$original = $this->getOriginalImage(ImageType::JPG);
		$res = $this->applyFilter(new ImageFilterDarken(127), $original, __METHOD__);
	
		$this->assertColorQ1($res, '7f0000');
		$this->assertColorQ2($res, '008000'); // just slightly different as from GIF & PNG
		$this->assertColorQ3($res, '00007f');
		$this->assertColorQ4($res, '808080');
	}
	public function testPngMedium(){
		$original = $this->getOriginalImage(ImageType::PNG);
		$res = $this->applyFilter(new ImageFilterDarken(127), $original, __METHOD__);
	
		$this->assertColorQ1($res, '800000');
		$this->assertColorQ2($res, '008000');
		$this->assertColorQ3($res, '000080');
		$this->assertColorQ4($res, '808080'); // 
	}
	
	public function testGifDark(){
		$original = $this->getOriginalImage(ImageType::GIF);
		$res = $this->applyFilter(new ImageFilterDarken(-255), $original, __METHOD__);
		
		$this->assertColorQ1($res, self::WHITE);
		$this->assertColorQ2($res, self::WHITE);
		$this->assertColorQ3($res, self::WHITE);
		$this->assertColorQ4($res, self::WHITE);
	}
	public function testJpgDark(){
		$original = $this->getOriginalImage(ImageType::JPG);
		$res = $this->applyFilter(new ImageFilterDarken(-255), $original, __METHOD__);
		
		$this->assertColorQ1($res, self::WHITE);
		$this->assertColorQ2($res, self::WHITE);
		$this->assertColorQ3($res, self::WHITE);
		$this->assertColorQ4($res, self::WHITE);
	}
	public function testPngDark(){
		$original = $this->getOriginalImage(ImageType::PNG);
		$res = $this->applyFilter(new ImageFilterDarken(-255), $original, __METHOD__);
		
		$this->assertColorQ1($res, self::WHITE);
		$this->assertColorQ2($res, self::WHITE);
		$this->assertColorQ3($res, self::WHITE);
		$this->assertColorQ4($res, self::WHITE);
	}
}
