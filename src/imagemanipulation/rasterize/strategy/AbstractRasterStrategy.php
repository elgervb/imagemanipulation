<?php
namespace imagemanipulation\rasterize\strategy;

use imagemanipulation\ImageResource;

abstract class AbstractRasterStrategy {
    
    /**
     * Create a new raster from a image resource
     * 
     * @param ImageResource $resource
     * 
     * @return \imagemanipulation\rasterize\ImageRaster
     */
    public abstract function createRaster(ImageResource $resource);
}
