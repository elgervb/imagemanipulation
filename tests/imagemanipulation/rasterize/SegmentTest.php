<?php
namespace imagemanipulation\rasterize;

class SegmentTest extends \PHPUnit_Framework_TestCase {
    
    private $segment;
    /**
     * {@inheritDoc}
     * @see PHPUnit_Framework_TestCase::setUp()
     */
    public function setUp() {
        $this->segment = new Segment(0, 10, 100, 110);
    }
    
    public function testXY() {
        $this->assertEquals(100, $this->segment->getWidth());
        $this->assertEquals(110, $this->segment->getHeight());
    }
    
    public function testCoordinate() {
        $this->assertEquals(0, $this->segment->getCoordinate()->getX());
        $this->assertEquals(10, $this->segment->getCoordinate()->getY());
    }
}