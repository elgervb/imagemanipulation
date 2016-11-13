<?php
namespace imagemanipulation\rasterize\strategy;

use imagemanipulation\ImageResource;
use imagemanipulation\rasterize\ImageRaster;
use imagemanipulation\rasterize\Segment;
use imagemanipulation\Args;

class GridRasterStrategy extends AbstractRasterStrategy {
    
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
        $x = $y = 0;
        
        while ($x <= $resource->getWidth() && $y <= $resource->getHeight()) {
            $segment = new Segment($x, $y, min([$this->width, $resource->getWidth() - $x]), min([$this->height, $resource->getHeight() - $y]));
            $raster->addSegment($segment);
            
            // new row
            if ($x + $this->width >= $resource->getWidth()) {
                $x = 0;
                $y += $this->height;
            } else {
               $x += $this->width;
            }
            
            if ($y >= $resource->getHeight()) {
                return $raster;
            }
            
        }
        
        return $raster;
    }
    
    private function calculatePercentage(ImageResource $resource) {
        assert ($this->isPercentage === true);
        
        $this->height = ($resource->getHeight() / 100) * $this->height;
        $this->width = ($resource->getWidth() / 100) * $this->width;
    }
}
