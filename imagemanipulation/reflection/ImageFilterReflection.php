<?php
namespace imagemanipulation\reflection;

use imagemanipulation\color\Color;
use imagemanipulation\ImageResource;
use imagemanipulation\filter\IImageFilter;
use imagemanipulation\rotate\ImageFilterRotate;
use imagemanipulation\Args;
/**
 * Test new filters
 */
class ImageFilterReflection implements IImageFilter
{
	private $height;
	private $startOpacity;
	private $backgroundColor;
	private $divLineHeight;
	private $includeOriginal;
	
	/**
	 * @param number $height the height of the shadow
	 * @param string $includeOriginal include the original image in the shadow, or just create only shadow
	 * @param string $backgroundColor the background color
	 * @param number $startOpacity the start opacity
	 * @param number $divLineHeight the div line height between the image and the shadow
	 */
	public function __construct($height, $includeOriginal = true, $backgroundColor = 'ffffff', $startOpacity = 30, $divLineHeight = 0){
		$this->height = Args::int($height, 'height')->required()->min(1)->value();
		$this->startOpacity = Args::int($startOpacity, 'Start Opacity')->required()->min(0)->max(100)->value();
		$this->includeOriginal = Args::bool($includeOriginal, 'includeOriginal')->required()->value();
		$this->backgroundColor = $backgroundColor instanceof Color ? $backgroundColor : new Color($backgroundColor);
		$this->divLineHeight = Args::int($divLineHeight, 'divLineHeight')->required()->min(0)->value();
	}
	/**
	 * Applies the filter to the resource
	 *
	 * @param ImageResource $aResource
	 */
	public function applyFilter( ImageResource $aResource )
	{
		$width = $aResource->getWidth();
		$height = $aResource->getHeight();
		 
		$lineRes = imagecreatetruecolor($width, 1);
		$bgc = imagecolorallocatealpha($lineRes,$this->backgroundColor->getRed(), $this->backgroundColor->getGreen(), $this->backgroundColor->getBlue(), $this->backgroundColor->getAlpha() ); // Background color
		imagefilledrectangle($lineRes, 0, 0, $width, 1, $bgc);
		
		$rotated = $aResource->cloneResource();
		$rotateFilter = new ImageFilterRotate(180, $this->backgroundColor);
		$rotateFilter->applyFilter($rotated);

		$bg = imagecreatetruecolor($width, $this->height);
		imagecopyresampled($bg, $rotated->getResource(), 0, 0, 0, 0, $width, $height, $width, $height);
		$im = $bg;
		$bg = imagecreatetruecolor($width, $this->height);
		for ($x = 0; $x < $width; $x++) {
		    imagecopy($bg, $im, $x, 0, $width-$x, 0, 1, $this->height);
		} 
		$im = $bg;
		 
		$in = 100 / $this->height;
		for($i = 0; $i <= $this->height; $i++){
		    imagecopymerge($im, $lineRes, 0, $i, 0, 0, $width, 1, $this->startOpacity);
		    if ($this->startOpacity < 100) $this->startOpacity += $in;
		}
		imagecopymerge($im, $lineRes, 0, 0, 0, 0, $width, $this->divLineHeight, 100); // Divider
		
		if ($this->includeOriginal) {
		    // we need to include the original
		    $mergeWidth = imagesx($im) + $aResource->getWidth();
		    $mergeHeight = imagesy($im) + $aResource->getHeight();
		    $imMerge = imagecreatetruecolor($width, $mergeHeight);
		    imagecopy($imMerge, $aResource->getResource(), 0, 0, 0, 0, $width, $height);
		    imagecopy($imMerge, $im, 0, $aResource->getHeight(), 0, 0, $width, $height);
		    $aResource->setResource($imMerge);
		} else {
    		$aResource->setResource($im);
		}
		
	}
	
}