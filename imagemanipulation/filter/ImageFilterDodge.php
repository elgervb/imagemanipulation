<?php
namespace imagemanipulation\filter;

use imagemanipulation\ImageResource;
/**
 * Dodge an image
 */
class ImageFilterDodge implements IImageFilter
{
	
	private $percentage;
	
	/**
	 * Creates a new ImageFilterDodge
	 *
	 * @param int $aPercentage min 0, max 100
	 */
	public function __construct( $aPercentage = 75 )
	{
		$this->percentage = $aPercentage;
	}
	
	/**
	 * Applies the filter to the image resource
	 *
	 * @param ImageResource $aResource
	 */
	public function applyFilter( ImageResource $aResource )
	{
		if ($this->percentage == 0)
		{
			return; // percentage = 0, do nothing !
		}
		
		$resource = $aResource->getResource();
		
		$rgb = 0;
		$d = array();
		$s = array();
		$dstx = 0;
		$dsty = 0;
		$dest = imagecreatetruecolor( $aResource->getX(), $aResource->getY() );
		
		for ($i = 0; $i < $aResource->getY(); $i ++)
		{
			for ($j = 0; $j < $aResource->getX(); $j ++)
			{
				$rgb = imagecolorat( $dest, $dstx + $j, $dsty + $i );
				$d[0] = ($rgb >> 16) & 0xFF;
				$d[1] = ($rgb >> 8) & 0xFF;
				$d[2] = $rgb & 0xFF;
				
				$rgb = imagecolorat( $aResource->getResource(), $j, $i );
				$s[0] = ($rgb >> 16) & 0xFF;
				$s[1] = ($rgb >> 8) & 0xFF;
				$s[2] = $rgb & 0xFF;
				
				$d[0] += min( $s[0], 0xFF - $d[0] ) * $this->percentage / 100;
				$d[1] += min( $s[1], 0xFF - $d[1] ) * $this->percentage / 100;
				$d[2] += min( $s[2], 0xFF - $d[2] ) * $this->percentage / 100;
				
				imagesetpixel( $resource, $dstx + $j, $dsty + $i, imagecolorallocate( $resource, $d[0], $d[1], $d[2] ) );
			}
		}
	}
}