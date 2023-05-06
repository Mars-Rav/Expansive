<?php

namespace App\Controllers;
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Controllers\SignUp;
use App\Controllers\Login;
use App\Models\User;

if($_POST['title'] === 'signup'){

    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $confirm_password = htmlspecialchars($_POST['confirm-password']);

    $user = new User($username, $email, $password, $confirm_password);

    $output = SignUp::validate($user);
    
    if($output === true){
        SignUp::register($user);
        echo json_encode(1);
        exit;
    }else {
        echo json_encode($output);
    }

}

if($_POST['title'] === 'login'){

    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    $output = Login::login($email, $password);
    
    if($output === true){
        echo json_encode(1);
        exit;
    }else {
        echo json_encode($output);
    }

}

if($_POST['title'] === 'email-forgot-form'){

    $email = htmlspecialchars($_POST['email']);

    $output = Forget::checkEmail($email);
    
    if($output === true){
        $state = Forget::sendEmail($email);
        if($state === true){
            echo json_encode(1);
        }else {
            echo json_encode(0);
        }
        exit;
    }else {
        echo json_encode($output);
    }

}

if($_POST['title'] === 'reset-form'){

    $confirm_password = htmlspecialchars($_POST['confirm-password']);
    $new_password = htmlspecialchars($_POST['password']);

    $output = Forget::reset($confirm_password, $new_password);

    if($output === true){

        echo json_encode(1);

    }else {
        echo json_encode($output);
    }

}

if ($_POST['title'] === 'logout') {
    session_start();
    session_destroy();
    echo json_encode(1);
}
