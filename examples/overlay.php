<?php
use imagemanipulation\overlay\ImageFilterOverlay;
use imagemanipulation\ImageImageResource;
use imagemanipulation\ImageType;

// create the image resource
$resource = new ImageImageResource(new \SplFileInfo(__DIR__ . DIRECTORY_SEPARATOR . 'uglydog.png'));
$overlayResource = new ImageImageResource(new \SplFileInfo(__DIR__ . DIRECTORY_SEPARATOR . 'monkey.png'));

$overlay = new ImageFilterOverlay(
    $overlayResource,
    20,
    0,
    0,
    true
);

$resource->filter($overlay);
$resource->imageoutput(null, ImageType::PNG, 80);

