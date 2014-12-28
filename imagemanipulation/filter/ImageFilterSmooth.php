<?php
namespace imagemanipulation\filter;

use imagemanipulation\ImageResource;
/**
 * Makes the image smoother.
 *
 * Applies a 9-cell convolution matrix where center pixel has the weight arg1 and others weight of 1.0.
 * The result is normalized by dividing the sum with arg1 + 8.0 (sum of the matrix).
 * any float is accepted, large value (in practice: 2048 or more) = no change
 *
 * @package image
 * @subpackage imagefilter
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
	 * Creates a new TImageFilterSmooth
	 *
	 * @param int $aRate Smoothness level.
	 */
	public function __construct( $aRate = 5 )
	{
		$this->rate = $aRate;
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