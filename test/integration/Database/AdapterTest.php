<?php
require_once dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'DbTest.php';
/**
 * Description of AdapterTest
 *
 * @author derhaa
 */
class AdapterTest extends DbTest
{

    public function setUp() {
        $this->getConnection()->createDataSet();
    }

    public function tearDown() {
        
    }
    
    public function testCreateDataSet () {
        $this->assertEquals(2, $this->getConnection()->getRowCount('guestbook'), "Pre-Condition");
    }

}

