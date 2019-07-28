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
    <title>Change password</title>
</header>
<body>
<div class="createAccount">
    <a href="homePage.php">Home page</a>
    <form method="post" action="../action/changePassword.php">
        <?php errorEmpty(); ?>
        <input type="hidden" name="token" id="token" value=<?php echo $_GET['token']; ?>>
        <div class="row">
            <input type="password" name="password" id="password" required>
            <label class="lableRight" for="pass">Password</label>
        </div>
        <div class="row">
            <input type="password" name="confirmPassword" id="confirmPassword" required>
            <?php errorConfirmPassword(); ?>
        </div>
        <input type="submit" name="submit" value="Change">
    </form>
</div>
</body>
</HTML>