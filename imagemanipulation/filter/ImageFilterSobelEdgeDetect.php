<?php
namespace imagemanipulation\filter;

use imagemanipulation\ImageResource;
use imagemanipulation\color\ColorUtil;
use imagemanipulation\filter\IImageFilter;
/**
 * Sobel edge detect (extremely slow...)
 */
class ImageFilterSobelEdgeDetect implements IImageFilter
{
	/**
	 * Applies the filter to the resource
	 *
	 * @param ImageResource $aResource
	 */
	public function applyFilter( ImageResource $aResource )
	{
		$orig_time_limit = ini_get('max_execution_time');
		set_time_limit(180);
		// creating the image
		$starting_img = $aResource->getResource();
		// this will be the final image, same width and height of the original
		$final = imagecreatetruecolor($aResource->getX(), $aResource->getY());
		// looping through ALL pixels!!
		for($x=1;$x<$aResource->getX()-1;$x++){
			for($y=1;$y<$aResource->getY()-1;$y++){
				// getting gray value of all surrounding pixels
				$pixel_up = $this->getLuminance(imagecolorat($starting_img,$x,$y-1));
				$pixel_down = $this->getLuminance(imagecolorat($starting_img,$x,$y+1));
				$pixel_left = $this->getLuminance(imagecolorat($starting_img,$x-1,$y));
				$pixel_right = $this->getLuminance(imagecolorat($starting_img,$x+1,$y));
				$pixel_up_left = $this->getLuminance(imagecolorat($starting_img,$x-1,$y-1));
				$pixel_up_right = $this->getLuminance(imagecolorat($starting_img,$x+1,$y-1));
				$pixel_down_left = $this->getLuminance(imagecolorat($starting_img,$x-1,$y+1));
				$pixel_down_right = $this->getLuminance(imagecolorat($starting_img,$x+1,$y+1));
		
				// appliying convolution mask
				$conv_x = ($pixel_up_right+($pixel_right*2)+$pixel_down_right)-($pixel_up_left+($pixel_left*2)+$pixel_down_left);
				$conv_y = ($pixel_up_left+($pixel_up*2)+$pixel_up_right)-($pixel_down_left+($pixel_down*2)+$pixel_down_right);
		
				// calculating the distance
				$gray = (int)sqrt($conv_x*$conv_x+$conv_y+$conv_y);
		
				// inverting the distance not to get the negative image
				$gray = 255-$gray;
		
				// adjusting distance if it's greater than 255 or less than zero (out of color range)
				if($gray > 255){
					$gray = 255;
				}
				if($gray < 0){
					$gray = 0;
				}
		
				// creation of the new gray
				$new_gray  = imagecolorallocate($final,$gray,$gray,$gray);
		
				// adding the gray pixel to the new image
				imagesetpixel($final,$x,$y,$new_gray);
			}
		}
		imagedestroy($starting_img);
		$aResource->setResource($final);
		
		set_time_limit($orig_time_limit);
	}
	
	/**
	 * Get the luminance value
	 */
	private function getLuminance($pixel){
		$pixel = sprintf('%06x',$pixel);
		$red = hexdec(substr($pixel,0,2))*0.30;
		$green = hexdec(substr($pixel,2,2))*0.59;
		$blue = hexdec(substr($pixel,4))*0.11;
		return $red+$green+$blue;
	}
}