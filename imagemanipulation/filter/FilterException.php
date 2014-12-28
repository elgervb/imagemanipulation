<?php
namespace imagemanipulation\filter;
/**
 * @package image
 * @subpackage imagefilter
 */
class FilterException extends \Exception
{

	/**
	 *
	 * @param message[optional]
	 * @param code[optional]
	 */
	public function __construct( $aFilterType )
	{
		parent::__construct( "Could not apply filter " + $aFilterType, 0 );
	}
}