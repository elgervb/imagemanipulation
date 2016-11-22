<?php
namespace imagemanipulation\filter;

/**
 * Motion blurs the image
 **/
class ImageFilterMotionBlur extends ImageFilterConvolution
{
	public function __construct()
	{
		parent::__construct( 0,0,1,0,0,0,1,0,0 ); // sharpen
	}
}