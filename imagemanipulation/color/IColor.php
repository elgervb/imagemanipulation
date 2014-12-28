<?php
namespace imagemanipulation\color;

interface IColor
{
	/**
	 * Returns the alpha channel value
	 * 
	 * @return int
	 */
	public function getAlpha();
	
	/**
	 * Returns the color code
	 * 
	 * @return string
	 */
	public function getHexColor();
	
	/**
	 * Returns the color index as used by PHP
	 * @return int
	 */
	public function getColorIndex();
	
	/**
	 * @return int
	 */
	public function getBlue();
	
	/**
	 * @return int
	 */
	public function getGreen();
	
	/**
	 * @return int
	 */
	public function getRed();
}