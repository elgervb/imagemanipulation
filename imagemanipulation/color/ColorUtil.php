<?php
namespace imagemanipulation\color;

use imagemanipulation\Coordinate;
use imagemanipulation\ImageResource;

/**
 * @author Elger van Boxtel
 */
class ColorUtil
{
	/**
	 * Calculates the average color of an image.
	 * 
	 * @param ImageResource $aResource
	 * 
	 * @return IColor
	 */
	public static function average(ImageResource $aResource) {
		$w = $aResource->getX();
		$h = $aResource->getY();
		$r = $g = $b = 0;
		$res = $aResource->getResource();
		for($y = 0; $y < $h; $y++) {
			for($x = 0; $x < $w; $x++) {
				$rgb = imagecolorat($res, $x, $y);
				$r += $rgb >> 16;
				$g += $rgb >> 8 & 255;
				$b += $rgb & 255;
			}
		}
		$pxls = $w * $h;
		$r = dechex(round($r / $pxls));
		$g = dechex(round($g / $pxls));
		$b = dechex(round($b / $pxls));
		if(strlen($r) < 2) {
			$r = 0 . $r;
		}
		if(strlen($g) < 2) {
			$g = 0 . $g;
		}
		if(strlen($b) < 2) {
			$b = 0 . $b;
		}
		$index = Color::createColorIndex($r, $g, $b);
		
		return new Color($index);
	}
	
	/**
	 * Returns the color at the specified location of the image resource
	 *
	 * @param ImageResource $aResource
	 * @param Coordinate $aCoordinate
	 *
	 * @return IColor The color found at the coordinates
	 */
	public static function getColorAt( ImageResource $aResource, Coordinate $aCoordinate )
	{
		$index = imagecolorat( $aResource->getResource(), $aCoordinate->getX(), $aCoordinate->getY() );
	
		$color = new Color( $index );
	
		return $color;
	}
}