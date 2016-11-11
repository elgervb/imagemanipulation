<?php
namespace tests\imagemanipulation;

use test\ImagemanipulationTestCase;
/**
 * Preconditions test case.
 */
class PreconditionsTest extends ImagemanipulationTestCase
{
    public function testGDSupport(){
        
        $this->assertTrue(function_exists('gd_info'), "Check that function gd_info exists");
    }
    
    public function testGDVersion(){
        $info = gd_info();
        $string = $info['GD Version']; // bundled (2.1.0 compatible)
        
        $match = preg_match("/.*([0-9]+\.[0-9]+\.[0-9]+).*/", $string, $matches);
        $this->assertNotFalse($match, "version REGEX not OK for versionstring: " . $string);
        
        $version = explode('.', $matches[1]);
        
        $this->assertGreaterThanOrEqual(2, (int) $version[0]);
    }
    
    public function testPngSupport(){
    
        $info = gd_info();
        
        $this->assertTrue($info['PNG Support'], "Check PNG Support");
    }
    
    public function testJpgSupport(){
    
        $info = gd_info();
    
        $this->assertTrue($info['JPEG Support'], "Check Jpeg Support");
    }
    
    public function testGifSupport(){
    
        $info = gd_info();
    
        $this->assertTrue($info['GIF Read Support'], "Check GIF Read Support");
        $this->assertTrue($info['GIF Create Support'], "Check GIF Create Support");
    }
}
