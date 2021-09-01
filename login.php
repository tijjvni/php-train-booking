<?php
    $pdo = require 'connect.php';

    // login user
    if( isset($_POST['submit']) && !empty($_POST['submit']) ){
        
        extract($_POST);

        // check if there's an empty field
        if(empty($email) || empty($password)){
            echo "All fields are required";
        }else { 


            $sql = 'SELECT * 
            FROM users
            WHERE email = :email
            AND password = :password';
    
            $statement = $pdo->prepare($sql);
            $statement->bindParam(':email', $email, PDO::PARAM_INT);
            $statement->bindParam(':password', sha1($password), PDO::PARAM_INT);
            $statement->execute();
            $user = $statement->fetch(PDO::FETCH_ASSOC);
            
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