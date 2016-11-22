<?php
namespace imagemanipulation\filter;

use imagemanipulation\ImageResource;

/**
 * Sobel edge detect
 */
class ImageFilterSobelEdgeEnhance extends ImageFilterConvolution
{
	public function __construct()
	{
		parent::__construct( 0,0,0, -1,1,0, 0,0,0	); // edge enhance
	}
	
	public function applyFilter(ImageResource $aResource){
		parent::applyFilter($aResource);
	}
}