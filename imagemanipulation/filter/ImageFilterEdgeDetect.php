<?php
namespace imagemanipulation\filter;

use imagemanipulation\ImageResource;
/**
 * Uses edge detection to highlight the edges in the image
 */
class ImageFilterEdgeDetect implements IImageFilter
{
	
	/**
	 * Applies the filter to an image resource
	 *
	 * @param ImageResource $aResource
	 */
	public function applyFilter( ImageResource $aResource )
	{
		imagefilter( $aResource->getResource(), IMG_FILTER_EDGEDETECT );
	}
}