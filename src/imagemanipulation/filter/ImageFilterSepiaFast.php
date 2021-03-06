<?php
namespace imagemanipulation\filter;

use imagemanipulation\ImageResource;
use imagemanipulation\Args;
/**
 * Apply a septia filter on the image
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
        $this->opacity = Args::int($darken, 'darken')->required()->min(0)->value(function($opacity){
        	return 127 - min(array($opacity + 30, 127));
        });
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