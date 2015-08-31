<?php
namespace imagemanipulation\filter;

use imagemanipulation\color\ColorFactory;

use imagemanipulation\Coordinate;
use imagemanipulation\color\ColorUtil;
use imagemanipulation\ImageUtil;
use imagemanipulation\ImageType;
use imagemanipulation\filter\ImageFilterColorize;
use imagemanipulation\ImageBuilder;

class ImageFilterDuotoneTest extends \ImageFilterTestCase
{
	public function testGifRed(){
		$original = $this->getOriginalImage(ImageType::GIF);
		$res = $this->applyFilter(new ImageFilterDuotone(255,0,0), $original, __METHOD__);
		
		$this->assertColorQ1($res, 'ff0000');
		$this->assertColorQ2($res, 'ffff00');
		$this->assertColorQ3($res, 'ff00ff');
		$this->assertColorQ4($res, 'ffffff');
	}
	public function testJpgRed(){
		$original = $this->getOriginalImage(ImageType::JPG);
		$res = $this->applyFilter(new ImageFilterDuotone(255,0,0), $original, __METHOD__);

		$this->assertColorQ1($res, 'ff0000'); 
		$this->assertColorQ2($res, 'ffff01');
		$this->assertColorQ3($res, 'ff00fe');
		$this->assertColorQ4($res, 'ffffff');
	}
	public function testPngRed(){
		$original = $this->getOriginalImage(ImageType::PNG);
		$res = $this->applyFilter(new ImageFilterDuotone(255,0,0), $original, __METHOD__);
		
		$this->assertColorQ1($res, 'ff0000');
		$this->assertColorQ2($res, 'ffff00');
		$this->assertColorQ3($res, 'ff00ff');
		$this->assertColorQ4($res, 'ffffff');
	}
	
	public function testGifRedImageBuilder(){
	    $original = $this->getOriginalImage(ImageType::GIF);
	    $res = ImageBuilder::create($original)->duotone(255,0,0)->toResource();
	
	    $this->assertColorQ1($res, 'ff0000');
	    $this->assertColorQ2($res, 'ffff00');
	    $this->assertColorQ3($res, 'ff00ff');
	    $this->assertColorQ4($res, 'ffffff');
	}
}