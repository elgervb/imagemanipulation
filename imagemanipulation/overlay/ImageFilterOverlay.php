<?php
namespace imagemanipulation\overlay;

use imagemanipulation\filter\IImageFilter;
use imagemanipulation\ImageResource;
use imagemanipulation\ImageImageResource;

class ImageFilterOverlay implements IImageFilter
{
    private $opacity;
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
     * @param number $aOpacity The opacity between 0 and 100
     * @param number $startX start X pixel of the overlay
     * @param number $startY start Y pixel of the overlay
     * @param boolean $fill Fill the overlay using the height of the original image, or use the size of the overlay
     */
    public function __construct(ImageResource $aOverlay, $aOpacity = 50, $startX = 0, $startY = 0, $fill = true){
        assert ('$aOpacity <= 100'); 
        assert ('$aOpacity >= 0');
        
        $this->opacity = $aOpacity;
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
        $placeholder = imagecreatetruecolor($aResource->getX(), $aResource->getY());
        imagealphablending($placeholder, false);
        imagesavealpha($placeholder,true);
        
        $destWidth = $this->fill ? $aResource->getX() : $this->overlay->getX();
        $destHeight = $this->fill ? $aResource->getY() : $this->overlay->getY();
        
        imagecopyresized($placeholder, $this->overlay->getResource(), 0, 0, 0, 0, $destWidth, $destHeight, $this->overlay->getX(), $this->overlay->getY());
        imagecopymerge($aResource->getResource(), $placeholder, $this->startX, $this->startY, 0, 0, $destWidth, $destHeight,     $this->opacity);
    }
}