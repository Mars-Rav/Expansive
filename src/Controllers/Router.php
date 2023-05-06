<?php

namespace App\Controllers;

use Exception;

class Router{

    public $routes;

    public function __construct(){
        $this->routes = [];
    }

    public function get($route, $action){
        $this->routes['get'][$route] = $action;
    }

    public function post($route, $action){
        $this->routes['post'][$route] = $action;
    }

    public function getMethod(){
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function getRoute(){
        $uri = explode('/', $_SERVER['REQUEST_URI']);
        array_shift($uri);

        if(strpos($uri[1], '?')){
            return substr($uri[1], 0, strpos($uri[1], '?'));
        }

        return $uri[1];
    }

    public function dispatch(){
        $route = $this->getRoute();
        $method = $this->getMethod();

        if(isset($this->routes[$method][$route])){
            $action = $this->routes[$method][$route];

            if(is_callable($action)){
                return $action();
            }else {
                $controller = new $action[0]();
                $prop = $action[1];
                return $controller->$prop();
            }
        }else {
            View::view('404');
        }
    }

    public function getBody()
    {
        $body = [];

        if ($this->getMethod() === 'get') {
            foreach ($_GET as $key => $value) {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        } else {
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        return $body;
    }

}