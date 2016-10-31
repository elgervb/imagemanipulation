<?php
namespace imagemanipulation\filter;

use imagemanipulation\ImageResource;
use imagemanipulation\overlay\ImageFilterOverlay;
use imagemanipulation\Args;
/**
 * Applies grayscale to an image, optionally add a grayscale percentage
 *
 * @package image
 * @subpackage imagefilter
 */
class ImageFilterSemiGrayScale implements IImageFilter
{
    private $percentage;

    public function __construct($percentage = 50)
    {
        $this->percentage = Args::int($percentage, 'percentage')->required()->min(0)->max(100)->value();
    }

    /**
     * Applies the filter to the resource
     *
     * @param ImageResource $aResource            
     */
    public function applyFilter(ImageResource $aResource)
    {
        if ($this->percentage === 0) {
            return $aResource;
        } else if ($this->percentage === 100) {
            $filter = new ImageFilterGrayScale();
            $filter->applyFilter($aResource);
        } else {
            $clone = $aResource->cloneResource();
            $filter = new ImageFilterGrayScale();
            $filter->applyFilter($clone);
            
            $overlayFilter = new ImageFilterOverlay($clone, $this->percentage); // grayscale clone
            $overlayFilter->applyFilter($aResource);
        }
    }
}