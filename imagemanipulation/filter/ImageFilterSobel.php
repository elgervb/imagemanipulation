<?php
namespace imagemanipulation\filter;

use imagemanipulation\ImageResource;

/**
 * Line detection
 */
class ImageFilterSobel extends ImageFilterConvolution
{
	public function __construct()
	{
	    parent::__construct(1,2,1,0,0,0,-1,-2,-1);
	}
	
	
	protected function beforeApplyFilter(ImageResource $aResource) {
	    $aResource->filter(new ImageFilterGrayScale());
	}
	
	protected function afterApplyFilter(ImageResource $aResource) {
	    $aResource->filter(new ImageFilterNegative());
	}
	
	protected function getDivision() {
	    return .2;
	}
	
	protected function getOffset() {
	    return 512;
	}
}