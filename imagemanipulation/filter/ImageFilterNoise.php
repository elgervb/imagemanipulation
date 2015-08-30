<?php
namespace imagemanipulation\filter;

use imagemanipulation\ImageResource;
/**
 * add noise to the image
 *
 * @package image
 * @subpackage Imagefilter
 *
 *@see http://www.tuxradar.com/practicalphp/11/2/22
 */
class ImageFilterNoise implements IImageFilter
{
	private $noise;
	
	public function __construct( $aNoise = 20 )
	{
		$this->noise = $aNoise;
	}
	
    /**
     * (non-PHPdoc)
     * @see \imagemanipulation\filter\IImageFilter::applyFilter()
     */
	public function applyFilter( ImageResource $aResource )
	{
		if ($this->noise === 0)
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
				if (rand( 0, 1 ))
				{
					$rgb = imagecolorat( $resource, $x, $y );
					$red = ($rgb >> 16) & 0xFF;
					$green = ($rgb >> 8) & 0xFF;
					$blue = $rgb & 0xFF;
					$modifier = rand( $this->noise * - 1, $this->noise );
					$red += $modifier;
					$green += $modifier;
					$blue += $modifier;
					
					if ($red > 255)
						$red = 255;
					if ($green > 255)
						$green = 255;
					if ($blue > 255)
						$blue = 255;
					if ($red < 0)
						$red = 0;
					if ($green < 0)
						$green = 0;
					if ($blue < 0)
						$blue = 0;
					
					$newcol = imagecolorallocate( $resource, $red, $green, $blue );
					imagesetpixel( $resource, $x, $y, $newcol );
				}
			}
		}
	}
}