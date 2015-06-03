<?php

namespace Rss\Template;
/**
 * Description of Templater
 *
 * @author mike
 */
class Templater implements TemplateInterface, \Rss\InjectableInterface
{
    
    private $variables = [];
    
    private $templatePath;
    private $outerTemplate;
    private $innerTemplate;
    
    private $container;
    
    /**
     * Add a variable to the templates
     * 
     * @param string $name
     * @param mixed  $value
     */
    public function addVariable($name, $value) 
    {
        $this->variables[$name] = $value;
        return $this;
    }

    /**
     * Returns a generated output
     * 
     * @return string
     */
    public function render() 
    {
        $this->outerTemplate->setVariables($this->variables);
        $contents = $this->outerTemplate->render();
        
        return $contents;
    }

    /**
     * Set the directory where the template files are stored
     * 
     * @param string $templatePath
     * 
     * @return \Rss\Template\Templater
     */
    public function setTemplatePath($templatePath)
    {
        $this->templatePath = $templatePath;
        return $this;
    }
    
    /**
     * Create an outer template
     * 
     * @param string $outerTemplatePath
     * 
     * @return \Rss\Template\Templater
     */
    public function setOuterTemplate($outerTemplatePath)
    {   
        $factory = $this->container->get('templateFactory');
        $this->outerTemplate = $factory->create($this->templatePath.'/'.$outerTemplatePath);
        
        return $this;
    }
    
    /**
     * Create an inner template
     * 
     * @param string $innerTemplatePath
     * 
     * @return \Rss\Template\Templater
     */
    public function setInnerTemplate($innerTemplatePath)
    {
        $factory = $this->container->get('templateFactory');
        $this->innerTemplate = $factory->create($this->templatePath.'/'.$innerTemplatePath);
        $this->outerTemplate->setChildTemplate($this->innerTemplate);
        return $this;
    }

    /**
     * Set the injection container
     * 
     * @param \Rss\InjectionContainer $container
     * 
     * @return \Rss\Template\Templater
     */
    public function setInjectionContainer(\Rss\InjectionContainer $container) 
    {
        $this->container = $container;
        return $this;
    }
    
}
