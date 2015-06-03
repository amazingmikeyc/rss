<?php
namespace Rss\Template;
/**
 * An interface for a template engine. This means 
 * we have a consistant interface to code to in case
 * we decide to use an alternate template engine.
 *
 * @author mike
 */
interface TemplateInterface {
   
    /**
     * Add a variable to the template
     * 
     * @param string $name
     * @param mixed  $value
     */
    public function addVariable($name, $value);
    
    /**
     * Path to the template
     * 
     * @param string $templatePath
     */
    public function setTemplatePath($templatePath);
    
    /**
     * Returns the rendered template
     * 
     * @return string
     */
    public function render();
    
}
