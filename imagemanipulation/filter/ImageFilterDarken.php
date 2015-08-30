<?php
namespace imagemanipulation\filter;

use imagemanipulation\ImageResource;
/**
 * Changes the brightness of the image
 *
 * @package image
 * @subpackage Imagefilter
 *
 */
class ImageFilterDarken implements IImageFilter
{
	
	private $rate;
	
	/**
	 * Create a new ImageFilterDarken
	 *
	 * @param int $aRate -255 = min brightness, 0 = no change, +255 = max brightness
	 */
	public function __construct( $aRate = 20 )
	{
		$this->rate = $aRate * - 1;
	}
	
	public function applyFilter( ImageResource $aResource )
	{
		imagefilter( $aResource->getResource(), IMG_FILTER_BRIGHTNESS, $this->rate );
	}
}