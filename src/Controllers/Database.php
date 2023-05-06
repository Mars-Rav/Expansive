<?php

namespace App\Controllers;

use \PDO;
use \PDOException;

class Database{

    public $conn;

    private const DB_NAME = 'mvc_practice';
    private const HOST = 'localhost';
    private const DSN = 'mysql:host=' . self::HOST . ';dbname=' . self::DB_NAME;
    private const USER = 'owner';
    private const PASSWORD = '123456';

    public function __construct(){
        try{
            $this->conn = new PDO(self::DSN, self::USER, self::PASSWORD);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $pdoe){
            echo 'Something went wrong with the database connection.' . '<br>';
            echo $pdoe;
        }
    }

}