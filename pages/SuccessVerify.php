<?php
    session_start();
    ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
    require_once '../config/database.php';
    require_once '../action/sendAccountInfo.php';

    if ($_GET['token'])
    {
        $pdo = new PDO($DB_DSN_CREATED, $DB_USER, $DB_PASSWORD);
        $result= $pdo->prepare('SELECT * FROM users  WHERE token=:token');
        $result->execute(array('token' => $_GET['token']));
        $valueToken = $result->fetch();
        $result->closeCursor();
        if ($valueToken)
        {
            $result= $pdo->prepare("UPDATE users SET verification='Y' WHERE id=:id");
            $result->execute(array('id' => $valueToken['id']));
            $result->closeCursor();
            sendAccountInfo($valueToken['login'], $_SESSION['passwordUser'], $valueToken['email']);
            $_SESSION['passwordUser'] = null;
        }
        echo "<span>Hello MotherFucker!!</span><br>";
    }