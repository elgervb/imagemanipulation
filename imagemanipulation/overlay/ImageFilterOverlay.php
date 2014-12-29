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
     * @var \SplFileInfo
     */
    private $overlay;
    
    public function __construct(\SplFileInfo $aOverlay, $aOpacity = 50){
        $this->opacity = $aOpacity;
        $this->overlay = $aOverlay;
    }

    public function applyFilter(ImageResource $aResource)
    {
        $overlayRes = new ImageImageResource($this->overlay);
        
        $placeholder = imagecreatetruecolor($aResource->getX(), $aResource->getY());
        imagealphablending($placeholder, false);
        imagesavealpha($placeholder,true);
        
        imagecopyresized($placeholder, $overlayRes->getResource(), 0, 0, 0, 0, $aResource->getX(), $aResource->getY(), $overlayRes->getX(), $overlayRes->getY());
        
        imagecopymerge($aResource->getResource(), $placeholder, 0, 0, 0, 0, $aResource->getX(), $aResource->getY(), $this->opacity);
    }
}