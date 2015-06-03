<?php

namespace Rss;
/**
 * A wrapper around PHP'c CURL methods
 *
 * @author mike
 */
class Curl {
    
    private $handle;
    
    /**
     * initialise the Curl object
     */
    private function init() 
    {
        $this->handle = curl_init();        
    }
    
    /**
     * Set Curl Options
     * 
     * @param array $options
     */
    private function setOptions(array $options)
    {        
        curl_setopt_array($this->handle, $options);
    }
    
    /**
     * 
     * @return string
     */
    private function exec()
    {
        return curl_exec($this->handle);
    }
    
    /**
     * Get the data
     * 
     * @param string $url
     * 
     * @return string
     */
    public function getData($url) 
    {
        //var_dump(CURLOPT_URL);
        $this->init();
        $options = [            
            CURLOPT_URL => $url,
            CURLOPT_HTTPGET => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true
        ];
        
        $this->setOptions($options);
                
        $value = $this->exec();
        if (!$value) {
            throw new \Exception('Curl Error', $this->getLastError());
        }
        $this->close();
       
        return $value;
    }
    
    /**
     * Close the Curl
     */
    public function close()
    {
        curl_close($this->handle);
    }
    
    /**
     * Get the last Curl error
     * 
     * @return int
     */
    public function getLastError()
    {
        return curl_errno($this->handle);
    }
    
}
