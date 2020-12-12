<?php
function emptyInputString($email, $username, $password, $password2)
{
    if (empty($email) || empty($username) || empty($password) || empty($password2)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
};
function invalidUid($username)
{
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
};
function invalidEmail($email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
};
function pwdMatch($password, $password2)
{
    if ($password !== $password2) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
};
function uidExist($conn, $username, $email)
{
    $sql = "SELECT * FROM users WHERE username = ? OR email = ?;";
    $statement = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($statement, $sql)) {
        header("location: ../register.php?error=statementfailer");
        exit();
    }

    mysqli_stmt_bind_param($statement, "ss", $username, $email);
    mysqli_stmt_execute($statement);

    $resultData = mysqli_stmt_get_result($statement);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }
    mysqli_stmt_close($statement);
};
function createUSer($conn, $email, $username, $password)
{
    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?);";
    $statement = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($statement, $sql)) {
        header("location: ../register.php?error=statementfailer");
        exit();
    }

    $hashedPass = password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($statement, "sss", $username, $email, $hashedPass);
    mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);

    header("location: ../register.php?error=none");
    exit();
};

//LOGIN

function emptyLogin($login, $password)
{
    if (empty($login) || empty($password)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
};
function loginUSer($conn, $login, $password)
{
    $userExists = uidExist($conn, $login, $login);

    //CHECK USERNAME

    if ($userExists === false) {
        header("location: ../login.php?error=nosuchuser");
        exit();
    }

    //CHECK PASSWORD

    $passHash = $userExists["password"];
    $checkPass = password_verify($password, $passHash);

    if ($checkPass === false) {
        header("location: ../login.php?error=wrongpassword");
        exit();
    } else if ($checkPass === true) {
        //CREATE LOGIN SESSION
        session_start();
        $_SESSION["user_id"] = $userExists["user_id"];
        $_SESSION["username"] = $userExists["login"];
        header("location: ../index.php");
        exit();
    }
};
