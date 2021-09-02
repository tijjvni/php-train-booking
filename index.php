<?php
    
    $pdo = require_once 'connect.php';
    
    require_once('functions.php');

    $user = authenticate($pdo);
?>
    <a href="logout.php">logout</a>
    <a href="book.php">book</a>
    <a href="tickets.php">tickets</a>
    <a href="profile.php">profile</a>
<?php
    if($user['is_admin']){
        ?>
            <a href="admin.php">admin</a>
        <?php
    }
