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
		
		$this->strategy->init( $newResource );
		$originalBegin = $this->strategy->getSourceBegin( $aResource );
		$originalEnd = $this->strategy->getSourceEnd( $aResource );
		$targetBegin = $this->strategy->getDestinationBegin( $newResource );
		$targetEnd = $this->strategy->getDestinationEnd( $newResource );
		
		// no change, return original
		if ($originalBegin == $targetBegin && $originalEnd == $targetEnd)
		{
			return $aResource;
		}
		
		$newResource->setResource( imagecreatetruecolor( $targetEnd->getX(), $targetEnd->getY() ) );
		
		imagecolortransparent( $newResource->getResource(), imagecolorallocate( $aResource->getResource(), 0, 0, 0 ) );
		imagealphablending( $newResource->getResource(), false );
		imageantialias( $newResource->getResource(), true );
		
		imagecopyresampled( $newResource->getResource(), $aResource->getResource(), $targetBegin->getX(), $targetBegin->getY(), $originalBegin->getX(), $originalBegin->getY(), $targetEnd->getX(), $targetEnd->getY(), $originalEnd->getX(), $originalEnd->getY() );
		
		imagedestroy( $origImgRes );
		
		// update the original resource with the new one. This way we can still reference if from outside scope
		$aResource->setResource($newResource->getResource());
		return $newResource;
	}
}