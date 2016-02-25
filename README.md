
# IMAGEMANIPULATION

[![Build Status](https://travis-ci.org/elgervb/imagemanipulation.svg?branch=master)](https://travis-ci.org/elgervb/imagemanipulation)
[![Latest Stable Version](https://poser.pugx.org/elgervb/imagemanipulation/version.svg)](https://packagist.org/packages/elgervb/imagemanipulation)<br/>
Fork me on GitHub: https://github.com/elgervb/imagemanipulation
[![Bitdeli Badge](https://d2weczhvl823v0.cloudfront.net/elgervb/imagemanipulation/trend.png)](https://bitdeli.com/free "Bitdeli Badge")

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
* duotone
* edge detect
* emboss
* find edges
* flip (horizonal, vertical, both)
* gamma correction
* gaussian blur
* grayscale
* hue rotate
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
* rounded corners
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


# Examples

## Thumbnails

You can create thumbnails in several ways

### centered
create a thumbnail which is centered in the middle of the image

Parameter       | Default   | Description
----------------|-----------|---------------------------
*width*         | 250       | The new width of the image in pixels
*height*        | 250       | The new height of the image in pixels

**Examples** <br />
![Centered Thumb](http://elgervanboxtel.nl/imageproxy/img/thumb/centered/width=150;height=350/dog.jpg)
![Centered Thumb](http://elgervanboxtel.nl/imageproxy/img/thumb/centered/width=350;height=250/dog.jpg)
![Centered Thumb](http://elgervanboxtel.nl/imageproxy/img/thumb/centered/width=150;height=150/dog.jpg)

*URL* <br />
/imageproxy/img/thumb/centered/width=150;height=350/dog.jpg <br />
/imageproxy/img/thumb/centered/width=350;height=250/dog.jpg <br />
/imageproxy/img/thumb/centered/width=150;height=150/dog.jpg <br />


### max
resize the image to a max width or height keeping proportions, thus restraining the image to a certain size

Parameter       | Default   | Description
----------------|-----------|---------------------------
*width*         | 250       | The max width of the image in pixels
*height*        | 250       | The max height of the image in pixels

**Examples** <br />
![Max Thumb](http://elgervanboxtel.nl/imageproxy/img/thumb/max/width=150;height=350/dog.jpg)
![Max Thumb](http://elgervanboxtel.nl/imageproxy/img/thumb/max/width=350;height=250/dog.jpg)
![Max Thumb](http://elgervanboxtel.nl/imageproxy/img/thumb/max/width=150;height=150/dog.jpg)

*URL* <br />
/imageproxy/img/thumb/max/width=150;height=350/dog.jpg <br />
/imageproxy/img/thumb/max/width=350;height=250/dog.jpg <br />
/imageproxy/img/thumb/max/width=150;height=150/dog.jpg <br />


### percentage
reduce a image with a certain percentage

Parameter       | Default   | Description
----------------|-----------|---------------------------
*percentage*    | 250       | The percentage to reduce the image with

**Examples** <br />
![Max Thumb](http://elgervanboxtel.nl/imageproxy/img/thumb/percentage/percentage=75/dog.jpg)
![Max Thumb](http://elgervanboxtel.nl/imageproxy/img/thumb/percentage/percentage=50/dog.jpg)
![Max Thumb](http://elgervanboxtel.nl/imageproxy/img/thumb/percentage/percentage=25/dog.jpg)

*URL* <br />
/imageproxy/img/thumb/percentage/percentage=75/dog.jpg <br />
/imageproxy/img/thumb/percentage/percentage=50/dog.jpg <br />
/imageproxy/img/thumb/percentage/percentage=25/dog.jpg <br />


### square

Parameter       | Default   | Description
----------------|-----------|---------------------------
*width*         | 250       | The new width of the image in pixels
*height*        | 250       | The new height of the image in pixels

**Examples** <br />
![Centered Thumb](http://elgervanboxtel.nl/imageproxy/img/thumb/square/width=350/dog.jpg)
![Centered Thumb](http://elgervanboxtel.nl/imageproxy/img/thumb/square/width=250/dog.jpg)
![Centered Thumb](http://elgervanboxtel.nl/imageproxy/img/thumb/square/width=150/dog.jpg)

*URL* <br />
/imageproxy/img/thumb/square/width=350/dog.jpg <br />
/imageproxy/img/thumb/square/width=250/dog.jpg <br />
/imageproxy/img/thumb/square/width=150/dog.jpg <br />



## Available Filters


### blocks
Add random blocks to an image with custom size and color

Parameter       |  Default  | Description
----------------|-----------|---------------------------
*number*        | 100       | The number of blocks
*size*          | 25        | The size of the blocks in pixels
*color*         | ffffff    | The color of the blocks

**Examples** <br />
![Blocks Filter](http://elgervanboxtel.nl/imageproxy/img/blocks/dog.jpg)
![Blocks Filter](http://elgervanboxtel.nl/imageproxy/img/blocks/color=8D8942;size=10/dog.jpg)
![Blocks Filter](http://elgervanboxtel.nl/imageproxy/img/blocks/color=000;size=60/dog.jpg) 

*URL* <br />
/imageproxy/img/blocks/dog.jpg <br />
/imageproxy/img/blocks/color=8D8942;size=10/dog.jpg <br />
/imageproxy/img/blocks/color=000;size=60/dog.jpg <br />


### brightness
Adjust the brightness of the image, either lighter or darker

Parameter       |  Default  | Description
----------------|-----------|---------------------------
*rate*          | 20        | The brightness level from -255 to 255, from darker to lighter

**Examples** <br />
![Brightness Filter](http://elgervanboxtel.nl/imageproxy/img/brightness/dog.jpg)
![Brightness Filter Darker](http://elgervanboxtel.nl/imageproxy/img/brightness/rate=-40/dog.jpg)
![Brightness Filter Lighter](http://elgervanboxtel.nl/imageproxy/img/brightness/rate=100/dog.jpg)

*URL* <br />
/imageproxy/img/brightness/dog.jpg <br />
/imageproxy/img/brightness/rate=-40/dog.jpg <br />
/imageproxy/img/brightness/rate=100/dog.jpg <br />


### colorize
Blends a fill color with the image

Parameter       |  Default  | Description
----------------|-----------|---------------------------
*color*         | ffffff    | The color to blend, either in hexadecimal or rgb(a)
*opacity*       | null      | The color opacity from 0 to 127

**Examples** <br />
![Colorize Filter](http://elgervanboxtel.nl/imageproxy/img/colorize/dog.jpg)
![Colorize Filter red](http://elgervanboxtel.nl/imageproxy/img/colorize/color=ff0000;opacity=100/dog.jpg)
![Colorize Filter green](http://elgervanboxtel.nl/imageproxy/img/colorize/color=rgba(0,255,0,40)/dog.jpg)

*URL* <br />
/imageproxy/img/colorize/dog.jpg <br />
/imageproxy/img/colorize/color=ff0000;opacity=100/dog.jpg <br />
/imageproxy/img/colorize/colorcolor=rgba(0,255,0,40)/dog.jpg <br />


### comic
Apply a sketchy comic filter to an image

Parameter       |  Default  | Description
----------------|-----------|---------------------------
*opacity*       | 40        | The opacity from 0 to 127

**Examples** <br />
![Comic Filter](http://elgervanboxtel.nl/imageproxy/img/comic/dog.jpg)
![Comic Filter](http://elgervanboxtel.nl/imageproxy/img/comic/opacity=40/dog.jpg)
![Comic Filter](http://elgervanboxtel.nl/imageproxy/img/comic/opacity=100/dog.jpg)

*URL* <br />
/imageproxy/img/comic/dog.jpg <br />
/imageproxy/img/comic/opacity=40/dog.jpg <br />
/imageproxy/img/comic/opacity=100/dog.jpg <br />


### contrast
Changes the contrast of the image

Parameter       |  Default  | Description
----------------|-----------|---------------------------
*rate*          | 5         | The opacity from -100 to 100, from minimal contrast to high constrast

**Examples** <br />
![Contrast Filter](http://elgervanboxtel.nl/imageproxy/img/contrast/dog.jpg)
![Contrast Filter](http://elgervanboxtel.nl/imageproxy/img/contrast/rate=40/dog.jpg)
![Contrast Filter](http://elgervanboxtel.nl/imageproxy/img/contrast/rate=-10/dog.jpg)

*URL* <br />
/imageproxy/img/contrast/dog.jpg <br />
/imageproxy/img/contrast/rate=40/dog.jpg <br />
/imageproxy/img/contrast/rate=-10/dog.jpg <br />


###darken
Adjust the brightness of the image, either darker or lighter

Parameter       |  Default  | Description
----------------|-----------|---------------------------
*rate*          | 20        | The brightness level from -255 to 255, from lighter to darker

**Examples** <br />
![Darken Filter](http://elgervanboxtel.nl/imageproxy/img/darken/dog.jpg)
![Darken Filter Lighter](http://elgervanboxtel.nl/imageproxy/img/darken/rate=-40/dog.jpg)
![Darken Filter Darker](http://elgervanboxtel.nl/imageproxy/img/darken/rate=100/dog.jpg)

*URL* <br />
/imageproxy/img/darken/dog.jpg <br />
/imageproxy/img/darken/rate=-40/dog.jpg <br />
/imageproxy/img/darken/rate=100/dog.jpg <br />


###dodge
Dodge an image, resulting in a darker image

Parameter       |  Default  | Description
----------------|-----------|---------------------------
*rate*          | 75        | The dodge level between 0 and 100

**Examples** <br />
![Dodge Filter](http://elgervanboxtel.nl/imageproxy/img/dodge/dog.jpg)
![Dodge Filter Lighter](http://elgervanboxtel.nl/imageproxy/img/dodge/rate=40/dog.jpg)
![Dodge Filter Darker](http://elgervanboxtel.nl/imageproxy/img/dodge/rate=10/dog.jpg)

*URL* <br />
/imageproxy/img/dodge/dog.jpg <br />
/imageproxy/img/dodge/rate=40/dog.jpg <br />
/imageproxy/img/dodge/rate=10/dog.jpg <br />


###duotone
Duotone filter. Enhances Red, Green or Blue or a combination

Parameter       |  Default  | Description
----------------|-----------|---------------------------
*red*           | 0         | The amount of red to add max = 255
*green*         | 0         | The amount of green to add max = 255
*blue*          | 0         | The amount of blue to add max = 255

**Examples** <br />
![Dodge Filter](http://elgervanboxtel.nl/imageproxy/img/duotone/dog.jpg)
![Dodge Filter Lighter](http://elgervanboxtel.nl/imageproxy/img/duotone/red=40/dog.jpg)
![Dodge Filter Darker](http://elgervanboxtel.nl/imageproxy/img/duotone/green=10;blue=90/dog.jpg)

*URL* <br />
/imageproxy/img/duotone/dog.jpg <br />
/imageproxy/img/duotone/red=40/dog.jpg <br />
/imageproxy/img/duotone/green=10;blue=90/dog.jpg <br />


###edgedetect
Uses edge detection to highlight the edges in the image

**Examples** <br />
![Edge detect Filter](http://elgervanboxtel.nl/imageproxy/img/edgedetect/dog.jpg)

*URL* <br />
/imageproxy/img/edgedetect/dog.jpg <br />


###emboss
Embosses the image

**Examples** <br />
![Edge detect Filter](http://elgervanboxtel.nl/imageproxy/img/emboss/dog.jpg)

*URL* <br />
/imageproxy/img/emboss/dog.jpg <br />


###findedges
Find the edges in an image without color loss

**Examples** <br />
![Edge detect Filter](http://elgervanboxtel.nl/imageproxy/img/findedges/dog.jpg)

*URL* <br />
/imageproxy/img/findedges/dog.jpg <br />


###flip
Flips an image

Parameter       |  Default  | Description
----------------|-----------|---------------------------
*mode*          | both      | Direction to fip: vertical, horizontal or both

**Examples** <br />
![Flip Filter](http://elgervanboxtel.nl/imageproxy/img/flip/mode=both/dog.jpg)
![Flip Filter Vertical](http://elgervanboxtel.nl/imageproxy/img/flip/mode=vertical/dog.jpg)
![Flip Filter Horizontal](http://elgervanboxtel.nl/imageproxy/img/flip/mode=horizontal/dog.jpg)

*URL* <br />
/imageproxy/img/flip/dog.jpg <br />
/imageproxy/img/flip/mode=vertical/dog.jpg <br />
/imageproxy/img/flip/mode=horizontal/dog.jpg <br />


###gammacorrection
Applies gamma correction

Parameter       |  Default  | Description
----------------|-----------|---------------------------
*input*         | 1.0       | Input
*output*        | 1.537     | Output

**Examples** <br />
![Gamma Correction Filter](http://elgervanboxtel.nl/imageproxy/img/gammacorrection/dog.jpg)
![Gamma Correction Vertical](http://elgervanboxtel.nl/imageproxy/img/gammacorrection/input=0.5;output=1/dog.jpg)
![FlipGamma Correction Horizontal](http://elgervanboxtel.nl/imageproxy/img/gammacorrection/input=2;output=1/dog.jpg)

*URL* <br />
/imageproxy/img/gammacorrection/dog.jpg <br />
/imageproxy/img/gammacorrection/input=0.5;output=1/dog.jpg <br />
/imageproxy/img/gammacorrection/input=2;output=1/dog.jpg <br />


###gaussianblur
Blurs the image using the Gaussian method.

**Examples** <br />
![Gaussian Blur Filter](http://elgervanboxtel.nl/imageproxy/img/gaussianblur/dog.jpg)

*URL* <br />
/imageproxy/img/gaussianblur/dog.jpg <br />


###grayscale
Converts the colors to grayscale

**Examples** <br />
![Gaussian Blur Filter](http://elgervanboxtel.nl/imageproxy/img/grayscale/dog.jpg)

*URL* <br />
/imageproxy/img/grayscale/dog.jpg <br />


###huerotate
Rotete the hue of the image

Parameter       |  Default  | Description
----------------|-----------|---------------------------
*rotate*        | 90        | degrees to rotate

**Examples** <br />
![Hue Rotate Filter](http://elgervanboxtel.nl/imageproxy/img/huerotate/dog.jpg)
![Hue Rotate Filter](http://elgervanboxtel.nl/imageproxy/img/huerotate/rotate=20/dog.jpg)
![Hue Rotate Filter](http://elgervanboxtel.nl/imageproxy/img/huerotate/rotate=270/dog.jpg)

*URL* <br />
/imageproxy/img/huerotate/dog.jpg <br />
/imageproxy/img/huerotate/red=40/dog.jpg <br />
/imageproxy/img/huerotate/green=10;blue=90/dog.jpg <br />


###meanremove
Uses mean removal to achieve a "sketchy" effect

**Examples** <br />
![Gaussian Blur Filter](http://elgervanboxtel.nl/imageproxy/img/meanremove/dog.jpg)

*URL* <br />
/imageproxy/img/meanremove/dog.jpg <br />


###motionblur
Motion blurs the image

**Examples** <br />
![Gaussian Blur Filter](http://elgervanboxtel.nl/imageproxy/img/motionblur/dog.jpg)

*URL* <br />
/imageproxy/img/motionblur/dog.jpg <br />


###negative
Create a negative of an image

**Examples** <br />
![Gaussian Blur Filter](http://elgervanboxtel.nl/imageproxy/img/negative/dog.jpg)

*URL* <br />
/imageproxy/img/negative/dog.jpg <br />


###noise
add noise to the image

Parameter       |  Default  | Description
----------------|-----------|---------------------------
*rate*          | 20        | The amount of noise to apply

**Examples** <br />
![Noise Filter](http://elgervanboxtel.nl/imageproxy/img/noise/dog.jpg)
![Noise Filter](http://elgervanboxtel.nl/imageproxy/img/noise/rate=40/dog.jpg)
![Noise Filter](http://elgervanboxtel.nl/imageproxy/img/noise/rate=80/dog.jpg)

*URL* <br />
/imageproxy/img/noise/dog.jpg <br />
/imageproxy/img/noise/rate=40/dog.jpg <br />
/imageproxy/img/noise/rate=80/dog.jpg <br />


###oldcardboard
Image filter to give the image an old cardboard look

**Examples** <br />
![Gaussian Blur Filter](http://elgervanboxtel.nl/imageproxy/img/oldcardboard/dog.jpg)

*URL* <br />
/imageproxy/img/oldcardboard/dog.jpg <br />


###opacity
Sets the opacity of an image

Parameter       |  Default  | Description
----------------|-----------|---------------------------
*opacity*       | 80        | A value between 0 and 127. 0 indicates completely opaque while 127 indicates completely transparent.

**Examples** <br />
![Opacity Filter](http://elgervanboxtel.nl/imageproxy/img/opacity/dog.jpg)
![Opacity Filter](http://elgervanboxtel.nl/imageproxy/img/opacity/opacity=40/dog.jpg)
![Opacity Filter](http://elgervanboxtel.nl/imageproxy/img/opacity/opacity=100/dog.jpg)

*URL* <br />
/imageproxy/img/opacity/dog.jpg <br />
/imageproxy/img/opacity/rate=40/dog.jpg <br />
/imageproxy/img/opacity/rate=100/dog.jpg <br />


###pixelate
Pixelate an image

Parameter       |  Default  | Description
----------------|-----------|---------------------------
*rate*          | 20        | the blocksize in pixels

**Examples** <br />
![Pixelate Filter](http://elgervanboxtel.nl/imageproxy/img/pixelate/rate=5/dog.jpg)
![Pixelate Filter](http://elgervanboxtel.nl/imageproxy/img/pixelate/dog.jpg)
![Pixelate Filter](http://elgervanboxtel.nl/imageproxy/img/pixelate/rate=63/dog.jpg)

*URL* <br />
/imageproxy/img/pixelate/rate=5/dog.jpg <br />
/imageproxy/img/pixelate/dog.jpg <br />
/imageproxy/img/pixelate/rate=60/dog.jpg <br />


###rotate
Rotate an image over an angle

Parameter       |  Default  | Description
----------------|-----------|---------------------------
*degrees*       | 90        | The degrees to rotate the image
*color*         | null      | The background color to apply 

**Examples** <br />
![Rotate Filter](http://elgervanboxtel.nl/imageproxy/img/rotate//dog.jpg)
![Rotate Filter](http://elgervanboxtel.nl/imageproxy/img/rotate/degrees=180/dog.jpg)
![Rotate Filter](http://elgervanboxtel.nl/imageproxy/img/rotate//degrees=45;color=f00/dog.jpg)

*URL* <br />
/imageproxy/img/rotate/dog.jpg <br />
/imageproxy/img/rotate/degrees=180/dog.jpg <br />
/imageproxy/img/rotate/degrees=45/dog.jpg <br />


###scatter
Scatter pixels around in a random way

Parameter       |  Default  | Description
----------------|-----------|---------------------------
*rate*          | 5         | the scatter size in pixels

**Examples** <br />
![Scatter Filter](http://elgervanboxtel.nl/imageproxy/img/scatter/dog.jpg)
![Scatter Filter](http://elgervanboxtel.nl/imageproxy/img/scatter/rate=10/dog.jpg)
![Scatter Filter](http://elgervanboxtel.nl/imageproxy/img/scatter/rate=20/dog.jpg)

*URL* <br />
/imageproxy/img/scatter/dog.jpg <br />
/imageproxy/img/scatter/rate=10/dog.jpg <br />
/imageproxy/img/scatter/rate=10/dog.jpg <br />


###selectiveblur
Image filter Selective Blur

**Examples** <br />
![Selective blur Filter](http://elgervanboxtel.nl/imageproxy/img/selectiveblur/dog.jpg)

*URL* <br />
/imageproxy/img/selectiveblur/dog.jpg <br />


###sepia
Apply sepia to the image

Parameter       |  Default  | Description
----------------|-----------|---------------------------
*rate*          | 15        | the darken rate

**Examples** <br />
![Sepia Filter](http://elgervanboxtel.nl/imageproxy/img/sepia/dog.jpg)
![Sepia Filter](http://elgervanboxtel.nl/imageproxy/img/sepia/rate=30/dog.jpg)
![Sepia Filter](http://elgervanboxtel.nl/imageproxy/img/sepia/rate=60/dog.jpg)

*URL* <br />
/imageproxy/img/sepia/dog.jpg <br />
/imageproxy/img/sepia/rate=30/dog.jpg <br />
/imageproxy/img/sepia/rate=60/dog.jpg <br />


###semigrayscale
Applies grayscale to an image, optionally add a grayscale percentage

Parameter       |  Default  | Description
----------------|-----------|---------------------------
*rate*          | 75        | The grayscale rate

**Examples** <br />
![Sepia Filter](http://elgervanboxtel.nl/imageproxy/img/semigrayscale/dog.jpg)
![Sepia Filter](http://elgervanboxtel.nl/imageproxy/img/semigrayscale/rate=20/dog.jpg)
![Sepia Filter](http://elgervanboxtel.nl/imageproxy/img/semigrayscale/rate=90/dog.jpg)

*URL* <br />
/imageproxy/img/semigrayscale/dog.jpg <br />
/imageproxy/img/semigrayscale/rate=30/dog.jpg <br />
/imageproxy/img/semigrayscale/rate=60/dog.jpg <br />


###sepiafast
Apply sepia to the image (fast)

**Examples** <br />
![Sepia fast Filter](http://elgervanboxtel.nl/imageproxy/img/sepiafast/dog.jpg)
![Sepia fast Filter](http://elgervanboxtel.nl/imageproxy/img/sepiafast/rate=30/dog.jpg)
![Sepia fast Filter](http://elgervanboxtel.nl/imageproxy/img/sepiafast/rate=60/dog.jpg)

*URL* <br />
/imageproxy/img/sepiafast/dog.jpg <br />


###sharpen
Sharpens the image

**Examples** <br />
![Sepia fast Filter](http://elgervanboxtel.nl/imageproxy/img/sharpen/dog.jpg)

*URL* <br />
/imageproxy/img/sharpen/dog.jpg <br />


###smooth
Makes the image smoother.

Parameter       |  Default  | Description
----------------|-----------|---------------------------
*rate*          | 5         | the darken rate

**Examples** <br />
![Smooth Filter](http://elgervanboxtel.nl/imageproxy/img/smooth/dog.jpg)
![Smooth Filter](http://elgervanboxtel.nl/imageproxy/img/smooth/rate=15/dog.jpg)
![Smooth Filter](http://elgervanboxtel.nl/imageproxy/img/smooth/rate=30/dog.jpg)

*URL* <br />
/imageproxy/img/sepia/dog.jpg <br />
/imageproxy/img/sepia/rate=15/dog.jpg <br />
/imageproxy/img/sepia/rate=30/dog.jpg <br />


###sobel
Sobel edge detect (extremely slow...)

**Examples** <br />
![Sobel Edge Detect Filter](http://elgervanboxtel.nl/imageproxy/img/sobel/dog.jpg)

*URL* <br />
/imageproxy/img/sobel/dog.jpg <br />


###sobeledge
Sobel edge enhance

**Examples** <br />
![Sobel Edge Detect Filter](http://elgervanboxtel.nl/imageproxy/img/sobeledge/dog.jpg)

*URL* <br />
/imageproxy/img/sobeledge/dog.jpg <br />


###truecolor
Makes the image smoother.

Parameter       |  Default  | Description
----------------|-----------|---------------------------
*primary*       | ffffff    | the primary color
*secundary*     | 000000    | the secundary color


**Examples** <br />
![Smooth Filter](http://elgervanboxtel.nl/imageproxy/img/truecolor/dog.jpg)
![Smooth Filter](http://elgervanboxtel.nl/imageproxy/img/truecolor/primary=B7121D;secundary=5774DB/dog.jpg)
![Smooth Filter](http://elgervanboxtel.nl/imageproxy/img/truecolor/primary=C1C1C1;secundary=44C4BD/dog.jpg)

*URL* <br />
/imageproxy/img/truecolor/dog.jpg <br />
/imageproxy/img/truecolor/primary=B7121D;secundary=5774DB/dog.jpg <br />
/imageproxy/img/truecolor/primary=C1C1C1;secundary=44C4BD/dog.jpg <br />


###vignette
Applies a darker mask around the edges of the image

**Examples** <br />
![Smooth Filter](http://elgervanboxtel.nl/imageproxy/img/vignette/dog.jpg)

*URL* <br />
/imageproxy/img/vignette/dog.jpg <br />

