<?php
namespace imagemanipulation\rasterize;

use imagemanipulation\rasterize\strategy\AbstractRasterStrategy;
use imagemanipulation\ImageImageResource;
use imagemanipulation\ImageUtil;
use imagemanipulation\filter\IImageFilter;
use imagemanipulation\ImageResource;

class Rasterizer {
    
    private $resource;
    /**
     * @var \imagemanipulation\rasterize\ImageRaster
     */
    private $raster;
    
    public function __construct(\SplFileInfo $image, AbstractRasterStrategy $strategy) {
        $this->resource = new ImageImageResource($image);
        $this->raster = $strategy->createRaster($this->resource);
    }
    
    public function getSegments() {
        return $this->raster->getSegments();
    }
    
    public function filter(IImageFilter $filter, Segment $segment) {
        $resource = new ImageResource(ImageUtil::createImage($segment->getWidth(), $segment->getHeight()));
        imagecopy(
            $resource->getResource(), $this->resource->getResource(), 
            0 ,0, // dest img
            $segment->getCoordinate()->getX(), $segment->getCoordinate()->getY(), // src img
            $segment->getWidth(), $segment->getHeight() // src dimensions
        );
        
        $resource->filter($filter);
        
        imagecopy(
            $this->resource->getResource(), $resource->getResource(), 
            $segment->getCoordinate()->getX(), $segment->getCoordinate()->getY(), // dest img
            0, 0, // src img
            $segment->getWidth(), $segment->getHeight() // src dimensions
        );
    }
    
    public function getResource() {
        return $this->resource;
    }
    
    public function save($path, $type) {
        $this->resource->imageoutput($path, $type);
    }
}