<?php
namespace imagemanipulation\filter;

use imagemanipulation\Coordinate;

use imagemanipulation\color\ColorUtil;

use imagemanipulation\ImageUtil;

use imagemanipulation\ImageType;

use imagemanipulation\filter\ImageFilterBrightness;

class ImageFilterBrightnessTest extends \ImageFilterTestCase
{
	public function testGifLight(){
		$original = $this->getOriginalImage(ImageType::GIF);
		$res = $this->applyFilter(new ImageFilterBrightness(255), $original, __METHOD__);
		
		$this->assertColorQ1($res, self::WHITE);
		$this->assertColorQ2($res, self::WHITE);
		$this->assertColorQ3($res, self::WHITE);
		$this->assertColorQ4($res, self::WHITE);
	}
	public function testJpgLight(){
		$original = $this->getOriginalImage(ImageType::JPG);
		$res = $this->applyFilter(new ImageFilterBrightness(255), $original, __METHOD__);

		$this->assertColorQ1($res, self::WHITE);
		$this->assertColorQ2($res, self::WHITE);
		$this->assertColorQ3($res, self::WHITE);
		$this->assertColorQ4($res, self::WHITE);
	}
	public function testPngLight(){
		$original = $this->getOriginalImage(ImageType::PNG);
		$res = $this->applyFilter(new ImageFilterBrightness(255), $original, __METHOD__);
		
		$this->assertColorQ1($res, self::WHITE);
		$this->assertColorQ2($res, self::WHITE);
		$this->assertColorQ3($res, self::WHITE);
		$this->assertColorQ4($res, self::WHITE);
	}
	
	public function testGifMedium(){
		$original = $this->getOriginalImage(ImageType::GIF);
		$res = $this->applyFilter(new ImageFilterBrightness(127), $original, __METHOD__);
	
		$this->assertColorQ1($res, 'ff7f7f');
		$this->assertColorQ2($res, '7fff7f');
		$this->assertColorQ3($res, '7f7fff');
		$this->assertColorQ4($res, self::WHITE);
	}
	public function testJpgMedium(){
		$original = $this->getOriginalImage(ImageType::JPG);
		$res = $this->applyFilter(new ImageFilterBrightness(127), $original, __METHOD__);
	
		$this->assertColorQ1($res, 'ff7f7f');
		$this->assertColorQ2($res, '7fff80'); // just slightly different as from GIF & PNG
		$this->assertColorQ3($res, '7f7fff');
		$this->assertColorQ4($res, self::WHITE);
	}
	public function testPngMedium(){
		$original = $this->getOriginalImage(ImageType::PNG);
		$res = $this->applyFilter(new ImageFilterBrightness(127), $original, __METHOD__);
	
		$this->assertColorQ1($res, 'ff7f7f');
		$this->assertColorQ2($res, '7fff7f');
		$this->assertColorQ3($res, '7f7fff');
		$this->assertColorQ4($res, self::WHITE); // 
	}
	
	public function testGifDark(){
		$original = $this->getOriginalImage(ImageType::GIF);
		$res = $this->applyFilter(new ImageFilterBrightness(-255), $original, __METHOD__);
		
		$this->assertColorQ1($res, self::BLACK);
		$this->assertColorQ2($res, self::BLACK);
		$this->assertColorQ3($res, self::BLACK);
		$this->assertColorQ4($res, self::BLACK);
	}
	public function testJpgDark(){
		$original = $this->getOriginalImage(ImageType::JPG);
		$res = $this->applyFilter(new ImageFilterBrightness(-255), $original, __METHOD__);
		
		$this->assertColorQ1($res, self::BLACK);
		$this->assertColorQ2($res, self::BLACK);
		$this->assertColorQ3($res, self::BLACK);
		$this->assertColorQ4($res, self::BLACK);
	}
	public function testPngDark(){
		$original = $this->getOriginalImage(ImageType::PNG);
		$res = $this->applyFilter(new ImageFilterBrightness(-255), $original, __METHOD__);
		
		$this->assertColorQ1($res, self::BLACK);
		$this->assertColorQ2($res, self::BLACK);
		$this->assertColorQ3($res, self::BLACK);
		$this->assertColorQ4($res, self::BLACK);
	}
}
