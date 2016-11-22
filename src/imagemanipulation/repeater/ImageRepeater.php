<?php
namespace imagemanipulation\repeater;

use imagemanipulation\ImageResource;
use imagemanipulation\ImageUtil;
use imagemanipulation\Args;

class ImageRepeater {
	
	private $resource;
	private $height;
	private $width;
	
	public function __construct(ImageResource $aResource, $width, $height){
		$this->resource = $aResource;
		$this->width= Args::int($width, 'width')->required()->min(0)->value();
		$this->height=Args::int($height, 'height')->required()->min(0)->value();
	}
	
	public function apply(){
		$res = ImageUtil::createTransparentImage($this->width, $this->height);
		
		$horizontal = 0;
		$vertical = 0;
		
		while ($horizontal < $this->width && $vertical < $this->height){
			
			$width = min( 500, $this->width - $horizontal);
			$height = min( 500, $this->height - $vertical);
			
			$result = imagecopy($res, $this->resource->getResource(), $horizontal, $vertical, 0, 0, $width, $height);
			if (!$result) throw new \Exception ('Could not copy image');
			
			$horizontal += $this->resource->getX();
			if ($horizontal >= $this->width){
				$horizontal = 0;
				$vertical += $this->resource->getY();
			}
		}
		
		return new ImageResource($res);
	}
}