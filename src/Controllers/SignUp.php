<?php

namespace App\Controllers;

use App\Controllers\Database;
use \PDO;
use \PDOException;

class SignUp
{

    private Database $db;

    public function layout()
    {
        View::view('SignUp');
    }


    // Under Construction ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public static function signup($user)
    {
    }

    public static function validate($user)
    {

        $username = $user->getUsername();
        $email = $user->getEmail();
        $password = $user->getPassword();
        $confirm_password = $user->getConfirmPassword();

        $db = new Database();
        $errors = [];

        $username_statement = $db->conn->prepare('SELECT * FROM users WHERE username = :username');
        $email_statement = $db->conn->prepare('SELECT * FROM users WHERE email = :email');

        if ($username === "") {
            $errors['username'][] = 'Username is required.';
        } else {
            $username_statement->bindValue(':username', $username);

            try {
                $username_statement->execute();
                $username_data = $username_statement->fetch(PDO::FETCH_OBJ);
            } catch (PDOException $pdoe) {
                throw new PDOException('Connection failed.');
            }

            if ($username_data !== false && $username === $username_data->username) {
                $errors['username'][] = 'Username already taken.';
            }
        }

        if ($email === "") {
            $errors['email'][] = 'Email is required.';
        } else {
            $email_statement->bindValue(':email', $email);

            try {
                $email_statement->execute();
                $email_data = $email_statement->fetch(PDO::FETCH_OBJ);
            } catch (PDOException $pdoe) {
                throw new PDOException('Connection failed.');
            }

            if ($email_data !== false && $email === $email_data->email) {
                $errors['email'][] = 'Email already in use.';
            }
        }

        if ($password === "") {
            $errors['password'][] = 'Password is required.';
        }

        if ($confirm_password === "") {
            $errors['confirm-password'][] = 'Password Confirmation is required.';
        }

        if (strlen($username) < 5) {
            $errors['username'][] = 'Username should be longer than 5 characters.';
        }

        if (strlen($username) > 50) {
            $errors['username'][] = 'Username should be shorter than 50 characters.';
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'][] = 'Invalid email format.';
        }

        if (strlen($password) < 8) {
            $errors['password'][] = 'Password should be longer than 8 characters.';
        }

        if (strlen($password) > 50) {
            $errors['password'][] = 'Password should be shorter than 50 characters.';
        }

        if ($confirm_password !== $password) {
            $errors['confirm-password'][] = 'Confirm Password should match Password.';
        }

        if (empty($errors)) {
            return true;
        }
        return $errors;
    }

    public static function register($user)
    {
        $db = new Database();

        $username = $user->getUsername();
        $email = $user->getEmail();
        $password = $user->getPassword();

        $statement = $db->conn->prepare('INSERT INTO users(username, email, password) VALUES (:username, :email, :password)');
        $statement->bindValue(':username', $username);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':password', sha1($password));

        return $statement->execute();
    }
}
