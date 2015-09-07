<?php
namespace imagemanipulation\thumbnail\pixelstrategy;


class MaxPixelStrategyTest extends \ImagemanipulationTestCase{

    public function testCreatWithNumeric(){
        $s = new MaxPixelStrategy("300", "500"); // this should work
    }
}