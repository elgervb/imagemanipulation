<?php
namespace imagemanipulation\filter;

use imagemanipulation\ImageResource;
use imagemanipulation\color\ColorUtil;
use imagemanipulation\filter\IImageFilter;
/**
 * Applies a darker mask around the edges of the image
 */
class ImageFilterVignette implements IImageFilter
{
	private $width;
	private $height;
	
	/**
	 * Applies the filter to the resource
	 *
	 * @param ImageResource $aResource
	 */
	public function applyFilter( ImageResource $aResource )
	{
		
		$this->width = $aResource->getX();
		$this->height = $aResource->getY();
		$im = $aResource->getResource();
		
		for($x = 0; $x < $this->width; ++$x){
			for($y = 0; $y < $this->height; ++$y){
				$index = imagecolorat($im, $x, $y);
				$rgb = imagecolorsforindex($im, $index);
				$this->vignetteToPixel($x, $y, $rgb);
				$color = imagecolorallocate($im, $rgb['red'], $rgb['green'], $rgb['blue']);
		
				imagesetpixel($im, $x, $y, $color);
			}
		}
	}
	
	public function vignetteToPixel($x, $y, &$rgb){
		$sharp = 0.4; // 0 - 10 small is sharpnes,
		$level = 0.7; // 0 - 1 small is brighter
	
		$l = sin(M_PI / $this->width * $x) * sin(M_PI / $this->height * $y);
		$l = pow($l, $sharp);
	
		$l = 1 - $level * (1 - $l);
	
		$rgb['red'] *= $l;
		$rgb['green'] *= $l;
		$rgb['blue'] *= $l;
	}
}