<?php
    
    $pdo = require_once 'connect.php';
    
    require_once('functions.php');

    authenticate();
    
    print_r($pdo);
