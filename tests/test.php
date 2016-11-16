<?php

/**
 * Includes and class loading
 */
include __DIR__ . '/../vendor/composer/ClassLoader.php';
use imagemanipulation\color\Color;
use imagemanipulation\ImageBuilder;
use imagemanipulation\generation\ImageGenerator;
$loader = new \Composer\Autoload\ClassLoader();
$loader->add('imagemanipulation', __DIR__.'/..');

// activate the autoloader
$loader->register();
$loader->setUseIncludePath(true);

/**
 * https://github.com/elgervb/imagemanipulation/issues/23
 */
ImageBuilder::create(new \SplFileInfo(__DIR__ . '/sample.png'))
        ->semiGrayscale(60)
        ->render();

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


/*// Test Rounded corners
ImageBuilder::create(new \SplFileInfo(__DIR__ . '/sample.png'))
    ->roundedCorners(300, 'ffffff')
    ->save(new \SplFileInfo('/tmp/result'.time().'.png'), true);
    echo 'done!';
*/

// // Test img generation
// $res = ImageGenerator::create(250, 750, new Color('ff00ff', 100));
// $res->save('/tmp/result'.time().'.png');


// Test gradient
// $res = ImageGenerator::gradient(500, 500, 0, new Color('0000ff'), new Color('ff0000'));
// $res->save('/tmp/result'.time().'.png');

// Test vignettes
// for ($i=1; $i<=12; $i++){
//     $file = '/tmp/OTF_Vignette_'.($i<=9?'0'.$i:$i).'.png';
//     ImageBuilder::create('rascal.jpg')
//         ->overlay($file)
//         ->save(new \SplFileInfo('/tmp/result'.time().'.png'), true);
    
//     echo 'Generating ' . $file . "\n";
// }
// echo 'done!';

