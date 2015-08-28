<?php
namespace imagemanipulation\filter;

use imagemanipulation\color\Color;
use imagemanipulation\ImageResource;
use imagemanipulation\color\ColorUtil;
use imagemanipulation\filter\IImageFilter;
use imagemanipulation\ImageImageResource;

/**
 * Add random blocks to an image with custom size and color
 */
class ImageFilterRandomBlocks implements IImageFilter
{
	/**
	 * @var Color
	 */
	private $blockColor;
	private $blockSize ;
	private $nrOfBlocks;
	
	/**
	 * 
	 * @param number $aNumberOfBlocks The number of blocks
	 * @param number $aBlockSize      The size of the blocks in pixels
	 * @param string $aBlockColor     The color of the blocks
	 */
	public function __construct($aNumberOfBlocks = 100, $aBlockSize = 25, $aBlockColor = 'FFFFFF'){
		$this->blockColor = $aBlockColor instanceof Color ? $aBlockColor : new Color($aBlockColor);
		$this->blockSize = $aBlockSize;
		$this->nrOfBlocks = $aNumberOfBlocks;
	}
	/**
	 * Applies the filter to the resource
	 *
	 * @param ImageResource $aResource
	 */
	public function applyFilter( ImageResource $aResource )
	{
		$width=$aResource->getX();
		$height=$aResource->getY();
		$blockImg=imagecreate(1, 1);
		
		imagecolorallocatealpha($blockImg, $this->blockColor->getRed(), $this->blockColor->getGreen(), $this->blockColor->getBlue(), $this->blockColor->getAlpha());

		for($i=0;$i<=$this->nrOfBlocks;$i++)
		{
			$xPos=rand(0,$width-$this->blockSize-1);
			$yPos=rand(0,$height-$this->blockSize-1);
			imagecopy($aResource->getResource(), $blockImg,  $xPos, $yPos , $xPos, $yPos , $this->blockSize  , $this->blockSize);
		}
	}
}