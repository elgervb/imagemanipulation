<?php
namespace imagemanipulation\filter;

use imagemanipulation\ImageResource;
use imagemanipulation\color\ColorUtil;
use imagemanipulation\filter\IImageFilter;
/**
 * Sets the opacity of an image
 */
class ImageFilterOpacity implements IImageFilter
{
	private $opacity;
	
	/**
	 * Constructor
	 * @param number $aOpacity A value between 0 and 127. 0 indicates completely opaque while 127 indicates completely transparent.
	 */
	public function __construct( $aOpacity = 80 )
	{
		$this->opacity = $aOpacity;
	}
	
	/**
	 * Applies the filter to the resource
	 *
	 * @param ImageResource $aResource
	 */
	public function applyFilter( ImageResource $aResource )
	{
		if( !isset( $this->opacity ) )
			return;
		
		$this->opacity /= 100;
		
		//get image width and height
		$w = $aResource->getX();
		$h = $aResource->getY();
		
		//turn alpha blending off
		imagealphablending( $aResource->getResource(), false );
		
		//find the most opaque pixel in the image (the one with the smallest alpha value)
		$minalpha = 127;
		for( $x = 0; $x < $w; $x++ )
		{
			for( $y = 0; $y < $h; $y++ )
			{
				$alpha = ( imagecolorat( $aResource->getResource(), $x, $y ) >> 24 ) & 0xFF;
				if( $alpha < $minalpha )
				{ $minalpha = $alpha; }
			}
		}
		
		//loop through image pixels and modify alpha for each
		for( $x = 0; $x < $w; $x++ )
		{
			for( $y = 0; $y < $h; $y++ )
			{
				//get current alpha value (represents the TANSPARENCY!)
				$colorxy = imagecolorat( $aResource->getResource(), $x, $y );
				$alpha = ( $colorxy >> 24 ) & 0xFF;
				//calculate new alpha
				if( $minalpha !== 127 )
				{ $alpha = 127 + 127 * $this->opacity * ( $alpha - 127 ) / ( 127 - $minalpha ); }
				else
				{ $alpha += 127 * $this->opacity; }
				//get the color index with new alpha
				$alphacolorxy = imagecolorallocatealpha( $aResource->getResource(), ( $colorxy >> 16 ) & 0xFF, ( $colorxy >> 8 ) & 0xFF, $colorxy & 0xFF, $alpha );
				//set pixel with the new color + opacity
				if( !imagesetpixel( $aResource->getResource(), $x, $y, $alphacolorxy ) )
				{ return; }
			}
		}
	}
}