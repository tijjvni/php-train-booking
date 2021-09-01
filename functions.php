<?php     
     
     function authenticate()
     {
         if(!isset($_SESSION['user'])){
             header('Location: login.php'); 
         }
 
         $statement = $pdo->prepare($sql);
         $statement->bindParam(':email', $_SESSION['user'], PDO::PARAM_INT);
         $statement->execute();
         return $user = $statement->fetch(PDO::FETCH_ASSOC);
     }