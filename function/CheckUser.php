<?php
    $pdo = new PDO($DB_DSN_CREATED, $DB_USER, $DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $result= $pdo->prepare("SELECT login FROM users");
    $result->execute();
    $valLogin = $result->fetch();
    $result->closeCursor();
    $loginExist = false;

    foreach ($valLogin as $value)
    {
        if (mb_strtolower($value) == mb_strtolower($_POST['login']))
        {
            $loginExist = true;
        }
    }

    $result= $pdo->prepare("SELECT * FROM users WHERE email=:email");
    $result->execute(array(':email' => $_POST['email']));
    $valEmail = $result->fetch();
    $result->closeCursor();