<?php
namespace imagemanipulation\filter;

use imagemanipulation\ImageResource;

use imagemanipulation\filter\ImageFilterConvolution;
/**
 * Sobel edge detect
 */
class ImageFilterSobelEdgeEnhance extends ImageFilterConvolution
{
	public function __construct()
	{
		parent::__construct( 0.0,0.0,0.0, -1.0,1.0,0.0, 0.0,0.0,0.0	); // edge enhance
	}
	
	public function applyFilter(ImageResource $aResource){
		parent::applyFilter($aResource);
	}
}