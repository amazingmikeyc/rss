<?php

namespace Rss\Template;
 
class FactoryTest extends \PHPUnit_Framework_TestCase
{
    
    public function testFactory()
    {
        $obj = new Factory;
        
        $this->assertInstanceOf('\Rss\Template\Template', $obj->create('/path/'));
    }
}
