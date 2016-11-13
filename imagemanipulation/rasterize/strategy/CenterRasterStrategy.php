<?php
namespace imagemanipulation\rasterize\strategy;

use imagemanipulation\ImageResource;
use imagemanipulation\rasterize\ImageRaster;
use imagemanipulation\rasterize\Segment;
use imagemanipulation\Args;

/**
 * Creates a segment at the center of the image
 * @author e.vanboxtel
 *
 */
class CenterRasterStrategy {
    
    private $width;
    private $height;
    private $isPercentage;
    
    public function __construct($width, $height, $isPercentage = false) {
        if ($isPercentage) {
            Args::int($width, 'width')->min(1)->max(100)->required();
            Args::int($height, 'height')->min(1)->max(100)->required();
        } else {
            Args::int($width, 'width')->min(1)->required();
            Args::int($height, 'height')->min(1)->required();
        }
        
        $this->width = $width;
        $this->height = $height;
        $this->isPercentage = $isPercentage;
    }
    
    public function createRaster(ImageResource $resource) {
        if ($this->isPercentage) {
            $this->calculatePercentage($resource);
        }
        
        $raster = new ImageRaster();
        $segment = new Segment($resource->getWidth() - ($this->width / 2), $resource->getHeight() - ($this->height / 2), $this->width, $this->height);
        $raster->addSegment($segment);
        
        return $raster;
    }
    
    private function calculatePercentage(ImageResource $resource) {
        assert ($this->isPercentage === true);
        
        $this->height = ($resource->getHeight() / 100) * $this->height;
        $this->width = ($resource->getWidth() / 100) * $this->width;
    }
}
