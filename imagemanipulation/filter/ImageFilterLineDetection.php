<?php
namespace imagemanipulation\filter;

/**
 * Line detection
 */
class ImageFilterLineDetection extends ImageFilterConvolution
{
	public function __construct()
	{
	    // horizontal
		parent::__construct( -1, -1, -1, 2, 2, 2, -1, -1, -1 ); 

        // vertical
//         parent::__construct(-1, 2, -1, -1, 2, -1, -1, 2, -1);
        
        // 45 degrees
//         parent::__construct(-1, -1, 2, -1, 2, -1, 2, -1, -1);
        
	    // sobel horizontal
// 	    parent::__construct(-1, -2, -1, 0, 2, 0, 1, 2, 1);
	    
	    // sobel vertical
// 	    parent::__construct(-1, 0, 1, -2, 4 , 2, -1, 0, 1);
	}
	
	protected function getDivision() {
	    return 1;
	}
	
	protected function getOffset() {
	    return 0;
	}
}