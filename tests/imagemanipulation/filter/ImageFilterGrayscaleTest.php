<?php
namespace imagemanipulation\filter;

use imagemanipulation\Coordinate;
use imagemanipulation\color\ColorUtil;
use imagemanipulation\ImageUtil;
use imagemanipulation\ImageType;
use imagemanipulation\filter\ImageFilterGrayScale;

class ImageFilterGrayscaleTest extends \ImageFilterTestCase
{
	public function testGif()
	{
		$original = $this->getOriginalImage( ImageType::GIF );
		$res = $this->applyFilter( new ImageFilterGrayScale(), $original, __METHOD__ );
		
		$this->assertColorQ1( $res, '4c4c4c' );
		$this->assertColorQ2( $res, '959595' );
		$this->assertColorQ3( $res, '1d1d1d' );
		$this->assertColorQ4( $res, 'ffffff' );
	}
	public function testJpg()
	{
		$original = $this->getOriginalImage( ImageType::JPG );
		$res = $this->applyFilter( new ImageFilterGrayScale(), $original, __METHOD__ );
		
		$this->assertColorQ1( $res, '4b4b4b' );
		$this->assertColorQ2( $res, '959595' );
		$this->assertColorQ3( $res, '1c1c1c' );
		$this->assertColorQ4( $res, 'ffffff' );
	}
	public function testPng()
	{
		$original = $this->getOriginalImage( ImageType::PNG );
		$res = $this->applyFilter( new ImageFilterGrayScale(), $original, __METHOD__ );
		
		$this->assertColorQ1( $res, '4c4c4c' );
		$this->assertColorQ2( $res, '959595' );
		$this->assertColorQ3( $res, '1d1d1d' );
		$this->assertColorQ4( $res, 'ffffff' );
	}
}
