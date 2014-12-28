<?php
namespace imagemanipulation\reflection;

use imagemanipulation\color\Color;
use imagemanipulation\ImageResource;
use imagemanipulation\color\ColorUtil;
use imagemanipulation\filter\IImageFilter;
use imagemanipulation\ImageImageResource;
use imagemanipulation\rotate\ImageFilterRotate;
/**
 * Test new filters
 */
class ImageFilterReflection implements IImageFilter
{
	private $height;
	private $startOpacity;
	private $backgroundColor;
	private $divLineHeight;
	
	public function __construct($aHeight, $aBackgroundColor = 'ffffff', $aStartOpacity = 30,   $aDivLineHeight=1){
		$this->height = $aHeight;
		$this->startOpacity = $aStartOpacity > 100 ? 100 : $aStartOpacity;
		$this->backgroundColor = $aBackgroundColor instanceof Color ? $aBackgroundColor : new Color($aBackgroundColor);
		$this->divLineHeight = $aDivLineHeight;
	}
	/**
	 * Applies the filter to the resource
	 *
	 * @param ImageResource $aResource
	 */
	public function applyFilter( ImageResource $aResource )
	{
		$width = $aResource->getX();
		$height = $aResource->getY();
		 
		$lineRes = imagecreatetruecolor($width, 1);
		$bgc = imagecolorallocatealpha($lineRes,$this->backgroundColor->getRed(), $this->backgroundColor->getGreen(), $this->backgroundColor->getBlue(), $this->backgroundColor->getAlpha() ); // Background color
		imagefilledrectangle($lineRes, 0, 0, $width, 1, $bgc);
		
		$rotateFilter = new ImageFilterRotate(180, $this->backgroundColor);
		$rotateFilter->applyFilter($aResource);

		$bg = imagecreatetruecolor($width, $this->height);
		imagecopyresampled($bg, $aResource->getResource(), 0, 0, 0, 0, $width, $height, $width, $height);
		$im = $bg;
		$bg = imagecreatetruecolor($width, $this->height);
		for ($x = 0; $x < $width; $x++) {
		    imagecopy($bg, $im, $x, 0, $width-$x, 0, 1, $this->height);
		} 
		$im = $bg;
		 
		$in = 100/$this->height;
		for($i=0; $i<=$this->height; $i++){
		    imagecopymerge($im, $lineRes, 0, $i, 0, 0, $width, 1, $this->startOpacity);
		    if ($this->startOpacity < 100) $this->startOpacity += $in;
		}
		imagecopymerge($im, $lineRes, 0, 0, 0, 0, $width, $this->divLineHeight, 100); // Divider
		$aResource->setResource($im);
	}
	
}