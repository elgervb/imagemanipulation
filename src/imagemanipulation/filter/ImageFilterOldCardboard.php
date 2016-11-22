<?php
namespace imagemanipulation\filter;


use imagemanipulation\filter\ImageFilterConvolution;
use imagemanipulation\filter\IImageFilter;
/**
 * Image filter to give the image an old cardboard look
 */
class ImageFilterOldCardboard extends ImageFilterConvolution implements IImageFilter
{
	
	public function __construct(){
		parent::__construct(-1, 0, 1, -2, 0, 2, -1, 0, 1);
	}
}