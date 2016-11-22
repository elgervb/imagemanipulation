<?php
namespace imagemanipulation\filter;

/**
 * Embosses the image with coloring
 */
class ImageFilterEmbossColoring extends ImageFilterConvolution
{
    
    public function __construct() {
        parent::__construct(1, 1, -1, 1, 1, -1, 1, -1, -1);
    }
}