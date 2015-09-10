<?php
namespace imagemanipulation\filter;

use imagemanipulation\ImageResource;
/**
 * Embosses the image
 */
class ImageFilterEmboss implements IImageFilter
{
	
	public function applyFilter( ImageResource $aResource )
	{
		imagefilter( $aResource->getResource(), IMG_FILTER_EMBOSS );
	}
}