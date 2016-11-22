<?php
namespace imagemanipulation\generation;

use imagemanipulation\color\Color;
use imagemanipulation\ImageResource;
use imagemanipulation\ImageUtil;
use imagemanipulation\Args;

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
        Args::int($width, 'width')->required()->min(1);
        Args::int($height, 'height')->required()->min(1);
        
        $res   = new ImageResource( imagecreatetruecolor($width, $height) );
        $color = ImageUtil::allocateColor($res->getResource(), $color);
        imagefill($res->getResource(), 0, 0, $color);
        $res->saveAlpha();
        
        return $res;
    }
    
    /**
     * Generate a gradient image
     * 
     * @param int $width The new image width in pixels
     * @param int $height The new image height in pixels
     * @param int $start The start of the gradient in pixels
     * @param Color $src_color The start image color
     * @param Color $dest_color The end image color
     * 
     * @return \imagemanipulation\ImageResource
     */
    public static function gradient($width, $height, $start, Color $src_color, Color $dest_color){
        Args::int($width, 'width')->required()->min(1);
        Args::int($height, 'height')->required()->min(1);
        
        $res   = self::create($width, $height, $src_color);
        $img = $res->getResource();
        
        $srcA = $src_color->getAlpha();
        $srcR = $src_color->getRed();
        $srcG = $src_color->getGreen();
        $srcB = $src_color->getBlue();
         
        $destA = $dest_color->getAlpha();
        $destR = $dest_color->getRed();
        $destG = $dest_color->getGreen();
        $destB = $dest_color->getBlue();
         
        $incA = ($destA - $srcA) / ($width - $start);
        $incR = ($destR - $srcR) / ($width - $start);
        $incG = ($destG - $srcG) / ($width - $start);
        $incB = ($destB - $srcB) / ($width - $start);
         
        for ($i=$start;$i<$width;$i++){
            $srcA += $incA;
            $srcB += $incB;
            $srcG += $incG;
            $srcR += $incR;
            imagefilledrectangle($img, $i, 0, $i, $height,
                imagecolorallocatealpha($img, $srcR, $srcG, $srcB, $srcA)
            );
        }
        
        return $res;
    }
    
}