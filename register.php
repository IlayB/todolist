<?php
include('config/db_connect.php');
include('templates/header.php');
include('templates/footer.php');

$email = $username = $password = $error = "";

?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Andika+New+Basic&display=swap');
</style>
<link rel="stylesheet" href="style.css">
<div class="inputform">
    <form action="include/singup.inc.php" method="POST">
        <label>Email </label></br>
        <input type="email" name="email"></br>
        <label>Username: </label></br>
        <input type="text" name="username"></input></br>
        <label>Password: </label></br>
        <input type="password" name="password"></input></br>
        <label>Confirm Password: </label></br>
        <input type="password" name="password2"></input></br>
        <input type="submit" name="submit" value="Register">
        <input type="reset" name="Cancel" value="Cancel">
    </form>
</div>
<h4 style="color:red" align="center">
    <?php
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
            echo "<p>Complete all fields</p>";
        } else if ($_GET["error"] == "invalidemail") {
            echo "<p>Invalid email</p>";
        } else if ($_GET["error"] == "invalidusername") {
            echo "<p>Invalid username</p>";
        } else if ($_GET["error"] == "passworddontmatch") {
            echo "<p>Passwords dont match</p>";
        } else if ($_GET["error"] == "usertaken") {
            echo "<p>User already exists</p>";
        } else if ($_GET["error"] == "statementfailer") {
            echo "<p>Something went wrong</p>";
        } else if ($_GET["error"] == "None") {
            echo "<p>Registered!</p>";
        }
    } ?>
</h4>