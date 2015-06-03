<?php
 
namespace Rss;
/**
 * A fairly basic controller that fires of some actions
 */
class Controller implements InjectableInterface {
    
    private $container;
            
    /**
     * Set the injection container
     * 
     * @param \Rss\InjectionContainer $container
     */
    public function setInjectionContainer(InjectionContainer $container)
    {
        $this->container = $container;
    }
    
    /**
     * do an HTTP redirect
     * Perhaps should not belong in here?
     */
    private function forwardTo($url) {
       header('Location: '.$url);
       die;
    }
    
    /**
     * add an item
     * 
     * @return string
     */
    public function actionAdd()
    {
        $postVars = $this->container->get('postVars');
        if (isset($_POST['url'])) {
            $repository = $this->getRepository();
            $repository->addFeed($_POST['url']);
        }
        $this->forwardTo('/');        
    }
    
    /**
     * 
     */
    public function actionRemove()
    {
        $postVars = $this->container->get('postVars');
        if (isset($_POST['id'])) {
            $repository = $this->getRepository();
            $repository->removeFeed($_POST['id']);
        }
        
        $this->forwardTo('/');
    }
    
    /**
     * Main index/listing page
     * 
     * @return string
     */
    public function actionList()
    {
        $engine = $this->getTemplateEngine();
        
        $engine->addVariable('title', "Mike's RSS Reader");
        $engine->setInnerTemplate('pages/index.php');   
        $repository = $this->getRepository();
        $engine->addVariable('feeds', $repository->getAllFeeds());
        
        return $engine->render();
    }
    
    /**
     * View an RSS feed
     * 
     * @param int $rssFeedId
     * 
     * @return string 
     */
    public function actionView($rssFeedId)
    {
        $engine = $this->getTemplateEngine();
        
        $curl = $this->container->get('curl');
        $rssParser = $this->container->get('rssParser');
        
        if ($feed = $this->getRepository()->getFeed($rssFeedId)) {
            $curlContent = $curl->getData($feed['uri']);
            
            $parsedXml = $rssParser->parse($curlContent);
            
            if ($parsedXml) {
                $engine->addVariable('title', $parsedXml['header']->title);
                $engine->addVariable('header', $parsedXml['header']);
                $engine->addVariable('items', $parsedXml['items']);

                $engine->setInnerTemplate('pages/viewrss.php');
            } else {
                $engine->setInnerTemplate('pages/error.php');
                $engine->addVariable('title', "Invalid RSS");
                $engine->addVariable('error', 'This file was not a valid RSS file'); 
            } 
            
            return $engine->render();            
           
        } else {
            return $this->action404();
        }
    }
    
    public function action404()
    {
        $engine = $this->getTemplateEngine();
        
        $engine->addVariable('title', "RSS Reader - Page not found");
        $engine->addVariable('error', '404 Not Found');
        $engine->setInnerTemplate('pages/error.php');
        return $engine->render();
    }
    
    /**
     * 
     * @return Template\TemplateInterface
     */
    private function getTemplateEngine()
    {
        return $this->container->get('templateEngine'); 
    }
    
    /**
     * 
     * @return RSSFeed\Repository
     */
    private function getRepository()
    {
        return $this->container->get('repository'); 
    }
    
}
