<?php
namespace imagemanipulation\rasterize;

use imagemanipulation\rasterize\strategy\AbstractRasterStrategy;
use imagemanipulation\ImageImageResource;
use imagemanipulation\ImageUtil;
use imagemanipulation\filter\IImageFilter;
use imagemanipulation\ImageResource;
use imagemanipulation\ImageResourceException;

class Rasterizer {
    
    private $resource;
    /**
     * @var \imagemanipulation\rasterize\ImageRaster
     */
    private $raster;
    
    /**
     * Create a new rasterizer from an image
     * @param \SplFileInfo $image the image to create from
     * @param AbstractRasterStrategy $strategy define the raster
     */
    public function __construct(\SplFileInfo $image, AbstractRasterStrategy $strategy) {
        $this->resource = new ImageImageResource($image);
        $this->raster = $strategy->createRaster($this->resource);
    }
    
    /**
     * Returns all the segments
     * @return ArrayObject
     */
    public function getSegments() {
        return $this->raster->getSegments();
    }
    
    /**
     * Apply a filter on the location of a segment
     * 
     * @param IImageFilter $filter the filter to apply
     * @param Segment $segment the location to apply the filter on
     * 
     * @return Rasterizer for chaining
     */
    public function filter(IImageFilter $filter, Segment $segment) {
        $resource = $this->createResource($segment);
        
        $resource->filter($filter);
        
        $this->writeSegment($resource, $segment);
        
        return $this;
    }
    
    /**
     * Create a new resource from the location of the segment
     * 
     * @param Segment $segment
     * 
     * @return \imagemanipulation\ImageResource
     */
    public function createResource(Segment $segment) {
        $resource = new ImageResource(ImageUtil::createImage($segment->getWidth(), $segment->getHeight()));
        
        imagecopy(
            $resource->getResource(), $this->resource->getResource(),
            0 ,0, // dest img
            $segment->getCoordinate()->getX(), $segment->getCoordinate()->getY(), // src img
            $segment->getWidth(), $segment->getHeight() // src dimensions
        );
        
        return $resource;
    }
    
    /**
     * Write the resource back to it's owner 
     * @param ImageResource $resource
     * @param Segment $segment
     * @throws ImageResourceException when segment's dimensions do not match resource dimensions
     */
    public function writeSegment(ImageResource $resource, Segment $segment) {
        if ($resource->getWidth() !== $segment->getWidth() || $resource->getHeight() !== $segment->getHeight()) {
            throw new ImageResourceException("Dimensions of resource and segment differ");
        }
        
        imagecopy(
            $this->resource->getResource(), $resource->getResource(),
            $segment->getCoordinate()->getX(), $segment->getCoordinate()->getY(), // dest img
            0, 0, // src img
            $segment->getWidth(), $segment->getHeight() // src dimensions
            );
    }
    
    /**
     * Returns the underlying resource of the whole image
     * 
     * @return \imagemanipulation\ImageImageResource
     */
    public function getResource() {
        return $this->resource;
    }
}