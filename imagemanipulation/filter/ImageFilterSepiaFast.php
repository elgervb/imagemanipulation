<?php
namespace imagemanipulation\filter;

use imagemanipulation\ImageResource;
/**
 * Image Sepia
 *
 * @package image
 * @subpackage Imagefilter
 *
 */
class ImageFilterSepiaFast implements IImageFilter
{
	
	
	/**
	 * Applies the sepia filter to an image resource
	 *
	 * @param ImageResource $aResource
	 */
	public function applyFilter( ImageResource $aResource )
	{
		imagefilter($aResource->getResource(), IMG_FILTER_GRAYSCALE); imagefilter($aResource->getResource(), IMG_FILTER_COLORIZE, 90, 60, 40); 
	}
}