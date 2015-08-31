<?php
namespace imagemanipulation\filter;

use imagemanipulation\ImageResource; 
/**
 * Changes the contrast of the image.
 *
 * @package image
 * @subpackage Imagefilter
 *
 */
class ImageFilterContrast implements IImageFilter
{
	
	private $level;
	
	/**
	 * Creates a new ImageFilterContrast
	 *
	 * @param int $aLevel -100 to +100, defaults to 5, where -100 = min contrast, 0 = no change, +100 = max contrast
	 */
	public function __construct( $level = 5 )
	{
		$this->level = $level * - 1;
	}
	
	/**
	 * Applies contrast to the image.
	 *
	 * @param ImageResource $aResource
	 */
	public function applyFilter( ImageResource $aResource )
	{
		if ($this->level != 0)
		{
			imagefilter( $aResource->getResource(), IMG_FILTER_CONTRAST, $this->level );
		}
	}
}