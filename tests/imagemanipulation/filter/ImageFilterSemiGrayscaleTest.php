<?php
namespace tests\imagemanipulation\filter;

use imagemanipulation\ImageType;
use imagemanipulation\filter\ImageFilterSemiGrayScale;

class ImageFilterSemiGrayscaleTest extends \ImageFilterTestCase
{
	public function testGif()
	{
		$original = $this->getOriginalImage( ImageType::GIF );
		$res = $this->applyFilter( new ImageFilterSemiGrayScale(100), $original, __METHOD__ );
		
		$this->assertColorQ1( $res, '4c4c4c' );
		$this->assertColorQ2( $res, '959595' );
		$this->assertColorQ3( $res, '1d1d1d' );
		$this->assertColorQ4( $res, 'ffffff' );
	}
	public function testJpg()
	{
		$original = $this->getOriginalImage( ImageType::JPG );
		$res = $this->applyFilter( new ImageFilterSemiGrayScale(100), $original, __METHOD__ );
		
		$this->assertColorQ1( $res, '4b4b4b' );
		$this->assertColorQ2( $res, '959595' );
		$this->assertColorQ3( $res, '1c1c1c' );
		$this->assertColorQ4( $res, 'ffffff' );
	}
	public function testPng()
	{
		$original = $this->getOriginalImage( ImageType::PNG );
		$res = $this->applyFilter( new ImageFilterSemiGrayScale(100), $original, __METHOD__ );
		
		$this->assertColorQ1( $res, '4c4c4c' );
		$this->assertColorQ2( $res, '959595' );
		$this->assertColorQ3( $res, '1d1d1d' );
		$this->assertColorQ4( $res, 'ffffff' );
	}
	
	public function testGif50()
	{
	    $original = $this->getOriginalImage( ImageType::GIF );
	    $res = $this->applyFilter( new ImageFilterSemiGrayScale(50), $original, __METHOD__ );
	
	    $this->assertColorQ1( $res, 'a52626' );
	    $this->assertColorQ2( $res, '4aca4a' );
	    $this->assertColorQ3( $res, '0e0e8e' );
	    $this->assertColorQ4( $res, 'ffffff' );
	}
	public function testJpg50()
	{
	    $original = $this->getOriginalImage( ImageType::JPG );
	    $res = $this->applyFilter( new ImageFilterSemiGrayScale(50), $original, __METHOD__ );
	
	    $this->assertColorQ1( $res, 'a42525' );
	    $this->assertColorQ2( $res, '4aca4b' );
	    $this->assertColorQ3( $res, '0e0e8d' );
	    $this->assertColorQ4( $res, 'ffffff' );
	}
	public function testPng50()
	{
	    $original = $this->getOriginalImage( ImageType::PNG );
	    $res = $this->applyFilter( new ImageFilterSemiGrayScale(50), $original, __METHOD__ );
	
	    $this->assertColorQ1( $res, 'a52626' );
	    $this->assertColorQ2( $res, '4aca4a' );
	    $this->assertColorQ3( $res, '0e0e8e' );
	    $this->assertColorQ4( $res, 'ffffff' );
	}
	public function testGif25()
	{
	    $original = $this->getOriginalImage( ImageType::GIF );
	    $res = $this->applyFilter( new ImageFilterSemiGrayScale(25), $original, __METHOD__ );
	
	    $this->assertColorQ1( $res, '783939' );
	    $this->assertColorQ2( $res, '6faf6f' );
	    $this->assertColorQ3( $res, '151555' );
	    $this->assertColorQ4( $res, 'ffffff' );
	}
	public function testJpg25()
	{
	    $original = $this->getOriginalImage( ImageType::JPG );
	    $res = $this->applyFilter( new ImageFilterSemiGrayScale(25), $original, __METHOD__ );
	
	    $this->assertColorQ1( $res, '773838' );
	    $this->assertColorQ2( $res, '6faf70' );
	    $this->assertColorQ3( $res, '151554' );
	    $this->assertColorQ4( $res, 'ffffff' );
	}
	public function testPng25()
	{
	    $original = $this->getOriginalImage( ImageType::PNG );
	    $res = $this->applyFilter( new ImageFilterSemiGrayScale(25), $original, __METHOD__ );
	
	    $this->assertColorQ1( $res, '783939' );
	    $this->assertColorQ2( $res, '6faf6f' );
	    $this->assertColorQ3( $res, '151555' );
	    $this->assertColorQ4( $res, 'ffffff' );
	}
}
