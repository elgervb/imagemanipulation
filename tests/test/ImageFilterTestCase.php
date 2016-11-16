<?php
namespace test;

use imagemanipulation\Coordinate;
use imagemanipulation\ImageImageResource;

/**
 *
 * @author Elger van Boxtel
 */
abstract class ImageFilterTestCase extends ImagemanipulationTestCase
{
	const WHITE = "ffffff";
	const BLACK = "000000";
	const RED   = "ff0000";
	const GREEN = "00ff00";
	const BLUE  = "0000ff";
	const OFFSET = 20;
	
	/**
	 * Applies a filter to an image file. The file will be copies to a fresh location.
	 *
	 * @param \imagemanipulation\filter\IImageFilter $aFilter The image filter to apply
	 * @param \SplFileInfo $file The orifinal image file
	 * @param string $aIdentifier The identifier to use for caching purposes
	 *
	 * @return \imagemanipulation\ImageImageResource
	 */
	protected function applyFilter($aFilter, $file, $aIdentifier){
		$res = $this->getImageRes($file, $aIdentifier);
	
		$aFilter->applyFilter($res);
	
		$res->setIsOverwrite(true);
		$res->setQuality(100);
		$res->createImage();
		return $res;
	}
	
	/**
	 * Assert that the color in quadrant 1 is 
	 * @param ImageImageResource $aRes
	 * @param unknown_type $aColor
	 */
	protected function assertColorQ1(ImageImageResource $aRes, $aColor){
	    $coord = Coordinate::create(self::OFFSET, self::OFFSET);
	    $testColor = $aRes->getColorAt($coord)->getHexColor();
		$this->assertEquals($aColor, $testColor, "Checking color in quadrant 1 $coord $aColor vs $testColor");
	}
	protected function assertColorQ2(ImageImageResource $aRes, $aColor){
	    $coord = Coordinate::create($aRes->getWidth() - self::OFFSET, self::OFFSET);
	    $testColor = $aRes->getColorAt($coord)->getHexColor();
		$this->assertEquals($aColor, $testColor, "Checking color in quadrant 2 $coord $aColor vs $testColor");
	}
	protected function assertColorQ3(ImageImageResource $aRes, $aColor){
	    $coord = Coordinate::create(self::OFFSET, $aRes->getHeight() - self::OFFSET);
	    $testColor = $aRes->getColorAt($coord)->getHexColor();
		$this->assertEquals($aColor, $testColor, "Checking color in quadrant 3 $coord $aColor vs $testColor");
	}
	protected function assertColorQ4(ImageImageResource $aRes, $aColor){
	    $coord = Coordinate::create($aRes->getWidth()-self::OFFSET, $aRes->getHeight()-self::OFFSET);
	    $testColor = $aRes->getColorAt($coord)->getHexColor();
		$this->assertEquals($aColor, $testColor, "Checking color in quadrant 4 $coord $aColor vs $testColor");
	}
}