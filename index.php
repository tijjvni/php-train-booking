<?php
    
    $pdo = require_once 'connect.php';
    
    require_once('functions.php');

    $user = authenticate();
?>
    <a href="logout.php">logout</a>
<?php
    print_r($user);
