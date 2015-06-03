<?php

namespace Rss;
/**
 * A really simple dependancy injection container.
 */
class InjectionContainer {
    
    private $contents = [];
    
    /**
     * Constructor; can provide an array of default contents
     * 
     * @param array $contents
     */
    public function __construct(array $contents = [])
    {
        $this->contents = $contents;
    }
    
    /**
     * Add a value into the container
     * 
     * @param string $name
     * @param mixed $value
     */
    public function add($name, $value)
    {
        $this->contents[$name] = $value;
    }
    
    /**
     * Get a value from the container
     * 
     * @param string $name
     * 
     * @return mixed
     */
    public function get($name)
    {
        if (array_key_exists($name, $this->contents)) {
            return $this->contents[$name];
        }
        
        return null;       
    }
    
}
