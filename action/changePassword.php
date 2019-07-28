<?php
    session_start();

    require_once '../config/database.php';
    require_once '../action/sendAccountInfo.php';

    if ($_POST['password'] != $_POST['confirmPassword'])
    {
        $_SESSION['password'] = true;
        header('Location: ../pages/changePassword.php?token=' . $_POST['token']);
        return ;
    }

    $pdo = new PDO($DB_DSN_CREATED, $DB_USER, $DB_PASSWORD);
    $result= $pdo->prepare("UPDATE users SET password=':password'  WHERE token=:token");
    $result->execute(array('token' => $_POST['token'], 'password' => hash('whirlpool', $_POST['password'])));
    $result->closeCursor();
    $_SESSION['passwordUser'] = null;

    $result= $pdo->prepare('SELECT * FROM users  WHERE token=:token');
    $result->execute(array('token' => $_POST['token']));
    $valueToken = $result->fetch();
    $result->closeCursor();

    sendAccountInfo($valueToken['login'], $_POST['password'], $valueToken['email']);
    header('Location: ../pages/changePassword.php?token=' . $_POST['token']);