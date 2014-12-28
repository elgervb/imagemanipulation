<?php
namespace imagemanipulation\filter;

use imagemanipulation\color\Color;

use imagemanipulation\ImageResource;
use imagemanipulation\color\ColorUtil;
use imagemanipulation\filter\IImageFilter;
/**
 * Replaces a color of an image
 */
class ImageFilterReplaceColor implements IImageFilter
{
	private $search;
	private $replace;
	
	public function __construct( $aSearches, $aReplace )
	{
		if (!is_array($aSearches)){
			$aSearches = array($aSearches);
		}
		$this->search = $aSearches;
		$this->replace = $aReplace instanceof Color ?  $aReplace : new Color($aReplace);
	}
	
	/**
	 * Applies the filter to the resource
	 *
	 * @param ImageResource $aResource
	 */
	public function applyFilter( ImageResource $aResource )
	{
		$dest = $aResource->getResource();
		if (imageistruecolor($dest)) {
			imagetruecolortopalette($dest, false, 256);
		}
		
		foreach ($this->search as $search){
			$searchRgb = new Color($search);
			$index = imagecolorclosest ( $aResource->getResource(),  $searchRgb->getRed(), $searchRgb->getGreen(), $searchRgb->getBlue() ); // get White COlor
			imagecolorset($aResource->getResource(), $index, $this->replace->getRed(), $this->replace->getGreen(), $this->replace->getBlue()); // SET NEW COLOR
		}
	
		$aResource->setResource($dest);
	}
}