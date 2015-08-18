<?php
namespace imagemanipulation\filter;

use imagemanipulation\Coordinate;
use imagemanipulation\color\ColorUtil;
use imagemanipulation\filter\ImageFilterDodge;
use imagemanipulation\ImageType;
use imagemanipulation\ImageUtil;

class ImageFilterDodgeTest extends \ImageFilterTestCase
{
	public function testGifLight(){
		$original = $this->getOriginalImage(ImageType::GIF);
		$res = $this->applyFilter(new ImageFilterDodge(0), $original, __METHOD__);
		
		$this->assertColorQ1($res, 'ff0000');
		$this->assertColorQ2($res, '00ff00');
		$this->assertColorQ3($res, '0000ff');
		$this->assertColorQ4($res, 'ffffff');
	}
	public function testJpgLight(){
		$original = $this->getOriginalImage(ImageType::JPG);
		$res = $this->applyFilter(new ImageFilterDodge(0), $original, __METHOD__);

		$this->assertColorQ1($res, 'fe0000');
		$this->assertColorQ2($res, '00ff01');
		$this->assertColorQ3($res, '0000fe');
		$this->assertColorQ4($res, 'ffffff');
	}
	public function testPngLight(){
		$original = $this->getOriginalImage(ImageType::PNG);
		$res = $this->applyFilter(new ImageFilterDodge(0), $original, __METHOD__);
		
		$this->assertColorQ1($res, 'ff0000');
		$this->assertColorQ2($res, '00ff00');
		$this->assertColorQ3($res, '0000ff');
		$this->assertColorQ4($res, 'ffffff');
	}
	
// TODO disabled for now, as these take too much time
// 	public function testGifMedium(){
// 		$original = $this->getOriginalImage(ImageType::GIF);
// 		$res = $this->applyFilter(new ImageFilterDodge(50), $original, __METHOD__);
	
// 		$this->assertColorQ1($res, '7f0000');
// 		$this->assertColorQ2($res, '007f00');
// 		$this->assertColorQ3($res, '00007f');
// 		$this->assertColorQ4($res, '7f7f7f');
// 	}
// 	public function testJpgMedium(){
// 		$original = $this->getOriginalImage(ImageType::JPG);
// 		$res = $this->applyFilter(new ImageFilterDodge(50), $original, __METHOD__);
	
// 		$this->assertColorQ1($res, '7f0000');
// 		$this->assertColorQ2($res, '007f00'); // just slightly different as from GIF & PNG
// 		$this->assertColorQ3($res, '00007f');
// 		$this->assertColorQ4($res, '7f7f7f');
// 	}
// 	public function testPngMedium(){
// 		$original = $this->getOriginalImage(ImageType::PNG);
// 		$res = $this->applyFilter(new ImageFilterDodge(50), $original, __METHOD__);
	
// 		$this->assertColorQ1($res, '7f0000');
// 		$this->assertColorQ2($res, '007f00');
// 		$this->assertColorQ3($res, '00007f');
// 		$this->assertColorQ4($res, '7f7f7f'); // 
// 	}
	
// 	public function testGifDark(){
// 		$original = $this->getOriginalImage(ImageType::GIF);
// 		$res = $this->applyFilter(new ImageFilterDodge(99), $original, __METHOD__);
		
// 		$this->assertColorQ1($res, 'fc0000');
// 		$this->assertColorQ2($res, '00fc00');
// 		$this->assertColorQ3($res, '0000fc');
// 		$this->assertColorQ4($res, 'fcfcfc');
// 	}
// 	public function testJpgDark(){
// 		$original = $this->getOriginalImage(ImageType::JPG);
// 		$res = $this->applyFilter(new ImageFilterDodge(99), $original, __METHOD__);
		
// 		$this->assertColorQ1($res, 'fb0000');
// 		$this->assertColorQ2($res, '00fc00');
// 		$this->assertColorQ3($res, '0000fb');
// 		$this->assertColorQ4($res, 'fcfcfc');
// 	}
// 	public function testPngDark(){
// 		$original = $this->getOriginalImage(ImageType::PNG);
// 		$res = $this->applyFilter(new ImageFilterDodge(99), $original, __METHOD__);
		
// 		$this->assertColorQ1($res, 'fc0000');
// 		$this->assertColorQ2($res, '00fc00');
// 		$this->assertColorQ3($res, '0000fc');
// 		$this->assertColorQ4($res, 'fcfcfc');
// 	}
}
