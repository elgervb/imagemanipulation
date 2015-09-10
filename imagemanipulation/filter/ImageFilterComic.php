<?php
namespace imagemanipulation\filter;

use imagemanipulation\ImageResource;
use imagemanipulation\ImageImageResource;
use imagemanipulation\Args;
/**
 * Apply a sketchy comic filter to an image
 */
class ImageFilterComic implements IImageFilter
{
	private $opacity;
	/**
	 * Constructor
	 * 
	 * @param number $aOpacity from 0 to 100
	 */
	public function __construct($opacity = 40){
	    $this->opacity = Args::int($opacity,'opacity')->required()->min(0)->max(100)->value();
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