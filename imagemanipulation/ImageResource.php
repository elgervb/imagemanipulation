<?php
namespace imagemanipulation;
use imagemanipulation\filter\IImageFilter;
/**
 * @package image
 * @subpackage resource
 */
class ImageResource
{
	
	/**
	 * The PHP image resource to work with
	 *
	 * @var resource
	 */
	private $imgRes;
	
	public function __construct( $aResource )
	{
		$this->validateResource( $aResource );
		
		$this->imgRes = $aResource;
	}
	
	/**
	 * Apply a filter to the image resource
	 * @param IImageFilter $aFilter
	 * @return \imagemanipulation\ImageResource
	 */
	public function filter(IImageFilter $filter){
		$filter->applyFilter($this);
		return $this;
	}
	
	/**
	 * Clone the image resource
	 * 
	 * @return ImageResource
	 */
	public function cloneResource(){
		$clone = imagecreatetruecolor($this->getX(), $this->getY());
		imagecopy($clone, $this->imgRes, 0, 0, 0, 0, $this->getX(), $this->getY());
		
		return new ImageResource($clone);
	}
	
	/**
	 * Destroys the resource and free up memory
	 */
	public function destroy(){
	    imagedestroy($this->imgRes);
	}
	
	/**
	 * Checks if the resource is a valid resource
	 *
	 * @param resource $aResource
	 *
	 * @throws ImageResourceException
	 */
	private function validateResource( $aResource )
	{
		if (! is_resource( $aResource ))
		{
			throw new ImageResourceException( "This is not a resource." );
		}
	}
	
	/**
	 * Gets the image resource
	 *
	 * @return resource
	 */
	public function getResource()
	{
		return $this->imgRes;
	}
	
	/**
	 * Gets the x - coordinate
	 *
	 * @return int
	 */
	public function getX()
	{
		return imagesx( $this->imgRes );
	}
	
	/**
	 * Gets the y - coordinate
	 *
	 * @return int
	 */
	public function getY()
	{
		return imagesy( $this->imgRes );
	}
	
	/**
	 * Sets the image resource
	 */
	public function setResource( $aResource )
	{
		$this->validateResource( $aResource );
		
		$this->imgRes = $aResource;
	}

}