<?php
namespace imagemanipulation\color;

use imagemanipulation\Coordinate;
use imagemanipulation\ImageResource;

/**
 * @author Elger van Boxtel
 */
class ColorUtil
{
	/**
	 * Calculates the average color of an image.
	 * 
	 * @param ImageResource $aResource
	 * 
	 * @return IColor
	 */
	public static function average(ImageResource $aResource) {
		$w = $aResource->getX();
		$h = $aResource->getY();
		$r = $g = $b = 0;
		$res = $aResource->getResource();
		for($y = 0; $y < $h; $y++) {
			for($x = 0; $x < $w; $x++) {
				$rgb = imagecolorat($res, $x, $y);
				$r += $rgb >> 16;
				$g += $rgb >> 8 & 255;
				$b += $rgb & 255;
			}
		}
		$pxls = $w * $h;
		$r = dechex(round($r / $pxls));
		$g = dechex(round($g / $pxls));
		$b = dechex(round($b / $pxls));
		if(strlen($r) < 2) {
			$r = 0 . $r;
		}
		if(strlen($g) < 2) {
			$g = 0 . $g;
		}
		if(strlen($b) < 2) {
			$b = 0 . $b;
		}
		$index = Color::createColorIndex($r, $g, $b);
		
		return new Color($index);
	}
	
	/**
	 * HSL hsl(360, 100%, 100%)
	 * 
	 * @param unknown $r
	 * @param unknown $g
	 * @param unknown $b
	 * @return array 
	 */
	public static function rgb2hsl($r, $g, $b) {
	    $var_r = $r / 255;
	    $var_g = $g / 255;
	    $var_b = $b / 255;
	    
	    $var_min = min($var_r,$var_g,$var_b);
	    $var_max = max($var_r,$var_g,$var_b);
	    $del_max = $var_max - $var_min;
	    
	    $l = ($var_max + $var_min) / 2;
	    
	    if ($del_max == 0)
	    {
	        $h = 0;
	        $s = 0;
	    }
	    else
	    {
	        if ($l < 0.5)
	        {
	            $s = $del_max / ($var_max + $var_min);
	        }
	        else
	        {
	            $s = $del_max / (2 - $var_max - $var_min);
	        };
	    
	        $del_r = ((($var_max - $var_r) / 6) + ($del_max / 2)) / $del_max;
	        $del_g = ((($var_max - $var_g) / 6) + ($del_max / 2)) / $del_max;
	        $del_b = ((($var_max - $var_b) / 6) + ($del_max / 2)) / $del_max;
	    
	        if ($var_r == $var_max)
	        {
	            $h = $del_b - $del_g;
	        }
	        elseif ($var_g == $var_max)
	        {
	            $h = (1 / 3) + $del_r - $del_b;
	        }
	        elseif ($var_b == $var_max)
	        {
	            $h = (2 / 3) + $del_g - $del_r;
	        };
	    
	        if ($h < 0)
	        {
	            $h += 1;
	        };
	    
	        if ($h > 1)
	        {
	            $h -= 1;
	        };
	    };
	    $HSL = $l + ($s << 0x8) + ($h << 0x10);
	    return array(round($h*360, 0), round($s*100, 0), round($l*100, 0));
	}
	
	/**
	 * Convert HEX color into HSL
	 * 
	 * @param unknown $hex
	 * @return multitype:number
	 */
	public static function hex2hsl($hex) {
	    $hex = str_replace("#", "", $hex);
        // Split input by color
        $hex = str_split($hex, 2);
        // Convert color values to value between 0 and 1
        $r = (hexdec($hex[0]));
        $g = (hexdec($hex[1]));
        $b = (hexdec($hex[2]));
        
        return self::rgb2hsl($r,$g,$b);
    }
    
    /**
     * Convert HSL into RGB
     * 
     * @param int $h degrees
     * @param int $s percentage
     * @param int $l percentage
     * 
     * @return array 
     */
	public static function hsl2rgb($h, $s, $l) {
	    $h = $h ? $h / 360 : 0;
	    $s = $s ? $s / 100 : 0;
	    $l = $l ? $l /100 : 0;
	    
        $m2 = ( $l <= 0.5 ) ? $l * ( $s + 1 ) : $l + $s - $l * $s;
        $m1 = $l * 2 - $m2;
    
        $hue = function ( $base ) use ( $m1, $m2 ) {
            $base = ( $base < 0 ) ? $base + 1 : ( ( $base > 1 ) ? $base - 1 : $base );
            if ( $base * 6 < 1 ) return round($m1 + ( $m2 - $m1 ) * $base * 6);
            if ( $base * 2 < 1 ) return round($m2);
            if ( $base * 3 < 2 ) return round($m1 + ( $m2 - $m1 ) * ( 0.6666666666 - $base ) * 6);
            return round($m1, 1);
        };
    
        return array( $hue( $h + 0.33333 ) * 255, $hue( $h ) * 255, $hue( $h - 0.33333 ) * 255 );
	}
	
	/**
	 * Parse a color index into an rgb array
	 *
	 * @param int $int color index
	 * 
	 * @see imagecolorat()
	 *
	 * @return array
	 */
	public static function int2rgba( $int )
	{
	    $a = ($int >> 24) & 0xFF;
	    $r = ($int >> 16) & 0xFF;
	    $g = ($int >> 8) & 0xFF;
	    $b = $int & 0xFF;
	    return array($r, $g, $b, $a);
	}
	
	/**
	 * This function builds a 32 bit integer from 4 values which must be 0-255 (8 bits)
	 * Example 32 bit integer: 00100000010001000000100000010000
	 * The first 8 bits define the alpha
	 * The next 8 bits define the blue
	 * The next 8 bits define the green
	 * The next 8 bits define the red
	 */
	public static function rgba2int($r, $g, $b, $a=1) {
	    
	    return ($a << 24) + ($b << 16) + ($g << 8) + $r;
	}
	
	/**
	 * Returns the color at the specified location of the image resource
	 *
	 * @param ImageResource $aResource
	 * @param Coordinate $aCoordinate
	 *
	 * @return IColor The color found at the coordinates
	 */
	public static function getColorAt( ImageResource $aResource, Coordinate $aCoordinate )
	{
		$index = imagecolorat( $aResource->getResource(), $aCoordinate->getX(), $aCoordinate->getY() );
	
		$color = new Color( $index );
	
		return $color;
	}
}