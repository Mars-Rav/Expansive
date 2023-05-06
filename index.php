<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Controllers\Application;
use App\Controllers\View;
use App\Controllers\Router;
use App\Controllers\SignUp;
use App\Controllers\Login;

$router = new Router();

$router->get('home', function(){
    View::view('Home');
});

$router->get('', function(){
    View::view('Home');
});

$router->get('account', function(){
    View::view('Account');
});

$router->get('forget', function(){
    View::view('Forget');
});

$router->get('reset', function(){
    View::view('Reset');
});

$router->get('signup', [SignUp::class, 'layout']);
$router->get('login', [Login::class, 'layout']);

$app = new Application($router);
$app->run();

?>
