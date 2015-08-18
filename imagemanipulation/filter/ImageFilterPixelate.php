<?php
namespace imagemanipulation\filter;

use imagemanipulation\ImageResource;
/**
 * Pixelate an image
 */
class ImageFilterPixelate implements IImageFilter
{
	private $blocksize;
	
	/**
	 * Creates a new Pixelate filter
	 * @param int $aBlocksize the blocksize in pixels
	 */
	public function __construct( $aBlocksize = 20 )
	{
		$this->blocksize = $aBlocksize;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \imagemanipulation\filter\IImageFilter::applyFilter()
	 */
	public function applyFilter( ImageResource $aResource )
	{
		if ($this->blocksize < 1)
			return;
		
		$resource = $aResource->getResource();
		$imagex = imagesx( $resource );
		$imagey = imagesy( $resource );
		
		for ($x = 0; $x < $imagex; $x += $this->blocksize)
		{
			for ($y = 0; $y < $imagey; $y += $this->blocksize)
			{
				// get the pixel colour at the top-left of the square
				$thiscol = imagecolorat( $resource, $x, $y );
				
				// set the new red, green, and blue values to 0
				$newr = 0;
				$newg = 0;
				$newb = 0;
				
				// create an empty array for the colours
				$colours = array();
				
				// cycle through each pixel in the block
				for ($k = $x; $k < $x + $this->blocksize; ++ $k)
				{
					for ($l = $y; $l < $y + $this->blocksize; ++ $l)
					{
						// if we are outside the valid bounds of the image, use a safe colour
						if ($k < 0)
						{
							$colours[] = $thiscol;
							continue;
						}
						if ($k >= $imagex)
						{
							$colours[] = $thiscol;
							continue;
						}
						if ($l < 0)
						{
							$colours[] = $thiscol;
							continue;
						}
						if ($l >= $imagey)
						{
							$colours[] = $thiscol;
							continue;
						}
						
						// if not outside the image bounds, get the colour at this pixel
						$colours[] = imagecolorat( $resource, $k, $l );
					}
				}
				
				// cycle through all the colours we can use for sampling
				foreach ($colours as $colour)
				{
					// add their red, green, and blue values to our master numbers
					$newr += ($colour >> 16) & 0xFF;
					$newg += ($colour >> 8) & 0xFF;
					$newb += $colour & 0xFF;
				}
				
				// now divide the master numbers by the number of valid samples to get an average
				$numelements = count( $colours );
				$newr /= $numelements;
				$newg /= $numelements;
				$newb /= $numelements;
				
				// and use the new numbers as our colour
				$newcol = imagecolorallocate( $resource, $newr, $newg, $newb );
				imagefilledrectangle( $resource, $x, $y, $x + $this->blocksize - 1, $y + $this->blocksize - 1, $newcol );
			}
		}
	}
}