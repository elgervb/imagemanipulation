<?php
namespace imagemanipulation\filter;
class ImageFilterSharpen extends ImageFilterConvolution
{
	public function __construct()
	{
		parent::__construct( - 1, - 1, - 1, - 1, 16, - 1, - 1, - 1, - 1 ); // sharpen
	}
}