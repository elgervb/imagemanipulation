<?php
namespace imagemanipulation\filter;

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
	
	public function testGifHigh()
	{
		$original = $this->getOriginalImage( ImageType::GIF );
		$res = $this->applyFilter( new ImageFilterContrast(100), $original, __METHOD__ );
	
		$this->assertColorQ1( $res, 'ff0000' );
		$this->assertColorQ2( $res, '00ff00' );
		$this->assertColorQ3( $res, '0000ff' );
		$this->assertColorQ4( $res, 'ffffff' );
	}
	public function testJpgHigh()
	{
		$original = $this->getOriginalImage( ImageType::JPG );
		$res = $this->applyFilter( new ImageFilterContrast(100), $original, __METHOD__ );
	
		$this->assertColorQ1( $res, 'ff0000' );
		$this->assertColorQ2( $res, '00ff00' );
		$this->assertColorQ3( $res, '0000ff' );
		$this->assertColorQ4( $res, 'ffffff' );
	}
	public function testPngHigh()
	{
		$original = $this->getOriginalImage( ImageType::PNG );
		$res = $this->applyFilter( new ImageFilterContrast(100), $original, __METHOD__ );
	
		$this->assertColorQ1( $res, 'ff0000' );
		$this->assertColorQ2( $res, '00ff00' );
		$this->assertColorQ3( $res, '0000ff' );
		$this->assertColorQ4( $res, 'ffffff' );
	}
	
	public function testGifLow()
	{
		$original = $this->getOriginalImage( ImageType::GIF );
		$res = $this->applyFilter( new ImageFilterContrast(-100), $original, __METHOD__ );
	
		$this->assertColorQ1( $res, '7f7f7f' );
		$this->assertColorQ2( $res, '7f7f7f' );
		$this->assertColorQ3( $res, '7f7f7f' );
		$this->assertColorQ4( $res, '7f7f7f' );
	}
	public function testJpgLow()
	{
		$original = $this->getOriginalImage( ImageType::JPG );
		$res = $this->applyFilter( new ImageFilterContrast(-100), $original, __METHOD__ );
	
		$this->assertColorQ1( $res, '7f7f7f' );
		$this->assertColorQ2( $res, '7f7f7f' );
		$this->assertColorQ3( $res, '7f7f7f' );
		$this->assertColorQ4( $res, '7f7f7f' );
	}
	public function testPngLow()
	{
		$original = $this->getOriginalImage( ImageType::PNG );
		$res = $this->applyFilter( new ImageFilterContrast(-100), $original, __METHOD__ );
	
		$this->assertColorQ1( $res, '7f7f7f' );
		$this->assertColorQ2( $res, '7f7f7f' );
		$this->assertColorQ3( $res, '7f7f7f' );
		$this->assertColorQ4( $res, '7f7f7f' );
	}
}
