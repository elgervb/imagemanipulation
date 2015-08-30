<?php
namespace imagemanipulation\filter;

/**
 * Find the edges in an image without color loss
 * @author elger
 *
 */
class ImageFilterFindEdges extends ImageFilterConvolution
{
	public function __construct()
	{
		parent::__construct( 0.0, 1.0, 0.0, 1.0, - 4.0, 1.0, 0.0, 1.0, 0.0 ); // findEdges
	}
}