<?php
use imagemanipulation\ImageImageResource;
use imagemanipulation\ImageType;
use imagemanipulation\rotate\ImageFilterRotate;

// create the image resource
$resource = new ImageImageResource(new \SplFileInfo(__DIR__ . DIRECTORY_SEPARATOR . 'uglydog.png'));

// rotate the image by 45 degrees and fill missing background with #0190D2
$resource->filter(new ImageFilterRotate(45, '#0190D2'));

// render the image
$resource->render(ImageType::PNG, 80);
