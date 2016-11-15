<?php
use imagemanipulation\ImageBuilder;

$ib = new ImageBuilder(new \SplFileInfo(__DIR__ . DIRECTORY_SEPARATOR . 'uglydog.png'));
$ib->contrast(10)
    ->greyscale()
    ->render(70);