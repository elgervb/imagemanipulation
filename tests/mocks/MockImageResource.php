<?php
namespace mocks;

use imagemanipulation\ImageResource;

class MockImageResource extends ImageResource {
    private $width;
    private $height;
    
    public function __construct($width, $height) {
        $this->width = $width;
        $this->height = $height;
    }
    
    public function getY()
    {
        return $this->getHeight();
    }
    
    public function getHeight() {
        return $this->height;
    }
    
    public function getX()
    {
        return $this->getWidth();
    }
    
    public function getWidth() {
        return $this->width;
    }
}