<?php
namespace imagemanipulation\filter;

use imagemanipulation\color\Color;
use imagemanipulation\ImageResource;
use imagemanipulation\color\ColorUtil;
use imagemanipulation\filter\IImageFilter;
use imagemanipulation\ImageImageResource;
use imagemanipulation\Args;

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
	public function __construct($numberOfBlocks = 100, $blockSize = 25, $blockColor = 'FFFFFF'){
	    
	    $this->nrOfBlocks = Args::int($numberOfBlocks)->required()->min(1)->value();
	    $this->blockSize = Args::int($blockSize)->required()->min(0)->value();
	    // TODO blockcolor can be Object and string... add check to args
	    
		$this->blockColor = $blockColor instanceof Color ? $blockColor : new Color($blockColor);
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