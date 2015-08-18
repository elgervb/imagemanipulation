<?php
namespace imagemanipulation\filter;

use imagemanipulation\Coordinate;
use imagemanipulation\color\ColorUtil;
use imagemanipulation\filter\ImageFilterFlip;
use imagemanipulation\ImageType;
use imagemanipulation\ImageUtil;

/**
 * @author elger
 * TODO create testcase for color in the edges
 */
class ImageFilterFlipTest extends \ImageFilterTestCase
{
	public function testGifHorizontal(){
		$original = $this->getOriginalImage(ImageType::GIF);
		$res = $this->applyFilter(new ImageFilterFlip(true, false), $original, __METHOD__);
		
		$this->assertColorQ1($res, '00ff00');
		$this->assertColorQ2($res, 'ff0000');
		$this->assertColorQ3($res, 'ffffff');
		$this->assertColorQ4($res, '0000ff');
	}
	public function testJpgHorizontal(){
		$original = $this->getOriginalImage(ImageType::JPG);
		$res = $this->applyFilter(new ImageFilterFlip(true, false), $original, __METHOD__);

		$this->assertColorQ1($res, '00ff01');
		$this->assertColorQ2($res, 'fe0000');
		$this->assertColorQ3($res, 'ffffff');
		$this->assertColorQ4($res, '0000fe');
	}
	public function testPngHorizontal(){
		$original = $this->getOriginalImage(ImageType::PNG);
		$res = $this->applyFilter(new ImageFilterFlip(true, false), $original, __METHOD__);
		
		$this->assertColorQ1($res, '00ff00');
		$this->assertColorQ2($res, 'ff0000');
		$this->assertColorQ3($res, 'ffffff');
		$this->assertColorQ4($res, '0000ff');
	}
	
	public function testGifVertical(){
		$original = $this->getOriginalImage(ImageType::GIF);
		$res = $this->applyFilter(new ImageFilterFlip(false,true), $original, __METHOD__);
	
		$this->assertColorQ1($res, '0000ff');
		$this->assertColorQ2($res, 'ffffff');
		$this->assertColorQ3($res, 'ff0000');
		$this->assertColorQ4($res, '00ff00');
	}
	public function testJpgVertical(){
		$original = $this->getOriginalImage(ImageType::JPG);
		$res = $this->applyFilter(new ImageFilterFlip(false,true), $original, __METHOD__);
	
		$this->assertColorQ1($res, '0000fe');
		$this->assertColorQ2($res, 'ffffff');
		$this->assertColorQ3($res, 'fe0000');
		$this->assertColorQ4($res, '00ff01');
	}
	public function testPngVertical(){
		$original = $this->getOriginalImage(ImageType::PNG);
		$res = $this->applyFilter(new ImageFilterFlip(false,true), $original, __METHOD__);
	
		$this->assertColorQ1($res, '0000ff');
		$this->assertColorQ2($res, 'ffffff');
		$this->assertColorQ3($res, 'ff0000');
		$this->assertColorQ4($res, '00ff00');
	}
	
	public function testGifBoth(){
		$original = $this->getOriginalImage(ImageType::GIF);
		$res = $this->applyFilter(new ImageFilterFlip(true, true), $original, __METHOD__);
	
		$this->assertColorQ1($res, 'ffffff');
		$this->assertColorQ2($res, '0000ff');
		$this->assertColorQ3($res, '00ff00');
		$this->assertColorQ4($res, 'ff0000');
	}
	public function testJpgBoth(){
		$original = $this->getOriginalImage(ImageType::JPG);
		$res = $this->applyFilter(new ImageFilterFlip(true, true), $original, __METHOD__);
	
		$this->assertColorQ1($res, 'ffffff');
		$this->assertColorQ2($res, '0000fe');
		$this->assertColorQ3($res, '00ff01');
		$this->assertColorQ4($res, 'fe0000');
	}
	public function testPngBoth(){
		$original = $this->getOriginalImage(ImageType::PNG);
		$res = $this->applyFilter(new ImageFilterFlip(true, true), $original, __METHOD__);
	
		$this->assertColorQ1($res, 'ffffff');
		$this->assertColorQ2($res, '0000ff');
		$this->assertColorQ3($res, '00ff00');
		$this->assertColorQ4($res, 'ff0000');
	}
}
