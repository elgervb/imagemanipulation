<?php
namespace imagemanipulation\thumbnail\pixelstrategy;


class CenteredPixelStrategyTest extends \ImagemanipulationTestCase{

    public function testCreatWithNumeric(){
        $s = new CenteredPixelStrategy("250", "250"); // this should work
    }
}