<?php
    session_start();
    if(isset($_SESSION['user_id'])) {
        $msg = "Je bent al ingelogd";
        header("Location: index.php?msg=".$msg);
        die;
}
?>

<!doctype html>
<html lang="nl">
<head>
    <title>Timesheet / Registreer</title>
    <?php require_once 'head.php'; ?>
</head>
<body>
    <?php require_once 'header.php'; ?>
    <div class="container home">
        <?php if(isset($_GET['msg'])){ echo $_GET['msg']; }?>

        <form action="backend/registerController.php" method="POST">
            <div class="form-group">
                <label for="name">Naam: </label>
                <input type="text" name="name" id="name">
            </div>
            <div class="form-group">
                <label for="username">Gebruikersnaam: </label>
                <input type="text" name="username" id="username">
            </div>
            <div class="form-group">
                <label for="password">Wachtwoord: </label>
                <input type="password" name="password" id="password">
            </div>
            <div class="form-group">
                <label for="password-confirm">Wachtwoord: </label>
                <input type="password" name="password-confirm" id="password-confirm">
            </div>
            <input type="submit" value="Registreer">
        </form>


    </div>
</body>
</html>