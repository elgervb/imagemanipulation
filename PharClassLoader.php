<?php
namespace imagemanipulation;
/**
 * Classloader for PHAR files
 * @author eaboxt
 */
class PharClassLoader {
	
	private $base;
	
	/**
	 * Constructor
	 * 
	 * @param string $aPharPath 
	 */
	public function __construct($aPharPath){
		$this->base = 'phar://' . $aPharPath . '/';
	}

	/**
	 * Register this classloader
	 */
	public function register(){
		spl_autoload_extensions( ".php" );
		
		spl_autoload_register( array($this , 'autoLoad') );
	}
	
	/**
	 * the loader implementation
	 * 
	 * @param string $aClassName The classname including the namespace
	 * 
	 * @throws \Exception
	 */
	public function autoLoad( $aClassName )
	{
		$path = $this->base . $aClassName . '.php';
		
		if (is_file($path)){
			$included = include $path;
			if (!$included){
				throw new \Exception('Could not load class ' . $aClassName . ' from ' . $this->base) ;
			}
		}
	}
}