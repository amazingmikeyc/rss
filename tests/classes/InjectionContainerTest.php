<?php

namespace Rss;

class InjectionContainerTest extends \PHPUnit_Framework_TestCase {
   
    
    private $testContents = [
        'item1' => 'An item',
        'item2' => 100,
        'item3' => ['array'],
        'fourthitem' => '*!*'
    ];
    
    public function testAdd()
    {
        
        $container = new InjectionContainer();
        
        $container->add('key', 'value');
        
        $this->assertEquals('value', $container->get('key'));
        
    }
    
    
    public function testGet()
    {
        $container = new InjectionContainer($this->testContents);
        
        $this->assertEquals(100, $container->get('item2'));
        $this->assertEquals(['array'], $container->get('item3'));
        $this->assertEquals(null, $container->get('NOT_A_KEY'));
    }
    
}
