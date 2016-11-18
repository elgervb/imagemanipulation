<?php
namespace imagemanipulation\rasterize;

use test\ImagemanipulationTestCase;
use imagemanipulation\ImageType;
use imagemanipulation\filter\ImageFilterGrayScale;
use imagemanipulation\rasterize\strategy\GridRasterStrategy;
use imagemanipulation\color\Color;
use imagemanipulation\color\ColorUtil;
use imagemanipulation\Coordinate;

class RasterizerTest extends ImagemanipulationTestCase {
    
    public function testFilter() {
        $image = $this->getOriginalImage(ImageType::PNG);
        $filter = new ImageFilterGrayScale();
        
        $rasterizer = new Rasterizer($image, new GridRasterStrategy(25, 25, true));
        $segments = $rasterizer->getSegments();
        $rasterizer->filter($filter, $segments->offsetGet(0));
        $rasterizer->filter($filter, $segments->offsetGet(5));
        
        $originalColor = "ff0000";
        $filteredColor = "4c4c4c";
        
        $color = ColorUtil::getColorAt($rasterizer->getResource(), Coordinate::create(50, 50));
        $this->assertEquals($filteredColor, $color->getHexColor());
        
        $color = ColorUtil::getColorAt($rasterizer->getResource(), Coordinate::create(160, 50));
        $this->assertEquals($originalColor, $color->getHexColor());
        
        $color = ColorUtil::getColorAt($rasterizer->getResource(), Coordinate::create(50, 160));
        $this->assertEquals($originalColor, $color->getHexColor());
        
        $color = ColorUtil::getColorAt($rasterizer->getResource(), Coordinate::create(160, 160));
        $this->assertEquals($filteredColor, $color->getHexColor());
    }
    }
