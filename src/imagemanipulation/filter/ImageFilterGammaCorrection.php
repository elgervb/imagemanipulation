<?php
namespace imagemanipulation\filter;

use imagemanipulation\ImageResource;
use imagemanipulation\filter\IImageFilter;
use imagemanipulation\Args;
/**
 * Apply gamma correction
 */
class ImageFilterGammaCorrection implements IImageFilter
{
	private $input;
	private $output;
	
	public function __construct($input = 1.0, $output = 1.537){
	    $this->input = Args::float($input, 'input')->required()->min(0)->value();
		$this->output = Args::float($output, 'output')->required()->min(0)->value();
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