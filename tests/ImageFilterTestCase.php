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
	const RED = "ff0000";
	const GREEN = "00ff00";
	const BLUE = "0000ff";
	
	/**
	 * Applies a filter to an image file. The file will be copies to a fresh location.
	 *
	 * @param \imagemanipulation\filter\IImageFilter $aFilter The image filter to apply
	 * @param \SplFileInfo $aFile The orifinal image file
	 * @param string $aIdentifier The identifier to use for caching purposes
	 *
	 * @return \imagemanipulation\ImageImageResource
	 */
	protected function applyFilter($aFilter, $aFile, $aIdentifier){
		$res = $this->getImageRes($aFile, $aIdentifier);
	
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
		$this->assertEquals($aColor,$aRes->getColorAt(new Coordinate($aRes->getX() -2, 2))->getHexColor(), "Checking color in quadrant 2");
	}
	protected function assertColorQ3(ImageImageResource $aRes, $aColor){
		$this->assertEquals($aColor,$aRes->getColorAt(new Coordinate(2, $aRes->getY() -2))->getHexColor(), "Checking color in quadrant 3");
	}
	protected function assertColorQ4(ImageImageResource $aRes, $aColor){
		$this->assertEquals($aColor,$aRes->getColorAt(new Coordinate($aRes->getX()-2, $aRes->getY()-2))->getHexColor(), "Checking color in quadrant 4");
	}
	
	/**
	 *
	 * @return \SplFileInfo
	 */
	private function getSampleGif()
	{
		return new \SplFileInfo( __DIR__ . '/sample.gif' );
	}
	/**
	 *
	 * @return \SplFileInfo
	 */
	private function getSampleJpg()
	{
		return new \SplFileInfo( __DIR__ . '/sample.jpg' );
	}
	/**
	 *
	 * @return \SplFileInfo
	 */
	private function getSamplePng()
	{
		return new \SplFileInfo( __DIR__ . '/sample.png' );
	}
	
	/**
	 * Returns the original Image
	 * 
	 * @param $aType string
	 *
	 * @return \SplFileInfo
	 */
	protected function getOriginalImage( $aType )
	{
		$file = null;
		switch ($aType)
		{
			case ImageType::GIF:
				$file = $this->getSampleGif();
				break;
			case ImageType::JPG:
				$file = $this->getSampleJpg();
				break;
			case ImageType::PNG:
				$file = $this->getSamplePng();
				break;
		}
		if ($file === null || ! $file->isFile())
			$this->fail( 'Image of type ' . $aType . ' could not be found - ' . $file );
		
		return $file;
	}
	/**
	 *
	 * @param $aFile \SplFileInfo The orifinal image file
	 * @param $aIdentifier string The identifier to use for caching purposes
	 *       
	 * @return \imagemanipulation\ImageImageResource
	 */
	public function getImageRes(\SplFileInfo $aFile, $aIdentifier )
	{
		$aIdentifier = str_replace("::", "", $aIdentifier);
		$aIdentifier = str_replace("\\", "", $aIdentifier);
		$cacheDir = $this->getCacheDir();
		
		$testFile = new \SplFileInfo( $cacheDir . DIRECTORY_SEPARATOR . $aIdentifier . '-' . $aFile->getFilename() );
		if ($testFile->isFile())
		{
			$path = $testFile->getPathname();
			unset( $path );
		}
		
		$res = new ImageImageResource( $aFile );
		$res->setOutputPath( $testFile );
		return $res;
	}
}