<?php
namespace imagemanipulation\filter;

use imagemanipulation\Coordinate;
use imagemanipulation\color\ColorUtil;
use imagemanipulation\filter\ImageFilterDarken;
use imagemanipulation\ImageType;
use imagemanipulation\ImageUtil;

class ImageFilterSepiaFastTest extends \ImageFilterTestCase
{
	public function testGifLight(){
		$original = $this->getOriginalImage(ImageType::GIF);
		$res = $this->applyFilter(new ImageFilterSepiaFast(80), $original, __METHOD__);
		
		$this->assertColorQ1($res, '9c7146');
		$this->assertColorQ2($res, 'edc297');
		$this->assertColorQ3($res, '683d12');
		$this->assertColorQ4($res, 'ffffff');
	}
	public function testJpgLight(){
		$original = $this->getOriginalImage(ImageType::JPG);
		$res = $this->applyFilter(new ImageFilterSepiaFast(80), $original, __METHOD__);

		$this->assertColorQ1($res, '9b7045');
		$this->assertColorQ2($res, 'edc297');
		$this->assertColorQ3($res, '673c11');
		$this->assertColorQ4($res, 'ffffff');
	}
	public function testPngLight(){
		$original = $this->getOriginalImage(ImageType::PNG);
		$res = $this->applyFilter(new ImageFilterSepiaFast(80), $original, __METHOD__);
		
		$this->assertColorQ1($res, '9c7146');
		$this->assertColorQ2($res, 'edc297');
		$this->assertColorQ3($res, '683d12');
		$this->assertColorQ4($res, 'ffffff');
	}
	
	public function testGifDefault(){
		$original = $this->getOriginalImage(ImageType::GIF);
		$res = $this->applyFilter(new ImageFilterSepiaFast(), $original, __METHOD__);
	
		$this->assertColorQ1($res, '695746');
		$this->assertColorQ2($res, 'baa897');
		$this->assertColorQ3($res, '352312');
		$this->assertColorQ4($res, 'ffffff');
	}
	public function testJpgDefault(){
		$original = $this->getOriginalImage(ImageType::JPG);
		$res = $this->applyFilter(new ImageFilterSepiaFast(), $original, __METHOD__);
	
		$this->assertColorQ1($res, '685645');
		$this->assertColorQ2($res, 'baa897'); 
		$this->assertColorQ3($res, '342211');
		$this->assertColorQ4($res, 'ffffff');
	}
	public function testPngDefault(){
		$original = $this->getOriginalImage(ImageType::PNG);
		$res = $this->applyFilter(new ImageFilterSepiaFast(), $original, __METHOD__);
	
		$this->assertColorQ1($res, '695746');
		$this->assertColorQ2($res, 'baa897');
		$this->assertColorQ3($res, '352312');
		$this->assertColorQ4($res, 'ffffff'); // 
	}
	
	public function testGifDark(){
		$original = $this->getOriginalImage(ImageType::GIF);
		$res = $this->applyFilter(new ImageFilterSepiaFast(0), $original, __METHOD__);
		
		$this->assertColorQ1($res, '5d5146');
		$this->assertColorQ2($res, 'aea297');
		$this->assertColorQ3($res, '291d12');
		$this->assertColorQ4($res, 'ffffff');
	}
	public function testJpgDark(){
		$original = $this->getOriginalImage(ImageType::JPG);
		$res = $this->applyFilter(new ImageFilterSepiaFast(0), $original, __METHOD__);
		
		$this->assertColorQ1($res, '5c5045');
		$this->assertColorQ2($res, 'aea297');
		$this->assertColorQ3($res, '281c11');
		$this->assertColorQ4($res, 'ffffff');
	}
	public function testPngDark(){
		$original = $this->getOriginalImage(ImageType::PNG);
		$res = $this->applyFilter(new ImageFilterSepiaFast(0), $original, __METHOD__);
		
		$this->assertColorQ1($res, '5d5146');
		$this->assertColorQ2($res, 'aea297');
		$this->assertColorQ3($res, '291d12');
		$this->assertColorQ4($res, 'ffffff');
	}
}
