<?php
namespace imagemanipulation\thumbnail\pixelstrategy;

use imagemanipulation\ImageResource;
use imagemanipulation\Coordinate;
/**
 * Pixel strategy for creating thumbnails which are centered in the middle of the image
 * 
 * @package image
 * @subpackage pixelstrategy
 */
class CenteredPixelStrategy implements IPixelStrategy
{
	/**
	 * @var int
	 */
	private $newWidth;
	/**
	 * @var int
	 */
	private $newHeight;
	/**
	 * @var boolean
	 */
	private $respectSmallerImage;
	/**
	 * @var int
	 */
	private $factor = 1;
	
	/**
	 * Creates a new CenteredPixelStrategy
	 *
	 * @param $aNewWidth int
	 * @param $aNewHeight int
	 * @param $aRespectSmallerImage boolean
	 */
	public function __construct( $aNewWidth, $aNewHeight, $aRespectSmallerImage = true )
	{
		assert( 'is_int($aNewWidth)' );
		assert( '$aNewWidth > 0' );
		assert( 'is_int($aNewHeight)' );
		assert( '$aNewHeight > 0' );
		
		$this->newWidth = $aNewWidth;
		$this->newHeight = $aNewHeight;
		$this->respectSmallerImage = $aRespectSmallerImage;
	}
	
	/**
	 *
	 * @see IPixelStrategy::getDestinationBegin()
	 *
	 * @param $aResource TImageResource
	 * @return imagemanipulation\Coordinate
	 */
	public function getDestinationBegin( ImageResource $aResource )
	{
		return new Coordinate( 0, 0 );
	}
	
	/**
	 *
	 * @see IPixelStrategy::getDestinationEnd()
	 *
	 * @param $aResource TImageResource
	 * @return imagemanipulation\Coordinate
	 */
	public function getDestinationEnd( ImageResource $aResource )
	{
		return new Coordinate( (int) ($this->newWidth * $this->factor), (int) ($this->newHeight * $this->factor) );
	}
	
	/**
	 *
	 * @see IPixelStrategy::getSourceBegin()
	 *
	 * @param $aResource ImageResource
	 * @return imagemanipulation\Coordinate
	 */
	public function getSourceBegin( ImageResource $aResource )
	{
		$originalX = $aResource->getX();
		$originalY = $aResource->getY();
		$aStartX = 0;
		$aStartY = 0;
		
		// if the dimensions are too high
		if (($originalX / $this->newWidth) < ($originalY / $this->newHeight))
		{
			$aStartY = ceil( ($originalY - ($this->newHeight * $originalX / $this->newWidth)) / 2 );
		}
		
		// if the dimensions are too width
		if (($originalY / $this->newHeight) < ($originalX / $this->newWidth))
		{
			$aStartX = ceil( ($originalX - ($this->newWidth * $originalY / $this->newHeight)) / 2 );
		}
		
		return new Coordinate( (int) $aStartX, (int) $aStartY );
	}
	
	/**
	 *
	 * @see IPixelStrategy::getSourceEnd()
	 *
	 * @param $aResource ImageResource
	 * @return imagemanipulation\Coordinate
	 */
	public function getSourceEnd( ImageResource $aResource )
	{
		$originalX = $aResource->getX();
		$originalY = $aResource->getY();
		$source_used_x = $originalX;
		$source_used_y = $originalY;
		
		// if the dimensions are too high
		if (($originalX / $this->newWidth) < ($originalY / $this->newHeight))
		{
			$source_used_y = ceil( ($this->newHeight * $originalX / $this->newWidth) );
			$source_used_x = $originalX;
		}
		
		// if the dimensions are too width
		if (($originalY / $this->newHeight) < ($originalX / $this->newWidth))
		{
			$source_used_x = ceil( ($this->newWidth * $originalY / $this->newHeight) );
			$source_used_y = $originalY;
		}
		
		return new Coordinate( (int) $source_used_x, (int) $source_used_y );
	}
	
	/**
	 * Initializes the pixel strategy
	 *
	 * @param $aResource ImageImageResource
	 */
	public function init( ImageResource $aResource )
	{
		if ($this->respectSmallerImage)
		{
			$x = $aResource->getX();
			$y = $aResource->getY();
			
			if ($x < $this->newWidth || $y < $this->newHeight)
			{
				if ($x < $y)
				{
					$this->factor = (int) $x / $this->newWidth;
				}
				else
				{
					$this->factor = (int) $y / $this->newHeight;
				}
			}
		}
	}
}