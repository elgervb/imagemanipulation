<?php

use imagemanipulation\ImageImageResource;
use imagemanipulation\thumbnail\Thumbalizer;
use imagemanipulation\thumbnail\pixelstrategy\CenteredPixelStrategy;
use imagemanipulation\ImageType;

// create the image resource
$resource = new ImageImageResource(new \SplFileInfo(__DIR__ . DIRECTORY_SEPARATOR . 'uglydog.png'));

// create the thumbnail
$thumbalizer = new Thumbalizer(new CenteredPixelStrategy(500, 200));

$thumb = $thumbalizer->create($resource);

// render the thumb
$thumb->render(ImageType::PNG, 80);