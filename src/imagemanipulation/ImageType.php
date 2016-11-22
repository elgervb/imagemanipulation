<?php
namespace imagemanipulation;
/**
 * 
 */
class ImageType
{
	const PNG = "png";
	const JPG = "jpg";
	const GIF = "gif";
	const BMP = "bmp";
	
	public static final function getType(\SplFileInfo $file) {
	    switch ($file->getExtension()) {
	        case 'png':
	            return ImageType::PNG;
	        case 'gif':
	            return ImageType::GIF;
	        case 'bmp':
	            return ImageType::BMP;
	        default:
	           return ImageType::JPG;
	    }
	}
}