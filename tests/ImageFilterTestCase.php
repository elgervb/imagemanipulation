<?php
use imagemanipulation\Coordinate;

use imagemanipulation\ImageResource;

use imagemanipulation\ImageImageResource;

use imagemanipulation\ImageType;

/**
 *
 * @author Elger van Boxtel
 */
abstract class ImageFilterTestCase extends \ImagemanipulationTestCase
{
	const WHITE = "ffffff";
	const BLACK = "000000";
	const RED   = "ff0000";
	const GREEN = "00ff00";
	const BLUE  = "0000ff";
	
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
	    $testColor = $aRes->getColorAt(new Coordinate(2, 2))->getHexColor();
		$this->assertEquals($aColor, $testColor, "Checking color in quadrant 1 " . $aColor . ' vs ' . $testColor);
	}
	protected function assertColorQ2(ImageImageResource $aRes, $aColor){
	    $testColor = $aRes->getColorAt(new Coordinate($aRes->getX() -01, 2))->getHexColor();
		$this->assertEquals($aColor, $testColor, "Checking color in quadrant 2 " . $aColor . ' vs ' . $testColor);
	}
	protected function assertColorQ3(ImageImageResource $aRes, $aColor){
	    $testColor = $aRes->getColorAt(new Coordinate(2, $aRes->getY() -2))->getHexColor();
		$this->assertEquals($aColor, $testColor, "Checking color in quadrant 3 " . $aColor . ' vs ' . $testColor);
	}
	protected function assertColorQ4(ImageImageResource $aRes, $aColor){
	    $testColor = $aRes->getColorAt(new Coordinate($aRes->getX()-2, $aRes->getY()-2))->getHexColor();
		$this->assertEquals($aColor, $testColor, "Checking color in quadrant 4 " . $aColor . ' vs ' . $testColor);
	}
}