<?php
    session_start();
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
    require_once '../config/database.php';
    $pdo = new PDO($DB_DSN_CREATED, $DB_USER, $DB_PASSWORD);
    $query= $pdo->prepare("SELECT * FROM users WHERE login=:login");
    $query->execute(array(':login' => $_POST['logginOrEmail']));
    $val = $query->fetch();
    var_dump($val);
    if ($val['verification'] == 'N')
    {
        echo 'HER';
    }
    else if ($val['verification'] == 'Y')
    {
        echo 'KEK';
    }