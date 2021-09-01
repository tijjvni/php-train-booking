<?php
    require_once 'config.php';

    function connect($host, $db, $user, $password)
    {
        $dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

        try {
            $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

            return new PDO($dsn, $user, $password, $options);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    function authenticate()
    {
        if(!isset($_SESSION['user'])){
            header('Location: login.php'); 
        }

        $statement = $pdo->prepare($sql);
        $statement->bindParam(':email', $_SESSION['user'], PDO::PARAM_INT);
        $statement->execute();
        return $user = $statement->fetch(PDO::FETCH_ASSOC);
    }

    connect($host, $db, $user, $password);