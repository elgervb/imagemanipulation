<?php
namespace imagemanipulation\generation;

use imagemanipulation\color\Color;
use imagemanipulation\ImageResource;
use imagemanipulation\ImageUtil;

class ImageGenerator{

    /**
     * Create a new image with specified width, height and color
     * 
     * @param int $width The new image width in pixels
     * @param int $height The new image height in pixels
     * @param Color $color The new image color
     * 
     * @return \imagemanipulation\ImageResource
     */
    public static function create($width, $height, Color $color){
        $res   = new ImageResource( imagecreatetruecolor($width, $height) );
        $color = ImageUtil::allocateColor($res->getResource(), $color);
        imagefill($res->getResource(), 0, 0, $color);
        $res->saveAlpha();
        
        return $res;
    }
    
}