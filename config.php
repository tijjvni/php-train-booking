<?php

// $host     = 'host';
// $db       = 'db';
// $user     = 'user';
// $password = 'password';

$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$host = $url["host"];
$user = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);