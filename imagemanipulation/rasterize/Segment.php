<?php
namespace imagemanipulation\rasterize;

use imagemanipulation\Coordinate;

class Segment {
    
    private $coordinate;
    private $width;
    private $height;
    
    public function __construct($x, $y, $width, $height) {
        $this->coordinate = new Coordinate($x, $y);
        $this->width = $width;
        $this->height = $height;
    }
    
    public function getCoordinate() {
        return $this->coordinate;
    }
    
    public function getHeight() {
        return $this->height;
    }
    
    public function getWidth() {
        return $this->width;
    }
}
