<?php
namespace imagemanipulation\filter;

use imagemanipulation\ImageType;

class ImageFilterMotionBlurTest extends \ImageFilterTestCase
{
	public function testGif()
	{
		$original = $this->getOriginalImage( ImageType::GIF );
		$res = $this->applyFilter( new ImageFilterMotionBlur(), $original, __METHOD__ );
		
		$this->assertColorQ1( $res, 'ff0000' );
		$this->assertColorQ2( $res, '00ff00' );
		$this->assertColorQ3( $res, '0000ff' );
		$this->assertColorQ4( $res, 'ffffff' );
	}
	public function testJpg()
	{
		$original = $this->getOriginalImage( ImageType::JPG );
		$res = $this->applyFilter( new ImageFilterMotionBlur(), $original, __METHOD__ );
		
		$this->assertColorQ1( $res, 'fe0000' );
		$this->assertColorQ2( $res, '00ff01' );
		$this->assertColorQ3( $res, '0000fe' );
		$this->assertColorQ4( $res, 'ffffff' );
	}
	public function testPng()
	{
		$original = $this->getOriginalImage( ImageType::PNG );
		$res = $this->applyFilter( new ImageFilterMotionBlur(), $original, __METHOD__ );
		
		$this->assertColorQ1( $res, 'ff0000' );
		$this->assertColorQ2( $res, '00ff00' );
		$this->assertColorQ3( $res, '0000ff' );
		$this->assertColorQ4( $res, 'ffffff' );
	}
}
