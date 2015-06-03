<?php

namespace Rss;

class CurlTest extends \PHPUnit_Framework_TestCase {
    
    /**
     * This isn't a brilliant test, but we can demonstrate
     * that something returns at least.
     */
    public function testGetData()
    {
        
        $curl = new Curl;        
        
        $this->assertNotFalse($curl->getData('localhost'));
    }
    
     /**
     * This isn't a brilliant test, but we can demonstrate
     * that something returns at least.
      * 
     */
    public function testGetDataFailure()
    {
        
        $curl = new Curl;        
        
        $this->setExpectedException('Exception', 'Curl Error');
        $curl->getData('!!not a url!?');
    }
    
}
