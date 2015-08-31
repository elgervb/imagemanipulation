<?php
namespace imagemanipulation\thumbnail\pixelstrategy;

use imagemanipulation\ImageResource;
use imagemanipulation\Coordinate;
/**
 * Pixel strategy to resize the image to a max width or height keeping proportions, thus restraining the image to a certain size
 */
class MaxPixelStrategy implements IPixelStrategy
{
	
	/**
	 * @var int
	 */
	private $maxWidth;
	
	/**
	 * @var int
	 */
	private $maxHeight;
	
	/**
	 * Creates a new MaxPixelStrategy. 
	 * 
	 * @param int $aMaxWidth 
	 * @param int $aMaxHeight
	 */
	public function __construct( $aMaxWidth, $aMaxHeight )
	{
		assert( 'is_int($aMaxWidth)' );
		assert( '$aMaxWidth > 0' );
		assert( 'is_int($aMaxHeight)' );
		assert( '$aMaxHeight > 0' );
		
		$this->maxWidth = $aMaxWidth;
		$this->maxHeight = $aMaxHeight;
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
		$x = $aResource->getX();
		$y = $aResource->getY();
		$factor = 1;
		
		if ($x > $this->maxWidth && $y > $this->maxHeight)
		{
			if ($this->maxWidth < $this->maxHeight)
			{
				$factor = ($this->maxWidth / $x);
			}
			else
			{
				$factor = ($this->maxHeight / $y);
			}
		}
		else 
			if ($x > $this->maxWidth)
			{
				$factor = ($this->maxWidth / $x);
			}
			elseif ($y > $this->maxHeight)
			{
				$factor = ($this->maxHeight / $y);
			}
		
		return new Coordinate( (int) ($x * $factor), (int) ($y * $factor) );
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