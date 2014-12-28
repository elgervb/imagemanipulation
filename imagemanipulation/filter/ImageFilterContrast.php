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
	 * @param int $aLevel -100 = min contrast, 0 = no change, +100 = max contrast
	 */
	public function __construct( $aLevel = 0 )
	{
		$this->level = $aLevel * - 1;
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