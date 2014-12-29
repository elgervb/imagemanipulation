<?php
namespace imagemanipulation;

use imagemanipulation\ImageBuilder;
use imagemanipulation\filter\ImageFilterContrast;
class PresetFilter
{
    public static function cool(ImageBuilder $builder){
        $builder->meanremove()->contrast(50);
    }
    
    public static function light(ImageBuilder $builder){
        $builder->brightness(10)->colorize('#643200', 10);
    }
    
    public static function boost(ImageBuilder $builder){
        $builder->contrast(35)->brightness(20);
    }
    
    public static function grayscaleDark(ImageBuilder $builder){
        $builder->grayscale()->contrast(15);
    }
    
    public static function sepia(ImageBuilder $builder){
        $builder->grayscale()->brightness(-10)->contrast(20)->colorize('#3C1E00');
    }
    
    public static function retro(ImageBuilder $builder){
        
        $builder->noise(40)->selectiveBlur()->selectiveBlur()->colorize('#704214', 65)->contrast(20)->brightness(10);
    }
}