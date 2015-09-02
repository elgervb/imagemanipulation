<?php
namespace imagemanipulation\overlay;

use imagemanipulation\filter\IImageFilter;
use imagemanipulation\ImageResource;
use imagemanipulation\ImageImageResource;

class ImageFilterOverlayWithAlpha implements IImageFilter
{
    /**
     * The overlay file
     * @var ImageResource
     */
    private $overlay;
    
    private $startX;
    private $startY;
    private $fill;
    
    /**
     * Creates a new overlay
     * 
     * @param ImageResource $aOverlay The overlay to apply
     * @param number $startX start X pixel of the overlay
     * @param number $startY start Y pixel of the overlay
     * @param boolean $fill Fill the overlay using the height of the original image, or use the size of the overlay
     */
    public function __construct(ImageResource $aOverlay, $startX = 0, $startY = 0, $fill = true){
        
        $this->overlay = $aOverlay;
        $this->startX = $startX;
        $this->startY = $startY;
        $this->fill = $fill;
    }

    /**
     * (non-PHPdoc)
     * @see \imagemanipulation\filter\IImageFilter::applyFilter()
     */
    public function applyFilter(ImageResource $aResource)
    {
        $destWidth = $this->fill ? $aResource->getX() : $this->overlay->getX();
        $destHeight = $this->fill ? $aResource->getY() : $this->overlay->getY();
        
        imagealphablending($this->overlay->getResource(), false);
        imagesavealpha($this->overlay->getResource(), false);
        
        imagecopyresized($this->overlay->getResource(), $this->overlay->getResource(), 0, 0, 0, 0, $destWidth, $destHeight, $this->overlay->getX(), $this->overlay->getY());
        
        imagealphablending($aResource->getResource(), true);
        imagesavealpha($aResource->getResource(), true);
        
        imagecopyresampled($aResource->getResource(), $this->overlay->getResource(), $this->startX, $this->startY, 0, 0, $destWidth, $destHeight, $destWidth, $destHeight);
    }
}