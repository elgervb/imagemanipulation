<?php
namespace imagemanipulation\filter;

use imagemanipulation\ImageType;
use imagemanipulation\color\Color;
use test\ImageFilterTestCase;

class ImageFilterRoundedCornersTest extends ImageFilterTestCase
{
	public function testGifDefault(){
		$original = $this->getOriginalImage(ImageType::GIF);
		$res = $this->applyFilter(new ImageFilterRoundedCorners(100), $original, __METHOD__);
		
		$this->assertColorQ1($res, 'ffffff');
		$this->assertColorQ2($res, 'ffffff');
		$this->assertColorQ3($res, 'ffffff');
		$this->assertColorQ4($res, 'ffffff');
	}
	public function testJpgDefault(){
		$original = $this->getOriginalImage(ImageType::JPG);
		$res = $this->applyFilter(new ImageFilterRoundedCorners(100), $original, __METHOD__);

		$this->assertColorQ1($res, 'ffffff');
		$this->assertColorQ2($res, 'ffffff');
		$this->assertColorQ3($res, 'ffffff');
		$this->assertColorQ4($res, 'ffffff');
	}
	public function testPngDefault(){
		$original = $this->getOriginalImage(ImageType::PNG);
		$res = $this->applyFilter(new ImageFilterRoundedCorners(100), $original, __METHOD__);
		
		$this->assertColorQ1($res, 'ffffff');
		$this->assertColorQ2($res, 'ffffff');
		$this->assertColorQ3($res, 'ffffff');
		$this->assertColorQ4($res, 'ffffff');
	}
	
	
	public function testGifDarkCorner(){
		$original = $this->getOriginalImage(ImageType::GIF);
		$res = $this->applyFilter(new ImageFilterRoundedCorners(100, new Color('ff00ff')), $original, __METHOD__);
	
		$this->assertColorQ1($res, 'ff00ff');
		$this->assertColorQ2($res, 'ff00ff');
		$this->assertColorQ3($res, 'ff00ff');
		$this->assertColorQ4($res, 'ff00ff');
	}
	public function testJpgDarkCorner(){
		$original = $this->getOriginalImage(ImageType::JPG);
		$res = $this->applyFilter(new ImageFilterRoundedCorners(100, new Color('ff00ff')), $original, __METHOD__);
	
		$this->assertColorQ1($res, 'ff00ff');
		$this->assertColorQ2($res, 'ff00ff');
		$this->assertColorQ3($res, 'ff00ff');
		$this->assertColorQ4($res, 'ff00ff');
	}
	public function testPngDarkCorner(){
		$original = $this->getOriginalImage(ImageType::PNG);
		$res = $this->applyFilter(new ImageFilterRoundedCorners(100, new Color('ff00ff')), $original, __METHOD__);
	
		$this->assertColorQ1($res, 'ff00ff');
		$this->assertColorQ2($res, 'ff00ff');
		$this->assertColorQ3($res, 'ff00ff');
		$this->assertColorQ4($res, 'ff00ff');
	}
}
