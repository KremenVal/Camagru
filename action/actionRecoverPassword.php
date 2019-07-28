<?php
    session_start();
    $_SESSION['emailValue'] = $_POST['email'];

    require_once '../config/database.php';
    require_once 'sendRecoverPassword.php';
    require_once '../function/CheckUser.php';

    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
    {
        $_SESSION['email'] = true;
        header('Location: ../pages/recoverPassword.php');
        return ;
    }
    else if (!$valEmail['email'])
    {
        $_SESSION['emailDoesntExist'] = true;
        header('Location: ../pages/recoverPassword.php');
        return ;
    }

$location = $_SERVER['HTTP_HOST'] . str_replace("/action/actionRecoverPassword.php", "", $_SERVER['REQUEST_URI']);
$pdo = new PDO($DB_DSN_CREATED, $DB_USER, $DB_PASSWORD);
$result= $pdo->prepare('SELECT * FROM users  WHERE email=:email');
$result->execute(array('email' => $_POST['email']));
$valueInfo = $result->fetch();
sendRecoverPassword($valueInfo['login'], $location, $_POST['email'], $valueInfo['token']);
$result->closeCursor();

$_SESSION['emailValue'] = NULL;
header('Location: ../pages/recoverPassword.php');
