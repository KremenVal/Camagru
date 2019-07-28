<?php
    $location = $_SERVER['HTTP_HOST'] . str_replace("/action/actionCreate.php", "", $_SERVER['REQUEST_URI']);
    $token = uniqid(rand(), true);
    $pdo = new PDO($DB_DSN_CREATED, $DB_USER, $DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sqlInsertInto = 'INSERT INTO users (login, email, password, token)
                value (:login, :email, :password, :token)';
    $result = $pdo->prepare($sqlInsertInto);
    $result->execute([':login' => $_POST['login'],
        ':email' => $_POST['email'],
        ':password' => hash('whirlpool', $_POST['password']),
        ':token' => $token
    ]);
    $result->closeCursor();