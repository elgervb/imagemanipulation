<?php
namespace imagemanipulation\filter;

use imagemanipulation\ImageResource;

/**
 * Line detection
 */
class ImageFilterSobelVertical extends ImageFilterConvolution
{
	public function __construct()
	{
	    parent::__construct(-1, 0, 1, -2, 0 , 2, -1, 0, 1); // 5
	}
	
	protected function beforeApplyFilter(ImageResource $aResource) {
	    $aResource->filter(new ImageFilterGrayScale());
	}
	
	protected function afterApplyFilter(ImageResource $aResource) {
	    $aResource->filter(new ImageFilterNegative());
	}
	
	protected function getDivision() {
	    return .01;
	}
	
	protected function getOffset() {
	    return 0;
	}
}