<?php
    
    $pdo = require_once 'connect.php';

    authenticate();

    print_r($pdo);
