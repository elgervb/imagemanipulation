<?php
namespace imagemanipulation\filter;

use imagemanipulation\ImageResource;
/**
 * Reverses the image
 *
 * @package image
 * @subpackage Imagefilter
 *
 */
class ImageFilterReverse implements IImageFilter
{
	
	public function __construct()
	{
	
	}
	
	public function applyFilter( ImageResource $aResource )
	{
		$x = $aResource->getX();
		$y = $aResource->getY();
		$resource = $aResource->getResource();
		
		// Create a new image
		$ip = imagecreatetruecolor( $x, $y );
		
		// Loop through the whole height of the image
		for ($i = 0; $i < $y; $i ++)
		{
			// Loop through the whole width of the image
			for ($j = 0; $j < $x; $j ++)
			{
				// Get the pixel color ( $this->img->x - 1 needs to be there because of the imagestart @ 0,0 ;) )
				$c = imagecolorat( $resource, ($x - 1) - $j, $i );
				
				// Get the rgb values from color $c
				$r = ($c >> 16) & 0xFF;
				$g = ($c >> 8) & 0xFF;
				$b = $c & 0xFF;
				
				// Set the color
				$clr = imagecolorallocate( $ip, $r, $g, $b );
				
				// Set the pixel color in the new image
				imagesetpixel( $ip, $j, $i, $clr );
			}
		}
		
		$aResource->setResource( imagecreatetruecolor( $x, $y ) );
		imagecopy( $aResource->getResource(), $ip, 0, 0, 0, 0, $x, $y );
	}
}