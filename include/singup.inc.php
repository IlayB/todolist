<?php

if (isset($_POST["submit"])) {

    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $password2 = $_POST["password2"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (emptyInputString($email, $username, $password, $password2) !== false) {
        header("location: ../register.php?error=emptyinput");
        exit();
    }
    if (invalidEmail($email) !== false) {
        header("location: ../register.php?error=invalidemail");
        exit();
    }
    if (invalidUid($username) !== false) {
        header("location: ../register.php?error=invalidusername");
        exit();
    }
    if (pwdMatch($password, $password2) !== false) {
        header("location: ../register.php?error=passworddontmatch");
        exit();
    }
    if (uidExist($conn, $username, $email) !== false) {
        header("location: ../register.php?error=usertaken");
        exit();
    }
    createUSer($conn, $email, $username, $password);
} else {
    header("location: ../index.php");
    exit();
};
