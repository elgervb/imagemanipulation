<?php
namespace imagemanipulation\overlay;

use imagemanipulation\ImageBuilder;
use imagemanipulation\ImageType;
class OverlayBuilderTest extends \ImageFilterTestCase
{
    public function testVignette(){
        $builder = new ImageBuilder($this->getOriginalImage(ImageType::JPG));
        $builder->overlay(10);
        
        $builder->save(new \SplFileInfo('/overlay.jpg'), true);
    }
}
