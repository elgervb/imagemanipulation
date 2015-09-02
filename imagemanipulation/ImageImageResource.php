<?php
namespace imagemanipulation;

use imagemanipulation\color\ColorUtil;
/**
 * A image resource for an image
 */
class ImageImageResource extends ImageResource
{
	
	private $quality = 80;
	
	private $overwrite = false;
	
	/**
	 * @var \SplFileInfo
	 */
	private $originalPath;
	
	/**
	 *
	 * @var SplFileInfo
	 */
	private $outputPath = null;
	
	/**
	 * Create a new instance of ImageImageResource
	 *
	 * @param $aImage SplFileInfo An image
	 *       
	 * @throws FilesystemException when image resource is not valid
	 */
	public function __construct( \SplFileInfo $aImage )
	{
		parent::__construct( $this->createImageResource( $aImage ) );
		
		$this->originalPath = $aImage;
		$this->outputPath = $aImage;
	}
	
	/**
	 * Creates a new image on the path which is set
	 *
	 * @return SplFileInfo
	 */
	public function createImage()
	{
		if (! $this->imageoutput( $this->outputPath->getPathname() ))
		{
			throw new ImageResourceException( "Could not create image on " . $this->outputPath );
		}
		
		return new \SplFileInfo( $this->outputPath );
	}
	
	/**
	 * Returns the color at a coordinate of the image
	 * 
	 * @see RGBColor::getColorAt (ImageResource, Coordinate)
	 *     
	 * @param Coordinate aCoordinatel
	 * @return \imagemanipulation\color\Color
	 */
	public function getColorAt( Coordinate $aCoordinate )
	{
		return ColorUtil::getColorAt( $this, $aCoordinate );
	}
	
	/**
	 * Returns the path to the image this resource links to.
	 * Can never be null.
	 *
	 * @return Path
	 */
	public function getImagePath()
	{
		return $this->originalPath;
	}
	
	/**
	 * Returns the output path
	 *
	 * @return SplFileInfo
	 */
	public function getOutputPath()
	{
		return $this->outputPath;
	}
	
	/**
	 * Gets the quality of the outputted image
	 *
	 * @return int
	 */
	public function getQuality()
	{
		return $this->quality;
	}
	
	/**
	 * Checks if file should be overwritten
	 *
	 * @return boolean
	 */
	public function isOverwrite()
	{
		return $this->overwrite;
	}
	
	/**
	 * Output the image to screen. Last call of the chain.
	 */
	public function outputImage()
	{
		$this->imageoutput();
	}
	
	/**
	 * Set the resource identifier (BE *VERY* CAREFULL with this method)
	 *
	 * @param $aResource resource
	 */
	public function setResource( $aResource )
	{
		parent::setResource( $aResource );
	}
	
	/**
	 * Set the overwrite flag when writing the image to disk
	 * 
	 * @param boolean $aIsOverwritable
	 */
	public function setIsOverwrite( $aIsOverwritable )
	{
		$this->overwrite = $aIsOverwritable;
	}
	
	/**
	 * Set the output path for the image
	 *
	 * @param $aPath SplFileInfo
	 */
	public function setOutputPath( \SplFileInfo $aPath )
	{
		$this->outputPath = $aPath;
	}
	
	/**
	 * Sets the quality for the image to output
	 *
	 * @param $aQuality int A quality from 0 to 100
	 */
	public function setQuality( $aQuality )
	{
		$this->quality = $aQuality;
	}
	
	/**
	 * Outputs an image to browser or file.
	 *
	 * @param $aPath string = null (output to the browser)
	 *       
	 * @return resource
	 */
	private function imageoutput( $aPath = null )
	{
		if (! is_resource( $this->getResource() ))
		{
			throw new ImageResourceException( 'This is not a resource' );
		}
		
		switch (strtolower( $this->originalPath->getExtension() ))
		{
			case ImageType::PNG:
				imagesavealpha( $this->getResource(), true );
				// quality for png must be 0 - 9
				return imagepng( $this->getResource(), $aPath, ($this->quality / 10) - 1, PNG_ALL_FILTERS );
				break;
			
			case ImageType::GIF:
				return imagegif( $this->getResource(), $aPath );
				break;
			
			// default = jpg
			default:
				return imagejpeg( $this->getResource(), $aPath, $this->quality );
				break;
		
		}
	}
	
	/**
	 * Create a new image resource from an image file
	 *
	 * @throws TResourceException
	 *
	 * @param $aImage SplFileInfo
	 *
	 * @return resource The image resource
	 */
	private function createImageResource( \SplFileInfo $aImage )
	{
		$result = null;
		
		switch (strtolower( $aImage->getExtension() ))
		{
			case ImageType::PNG:
				$result = imagecreatefrompng( $aImage );
				break;
			
			case ImageType::GIF:
				$result = imagecreatefromgif( $aImage );
				break;
			
			// default = jpg
			default:
				$result = imagecreatefromjpeg( $aImage );
				break;
		}
		
		if ($result === null || $result === false)
		{
			throw new ImageResourceException( 'Failed to create image resource from image ' . $aImage->getPathname() );
		}
		
		// convert palette to true color image
		if (! imageistruecolor( $result ))
			$result = $this->palette2truecolor( $result );
		
		return $result;
	}
	
	private function palette2truecolor( $aImgRes )
	{
		$x = imagesx( $aImgRes );
		$y = imagesy( $aImgRes );
		$result = imagecreatetruecolor( $x, $y );
		imagecopy( $result, $aImgRes, 0, 0, 0, 0, $x, $y );
		return $result;
	}
	
	/**
	 * Gets the extension of a file
	 *
	 * @param $aFile SplFileInfo
	 *
	 * @return string the extension or an empty string when no extension
	 */
	private function getExtension( \SplFileInfo $aFile )
	{
		$base = $aFile->getBasename();
		$dotPos = strrpos( $base, "." );
		if (false === $dotPos)
		{
			return "";
		}
		
		return substr( $base, $dotPos + 1, strlen( $base ) );
	}
}