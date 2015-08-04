<?php
namespace tests;

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
}