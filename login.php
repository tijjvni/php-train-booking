<?php
    
    $pdo = require_once 'connect.php';
    
    require 'functions.php';

    // login user
    if( isset($_POST['submit']) && !empty($_POST['submit']) ){
        
        extract($_POST);

        // check if there's an empty field
        if(empty($email) || empty($password)){
            echo "All fields are required";
        }else { 

            $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email AND password = :password');
            $stmt->execute(['email' => $email, 'password' => sha1($password)]);            

            $user = $stmt->fetch();
            
            print_r($user);

            if ($user) {
                $_SESSION['user'] = $email;
                header('Location: index.php'); 
            } else {
                echo "user not found.";
            }            


        }

    }
?>

<form method="post" action="login.php">
    <input type="email" placeholder="email" name="email"/>
    <input type="password" placeholder="password" name="password"/>

    <input type="submit" value="submit" name="submit"/>
    
</form>