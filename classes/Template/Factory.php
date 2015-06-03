<?php

namespace Rss\Template;

class Factory {
    
    public function create($templatePath)
    {
        return new Template($templatePath);
    }
    
}
