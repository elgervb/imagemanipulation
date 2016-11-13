<?php
namespace imagemanipulation\rasterize\strategy;

use mocks\MockImageResource;

class CenterRasterStrategyTest extends \PHPUnit_Framework_TestCase {
    
    public function testCenter() {
        $strategy = new CenterRasterStrategy(100, 100);
        
        $raster = $strategy->createRaster(new MockImageResource(200, 200));
        
        $this->assertEquals(1, $raster->count());
    }
}
