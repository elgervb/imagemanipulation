<?php
namespace imagemanipulation\filter;

use imagemanipulation\ImageResource;
use imagemanipulation\color\ColorUtil;
use imagemanipulation\Coordinate;
use imagemanipulation\Args;
/**
 * Rotate the hue of the image
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
	    $this->degrees = Args::int($degrees)->required()->min(0)->value(function($degrees){
	        return $degrees > 360 ? $degrees % 360 : $degrees;
	    });
	}
	/**
	 * Applies the sepia filter to an image resource
	 *
	 * @param ImageResource $aResource
	 */
	public function applyFilter( ImageResource $aResource )
	{
	    if ($this->degrees === 0){return;}
	    
	    $width = $aResource->getX();
	    $height = $aResource->getY();
	    
	    // cache calculated colors in a map...
	    $colorMap = array();
	    
	    for ($x = 0; $x < $width; ++ $x)
	    {
	        for ($y = 0; $y < $height; ++ $y)
	        {
	            $color = ColorUtil::getColorAt($aResource, Coordinate::create($x, $y));
	            if (!isset($colorMap[$color->getColorIndex()])){
	                // calculate the new color
    	            $hsl = ColorUtil::rgb2hsl($color->getRed(), $color->getGreen(), $color->getBlue());
    	            $hsl[0] += $this->degrees;
    	            $rgb = ColorUtil::hsl2rgb($hsl[0], $hsl[1], $hsl[2]);
    	            $newcol = imagecolorallocate( $aResource->getResource(), $rgb[0], $rgb[1], $rgb[2] );
    	            
    	            $colorMap[$color->getColorIndex()] = $newcol;
	            } else {
	                $newcol = $colorMap[$color->getColorIndex()];
	            }
	            
	            imagesetpixel( $aResource->getResource(), $x, $y, $newcol );
	        }
	    }
	    
	    $colorMap = null;
	}
}