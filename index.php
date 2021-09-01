<?php
    
    $pdo = require_once 'connect.php';
    
    require_once('functions.php');

    $user = authenticate($pdo);
?>
    <a href="logout.php">logout</a>
<?php

