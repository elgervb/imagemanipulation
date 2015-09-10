<?php
namespace imagemanipulation\reflection;

use imagemanipulation\color\Color;
use imagemanipulation\ImageResource;
use imagemanipulation\color\ColorUtil;
use imagemanipulation\filter\IImageFilter;
use imagemanipulation\ImageImageResource;
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
	
	public function __construct($height, $backgroundColor = 'ffffff', $startOpacity = 30,   $divLineHeight = 1){
		$this->height = Args::int($height, 'height')->required()->min(1)->value();
		$this->startOpacity = Args::int($startOpacity, 'Start Opacity')->required()->min(0)->max(100)->value();
		
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