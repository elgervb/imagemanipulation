<?php
namespace imagemanipulation;
/**
 * Coordinate in a image, x & y
 * @author Elger van Boxtel
 */
class Coordinate
{
	/**
	 * The x-coordinate of the pixel
	 * 
	 * @var int
	 */
	private $x;
	
	/**
	 * The y-coordinate of the pixel
	 * 
	 * @var int
	 */
	private $y;
	
	/**
	 * Creates a new x - y Coordinate
	 * 
	 * @param int $aX
	 * @param int $aY
	 */
	public function __construct( $aX, $aY )
	{
		$this->setX( $aX );
		$this->setY( $aY );
	}
	
	/**
	 * Factory method to create a new Coordinate
	 * 
	 * @param int $x
	 * @param int $y
	 * 
	 * @return \imagemanipulation\Coordinate
	 */
	public static function create($x, $y){
	    return new Coordinate($x, $y);
	}
	
	/**
	 * Returns the x-coordinate of the pixel
	 * @return int
	 */
	public function getX()
	{
		return $this->x;
	}
	
	/**
	 * Returns the y-coordinate of the pixel
	 * @return int
	 */
	public function getY()
	{
		return $this->y;
	}
	
	/**
	 * Sets the x-coordinate of the pixel
	 * @param int $x
	 */
	private function setX( $x )
	{
		assert( 'is_int($x)' );
		$this->x = $x;
	}
	
	/**
	 * Sets the y-coordinate of the pixel
	 * 
	 * @param int $y
	 */
	private function setY( $y )
	{
		assert( 'is_int($y)' );
		$this->y = $y;
	}

}