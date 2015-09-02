<?php

/**
 * Includes and class loading
 */
include __DIR__ . '/../vendor/composer/ClassLoader.php';
use imagemanipulation\color\Color;
use imagemanipulation\ImageBuilder;
$loader = new \Composer\Autoload\ClassLoader();
$loader->add('imagemanipulation', __DIR__.'/../imagemanipulation');

// activate the autoloader
$loader->register();
$loader->setUseIncludePath(true);

/*
 * Test Overlay
 */
// $builder = new ImageBuilder(new \SplFileInfo(__DIR__ . '/sample.png'));
// $builder->overlay(__DIR__ . '/../imagemanipulation/overlay/img/vignette.png', 90, 0, 0, true);
// $builder->save(new \SplFileInfo('\tmp\sample_png.png'));

// $builder = new ImageBuilder(new \SplFileInfo(__DIR__ . '/sample.png'));
// $builder->overlay(__DIR__ . '/../imagemanipulation/overlay/img/vignette.jpg', 50, 0, 0, true);
// $builder->save(new \SplFileInfo('\tmp\sample_jpg.png'));

// ImageBuilder::create('UglyDog.png')
//     ->contrast(10)
//     ->truecolor('fff', '00B0BA')
//     ->save(new \SplFileInfo('/tmp/result'.time().'.png'), true);

// echo 'done!';



ImageBuilder::create(new \SplFileInfo(__DIR__ . '/sample.png'))
    ->roundedCorners(300, 'ffffff')
    ->save(new \SplFileInfo('/tmp/result'.time().'.png'), true);

    echo 'done!';