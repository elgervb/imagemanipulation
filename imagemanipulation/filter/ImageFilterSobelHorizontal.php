<?php
namespace imagemanipulation\filter;

use imagemanipulation\ImageResource;

/**
 * Line detection
 */
class ImageFilterSobelHorizontal extends ImageFilterConvolution
{
	public function __construct()
	{
	    // sobel horizontal
	    parent::__construct(-1, -2, -1, 0, 0, 0, 1, 2, 1); //4
	}
	
	protected function beforeApplyFilter(ImageResource $aResource) {
	    $aResource->filter(new ImageFilterGrayScale());
	}
	
	protected function afterApplyFilter(ImageResource $aResource) {
	    $aResource->filter(new ImageFilterNegative());
	}
	
	protected function getDivision() {
	    return -.5;
	}
	
	protected function getOffset() {
	    return 0;
	}
}