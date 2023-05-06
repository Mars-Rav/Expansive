<?php

namespace App\Models;

class User{
    private $username;
    private $email;
    private $password;
    private $confirm_password;
    private $phoneno;
    private $pfp;

    public function __construct($username, $email, $password, $confirm_password, $phoneno = '', $pfp = ''){

        $this->setUsername($username);
        $this->setEmail($email);
        $this->setPassword($password);
        $this->setConfirmPassword($confirm_password);
        $this->setPhoneno($phoneno);
        $this->setPfp($pfp);

    }

    public function setUsername($username){
        $this->username = $username;
    }
    public function setEmail($email){
        $this->email = $email;
    }
    public function setPassword($password){
        $this->password = $password;
    }
    public function setConfirmPassword($confirm_password){
        $this->confirm_password = $confirm_password;
    }
    public function setPhoneno($phoneno){
        $this->phoneno = $phoneno;
    }
    public function setPfp($pfp){
        $this->pfp = $pfp;
    }

    public function getUsername(){
        return $this->username;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getPassword(){
        return $this->password;
    }
    public function getConfirmPassword(){
        return $this->confirm_password;
    }
    public function getPhoneno(){
        return $this->phoneno;
    }
    public function getPfp(){
        return $this->pfp;
    }

}