<?php
namespace imagemanipulation\filter;

use imagemanipulation\ImageResource;
use imagemanipulation\ImageImageResource;
/**
 * Apply a sketchy comic filter to an image
 */
class ImageFilterComic implements IImageFilter
{
	private $opacity;
	public function __construct($aOpacity = 40){
		$this->opacity = $aOpacity;
	}
	/**
	 * Applies the filter to the resource
	 *
	 * @param ImageResource $aResource
	 */
	public function applyFilter( ImageResource $aResource )
	{
		//comic effect
		$width = $aResource->getX();
		$height = $aResource->getY();
		
		/* @var $imgK \imagemanipulation\ImageResource */
		$imgK = $aResource->cloneResource();
		$trueColorFilter = new ImageFilterTrueColor('ffffff', '000000');
		$trueColorFilter->applyFilter($imgK);
		
		imagecopymerge($aResource->getResource(),$imgK->getResource(),0,0,0,0,$width,$height,$this->opacity);
		
		imagedestroy($imgK->getResource());
	}
}