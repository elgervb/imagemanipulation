
# IMAGEMANIPULATION

[![Build Status](https://travis-ci.org/elgervb/imagemanipulation.svg?branch=master)](https://travis-ci.org/elgervb/imagemanipulation)
[![Latest Stable Version](https://poser.pugx.org/elgervb/imagemanipulation/version.svg)](https://packagist.org/packages/elgervb/imagemanipulation)<br/>
Fork me on GitHub: https://github.com/elgervb/imagemanipulation

Library to manipulate images using PHP's GD library. Most of the functionality is available through the `ImageBuilder` facade.
This way chaining of image filters and thumbnailing is possible, like:

```php
ImageBuilder::create( new \SplFileInfo('image.jpg') )
  ->contrast( 20 ) // increase contrast
  ->colorize( '#DB3636' ) // apply a bit of red the the image
  ->flip( ImageFilterFlip::FLIP_VERTICALLY ) // flip image vertically
  ->save( new \SplFileInfo( 'image.new.png' ) ) // save the jpg image as png with filters applied
  ->render( 80 ); // render to browser with quality 80
```


## Installation

### With composer.json:

```
	"require" : {
		"elgervb/imagemanipulation": "^1.0"
	}
```
## Requirements

PHP version >= 5.3
with GD library
    

## FUNCTIONALITY

### Filters

Lots of image filters. All of them listed below:

* brightness
* colorize
* comic
* contrast
* convolution 3x3 filters
* darken
* dodge
* edge detect
* emboss
* find edges
* flip (horizonal, vertical, both)
* gamma correction
* gaussian blur
* grayscale
* mean remove
* motion blur
* negative
* noise
* old cardboard
* opacity
* pixelate
* random blocks with custom size and color
* replace color
* reverse
* scatter
* selective blur
* semi grayscale
* sepia
* sepia fast
* sharpen
* smooth
* sobel edge detect
* sobel edge enhance (based on convolution matrix)
* true color
* vignette


### Overlay

Use an image as overlay on another image. Can be configured with overlay opacity, start and end position and fill options.


### Reflection

Use the current image to make a reflection below the original image


### Image repeater

Repeat images on a canvas, until it fits. This way we can create Warhol like images.


### Rotate

Rotate images in degrees. When rotating an image not equal to 90, 180, 270 or 360 degrees, then optionally you can specify a background color for those oncovered edges.


### Thumbnails

Create thumbnails on the fly. There are several strategies to use:

* Centered strategy: create a thumb from the center of an image. Ideal for creating square thumbs from not so square images
* Max strategy: resize the image to a max width or height keeping proportions. For example: when resizing an image (300x750) on max 500 pixels, the resulting image will be 200x500 pixels
* Percentage strategy: reduce the size of an image with a certain percentage. 


### Watermarking

Add a watermark to your image. Possible positions are: top, bottom, left, right, center, top right, top left, bottom right, bottom left.
