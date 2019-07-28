<?php
    session_start();
    require '../action/errorMessage.php';
    require '../action/inputValue.php';
?>
<!DOCTYPE html>
<HTML>
<header>
    <link rel="stylesheet" type="text/css" href="../style/createAccount.css">
    <meta charset="UTF-8">
    <title>Recover password</title>
</header>
<body>
<div class="createAccount">
    <form method="post" action="../action/actionRecoverPassword.php">
        <?php errorEmpty(); ?>
        <div class="row">
            <input type="text" name="email" id="email" required value=<?php inputValue($_SESSION['emailValue']); ?>>
            <?php errorEmail(); ?>
        </div>
        <input type="submit" name="submit" value="Send">
    </form>
</div>
</body>
</HTML>