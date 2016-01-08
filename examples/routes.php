<?php
use imagemanipulation\ImageBuilder;
require_once '../vendor/autoload.php';

session_start();

// path without querystring
$path = $_SERVER["REQUEST_URI"];
$index = strpos($path, '?');
if ($index !== false) {
    $path = substr($path, 0, $index);
}

// copy image
$id = sha1(session_id());
$image = 'tmp/'.$id . '.png';
if (!is_file($image)) {
    copy('uglydog.png', $image);
}


if (preg_match('/\.(?:png|jpg|jpeg|gif)$/', $path)) {
    return false;    // serve the requested resource as-is
}



$b = ImageBuilder::create(__DIR__ . DIRECTORY_SEPARATOR . $image);


if($path == '/clear') {
    copy('uglydog.png', $image);
    $b = ImageBuilder::create(__DIR__ . DIRECTORY_SEPARATOR . $image);
    header('Location: /');
} else if ($path !== '/') {
    $paths = explode("/", $path);
    
    $method = $paths[1];
    call_user_func_array(array($b, $method), array_slice($paths, 2))->save(null, true);
}
$resouce = $b->toResource();
?><!doctype html>
<html>
<head>
	<meta charset='utf-8'>
	<meta name='viewport' content='initial-scale=1'>
	<title>ImageManipulation Test Page</title>

  <style>
    html {
        font-size: 16px;
    }
    html, body {
        font-size: 1em;
        height: 100%;
        margin: 0;
        padding: 0;
        width: 100%;
    }
    body {
        display: flex;
    }
    a {
        border-bottom: 2px dotted transparent;
        color: #2CCC87;
        display: block;
        text-decoration: none;
    }
    a:hover {
        border-bottom: 2px dotted #2CCC87;
    }
    .filters {
        list-style: none;
        margin: 0;
        padding: 0;
    }
    .filters li {
        padding: .1rem 1rem;
    }
    .filters p {
        padding: 0;
        margin: .1rem 0;
    }
    .image {
       position: fixed;
    }
  </style>
	
</head>
<body>

    <ul class="filters">
        <li>
            <p>Dimensions: <?= $resouce->getX()?> x <?= $resouce->getY()?></p>
            <p>Size: <?= round($resouce->getSize() / 1000, 2)?> KB</p>
        </li>
        <li><a href="/clear">clear</a></li>
        <li><a href="/brightness">brightness</a></li>
        <li><a href="/colorize/D67D7A">colorize</a></li>
        <li><a href="/comic">comic</a></li>
        <li><a href="/contrast">contrast</a></li>
        <li><a href="/darken">darken</a></li>
        <li><a href="/dodge">dodge</a></li>
        <li><a href="/duotone">duotone</a></li>
        <li><a href="/edgeDetect">edgeDetect</a></li>
        <li><a href="/emboss">emboss</a></li>
        <li><a href="/flip">flip</a></li>
        <li><a href="/findEdges">findEdges</a></li>
        <li><a href="/gammaCorrection">gammaCorrection</a></li>
        <li><a href="/gaussianBlur">gaussianBlur</a></li>
        <li><a href="/grayscale">grayscale</a></li>
        <li><a href="/hueRotate">hueRotate</a></li>
        <li><a href="/meanremove">meanremove</a></li>
        <li><a href="/motionBlur">motionBlur</a></li>
        <li><a href="/negative">negative</a></li>
        <li><a href="/noise">noise</a></li>
        <li><a href="/oldCardboard">oldCardboard</a></li>
        <li><a href="/opacity">opacity</a></li>
        <li><a href="/pixelate">pixelate</a></li>
        <li><a href="/randomBlocks">randomBlocks</a></li>
        <li><a href="/rotate">rotate</a></li>
        <li><a href="/roundedCorners">roundedCorners</a></li>
        <li><a href="/scatter">scatter</a></li>
        <li><a href="/selectiveBlur">selectiveBlur</a></li>
        <li><a href="/semiGrayscale">semiGrayscale</a></li>
        <li><a href="/sepia">sepia</a></li>
        <li><a href="/sepiaFast">sepiaFast</a></li>
        <li><a href="/sharpen">sharpen</a></li>
        <li><a href="/smooth">smooth</a></li>
        <li><a href="/sobelEdgeDetect">sobelEdgeDetect</a></li>
        <li><a href="/sobelEdgeEnhance">sobelEdgeEnhance</a></li>
        <li><a href="/truecolor">truecolor</a></li>
        <li><a href="/vignette">vignette</a></li>
    </ul>
    <div class="image">
        <img  src="/<?= $image?>?time=<?= time()?>" />
        <img src="/uglydog.png" />
    </div>
</body>
</html>