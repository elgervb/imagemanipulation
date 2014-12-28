<?php
namespace imagemanipulation\filter;

use imagemanipulation\ImageResource;
/**
 * Image filter Selective Blur
 *
 * @package image
 * @subpackage Imagefilter
 *
 */
class ImageFilterSelectiveBlur implements IImageFilter
{
	
	public function applyFilter( ImageResource $aResource )
	{
		imagefilter( $aResource->getResource(), IMG_FILTER_SELECTIVE_BLUR );
	}
}