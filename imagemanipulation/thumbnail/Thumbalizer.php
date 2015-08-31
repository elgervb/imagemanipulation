<?php
namespace imagemanipulation\thumbnail;

use imagemanipulation\ImageImageResource;
use imagemanipulation\Coordinate;
use imagemanipulation\thumbnail\pixelstrategy\IPixelStrategy;
use imagemanipulation\ImageResource;
/**
 *
 * @package image
 * @subpackage thumbnail
 */
class Thumbalizer
{
	/**
	 *
	 * @var IPixelStrategy
	 */
	private $strategy;
	
	/**
	 * Creates a new Thumbalizer
	 *
	 * @param $aStrategy IPixelStrategy
	 */
	public function __construct( IPixelStrategy $aStrategy )
	{
		$this->strategy = $aStrategy;
	}
	
	/**
	 * Create the thumbnail
	 *
	 * @param $aResource ImageResource The image resource of the original image
	 *       
	 * @return ImageResource The image resource of the thumbnail
	 */
	public function create( ImageResource $aResource )
	{
		// The original PHP image resource
		$origImgRes = $aResource->getResource();
		
		// Create a new image resource
		$newResource = clone $aResource;
		
		$this->strategy->init( $aResource );
		$originalBegin = $this->strategy->getSourceBegin( $newResource );
		$originalEnd = $this->strategy->getSourceEnd( $newResource );
		$targetBegin = $this->strategy->getDestinationBegin( $aResource );
		$targetEnd = $this->strategy->getDestinationEnd( $newResource );
		
		// no change, return original
		if ($originalBegin == $targetBegin && $originalEnd == $targetEnd)
		{
			return $aResource;
		}
		
		$aResource->setResource( imagecreatetruecolor( $targetEnd->getX(), $targetEnd->getY() ) );
		
		imagecolortransparent( $aResource->getResource(), imagecolorallocate( $newResource->getResource(), 0, 0, 0 ) );
		imagealphablending( $aResource->getResource(), false );
		imageantialias( $aResource->getResource(), true );
		
		imagecopyresampled( $aResource->getResource(), $newResource->getResource(), $targetBegin->getX(), $targetBegin->getY(), $originalBegin->getX(), $originalBegin->getY(), $targetEnd->getX(), $targetEnd->getY(), $originalEnd->getX(), $originalEnd->getY() );
		
		$aResource->setResource($aResource->getResource());
		$newResource->destroy();
		
		return $aResource;
	}
}