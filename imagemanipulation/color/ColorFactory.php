<?php
namespace imagemanipulation\color;
/**
 * @package image
 * @subpackage color
 */
class ColorFactory
{
	/**
	 * Creates a color
	 *
	 * @return Color
	 */
	public static function create( $aColor, $aAlpha = null)
	{
		return new Color( $aColor, $aAlpha );
	}
	
	/**
	 * Returns the color white
	 *
	 * @return Color
	 */
	public static function white($aAlpha = null)
	{
		return new Color( 'ffffff' , $aAlpha);
	}
	
	/**
	 * Returns the color black
	 *
	 * @return Color
	 */
	public static function black($aAlpha = null)
	{
		return new Color( '000000', $aAlpha );
	}
	
	public static function darkGreen($aAlpha = null)
	{
		return new Color( '006400', $aAlpha );
	}
	
	/**
	 * Returns the hex color red
	 *
	 * @return Color
	 */
	public static function red($aAlpha = null)
	{
		return new Color( 'ff0000', $aAlpha );
	}
	
	/**
	 * Returns the hex color green
	 *
	 * @return Color
	 */
	public static function green($aAlpha = null)
	{
		return new Color( '00ff00', $aAlpha );
	}
	
	/**
	 * Returns the hex color blue
	 *
	 * @return Color
	 */
	public static function blue($aAlpha = null)
	{
		return new Color( '0000ff', $aAlpha );
	}
}