<?php

namespace imagemanipulation\watermark;

use imagemanipulation\ImageResource;
use imagemanipulation\watermark\ImageFilterWatermark;
use imagemanipulation\ImageBuilder;
use imagemanipulation\filter\IImageFilter;

class WatermarkBuilder implements IImageFilter {
	private $opacity;
	private $watermark;
	private $position;
	
	public function __construct(){
		//
	}
	
	public static function create(){
		return new WatermarkBuilder();
	}
	
	public function build(){
		return new ImageFilterWatermark($this->watermark, $this->position, $this->opacity);
	}
	
	public function opacity($aOpacity){
		$this->opacity = $aOpacity;
		return $this;
	}
	
	public function positionBottom(){
		$this->position = ImageFilterWatermark::POS_BOTTOM;
		return $this;
	}
	public function positionBottomLeft(){
		$this->position = ImageFilterWatermark::POS_BOTTOM_LEFT;
		return $this;
	}
	public function positionBottomRight(){
		$this->position = ImageFilterWatermark::POS_BOTTOM_RIGHT;
		return $this;
	}
	public function positionCenter(){
		$this->position = ImageFilterWatermark::POS_CENTER;
		return $this;
	}
	public function positionLeft(){
		$this->position = ImageFilterWatermark::POS_LEFT;
		return $this;
	}
	public function positionRight(){
		$this->position = ImageFilterWatermark::POS_RIGHT;
		return $this;
	}
	public function positionTop(){
		$this->position = ImageFilterWatermark::POS_TOP;
		return $this;
	}
	public function positionTopLeft(){
		$this->position = ImageFilterWatermark::POS_TOP_LEFT;
		return $this;
	}
	public function positionTopRight(){
		$this->position = ImageFilterWatermark::POS_TOP_RIGHT;
		return $this;
	}
	
	public function watermark(\SplFileInfo $aWatermark){
		assert('$aWatermark->isFile()');
		$this->watermark = $aWatermark;
		return $this;
	}
	/* (non-PHPdoc)
	 * @see \imagemanipulation\filter\IImageFilter::applyFilter()
	 */
	public function applyFilter(ImageResource $aResource) {
		$filter = $this->build();
		$filter->applyFilter($aResource);
	}
}