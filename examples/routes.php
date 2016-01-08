<?php

use imagemanipulation\ImageBuilder;

require_once '../vendor/autoload.php';


$path = $_SERVER["REQUEST_URI"];
$paths = explode("/", $path);
$method = str_replace('.png', '', $paths[1]);

$b = ImageBuilder::create(__DIR__ . '/uglydog.png')->thumbPercentage(50);

if (preg_match('/\.(?:png|jpg|jpeg|gif)$/', $path)) {
    if ($path == "/uglydog.png"){
        return false;    // serve the requested resource as-is
    }
    
    return call_user_func_array(array($b, $method), array_slice($paths, 2))->render();
      
}
?>
<p>
    <a href="brightness.png">brightness</a>
    <a href="colorize.png">colorize</a>
    <a href="comic.png">comic</a>
    <a href="contrast.png">contrast</a>
    <a href="darken.png">darken</a>
    <a href="dodge.png">dodge</a>
    <a href="duotone.png">duotone</a>
    <a href="edgeDetect.png">edgeDetect</a>
    <a href="emboss.png">emboss</a>
    <a href="flip.png">flip</a>
    <a href="findEdges.png">findEdges</a>
    <a href="gammaCorrection.png">gammaCorrection</a>
    <a href="gaussianBlur.png">gaussianBlur</a>
    <a href="grayscale.png">grayscale</a>
    <a href="hueRotate.png">hueRotate</a>
    <a href="meanremove.png">meanremove</a>
    <a href="motionBlur.png">motionBlur</a>
    <a href="negative.png">negative</a>
    <a href="noise.png">noise</a>
    <a href="oldCardboard.png">oldCardboard</a>
    <a href="opacity.png">opacity</a>
    <a href="pixelate.png">pixelate</a>
    <a href="randomBlocks.png">randomBlocks</a>
    <a href="rotate.png">rotate</a>
    <a href="roundedCorners.png">roundedCorners</a>
    <a href="scatter.png">scatter</a>
    <a href="selectiveBlur.png">selectiveBlur</a>
    <a href="semiGrayscale.png">semiGrayscale</a>
    <a href="sepia.png">sepia</a>
    <a href="sepiaFast.png">sepiaFast</a>
    <a href="sharpen.png">sharpen</a>
    <a href="smooth.png">smooth</a>
    <a href="sobelEdgeDetect.png">sobelEdgeDetect</a>
    <a href="sobelEdgeEnhance.png">sobelEdgeEnhance</a>
    <a href="truecolor.png">truecolor</a>
    <a href="vignette.png">vignette</a>
</p>
