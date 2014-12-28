<?php
namespace imagemanipulation\filter;

use imagemanipulation\ImageResource;
/**
 * Uses mean removal to achieve a "sketchy" effect
 *
 * @package image
 * @subpackage Imagefilter
 *
 */
class ImageFilterMeanRemove implements IImageFilter
{
	
	public function __construct()
	{
		//
	}
	
	public function applyFilter( ImageResource $aResource )
	{
		imagefilter( $aResource->getResource(), IMG_FILTER_MEAN_REMOVAL );
	}
}