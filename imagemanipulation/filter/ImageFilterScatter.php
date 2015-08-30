<?php
namespace imagemanipulation\filter;

use imagemanipulation\ImageResource;
/**
 * Scatter pixels around in a random way
 * 
 * <h2>Default</h2>
 * <img src="http://elgervanboxtel.nl/imageproxy/img/scatter/dog.jpg" />
 * <h2>Rate = 10</h2>
 * <img src="http://elgervanboxtel.nl/imageproxy/img/scatter/rate=10/dog.jpg" />
 * <h2>Rate = 20</h2>
 * <img src="http://elgervanboxtel.nl/imageproxy/img/scatter/rate=20/dog.jpg" />
 *
 *@see http://www.tuxradar.com/practicalphp/11/2/23
 */
class ImageFilterScatter implements IImageFilter
{
	private $offset;
	
	/**
	 * 
	 * @param number $aOffset
	 */
	public function __construct( $aOffset = 4 )
	{
		$this->offset = $aOffset;
	}
	/**
	 * Applies the sepia filter to an image resource
	 *
	 * @param ImageResource $aResource
	 */
	public function applyFilter( ImageResource $aResource )
	{
		if ($this->offset === 0)
		{
			return;
		}
		
		$resource = $aResource->getResource();
		
		$imagex = imagesx( $resource );
		$imagey = imagesy( $resource );
		
		for ($x = 0; $x < $imagex; ++ $x)
		{
			for ($y = 0; $y < $imagey; ++ $y)
			{
				$distx = rand( $this->offset * - 1, $this->offset );
				$disty = rand( $this->offset * - 1, $this->offset );
				
				if ($x + $distx >= $imagex)
					continue;
				if ($x + $distx < 0)
					continue;
				if ($y + $disty >= $imagey)
					continue;
				if ($y + $disty < 0)
					continue;
				
				$oldcol = imagecolorat( $resource, $x, $y );
				$newcol = imagecolorat( $resource, $x + $distx, $y + $disty );
				imagesetpixel( $resource, $x, $y, $newcol );
				imagesetpixel( $resource, $x + $distx, $y + $disty, $oldcol );
			}
		}
	}
}