<?php
namespace tests\imagemanipulation;

use imagemanipulation\ImageResourceException;
use imagemanipulation\ImageResource;

/**
 * ImageResource test case.
 */
class ImageResourceTest extends \ImagemanipulationTestCase
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
		
		$this->res = new ImageResource( imagecreatefrompng( __DIR__ . '/../sample.png' ) );
	
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
	/* TODO enable test when Travis is green
	public function testCloneResource()
	{
		$clone = $this->res->cloneResource();
		$this->assertNotEquals( $this->res, $clone, 'Checking objects not the same' );
		
		$this->assertEquals( $this->res->getX(), $clone->getX(), 'Checking width' );
		$this->assertEquals( $this->res->getY(), $clone->getY(), 'Checking height' );
		
		$this->assertTrue( is_resource( $clone->getResource() ) );
		$this->assertNotEquals( $this->res->getResource(), $clone->getResource() );
	
	}*/
	
	/**
	 * Tests ImageResource->getResource()
	 */
	public function testGetResource()
	{
		$this->res->getResource();
	
	}
	
	/**
	 * Tests ImageResource->getX()
	 */
	public function testGetX()
	{
		$this->assertEquals( $this->res->getX(), 600, 'Checking width' );
	}
	
	/**
	 * Tests ImageResource->getY()
	 */
	public function testGetY()
	{
		$this->assertEquals( $this->res->getY(), 600, 'Checking height' );
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
			
		}
	}
}
