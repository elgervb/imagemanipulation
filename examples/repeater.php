<?php
use imagemanipulation\ImageImageResource;
use imagemanipulation\ImageType;
use imagemanipulation\repeater\ImageRepeater;
use imagemanipulation\thumbnail\Thumbalizer;
use imagemanipulation\thumbnail\pixelstrategy\PercentagePixelStrategy;

// create the image resource
$resource = new ImageImageResource(new \SplFileInfo(__DIR__ . DIRECTORY_SEPARATOR . 'uglydog.png'));

// make the image a bit smaller before repeating it
$thumb = new Thumbalizer(new PercentagePixelStrategy(50));
$smallResource = $thumb->create($resource);

// create a grid of 2 x 2 ugly dogs
$repeater = new ImageRepeater($smallResource, $smallResource->getWidth() * 2, $smallResource->getHeight() * 2);
$repeated = $repeater->apply();

$repeated->imageoutput(null, ImageType::PNG, 80);

