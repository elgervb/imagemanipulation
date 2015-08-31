<?php
namespace imagemanipulation\filter;

use imagemanipulation\Coordinate;
use imagemanipulation\color\ColorUtil;
use imagemanipulation\filter\ImageFilterSobelEdgeEnhance;
use imagemanipulation\ImageType;
use imagemanipulation\ImageUtil;

/**
 * @author elger
 */
class ImageFilterSobelEdgeDetectTest extends \ImageFilterTestCase
{
	public function testGif(){
		$original = $this->getOriginalImage(ImageType::GIF);
		$res = $this->applyFilter(new ImageFilterSobelEdgeDetect(), $original, __METHOD__);
		
		$this->assertColorQ1($res, 'ffffff');
		$this->assertColorQ2($res, '000000');
		$this->assertColorQ3($res, 'ffffff');
		$this->assertColorQ4($res, 'ffffff');
	}
	public function testJpg(){
		$original = $this->getOriginalImage(ImageType::JPG);
		$res = $this->applyFilter(new ImageFilterSobelEdgeDetect(), $original, __METHOD__);

		$this->assertColorQ1($res, 'ffffff');
		$this->assertColorQ2($res, '000000');
		$this->assertColorQ3($res, 'ffffff');
		$this->assertColorQ4($res, 'ffffff');
	}
	public function testPng(){
		$original = $this->getOriginalImage(ImageType::PNG);
		$res = $this->applyFilter(new ImageFilterSobelEdgeDetect(), $original, __METHOD__);
		
		$this->assertColorQ1($res, 'ffffff');
		$this->assertColorQ2($res, '000000');
		$this->assertColorQ3($res, 'ffffff');
		$this->assertColorQ4($res, 'ffffff');
	}
}
