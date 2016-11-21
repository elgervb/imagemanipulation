<?php

use imagemanipulation\ImageImageResource;
use imagemanipulation\filter\ImageFilterSobelEdgeDetect;
use imagemanipulation\ImageType;
use imagemanipulation\filter\ImageFilterSobelEdgeEnhance;
use imagemanipulation\filter\ImageFilterNegative;
use imagemanipulation\filter\ImageFilterLineDetection;
use imagemanipulation\filter\ImageFilterGrayScale;

// create the image resource
$resource = new ImageImageResource(new \SplFileInfo(__DIR__ . DIRECTORY_SEPARATOR . 'uglydog.jpg'));

$filter = new ImageFilterLineDetection();
$resource->filter($filter);

$resource->save(__DIR__ . DIRECTORY_SEPARATOR . get_class($filter) . '6.png', ImageType::PNG, 80);
$resource->render(ImageType::PNG, 80);
