<?php
    $pdo = require 'connect.php';

    // check form submission
    if( isset($_POST['submit']) && !empty($_POST['submit']) ){
        
        extract($_POST);

        // check if there's an empty field
        if(empty($first_name) || empty($last_name) || empty($email) || empty($password)){
            echo "All fields are required";
        }else {


            // registeruser
            $sql = 'INSERT INTO users(first_name, last_name, email, password) VALUES(:first_name, :last_name, :email, :password)';

            $statement = $pdo->prepare($sql);

            $statement->execute([
                ':first_name' => $first_name,
                ':last_name' => $last_name,
                ':email' => $email,
                ':password' => sha1($password)
            ]);


            echo 'Account created successfully. please <a href="login.php">login</a>';            


        }

    }

?>
<form method="post" action="register.php"> 
    <input type="text" placeholder="first name" name="first_name"/>
    <input type="text" placeholder="last name" name="last_name"/>
    <input type="email" placeholder="email" name="email"/>
    <input type="password" placeholder="password" name="password"/>

    <input type="submit" value="submit" name="submit"/>
    
</form>