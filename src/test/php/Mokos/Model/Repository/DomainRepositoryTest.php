<?php
use Mokos\Model\Repository\DomainRepository;
/**
 *
 * @author derhaa
 */
class DomainRepositoryTest extends PHPUnit_Framework_TestCase
{
	/**
	 * Mock of \PersonMapper implementation
	 * @var PHPUnit_Framework_MockObject_MockObject mocked object
	 */
	private $mapper;
	/**
	 * 
	 * @var \PersonRepository
	 */
	private $object;
	
	protected function setUp()
	{
		$this->mapper = $this->getMock('PersonMapper');
		$this->object = new PersonRepository($this->mapper);
	}
	
	public function testGetSomething()
	{
		return $this->assertEquals(1, 1);
	}
}