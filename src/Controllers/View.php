<?php

namespace App\Controllers;

use App\Controllers\Router;

class View{

    private static $auth_pages = ['SignUp', 'Login', 'Forget', 'Reset'];
    private static $auth_navs = ['signup', 'login', 'forget', 'reset'];

    public static function view($page){
        $router = new Router;
        require 'C:\xampp\htdocs\MVC Test\src\Views\Layouts\Header.php';

        if(in_array($router->getRoute(), self::$auth_navs)){
            require 'C:\xampp\htdocs\MVC Test\src\Views\Layouts\AuthNavbar.php';
        }else {
            require 'C:\xampp\htdocs\MVC Test\src\Views\Layouts\Navbar.php';
        }

        $path = __DIR__ . "/../Views/Entities/$page.php";
        
        if(in_array($page, self::$auth_pages)){
            $path = __DIR__ . "/../Views/Authentication/$page.php";
        }

        $_404 = __DIR__ . "/../Views/_404.php";

        if(is_file($path)){
            require $path;
        }else {
            require $_404;
        }

        require 'C:\xampp\htdocs\MVC Test\src\Views\Layouts\Footer.php';
    }
}
