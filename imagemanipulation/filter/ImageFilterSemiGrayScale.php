<?php
namespace imagemanipulation\filter;

use imagemanipulation\ImageResource;
use imagemanipulation\overlay\ImageFilterOverlay;
/**
 * Applies grayscale to an image, optionally add a grayscale percentage
 *
 * @package image
 * @subpackage imagefilter
 */
class ImageFilterSemiGrayScale implements IImageFilter
{
    private $percentage;

    public function __construct($percentage = 100)
    {
        $this->percentage = $percentage;
    }

    /**
     * Applies the filter to the resource
     *
     * @param ImageResource $aResource            
     */
    public function applyFilter(ImageResource $aResource)
    {
        if ($this->percentage === 100) {
            $filter = new ImageFilterGrayScale();
            $filter->applyFilter($aResource);
        } else {
            $clone = $aResource->cloneResource();
            $filter = new ImageFilterGrayScale();
            $filter->applyFilter($clone);
            
            $overlayFilter = new ImageFilterOverlay($clone, 100 - $this->percentage); // grayscale clone
            $overlayFilter->applyFilter($aResource);
        }
    }
}