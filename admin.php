<?php
    $pdo = require 'connect.php';

    authenticate();
    adminPage($user);


    
?>

<form method="post" action="admin.php"> 
    <p> Add Location</p>
    <input type="text" placeholder="location" name="location"/>

    <input type="submit" value="submit" name="addLocation"/>
    
</form>