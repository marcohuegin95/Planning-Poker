<?php

require 'filters/Filter.php';

/**
 * Route
 *
 * Übernimmt das weiterleiten einer Anfrage an die dafür
 * verantwortliche Schnittstelle. Zusätzlich werden, die für die Anfrage
 * angegebenen Filter aufgerufen
 * @author Timon Mueller-Wessling
 */
class Router
{

    /**
     * Läd die gegebene Klasse aus dem im präfix angebenen Ordner
     */
    private function autoload ($prefix, $className) { 
        $class = $prefix . '/' . $className. '.php';
         if (file_exists($class)) {
            require $class;
        }
    } 

    /**
    * Sucht die übergenen URL in der routing.xml und gibt falls ein Eintrag gefunden
    * werden kann, den Eintrag der xml Datei zurück
    * @return route den Eintrag der XML, der Informationen zum Controller, Filter usw. enthält
    */
    private function findRouteByURL($url){
        $routes = simplexml_load_file("routing.xml");
        foreach($routes as $route){
            if (isset($route->url) && isset($route->controller) && isset($route->action)){
                if (strcasecmp($route->url, $url) == 0){
                    return $route;
                }
             }else{
                throw new Exception('Invalid routing entry');
             }
        }
        return NULL;
    }

    /**
     * Versucht den übergebenen Filter zu finden
     * und die Filterfunktion von diesem aufzurufen
     */
    private function callFilter($filter){
        $this->autoload('filters', $filter);
        $filter_class = (string) $filter;

        $filter = new $filter_class();
        if ($filter instanceof Filter){
            $filter->filter();
        }
    }

    /**
    * Vermittelt die übergeben URL an die dafür
    * verantwortliche Schnittstelle bzw. Kontroller.
    * Zusätzlich werden Filter für den gebenen Kontroller aufgerufen
    */
    public function dispatch($url){
        $base_url = $this->getBasePathFromURL($url);
        $route = $this->findRouteByURL($base_url);
        print_r($route);
        if ($route != NULL){
            if ($route->filter){
                if(is_array($route->filter)){
                    foreach($route->filter as $filter){
                        $this->callFilter($filter);    
                    }
                }else{
                    $this->callFilter($route->filter);
                }
            }
            $this->autoload('controller' , $route->controller);
            $controller_class = (string) $route->controller;
            $controller_action = (string) $route->action;
            
            $controller = new $controller_class();
            $controller->{$controller_action}();
        }else{
            echo '404 Seite nicht gefunden';
        }
        
    }

    /**
    * Entfernt alle Paramter von der mitgebenen url
    * @return url die URL ohne alle Parameter die nach dem ersten '?' kommen 
    */
    private function getBasePathFromURL($url){
        if (strpos($url, '?') != false){
            $url = explode('?', $url, 2)[0];
        }
        return $url;
    }

	
}