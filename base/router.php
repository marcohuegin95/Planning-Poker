<?php
/**
 * Route
 *
 * Objekt to associate an URL with an specific controller method 
 */
class Router
{

    private function autoload ($className) { 
        $class = 'controller/' . $className. '.php';
         if (file_exists($class)) {
            require $class;
        }
    } 

    /**
    * searches for the given URL in the routing.xml for the matchign action
    * @return route a route object if an action was found, NULL if not
    */
    private function findRouteByURL($url){
        
        $routes = simplexml_load_file("routing.xml");
        foreach($routes as $route){
            if (isset($route->url) && isset($route->controller) && isset($route->action)){
                if (strcmp($route->url, $url) == 0){
                    return $route;
                }
             }else{
                throw new Exception('Invalid routing entry');
             }
        }
        return NULL;
    }

    /**
    * calls the action associate with the URL
    * @param string $url 
    */
    public function dispatch($url){
        $base_url = $this->getBasePathFromURL($url);
        $route = $this->findRouteByURL($base_url);
        if ($route != NULL){
            $this->autoload($route->controller);
            $controller_class = (string) $route->controller;
            $controller_action = (string) $route->action;
            
            $controller = new $controller_class();
            $controller->{$controller_action}();
        }else{
            //TODO

        }
        
    }

    /**
    * Removes all the Parameters from the url
    * @param string $url 
    */
    private function getBasePathFromURL($url){
        if (strpos($url, '&') != false){
            $url = explode('&', $url, 2)[0];
        }
        return $url;
    }

	
}