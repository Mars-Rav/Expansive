<?php

namespace App\Controllers;

class Application{

    public Router $router;

    public function __construct($router){
        $this->router = $router;
    }

    public function run(){
        $this->router->dispatch();
    }

}