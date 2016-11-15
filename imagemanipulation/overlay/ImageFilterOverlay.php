<?php
namespace imagemanipulation\overlay;

use imagemanipulation\filter\IImageFilter;
use imagemanipulation\ImageResource;
use imagemanipulation\Args;

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
    public function __construct(ImageResource $overlay, $opacity = 50, $startX = 0, $startY = 0, $fill = true){
        
        $this->startX = Args::int($startX, 'startX')->required()->min(0)->value();
        $this->startY = Args::int($startY, 'startY')->required()->min(0)->value();
        $this->opacity = Args::int($opacity, 'opacity')->required()->min(1)->max(100)->value();
        $this->fill = Args::bool($fill, 'fill')->required()->value();
        
        $this->overlay = $overlay;
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