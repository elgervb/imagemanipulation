<?php
namespace tests\imagemanipulation;

use imagemanipulation\ImageResourceException;
use imagemanipulation\ImageResource;
use test\ImagemanipulationTestCase;

/**
 * ImageResource test case.
 */
class ImageResourceTest extends ImagemanipulationTestCase
{
	/**
	 *
	 * @var ImageResource
	 */
	private $res;
	
	/**
	 * Prepares the environment before running a test.
	 */
	protected function setUp()
	{
		parent::setUp();
		
		$this->res = new ImageResource( imagecreatefrompng( __DIR__ . '/../test/sample.png' ) );
	
	}
	
	/**
	 * Cleans up the environment after running a test.
	 */
	protected function tearDown()
	{
		$this->res = null;
		
		parent::tearDown();
	}
	
	/**
	 * Tests ImageResource->cloneResource()
	 */
	public function testCloneResource()
	{
		$clone = $this->res->cloneResource();
		$this->assertNotEquals( $this->res, $clone, 'Checking objects not the same' );
		
		$this->assertEquals( $this->res->getWidth(), $clone->getWidth(), 'Checking width' );
		$this->assertEquals( $this->res->getHeight(), $clone->getHeight(), 'Checking height' );
		
		$this->assertTrue( is_resource( $clone->getResource() ) );
		$this->assertNotEquals( $this->res->getResource(), $clone->getResource() );
	
	}
	
	/**
	 * Tests ImageResource->getResource()
	 */
	public function testGetResource()
	{
		$this->assertTrue(is_resource($this->res->getResource()));
	}
	
    /**
	 * Tests ImageResource->getResource()
	 */
	public function testDestroy()
	{
	    $this->assertTrue(is_resource($this->res->getResource()));
		$this->res->destroy();
		
		$this->assertNull($this->res->getResource());
	}
	
	public function testGetSize() {
	    $size = $this->res->getSize();
	    
	    $this->assertEquals(1386, $size);
	}
	
	/**
	 * Tests ImageResource->getX()
	 */
	public function testGetWidth()
	{
		$this->assertEquals( $this->res->getWidth(), 600, 'Checking width' );
	}
	
	/**
	 * Tests ImageResource->getY()
	 */
	public function testGetHeight()
	{
		$this->assertEquals( $this->res->getHeight(), 600, 'Checking height' );
	}
	
	/**
	 * Tests ImageResource->setResource()
	 */
	public function testSetResource()
	{
		$clone = $this->res->cloneResource();
		$originalRes = $this->res->getResource();
		$this->res->setResource( $clone->getResource() );
		
		$this->assertNotEquals( $originalRes, $this->res->getResource() );
	}
	
	/**
	 * Tests ImageResource->setResource()
	 */
	public function testSetResourceFail()
	{
		try{
			$this->res->setResource(false);
			$this->fail('Expected an exception');
		}
		catch (ImageResourceException $ex){
			 $this->assertNotNull($ex->getMessage());
		}
	}
}
