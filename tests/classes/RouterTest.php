<?php

namespace Rss;

class RouterTest extends \PHPUnit_Framework_TestCase {
    
    private $controller;
    
    public function setUp()
    {
        $this->controller = $this->getMockBuilder('\Rss\Controller')->disableOriginalConstructor()->getMock();       
    }
    
    /**
     * This is kind of a functional test
     * 
     * @dataProvider dataProvider
     */
    public function testExecute($url, $expectedRoute)
    {
        $this->controller->expects($this->once())
            ->method($expectedRoute)            
            ->will($this->returnValue($expectedRoute));
        
        $obj = new Router($this->controller, $url);
        
        $this->assertEquals($expectedRoute, $obj->execute());
    }
    
    
    public function dataProvider()
    {
        return [
            ['/add', 'actionAdd'],
            ['/remove', 'actionRemove'],
            ['/view/103', 'actionView'],
            ['/', 'actionList'],
            ['/not/a/url', 'action404']
        ];
    }
    
}
