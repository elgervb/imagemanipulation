<?php
namespace imagemanipulation\filter;

use imagemanipulation\ImageResource;
/**
 * Image Sepia
 *
 * @package image
 * @subpackage Imagefilter
 *
 */
class ImageFilterSepiaFast implements IImageFilter
{
    private $opacity;
    
    /**
     * Creates a new ImageFilterSepia
     *
     * @param int $aDarken
     */
    public function __construct( $darken = 15 )
    {
        $this->opacity = 127 - min(array($darken + 30, 127));
    }

	/**
	 * Applies the sepia filter to an image resource
	 *
	 * @param ImageResource $aResource
	 */
	public function applyFilter( ImageResource $aResource )
	{
		imagefilter($aResource->getResource(), IMG_FILTER_GRAYSCALE);
		imagefilter( $aResource->getResource(), IMG_FILTER_CONTRAST, -5 );
		imagefilter($aResource->getResource(), IMG_FILTER_COLORIZE, 100,50,0, $this->opacity);
	}
}