<?php
namespace imagemanipulation\filter;

use imagemanipulation\ImageResource;
use imagemanipulation\color\Color;
use imagemanipulation\color\ColorUtil;
use imagemanipulation\filter\IImageFilter;
/**
 * Bring the image back to 2 colors. Per default is goes to absolute black and white
 */
class ImageFilterTrueColor implements IImageFilter
{
	private $lowcolor;
	private $highcolor;
	
	/**
	 * @param string $aLowColor
	 * @param string $aHighColor
	 */
	public function __construct($aLowColor = 'FFFFFF', $aHighColor = '000000'){
		$this->lowcolor = $aLowColor instanceof Color ? $aLowColor : new Color($aLowColor);
		$this->highcolor = $aHighColor instanceof Color ? $aHighColor : new Color($aHighColor);
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
		
		$imgK=imagecreatetruecolor($width,$height);

		$lowR = $this->lowcolor->getRed();
		$lowG = $this->lowcolor->getGreen();
		$lowB = $this->lowcolor->getBlue();
		
		$highR = $this->highcolor->getRed();
		$highG = $this->highcolor->getGreen();
		$highB = $this->highcolor->getBlue();
		
		for($y=0;$y<$height;$y++){
		  for($x=0;$x<$width;$x++){
		    $rgb = imagecolorat($aResource->getResource(), $x, $y);
		    $r = ($rgb >> 16) & 0xFF;
		    $g = ($rgb >> 8) & 0xFF;
		    $b = $rgb & 0xFF;
		    $bw=$r+$g+$b>300?imagecolorallocate($imgK,$lowR,$lowG,$lowB):imagecolorallocate($imgK,$highR,$highG,$highB);
		    imagesetpixel($imgK,$x,$y,$bw);
		  }
		}
		
		$aResource->setResource($imgK);
	}
}