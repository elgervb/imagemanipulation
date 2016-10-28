<?php
namespace imagemanipulation\filter;

use imagemanipulation\ImageResource;
/**
 * Blurs the image using the Gaussian method.
 */
class ImageFilterGaussianBlur implements IImageFilter
{
	
	public function applyFilter( ImageResource $aResource )
	{
		imagefilter( $aResource->getResource(), IMG_FILTER_GAUSSIAN_BLUR );
	}
}