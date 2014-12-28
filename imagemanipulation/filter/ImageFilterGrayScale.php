<?php
namespace imagemanipulation\filter;

use imagemanipulation\ImageResource;
/**
 * Applies grayscale to an image
 *
 * @package image
 * @subpackage imagefilter
 */
class ImageFilterGrayScale implements IImageFilter
{
	
	/**
	 * Applies the filter to the resource
	 *
	 * @param ImageResource $aResource
	 */
	public function applyFilter( ImageResource $aResource )
	{
		imagefilter( $aResource->getResource(), IMG_FILTER_GRAYSCALE );
	}
}