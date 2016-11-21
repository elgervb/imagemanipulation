<?php
namespace imagemanipulation\filter;

use imagemanipulation\ImageResource;

/**
 * Line detection
 */
class ImageFilterSobelScharr extends ImageFilterConvolution
{
	public function __construct()
	{
	    parent::__construct(3,10,3,0,0,0,-3,-10,-3); 
	}
	
	protected function beforeApplyFilter(ImageResource $aResource) {
	    $aResource->filter(new ImageFilterGrayScale());
	}
	
	protected function getDivision() {
	    return .2;
	}
	
	protected function getOffset() {
	    return 2048;
	}
}