<?php
namespace imagemanipulation\thumbnail\pixelstrategy;


class PercentagePixelStrategyTest extends \ImagemanipulationTestCase{

    public function testCreatWithNumeric(){
        $s = new PercentagePixelStrategy("50"); // this should work
    }
}