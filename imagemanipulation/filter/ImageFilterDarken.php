<?php
namespace imagemanipulation\filter;

use imagemanipulation\ImageResource;
use imagemanipulation\Args;
/**
 * Changes the brightness of the image
 */
class ImageFilterDarken implements IImageFilter
{
	
	private $rate;
	
	/**
	 * Create a new ImageFilterDarken
	 *
	 * @param int $aRate -255 = min brightness, 0 = no change, +255 = max brightness
	 */
	public function __construct( $rate = 20 )
	{
	    $this->rate = Args::int($rate)->required()->min(-255)->max(255)->value()  * -1;
	}
	
	public function applyFilter( ImageResource $aResource )
	{
		imagefilter( $aResource->getResource(), IMG_FILTER_BRIGHTNESS, $this->rate );
	}
}