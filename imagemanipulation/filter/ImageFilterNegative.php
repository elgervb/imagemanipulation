<?php
namespace imagemanipulation\filter;

use imagemanipulation\ImageResource;
/**
 * Create a negative of an image
 *
 * @author Elger van Boxtel
 */
class ImageFilterNegative implements IImageFilter
{
	/**
	 * Applies the filter to the image resource
	 *
	 * @param ImageResource $aResource
	 */
	public function applyFilter( ImageResource $aResource )
	{
		imagefilter( $aResource->getResource(), IMG_FILTER_NEGATE );
	}
}