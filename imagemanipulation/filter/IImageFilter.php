<?php
namespace imagemanipulation\filter;

use imagemanipulation\ImageResource;

/**
 * Interface for a image filter.
 *
 * @package image
 * @subpackage imagefilter
 *
 */
interface IImageFilter
{
	/**
	 * Apply a filter to the image resource
	 * @param ImageResource $aResource
	 */
	public function applyFilter(ImageResource $aResource);
}
