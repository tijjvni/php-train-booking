<?php
    $pdo = require 'connect.php';

    authenticate();

    if($user['is_admin']){
        ?>
            go to <a href="admin.php">admin</a>
        <?php
    }