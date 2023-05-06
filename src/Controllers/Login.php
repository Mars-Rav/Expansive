<?php

namespace App\Controllers;

use App\Controllers\Database;
use \PDO;
use \PDOException;

class Login{

    public function layout(){
        View::view('Login');
    }

    public static function login($email, $password){

        $db = new Database();
        $errors = [];

        if($email === ""){
            $errors['email'] = 'This field is required.';
        }else {
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors['email'] = 'Invalid email format.';
            }
        }

        if($password === ""){
            $errors['password'] = 'This field is required.';
        }

        if(empty($errors)){
            $statement = $db->conn->prepare('SELECT * FROM users WHERE email = :email AND password = :password');
            $statement->bindValue(':email', $email);
            $statement->bindValue(':password', sha1($password));

            try{
                $statement->execute();
                $user = $statement->fetch(PDO::FETCH_OBJ);
            }catch(PDOException $pdoe){
                throw new PDOException('Connection failed.');
            }

            if($user !== false){
                session_start();
                $_SESSION['user-id'] = $user->id;
                return true;
            }
            
            $errors['invalid'] = 'The email or the password is invalid.';
        }

        return $errors;

    }

    public static function validate(){

    }

}
