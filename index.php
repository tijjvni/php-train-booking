<?php
    
    $pdo = require_once 'connect.php';
    
    // require_once('functions.php');

    // $user = authenticate();
?>
    <a href="logout">logout</a>
<?php
    print_r($_SESSION['user']);
