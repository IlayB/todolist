<?php
include('config/db_connect.php');
include('templates/header.php');
include('templates/footer.php');

$login = $password = "";
?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Andika+New+Basic&display=swap');
</style>
<link rel="stylesheet" href="style.css">
<div class="inputform">
    <form action="include/login.inc.php" method="POST">
        <label>Email / Username </label></br>
        <input type="text" name="login"></br>
        <label>Password: </label></br>
        <input type="password" name="password"></input></br>
        <input type="submit" name="submit" value="Login">
        <input type="reset" name="Cancel" value="Cancel">
    </form>
</div>
<h4 style="color:red" align="center">
    <?php
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "nosuchuser") {
            echo "<p>Wrong Email / Username</p>";
        } else if ($_GET["error"] == "wrongpassword") {
            echo "<p>Wrong password</p>";
        } else if ($_GET["error"] == "emptyinput") {
            echo "<p>Complete all fields</p>";
        }
    } ?>
</h4>