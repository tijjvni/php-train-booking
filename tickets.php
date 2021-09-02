<?php
    
    $pdo = require_once 'connect.php';
    
    require_once('functions.php');

    $user = authenticate($pdo);


    $sql = 'SELECT * from tickets where user_id = :user and booked = 1'; 

    $statement = $pdo->prepare($sql);
    $statement->execute([
        ':user' => $user['id']
    ]);
          
    $tickets = $statement->fetchAll(PDO::FETCH_ASSOC);  

    if(!$tickets){
        ?>
            You have no ticket, <a href="book.php">book now</a>
        <?php
    }else {
        foreach($tickets as $ticket){
            ?>
                <pre><?php print_r($ticket); ?></pre>
            <?php
        }
    }
?>