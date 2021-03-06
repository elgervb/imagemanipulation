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
use imagemanipulation\filter\ImageFilterComic;
use imagemanipulation\thumbnail\Thumbalizer;
use imagemanipulation\thumbnail\pixelstrategy\CenteredPixelStrategy;
use imagemanipulation\thumbnail\pixelstrategy\PercentagePixelStrategy;
use imagemanipulation\thumbnail\pixelstrategy\MaxPixelStrategy;
use imagemanipulation\filter\ImageFilterDuotone;
use imagemanipulation\filter\ImageFilterTrueColor;
use imagemanipulation\filter\ImageFilterDuotoneTest;
use imagemanipulation\filter\ImageFilterSobelEdgeEnhance;
use imagemanipulation\filter\ImageFilterSemiGrayScale;
use imagemanipulation\filter\ImageFilterOldCardboard;
use imagemanipulation\filter\ImageFilterHueRotate;
use imagemanipulation\overlay\ImageFilterOverlayWithAlpha;
use imagemanipulation\filter\ImageFilterRoundedCorners;
use imagemanipulation\filter\ImageFilterEmbossColoring;

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
     * The file the image resource is mapped on
     *
     * @var \SplFileInfo
     */
    private $file;


    /**
     * Queue up all filter until we actually need them
     */
    private $queue;

    /**
     * Create a new ImageBuilder
     * @param \SplFileInfo $image
     */
    public function __construct(\SplFileInfo $image)
    {
        $this->res = new ImageImageResource($image);
        $this->queue = new \ArrayObject();
        $this->file = $image;
    }

    /**
     * @param number $aRate
     * @return \imagemanipulation\ImageBuilder
     *
     * @see ImageFilterBrightness::__construct
     */
    public function brightness($aRate = 20)
    {
        $this->queue->append(new ImageFilterBrightness($aRate));
        return $this;
    }

    /**
     * @param string $aColor
     * @param string $aAlpha
     * @return \imagemanipulation\ImageBuilder
     *
     * @see ImageFilterColorize::__construct
     */
    public function colorize($color = '2980b9', $alpha = null)
    {
        $color = new Color($color, $alpha);

        $this->queue->append(new ImageFilterColorize($color));
        return $this;
    }

    /**
     * @param number $opacity
     * @return \imagemanipulation\ImageBuilder
     *
     * @see ImageFilterComic::__construct
     */
    public function comic($opacity = 40){
        $this->queue->append(new ImageFilterComic($opacity));
        return $this;
    }

    /**
     *
     * @param number $aRate
     * @return \imagemanipulation\ImageBuilder
     *
     * @see ImageFilterContrast::__construct
     */
    public function contrast($aRate = 5)
    {
        $this->queue->append(new ImageFilterContrast($aRate));
        return $this;
    }

    /**
     * Creates a new ImageBuilder
     *
     * @param \SplFileInfo|string $aImage
     *
     * @return \imagemanipulation\ImageBuilder
     */
    public static function create($image)
    {
        if (! $image instanceof \SplFileInfo && is_string($image)){
            $image = new \SplFileInfo($image);
        }
        return new ImageBuilder($image);
    }

    /**
     * @return \imagemanipulation\ImageBuilder
     */
    public function darken($aRate = 5)
    {
        $this->queue->append(new ImageFilterDarken($aRate));
        return $this;
    }

    /**
     * @return \imagemanipulation\ImageBuilder
     */
    public function dodge($aRate = 50)
    {
        $this->queue->append(new ImageFilterDodge($aRate));
        return $this;
    }

    /**
	 * Apply a duotone filter
	 *
	 * @param int $red The amount of red to add max = 255
	 * @param int $green The amount of green to add max = 255
	 * @param int $bleu The amount of blue to add max = 255
     *
     * @return \imagemanipulation\ImageBuilder
	 */
    public function duotone($red = 0, $green = 0, $blue = 0)
    {
        $this->queue->append(new ImageFilterDuotone($red, $green, $blue));
        return $this;
    }

    /**
     * Apply an edgedetect filter
     *
     * @return \imagemanipulation\ImageBuilder
     */
    public function edgeDetect()
    {
        $this->queue->append(new ImageFilterEdgeDetect());
        return $this;
    }

    /**
     * Apply an emboss filter
     *
     * @param boolean $colorPreserve whether or not to preserve colors
     *
     * @return \imagemanipulation\ImageBuilder
     */
    public function emboss($colorPreserve = false)
    {
        if ($colorPreserve) {
            $this->queue->append(new ImageFilterEmbossColoring());
        } else {
            $this->queue->append(new ImageFilterEmboss());
        }
        return $this;
    }

    /**
     * Flips an image horizontally, vertically or both
     *
     * @return \imagemanipulation\ImageBuilder
     */
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
     * @return \imagemanipulation\ImageBuilder
     */
    public function filter(IImageFilter $aFilter)
    {
        $this->queue->append($aFilter);
        return $this;
    }

    /**
     * Apply an edge detection filter
     *
     * @return \imagemanipulation\ImageBuilder
     */
    public function findEdges()
    {
        $this->queue->append(new ImageFilterFindEdges());
        return $this;
    }

    /**
     * Apply a gamma correction filter
     *
     * @param float $input
     * @param float $output
     *
     * @return \imagemanipulation\ImageBuilder
     */
    public function gammaCorrection($input = 1.0, $output = 1.537){
        $this->queue->append(new ImageFilterGammaCorrection($input, $output));
        return $this;
    }

    /**
     * Apply a gaussian blur filter
     *
     * @return \imagemanipulation\ImageBuilder
     */
    public function gaussianBlur()
    {
        $this->queue->append(new ImageFilterGaussianBlur());
        return $this;
    }

    /**
     * Apply a grayscale filter
     *
     * @return \imagemanipulation\ImageBuilder
     * @deprecated
     */
    public function grayscale()
    {
        return $this->greyscale();
    }

    /**
     * Apply a greyscale filter
     *
     * @return \imagemanipulation\ImageBuilder
     */
    public function greyscale()
    {
        $this->queue->append(new ImageFilterGrayScale());
        return $this;
    }

    /**
     * Apply a hue rotate filter
     *
     * @return \imagemanipulation\ImageBuilder
     */
    public function hueRotate($degrees = 90)
    {
        $this->queue->append(new ImageFilterHueRotate($degrees));
        return $this;
    }

    /**
     * Apply a mean remove filter
     *
     * @return \imagemanipulation\ImageBuilder
     */
    public function meanremove()
    {
        $this->queue->append(new ImageFilterMeanRemove());
        return $this;
    }

    /**
     * Apply a motion blur filter
     *
     * @return \imagemanipulation\ImageBuilder
     */
    public function motionBlur(){
        $this->queue->append(new ImageFilterMotionBlur());
        return $this;
    }

    /**
     * Apply a negitive filter
     *
     * @return \imagemanipulation\ImageBuilder
     */
    public function negative()
    {
        $this->queue->append(new ImageFilterNegative());
        return $this;
    }

    /**
     * Apply a noise filter
     *
     * @return \imagemanipulation\ImageBuilder
     */
    public function noise($aRate = 20)
    {
        $this->queue->append(new ImageFilterNoise($aRate));
        return $this;
    }

    /**
     * Apply an oldCardboard filter
     *
     * @return \imagemanipulation\ImageBuilder
     */
    public function oldCardboard()
    {
        $this->queue->append(new ImageFilterOldCardboard());
        return $this;
    }

    /**
     *
     * @see ImageFilterOpacity::__construct
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

    public function overlay($overlayFile, $opacity = 64, $startX = 0, $startY = 0, $fill = true){
        $overlay = new ImageImageResource(new \SplFileInfo($overlayFile));

        if(ord(file_get_contents($overlayFile, NULL, NULL, 25, 1)) == 6) {
            $this->filter(new ImageFilterOverlayWithAlpha($overlay, 0 ,0, $fill));
        }
        else{
            $this->filter(new ImageFilterOverlay($overlay, $opacity, 0 ,0, $fill));
        }
        return $this;
    }


    /**
     * @see ImageFilterPixelate::__construct
     *
     * @param int $rate
     *
     * @return \imagemanipulation\ImageBuilder
     *
     */
    public function pixelate($rate = 10)
    {
        $this->queue->append(new ImageFilterPixelate($rate));
        return $this;
    }

    /**
     * @return \imagemanipulation\ImageBuilder
     */
    public function randomBlocks($aNumberOfBlocks = 100, $aBlockSize = 25, $aBlockColor = 'FFFFFF')
    {
        $this->queue->append(new ImageFilterRandomBlocks($aNumberOfBlocks, $aBlockSize, $aBlockColor));
        return $this;
    }

    /**
     * @return \imagemanipulation\ImageBuilder
     */
    public function replace($aSearches, $aReplace)
    {
        $this->queue->append(new ImageFilterReplaceColor($aSearches, $aReplace));
        return $this;
    }

    /**
     * @return \imagemanipulation\ImageBuilder
     */
    public function rotate($aDegrees = 90, $aBgColor = null)
    {
        $this->queue->append(new ImageFilterRotate($aDegrees, $aBgColor));
        return $this;
    }

    /**
     * @return \imagemanipulation\ImageBuilder
     */
    public function roundedCorners($degrees = 20, $color = null)
    {
        $color = $color ? new Color($color) : new Color('444444');
        $this->queue->append(new ImageFilterRoundedCorners($degrees, $color));
        return $this;
    }

    /**
     * @see ImageFilterScatter::__construct
     * @param int $aOffset The offset of the scatter points. The larget the number, the more scattered
     * @return \imagemanipulation\ImageBuilder
     */
    public function scatter($aOffset = 4)
    {
        $this->queue->append(new ImageFilterScatter($aOffset));
        return $this;
    }

    /**
     * @return \imagemanipulation\ImageBuilder
     */
    public function selectiveBlur()
    {
        $this->queue->append(new ImageFilterSelectiveBlur());
        return $this;
    }

    /**
     * @return \imagemanipulation\ImageBuilder
     */
    public function semiGrayscale($rate = 50)
    {
        $this->queue->append(new ImageFilterSemiGrayScale($rate));
        return $this;
    }

    /**
     * @return \imagemanipulation\ImageBuilder
     */
    public function sepia($aDarken = 15)
    {
        $this->queue->append(new ImageFilterSepia($aDarken));
        return $this;
    }

    /**
     * @return \imagemanipulation\ImageBuilder
     */
    public function sepiaFast()
    {
        $this->queue->append(new ImageFilterSepiaFast());
        return $this;
    }

    /**
     * @return \imagemanipulation\ImageBuilder
     */
    public function sharpen()
    {
        $this->queue->append(new ImageFilterSharpen());
        return $this;
    }

    /**
     * @return \imagemanipulation\ImageBuilder
     */
    public function smooth($aRate = 5)
    {
        $this->queue->append(new ImageFilterSmooth($aRate));
        return $this;
    }

    /**
     * @return \imagemanipulation\ImageBuilder
     */
    public function sobelEdgeDetect()
    {
        $this->queue->append(new ImageFilterSobelEdgeDetect());
        return $this;
    }

    /**
     * @return \imagemanipulation\ImageBuilder
     */
    public function sobelEdgeEnhance()
    {
        $this->queue->append(new ImageFilterSobelEdgeEnhance());
        return $this;
    }

    /**
     * @return \imagemanipulation\ImageBuilder
     */
    public function thumbCentered($width, $height){
        $t = new Thumbalizer(new CenteredPixelStrategy($width, $height));

        $t->create($this->res);

        return $this;
    }

    /**
     * @return \imagemanipulation\ImageBuilder
     */
    public function thumbMax($width, $height){
        $t = new Thumbalizer(new MaxPixelStrategy($width, $height));

        $t->create($this->res);

        return $this;
    }

    /**
     * @return \imagemanipulation\ImageBuilder
     */
    public function thumbPercentage($percentage){
        $t = new Thumbalizer(new PercentagePixelStrategy($percentage));

        $t->create($this->res);

        return $this;
    }

    /**
     * @return \imagemanipulation\ImageBuilder
     */
    public function thumbSquare($width){
        $t = new Thumbalizer(new CenteredPixelStrategy($width, $width));

        $t->create($this->res);

        return $this;
    }

    /**
     * @return \imagemanipulation\ImageBuilder
     */
    public function truecolor($primary = 'FFFFFF', $secundary = "000000"){
        $this->queue->append(new ImageFilterTrueColor($primary, $secundary));

        return $this;
    }

    /**
     * @return \imagemanipulation\ImageBuilder
     */
    public function vignette()
    {
        $this->queue->append(new ImageFilterVignette());
        return $this;
    }

    /**
     * Renders the image. This will add the appropriate headers and streams the image
     *
     * @param string $aQuality
     */
    public function render($aQuality = null)
    {
        if ($aQuality != null) {
            $this->res->setQuality($aQuality);
        }

        $this->applyFilters();

        $this->res->render(ImageType::getType($this->res->getOutputPath()));
    }

    /**
     * Saves the image to disk
     *
     * @param \SplFileInfo $file the filename of the new image. Leave null with overwrite = false to automatically create a new file with the .copy pre-extension. the .copy file will be overwritten on next change...
     * @param string $aOverwrite wether or not to overwrite the file
     *
     * @return \imagemanipulation\ImageBuilder $this for chaining
     */
    public function save(\SplFileInfo $file = null, $aOverwrite = false)
    {
        $search = ".".$this->file->getExtension();
        if ($file === null && $aOverwrite === false && ! strstr($this->file->getPathname(), '.copy'.$search)){
            $file = new \SplFileInfo(str_replace($search, ".copy".$search, $this->file->getPathname()));
        }
        else if ($file === null){
            $file = $this->file;
        }

        $this->applyFilters();

        $this->res->setIsOverwrite($aOverwrite);
        $this->res->setOutputPath($file);
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
