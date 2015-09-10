<?php
namespace imagemanipulation\filter;

use imagemanipulation\ImageResource;
use imagemanipulation\Args;
/**
 * Makes the image smoother.
 *
 */
class ImageFilterSmooth implements IImageFilter
{
	
	/**
	 * Smoothness level.
	 *
	 * @var int
	 */
	private $rate;
	
	/**
	 * Creates a new ImageFilterSmooth
	 *
	 * @param int $aRate Smoothness level.
	 */
	public function __construct( $rate = 5 )
	{
	    $this->rate = Args::int($rate, 'rate')->required()->min(0)->value();
	}
	
	/**
	 * Applies the filter to an image resource
	 *
	 * @param ImageResource $aResource
	 */
	public function applyFilter( ImageResource $aResource )
	{
		assert( '$this->rate !== null' );
		
		imagefilter( $aResource->getResource(), IMG_FILTER_SMOOTH, $this->rate );
	}
}