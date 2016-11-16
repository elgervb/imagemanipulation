<?php
use imagemanipulation\ImageImageResource;
use imagemanipulation\reflection\ImageFilterReflection;
use imagemanipulation\ImageType;

// create the image resource
$resource = new ImageImageResource(new \SplFileInfo(__DIR__ . DIRECTORY_SEPARATOR . 'uglydog.png'));
$resource->filter(new ImageFilterReflection(300));

$resource->render(null, ImageType::PNG, 80);
