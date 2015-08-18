<?php
use imagemanipulation\color\Color;
use imagemanipulation\ImageImageResource;
use imagemanipulation\ImageType;
/**
 * @author elger
 */
abstract class ImagemanipulationTestCase extends \PHPUnit_Framework_TestCase
{
	
	public function __construct(){
		set_include_path( realpath(__DIR__ . '/..') . PATH_SEPARATOR . get_include_path());
		spl_autoload_register( array($this , 'autoLoad') );
	}
	
	public function autoLoad($aClassName){
		$file = DIRECTORY_SEPARATOR .  str_replace('\\', DIRECTORY_SEPARATOR, $aClassName) . ".php";
		$paths = explode( PATH_SEPARATOR, get_include_path() );
		foreach ($paths as $path)
		{
			$fullpath = $path . DIRECTORY_SEPARATOR . $file;
			if (file_exists( $fullpath ))
			{
				require realpath( $fullpath );
				return;
			}
		}
	}

	protected function setUp()
	{
		parent::setUp();
		
		if (!is_dir($this->getCacheDir()))
		{
			mkdir($this->getCacheDir());
		}
	}
	
	
	/**
	 * Cleans up the environment after running a test.
	 */
	protected function tearDown()
	{
		
	}
	
	protected function getCacheDir(){
		return __DIR__ . '/cache';
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
	
	/**
	 * asserts that the color and the hex provided are the same
	 * @param Color $color
	 * @param string $hex
	 */
	protected function assertColor(Color $color, $hex){
	    $this->assertEquals($color->getHexColor(), $hex, "Colors are not the same... ". $color->getHexColor() . " - " . $hex);
	}
}