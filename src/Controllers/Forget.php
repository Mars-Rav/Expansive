<?php

namespace App\Controllers;

require 'C:\xampp\htdocs\MVC Test\vendor\autoload.php';

use App\Controllers\Database;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use \PDO;
use \PDOException;

class Forget{

    public static function checkEmail($email){
        $db = new Database();
        $errors = [];

        if($email === ""){
            $errors['email'] = 'This field is required.';
        }else {
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors['email'] = 'Invalid email format.';
            }
        }

        if(empty($errors)){
            $statement = $db->conn->prepare('SELECT * FROM users WHERE email = :email');
            $statement->bindValue(':email', $email);

            try{
                $statement->execute();
                $user = $statement->fetch(PDO::FETCH_OBJ);
            }catch(PDOException $pdoe){
                throw new PDOException('Connection failed.');
            }

            if($user !== false){
                return true;
            }
            
            $errors['email'] = 'Email was not found.';
        }

        return $errors;
    }

    public static function sendEmail($to_email){

        $identification = sha1(uniqid());
        setcookie("exp", $identification, time() + 60, '/');

        $subject = 'Password reset';
        $message = 'Dear User,<br><br>Please click on the following link to reset your password:<br><br>http://localhost/mvc%20test/reset?i=' . $identification . '<br><br>Best regards,<br>Your Website Team'; // email message
        $from_email = 'accweb213@gmail.com';
        $from_name = 'Authentication Website';

        session_start();
        $_SESSION['email'] = $to_email;

        $mail = new PHPMailer(true);

        try {
            
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'accweb213@gmail.com';
            $mail->Password = 'vkrogtbsozcszmhv';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom($from_email, $from_name);
            $mail->addAddress($to_email);

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $message;

            $mail->send();
            $mail->smtpClose();
            // echo json_encode('Password reset email has been sent to ' . $to_email . '.');
            return true;
        } catch (Exception $e) {
            // echo json_encode('Message could not be sent. Error: ', $mail->ErrorInfo);
            return $mail->ErrorInfo;
        }
    }

    public static function reset($confirm_password, $new_password){
        $db = new Database();
        $errors = [];

        session_start();
        $email = $_SESSION['email'];

        // return $email;
    
        $fetch_sec = $db->conn->prepare("SELECT * FROM users WHERE email = :email");
        $fetch_sec->bindParam('email', $email);
        $fetch_sec->execute();
    
        $user = $fetch_sec->fetch(PDO::FETCH_OBJ);

        if($new_password === ''){
            $errors['new_password'][] = 'Password field is required.';
        }

        if($confirm_password === ''){
            $errors['confirm_password'][] = 'Confirm password field is required.';
        }

        $id = $user->id;
        if (strlen($new_password) >= 8) {
            if ($new_password === $confirm_password) {

                $update_password = $db->conn->prepare("UPDATE users SET password = :password WHERE id = :id");

                $hashed = sha1($new_password);
                $update_password->bindParam('password', $hashed);
                $update_password->bindParam('id', $id);

                $update_password->execute();
                return true;
            } else {
                $errors['confirm_password'][] = 'Passwords do not match.';
            }
        } else {
            $errors['new_password'][] = 'Password is too short.';
        }
        return $errors;
    }

}
