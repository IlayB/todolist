<?php

if (isset($_POST["submit"])) {

    $login = $_POST["login"];
    $password = $_POST["password"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (emptyLogin($login, $password) !== false) {
        header("location: ../login.php?error=emptyinput");
        exit();
    }

    loginUSer($conn, $login, $password);
} else {
    header("location: ../index.php");
};
