<?php
namespace Classes\Ok;

class EntryPoint
{   
    private $route;
    private $method;
    private $routes;
    
    public function __construct(string $route, string $method, $routes){
        $this->route = $route;
        $this->method = $method;
        $this->routes = $routes;
    }
    
    public function run(){
        
        $getRutes = $this->routes->getRoutes()[$this->route][$this->method];
        $controller = $getRutes['controller'];
        $action = $getRutes['action'];
        
        $route = $controller->$action();
        
        return;
    }
    
}