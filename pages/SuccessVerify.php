<?php
    session_start();
    require_once '../config/database.php';

    if ($_GET['token'] && $_SESSION['user'])
    {

        echo "<span>Hello MotherFucker!!</span><br>";
        $pdo = new PDO($DB_DSN_CREATED, $DB_USER, $DB_PASSWORD);
        $query= $pdo->prepare("SELECT id FROM users WHERE login=:login");
        $query->execute(array(':login' => $_SESSION['user']));
        $val = $query->fetch();
        $query->closeCursor();
        $query= $pdo->prepare("UPDATE users SET verification='Y' WHERE id=:id");
        $query->execute(array('id' => $val['id']));
        $query->closeCursor();
    }