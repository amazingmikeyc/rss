<?php

namespace Rss\RSSFeed;

class RepositoryTest extends \PHPUnit_Framework_TestCase 
{
    
    private $mockDb;
    
    public function setUp()
    {
        
        $statement = $this->getMockBuilder('\PDOStatement')->disableOriginalConstructor()->getMock();
        
        $database = $this->getMockBuilder('\Rss\Database\Database')->disableOriginalConstructor()->getMock();
        
         
        $statement->expects($this->atMost(1))
                ->method('fetch')
                ->will($this->returnValue(['an', 'array']));
        
        $statement->expects($this->atMost(1))
                ->method('fetchAll')
                ->will($this->returnValue(['an', 'array']));
        
        $database->expects($this->once())
                ->method('execute')
                ->will($this->returnValue($statement));
       
        
        $this->mockDb = $database;
    }
    
    
    public function testGetAllFeeds()
    {
        $repo = new Repository($this->mockDb);
        
        $this->assertInternalType('array', $repo->getAllFeeds());        
    }
    
    public function testGetFeed()
    {
        $repo = new Repository($this->mockDb);
        
        $this->assertInternalType('array', $repo->getFeed(100));
        
    }
    
    
    public function testAddFeed()
    {
        $repo = new Repository($this->mockDb);
        
        $this->assertNull($repo->addFeed('http://addfeed.com/rss'));
        
    }
    
    public function testRemoveFeed()
    {
        $repo = new Repository($this->mockDb);
        
        $this->assertNull($repo->removeFeed(100));
        
    }
    
    
}