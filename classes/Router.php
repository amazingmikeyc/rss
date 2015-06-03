<?php

namespace Rss;

/**
 * Determines a route from the URL for the Controller
 */
class Router {
    
    private $routes = [
        'add' => 'actionAdd',
        'remove' => 'actionRemove',
        'view' => 'actionView',
        'list' => 'actionList',        
        'default' => 'actionList',
        '404' => 'action404'
    ];
    
    private $url;
    private $controller;
    
    /**
     * 
     * @param string $url
     */
    public function __construct(Controller $controller, $url) 
    {
        $this->url = $url;        
        $this->controller = $controller;
    }
        
    /**
     * Parse a URL route
     * 
     * @param string $action
     * 
     * @return string
     */
    private function getRoute($action)
    {
        
        if (array_key_exists($action, $this->routes)) {
            return $this->routes[$action];
        }
        
        if ($action==='') {
            return $this->routes['default'];
        }
        
        return $this->routes['404'];
    }    
    
    /**
     * Run a path
     * 
     * @return string
     */
    public function execute()
    {        
        $urlParts = explode('/', explode('?', $this->url)[0]);
        
        $method = $this->getRoute($urlParts[1]);
        
        $params = array_slice($urlParts, 2);

        //Here I get to use the new ... operator!
        return $this->controller->$method(...$params);
    }
    
}
