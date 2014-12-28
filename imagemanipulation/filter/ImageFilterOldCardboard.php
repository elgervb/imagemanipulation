<?php
namespace imagemanipulation\filter;


use imagemanipulation\filter\ImageFilterConvolution;
use imagemanipulation\filter\IImageFilter;
/**
 * Test new filters
 */
class ImageFilterOldCardboard extends ImageFilterConvolution implements IImageFilter
{
	
	public function __construct(){
		parent::__construct(-1, 0, 1, -2, 0, 2, -1, 0, 1);
	}
}