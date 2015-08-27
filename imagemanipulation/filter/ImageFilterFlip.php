<?php
namespace imagemanipulation\filter;

use \imagemanipulation\color\ColorFactory;
use imagemanipulation\ImageResource;
/**
 * Flips an image
 */
class ImageFilterFlip implements IImageFilter
{
	const FLIP_BOTH = 0;
	const FLIP_VERTICALLY = 1;
	const FLIP_HORIZONTALLY = 2;
	
	private $horizontal;
	private $vertical;
	
	/**
	 * Creates a new ImageFilterFlip
	 *
	 * @param boolean $aHorizontal Flip horizontal
	 * @param boolean $aVertical Flip vertical
	 *
	 */
	public function __construct( $aHorizontal = true, $aVertical = false )
	{
		$this->horizontal = $aHorizontal;
		$this->vertical = $aVertical;
	}
	
	/**
	 * Applies the filter to the image resource
	 *
	 * @param ImageResource $aResource
	 */
	public function applyFilter( ImageResource $aResource )
	{
		$function = 'imageflip';
		if (function_exists($function))
			$function($aResource->getResource(), $this->getMode());
		else{
			
			$width = $aResource->getX();
			$height = $aResource->getY();
			
			$dest = imagecreatetruecolor($width, $height);
			imagealphablending($dest, false);
			imagesavealpha($dest, true);
			
			switch($this->getMode()) {
				case self::FLIP_VERTICALLY :
					$this->flipVertically($dest, $aResource->getResource(), $height, $width);
					break;
				case self::FLIP_HORIZONTALLY :
					$this->flipHorizontally($dest, $aResource->getResource(), $height, $width);
					break;
				case self::FLIP_BOTH	:
					$this->flipVertically($dest, $aResource->getResource(), $height, $width);
					
					$copy = imagecreatetruecolor($width, $height);
					imagecopy($copy, $dest, 0,0,0,0,$width,$height );
					$this->flipHorizontally($dest, $copy, $height, $width);
					break;
			}
			
			$aResource->setResource($dest);
		}
	}
	
	private function flipHorizontally($aDest, $aRes, $aHeigth, $aWidth){
		for($i = 0; $i < $aWidth; $i++) {
			/**
			 * Here we apply the same logic for other direction
			 * The first column of pixels of the source image
			 * goes to the last column of pixels of the destination image
			 *
			 * So, for the $i -th column of the source
			 * the column of the destination would be
			 * $width - $i - 1
			 */
			imagecopy($aDest, $aRes, ($aWidth - $i - 1), 0, $i, 0, 1, $aHeigth);
		}
	}
	
	private function flipVertically($aDest, $aRes, $aHeigth, $aWidth){
		for($i = 0; $i < $aHeigth; $i++) {
			/**
			 * What we do here is pixel wise row flipping
			 * The first row of pixels of the source image (ie, when $i = 0)
			 * goes to the last row of pixels of the destination image
			 *
			 * So, mathematically, for the row $i of the source image
			 * the corresponding row of the destination should be
			 * $height - $i - 1
			 * -1, because y and x both co-ordinates are calculated from zero
			 */
			imagecopy($aDest, $aRes, 0, ($aHeigth - $i - 1), 0, $i, $aWidth, 1);
		}
	}
	
	/**
	 * Returns the flip mode; either horizontal, vertical or both
	 * 
	 * @return int The flip mode
	 */
	private function getMode(){
		if (function_exists('imageflip')){
			if ($this->horizontal && $this->vertical)
				return IMG_FLIP_BOTH;
			if ($this->vertical)
					return IMG_FLIP_VERTICAL;
			return IMG_FLIP_HORIZONTAL;
		}
		else
		{
			if ($this->horizontal && $this->vertical)
				return self::FLIP_BOTH;
			if ($this->vertical)
				return self::FLIP_VERTICALLY;
			return self::FLIP_HORIZONTALLY;
		}
	}
}