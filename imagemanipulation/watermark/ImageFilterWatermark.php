<?php
namespace imagemanipulation\watermark;

use imagemanipulation\ImageResource;
use imagemanipulation\color\ColorUtil;
use imagemanipulation\filter\IImageFilter;
use imagemanipulation\ImageImageResource;
use imagemanipulation\filter\ImageFilterOpacity;
/**
 * Apply watermark to the image
 */
class ImageFilterWatermark implements IImageFilter
{
	const POS_TOP_RIGHT= 'top-right';
	const POS_TOP_LEFT= 'top-left';
	const POS_BOTTOM_RIGHT= 'bottom-right';
	const POS_BOTTOM_LEFT= 'bottom-left';
	const POS_CENTER= 'center';
	const POS_LEFT= 'left';
	const POS_RIGHT= 'right';
	const POS_TOP= 'top';
	const POS_BOTTOM = 'bottom';
	
	private $watermark;
	private $position;
	private $watermarkOpacity;
	
	/**
	 * Creates a new filter for watermarking an image
	 * 
	 * @param \SplFileInfo $aWatermark The full path to a watermark image
	 * @param string $aPosition The position where to place the watermark. Use the POS_* constants
	 * @param string $aWatermarkOpacity [optional] The opacity of the watermark image.
	 */
	public function __construct(\SplFileInfo $aWatermark, $aPosition = 'bottom-right', $aWatermarkOpacity=null){
		$this->watermark = $aWatermark;
		$this->position = $aPosition;
		$this->watermarkOpacity = $aWatermarkOpacity;
	}
	
    /**
     * (non-PHPdoc)
     * @see \imagemanipulation\filter\IImageFilter::applyFilter()
     */
	public function applyFilter( ImageResource $aResource )
	{
		$watermarkRes = new ImageImageResource($this->watermark);
		
		imagealphablending($aResource->getResource(),true);
		imagealphablending($watermarkRes->getResource(),true);
		
		if ($this->position == 'random') {
			$this->position = rand(1,8);
		}
		
		if ($this->watermarkOpacity){
			$opacityFilter = new ImageFilterOpacity( $this->watermarkOpacity );
			$opacityFilter->applyFilter($watermarkRes);
		}
		
		$destWidth = $aResource->getX();
		$destHeight = $aResource->getY();
		
		$watermarkWidth = $watermarkRes->getX();
		$watermarkHeight = $watermarkRes->getY();
		
		switch ($this->position) {
			case 'top-right':
			case 'right-top':
			case 1:
				$result = imagecopy($aResource->getResource(), $watermarkRes->getResource(), ($destWidth-$watermarkWidth), 0, 0, 0, $watermarkWidth, $watermarkHeight);
			break;
			case 'top-left':
			case 2:
				$result = imagecopy($aResource->getResource(), $watermarkRes->getResource(), 0, 0, 0, 0, $watermarkWidth, $watermarkHeight);
				break;
			case 'bottom-right':
			case 3:
				$result = imagecopy($aResource->getResource(), $watermarkRes->getResource(), ($destWidth-$watermarkWidth), ($destHeight-$watermarkHeight), 0, 0, $watermarkWidth, $watermarkHeight);
				break;
			case 'bottom-left':
			case 4:
				$result = imagecopy($aResource->getResource(), $watermarkRes->getResource(), 0 , ($destHeight-$watermarkHeight), 0, 0, $watermarkWidth, $watermarkHeight);
				break;
			case 'center':
			case 5:
				$result = imagecopy($aResource->getResource(), $watermarkRes->getResource(), (($destWidth/2)-($watermarkWidth/2)), (($destHeight/2)-($watermarkHeight/2)), 0, 0, $watermarkWidth, $watermarkHeight);
				break;
			case 'top':
			case 6:
				$result = imagecopy($aResource->getResource(), $watermarkRes->getResource(), (($destWidth/2)-($watermarkWidth/2)), 0, 0, 0, $watermarkWidth, $watermarkHeight);
				break;
			case 'bottom':
			case 7:
				$result = imagecopy($aResource->getResource(), $watermarkRes->getResource(), (($destWidth/2)-($watermarkWidth/2)), ($destHeight-$watermarkHeight), 0, 0, $watermarkWidth, $watermarkHeight);
				break;
			case 'left':
			case 8:
				$result = imagecopy($aResource->getResource(), $watermarkRes->getResource(), 0, (($destHeight/2)-($watermarkHeight/2)), 0, 0, $watermarkWidth, $watermarkHeight);
				break;
			case 'right':
			case 9:
				$result = imagecopy($aResource->getResource(), $watermarkRes->getResource(), ($destWidth-$watermarkWidth), (($destHeight/2)-($watermarkHeight/2)), 0, 0, $watermarkWidth, $watermarkHeight);
				break;

			imagedestroy($watermarkRes->getResource());
			if (!$result){
				throw new \Exception('Applying watermark failed');
			}
		}
	}
}