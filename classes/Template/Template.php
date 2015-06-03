<?php

namespace Rss\Template;

/**
 * A class for the actual template itself
 * 
 * @codeCoverageIgnore
 */
class Template {
    
    private $templatePath;
    private $variables = [];
    
    private $childTemplate;
    
    /**
     * Constructor with full template file path
     * 
     * @param string $path
     */
    public function __construct($path)
    {
        $this->templatePath = $path;
    }
    
    /**
     * Set the variables for the template
     * 
     * @param array $variables
     */
    public function setVariables(array $variables)
    {
        $this->variables = $variables;
    }
    
    /**
     * Return a rendered string
     * 
     * @return string
     */
    public function render() 
    {
        ob_start();
        
        extract($this->variables);
        
        if ($this->childTemplate) {
            $this->childTemplate->setVariables($this->variables);
            $mainBody = $this->childTemplate->render();
        }
        
        include($this->templatePath);
        
        $body = ob_get_contents();
        ob_end_clean();
        
        return $body;
    }
    
    /**
     * Set a child template.
     * 
     * @param \Rss\Template\Template $template
     */
    public function setChildTemplate(Template $template)
    {
        $this->childTemplate = $template;
    }
    
}
