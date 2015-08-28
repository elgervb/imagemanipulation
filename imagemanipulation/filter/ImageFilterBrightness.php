<?php
namespace imagemanipulation\filter;

use imagemanipulation\ImageResource;
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
	public function __construct( $aRate = 20 )
	{
		$this->rate = $aRate;
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