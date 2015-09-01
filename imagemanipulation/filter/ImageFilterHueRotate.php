<?php
namespace imagemanipulation\filter;

use imagemanipulation\ImageResource;
use imagemanipulation\color\ColorUtil;
use imagemanipulation\Coordinate;
/**
 * Rotete the hue of the image
 */
class ImageFilterHueRotate implements IImageFilter
{
	private $degrees;
	
	/**
	 * 
	 * @param number $aOffset
	 */
	public function __construct( $degrees = 90 )
	{
		$this->degrees = $degrees > 360 ? $degrees % 360 : $degrees;;
	}
	/**
	 * Applies the sepia filter to an image resource
	 *
	 * @param ImageResource $aResource
	 */
	public function applyFilter( ImageResource $aResource )
	{
	    if ($this->degrees % 360 === 0){return;}
	    
	    $width = $aResource->getX();
	    $height = $aResource->getY();
	    
	    for ($x = 0; $x < $width; ++ $x)
	    {
	        for ($y = 0; $y < $height; ++ $y)
	        {
	            $color = ColorUtil::getColorAt($aResource, Coordinate::create($x, $y));
	            $hsl = ColorUtil::rgb2hsl($color->getRed(), $color->getGreen(), $color->getBlue());
	            
	            $hsl[0] += $this->degrees;
	            
	            $rgb = ColorUtil::hsl2rgb($hsl[0], $hsl[1], $hsl[2]);
	            
	            $newcol = imagecolorallocate( $aResource->getResource(), $rgb[0], $rgb[1], $rgb[2] );
	            imagesetpixel( $aResource->getResource(), $x, $y, $newcol );
	        }
	    }
	}
}