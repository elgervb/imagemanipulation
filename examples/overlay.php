<?php

use imagemanipulation\overlay\ImageFilterOverlay;
use imagemanipulation\ImageImageResource;
use imagemanipulation\ImageType;


$resource = new ImageImageResource(new \SplFileInfo(__DIR__ . DIRECTORY_SEPARATOR . 'uglydog.png'));
$overlayResource = new ImageImageResource(new \SplFileInfo(__DIR__ . DIRECTORY_SEPARATOR . 'monkey.png'));

$overlay = new ImageFilterOverlay(
    $overlayResource,
    30,
    $resource->getWidth() / 2 - $overlayResource->getWidth() / 2,
    $resource->getHeight() / 2 - $overlayResource->getHeight() / 2,
    false
);

$resource->filter($overlay);
$resource->imageoutput(null, ImageType::PNG, 80);
