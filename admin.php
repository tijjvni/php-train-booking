<?php
    $pdo = require_once 'connect.php';
    require_once('functions.php');

    $user = authenticate($pdo);
    adminPage($user);
    
?>

<form method="post" action="admin.php"> 
    <p> Add Location</p>
    <input type="text" placeholder="location" name="location"/>

    <input type="submit" value="submit" name="addLocation"/>
    
</form>