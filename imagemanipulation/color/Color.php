<?php
namespace imagemanipulation\color;

class Color implements IColor
{
	private $index;
	private $rgb = array();
	
	/**
	 * 
	 * #fff
	 * fff
	 * #ffffff
	 * ffffff
	 * rgb(127,255,255)
	 * rgba(127,127,127, 127)
	 * 
	 * @param string $aColorString
	 * @param int The alpha value is between 0 (opaque) and 127 (transparent). 
	 */
	public function __construct( $aColorString, $aAlpha = null )
	{
		$len = strlen($aColorString);
		
		// color index
		if (is_int($aColorString)){
			$this->index = $aColorString;
			$this->rgb = $this->int2rgba($this->index);
		}
		
		// hexadecimal
		else if (stristr( $aColorString, '#' ) || $len == 3 || $len == 6 ){
			
			if (stristr( $aColorString, '#' )){
				$aColorString = str_replace( '#', '', $aColorString );
			}
			
			if (strlen( $aColorString ) == 3)
			{
				$aColorString = $aColorString[0] . $aColorString[0] . $aColorString[1] . $aColorString[1] . $aColorString[2] . $aColorString[2];
			}
			
			$this->rgb['r'] = hexdec( substr( $aColorString, 0, 2 ) );
			$this->rgb['g'] = hexdec( substr( $aColorString, 2, 2 ) );
			$this->rgb['b'] = hexdec( substr( $aColorString, 4, 2 ) );
		}
		
		// rgb(a)
		else if (stripos($aColorString, 'rgb') === 0 ){
			$match = preg_match('/.*\((.*)\).*/i', $aColorString, $matches);
			if ($match){
				$colors = explode(',', $matches[1]);
				$this->rgb['r'] = $colors[0];
				$this->rgb['g'] = $colors[1];
				$this->rgb['b'] = $colors[2];
				if (count($colors) > 3)
					$this->rgb['a'] = $colors[3];
			}
		}
		
		if (!isset($this->rgb['a'])){
			$this->rgb['a'] = $aAlpha === null ? 0 : $aAlpha ;
		}
	}
	
	/**
	 * Returns the alpha channel value
	 *
	 * @return int The alpha value is between 0 (opaque) and 127 (transparent). 
	 */
	public function getAlpha()
	{
		return $this->rgb['a'];
	}
	
	/**
	 * Returns the hex color code
	 *
	 * @return string
	 */
	public function getHexColor()
	{
		// force the passed value to be numeric by adding zero
		// use max and min to limit the number to between 0 and 255
		// shift the number to make it the correct future hex value
		$red = 0x10000 * max( 0, min( 255, $this->rgb['r'] + 0 ) );
		$green = 0x100 * max( 0, min( 255, $this->rgb['g'] + 0 ) );
		$blue = max( 0, min( 255, $this->rgb['b'] + 0 ) );
		
		// convert the combined value to hex and zero-fill to 6 digits
		return str_pad( strtolower( dechex( $red + $green + $blue ) ), 6, "0", STR_PAD_LEFT );
	}
	
	/**
	 * Returns the color index as used by PHP
	 *
	 * @return int
	 */
	public function getColorIndex()
	{
		if (!$this->index){
			$this->index = Color::createColorIndex($this->rgb['r'], $this->rgb['g'], $this->rgb['b'], $this->rgb['a']);
		}
		return $this->index;
	}
	
	/**
	 * @return int
	 */
	public function getBlue()
	{
		return $this->rgb['b'];
	}
	
	/**
	 * @return int
	 */
	public function getGreen()
	{
		return $this->rgb['g'];
	}
	
	/**
	 * @return int
	 */
	public function getRed()
	{
		return $this->rgb['r'];
	}
	
	private function int2rgba( $int )
	{
		$a = ($int >> 24) & 0xFF;
		$r = ($int >> 16) & 0xFF;
		$g = ($int >> 8) & 0xFF;
		$b = $int & 0xFF;
		return array('r' => $r , 'g' => $g , 'b' => $b , 'a' => $a);
	}
	
	/**
	 * This function builds a 32 bit integer from 4 values which must be 0-255 (8 bits)
	 *
	 * Example 32 bit integer: 00100000010001000000100000010000
	 * The first 8 bits define the alpha
	 * The next 8 bits define the blue
	 * The next 8 bits define the green
	 * The next 8 bits define the red
	 */
	public static function createColorIndex( $r, $g, $b, $a = 0 )
	{
		if ($a === null){
			$a = 0;
		}
		return ($a << 24) + ($b << 16) + ($g << 8) + $r;
	}
}