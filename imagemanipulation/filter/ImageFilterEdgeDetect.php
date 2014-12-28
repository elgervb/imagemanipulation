<?php
namespace imagemanipulation\filter;

use imagemanipulation\ImageResource;
/**
 * Uses edge detection to highlight the edges in the image
 *
 * @package image
 * @subpackage Imagefilter
 *
 */
class ImageFilterEdgeDetect implements IImageFilter
{
	
	public function __construct()
	{
		//
	}
	
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