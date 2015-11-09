<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Rss\RSSFeed;

/**
 * A class to parse the XML
 */
class Parser {

    /**
     * Load the XML string into a Simple XML Element
     * 
     * @param string $xml
     * 
     * @return type
     */
    public function parse($xml)
    {
        \libxml_use_internal_errors(true);
        
        try {
            $parsedXML = \simplexml_load_string($xml);        
            
            if (\libxml_get_errors() == [] && $this->checkIsRSS($parsedXML)) {
                return [
                    'header' => $parsedXML->channel,
                    //some of the RSS feeds have the items in the wrong place!
                    'items' => $parsedXML->channel->item ? $parsedXML->channel->item : $parsedXML->item
                ];
            } else {
                return false;                
            }
        } catch (\Exception $e) {
            return false;
        }
    }
    
    /**
     * A basic check to see if our XML has channel and item
     * elements which RSS requires
     * 
     * @param \SimpleXMLElement $xmlElements
     * 
     * @return boolean
     */
    public function checkIsRSS(\SimpleXMLElement $xmlElements)
    {
        return ($xmlElements->channel && ($xmlElements->item || $xmlElements->channel->item));
    }
         
    
}
