<?php
namespace imagemanipulation\filter;

use imagemanipulation\ImageResource;
/** 
 * @author elger
 * 
 * 
 */
class ImageFilterConvolution implements IImageFilter
{
	/**
	 * @var array
	 */
	protected $matrix;
	
	public function __construct( $aArg1, $aArg2, $aArg3, $aArg4, $aArg5, $aArg6, $aArg7, $aArg8, $aArg9 )
	{
		$this->matrix = array(array($aArg1 , $aArg2 , $aArg3) , array($aArg4 , $aArg5 , $aArg6) , array($aArg7 , $aArg8 , $aArg8));
	}
	
	/**
	 * 
	 * @see IImageFilter::applyFilter()
	 */
	public function applyFilter( ImageResource $aResource )
	{
	    $this->beforeApplyFilter($aResource);
		imageconvolution( $aResource->getResource(), $this->matrix, $this->getDivision(), $this->getOffset() );
		$this->afterApplyFilter($aResource);
	}
	
	protected function beforeApplyFilter(ImageResource $aResource) {
	    //
	}
	
	protected function afterApplyFilter(ImageResource $aResource) {
	     //
	}
	
	protected function getDivision() {
	    return $this->computeDiv();
	}
	
	protected function getOffset() {
	    return 0;
	}
	
	final protected function computeDiv()
	{
		return array_sum( $this->matrix[0] ) + array_sum( $this->matrix[1] ) + array_sum( $this->matrix[2] );
	}

}