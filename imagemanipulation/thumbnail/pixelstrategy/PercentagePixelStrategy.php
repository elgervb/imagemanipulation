<?php
namespace imagemanipulation\thumbnail\pixelstrategy;

use imagemanipulation\ImageResource;
use imagemanipulation\Coordinate;
/**
 * Pixel strategy to reduce a image with a certain percentage
 * @author eaboxt
 *
 */
class PercentagePixelStrategy implements IPixelStrategy
{

	/**
	 * @var int
	 */
	private $percentage;

	/**
	 * Creates a new TPercentagePixelStrategy
	 * 
	 * @param int $aPercentage
	 */
	public function __construct( $aPercentage )
	{
		assert( 'is_int($aPercentage)' );
		assert( '$aPercentage > 0' );

		$this->percentage = $aPercentage;
	}

	/**
	 * @see IPixelStrategy::getDestinationBegin()
	 *
	 * @param ImageResource $aResource
	 * 
	 * @return imagemanipulation\Coordinate
	 */
	public function getDestinationBegin( ImageResource $aResource )
	{
		return new Coordinate( 0, 0 );
	}

	/**
	 * @see IPixelStrategy::getDestinationEnd()
	 *
	 * @param ImageResource $aResource
	 * @return imagemanipulation\Coordinate
	 */
	public function getDestinationEnd( ImageResource $aResource )
	{
		$x = $aResource->getX() * ($this->percentage / 100);
		$y = $aResource->getY() * ($this->percentage / 100);

		return new Coordinate( (int) $x, (int) $y );
	}

	/**
	 * @see IPixelStrategy::getSourceBegin()
	 *
	 * @param ImageResource $aResource
	 * @return imagemanipulation\Coordinate
	 */
	public function getSourceBegin( ImageResource $aResource )
	{
		return new Coordinate( 0, 0 );
	}

	/**
	 * @see IPixelStrategy::getSourceEnd()
	 *
	 * @param ImageResource $aResource
	 * @return imagemanipulation\Coordinate
	 */
	public function getSourceEnd( ImageResource $aResource )
	{
		return new Coordinate( $aResource->getX(), $aResource->getY() );
	}

	/**
	 * Initializes the pixel strategy
	 * 
	 * @param ImageResource $aResource
	 */
	public function init( ImageResource $aResource )
	{
		//
	}
}