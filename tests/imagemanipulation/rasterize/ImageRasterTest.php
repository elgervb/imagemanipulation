<?php
namespace imagemanipulation\rasterize;

class ImageRasterTest extends \PHPUnit_Framework_TestCase {
    
    private function createRaster() {
        $raster = new ImageRaster();
        $raster->addSegment(new Segment(0, 0, 100, 100));
        $raster->addSegment(new Segment(100, 0, 100, 100));
        $raster->addSegment(new Segment(0, 100, 100, 100));
        $raster->addSegment(new Segment(100, 100, 100, 100));
        
        return $raster;
    }
    
    public function testCount() {
        $raster = $this->createRaster();
        
        $this->assertEquals(4, $raster->count());
    }
}