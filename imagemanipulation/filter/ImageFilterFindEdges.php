<?php
namespace imagemanipulation\filter;

class ImageFilterFindEdges extends ImageFilterConvolution
{
	public function __construct()
	{
		parent::__construct( 0.0, 1.0, 0.0, 1.0, - 4.0, 1.0, 0.0, 1.0, 0.0 ); // findEdges
	}
}