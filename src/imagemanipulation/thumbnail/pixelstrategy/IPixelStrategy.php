<?php
namespace imagemanipulation\thumbnail\pixelstrategy;
/**
 * Interface for a pixel calculating strategy
 *
 * @package image
 * @subpackage pixelstrategy
 */
use imagemanipulation\ImageResource;
use imagemanipulation\Coordinate;

interface IPixelStrategy
{
	/**
	 * Returns a pixel with the coordinates of the destination image begin point
	 *
	 * @param $aResource ImageResource The destination image resource
	 *       
	 * @return imagemanipulation\Coordinate
	 */
	public function getDestinationBegin( ImageResource $aResource );
	
	/**
	 * Returns a pixel with the coordinates of the destination image end point
	 *
	 * @param $aResource ImageResource The destination image resource
	 *       
	 * @return imagemanipulation\Coordinate
	 */
	public function getDestinationEnd( ImageResource $aResource );
	
	/**
	 * Returns a pixel with the coordinates of the source image begin point
	 *
	 * @param $aResource ImageResource The source image resource
	 *       
	 * @return imagemanipulation\Coordinate
	 */
	public function getSourceBegin( ImageResource $aResource );
	
	/**
	 * Returns a pixel with the coordinates of the source image end point
	 *
	 * @param $aResource ImageResource The source image resource
	 *       
	 * @return imagemanipulation\Coordinate
	 */
	public function getSourceEnd( ImageResource $aResource );

	/**
	 * Initializes the pixel strategy
	 *
	 * @param $aResource ImageImageResource
	 */
	public function init( ImageResource $aResource );

}