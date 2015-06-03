<?php

namespace Rss\Template;

class TemplaterTest extends \PHPUnit_Framework_TestCase
{
    
    private $injectionContainer;
    
    public function setUp() 
    {
        $template = $this->getMockBuilder('Rss\Template\Template')->disableOriginalConstructor()->getMock();
        $template->expects($this->once())
                ->method('render')
                ->will($this->returnValue('this is template'));
        
        $templateFactory = $this->getMockBuilder('\Rss\Template\Factory')
                ->disableOriginalConstructor()->getMock();
        $templateFactory->expects($this->once())
                ->method('create')
                ->will($this->returnValue($template));         
        
        
        $this->injectionContainer = $this->getMockBuilder('\Rss\InjectionContainer')->disableOriginalConstructor()->getMock();
        $this->injectionContainer->expects($this->once())
                ->method('get')
                ->will($this->returnValue($templateFactory));
    }

    public function testAddVariable()
    {
        $templater = new Templater();
        
        $this->assertEquals($templater, $templater->addVariable('name', 'value'));
    }
    
    
    public function testRender()
    {
        $templater = new Templater();
        $templater->setInjectionContainer($this->injectionContainer);
        
        $templater->setOuterTemplate('path');
        
        $this->assertEquals('this is template', $templater->render());
    }
    
}
