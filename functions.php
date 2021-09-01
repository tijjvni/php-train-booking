<?php     
     
     function authenticate($user)
     {
         if(!isset($_SESSION['user'])){
             header('Location: login.php'); 
         }
 

         $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email');
         $stmt->execute(['email' => $user]);            

         return $user = $stmt->fetch();         

     }