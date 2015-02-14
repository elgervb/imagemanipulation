<?php
namespace imagemanipulation;

use imagemanipulation\color\Color;
use imagemanipulation\ImageImageResource;
use imagemanipulation\filter\ImageFilterBrightness;
use imagemanipulation\filter\ImageFilterColorize;
use imagemanipulation\color\ColorUtil;
use imagemanipulation\filter\ImageFilterContrast;
use imagemanipulation\filter\ImageFilterDarken;
use imagemanipulation\filter\ImageFilterDodge;
use imagemanipulation\filter\ImageFilterEdgeDetect;
use imagemanipulation\filter\ImageFilterSobelEdgeDetect;
use imagemanipulation\filter\ImageFilterEmboss;
use imagemanipulation\filter\ImageFilterFlip;
use imagemanipulation\filter\ImageFilterFindEdges;
use imagemanipulation\filter\ImageFilterGaussianBlur;
use imagemanipulation\filter\ImageFilterGrayScale;
use imagemanipulation\filter\ImageFilterMeanRemove;
use imagemanipulation\filter\ImageFilterNegative;
use imagemanipulation\filter\ImageFilterNoise;
use imagemanipulation\filter\ImageFilterOpacity;
use imagemanipulation\filter\ImageFilterPixelate;
use imagemanipulation\filter\ImageFilterReplaceColor;
use imagemanipulation\filter\ImageFilterScatter;
use imagemanipulation\filter\ImageFilterSelectiveBlur;
use imagemanipulation\filter\ImageFilterSepia;
use imagemanipulation\filter\ImageFilterSepiaFast;
use imagemanipulation\filter\ImageFilterSharpen;
use imagemanipulation\filter\ImageFilterSmooth;
use imagemanipulation\filter\ImageFilterRandomBlocks;
use imagemanipulation\rotate\ImageFilterRotate;
use imagemanipulation\watermark\WatermarkBuilder;
use imagemanipulation\filter\ImageFilterVignette;
use imagemanipulation\filter\IImageFilter;
use imagemanipulation\filter\ImageFilterGammaCorrection;
use imagemanipulation\filter\ImageFilterMotionBlur;
use imagemanipulation\overlay\ImageFilterOverlay;
/*
 * TODO checkout https://github.com/marchibbins/GD-Filter-testing
 */
class ImageBuilder
{

    /**
     * The actual image resource
     * 
     * @var ImageImageResource
     */
    private $res;

    /**
     * Queue up all filter until we actually need them
     */
    private $queue;

    public function __construct(\SplFileInfo $aImage)
    {
        $this->res = new ImageImageResource($aImage);
        $this->queue = new \ArrayObject();
    }

    public function brightness($aRate = 20)
    {
        $this->queue->append(new ImageFilterBrightness($aRate));
        return $this;
    }

    public function colorize($aColor = 'FFFFFF', $aAlpha = null)
    {
        $color = new Color($aColor, $aAlpha);
        
        $this->queue->append(new ImageFilterColorize($color));
        return $this;
    }

    public function contrast($aRate = 5)
    {
        $this->queue->append(new ImageFilterContrast($aRate));
        return $this;
    }

    /**
     * Creates a new ImageBuilder
     *
     * @param \SplFileInfo $aImage            
     *
     * @return \imagemanipulation\ImageBuilder
     */
    public static function create(\SplFileInfo $aImage)
    {
        return new ImageBuilder($aImage);
    }

    public function darken($aRate = 5)
    {
        $this->queue->append(new ImageFilterDarken($aRate));
        return $this;
    }

    public function dodge($aRate = 50)
    {
        $this->queue->append(new ImageFilterDodge($aRate));
        return $this;
    }

    public function edgeDetect()
    {
        $this->queue->append(new ImageFilterEdgeDetect());
        return $this;
    }

    public function emboss()
    {
        $this->queue->append(new ImageFilterEmboss());
        return $this;
    }

    public function flip($aFlip = ImageFilterFlip::FLIP_HORIZONTALLY)
    {
        $horizontally = $aFlip == ImageFilterFlip::FLIP_HORIZONTALLY || $aFlip == ImageFilterFlip::FLIP_BOTH;
        $vertically = $aFlip == ImageFilterFlip::FLIP_VERTICALLY || $aFlip == ImageFilterFlip::FLIP_BOTH;
        $this->queue->append(new ImageFilterFlip($horizontally, $vertically));
        return $this;
    }

    /**
     * Apply a filter to the image
     *
     * @param IImageFilter $aFilter            
     *
     * @return ImageBuilder $this for chaining
     */
    public function filter(IImageFilter $aFilter)
    {
        $this->queue->append($aFilter);
        return $this;
    }

    public function findEdges()
    {
        $this->queue->append(new ImageFilterFindEdges());
        return $this;
    }
    
    public function gammaCorrection($aInput = 1.0, $aOutput = 1.537){
        $this->queue->append(new ImageFilterGammaCorrection($aInput, $aOutput));
        return $this;
    }

    public function gaussianBlur()
    {
        $this->queue->append(new ImageFilterGaussianBlur());
        return $this;
    }

    public function grayscale()
    {
        $this->queue->append(new ImageFilterGrayScale());
        return $this;
    }

    public function meanremove()
    {
        $this->queue->append(new ImageFilterMeanRemove());
        return $this;
    }
    
    public function motionBlur(){
        $this->queue->append(new ImageFilterMotionBlur());
        return $this;
    }

    public function negative()
    {
        $this->queue->append(new ImageFilterNegative());
        return $this;
    }

    public function noise($aRate = 20)
    {
        $this->queue->append(new ImageFilterNoise($aRate));
        return $this;
    }

    /**
     *
     * @see ImageFilterOpacity
     *
     * @param number $aRate
     *            A value between 0 and 127. 0 indicates completely opaque while 127 indicates completely transparent.
     *            
     * @return \imagemanipulation\ImageBuilder
     */
    public function opacity($aRate = 50)
    {
        $this->queue->append(new ImageFilterOpacity($aRate));
        return $this;
    }
    
    public function overlay(ImageResource $overlay, $opacity = 50, $startX = 0, $startY = 0, $fill = true){
    	$this->queue->append(new ImageFilterOverlay($overlay, $opacity, $startX, $startY, $fill ));
    	
    	return $this;
    }

    public function pixelate($aRate = 10)
    {
        $this->queue->append(new ImageFilterPixelate($aRate));
        return $this;
    }

    public function randomBlocks($aNumberOfBlocks = 100, $aBlockSize = 25, $aBlockColor = 'FFFFFF')
    {
        $this->queue->append(new ImageFilterRandomBlocks($aNumberOfBlocks, $aBlockSize, $aBlockColor));
        return $this;
    }

    public function replace($aSearches, $aReplace)
    {
        $this->queue->append(new ImageFilterReplaceColor($aSearches, $aReplace));
        return $this;
    }

    public function rotate($aDegrees = 90, $aBgColor = null)
    {
        $this->queue->append(new ImageFilterRotate($aDegrees, $aBgColor));
        return $this;
    }

    public function scatter($aOffset = 4)
    {
        $this->queue->append(new ImageFilterScatter($aOffset));
        return $this;
    }

    public function selectiveBlur()
    {
        $this->queue->append(new ImageFilterSelectiveBlur());
        return $this;
    }

    public function sepia($aDarken = 15)
    {
        $this->queue->append(new ImageFilterSepia($aDarken));
        return $this;
    }

    public function sepiaFast()
    {
        $this->queue->append(new ImageFilterSepiaFast());
        return $this;
    }

    public function sharpen()
    {
        $this->queue->append(new ImageFilterSharpen());
        return $this;
    }

    public function smooth($aRate = 5)
    {
        $this->queue->append(new ImageFilterSmooth($aRate));
        return $this;
    }

    public function sobelEdgeDetect()
    {
        $this->queue->append(new ImageFilterSobelEdgeDetect());
        return $this;
    }

    public function vignette()
    {
        $this->queue->append(new ImageFilterVignette());
        return $this;
    }

    /**
     *
     * @param string $aQuality            
     */
    public function render($aQuality = null)
    {
        if ($aQuality != null) {
            $this->res->setQuality($aQuality);
        }
        
        $this->applyFilters();
        
        // set the correct header when output to screen
        header("Content-Type:", 'image/' . $this->res->getOutputPath()->getExtension());
        $this->res->outputImage();
    }

    /**
     * Saves the image to disk
     *
     * @param \SplFileInfo $aFile            
     * @param string $aOverwrite            
     *
     * @return \imagemanipulation\ImageBuilder $this for chaining
     */
    public function save(\SplFileInfo $aFile, $aOverwrite = false)
    {
        $this->applyFilters();
        
        $this->res->setIsOverwrite($aOverwrite);
        $this->res->setOutputPath($aFile);
        $this->res->createImage();
        
        return $this;
    }
    /**
     * Returns the image resource
     * 
     * @return \imagemanipulation\ImageImageResource
     */
    public function toResource(){
    	$this->applyFilters();
    	return $this->res;
    }

    public function watermarkBuilder()
    {
        $builder = new WatermarkBuilder();
        $this->queue->append($builder);
        return $builder;
    }

    private function applyFilters()
    {
        if ($this->queue->count() > 0) {
            /* @var $filter \imagemanipulation\filter\IImageFilter */
            foreach ($this->queue as $filter) {
                $filter->applyFilter($this->res);
            }
            
            $this->queue = new \ArrayObject();
        }
    }
}