<?php
namespace imagemanipulation\filter;

use imagemanipulation\ImageResource;
/**
 * Duotone filter. Enhances Red, Green or Blue or a combination
 */
class ImageFilterDuotone implements IImageFilter
{
	
	private $red;
	private $green;
	private $blue;
	
	/**
	 * Creates a new ImageFilterDuotone
	 *
	 * @param int $red The amount of red to add
	 * @param int $green The amount of green to add
	 * @param int $bleu The amount of blue to add
	 */
	public function __construct( $red = 0, $green = 0, $blue = 0 )
	{
		$this->red = $red;
		$this->green = $green;
		$this->blue = $blue;
	}
	
	/**
	 * Applies the sepia filter to an image resource
	 *
	 * @param ImageResource $aResource
	 */
	public function applyFilter( ImageResource $aResource )
	{
	    if($this->red === 0 && $this->green === 0 && $this->blue === 0){
	        return;
	    }
	    
		$res = $aResource->getResource();
		$width = $aResource->getX();
		$height = $aResource->getY();
		
		for ($y = 0; $y < $height; $y ++)
		{
			for ($x = 0; $x < $width; $x ++)
			{
				$colorIndex = imagecolorat( $res, $x, $y );
				
				$dstA = ($colorIndex >> 24) << 1;
				$dstR = $colorIndex >> 16 & 0xFF;
				$dstG = $colorIndex >> 8 & 0xFF;
				$dstB = $colorIndex & 0xFF;
				
				$newR = min(255, $this->red + $dstR);
				$newG = min(255, $this->green + $dstG);
				$newB = min(255, $this->blue + $dstB);
				
				$newColor = imagecolorallocatealpha( $res, $newR, $newG, $newB, $dstA );
				imagesetpixel( $res, $x, $y, $newColor );
			}
		}
	}
}