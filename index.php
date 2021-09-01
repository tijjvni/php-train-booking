<?php
    
    $pdo = require_once 'connect.php';
    
    require 'functions.php';

    authenticate();

    print_r($pdo);
