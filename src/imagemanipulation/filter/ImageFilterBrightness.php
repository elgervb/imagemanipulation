<?php
namespace imagemanipulation\filter;

use imagemanipulation\ImageResource;
use imagemanipulation\Args;
/**
 * Adjust the brightness of the image, either lighter or darker
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
	 * @param int = 20 The brightness level from -255 to 255, from darker to lighter
	 */
	public function __construct( $rate = 20 )
	{
	    $this->rate = Args::int($rate, 'rate')->required()->min(-255)->max(255)->value();
	}

    /**
     * (non-PHPdoc)
     * @see \imagemanipulation\filter\IImageFilter::applyFilter()
     */
	public function applyFilter( ImageResource $aResource )
	{
		if ($this->rate != 0) // 0 means no change
		{
			imagefilter( $aResource->getResource(), IMG_FILTER_BRIGHTNESS, $this->rate );
		}
	}
}