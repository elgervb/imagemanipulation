<?php
namespace imagemanipulation\filter;

use imagemanipulation\ImageResource;
use imagemanipulation\filter\IImageFilter;
/**
 * Applies gamma correction
 */
class ImageFilterGammaCorrection implements IImageFilter
{
	private $input;
	private $output;
	
	public function __construct($aInput = 1.0, $aOutput = 1.537){
		$this->input = $aInput;
		$this->output = $aOutput;
	}
	/**
	 * Applies the filter to the resource
	 *
	 * @param ImageResource $aResource
	 */
	public function applyFilter( ImageResource $aResource )
	{
		imagegammacorrect($aResource->getResource(), $this->input, $this->output);
	}
}