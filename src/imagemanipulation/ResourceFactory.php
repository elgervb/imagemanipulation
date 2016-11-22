<?php
namespace imagemanipulation;
/**
 * @package image
 * @subpackage resource
 */
class ResourceFactory
{
	/**
	 * Creates a new Image resource from an image
	 *
	 * @param SplFileInfo $aImage
	 * @return ImageImageResource
	 */
	public static function createResource( \SplFileInfo $aImage )
	{
		return new ImageImageResource( $aImage );
	}
}