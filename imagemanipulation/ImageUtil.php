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
	public static function createTransparentImage( $aWidth, $aHeight )
	{
		assert( '$aWidth > 0' );
		assert( '$aHeight > 0' );

		$color = ColorFactory::white( 127 );

		$imgRes = imagecreatetruecolor( $aWidth, $aHeight );
		imageantialias( $imgRes, true );
		imagealphablending( $imgRes, true );
		imagesavealpha( $imgRes, true );

		$transparent = self::allocateColor( $imgRes, $color );

		imagefill( $imgRes, 0, 0, $transparent );

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