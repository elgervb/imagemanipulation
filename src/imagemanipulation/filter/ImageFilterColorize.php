<?php
namespace imagemanipulation\filter;

use imagemanipulation\color\Color;
use imagemanipulation\ImageResource;

/**
 * Blends a fill color with the image
 *
 * @author Elger van Boxtel
 */
class ImageFilterColorize implements IImageFilter
{
	private $color;
	
	/**
	 * Creates a new ImageFilterColorize
	 *
	 * @param $aColor Color The color to blend, either in hexadecimal or rgb(a)
	 */
	public function __construct( Color $aColor )
	{
		$this->color = $aColor;
	}
	
	/**
	 * Applies the filter to the resource
	 *
	 * @param $aResource ImageResource
	 */
	public function applyFilter( ImageResource $aResource )
	{
		imagefilter( $aResource->getResource(), IMG_FILTER_COLORIZE, $this->color->getRed(), $this->color->getGreen(), $this->color->getBlue(), $this->color->getAlpha() );
	}
}