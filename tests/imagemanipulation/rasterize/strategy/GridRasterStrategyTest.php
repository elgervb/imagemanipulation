<?php
namespace imagemanipulation\rasterize\strategy;

use mocks\MockImageResource;

class GridRasterStrategyTest extends \PHPUnit_Framework_TestCase {
    
    public function testFit4() {
        $strategy = new GridRasterStrategy(100, 100);
        
        $raster = $strategy->createRaster(new MockImageResource(200, 200));
        
        $this->assertEquals(4, $raster->count());
    }
    
    public function testFit4Percentage() {
        $strategy = new GridRasterStrategy(50, 50, true);
    
        $raster = $strategy->createRaster(new MockImageResource(200, 200));
    
        $this->assertEquals(4, $raster->count());
    }
    
    public function testFit1() {
        $strategy = new GridRasterStrategy(100, 100);
    
        $raster = $strategy->createRaster(new MockImageResource(100, 100));
    
        $this->assertEquals(1, $raster->count());
    }
    
    public function testPartial1() {
        $strategy = new GridRasterStrategy(100, 100);
    
        $raster = $strategy->createRaster(new MockImageResource(99, 99));
    
        $this->assertEquals(1, $raster->count());
    }
    
    public function testPartialLarger() {
        $strategy = new GridRasterStrategy(100, 100);
    
        $raster = $strategy->createRaster(new MockImageResource(101, 101));
    
        $this->assertEquals(4, $raster->count());
    }
    
    public function testPartialSmaller() {
        $strategy = new GridRasterStrategy(100, 100);
    
        $raster = $strategy->createRaster(new MockImageResource(199, 199));
    
        $this->assertEquals(4, $raster->count());
    }
}