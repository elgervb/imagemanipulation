<?php

use imagemanipulation\rasterize\Rasterizer;
use imagemanipulation\rasterize\strategy\GridRasterStrategy;
use imagemanipulation\filter\ImageFilterGrayScale;
use imagemanipulation\ImageType;

const EVEN = 0;
const ODD = 1;

$rasterizer = new Rasterizer(
        new \SplFileInfo(__DIR__ . DIRECTORY_SEPARATOR . 'uglydog.png'), 
        new GridRasterStrategy(10, 10, true)
    );
$filter = new ImageFilterGrayScale();

// create a checkers board
foreach ($rasterizer->getSegments() as $i => $segment) {
    $check = floor($i / 10) % 2 ? ODD : EVEN; // 10 segments per row
    
    if ($i % 2 === $check) {
        $resource = $rasterizer->createResource($segment);
        $resource->filter($filter);
        $rasterizer->writeSegment($resource, $segment);
    }
}

$rasterizer->getResource()->render(ImageType::PNG, 80);
