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
	    $this->imgRes = null;
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
	 * returns the size of the image
	 * 
	 * @return number the size in bytes
	 */
	public function getSize() {
	    ob_start();              // start the buffer
	    $this->render();         // output image to buffer
	    $size = ob_get_length(); // get size of buffer (in bytes)
	    ob_end_clean();          // trash the buffer
	    
	    return $size;
	}
	
	/**
	 * Gets the x - coordinate
	 *
	 * @return int
	 * 
	 * @deprecated use ImageResource::getWidth()
	 */
	public function getX()
	{
		return $this->getWidth();
	}
	
	/**
	 * Get the image width in pixels
	 *
	 * @return number
	 */
	public function getWidth() {
	    return imagesx( $this->imgRes );
	}
	
	/**
	 * Gets the y - coordinate
	 *
	 * @return int
	 * 
	 * @deprecated use ImageResource::getHeight()
	 */
	public function getY()
	{
		return $this->getHeight();
	}
	
	/**
	 * Get the image height in pixels
	 * 
	 * @return number
	 */
	public function getHeight() {
	    return imagesy( $this->imgRes );
	}
	
	/**
	 * Renders an image
	 * 
	 * @param string image type to render
	 * @param int quality of the image
	 * 
	 * @return boolean true on success, false on failure
	 * @param ImageType $type
	 * @param number $quality
	 */
	public function render($type = ImageType::PNG, $quality = 80) {
	    return $this->imageoutput(null, $type, $quality);
	}
	
	/**
	 * Save an image to file
	 *
	 * @param string path to save the image to on disk, null to output to the browser
	 * @param string image type to render
	 * @param int quality of the image
	 *
	 * @return boolean true on success, false on failure
	 */
	public function save($path = null, $type = ImageType::PNG, $quality = 80) {
	    return $this->imageoutput($path, $type, $quality);
	}
	
	/**
	 * Outputs an image to browser or file.
	 *
	 * @param string path to save the image to on disk, null to output to the browser
	 * @param string image type to render
	 * @param int quality of the image
	 * 
	 * @return boolean true on success, false on failure
	 * 
	 * @deprecated use either ImageResource::render() or ImageResource::save()
	 */
	public final function imageoutput( $path = null, $type = ImageType::PNG, $quality = 80 )
	{
	    Args::int($quality, 'quality')->min(1)->max(100)->required();
	    
	    if (! is_resource( $this->getResource() ))
	    {
	        throw new ImageResourceException( 'This is not a resource' );
	    }
	    
	    $result = false;
	    ob_start();
	
	    switch ($type)
	    {
	    	case ImageType::PNG:
	    	    imagesavealpha( $this->getResource(), true );
	    	    // quality for png must be 0 - 9
	    	    $result = imagepng( $this->getResource(), $path, ($quality / 10) - 1, PNG_ALL_FILTERS );
	    	    
	    	    break;
	    	    	
	    	case ImageType::GIF:
	    	    $result = imagegif( $this->getResource(), $path ); // gif does not have quality
	    	    break;
	    	    	
	    	// default = jpg
	    	default:
	    	    $result = imagejpeg( $this->getResource(), $path, $quality );
	    	    $type = ImageType::JPG;
	    	    break;
	    }
	    
	    $size = ob_get_length();
	    if (!headers_sent()) {
	       header('Content-Type: image/' . $type); 
	       header("Content-Length: " . $size);
	    }
	    ob_end_flush();
	    
	    return $result;
	}
	
	/**
	 * Set the save alpha flag
	 * 
	 * @param string $flag
	 */
	public function saveAlpha($flag = true){
	    imagesavealpha($this->getResource(), $flag);
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