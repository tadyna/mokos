<?php
use Mokos\Model\Repository\DomainRepository;
/**
 *
 * @author derhaa
 */
class DomainRepositoryTest extends AbstractUnitTest
{
	/**
	 * 
	 * @var unknown
	 */
	private $object;
	
	protected function setUp()
	{
		$this->object = new DomainRepository();
	}
	
	public function testGetSomething()
	{
		return $this->assertEquals(1, 1);
	}
}