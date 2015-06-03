<?php

namespace Rss\Database;

/**
 * Description of DatabaseTest
 *
 * @author mike
 */
class DatabaseTest extends \PHPUnit_Framework_TestCase {

    protected $expectedRows = [
        [
            'col1' => 1,
            'col2' => 2
        ],
        [
            'col1' => 1,
            'col2' => 2
        ],
        [
            'col1' => 1,
            'col2' => 2
        ],
    ];
    
    public function testGetRow() 
    {
        $pdoMock = $this->getMockBuilder('\PDO')->disableOriginalConstructor()->getMock();        
        
        $db = new Database($pdoMock);
        
    }
    
}
