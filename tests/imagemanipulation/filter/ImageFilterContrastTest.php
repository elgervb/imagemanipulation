<?php
namespace imagemanipulation\filter;

use imagemanipulation\Coordinate;
use imagemanipulation\color\ColorUtil;
use imagemanipulation\ImageUtil;
use imagemanipulation\ImageType;
use imagemanipulation\filter\ImageFilterContrast;

class ImageFilterContrastTest extends \ImageFilterTestCase
{
	public function testGif()
	{
		$original = $this->getOriginalImage( ImageType::GIF );
		$res = $this->applyFilter( new ImageFilterContrast(), $original, __METHOD__ );
		
		$this->assertColorQ1( $res, 'ff0000' );
		$this->assertColorQ2( $res, '00ff00' );
		$this->assertColorQ3( $res, '0000ff' );
		$this->assertColorQ4( $res, 'ffffff' );
	}
	public function testJpg()
	{
		$original = $this->getOriginalImage( ImageType::JPG );
		$res = $this->applyFilter( new ImageFilterContrast(), $original, __METHOD__ );
		
		$this->assertColorQ1( $res, 'ff0000' );
		$this->assertColorQ2( $res, '00ff00' );
		$this->assertColorQ3( $res, '0000ff' );
		$this->assertColorQ4( $res, 'ffffff' );
	}
	public function testPng()
	{
		$original = $this->getOriginalImage( ImageType::PNG );
		$res = $this->applyFilter( new ImageFilterContrast(), $original, __METHOD__ );
		
		$this->assertColorQ1( $res, 'ff0000' );
		$this->assertColorQ2( $res, '00ff00' );
		$this->assertColorQ3( $res, '0000ff' );
		$this->assertColorQ4( $res, 'ffffff' );
	}
	
	public function testGifHig()
	{
		$original = $this->getOriginalImage( ImageType::GIF );
		$res = $this->applyFilter( new ImageFilterContrast(255), $original, __METHOD__ );
	
		$this->assertColorQ1( $res, 'ff0000' );
		$this->assertColorQ2( $res, '00ff00' );
		$this->assertColorQ3( $res, '0000ff' );
		$this->assertColorQ4( $res, 'ffffff' );
	}
	public function testJpgHigh()
	{
		$original = $this->getOriginalImage( ImageType::JPG );
		$res = $this->applyFilter( new ImageFilterContrast(255), $original, __METHOD__ );
	
		$this->assertColorQ1( $res, 'ff0000' );
		$this->assertColorQ2( $res, '00ff00' );
		$this->assertColorQ3( $res, '0000ff' );
		$this->assertColorQ4( $res, 'ffffff' );
	}
	public function testPngHigh()
	{
		$original = $this->getOriginalImage( ImageType::PNG );
		$res = $this->applyFilter( new ImageFilterContrast(255), $original, __METHOD__ );
	
		$this->assertColorQ1( $res, 'ff0000' );
		$this->assertColorQ2( $res, '00ff00' );
		$this->assertColorQ3( $res, '0000ff' );
		$this->assertColorQ4( $res, 'ffffff' );
	}
	
	public function testGifLow()
	{
		$original = $this->getOriginalImage( ImageType::GIF );
		$res = $this->applyFilter( new ImageFilterContrast(-255), $original, __METHOD__ );
	
		$this->assertColorQ1( $res, 'ff0000' );
		$this->assertColorQ2( $res, '00ff00' );
		$this->assertColorQ3( $res, '0000ff' );
		$this->assertColorQ4( $res, 'ffffff' );
	}
	public function testJpgLow()
	{
		$original = $this->getOriginalImage( ImageType::JPG );
		$res = $this->applyFilter( new ImageFilterContrast(-255), $original, __METHOD__ );
	
		$this->assertColorQ1( $res, 'ff0000' );
		$this->assertColorQ2( $res, '00ff00' );
		$this->assertColorQ3( $res, '0000ff' );
		$this->assertColorQ4( $res, 'ffffff' );
	}
	public function testPngLow()
	{
		$original = $this->getOriginalImage( ImageType::PNG );
		$res = $this->applyFilter( new ImageFilterContrast(-255), $original, __METHOD__ );
	
		$this->assertColorQ1( $res, 'ff0000' );
		$this->assertColorQ2( $res, '00ff00' );
		$this->assertColorQ3( $res, '0000ff' );
		$this->assertColorQ4( $res, 'ffffff' );
	}
}
