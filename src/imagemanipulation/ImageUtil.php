<?php
namespace imagemanipulation;

use imagemanipulation\color\ColorFactory;

use imagemanipulation\color\Color;
/**
 * 
 */
class ImageUtil
{
	/**
	 * Creates a transparent (PNG, JPG) image with a <code>aWidth</code> and <code>aHeight</code>.
	 *
	 * @param int $aWidth The width of the image
	 * @param int $aHeight The height of the image
	 * @return resource
	 */
	public static function createTransparentImage( $width, $height )
	{
	    $imgRes = self::createImage($width, $height);
		$color = ColorFactory::white( 127 );

		$transparent = self::allocateColor( $imgRes, $color );

		imagefill( $imgRes, 0, 0, $transparent );

		return $imgRes;
	}
	
	public static function createImage($width, $height) {
	    Args::int($width, 'width')->required()->min(0);
	    Args::int($height, 'height')->required()->min(0);
	    
	    $imgRes = imagecreatetruecolor( $width, $height );
	    imageantialias( $imgRes, true );
	    imagealphablending( $imgRes, true );
	    imagesavealpha( $imgRes, true );
	    
	    return $imgRes;
	}

	/**
	 * Returns the allocated color
	 *
	 * @param RGBColor $aColor
	 * @return int
	 */
	public static function allocateColor( $aImgRes, Color $aColor )
	{
		return imagecolorallocatealpha( $aImgRes, $aColor->getRed(), $aColor->getGreen(), $aColor->getBlue(), $aColor->getAlpha() );
	}

}