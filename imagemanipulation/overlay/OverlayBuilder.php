<?php
namespace imagemanipulation\overlay;

use imagemanipulation\ImageImageResource;
use imagemanipulation\overlay\ImageFilterOverlay;
use imagemanipulation\ImageResource;
use imagemanipulation\ImageBuilder;

class OverlayBuilder
{
    public function vignette(ImageBuilder $builder, $opacity = 64){
        $overlay = new ImageImageResource(new \SplFileInfo(__DIR__ . '/img/purple-lights.jpg'));
        
        $builder->filter(new ImageFilterOverlay($overlay, $opacity, 0 ,0, true));
        
        return $builder;
    }
}
