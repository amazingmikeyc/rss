<?php

namespace Rss\RSSFeed;

class ParserTest extends \PHPUnit_Framework_TestCase {
        
    public function testParseValid()
    {
        
        $xml = file_get_contents('classes/RSSFeed/fixtures/goodRss.xml');
        
        $parser = new Parser();
        
        $returnValues = $parser->parse($xml);
        
        $this->assertEquals(['header', 'items'], array_keys($returnValues));
        
    }
    
    public function testParseAlsoValid()
    {
        
        $xml = file_get_contents('classes/RSSFeed/fixtures/goodishRss.xml');
        
        $parser = new Parser();
        
        $returnValues = $parser->parse($xml);
        
        $this->assertEquals(['header', 'items'], array_keys($returnValues));
        
    }
    
    public function testParseNotXml()
    {
        
        $xml = 'this is not XML';
        
        $parser = new Parser();
        
        $this->assertFalse($parser->parse($xml));
                
    }
    
    
    public function testParseIsXMLButBadRSS()
    {
        
        $xml = file_get_contents('classes/RSSFeed/fixtures/badRss.xml');
        
        $parser = new Parser();
        
        $this->assertFalse($parser->parse($xml));
                
    }
   
}
