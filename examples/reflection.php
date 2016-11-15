<?php

use imagemanipulation\ImageImageResource;
use imagemanipulation\reflection\ImageFilterReflection;
use imagemanipulation\ImageType;

$resource = new ImageImageResource(new \SplFileInfo(__DIR__ . DIRECTORY_SEPARATOR . 'uglydog.png'));
$resource->filter(new ImageFilterReflection(300));

$resource->imageoutput(null, ImageType::PNG, 80);
