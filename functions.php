<?php     
     
     function authenticate($pdo)
     {
         if(!isset($_SESSION['user'])){
             header('Location: login.php'); 
         }
 
         
         $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email');
         $stmt->execute(['email' => $_SESSION['user'] ]);            

         $user = $stmt->fetch();   
         
         return $user;

     }

     function adminPage($user) 
     {
        if(!$user['is_admin']){
            header('Location: index.php'); 
        }
     }