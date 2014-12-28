<?php
namespace imagemanipulation\filter;

use imagemanipulation\ImageResource;
/**
 * Changes the brightness of the image. 
 *
 * @package image
 * @subpackage imagefilter
 */
class ImageFilterBrightness implements IImageFilter
{
	
	private $rate;
	
	/**
	 * Creates a new ImageFilterBrightness
	 *
	 * @param int = 20 -255 = min brightness, 0 = no change, +255 = max brightness
	 */
	public function __construct( $aRate = 20 )
	{
		$this->rate = $aRate;
	}
	
	/**
	 * Applies the filter on the image resource
	 *
	 * @param ImageResource $aResource
	 */
	public function applyFilter( ImageResource $aResource )
	{
		if ($this->rate != 0) // 0 means no change
		{
			imagefilter( $aResource->getResource(), IMG_FILTER_BRIGHTNESS, $this->rate );
		}
	}
}