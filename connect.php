<?php
    require_once 'config.php';

    function connect($host, $db, $user, $password)
    {

        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        try {
            $pdo = new PDO($dsn, $user, $pass, $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
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