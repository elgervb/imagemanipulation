<?php
namespace imagemanipulation\filter;

use imagemanipulation\ImageResource;
use imagemanipulation\color\Color;
/**
 * add rounded corners to the image
 */
class ImageFilterRoundedCorners implements IImageFilter
{
	private $radius;
	private $color;
	
	public function __construct( $radius = 20, Color $color = null )
	{
		$this->radius = $radius;
		$this->color = $color ? $color : new Color('ffffff');
	}
	
    /**
     * (non-PHPdoc)
     * @see \imagemanipulation\filter\IImageFilter::applyFilter()
     */
	public function applyFilter( ImageResource $resource )
	{
		if ($this->radius === 0)
		{
			return;
		}
		
		$source_image = $resource->getResource();
		$source_width = $resource->getX();
		$source_height = $resource->getY();
		
		$corner_image = imagecreatetruecolor($this->radius,$this->radius);
		$clear_colour = imagecolorallocate($corner_image,0,0,0);
		imagecolortransparent($corner_image,$clear_colour);
		
		$solid_colour = imagecolorallocate($corner_image, $this->color->getRed(), $this->color->getGreen(), $this->color->getBlue());
		
		imagefill($corner_image,0,0,$solid_colour);
		imagefilledellipse($corner_image,$this->radius,$this->radius,$this->radius * 2,$this->radius * 2,$clear_colour);
		
		/*
		 * render the top-left, bottom-left, bottom-right, top-right corners by rotating and copying the mask
		 */
		imagecopymerge($source_image,$corner_image,0,0,0,0,$this->radius,$this->radius,100);
		
		$corner_image = imagerotate($corner_image, 90, 0);
        imagecopymerge($source_image,$corner_image,0,$source_height - $this->radius,0,0,$this->radius,$this->radius,100);
		
		$corner_image = imagerotate($corner_image, 90, 0);
        imagecopymerge($source_image,$corner_image,$source_width - $this->radius, $source_height - $this->radius,0,0,$this->radius,$this->radius,100);
		
		$corner_image = imagerotate($corner_image, 90, 0);
		imagecopymerge($source_image,$corner_image,$source_width - $this->radius,0,0,0,$this->radius,$this->radius,100);
	}
}