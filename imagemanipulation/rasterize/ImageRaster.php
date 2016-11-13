<?php
namespace imagemanipulation\rasterize;

/**
 * 
 */
class ImageRaster {
    private $segments;
    
    /**
     * 
     */
    public function __construct() {
        $this->segments = new \ArrayObject();
    }
    
    /**
     * 
     * @param Segment $segment
     */
    public function addSegment(Segment $segment) {
        $this->segments->append($segment);
    }
    
    /**
     * 
     * @return number
     */
    public function count() {
        return $this->segments->count();
    }
    
    /**
     * 
     * @return \ArrayObject
     */
    public function getSegments() {
        return $this->segments;
    }
}
