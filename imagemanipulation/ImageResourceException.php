<?php
namespace imagemanipulation;
/**
 * Exception when handling image resource
 *
 * @author elger
 */
class ImageResourceException extends \Exception
{
	/**
	 * Creates a new ImageResourceException
	 *
	 * @param the message $aMessage
	 * @param the code $aCode
	 * @param a previous exception $aPrevious
	 */
	public function __construct( $aMessage, $aCode = null, $aPrevious = null )
	{
		parent::__construct( $aMessage, $aCode, $aPrevious );
	}
}