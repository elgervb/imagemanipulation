<?php
namespace imagemanipulation\filter;

use imagemanipulation\ImageResource;
/**
 * Embosses the image
 *
 * @package image
 * @subpackage Imagefilter
 *
 */
class ImageFilterEmboss implements IImageFilter
{
	
	public function __construct()
	{
		//
	}
	
	public function applyFilter( ImageResource $aResource )
	{
		imagefilter( $aResource->getResource(), IMG_FILTER_EMBOSS );
	}
}