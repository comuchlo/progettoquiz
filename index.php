<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SESSION['username'])){
    header('location: menu.php');
    die();
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <?php require("./include_bs_css.php"); ?>

</head>
<body>
    <div class=" px-5 justify-content-center align-items-center row" style="height: 100vh;">
        <div class="p-5 bg-light-subtle bs-light-border-subtle fw-medium bg-body-light bg-gradient border rounded-4" style="max-width: 32rem;">
            <?=(isset($_REQUEST['login_error']))?('<div class="alert alert-danger alert-dismissible fade show fw-normal" role="alert">credenziali errate, riprova  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'):('') ?>
            <form action="login.php" method="post" class="row g-2">
                <label for="username" class="form-label">username</label>
                <input type="text" name="username" id="username" required class="form-control"><br>
                <label for="password" class="form-label">password</label>
                <input type="password" name="password" id="password" required class="form-control"><br>
                <input type="submit" value="login" name="submit" class="btn btn-success"><br>
            </form>
        </div>
    </div>
    <?php require("./include_bs_js.php"); ?>
</body>
</html>